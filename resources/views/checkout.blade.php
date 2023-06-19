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
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Checkout</li>
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

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="first-name" placeholder="First Name">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="last-name" placeholder="Last Name">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" placeholder="Telephone">
							</div>
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="create-account">
									<label for="create-account">
										<span></span>
										Create Account?
									</label>
									<div class="caption">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
										<input class="input" type="password" name="password" placeholder="Enter Your Password">
									</div>
								</div>
							</div>
						</div>
						<!-- /Billing Details -->

						<!-- Shiping Details -->
						<div class="shiping-details">
							<div class="section-title">
								<h3 class="title">Shiping address</h3>
							</div>
							<div class="input-checkbox">
								<input type="checkbox" id="shiping-address">
								<label for="shiping-address">
									<span></span>
									Ship to a diffrent address?
								</label>
								<div class="caption">
									<div class="form-group">
										<input class="input" type="text" name="first-name" placeholder="First Name">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="last-name" placeholder="Last Name">
									</div>
									<div class="form-group">
										<input class="input" type="email" name="email" placeholder="Email">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="address" placeholder="Address">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="city" placeholder="City">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="country" placeholder="Country">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
									</div>
									<div class="form-group">
										<input class="input" type="tel" name="tel" placeholder="Telephone">
									</div>
								</div>
							</div>
						</div>
						<!-- /Shiping Details -->

						<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" placeholder="Order Notes"></textarea>
						</div>
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
								<div class="order-col">
									<div>1x Product Name Goes Here</div>
									<div>$980.00</div>
								</div>
								<div class="order-col">
									<div>2x Product Name Goes Here</div>
									<div>$980.00</div>
								</div>
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">$2940.00</strong></div>
							</div>
						</div>
                        <div class="payment-method">
                            <h3>Payment Method</h3>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-1">
                                <label for="payment-1">
                                    <span></span>
                                    <i class="fa fa-university"></i> Direct Bank Transfer
                                </label>
                                <div class="caption">
                                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-2">
                                <label for="payment-2">
                                    <span></span>
                                    <i class="fa fa-money"></i> Cheque Payment
                                </label>
                                <div class="caption">
                                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-3">
                                <label for="payment-3">
                                    <span></span>
                                    <i class="fa fa-paypal"></i> Paypal System
                                </label>
                                <div class="caption">
                                    <p>Pay via PayPal; you can pay with your credit card if you don't have a PayPal account.</p>
                                </div>
                            </div>
                        </div>

                        <div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<a href="#" class="primary-btn order-submit">Place order</a>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

        @include('components.footer')

		<!-- jQuery Plugins -->

    <script>
        function updateOrderDetails(cartData) {
            $('.order-products').empty();
            let totalAmount = 0;

            for (var id in cartData) {
                let product = cartData[id];
                let totalProductPrice = product.price * product.quantity;

                $('.order-products').append(
                    `<div class="order-col">
                <div>${product.quantity}x ${product.name}</div>
                <div>$${totalProductPrice.toFixed(2)}</div>
            </div>`
                );

                totalAmount += totalProductPrice;
            }

            $('.order-total').text('$' + totalAmount.toFixed(2));
        }

        $(document).ready(function() {
            $.ajax({
                url: '/cartData',
                type: 'GET',
                success: function(response) {
                    // Update the order details on page load.
                    updateOrderDetails(response);
                },
                error: function(response) {
                    console.log(response);
                }
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
