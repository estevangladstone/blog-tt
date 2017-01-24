<html>
	<head>
		<title>@yield('title')</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		@yield('styles')
	</head>
	<body>
		<div class="container">
			@yield('content')
		</div>
		
		@yield('scripts')
	</body>
</html>





