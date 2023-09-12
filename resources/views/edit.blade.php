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
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="category">Category:</label>
                <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category', $product->category->name) }}">
                @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12 col-md-6">
                <label for="price">Price:</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}">
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="old_price">Old Price:</label>
                <input type="text" class="form-control @error('old_price') is-invalid @enderror" id="old_price" name="old_price" value="{{ old('old_price', $product->old_price) }}">
                @error('old_price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12 col-md-6">
                <label for="description">Description:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12 col-md-6">
                <label for="current_image">Current Image:</label><br>
                <img src="{{ asset('img/' . $product->image) }}" class="mt-3" width="100px" alt="">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="image">New Image:</label><br>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-row">
                <div class="form-group col-12 col-md-6">
                    <label for="size">Size:</label>
                    <input type="text" class="form-control @error('size') is-invalid @enderror" id="size" name="```html
size" value="{{ old('size', optional($product->productData)->size) }}">
                    @error('size')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color', optional($product->productData)->color) }}">
                    @error('color')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="car_model_name">Car Model Name:</label>
                    <input type="text" class="form-control @error('car_model_name') is-invalid @enderror" id="car_model_name" name="car_model_name" value="{{ old('car_model_name', optional($product->productData)->car_model_name) }}">
                    @error('car_model_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="weight">Weight:</label>
                    <input type="text" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight', optional($product->productData)->weight) }}">
                    @error('weight')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="part_number">Part Number:</label>
                    <input type="text" class="form-control @error('part_number') is-invalid @enderror" id="part_number" name="part_number" value="{{ old('part_number', optional($product->productData)->part_number) }}">
                    @error('part_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="manufacturer">Manufacturer:</label>
                    <input type="text" class="form-control @error('manufacturer') is-invalid @enderror" id="manufacturer" name="manufacturer" value="{{ old('manufacturer', optional($product->productData)->manufacturer) }}">
                    @error('manufacturer')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="compatibility">Compatibility:</label>
                    <input type="text" class="form-control @error('compatibility') is-invalid @enderror" id="compatibility" name="compatibility" value="{{ old('compatibility', optional($product->productData)->compatibility) }}">
                    @error('compatibility')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="material">Material:</label>
                    <input type="text" class="form-control @error('material') is-invalid @enderror" id="material" name="material" value="{{ old('material', optional($product->productData)->material) }}">
                    @error('material')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
                <!-- Image upload -->
            <div class="form-group">
                <label for="images">Product Images:</label>
                <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images[]" multiple>
                @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


        </div>
        <div class="form-row">
            <div class="form-group col-12 col-md-6">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </form>
</div>
@include('components.footer')
</body>
</html>
