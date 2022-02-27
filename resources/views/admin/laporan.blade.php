@extends('admin.layout')
@section('content')
@php
$pemeriksaan = new App\Models\Pemeriksaan;
$pemeriksaan = $pemeriksaan->orderBy('id', 'desc')->whereMonth('created_at', date('m'))->get();

if (isset($_GET['laporan'])) {
	$pemeriksaan = new App\Models\Pemeriksaan;
	if ($_GET['laporan'] == 'bulanan') {
		$bulan = substr($_GET['bulan'], 5, 7);
		$pemeriksaan = $pemeriksaan->orderBy('id', 'desc')->whereMonth('created_at', $bulan)->get();
	} else if ($_GET['laporan'] == 'harian') {
		$tanggal = $_GET['tanggal'];
		$pemeriksaan = $pemeriksaan->orderBy('id', 'desc')->whereDate('created_at', $tanggal)->get();
	}
}
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
					<h4 class="page-title">Laporan</h4>
					<ol class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li class="active">
							Laporan
						</li>
					</ol>
				</div>
			</div>


			<div class="row">
				<div class="col-sm-12">
					<div class="card-box table-responsive">
						<h4 class="m-t-0 header-title"><b>Laporan Pasien</b></h4>
						<hr>
						<form method="GET" action="{{ url('admin/laporan') }}">
							<div class="row pl-3">
								<div class="col-md-2 border-right pt-4">
									<span><b>Data Berdasarkan:</b></span>
								</div>
								<div class="col-md-2 form-group">
									<label>Laporan</label>
									<select class="form-control input-sm" required="" name="laporan" style="font-size: 12px;" id="laporan-change">
										<option value="bulanan">Bulanan</option>
										<option value="harian">Harian</option>
									</select>
								</div>
								<div class="col-md-3 form-group" id="bulan">
									<label>Bulan</label>
									<input type="month" class="form-control input-sm" id="bulan-val" name="bulan" style="font-size: 12px;" value="{{ date('Y-m') }}" autocomplete="off">
								</div>
								<div class="col-md-3 form-group" id="tanggal" hidden="">
									<label>Tanggal</label>
									<input type="date" class="form-control input-sm" id="tanggal-val" name="tanggal" style="font-size: 12px;" value="{{ date('Y-m-d') }}" autocomplete="off">
								</div>
								<div class="col-md-2 form-group">
									<label>&nbsp;</label>
									<button type="submit" class="btn btn-primary btn-sm btn-block" style="font-size: 12px;"><i class="fa fa-eye"></i> &nbsp;Tampilkan Data</button>
								</div>
							</div>
						</form>
						<hr>
						<table id="datatable-buttons" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th class="text-center">NO</th>
									<th class="text-center">NO KUNJUNGAN</th>
									<th class="text-center">TANGGAL PELAYANAN</th>
									<th class="text-center">TANGGAL ENTRI</th>
									<th class="text-center">NO KARTU</th>
									<th class="text-center">NAMA PESERTA</th>
									<th class="text-center">JENIS KELAMIN</th>
									<th class="text-center">DIAGNOSIS</th>
									<th class="text-center">STATUS PULANG</th>
									<th class="text-center">PRB</th>
									<th class="text-center">PROLANIS</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($pemeriksaan as $i => $dta)
								<tr>
									<td>{{ (int)$i + 1 }}</td>
									<td>18030302-{{ sprintf('%05s', $dta->id) }}</td>
									<td class="text-center">{{ date('d/m/Y', strtotime($dta->tggl_pemeriksaan)) }}</td>
									<td class="text-center">{{ date('d/m/Y H:i', strtotime($dta->tggl_pemeriksaan)) }}</td>
									<td>{{ $dta->user->no_rekam_medik }}</td>
									<td>{{ $dta->user->nama }}</td>
									<td class="text-center">
										{{ ($dta->user->jenis_kelamin == 'Laki-laki') ? 'L' : 'P' }}
									</td>
									<td>{{ $dta->diagnosis }}</td>
									<td>{{ $dta->status_pulang }}</td>
									<td>{{ $dta->prb }}</td>
									<td>{{ $dta->prolanis }}</td>
								</tr>
								@endforeach
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

@section('javascript')<script>
	$(document).ready(function() {
		$('#nv-laporan').addClass('active');

		$('#laporan-change').change(function() {
			var lap = $(this).val();
			if (lap == 'harian') {
				$('#bulan').attr('hidden', '');
				$('#tanggal').removeAttr('hidden');
			} else if (lap == 'bulanan') {
				$('#tanggal').attr('hidden', '');
				$('#bulan').removeAttr('hidden');
			}
		});

		$("#datatable-buttons").DataTable({
			dom: "Bfrtip",
			buttons: [{
				extend: "copy",
				className: "btn-sm"
			}, {
				extend: "csv",
				className: "btn-sm"
			}, {
				extend: "excel",
				className: "btn-sm"
			}, {
				extend: "pdf",
				className: "btn-sm"
			}, {
				extend: "print",
				className: "btn-sm"
			}],
			scrollX: true,
		});

		@isset($_GET['laporan'])
		@if ($_GET['laporan'] == 'bulanan')
		$('#bulan-val').val("{{ $_GET['bulan'] }}");
		$('#laporan-change').val('bulanan');
		$('#tanggal').attr('hidden', '');
		$('#bulan').removeAttr('hidden');
		@elseif ($_GET['laporan'] == 'harian')
		$('#tanggal-val').val("{{ $_GET['tanggal'] }}");
		$('#laporan-change').val('harian');
		$('#bulan').attr('hidden', '');
		$('#tanggal').removeAttr('hidden');
		@endif		    
		var url = window.location.href;
		url = url.split('?')[0];
		window.history.pushState('', '', url)
		@endisset
	});
</script>
@endsection