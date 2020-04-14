<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		@include('front.includes.head')

		@yield('head-content')
		
	</head>
	<body>
		@yield('body-content')
		
		@include('front.includes.header')

		@yield('mainContainer')
		
		@include('front.includes.footer')

	</body>
	@yield('footer')
</html>