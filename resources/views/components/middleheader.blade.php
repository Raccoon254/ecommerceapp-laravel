<!-- MAIN HEADER -->
<div id="header">
    @php
        use Illuminate\Support\Facades\Auth
    @endphp
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class="col-md-3">
                <div class="header-logo">
                    <a href="{{ route("products.index") }}" class="logo">
                        <img src="{{ asset('img/logo.png') }}" alt="">
                    </a>
                </div>
            </div>
            <!-- /LOGO -->

            <!-- SEARCH BAR -->
            <div class="col-md-6">
                <div class="header-search">
                    <form class="flex" id="search-form" action="{{ route('products.search') }}" method="GET">
                        @csrf
                    <label>
                            <select class="input-select" name="category">
                                <option value="0">All Categories</option>
                                @foreach($categories as $category)
                                        <?php $firstName = explode(" ", $category->name)[0]; ?>
                                    <option value="{{ $category->id }}">{{ $firstName }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label>
                            <input style="border-radius: 0!important;" id="search-input" class="input header-w-full" name="search" placeholder="Search here">
                        </label>
                        <button type="submit" class="search-btn">Search</button>
                    </form>
                </div>
            </div>
            <!-- /SEARCH BAR -->

            <!-- ACCOUNT -->
            <div class="col-md-3 clearfix">
                <div class="header-ctn">
                    <!-- Wishlist -->
                    @if (Auth::check() && Auth::user()->isAdmin())
                    <div>
                        <a href="{{ route('manage.products') }}">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                            <span>Manage</span>
                        </a>
                    </div>
                    @else
                        <div>
                            <a href="#">
                                <i class="fa fa-heart-o"></i>
                                <span>Wishlist</span>
                                <div class="wish">0</div>
                            </a>
                        </div>
                    @endif
                    <!-- /Wishlist -->

                    <!-- Add Product -->
                    @if (Auth::check() && Auth::user()->isAdmin())
                        <div>
                            <a href="{{ route('add.prod') }}">
                                <i class="fa fa-plus-circle"></i>
                                <span>Add Prod</span>
                            </a>
                        </div>
                    @endif
                    <!-- /Add Product -->


                    <!-- Cart -->
                    <div class="dropdown">
                        <a class="dropdown-toggle r-cart" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Cart</span>
                            <div class="qty">0</div>
                        </a>
                        <div class="cart-dropdown">
                            <div class="cart-list">
                            </div>
                            <div class="cart-summary">
                                <small>0 Item(s) selected</small>
                                <h5>SUBTOTAL: $00.00</h5>
                            </div>
                            <div class="cart-btns">
                                <a class="pointer" href="{{ route('cart.index') }}">View Cart</a>
                                <a class="pointer" href="{{ route('checkout.index') }}">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /Cart -->

                    <!-- Menu Toogle -->
                    <div class="menu-toggle">
                        <a href="#">
                            <i class="fa fa-bars"></i>
                            <span>Menu</span>
                        </a>
                    </div>
                    <!-- /Menu Toogle -->
                </div>
            </div>
            <!-- /ACCOUNT -->
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</div>
<!-- /MAIN HEADER -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var delay = (function(){
            var timer = 0;
            return function(callback, ms){
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();

        // Function to perform AJAX request
        var doAjaxSearch = function() {
            $.ajax({
                url: $('#search-form').attr('action'),
                method: 'GET',
                data: $('#search-form').serialize(),
                success: function(data){
                    $('#product-list').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThrown);
                }
            });
        };

        // Search on input
        $('#search-input').on('input', function(e){
            e.preventDefault();

            delay(function(){
                doAjaxSearch();
            }, 100);
        });

        // Search on category change
        $('select[name="category"]').on('change', function(e) {
            e.preventDefault();

            doAjaxSearch();
        });

        // Search on form submit
        $('#search-form').on('submit', function(e) {
            e.preventDefault();

            doAjaxSearch();
        });
    });
</script>

