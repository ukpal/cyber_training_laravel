<!doctype html>
<html lang="en">
	<head>
		@include('backend.includes.login_header')
	</head>
	<body>
		
        <!-- Page Content -->

        @yield('content')

        <!-- /#page-content -->

		{!!flash_message()!!}
	</body>
	@include('backend.includes.login_footer')
</html>