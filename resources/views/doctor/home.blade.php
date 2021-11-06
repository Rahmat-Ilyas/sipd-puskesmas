@extends('doctor.layout')
@section('content')
@php
$poli = new App\Models\Poli;
$dokter_id = Auth::user()->id;
$nama_poli = $poli->where('dokter_id', $dokter_id)->first();
$nama_poli = $nama_poli ? $nama_poli->nama_poli : 'Selamat Datang';
@endphp
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                      
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container">

			<!-- Page-Title -->
			<div class="row">
				<div class="col-sm-12">
					<h4 class="page-title">Dashboard</h4>
					<p class="text-muted page-title-alt">Selamat datang di halaman dashboard UPT Puskesmas Bontonompo II</p>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6 col-sm-6">
					<div class="widget-panel widget-style-2 bg-white">

						<h2 class="m-0 text-dark counter font-600">{{ $nama_poli }}</h2>
						<div class="text-muted m-t-5">{{ Auth::user()->nama }}</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="widget-panel widget-style-2 bg-white">
						<i class="fa fa-wheelchair text-pink"></i>
						<h2 class="m-0 text-dark counter font-600">210</h2>
						<div class="text-muted m-t-5">Pasien Bulan Ini</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="widget-panel widget-style-2 bg-white">
						<i class="fa fa-users text-info"></i>
						<h2 class="m-0 text-dark counter font-600">18</h2>
						<div class="text-muted m-t-5">Total Pasien</div>
					</div>
				</div>
			</div>
		</div> <!-- container -->

	</div> <!-- content -->

	<footer class="footer text-right">
		© {{ date('Y') }}. All rights reserved.
	</footer>

</div>


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->	
@endsection