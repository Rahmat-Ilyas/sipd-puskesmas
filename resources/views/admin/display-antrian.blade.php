<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
	<meta name="author" content="Coderthemes">

	<link rel="shortcut icon" href="{{ asset('assets/images/favicon_1.ico') }}">

	<title>Antrian UPT Puskesma Bontonompo II</title>

	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />

	<script src="{{ asset('assets/js/modernizr.min.js') }}"></script>

</head>
<body>

	<div class="account-pages"></div>
	<div class="clearfix"></div>
	<div class="wrapper-page">
		<div class=" card-box">

			<div class="panel-body">


			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 text-center">
				<p>
					Not Chadengle?<a href="page-login.html" class="text-primary m-l-5"><b>Sign In</b></a>
				</p>
			</div>
		</div>

	</div>

	<script>
		var resizefunc = [];
	</script>

	<!-- jQuery  -->
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/detect.js') }}"></script>
	<script src="{{ asset('assets/js/fastclick.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
	<script src="{{ asset('assets/js/waves.js') }}"></script>
	<script src="{{ asset('assets/js/wow.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>


	<script src="{{ asset('assets/js/jquery.core.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.app.js') }}"></script>

	<script src="{{ asset('assets/plugins/notifyjs/js/notify.js') }}"></script>
	<script src="{{ asset('assets/plugins/notifications/notify-metro.js') }}"></script>
	<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

	<script>
		$(document).ready(function() {
			var url = "{{ url('doctor/config') }}";
			var headers = {
				"Accept": "application/json",
				"X-CSRF-TOKEN" : "{{ csrf_token() }}"
			}

			// Initiate the Pusher JS library
			Pusher.logToConsole = true;
			var pusher = new Pusher('a5bf0a9f7538a3e6a68f', {
				cluster: 'ap1',
				encrypted: true
			});

			var channel = pusher.subscribe('panggil-antrian');
			channel.bind('panggil-antrian', function(data) {
				console.log(data);
			});
		});
	</script>

</body>
</html>