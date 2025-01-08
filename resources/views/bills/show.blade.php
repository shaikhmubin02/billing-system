@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Bill #{{ $bill->id }}</h1>
            <a href="{{ route('bills.index') }}" class="text-gray-600 hover:text-gray-800">Back to Bills</a>
        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Customer Information</h2>
                <p><strong>Name:</strong> {{ $bill->customer->name }}</p>
                <p><strong>Email:</strong> {{ $bill->customer->email }}</p>
                <p><strong>Phone:</strong> {{ $bill->customer->phone }}</p>
                <p><strong>Address:</strong> {{ $bill->customer->address }}</p>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Bill Details</h2>
                <p><strong>Status:</strong> 
                    <span class="px-2 py-1 rounded text-xs
                        @if($bill->status === 'paid') bg-green-200 text-green-800
                        @elseif($bill->status === 'pending') bg-yellow-200 text-yellow-800
                        @else bg-red-200 text-red-800
                        @endif">
                        {{ ucfirst($bill->status) }}
                    </span>
                </p>
                <p><strong>Date:</strong> {{ $bill->created_at->format('Y-m-d H:i:s') }}</p>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Items</h2>
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Product</th>
                            <th class="py-3 px-6 text-right">Price</th>
                            <th class="py-3 px-6 text-right">Quantity</th>
                            <th class="py-3 px-6 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @foreach($bill->items as $item)
                            <tr class="border-b border-gray-200">
                                <td class="py-3 px-6">{{ $item->product->name }}</td>
                                <td class="py-3 px-6 text-right">${{ number_format($item->price, 2) }}</td>
                                <td class="py-3 px-6 text-right">{{ $item->quantity }}</td>
                                <td class="py-3 px-6 text-right">${{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr class="font-bold">
                            <td class="py-3 px-6" colspan="3">Total</td>
                            <td class="py-3 px-6 text-right">${{ number_format($bill->total_amount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if($bill->status !== 'paid')
                <div class="flex space-x-4">
                    <form action="{{ route('bills.update', $bill) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="paid">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Mark as Paid
                        </button>
                    </form>

                    <form action="{{ route('bills.destroy', $bill) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">
                            Delete Bill
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection 