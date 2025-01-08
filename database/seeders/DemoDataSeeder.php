<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Bill;
use App\Models\BillItem;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample customers
        $customer1 = Customer::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '1234567890',
            'address' => '123 Main St'
        ]);

        $customer2 = Customer::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'phone' => '0987654321',
            'address' => '456 Oak Ave'
        ]);

        // Create sample products
        $product1 = Product::create([
            'name' => 'Laptop XPS',
            'description' => 'High-performance laptop',
            'price' => 999.99,
            'stock' => 10
        ]);

        $product2 = Product::create([
            'name' => 'iPhone 15',
            'description' => 'Latest model smartphone',
            'price' => 599.99,
            'stock' => 15
        ]);

        // Create sample bills
        $bill1 = Bill::create([
            'customer_id' => $customer1->id,
            'total_amount' => 1599.98, // Laptop + iPhone
            'status' => 'paid'
        ]);

        // Create bill items for first bill
        BillItem::create([
            'bill_id' => $bill1->id,
            'product_id' => $product1->id,
            'quantity' => 1,
            'price' => 999.99,
            'subtotal' => 999.99
        ]);

        BillItem::create([
            'bill_id' => $bill1->id,
            'product_id' => $product2->id,
            'quantity' => 1,
            'price' => 599.99,
            'subtotal' => 599.99
        ]);

        // Create another bill
        $bill2 = Bill::create([
            'customer_id' => $customer2->id,
            'total_amount' => 599.99, // Just iPhone
            'status' => 'pending'
        ]);

        // Create bill item for second bill
        BillItem::create([
            'bill_id' => $bill2->id,
            'product_id' => $product2->id,
            'quantity' => 1,
            'price' => 599.99,
            'subtotal' => 599.99
        ]);
    }
}
