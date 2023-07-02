<div class="container mx-auto px-4 mt-6 py-5">
    <div class="flex gap-4 flex-wrap items-center justify-center">
        <a href="{{ route('orders.index') }}" class="flex justify-center items-center flex-col">
            <i class="fa-solid fa-bag-shopping fa-2x"></i>
            <p class="normal-case">Orders</p>
        </a>
        <a href="{{ route('add.prod') }}" class="flex justify-center items-center flex-col">
            <i class="fa-solid fa-cart-plus fa-2x"></i>
            <p class="normal-case">Add Part</p>
        </a>
        <a href="{{ route('manage.products') }}" class="flex justify-center items-center flex-col">
            <i class="fas fa-cogs fa-2x"></i>
            <p class="normal-case">Manage</p>
        </a>
    </div>

    <div class="text-center mt-10">
        <p class="text-sm text-gray-500">
            &copy; @php echo date("Y"); @endphp {{ config('app.name') }}. All rights reserved.
        </p>
    </div>
</div>
