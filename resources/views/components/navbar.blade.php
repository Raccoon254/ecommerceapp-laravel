@include('components.topheader')
@include('components.middleheader')
@include('components.lowerheader')
<script src="https://kit.fontawesome.com/af6aba113a.js" crossorigin="anonymous"></script>
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
            let assetPath = "{{ asset('img') }}";
            let product = cartData[id];
            let totalProductPrice = product.price * product.quantity;

            $('.cart-list').append(
                `<div class="product-widget">
                <div class="product-img">
                   <img src="${assetPath}/${product.image}" alt="">
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
