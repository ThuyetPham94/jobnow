<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>JobNow
			@if(isset($title))
			{!! $title !!}
			@endif
		</title>
                <meta name="google-site-verification" content="ddeLe0t6sXWUStHk_0-iPNknoDQFwtEAvtV-I3oHdc8" />
		<!-- Bootstrap CSS -->
		@section('style')
			@include('frontend.includes.style')
		@show
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="wrapper">
			<div class="header">
				@section('header')
					@include('frontend.includes.header')
				@show
			</div><!-- end .header -->

			<div class="main">
				@yield('content')
			</div>

			<div class="footer">
				<div class="container">
					@section('footer')
						@include('frontend.includes.footer')
					@show
				</div>
				
			</div>
			<div class="bot-foo">
				<div class="container text-center">
					<p><span>&copy; Copyright 2017 JobNow</span></p>
				</div>
			</div>
		</div><!-- end wrapper -->
			

		<!-- jQuery -->
		@section('javascript')
			@include('frontend.includes.javascript')
		@show
		
	</body>
</html>