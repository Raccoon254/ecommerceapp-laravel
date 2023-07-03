@extends('layouts.app')

@section('content')
<form action="{{ route('categories.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Category Name:</label>
        <input id="name" type="text" name="name" class="form-control" />
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Add Category</button>
    </div>
</form>
@endsection
