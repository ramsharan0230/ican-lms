<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900" rel="stylesheet">
		<style type="text/css">
			body{
				font-family: 'Roboto', sans-serif;
				background: url({{ asset('assets/images/login_background.jpg') }}) repeat;
			}
			.logo_login{
				width:100%;
			}
			.new_login_wrapper{
				background:#f4f4f4;
				padding:20px;
				max-width:450px;
				margin:7% auto 0 auto;
				border-top:3px solid #20335e;
			}
			.new_login_wrapper a#forgot_password_login{
				text-decoration: none;
				position: relative;
				top: 8px;
				font-size: 16px;
			}
			.new_login_wrapper a#forgot_password_login:hover{
				color:blue;
				text-decoration: none;
			}
			.new_login_wrapper #register_button_login {
				margin-right: 10px;
			}
			.form_wrap{
				background: #eaeaea;
				padding:10px;
				margin-bottom:10px;
				border-top:1px solid #fff;
			}
			.new_login_wrapper h2{
				font-size: 26px;
				font-weight: 600;
				color: #20335e;
				margin-top: 0;
				margin-bottom: 22px;
			}
		</style>
	</head>
	<body>
		<img src="{{ asset('assets/images/login_banner.jpg')}}" class="img-responsive logo_login">
		<div class="new_login_wrapper">
			<h2>Welcome, Login LMS</h2>
			{!! Form::open(['route' => 'login.verify']) !!}
			{{ csrf_field() }}
			<div class="form_wrap">
				@include('flash-messages.partial_flash_alert_message')
				<div class="form-group">
					<label for="exampleInputEmail1">Email / Username</label>
					<input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				</div>
			</div>
			<!-- // form-wrap-->
			<a href="{{ route('password.email') }}" id="forgot_password_login">Forgot your password?</a>
			<button type="submit" class="btn btn-primary pull-right">Login</button>
			<a href="{{ route('auth.terms') }}" class="btn btn-success pull-right" id="register_button_login">Signup</a>
			<div class="clearfix"></div>
			{{ Form::close() }}
		</div>
		<script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
		<script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
	</body>
</html>