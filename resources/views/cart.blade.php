<!DOCTYPE html>
<html lang="en">
@include('components.header')
<body>
<!-- HEADER -->
<header>
    @php
        use Carbon\Carbon;
    @endphp
</header>
<!-- /HEADER -->

@include('components.navbar')

<!-- BREADCRUMB -->

<div>
    <table class="table table-striped table-bordered table-responsive-sm">
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Image</th>
            <th>Add</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody>
        @php
            $totalAmount = 0;
        @endphp
        @foreach ($cart as $productId => $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['price'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td><img src="{{ asset('img/'.$item['image']) }}" class="img-fluid" width="70px" alt="{{ $item['name'] }}"></td>
                <td>
                    <a href="{{ route('cart.increment', $productId) }}" class="btn btn-primary">+</a>
                </td>
                <td>
                    <a href="{{ route('cart.decrement', $productId) }}" class="btn btn-primary">-</a>
                </td>
            </tr>
            @php
                $totalAmount += $item['price'] * $item['quantity'];
            @endphp
        @endforeach
        </tbody>
    </table>
    <p class="w-full center">Total Amount: {{ $totalAmount }}</p>
    <div class="d-flex px-2 w-full center gap-2">
        <a href="{{ route('cart.clear') }}" class="btn center flex gap-2 btn-danger"><i class="fa-solid fa-trash"></i>Clear Cart</a>
        <a href="{{ route('checkout') }}" class="btn flex center gap-2 btn-success"><i class="fa-solid fa-bag-shopping"></i>Checkout</a>
        <a href="{{ route('cart.index') }}" class="btn flex center gap-2 btn-primary"><i class="fa-solid fa-rotate-right"></i>Refresh</a>
    </div>
</div>

<!-- /BREADCRUMB -->
@include('components.footer')

</body>
</html>
