@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-5">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-700 dark:text-white">Order Details</h1>
            <h2 class="text-xl text-gray-500 dark:text-gray-300">
                <i class="fas fa-receipt"></i> {{ $order->order_number }}
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold mb-2 text-gray-700 dark:text-white">
                    <i class="fas fa-user"></i> Customer Details
                </h2>
                <p class="text-gray-600 dark:text-gray-300"><strong>Name:</strong> {{ $order->user->name }}</p>
                <p class="text-gray-600 dark:text-gray-300"><strong>Email:</strong> {{ $order->user->email }}</p>
                <p class="text-gray-600 dark:text-gray-300"><strong>Delivery Location:</strong> {{ $order->delivery_location }}</p>
                <p class="text-gray-600 dark:text-gray-300"><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold mb-2 text-gray-700 dark:text-white">
                    <i class="fas fa-cogs"></i> Order Status
                </h2>
                <form method="POST" action="{{ route('orders.update', $order) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <label for="status" class="text-gray-600 dark:text-gray-300">Status</label>
                    <select id="status" name="status" class="w-full py-2 px-3 text-gray-700 bg-gray-200 rounded-lg focus:outline-none focus:shadow-outline">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 rounded text-white">Update Status</button>
                </form>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-10">
            <h2 class="text-2xl font-bold mb-2 text-gray-700 dark:text-white">
                <i class="fas fa-box-open"></i> Products Ordered
            </h2>
            <ul class="space-y-4">
                @foreach($order->products as $product)
                    <li class="border-b pb-4">
                        <p class="text-gray-600 dark:text-gray-300"><strong>Name:</strong> {{ $product->name }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Quantity:</strong> {{ $product->pivot->quantity }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Price:</strong> ${{ number_format($product->pivot->price_at_the_time_of_purchase, 2) }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex justify-center">
            <a href="{{ route('orders.index') }}" class="py-2 px-4 bg-blue-600 hover:bg-blue-700 rounded text-white">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>
@endsection
