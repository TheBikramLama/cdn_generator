<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CDN Generator</title>
	<meta name="description" content="Generate Fast CDN from github to JSDelivr" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="apple-touch-icon" sizes="57x57" href="{{ url('/assets/icons/apple-icon-57x57.png') }}">
	<link rel="apple-touch-icon" sizes="60x60" href="{{ url('/assets/icons/apple-icon-60x60.png') }}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{ url('/assets/icons/apple-icon-72x72.png') }}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{ url('/assets/icons/apple-icon-76x76.png') }}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{ url('/assets/icons/apple-icon-114x114.png') }}">
	<link rel="apple-touch-icon" sizes="120x120" href="{{ url('/assets/icons/apple-icon-120x120.png') }}">
	<link rel="apple-touch-icon" sizes="144x144" href="{{ url('/assets/icons/apple-icon-144x144.png') }}">
	<link rel="apple-touch-icon" sizes="152x152" href="{{ url('/assets/icons/apple-icon-152x152.png') }}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ url('/assets/icons/apple-icon-180x180.png') }}">
	<link rel="icon" type="image/png" sizes="192x192"  href="{{ url('/assets/icons/android-icon-192x192.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ url('/assets/icons/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ url('/assets/icons/favicon-96x96.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ url('/assets/icons/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ url('/assets/icons/manifest.json') }}">
	<meta name="msapplication-TileColor" content="#d99457">
	<meta name="msapplication-TileImage" content="{{ url('/assets/icons/ms-icon-144x144.png') }}">
	<meta name="theme-color" content="#d99457">

	{{--
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	--}}
	@yield('css')
</head>
<body>
	<div class="container text-center">
		<div class="col-md-8 offset-md-2 mt-100">
			@yield('content')
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/TheBikramLama/blshare@master/dist/blShare.min.js"></script>
	@yield('javascript')
</body>
</html>