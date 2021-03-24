<!DOCTYPE html>
<html lang="en">
<head>
	@section('session','Capturer')
	@include('layouts.head') 
	<?php $allRequests=\App\User::all()??''; 
	$thisOwner=\App\Model\Capturer::where('id',Auth::user()->id)->get()??''; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini layout-fixed">
	<div class="wrapper">
		@include('capturer.layouts.header')
		@include('capturer.layouts.sidebar')

		<div class="content-wrapper">
			@yield('home')
			@yield('content')
				@yield('request')

				@yield('toilet.index')
				@yield('toilet.show')

				@yield('toiletuser.index')
				@yield('toiletuser.show')
			@yield('personal')
			@yield('rating')
			@yield('sale')
			@yield('feedback')
			@yield('report')

			@if(Session::has('toast.o'))
				<div id="toast" class="mx-auto container row justify-content-center">
					<div class="alert bg-dark text-white" id="toast-body">
						{{ Session::get('toast.o') }}
					</div>
				</div>
				<script>setTimeout(function() { $('#toast').fadeOut('slow'); }, 3500);</script>
			@endif

		</div>

		@include('layouts.footer')
	</div>
	@yield('jquery')
</body>
</html>