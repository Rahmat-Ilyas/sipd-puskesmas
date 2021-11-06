@extends('doctor.layout')
@section('content')
@php
$poli = new App\Models\Poli;
$dokter_id = Auth::user()->id;
$poli = $poli->where('dokter_id', $dokter_id)->first();
@endphp
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->                      
<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="page-title">Antrian Pasien</h4>
					<ol class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li class="active">
							Antrian Pasien
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
						<h4 class="m-t-0 header-title"><b>Daftar Antrian Pasien ({{ $poli->nama_poli }})</b></h4>
						<hr class="m-b-10">
						<h2 class="m-b-20">{{ $poli->nama_poli }}</h2>
						<table id="datatable" class="table table-striped table-bordered" style="margin-top: 20px;">
							<thead>
								<tr>
									<th>No</th>
									<th>Waktu Ambil</th>
									<th>No. Antrian</th>
									<th>No. Rekam Medik</th>
									<th>Nama Pasien</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody id="data-antrian">
								<tr>
									<td>1</td>
									<td>24-10-2020 07:11</td>
									<td>A-001</td>
									<td>P000564</td>
									<td>Muhammad Aladin</td>
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
									<td>24-10-2020 07:25</td>
									<td>A-002</td>
									<td>P000565</td>
									<td>Maemunah</td>
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

@section('javascript')
<script>
	$(document).ready(function() {
		var url = "{{ url('doctor/config') }}";
		var headers = {
			"Accept": "application/json",
			"X-CSRF-TOKEN" : "{{ csrf_token() }}"
		}


		getAntrian();
		function getAntrian(poli_id) {
			var poli_id = "{{ $poli->id }}";
			$.ajax({
				url     : url,
				method  : "POST",
				headers : headers,
				data 	: { 
					req: 'getAntrian',
					poli_id: poli_id
				},
				success : function(data) {
					if (data) $('#data-antrian').html(data);
					else $('#datatable').dataTable().fnClearTable();
				}
			});
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
	});
</script>
@endsection