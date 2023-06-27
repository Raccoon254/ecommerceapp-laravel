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
                    <form>
                        <select class="input-select">
                            <option value="0">All Categories</option>
                            <option value="1">Category 01</option>
                            <option value="1">Category 02</option>
                        </select>
                        <input class="input" placeholder="Search here">
                        <button class="search-btn">Search</button>
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
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
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
                                <a href="#">View Cart</a>
                                <a href="../checkout">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
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
