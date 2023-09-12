<!DOCTYPE html>
<html lang="en">
@include('components.header')
<body>
<!-- HEADER -->
<header>

</header>
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
                    <li><a href="#">{{ $product->category->name }}</a></li>
                    <li class="active">{{$product->name}}</li>
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
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    <div class="product-preview">
                        @if (filter_var($product->image, FILTER_VALIDATE_URL))
                            <img class="rounded" src="{{ $product->image }}" alt="">
                        @else
                            <img class="rounded" src="{{ asset('img/' . $product->image) }}" alt="">
                        @endif
                    </div>
                    @foreach ($product->images as $image)
                        <div class="product-preview">
                            @if (filter_var($image->filename, FILTER_VALIDATE_URL))
                                <img class="rounded" src="{{ $image->filename }}" alt="">
                            @else
                                <img class="rounded" src="{{ asset('img/' . $image->filename) }}" alt="">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs">
                    <div class="product-preview">
                        @if (filter_var($product->image, FILTER_VALIDATE_URL))
                            <img src="{{ $product->image }}" alt="">
                        @else
                            <img src="{{ asset('img/' . $product->image) }}" alt="">
                        @endif
                    </div>
                    @foreach ($product->images as $image)
                        <div class="product-preview">
                            @if (filter_var($image->filename, FILTER_VALIDATE_URL))
                                <img src="{{ $image->filename }}" alt="">
                            @else
                                <img src="{{ asset('img/' . $image->filename) }}" alt="">
                            @endif
                        </div>
                    @endforeach

                </div>
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <div>
                        <div class="product-rating">
                            <form action="{{ route('ratings.store', $product) }}" method="POST">
                                @csrf
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="submit" name="rating" value="{{ $i }}" class="star rating-button"
                                            title="Rate this {{ $i }} out of 5 stars">
                                        @if($product->averageRating() >= $i)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    </button>
                                @endfor
                            </form>
                        </div>
                        <a class="review-link" href="{{ route('review.create',['product'=>$product]) }}">{{ $reviewCount
                }} Review(s) | Add your review</a>
                    </div>
                    <div>
                        <h3 class="product-price">${{ $product->price }}
                            <del class="product-old-price">${{ $product->old_price }}</del>
                        </h3>
                        <span class="product-available">In Stock</span>
                    </div>
                    <p>{{ $product->description }}</p>

                    <div class="product-options">
                        @if(isset($product->productData->size))
                            <label>
                                Size
                                <select class="input-select">
                                    <option value="0">{{ $product->productData->size }}</option>
                                </select>
                            </label>
                        @endif
                        @if(isset($product->productData->color))
                            <label>
                                Color
                                <select class="input-select">
                                    <option value="0">{{ $product->productData->color }}</option>
                                </select>
                            </label>
                        @endif
                    </div>

                    <div class="add-to-cart">
                        <div class="qty-label">
                            Qty
                            <div class="input-number">
                                <input type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                        <button class="add-to-cart-btn" data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i>
                            add to cart
                        </button>
                    </div>

                    <ul class="product-btns">
                        <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
                    </ul>

                    <ul class="product-links">
                        <li>Category:</li>
                        @if(isset($product->category))
                            <li><a href="#">{{ $product->category->name }}</a></li>
                        @endif
                    </ul>

                    <ul class="product-links">
                        <li>Share:</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                        <li><a data-toggle="tab" href="#tab2">Details</a></li>
                        <li><a data-toggle="tab" href="#tab3">Reviews ({{ $reviewCount }})</a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab1  -->

                        <!-- tab2  -->
                        <div id="tab2" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                            @if(isset($product->productData->size))
                                                <tr>
                                                    <td class="text-primary"><i class="fa fa-text-height"></i> Size</td>
                                                    <td>{{ $product->productData->size }}</td>
                                                </tr>
                                            @endif
                                            @if(isset($product->productData->color))
                                                <tr>
                                                    <td class="text-primary"><i class="fa fa-paint-brush"></i> Color</td>
                                                    <td>{{ $product->productData->color }}</td>
                                                </tr>
                                            @endif
                                            @if(isset($product->productData->car_model_name))
                                                <tr>
                                                    <td class="text-primary"><i class="fa fa-car"></i> Car Model Name</td>
                                                    <td>{{ $product->productData->car_model_name }}</td>
                                                </tr>
                                            @endif
                                            @if(isset($product->productData->weight))
                                                <tr>
                                                    <td class="text-primary"><i class="fa fa-balance-scale"></i> Weight</td>
                                                    <td>{{ $product->productData->weight }}</td>
                                                </tr>
                                            @endif
                                            @if(isset($product->productData->part_number))
                                                <tr>
                                                    <td class="text-primary"><i class="fa fa-hashtag"></i> Part Number</td>
                                                    <td>{{ $product->productData->part_number }}</td>
                                                </tr>
                                            @endif
                                            @if(isset($product->productData->manufacturer))
                                                <tr>
                                                    <td class="text-primary"><i class="fa fa-industry"></i> Manufacturer</td>
                                                    <td>{{ $product->productData->manufacturer }}</td>
                                                </tr>
                                            @endif
                                            @if(isset($product->productData->compatibility))
                                                <tr>
                                                    <td class="text-primary"><i class="fa fa-check-circle"></i> Compatibility</td>
                                                    <td>{{ $product->productData->compatibility }}</td>
                                                </tr>
                                            @endif
                                            @if(isset($product->productData->material))
                                                <tr>
                                                    <td class="text-primary"><i class="fa fa-cube"></i> Material</td>
                                                    <td>{{ $product->productData->material }}</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /tab2  -->


                        <!-- tab3  -->
                        <div id="tab3" class="tab-pane fade in">
                            <div class="row">
                                <!-- Rating -->
                                <div class="col-md-3">
                                    <div id="rating">
                                        <div class="rating-avg">
                                            <span>{{ $ratings->avg('rating') }}</span>
                                            <div class="rating-stars">
                                                @for ($i = 0; $i < 5; $i++)
                                                @if (floor($ratings->avg('rating')) - $i >= 1)
                                                <i class="fa fa-star"></i>
                                                @elseif ($ratings->avg('rating') - $i > 0)
                                                <i class="fa fa-star-half-o"></i>
                                                @else
                                                <i class="fa fa-star-o"></i>
                                                @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <!-- This is for displaying individual user ratings. Assuming the ratings are from 1 to 5-->
                                        <ul class="rating">
                                            @for ($i = 5; $i >= 1; $i--)
                                            <li>
                                                <div class="rating-stars">
                                                    @for ($j = 0; $j < $i; $j++)
                                                    <i class="fa fa-star"></i>
                                                    @endfor
                                                    @for ($j = $i; $j < 5; $j++)
                                                    <i class="fa fa-star-o"></i>
                                                    @endfor
                                                </div>
                                                <div class="rating-progress">
                                                    @php
                                                    // Calculate the percentage
                                                    $percentage = $ratings->count() > 0 ? ($ratings->where('rating',
                                                    $i)->count() / $ratings->count()) * 100 : 0;
                                                    @endphp
                                                    <div style="width: {{ $percentage }}%;"></div>
                                                </div>
                                                <span class="sum">{{ $ratings->where('rating', $i)->count() }}</span>
                                            </li>
                                            @endfor
                                        </ul>

                                    </div>
                                </div>
                                <!-- /Rating -->

                                <!-- Reviews -->
                                <div class="col-md-6">
                                    <div id="reviews">
                                        <ul class="reviews">
                                            @foreach($reviews as $review)
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">{{ $review->user->name }}</h5>
                                                    <p class="date">{{ $review->created_at }}</p>
                                                    <div class="review-rating custom">
                                                        @for($i = 1; $i <= 5; $i++)
                                                        <div>
                                                            @if($product->averageRating() >= $i)
                                                            <i class="fa fa-star"></i>
                                                            @else
                                                            <i class="fa fa-star-o"></i>
                                                            @endif
                                                        </div>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>{{ $review->review }}</p>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <!-- pagination would depend on the exact way you set up pagination in Laravel -->
                                        {{ $reviews->links() }}
                                    </div>
                                </div>
                                <!-- /Reviews -->

                                <!-- Review Form -->
                                <div class="col-md-3">
                                    <!-- Existing form -->
                                </div>
                                <!-- /Review Form -->
                            </div>
                        </div>
                        <!-- /tab3  -->


                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">Related Products</h3>
                </div>
            </div>

            @foreach ($sameCategoryProducts as $sameCategoryProduct)

            <div class="col-md-4 col-xs-6">
                <a href="{{ route('products.prod', ['id' => $sameCategoryProduct->id]) }}">
                    <div class="product">
                        <div class="product-img">
                            <img src="{{ filter_var($sameCategoryProduct->image, FILTER_VALIDATE_URL) ? $sameCategoryProduct->image : asset('img/' . $sameCategoryProduct->image) }}" alt="">

                            <div class="product-label">
                                @if($product->discount)
                                <span class="sale">-{{$sameCategoryProduct->discount}}%</span>
                                @endif
                                <!-- Checking if the product was created in the last 10 minutes -->
                                @if($sameCategoryProduct->created_at >= \Carbon\Carbon::now()->subMinutes(10))
                                <span class="new">NEW</span>
                                @endif
                            </div>
                        </div>
                        <div class="product-body">
                            <p class="product-category">{{ $sameCategoryProduct->category->name }}</p>
                            <h3 class="product-name"><a href="#">{{ $sameCategoryProduct->name }}</a></h3>
                            <h4 class="product-price">${{ $sameCategoryProduct->price }}
                                <del class="product-old-price">${{ $sameCategoryProduct->old_price }}</del>
                            </h4>
                            <div class="product-rating">
                                @for($i = 0; $i < 5; $i++)
                                @if($sameCategoryProduct->rating > $i)
                                <i class="fa fa-star"></i>
                                @else
                                <i class="fa fa-star-o"></i>
                                @endif
                                @endfor
                            </div>
                            <div class="product-btns">
                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span>
                                </button>
                                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span>
                                </button>
                                <button class="quick-view"><i class="fa fa-eye"></i><span
                                        class="tooltipp">quick view</span></button>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <button class="add-to-cart-btn" data-id="{{ $sameCategoryProduct->id }}"><i
                                    class="fa fa-shopping-cart"></i> add to cart
                            </button>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->

<!-- FOOTER -->
@include('components.footer')
<!-- /FOOTER -->
</body>
</html>
