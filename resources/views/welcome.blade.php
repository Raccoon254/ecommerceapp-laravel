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
                            <!-- Category Filter -->
                            <div class="checkbox-filter">
                                <ul>
                                    @foreach($categories as $category)
                                        <li>
                                            <input type="checkbox" id="category-{{ $category->id }}" class="category-checkbox" data-category="{{ $category->category }}">
                                            <label for="category-{{ $category->id }}">
                                                <span></span>
                                                {{ $category->category }}
                                                <small>({{ $category->total }})</small>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <button id="apply-filter">Apply</button>
                            <!-- /Category Filter -->
                        </div>
                        <!-- /aside Widget -->

                        <!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
                                    <label for="price-min"></label><input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
                                    <label for="price-max"></label><input id="price-max" type="number">
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
                            <div id="product-list">
                                @include('product-list-partial', ['products' => $products])
                            </div>
						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
                            <span class="store-qty">Showing {{ sizeof($products) }} products</span>
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
    $('.input-number').each(function() {
        var $this = $(this),
            $input = $this.find('input[type="number"]'),
            up = $this.find('.qty-up'),
            down = $this.find('.qty-down');

        down.on('click', function () {
            var value = parseInt($input.val()) - 1;
            value = value < 1 ? 1 : value;
            $input.val(value);
            $input.change();
            updatePriceSlider($this , value)
        })

        up.on('click', function () {
            var value = parseInt($input.val()) + 1;
            $input.val(value);
            $input.change();
            updatePriceSlider($this , value)
        })
    });

    var priceInputMax = document.getElementById('price-max'),
        priceInputMin = document.getElementById('price-min');

    //if price inputs are not null
    if(priceInputMax && priceInputMin){
        priceInputMax.addEventListener('change', function(){
            updatePriceSlider($(this).parent() , this.value)
        });

        priceInputMin.addEventListener('change', function(){
            updatePriceSlider($(this).parent() , this.value)
        });
    }

    function updatePriceSlider(elem , value) {
        if ( elem.hasClass('price-min') ) {
            //console.log('min')
            //fetchProducts(priceInputMin.value, priceInputMax.value);
            priceSlider.noUiSlider.set([value, null]);
        } else if ( elem.hasClass('price-max')) {
            //console.log('max')
            //fetchProducts(priceInputMin.value, priceInputMax.value);
            priceSlider.noUiSlider.set([null, value]);
        }
    }

    // Price Slider
    var priceSlider = document.getElementById('price-slider');
    if (priceSlider) {
        noUiSlider.create(priceSlider, {
            start: [{{ $minPrice }}, {{ $maxPrice }}],
            connect: true,
            step: 1,
            range: {
                'min': {{ $minPrice }},
                'max': {{ $maxPrice }}
            }
        });

        priceSlider.noUiSlider.on('update', function(values, handle) {
            var value = values[handle];
            handle ? priceInputMax.value = value : priceInputMin.value = value

            // Fetch products within selected price range using AJAX
            fetchProducts(priceInputMin.value, priceInputMax.value);
        });

        function fetchProducts(minPrice, maxPrice) {
            $.ajax({
                url: "/fill",
                type: "GET",
                data: {
                    min_price: minPrice,
                    max_price: maxPrice
                },
                success: function(data) {
                    // Update product list on the page
                    // Replace '#product-list' with the actual id or class of your product list container
                    $('#product-list').html(data);
                }
            });
        }

    }
</script>
        <script>
            $(document).ready(function() {
                let selectedCategories = [];

                $('.category-checkbox').change(function() {
                    let category = $(this).data('category');
                    let isChecked = $(this).is(':checked');

                    if (isChecked) {
                        selectedCategories.push(category);
                    } else {
                        const index = selectedCategories.indexOf(category);
                        if (index > -1) {
                            selectedCategories.splice(index, 1);
                        }
                    }
                });

                $('#apply-filter').click(function() {
                    $.ajax({
                        type: 'GET',
                        url: '/products/filterByCategory',  // the route for filtering products
                        data: {
                            categories: selectedCategories
                        },
                        success: function(data) {
                            $('#product-list').html(data);
                        }
                    });
                });
            });
        </script>
    </body>
</html>
