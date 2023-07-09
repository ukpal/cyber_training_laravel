<!doctype html>
<html lang="en">

	@include('frontend.includes.header')

	<!-- Page Content -->
	<div class="container" style="min-height:calc(100vh - 375px);">
		<div class="row">
			<div class="col-md-12">
				@yield('content')
			</div>
		</div>
	</div>
	<!-- /#page-content -->

	@include('frontend.includes.footer')
</html>
