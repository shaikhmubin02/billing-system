@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Customers</h1>
        <a href="{{ route('customers.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add Customer
        </a>
    </div>

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Phone</th>
                    <th class="py-3 px-6 text-left">Address</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @foreach ($customers as $customer)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $customer->name }}</td>
                        <td class="py-3 px-6">{{ $customer->email }}</td>
                        <td class="py-3 px-6">{{ $customer->phone }}</td>
                        <td class="py-3 px-6">{{ $customer->address }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <a href="{{ route('customers.show', $customer) }}" class="text-blue-500 hover:text-blue-700 mx-2">
                                    View
                                </a>
                                <a href="{{ route('customers.edit', $customer) }}" class="text-yellow-500 hover:text-yellow-700 mx-2">
                                    Edit
                                </a>
                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline">
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
        {{ $customers->links() }}
    </div>
@endsection 