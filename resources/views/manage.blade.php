<!DOCTYPE html>
<html lang="">
@include('components.header')
@include('components.navbar')
<body>
<h1>Manage Products</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Old Price</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->old_price }}</td>
            <td><img src="{{ asset('img/' . $product->image) }}" width="50px"></td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@include('components.footer')
</body>
</html>
