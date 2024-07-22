@include('admin.partials.header')

<body>
  <nav class="navbar navbar-expand-xl">
    <div class="container h-100">
      <a class="navbar-brand" href="{{ route('admin.index') }}">
        <h1 class="tm-site-title mb-0">Product Admin</h1>
      </a>
      <button
        class="navbar-toggler ml-auto mr-0"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars tm-nav-icon"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto h-100">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.index') }}">
              <i class="fas fa-tachometer-alt"></i> Dashboard
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="far fa-file-alt"></i>
              <span> Reports <i class="fas fa-angle-down"></i> </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Daily Report</a>
              <a class="dropdown-item" href="#">Weekly Report</a>
              <a class="dropdown-item" href="#">Yearly Report</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.products') }}">
              <i class="fas fa-shopping-cart"></i> Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.accounts') }}">
              <i class="far fa-user"></i> Accounts
            </a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="fas fa-cog"></i>
              <span> Settings <i class="fas fa-angle-down"></i> </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Profile</a>
              <a class="dropdown-item" href="#">Billing</a>
              <a class="dropdown-item" href="#">Customize</a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link d-block" href="{{ route('admin.login') }}">
              Admin, <b>Logout</b>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container tm-mt-big tm-mb-big">
    <div class="row">
      <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
        <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
          <div class="row">
            <div class="col-12">
              <h2 class="tm-block-title d-inline-block">Add Product</h2>
            </div>
          </div>
          <div class="row tm-edit-product-row">
            <div class="col-xl-6 col-lg-6 col-md-12">
              
             

              <form action="{{ route('admin.add-product') }}" method="POST" class="tm-edit-product-form" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                  <label for="name">Product Name</label>
                  <input id="name" name="name" type="text" class="form-control validate" required>
                </div>
                <div class="form-group mb-3">
                  <label for="description">Description</label>
                  <textarea class="form-control validate" rows="3" name="description" required></textarea>
                </div>
                <div class="form-group mb-3">
                  <label for="category">Category</label>
                  <select class="custom-select tm-select-accounts" id="category" name="category_id" required>
                    <option selected disabled>Select category</option>
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="row">
                  <div class="form-group mb-3 col-xs-12 col-sm-6">
                    <label for="stock">Units In Stock</label>
                    <input id="stock" name="stock_quantity" type="number" class="form-control validate" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group mb-3 col-xs-12 col-sm-6">
                    <label for="price">Price (KSh)</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">KSh</span>
                      </div>
                      <input id="price" name="price" type="number" step="0.01" min="0" class="form-control validate" placeholder="Enter price in KSh" required>
                    </div>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <label for="fileInput">Product Image</label>
                  <input id="fileInput" type="file" name="image_url" accept="image/*" onchange="previewImage(event)" style="display:none;">
                  <input type="button" class="btn btn-primary" value="UPLOAD PRODUCT IMAGE" onclick="document.getElementById('fileInput').click();">
                  <div class="mt-3">
                    <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; height: auto; display: none;">
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block text-uppercase">Add Product Now</button>
                </div>
              </form>
              
              <script>
                function previewImage(event) {
                  var file = event.target.files[0];
                  var reader = new FileReader();
                  
                  reader.onload = function(e) {
                    var imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                  };
                  
                  if (file) {
                    reader.readAsDataURL(file);
                  }
                }
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="tm-footer row tm-mt-small">
    <div class="col-12 font-weight-light">
      <p class="text-center text-white mb-0 px-4 small">
        Copyright &copy; <b>2018</b> All rights reserved. 
        Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link"></a>
      </p>
    </div>
  </footer> 

  <script src="js/jquery-3.3.1.min.js"></script>
  <!-- https://jquery.com/download/ -->
  <script src="jquery-ui-datepicker/jquery-ui.min.js"></script>
  <!-- https://jqueryui.com/download/ -->
  <script src="js/bootstrap.min.js"></script>
  <!-- https://getbootstrap.com/ -->
  <script>
    $(function() {
      $("#expire_date").datepicker();
    });
  </script>
</body>
</html>
