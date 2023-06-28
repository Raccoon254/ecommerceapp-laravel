<!DOCTYPE html>
<html lang="">
@include('components.header')
@include('components.navbar')
<body>
<div class="container mt-5">
    <h1 class="text-center">Manage Products</h1>

    @if ($products->isEmpty())
        <div class="alert alert-warning">
            <p>No products found </p>
            <p>Please click <a href="{{ route('add.prod') }}">here</a> to add products</p>
        </div>
    @else
    <table class="table table-striped table-bordered table-responsive-sm">
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Old Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->old_price }}</td>
                <td width="100px">{{ $product->description }}</td>
                <td><img src="{{ asset('img/' . $product->image) }}" class="img-fluid" width="70px"></td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                    <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger delete-btn" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".delete-btn");

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const productName = this.dataset.productName;
                const productId = this.dataset.productId;
                const userInput = prompt(`Please enter product name to confirm deletion.\nType: ${productName}`);

                if (userInput === productName) {
                    document.getElementById(`delete-form-${productId}`).submit();
                } else {
                    alert('Incorrect product name. Operation cancelled.');
                }
            });
        });
    });
</script>

@include('components.footer')
</body>
</html>
