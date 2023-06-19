<!DOCTYPE html>
<html lang="">
@include('components.header')
@include('components.navbar')
<body>

<div class="container mt-5">
    <h1 class="text-center">Create Product</h1>
    <div class="card">
        <div class="card-body">
            <form action="/prod" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="category">Category:</label>
                        <input type="text" id="category" name="category" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 form-group">
                        <label for="price">Price:</label>
                        <input type="text" id="price" name="price" class="form-control">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="old_price">Old Price:</label>
                        <input type="text" id="old_price" name="old_price" class="form-control">
                    </div>
                </div>

                <div class="row" style="display: flex; align-items: flex-start;">
                    <div class="col-lg-6 form-group">
                        <label for="images">Images:</label>
                        <div class="" style="display: flex; height: 34px; border: 1px solid #211f1f; border-radius: 4px;">
                            <input type="file" id="images" name="images[]" multiple style="display: none;">
                            <label for="images" style="display: flex; align-items: center; padding-right: 5px;
                             padding-left:5px; border: 1px solid #ccc; border-radius: 4px; cursor: pointer; height: 100%;">Choose Files</label>
                            <span id="selected-files" style="margin-left: 10px; color: #211f1f; height: 100%; display: flex; align-items: center;"></span>
                        </div>

                        <script>
                            const fileInput = document.getElementById('images');
                            const selectedFiles = document.getElementById('selected-files');

                            fileInput.addEventListener('change', function() {
                                selectedFiles.textContent = '';
                                for (let i = 0; i < this.files.length; i++) {
                                    selectedFiles.textContent += this.files[i].name;
                                    if (i !== this.files.length - 1) {
                                        selectedFiles.textContent += ', ';
                                    }
                                }
                            });
                        </script>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="description" >Description:</label>
                        <textarea required id="description" name="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 form-group">
                        <label class="label"></label>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('components.footer')
</body>
</html>
