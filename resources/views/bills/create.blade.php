@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Create Bill</h1>

        <form action="{{ route('bills.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="customer_id">
                    Customer
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('customer_id') border-red-500 @enderror"
                    id="customer_id" name="customer_id" required>
                    <option value="">Select a customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div id="products-container">
                <h3 class="text-lg font-semibold mb-4">Products</h3>
                <div class="product-row mb-4">
                    <div class="flex space-x-4">
                        <div class="flex-1">
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name="products[0][id]" required>
                                <option value="">Select a product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                        {{ $product->name }} - ${{ number_format($product->price, 2) }} ({{ $product->stock }} in stock)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-32">
                            <input type="number" name="products[0][quantity]" min="1" value="1" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Qty">
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="mb-4 text-blue-500 hover:text-blue-700" onclick="addProductRow()">
                + Add Another Product
            </button>

            <div class="flex items-center justify-between mt-6">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Create Bill
                </button>
                <a href="{{ route('bills.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        let productRowCount = 1;

        function addProductRow() {
            const container = document.getElementById('products-container');
            const newRow = document.createElement('div');
            newRow.className = 'product-row mb-4';
            newRow.innerHTML = `
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            name="products[${productRowCount}][id]" required>
                            <option value="">Select a product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                    {{ $product->name }} - ${{ number_format($product->price, 2) }} ({{ $product->stock }} in stock)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-32">
                        <input type="number" name="products[${productRowCount}][quantity]" min="1" value="1" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Qty">
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.parentElement.remove()">
                        Remove
                    </button>
                </div>
            `;
            container.appendChild(newRow);
            productRowCount++;
        }
    </script>
@endsection 