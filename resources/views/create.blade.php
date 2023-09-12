@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 mt-5">
        <h1 class="text-center text-2xl font-bold mb-5">Create Product</h1>
        <div class="shadow rounded-lg p-6">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <x-input-label for="name" value="Name" />
                        <x-text-input id="name" type="text" name="name" class="w-full" value="{{ old('name') }}"/>
                        @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <x-input-label for="category_id" value="Category" />
                        <select id="category_id" name="category_id" class="select select-secondary w-full mt-2 p-2 flex items form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <x-input-label for="price" value="Price" />
                        <x-text-input id="price" type="text" name="price" class="w-full" value="{{ old('price') }}"/>
                        @error('price')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <x-input-label for="old_price" value="Old Price" />
                        <x-text-input id="old_price" type="text" name="old_price" class="w-full" value="{{ old('old_price') }}"/>
                        @error('old_price')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <x-input-label for="images" value="Images" />
                        <input type="file" id="images" name="images[]" multiple class="file-input file-input-bordered mt-2 w-full">
                        @error('images')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <x-input-label for="description" value="Description" />
                        <textarea id="description" name="description" class="form-input textarea textarea-primary mt-2 w-full p-2 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Add the product data fields -->
                    <div class="form-group">
                        <x-input-label for="size" value="Size" />
                        <x-text-input id="size" type="text" name="size" class="w-full" value="{{ old('size') }}"/>
                    </div>
                    <div class="form-group">
                        <x-input-label for="color" value="Color" />
                        <x-text-input id="color" type="text" name="color" class="w-full" value="{{ old('color') }}"/>
                    </div>
                    <div class="form-group">
                        <x-input-label for="car_model_name" value="Car Model Name" />
                        <x-text-input id="car_model_name" type="text" name="car_model_name" class="w-full" value="{{ old('car_model_name') }}"/>
                    </div>
                    <div class="form-group">
                        <x-input-label for="weight" value="Weight" />
                        <x-text-input id="weight" type="text" name="weight" class="w-full" value="{{ old('weight') }}"/>
                    </div>
                    <div class="form-group">
                        <x-input-label for="part_number" value="Part Number" />
                        <x-text-input id="part_number" type="text" name="part_number" class="w-full" value="{{ old('part_number') }}"/>
                    </div>
                    <div class="form-group">
                        <x-input-label for="manufacturer" value="Manufacturer" />
                        <x-text-input id="manufacturer" type="text" name="manufacturer" class="w-full" value="{{ old('manufacturer') }}"/>
                    </div>
                    <div class="form-group">
                        <x-input-label for="compatibility" value="Compatibility" />
                        <x-text-input id="compatibility" type="text" name="compatibility" class="w-full" value="{{ old('compatibility') }}"/>
                    </div>
                    <div class="form-group">
                        <x-input-label for="material" value="Material" />
                        <x-text-input id="material" type="text" name="material" class="w-full" value="{{ old('material') }}"/>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn btn-outline btn-warning ring-2 ring-offset-2 px-4 py-2 font-medium bg-blue-600 text-white hover:bg-blue-500">
                        <i class="fa-solid fa-cart-plus"></i>
                        Add Product
                    </button>
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
