@extends('frontend.layouts.app')

@section('content')
<!-- Start Login Register Content -->
    <div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url({{ asset('frontend/images/bg/2.jpg') }}) no-repeat scroll center center / cover ;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="htc__login__register__wrap">
                        <!-- Start Single Content -->
                        <div id="login" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                            <form class="login" method="POST" action="{{ route('login') }}">
                                @csrf
                                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                                <input id="password" type="password" @error('password') is-invalid @enderror name="password" required autocomplete="current-password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                                <div class="tabs__checkbox">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                    @if (Route::has('password.request'))
                                        <span class="forget">
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        </span>
                                    @endif
                                </div>
                                <div class="footer_login">
                                    <div class="htc__login__btn">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                    <span class="guest_checkout"><a href="{{ route('checkout.guest') }}">Checkout as a guest</a></span>
                                </div>
                            </form>
                        </div>
                        <!-- End Single Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End Login Register Content -->
@endsection
