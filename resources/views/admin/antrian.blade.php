@extends('admin.layout')
@section('content')
@php
$poli = new App\Models\Poli;
$jadwal = new App\Models\Jadwal;
$get_antrian = new App\Models\Antrian;
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
					<h4 class="page-title">Daftar Antrian Pasien</h4>
					<ol class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li class="active">
							Daftar Antrian Pasien
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
						<h4 class="m-t-0 header-title"><b>Daftar Antrian Pasien</b></h4>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<div class="btn-group m-b-20">
									<button type="button" class="btn btn-default btn-rounded dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-plus-circle"></i> Tambah Antrian <span class="caret"></span></button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{ url('admin/ambil-antrian?type=new') }}">Pasien Baru</a></li>
										<li><a href="{{ url('admin/ambil-antrian') }}">Pasien Lama</a></li>
									</ul>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<b>Lihat Antrian Berdasarkan Poli:</b>
									<select class="form-control input-sm" id="chg_poli">
										<option value="all">Semua Poli</option>
										@foreach ($poli->where('status_layanan', 'Aktif')->get() as $pli)
										<option value="{{ $pli->id }}">{{ $pli->nama_poli }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<table id="datatable" class="table table-striped table-bordered" style="margin-top: 20px;">
							<thead>
								<tr>
									<th>No</th>
									<th>Waktu Ambil</th>
									<th>No. Antrian</th>
									<th>No. Rekam Medik</th>
									<th width="180">Nama</th>
									<th>Poli Tujuan</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody id="data-antrian">
								
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
		var url = "{{ url('admin/config') }}";
		var headers = {
			"Accept": "application/json",
			"X-CSRF-TOKEN" : "{{ csrf_token() }}"
		}

		getAntrian('all');
		function getAntrian(poli_id) {
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

		$('#chg_poli').change(function(event) {
			var poli_id = $(this).val();
			if (poli_id) getAntrian(poli_id);
		});

		// Initiate the Pusher JS library
		Pusher.logToConsole = true;
		var pusher = new Pusher('a5bf0a9f7538a3e6a68f', {
			cluster: 'ap1',
			encrypted: true
		});

		var channel = pusher.subscribe('ambil-antrian');
		channel.bind('ambil-antrian', function(data) {
			var poli_id = $('#chg_poli').val();
			if (poli_id == 'all') getAntrian('all');
			else getAntrian(poli_id);
		});
	});
</script>
@endsection