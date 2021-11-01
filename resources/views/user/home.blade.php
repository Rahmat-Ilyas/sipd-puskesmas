@extends('user.layout')
@section('content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                      
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container">

			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<div class="text-center">
							<h2 style="margin-bottom: -8px;"><b>DINAS KESEHATAN</b></h2>
							<h3 style="margin-bottom: -8px;"><b>UPT PUSKESMAS BONTONOMPO II</b></h3>
							<h5 style="margin-bottom: -8px; margin-bottom: 10px;"><i>JLN. BONTOCARADDE, Tamallayang,  Bontonompo, Sulawesi Selatan, South Sulawesi 92153</i></h5>
						</div>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="row">
						<div class="col-sm-6">
							<div class="widget-panel widget-style-2 bg-white">
								<i class="fa fa-user-md text-primary"></i>
								<h2 class="m-0 text-dark counter font-600">30</h2>
								<div class="text-muted m-t-5">Kunjunag Bulan Ini</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="widget-panel widget-style-2 bg-white">
								<i class="fa fa-wheelchair text-pink"></i>
								<h2 class="m-0 text-dark counter font-600">210</h2>
								<div class="text-muted m-t-5">Total Kunjungan</div>
							</div>
						</div>
					</div>
					<div class="card-box">
						<h4 class="text-center">Assalamualikum, {{ Auth::user()->nama }}</h4>
						<h2 class="text-center">Selamat Datang di Halaman Pasien UPT Puskesmas Bontonompo II</h2>
						<div class="text-center m-t-20">
							<a href="{{ url('user/antrian') }}" class="btn btn-default"><i class="fa fa-ticket"></i> Ambil Antrian</a>
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<div class="card-box">
						<div class="panel panel-color panel-inverse" style="border: solid 1px;">
							<div class="panel-heading text-center">
								<h3 class="panel-title" style="margin-bottom: -10px;">Kartu Pasien</h3>
								<h3 class="panel-title" style="margin-bottom: -5px;">PUSKESMAS BONTONOMPO II</h3>
								<span><i class="text-white">HP/WA: 081340180008</i></span>
							</div>
							<div class="panel-body p-0">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td width="150">No. Rekam Medik</td>
											<td>:</td>
											<td>{{ Auth::user()->no_rekam_medik }}</td>
										</tr>
										<tr>
											<td>Nama</td>
											<td>:</td>
											<td>{{ Auth::user()->nama }}</td>
										</tr>
										<tr>
											<td>Tanggal Lahir</td>
											<td>:</td>
											<td>{{ date('d-m-Y', strtotime(Auth::user()->tanggal_lahir)) }}</td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td>:</td>
											<td>{{ Auth::user()->alamat }}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="text-center" style="margin-top: -10px;">
							<button class="btn btn-sm btn-rounded btn-success"><i class="fa fa-download"></i> Download Kartu</button>
							<button class="btn btn-sm btn-rounded btn-primary"><i class="fa fa-print"></i> Cetak Kartu</button>
						</div>
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