<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <title>ticktrip - Registration</title>
</head>
<body>
  <section class="intro">
    <div class="bg-image h-100">
      <div class="mask d-flex align-items-center h-100" style="background-color: #f3f2f2;">
        <div class="container" style="max-height: 100vh;">
          <div class="row d-flex justify-content-center align-items-center ">
            <div class="col-12 col-lg-9 col-xl-8" >
              <div class="card" style="border-radius: 1rem;" >
                <div class="row g-0">
                  <div class="col-md-4 d-none d-md-block">
                    <img
                      src="{{ asset('images/sign up.png') }}"
                      alt="signup image"
                      class="img-fluid" style="border-top-left-radius: 1rem; border-bottom-left-radius: 1rem;height: 100%; width: 100%;"
                    />
                  </div>
                  <div class="col-md-8 d-flex align-items-center";>
                    <div class="card-body py-5 px-4 p-md-5" >
             
                        <form action="{{ route('register-user') }}" method="POST">
                            @csrf <!-- CSRF token for security -->
                            <h4 class="fw-bold mb-4" style="color: #6610F2;">Sign in to your account</h4>
                            <p class="mb-4" style="color: #45526e;">To sign in, please fill in these text fields with your name, username, email address, and password.</p>
                        
                            <div class="form-outline mb-2">
                                <label class="form-label" for="firstname">First name</label>
                                <input type="text" id="firstname" name="firstname" class="form-control" value="{{ old('firstname') }}" />
                                @error('firstname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="form-outline mb-2">
                                <label class="form-label" for="lastname">Last name</label>
                                <input type="text" id="lastname" name="lastname" class="form-control" value="{{ old('lastname') }}" />
                                @error('lastname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="form-outline mb-2">
                                <label class="form-label" for="matricule">Matricule</label>
                                <input type="text" id="matricule" name="matricule" class="form-control" value="{{ old('matricule') }}" />
                                @error('matricule')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="form-outline mb-2">
                                <label class="form-label" for="email">Email address</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" />
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="form-outline mb-2">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" />
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="form-outline mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" />
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="d-flex justify-content-end pt-3 mb-10">
                                <button class="btn btn-primary btn-rounded" type="submit" style="background-color: #6610F2;">Sign in</button>
                            </div>
                            <hr>
                            <a class="link float-end" href="login.html">Already have an account? Click here to log in.</a>
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