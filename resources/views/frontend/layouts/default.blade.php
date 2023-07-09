<!doctype html>
<html lang="en">

	@include('frontend.includes.header')

	<!-- Page Content -->
	<div style="min-height:calc(100vh - 375px);">
		@yield('content')
	</div>
	<!-- /#page-content -->

	@include('frontend.includes.footer')
</html>
