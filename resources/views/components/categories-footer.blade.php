@foreach($categories as $category)
    <?php $firstName = explode(" ", $category->name)[0]; ?>
    <li><a href="{{ route('category.show', $category->id) }}">{{ $firstName }}</a></li>
@endforeach
