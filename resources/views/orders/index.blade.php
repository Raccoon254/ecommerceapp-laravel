@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4 text-gray-700 dark:text-white">All Orders</h1>

    <table class="table-auto w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
        <tr>
            <th class="px-4 py-2 text-gray-600 dark:text-gray-300">Order Number</th>
            <th class="px-4 py-2 text-gray-600 dark:text-gray-300">User Name</th>
            <th class="px-4 py-2 text-gray-600 dark:text-gray-300">Email</th>
            <th class="px-4 py-2 text-gray-600 dark:text-gray-300">Delivery Location</th>
            <th class="px-4 py-2 text-gray-600 dark:text-gray-300">Total Price</th>
            <th class="px-4 py-2 text-gray-600 dark:text-gray-300">Status</th>
            <th class="px-4 py-2 text-gray-600 dark:text-gray-300">Actions</th>
        </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800">
        @foreach($orders as $order)
            <tr class="text-gray-700 dark:text-gray-300">
                <td class="border px-4 py-2">{{ $order->order_number }}</td>
                <td class="border px-4 py-2">{{ $order->user->name }}</td>
                <td class="border px-4 py-2">{{ $order->user->email }}</td>
                <td class="border px-4 py-2">{{ $order->delivery_location }}</td>
                <td class="border px-4 py-2">${{ number_format($order->total_price, 2) }}</td>
                <td class="border px-4 py-2">{{ $order->status }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('orders.show', $order) }}" class="text-blue-500 hover:text-blue-700 dark:hover:text-blue-300"><i class="fa-solid fa-gear fa-spin"></i> View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
