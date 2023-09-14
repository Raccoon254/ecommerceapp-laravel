<section>
    @foreach($categories as $category)
        <div class="input-checkbox">
            <input type="checkbox" id="category-{{ $category->id }}" class="category-checkbox" data-category-id="{{ $category->id }}">
            <label for="category-{{ $category->id }}">
                <span></span>
                {{ $category->name }}
                <small>({{ $category->products->count() }})</small>
            </label>
        </div>
    @endforeach

</section>
<style>
    @media (max-width: 768px) { /* Assuming 768px is the breakpoint for small screens */
        .input-checkbox {
            display: none;
        }
        .input-checkbox.active {
            display: block;
        }
    }

    /* hide nextButton on large screens */
    @media (min-width: 768px) {
        #nextButton {
            display: none;
        }
    }

</style>

<script>
    $(document).ready(function() {
        let currentStart = 0;
        const increment = 5;
        const totalCategories = $('.input-checkbox').length;

        function showCategories(start) {
            $('.input-checkbox').removeClass('active');
            for(let i = start; i < (start + increment); i++) {
                $('.input-checkbox').eq(i).addClass('active');
            }
        }

        showCategories(currentStart);

        $('#nextButton').click(function() {
            currentStart += increment;
            if (currentStart >= totalCategories) {
                currentStart = 0;
            }
            showCategories(currentStart);
        });

        //click #nextButton after 5 seconds
        setInterval(function() {
            $('#nextButton').click();
        }, 5000);
    });

</script>
