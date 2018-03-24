<!DOCTYPE html>
<html>
<head>
	<title>JobNow Welcome !</title>
</head>
<body>
	<h3>Register success</h3>
	<p><strong>Email : </strong> {!! $user->Email !!} </p>
	<p><strong>Link login : </strong> <a href="{!! route('public.company.getLogin') !!}">{!! route('public.company.getLogin') !!}</a></p>
</body>
</html>
