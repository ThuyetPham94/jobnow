<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		
		<div class="container-fuild">
			<div class="form-login">
				<div class="logo">
					<img src="{!! Asset('frontend/images/icon/logo_popup.png') !!}">
				</div>
				<form action="{!! route('public.company.postRegister') !!}" method="POST" role="form">
					{!! Form::hidden('_token', csrf_token()) !!}
					<div class="form-group">
						<label for="">Email</label>
						<input type="text" class="form-control" id="" placeholder="Email" name="Email">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" class="form-control" id="" placeholder="Password" name="Password">
					</div>
					<div class="form-group">
						<label for="">Name Company</label>
						<input type="text" class="form-control" id="" placeholder="Name Company" name="Name">
					</div>
					<div class="form-group">
						<label for="">Company Size</label>
						<select class="form-control" name="CompanySizeID">
							@foreach($companySize as $size)
								<option value="{!! $size->id !!}">{!! $size->Name !!}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="">Address</label>
						<input type="text" class="form-control" id="" placeholder="Address" name="Address">
					</div>
					<div class="form-group">
						<label for="">Contact Number</label>
						<input type="text" class="form-control" id="" placeholder="Contact Number" name="ContactNumber">
					</div>
					<div class="form-group">
						<label for="">Contact Name</label>
						<input type="test" class="form-control" id="" placeholder="Contact Name" name="ContactName">
					</div>
					<div>
						
						<button type="submit" class="btn btn-primary pull-right">Register</button>
					</div>
					
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
		<style type="text/css">
			.over{
				margin: 0 -20px;
			}
			.border{
				padding: 20px 20px 0;
				margin-top: 10px;
				border-top: 1px solid #ccc;
				text-align: center;
			}
			.border p{
				margin-bottom: 0;
			}
			input[type=checkbox].css-checkbox:checked + label.css-label {
				background-image: url('/public/frontend/images/icon/is_check.png');
			}
			.css-checkbox{
				display: none;
			}
			input[type=checkbox].css-checkbox + label.css-label {
				padding-left: 25px;
				height: 15px;
				display: inline-block;
				line-height: 15px;
				background-repeat: no-repeat;
				background-position: 0 0;
				font-size: 15px;
				vertical-align: middle;
				cursor: pointer;
				background-image: url('/public/frontend/images/icon/not_check.png');
			}
			body {
				background: #f4f4f4;
			}
			.container-fuild{
				padding: 100px 0;
			}
			.form-login{
				max-width: 400px;
				margin: auto;
				padding: 20px;
				border: 1px solid #ccc;
				background: #fff;
				border-top: 3px solid #4d7496;
			}
			.logo{
				text-align: center;
				margin-bottom: 10px;
			}
			.form-control{
				height: 38px;
				border-radius: 0;
			}
			.btn{
				border-radius: 0;
				padding: 6px 20px;
				background: #3968c6;
			}
		</style>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	</body>
</html>