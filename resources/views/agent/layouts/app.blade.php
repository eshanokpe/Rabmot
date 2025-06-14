<!DOCTYPE html>

<html lang="en">

	<!-- Mirrored from codervent.com/syndash/demo/vertical/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Apr 2023 18:44:23 GMT -->

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<title>Rabmot - Vehicle License Agency</title>
		<!--favicon-->
		<link rel="icon" href="{{ asset('/assets/img/fav.png')}}" type="image/png" />
		<!-- Vector CSS -->
		<link href="{{ asset('/assets/dashboard/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
		<!--plugins-->
		<link href="{{ asset('/assets/dashboard/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
		<link href="{{ asset('/assets/dashboard/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
		<link href="{{ asset('/assets/dashboard/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
		<!-- loader-->
		<link href="{{ asset('/assets/dashboard/css/pace.min.css')}}" rel="stylesheet" />
		<script src="{{ asset('/assets/dashboard/js/pace.min.js')}}"></script>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('/assets/dashboard/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&amp;family=Roboto&amp;display=swap" />
		<!-- Icons CSS -->
		<link rel="stylesheet" href="{{ asset('/assets/dashboard/css/icons.css')}}" />
		<!-- App CSS -->
		<link rel="stylesheet" href="{{ asset('/assets/dashboard/css/app.css') }} " />
		<link rel="stylesheet" href="{{ asset('/assets/dashboard/css/dark-sidebar.css')}}" />
		<link rel="stylesheet" href="{{ asset('/assets/dashboard/css/dark-theme.css')}}" />
	</head>
	<body>
		<div class="wrapper">
			<!--sidebar-wrapper-->
			@include('agent.partials.sidebar');
			<!--end sidebar-wrapper-->
			<!--header-->
			@include('agent.partials.topnav');
			<!--end header--> 
			<main class="py-4">

				@yield('content')

			</main>
		</div>
		@include('agent.partials.footer');
	</body>

</html>