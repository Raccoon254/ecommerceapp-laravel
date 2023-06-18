<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
</head>
<body>
<h1>Create Product</h1>
<form action="/prod" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="category">Category:</label>
        <input type="text" id="category" name="category">
    </div>
    <div>
        <label for="price">Price:</label>
        <input type="text" id="price" name="price">
    </div>
    <div>
        <label for="old_price">Old Price:</label>
        <input type="text" id="old_price" name="old_price">
    </div>
    <div>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
    </div>
    <button type="submit">Add Product</button>
</form>
</body>
</html>
