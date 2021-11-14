@php
$poli = new App\Models\Poli;
$poli = $poli->where('status_layanan', 'Aktif')->get();
@endphp
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
<body style="background: url('{{ asset('assets/images/bggreen.png') }}'); background-position: center; background-repeat: cover; background-repeat: no-repeat; background-size: 100% 100%;">
	<div class="row m-b-10">
		<div class="col-sm-8">
			<div id="carousel-example-captions-1" data-ride="carousel" class="carousel slide">
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-captions-1" data-slide-to="0" class=""></li>
					<li data-target="#carousel-example-captions-1" data-slide-to="1" class="active"></li>
					<li data-target="#carousel-example-captions-1" data-slide-to="2" class=""></li>
				</ol>
				<div role="listbox" class="carousel-inner" style="height: 340px;">
					<div class="item">
						<img src="{{ asset('assets/images/big/bg1.jpg') }}" alt="First slide image" style="height: 100%; width: 100%;">
					</div>
					<div class="item active">
						<img src="{{ asset('assets/images/big/bg2.jpg') }}" alt="Second slide image" style="height: 100%; width: 100%;">
					</div>
					<div class="item">
						<img src="{{ asset('assets/images/big/bg3.jpg') }}" alt="Third slide image" style="height: 100%; width: 100%;">
					</div>
				</div>
			</div>
			<div class="bg-inverse" style="padding: 0.5px; ">
				<h4 class="text-white" style="text-transform: uppercase;">
					<marquee><b>SELAMAT DATANG DI UPT PUSKESMAS BONTONOMPO II, JLN. BONTOCARADDE, Tamallayang,  Bontonompo, Sulawesi Selatan, South Sulawesi 92153</b></marquee>
				</h4>
			</div>
		</div>
		<div class="col-md-4">
			<a href="#" id="btn-fullscreen" class="hovers btn waves-effect waves-light m-t-5" style="background: black; border-radius: 100px; color: #fff; padding-top: 10px; padding-bottom: 10px; opacity: 0.5; position: absolute; right: 0; margin-right: 10px;">
				<i class="icon-size-fullscreen" style="font-size: 20px;"></i>
			</a>
			<div class="card-box m-b-0 p-t-10" style="height: 340px; border-radius: 0px; background-image: linear-gradient(to bottom, #8FC93E, #105E7F);">
				<div class="row">
					<div class="col-sm-7">
						<div class="bg-inverse m-t-10" style="margin-left: -20px; padding: 5px;">
							<h5 class="text-white"><b>UPT PUSKESMAS BONTONOMPO II</b></h5>
						</div>
					</div>
					<div class="col-sm-5 text-center bg-inverse" style="opacity: 1; border: grey solid 2px; border-radius: 10px; padding-top: -10px;">
						<h1 class="m-b-0 m-t-0 text-white" id="showTime">{{ date('H.i.s') }}</h1>
						<b style="color: #EF7318;">{{ date('d F Y') }}</b>
					</div>
				</div>
				<hr>

				<h1 class="text-center text-white"><b>NOMOR ANTRIAN</b></h1>
				<h1 class="text-center" style="color: #EF7318; font-size: 70px; margin: 30px 30px;"><b id="no_antrian_display">A-000</b></h1>
				<h1 class="text-center text-white" style="text-transform: uppercase;"><b id="poli_display">POLI UMUM</b></h1>
			</div>
			<div class="bg-inverse" style="padding: 1px; height: 48px; color: #EF7318;">
				<div class="m-t-15 m-l-10">
					<i class="fa fa-volume-up fa-lg"></i> <sapn><i id="text_display">Tidak ada panggilan antrian</i></sapn>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			@foreach ($poli as $dta)
			<div class="col-lg-4">
				<div class="panel m-b-15 text-white" style="background-image: linear-gradient(to bottom, #8FC93E, #105E7F); height: 170px; border: 1px solid; border-radius: 0;">
					<div class="panel-body">
						<h3 style="text-transform: uppercase; font-size: 40px;" class="text-center text-white"><b>{{ $dta->nama_poli }}</b></h3>
						<hr>
						<div class="row" style="margin-top: -10px;">
							<div class="col-sm-6" style="border-right: 2px solid;">
								<h1 style="font-size: 60px; color: #EF7318;" class="text-center">
									<b id="antrian_dilayani{{ $dta->id }}">A-000</b>
								</h1>
							</div>
							<div class="col-sm-6" style="padding-top: 8px;">
								<span>Selanjutnya:</span> 
								<b id="antrian_selanjutnya{{ $dta->id }}">A-000</b>
								<hr style="margin: 5px;">
								<span>Sisa:</span> 
								<b id="sisa_antrian{{ $dta->id }}">0 Antrian</b>
							</div>				
						</div>
					</div>
				</div>
			</div>			
			@endforeach
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
	<script src="https://code.responsivevoice.org/responsivevoice.js?key=hmZQmkgc"></script>

	<script>
		$(document).ready(function() {
			var url = "{{ url('admin/config') }}";
			var headers = {
				"Accept": "application/json",
				"X-CSRF-TOKEN" : "{{ csrf_token() }}"
			}


			responsiveVoice.speak("", "Indonesian Female");
			panggilAntrian();
			getAntrian();
			function getAntrian() {
				$.ajax({
					url     : url,
					method  : "POST",
					headers : headers,
					data 	: { req: 'getAntrianDisplay' },
					success : function(data) {						
						$.each(data, function(key, val) {
							$('#antrian_selanjutnya'+val.poli_id).text(val.antrian_selanjutnya);
							$('#antrian_dilayani'+val.poli_id).text(val.antrian_dilayani);
							$('#sisa_antrian'+val.poli_id).text(val.sisa_antrian);
						});
					}
				});
			}

			if(document.addEventListener) {
				document.addEventListener('fullscreenchange', exitFullScreen, false);
			}
			function exitFullScreen() {
				if (document.fullscreenElement) $('#btn-fullscreen').hide();
				else $('#btn-fullscreen').show();
			}

			var time = setInterval(thisTime, 1000);
			function thisTime() {
				var getTime = new Date();
				var setTime = getTime.toLocaleTimeString();
				$('#showTime').html(setTime);
			}

			// Initiate the Pusher JS library
			Pusher.logToConsole = true;
			var pusher = new Pusher('a5bf0a9f7538a3e6a68f', {
				cluster: 'ap1',
				encrypted: true
			});

			var channel = pusher.subscribe('ambil-antrian');
			channel.bind('ambil-antrian', function(data) {
				getAntrian();
			});

			var channel = pusher.subscribe('panggil-antrian');
			channel.bind('panggil-antrian', function(data) {
				setData(data.antrian_id);
				panggilAntrian();
			});

			// Set Dat Antrian
			function setData(data) {
				var data_antrian = localStorage.getItem('data_antrian');
				data_antrian = $.parseJSON(data_antrian);
				if (data_antrian) {
					if (data_antrian.includes(data)) {
						$.ajax({
							url     : url,
							method  : "POST",
							headers : headers,
							data 	: { 
								req: 'cekAntrianDisplay',
								antrian_id: data
							}
						});
					} else data_antrian.push(data);
				} else data_antrian = [data];

				localStorage.setItem('data_antrian', JSON.stringify(data_antrian));
			}

			function delData(val) {
				var data_antrian = localStorage.getItem('data_antrian');
				data_antrian = $.parseJSON(data_antrian);
				var i = data_antrian.indexOf(val);
				if (i != -1) {
					data_antrian.splice(i, 1);
				}
				localStorage.removeItem('data_antrian');
				localStorage.setItem('data_antrian', JSON.stringify(data_antrian));
			}

			// Panggi Antrian
			function panggilAntrian() {
				var data_antrian = localStorage.getItem('data_antrian');
				data_antrian = $.parseJSON(data_antrian);

				if (data_antrian[0]) {
					var antrian_id = data_antrian[0];

					$.ajax({
						url     : url,
						method  : "POST",
						headers : headers,
						data 	: { 
							req: 'getAntrianCalling',
							antrian_id: antrian_id
						},
						success : function(data) {
							if(!responsiveVoice.isPlaying()) {
								responsiveVoice.speak(data.text_voice, "Indonesian Female", {
									pitch: 0.9, 
									rate: 0.9,
									volume: 1,
									onend: endCallback
								});

								$('#no_antrian_display').text(data.no_antrian);
								$('#poli_display').text(data.poli);
								$('#text_display').text(data.text_display);

								function endCallback() {
									delData(antrian_id);
									setTimeout(function() {
										panggilAntrian();
									}, 3000)
								}
							}
						}
					});
				}

			}
		});
	</script>

</body>
</html>