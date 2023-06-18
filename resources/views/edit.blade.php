<!DOCTYPE html>
<html lang="">
@include('components.header')
@include('components.navbar')
<body>
<div class="container mt-10 pt-20">
    <h1 class="text-center">Edit Product</h1>
    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-row">
            <div class="form-group col-12 col-md-6">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ $product->category }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12 col-md-6">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="old_price">Old Price:</label>
                <input type="text" class="form-control" id="old_price" name="old_price" value="{{ $product->old_price }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12 col-md-6">
                <label for="current_image">Current Image:</label><br>
                <img src="{{ asset('img/' . $product->image) }}" class="mt-3" width="100px" alt="">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="image">New Image:</label><br>
                <input type="file" id="image" name="image">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12 col-md-6">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
@include('components.footer')
</body>
</html>
