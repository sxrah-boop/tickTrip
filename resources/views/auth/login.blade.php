<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <title>Login</title>
</head>

<body>
  <section class="intro">
    <div class="bg-image h-100">
      <div class="mask d-flex align-items-center h-100" style="background-color: #f3f2f2;">
        <div class="container">
          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-lg-9 col-xl-8">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="col-md-4 d-none d-md-block">
                    <img src="{{ asset('images/login.png') }}" alt="login form" class="img-fluid"
                      style="border-top-left-radius: 1rem; border-bottom-left-radius: 1rem;height: 100%;" />
                  </div>
                  <div class="col-md-8 d-flex align-items-center">
                    <div class="card-body py-5 px-4 p-md-5">

                      <form action="{{ route('login-user') }}" method="POST">
                        @csrf <!-- CSRF token for security -->
                        @if(Session::has('fail'))
                        <div class="alert alert-danger">
                          {{ Session::get('fail') }}
                        </div>
                        @endif
                        <h4 class="fw-bold mb-4" style="color: #6610F2;">Login to your account</h4>
                        <p class="mb-4">To login, please fill in these text fields with your e-mail address and
                          password.</p>

                        <div class="form-outline mb-4">
                          <label class="form-label" for="email">Email address</label>
                          <input type="email" id="email" name="email" class="form-control" />
                          <!--  validation/error messages -->
                          @error('email')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="form-outline mb-4">
                          <label class="form-label" for="password">Password</label>
                          <input type="password" id="password" name="password" class="form-control" />
                          <!--  validation/error messages  -->
                          @error('password')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="d-flex justify-content-end pt-1 mb-4">
                          <button class="btn btn-primary btn-rounded" type="submit"
                            style="background-color: #6610F2;">Login</button>
                        </div>
                        <hr>
                        <a class="link float-end" href="">Forgot password? Click here.</a>
                      </form>


                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>