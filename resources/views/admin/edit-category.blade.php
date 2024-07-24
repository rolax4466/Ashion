<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Category</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <link rel="stylesheet" href="/Admin/css/fontawesome.min.css">
    <link rel="stylesheet" href="/Admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Admin/css/templatemo-style.css">
</head>
<body>
    @include('admin.partials.header')

    <div class="container tm-mt-big tm-mb-big">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.products') }}">
                        <i class="fas fa-chevron-left"></i> Back to Products
                    </a>
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="tm-block-title d-inline-block">Edit Category</h2>
                        </div>
                    </div>
                    <div class="row tm-edit-product-row">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <form action="{{ route('admin.edit-category', $category->id) }}" method="POST" class="tm-edit-product-form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-3">
                                    <label for="name">Category Name</label>
                                    <input id="name" name="name" type="text" value="{{ old('name', $category->name) }}" class="form-control validate" required />
                                </div>

                                <div class="form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control validate tm-small" rows="5" required>{{ old('description', $category->description) }}</textarea>
                                </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                            <div class="tm-product-img-edit mx-auto">
                                <!-- Display the existing image --><img src="{{ $category->image_url ? asset('storage/' . $category->image_url) : '' }}" alt="Category Image" class="img-fluid d-block mx-auto" style="width: 100%; max-width: 300px;">

                                <img src="{{ $category->image_url }}" alt="Category Image" class="img-fluid d-block mx-auto" style="width: 100%; max-width: 300px;">
                                <i class="fas fa-cloud-upload-alt tm-upload-icon" onclick="document.getElementById('fileInput').click();"></i>
                            </div>
                            <div class="custom-file mt-3 mb-3">
                                <input id="fileInput" name="image" type="file" style="display:none;" />
                                <input type="button" class="btn btn-primary btn-block mx-auto" value="CHANGE IMAGE NOW" onclick="document.getElementById('fileInput').click();" />
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block text-uppercase">Update Category</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
            <p class="text-center text-white mb-0 px-4 small">
                Copyright &copy; <b>2023</b> All rights reserved.
                Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
            </p>
        </div>
    </footer>

    <script src="/Admin/js/jquery-3.3.1.min.js"></script>
    <script src="/Admin/js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $("#expire_date").datepicker({
                defaultDate: "10/22/2020"
            });
        });
    </script>
</body>
</html>
