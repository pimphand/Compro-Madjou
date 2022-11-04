@section('title', 'Register account')
<x-guest-layout>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">
    
                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">
                <div class="col-md-4 pe-md-0">
                  <div class="auth-side-wrapper">
    
                  </div>
                </div>
                <div class="col-md-8 ps-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo d-block mb-2">Madjou <span>Web</span></a>
                    <h5 class="text-muted fw-normal mb-4">Create you're account.</h5>
                    <form class="forms-sample" method="POST" action="{{ route('register') }}">
                        @csrf
    
                      <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label" >Name </label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" :value="old('name')" required autofocus>
                      </div>
    
                        @error('name')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                            </div>
                        @enderror
    
                      <div class="mb-3">
                        <label for="userEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" :value="old('email')" requirerd>
                      </div>
    
                        @error('email')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                            </div>
                        @enderror
    
                      <div class="mb-3">
                        <label for="userPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="new-password">
                      </div>
    
                        @error('password')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                            </div>
                        @enderror
    
                      <div class="mb-3">
                        <label for="userPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                      </div>
                      
                        @error('password_confirmation')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                            </div>
                        @enderror
    
                      <div>
                        <button class="btn btn-primary text-white me-2 mb-2 mb-md-0">Sign up</button>
                      </div>
                      
                      <a href="{{ route('login') }}" class="d-block mt-3 text-muted">Already a user? Sign in</a>
                    </form>
                  </div>
                </div>
              </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
</x-guest-layout>



