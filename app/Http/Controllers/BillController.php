<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Customer;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with(['customer', 'items.product'])->latest()->paginate(10);
        return view('bills.index', compact('bills'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::where('stock', '>', 0)->get();
        return view('bills.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $total_amount = 0;
                $bill = Bill::create([
                    'customer_id' => $validated['customer_id'],
                    'total_amount' => 0,
                    'status' => 'pending'
                ]);

                foreach ($validated['products'] as $item) {
                    $product = Product::findOrFail($item['id']);
                    if ($product->stock < $item['quantity']) {
                        throw new \Exception("Insufficient stock for product: {$product->name}");
                    }

                    $subtotal = $product->price * $item['quantity'];
                    $total_amount += $subtotal;

                    BillItem::create([
                        'bill_id' => $bill->id,
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'price' => $product->price,
                        'subtotal' => $subtotal
                    ]);

                    $product->decrement('stock', $item['quantity']);
                }

                $bill->update(['total_amount' => $total_amount]);
            });

            return redirect()->route('bills.index')->with('success', 'Bill created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function show(Bill $bill)
    {
        $bill->load(['customer', 'items.product']);
        return view('bills.show', compact('bill'));
    }

    public function update(Request $request, Bill $bill)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $bill->update($validated);
        return redirect()->route('bills.index')->with('success', 'Bill status updated successfully');
    }

    public function destroy(Bill $bill)
    {
        if ($bill->status === 'paid') {
            return back()->with('error', 'Cannot delete a paid bill');
        }

        DB::transaction(function () use ($bill) {
            // Restore product stock
            foreach ($bill->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
            $bill->delete();
        });

        return redirect()->route('bills.index')->with('success', 'Bill deleted successfully');
    }
}
