@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Products</h1>
        <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Product
        </a>
    </div>

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-right">Price</th>
                    <th class="py-3 px-6 text-right">Stock</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @foreach ($products as $product)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $product->name }}</td>
                        <td class="py-3 px-6">{{ $product->description }}</td>
                        <td class="py-3 px-6 text-right">${{ number_format($product->price, 2) }}</td>
                        <td class="py-3 px-6 text-right">{{ $product->stock }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <a href="{{ route('products.show', $product) }}" class="text-blue-500 hover:text-blue-700 mx-2">
                                    View
                                </a>
                                <a href="{{ route('products.edit', $product) }}" class="text-yellow-500 hover:text-yellow-700 mx-2">
                                    Edit
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 mx-2" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection 