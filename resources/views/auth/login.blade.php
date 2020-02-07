<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login - {{ config('app.name', 'Laravel') }}</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset('login_assets') }}/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets') }}/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets') }}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets') }}/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets') }}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets') }}/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets') }}/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('login_assets') }}/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{ asset('login_assets') }}/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="post" action="{{route('login')}}">
					@csrf
					<span class="login100-form-title">
						{{ __('Login') }}
					</span>
					@if(session()->has('login_error'))
            <div class="alert alert-success">
              {{ session()->get('login_error') }}
							@php
								session()->forget('login_error');
							@endphp
            </div>
          @endif
					<div class="wrap-input100 validate-input {{ $errors->has('identity') ? 'alert-validate' : '' }}" data-validate = "Username is Required">
						<input class="input100" type="text" value="{{ old('identity') }}" name="identity" placeholder="{{ __('Username') }}"  autofocus>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input {{ $errors->has('password') ? 'alert-validate' : '' }}" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="{{ __('Password') }}" >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							{{ __('Login') }}
						</button>
					</div>

					@if (Route::has('password.request'))
					<div class="text-center p-t-12">
						{{-- <span class="txt1">
							Forgot
						</span> --}}
						<a class="txt2" href="{{ route('password.request') }}">
							{{ __('Forgot Your Password?') }}
						</a>
					</div>
					@endif

					{{-- <div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div> --}}


				</form>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="{{ asset('login_assets') }}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_assets') }}/vendor/bootstrap/js/popper.js"></script>
	<script src="{{ asset('login_assets') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_assets') }}/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('login_assets') }}/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('login_assets') }}/js/main.js"></script>

</body>
</html>
