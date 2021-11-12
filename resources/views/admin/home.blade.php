@extends('admin.layout')
@section('content')
@php
$dokter = new App\Models\Doctor;
$pasien = new App\Models\User;
$antrian = new App\Models\Antrian;
$pemeriksaan = new App\Models\Pemeriksaan;
$pemeriksaan = $pemeriksaan->whereMonth('created_at', date('m'))->groupBy('user_id')->get(['user_id']);
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
				<div class="col-lg-3 col-sm-6">
					<div class="widget-panel widget-style-2 bg-white">
						<i class="fa fa-sort-numeric-asc text-primary"></i>
						<h2 class="m-0 text-dark counter font-600">{{ count($antrian->whereDate('created_at', date('Y-m-d'))->get()) }}</h2>
						<div class="text-muted m-t-5">Antrian Hari Ini</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="widget-panel widget-style-2 bg-white">
						<i class="fa fa-wheelchair text-pink"></i>
						<h2 class="m-0 text-dark counter font-600">{{ count($pemeriksaan) }}</h2>
						<div class="text-muted m-t-5">Pasien Bulan Ini</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="widget-panel widget-style-2 bg-white">
						<i class="fa fa-users text-info"></i>
						<h2 class="m-0 text-dark counter font-600">{{ count($pasien->all()) }}</h2>
						<div class="text-muted m-t-5">Pasien Terdaftar</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="widget-panel widget-style-2 bg-white">
						<i class="fa fa-user-md text-custom"></i>
						<h2 class="m-0 text-dark counter font-600">{{ count($dokter->all()) }}</h2>
						<div class="text-muted m-t-5">Jumlah Dokter</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<div class="text-center">
                            <h2 style="margin-bottom: -8px;"><b>DINAS KESEHATAN</b></h2>
                            <h3 style="margin-bottom: -8px;"><b>UPT PUSKESMAS BONTONOMPO II</b></h3>
                            <h5 style="margin-bottom: -8px;"><i>JLN. BONTOCARADDE, Tamallayang,  Bontonompo, Sulawesi Selatan, South Sulawesi 92153</i></h5>
                        </div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="card-box p-0 border shadow">
						<img src="{{ asset('assets/images/puskesmas.jpg') }}" style="width: 100%; height: 380px;">
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