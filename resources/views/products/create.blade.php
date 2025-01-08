@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Create Product</h1>

        <form action="{{ route('products.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                    id="name" type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                    id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                    Price
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror"
                    id="price" type="number" step="0.01" name="price" value="{{ old('price') }}" required>
                @error('price')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="stock">
                    Stock
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('stock') border-red-500 @enderror"
                    id="stock" type="number" name="stock" value="{{ old('stock', 0) }}" required>
                @error('stock')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Create Product
                </button>
                <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
            </div>
        </form>
    </div>
@endsection 