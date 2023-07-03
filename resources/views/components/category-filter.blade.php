<section>
    @foreach($categories as $category)
        <div class="input-checkbox">
            <input type="checkbox" id="category-{{ $category->id }}" class="category-checkbox" data-category-id="{{ $category->id }}">
            <label for="category-{{ $category->id }}">
                <span></span>
                {{ $category->name }}
                <small>({{ $category->products->count() }})</small>
            </label>
        </div>
    @endforeach
</section>
