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
<div class="container">
    <h1 class="my-3">Review for {{ $product->name }}</h1>
    <form action="{{ route('product_reviews.store', ['product' => $product]) }}" method="post" class="bg-light p-4 rounded">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select class="form-select" id="rating" name="rating" required>
                <option selected disabled>Choose...</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" @if(isset($review) && $review->rating == $i) selected @endif>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="review" class="form-label">Review</label>
            <textarea class="form-control" id="review" name="review" rows="3">{{ isset($review) ? $review->review : '' }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
