<!doctype html>
<html lang="en">
	<head>
		@include('backend.includes.header')
	</head>
	<body>
		@include('backend.includes.leftpanel')

		@include('backend.includes.headpanel')

	{{-- 	@include('backend.includes.rightpanel') --}}

		<div class="sl-mainpanel">

			<!-- Page Content -->

			@yield('content')

			<!-- /#page-content -->

			<footer class="sl-footer">
				<div class="footer-left">
				  <div class="mg-b-2">Society for Natural Language Technology Research under Department of information Technology & Electronics</div>
				  <div>Government of West Bengal</div>
				</div>
			</footer>
		</div>

		{!!flash_message()!!}
	</body>
	@include('backend.includes.footer')
</html>