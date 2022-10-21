@section('title', 'Login')
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
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                      </div>
                    </div>
                    <div class="col-md-8 ps-md-0">
                      <div class="auth-form-wrapper px-4 py-5">
                        <a href="#" class="noble-ui-logo d-block mb-2">Madjou <span>Web</span></a>
                        <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                        <form class="forms-sample" method="POST" action="{{ route('login') }}" >
                            @csrf
                        {{-- email address --}}
                          <div class="mb-3">
                            <label for="email" :value="__('Email')" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email"  name="email" :value="old('email')" required autofocus />
                          </div>

                        {{-- error alert email --}}
                            @error('email')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                                    </div>
                            @enderror
                        
                        {{-- Password --}}
                          <div class="mb-3">
                            <label for="password" :value="__('Password')" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password"
                                    name="password"
                                    required autocomplete="current-password" placeholder="Password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                          </div>

                        {{-- error alert password --}}
                        @error('password')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                                    </div>
                            @enderror
                          
                          <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="remember_me" />
                            <label class="form-check-label" for="authCheck">{{ __('Remember me') }} </label>
                          </div>
                          <div>
                            <x-primary-button class="btn btn-primary me-2 mb-2 mb-md-0 text-white">
                                {{ __('Log in') }}
                            </x-primary-button>
                          </div>
                          {{-- <a href="register.html" class="d-block mt-3 text-muted">Remember you're password!</a> --}}
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

</x-guest-layout>


