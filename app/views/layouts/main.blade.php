<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="{{ URL::asset('') }} ?>" />
</head>
<body>
	<header>
		<h1>Data For Good — Calgary</h1>
	</header>
	
	 @yield('main')
	
	<script type="text/javascript" src="{{ URL::asset('js/d3.min.js') }}?m=<?// filemtime('public/js/tracker.js') ?>"></script>
</body>
</html>