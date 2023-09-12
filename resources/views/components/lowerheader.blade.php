<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                @foreach($categories->take(10) as $category)
                        <?php $firstName = $category->name ?>
                    <li>
                        <a href="#" class="category-link text-sm" data-category-id="{{ $category->id }}">{{ $firstName }}</a>
                    </li>
                @endforeach
            </ul>
            <!-- /NAV -->

        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.category-link').on('click', function(e){
            e.preventDefault();

            // get the category id from the data attribute
            var categoryId = $(this).data('category-id');

            $.ajax({
                url: '/category/' + categoryId + '/products',
                method: 'GET',
                success: function(data){
                    $('#product-list').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });
</script>

