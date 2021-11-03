@extends('admin.layout')
@section('content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                      
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="page-title">Data Antrian Pasien</h4>
					<ol class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li class="active">
							Data Antrian Pasien
						</li>
					</ol>
				</div>
			</div>


			<div class="row">
				<div class="col-sm-12">
					<div class="card-box table-responsive">
						<h5 class="text-dark font-14 pull-right" style="padding-bottom: 20px;">
							<u class=" "><b>Tanggal Peayanan : </b> <i>{{ date('d-m-Y') }}</i></u>
						</h5>
						<h4 class="m-t-0 header-title"><b>Data Antrian Pasien</b></h4>
						<hr>
						<table id="datatable" class="table table-striped table-bordered" style="margin-top: 20px;">
							<thead>
								<tr>
									<th>No</th>
									<th>No. Kunjungan</th>
									<th>Waktu Antrian</th>
									<th>No. Antrian</th>
									<th>Nama Pasien</th>
									<th>Jenis Kelamin</th>
									<th>Poli Tujuan</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>18030302092P000564</td>
									<td>24-10-2020 07:11</td>
									<td>A-001</td>
									<td>Muhammad Aladin</td>
									<td>Laki-Laki</td>
									<td>Poli Umum</td>
									<td>
										<span class="badge badge-success">Baru</span>
									</td>
									<td width="80">
										<button class="btn btn-sm btn-rounded btn-block btn-success"><i class="fa fa-volume-up"></i> Panggil</button>
										<button class="btn btn-sm btn-rounded btn-block btn-danger"><i class="fa fa-arrow-circle-right"></i> Lewati</button>
									</td>
								</tr>
								<tr>
									<td>2</td>
									<td>18030302092P000565</td>
									<td>24-10-2020 07:25</td>
									<td>A-002</td>
									<td>Maemunah</td>
									<td>Perempuan</td>
									<td>Poli Umum</td>
									<td>
										<span class="badge badge-primary">Dipanggil</span>
									</td>
									<td width="80">
										<button class="btn btn-sm btn-rounded btn-block btn-success"><i class="fa fa-volume-up"></i> Panggil</button>
										<button class="btn btn-sm btn-rounded btn-block btn-danger"><i class="fa fa-arrow-circle-right"></i> Lewati</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer class="footer text-right">
		© {{ date('Y') }}. All rights reserved.
	</footer>

</div>


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->	
@endsection