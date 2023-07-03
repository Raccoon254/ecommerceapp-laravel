@if($products->isEmpty())
    <h3 style="padding-left: 10px">No products found</h3>
@else
    @foreach ($products as $product)
        <div class="col-md-4 col-xs-6">
            <a href="{{ route('products.prod', ['id' => $product->id]) }}">
                <div class="product">
                    <div class="product-img">
                        <img src="{{ asset('img/' . $product->image) }}" alt="">
                        <div class="product-label">
                            @if($product->discount)
                                <span class="sale">-{{$product->discount}}%</span>
                            @endif
                            <!-- Checking if the product was created in the last 10 minutes -->
                            @if($product->created_at >= \Carbon\Carbon::now()->subMinutes(10))
                                <span class="new">NEW</span>
                            @endif
                        </div>
                    </div>
                    <div class="product-body">
                        <p class="product-category"><small>{{ $product->category->name }}</small></p>
                        <h3 class="product-name"><a href="#">{{ $product->name }}</a></h3>
                        <h4 class="product-price">${{ $product->price }} <del class="product-old-price">${{ $product->old_price }}</del></h4>
                        <div class="product-rating">
                            <form action="{{ route('ratings.store', $product) }}" method="POST">
                                @csrf
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="submit" name="rating" value="{{ $i }}" class="star rating-button" title="Rate this {{ $i }} out of 5 stars">
                                        @if($product->averageRating() >= $i)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    </button>
                                @endfor
                            </form>
                        </div>

                        <div class="product-btns">
                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                        </div>
                    </div>
                    <div class="add-to-cart">
                        <button class="add-to-cart-btn" data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i> add to cart</button>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
@endif
