@foreach($topSellingProducts as $product)
    <div class="product-widget flex">
        <div class="top-sell-img w-1/4">
            <img src="{{ asset('img/'.$product->image) }}" alt="">
        </div>
        <div class="product-body pl-30 w-3/4">
            <h3 class="product-name w-full"><a href="#">{{ $product->name }}</a></h3>
            <h4 class="product-price w-full">${{ $product->price }} <del class="product-old-price">${{ $product->old_price }}</del></h4>
        </div>
    </div>
@endforeach
