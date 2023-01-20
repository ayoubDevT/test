<x-guest-layout>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-4 pr-md-0">
                                    <div class="auth-left-wrapper">
                                        <img src="assets\images\rue-chefchaouen.jpg" alt="image" style="height: 520px">
                                    </div>
                                </div>
                                <div class="col-md-8 pl-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <x-jet-authentication-card-logo />
                                        <x-jet-validation-errors class="mb-4" />

                                        @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                        @endif
                                        <h5 class="text-muted font-weight-normal mt-4 mb-3">Welcome back! Log in to your
                                            account.</h5>
                                        <form class="forms-sample" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ old('email') }}" id="exampleInputEmail1"
                                                    placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="exampleInputPassword1" autocomplete="current-password"
                                                    placeholder="Password">
                                            </div>
                                            <div class="form-check form-check-flat form-check-primary container">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="remember_me" class="flex items-center">
                                                            <x-jet-checkbox id="remember_me" name="remember" />
                                                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember
                                                                me') }}</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-6">
                                                        <x-jet-button class="ml-4 mr-0 btn btn-primary btn-icon-text">
                                                            {{ __('Log in') }}
                                                        </x-jet-button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="mt-3">
                                                @if (Route::has('password.request'))
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>

                                                @endif
                                            </div>
                                            
                                            <a href="register.html" class="d-block mt-3 text-muted">Not a user? Sign
                                                up</a>-->
                                            @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                            @endif
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