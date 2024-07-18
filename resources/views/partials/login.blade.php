@include('partials.navbar')
<section class="container-fluid py-5">
    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
      </li>
    </ul>
  
    <div class="tab-content">
      <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <form>
          <div class="d-grid gap-2 text-center mb-3">
            <button type="button" class="btn btn-link btn-floating"><i class="fab fa-facebook-f"></i></button>
            <button type="button" class="btn btn-link btn-floating"><i class="fab fa-google"></i></button>
            <button type="button" class="btn btn-link btn-floating"><i class="fab fa-twitter"></i></button>
            <button type="button" class="btn btn-link btn-floating"><i class="fab fa-github"></i></button>
          </div>
          <div class="mb-4">
            <input type="email" class="form-control" placeholder="Email or username">
            <input type="password" class="form-control mt-2" placeholder="Password">
          </div>
          <div class="d-flex justify-content-between mb-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked>
              <label class="form-check-label" for="loginCheck"> Remember me </label>
            </div>
            <a href="#">Forgot password?</a>
          </div>
          <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
          <div class="text-center">
            <p>Not a member? <a data-bs-toggle="pill" href="#pills-register">Register</a></p>
          </div>
        </form>
      </div>
      <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
        <form>
          <div class="d-grid gap-2 text-center mb-3">
            <button type="button" class="btn btn-link btn-floating"><i class="fab fa-facebook-f"></i></button>
            <button type="button" class="btn btn-link btn-floating"><i class="fab fa-google"></i></button>
            <button type="button" class="btn btn-link btn-floating"><i class="fab fa-twitter"></i></button>
            <button type="button" class="btn btn-link btn-floating"><i class="fab fa-github"></i></button>
          </div>
          <div class="mb-4">
            <input type="text" class="form-control" placeholder="Name">
            <input type="text" class="form-control mt-2" placeholder="Username">
            <input type="email" class="form-control mt-2" placeholder="Email">
            <input type="password" class="form-control mt-2" placeholder="Password">
            <input type="password" class="form-control mt-2" placeholder="Repeat password">
          </div>
          <div class="form-check d-flex justify-content-center mb-4">
            <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked>
            <label class="form-check-label" for="registerCheck">I have read and agree to the terms</label>
          </div>
          <button type="submit" class="btn btn-primary btn-block mb-3">Sign up</button>
        </form>
      </div>
    </div>
    @include('partials.footer')
