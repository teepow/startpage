<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Start Page</title>

	
	<link href="{{ asset('/css/all.css') }}" rel="stylesheet">
	<link rel="icon" href="{{{ asset('star.png') }}}" type="image/png" sizes="16x16">
</head>
<body>
	@include('partials.nav')

	<div class="container">
		@yield('content')
	</div>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="/js/all.js"></script>
</body>
</html>