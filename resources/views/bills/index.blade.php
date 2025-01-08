@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Bills</h1>
        <a href="{{ route('bills.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create Bill
        </a>
    </div>

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Bill #</th>
                    <th class="py-3 px-6 text-left">Customer</th>
                    <th class="py-3 px-6 text-right">Total Amount</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Date</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @foreach ($bills as $bill)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $bill->id }}</td>
                        <td class="py-3 px-6">{{ $bill->customer->name }}</td>
                        <td class="py-3 px-6 text-right">${{ number_format($bill->total_amount, 2) }}</td>
                        <td class="py-3 px-6 text-center">
                            <span class="px-2 py-1 rounded text-xs
                                @if($bill->status === 'paid') bg-green-200 text-green-800
                                @elseif($bill->status === 'pending') bg-yellow-200 text-yellow-800
                                @else bg-red-200 text-red-800
                                @endif">
                                {{ ucfirst($bill->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-center">{{ $bill->created_at->format('Y-m-d') }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <a href="{{ route('bills.show', $bill) }}" class="text-blue-500 hover:text-blue-700 mx-2">
                                    View
                                </a>
                                @if($bill->status !== 'paid')
                                    <form action="{{ route('bills.update', $bill) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="paid">
                                        <button type="submit" class="text-green-500 hover:text-green-700 mx-2">
                                            Mark as Paid
                                        </button>
                                    </form>
                                    <form action="{{ route('bills.destroy', $bill) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 mx-2" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $bills->links() }}
    </div>
@endsection 