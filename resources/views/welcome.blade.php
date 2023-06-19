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
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li><a href="#">All Categories</a></li>
							<li><a href="#">Accessories</a></li>
							<li class="active">Headphones (227,490 Results)</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
							<div class="checkbox-filter">

								<div class="input-checkbox">
									<input type="checkbox" id="category-1">
									<label for="category-1">
										<span></span>
										Laptops
										<small>(120)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-2">
									<label for="category-2">
										<span></span>
										Smartphones
										<small>(740)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-3">
									<label for="category-3">
										<span></span>
										Cameras
										<small>(1450)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-4">
									<label for="category-4">
										<span></span>
										Accessories
										<small>(578)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-5">
									<label for="category-5">
										<span></span>
										Laptops
										<small>(120)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-6">
									<label for="category-6">
										<span></span>
										Smartphones
										<small>(740)</small>
									</label>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Brand</h3>
							<div class="checkbox-filter">
								<div class="input-checkbox">
									<input type="checkbox" id="brand-1">
									<label for="brand-1">
										<span></span>
										SAMSUNG
										<small>(578)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-2">
									<label for="brand-2">
										<span></span>
										LG
										<small>(125)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-3">
									<label for="brand-3">
										<span></span>
										SONY
										<small>(755)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-4">
									<label for="brand-4">
										<span></span>
										SAMSUNG
										<small>(578)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-5">
									<label for="brand-5">
										<span></span>
										LG
										<small>(125)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-6">
									<label for="brand-6">
										<span></span>
										SONY
										<small>(755)</small>
									</label>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Top selling</h3>
							<div class="product-widget">
								<div class="product-img">
									{{-- <img src="./img/product01.png" alt=""> --}}
									<img src="{{ asset('img/product01.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>

							<div class="product-widget">
								<div class="product-img">
									{{-- <img src="./img/product02.png" alt=""> --}}
									<img src="{{ asset('img/product02.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>

							<div class="product-widget">
								<div class="product-img">
									{{-- <img src="./img/product03.png" alt=""> --}}
									<img src="{{ asset('img/product03.png') }}" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sort By:
									<select class="input-select">
										<option value="0">Popular</option>
										<option value="1">Position</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row">
							<!-- product -->
                            @foreach ($products as $product)
                                <div class="col-md-4 col-xs-6">
                                    <a href="{{ route('products.prod', $product->id) }}">
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
                                            <p class="product-category">{{ $product->category }}</p>
                                            <h3 class="product-name"><a href="#">{{ $product->name }}</a></h3>
                                            <h4 class="product-price">${{ $product->price }} <del class="product-old-price">${{ $product->old_price }}</del></h4>
                                            <div class="product-rating">
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($product->rating > $i)
                                                        <i class="fa fa-star"></i>
                                                    @else
                                                        <i class="fa fa-star-o"></i>
                                                    @endif
                                                @endfor
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
						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty">Showing 20-100 products</span>
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

        @include('components.footer')

        <script>

            $(document).ready(function() {
                $('.add-to-cart-btn').click(function() {
                    var productId = $(this).data('id');

                    $.ajax({
                        url: '/add-to-cart',
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            productId: productId
                        },
                        success: function(response) {
                            // Update the cart data on success.
                            updateCart(response);
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                });
            });


            function updateCart(cartData) {
                $('.cart-list').empty();
                let totalItems = 0;
                let subtotal = 0;

                for (var id in cartData) {
                    let product = cartData[id];
                    let totalProductPrice = product.price * product.quantity;

                    $('.cart-list').append(
                        `<div class="product-widget">
                <div class="product-img">
                   <img src="./img/${product.image}" alt="">
                </div>
                <div class="product-body">
                    <h3 class="product-name"><a href="#">${product.name}</a></h3>
                    <h4 class="product-price"><span class="qty">${product.quantity}x</span>$${totalProductPrice.toFixed(2)}</h4>
                </div>
                <button class="delete" data-id="${id}"><i class="fa fa-close"></i></button>
            </div>`
                    );

                    totalItems += product.quantity;
                    subtotal += totalProductPrice;
                }

                $('.qty').text(totalItems);
                $('.cart-summary small').text(totalItems + ' Item(s) selected');
                $('.cart-summary h5').text('SUBTOTAL: $' + subtotal.toFixed(2));

                // Refresh event listeners for delete buttons
                $('.delete').click(function() {
                    let productId = $(this).data('id');

                    $.ajax({
                        url: '/cart/remove/' + productId,
                        type: 'GET',
                        success: function(response) {
                            // Update the cart data on success.
                            updateCart(response);
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                });
            }

            //update cart on page load
            $(document).ready(function() {
                $.ajax({
                    url: '/cartData', // replace this with the URL that returns your cart data in JSON format
                    type: 'GET',
                    success: function(response) {
                        // update the cart UI with the data received from server
                        updateCart(response);
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });


        </script>


	</body>
</html>
