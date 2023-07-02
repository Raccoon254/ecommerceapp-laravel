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
                        <x-text-input id="name" type="text" name="name" class="w-full"/>
                        @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <x-input-label for="category" value="Category" />
                        <x-text-input id="category" type="text" name="category" class="w-full" />
                        @error('category')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <x-input-label for="price" value="Price" />
                        <x-text-input id="price" type="text" name="price" class="w-full" />
                        @error('price')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <x-input-label for="old_price" value="Old Price" />
                        <x-text-input id="old_price" type="text" name="old_price" class="w-full" />
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
                        <label for="description"></label><textarea id="description" name="description" class="form-input textarea textarea-primary mt-2 w-full p-2 rounded-md shadow-sm"></textarea>
                        @error('description')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn btn-outline btn-warning ring-2 ring-offset-2 px-4 py-2 font-medium bg-blue-600 text-white hover:bg-blue-500">
                        <i class="fa-solid fa-cart-plus"></i>
                        Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
