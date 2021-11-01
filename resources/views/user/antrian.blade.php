@extends('user.layout')
@section('content')
@php
$data = new App\Models\Poli;
$jadwal = new App\Models\Jadwal;

$days = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];

$this_day = date('D');
$day = '';
if ($this_day == 'Mon') $day = "Senin";
else if ($this_day == 'Tue') $day = "Selasa";
else if ($this_day == 'Wed') $day = "Rabu";
else if ($this_day == 'Thu') $day = "Kamis";
else if ($this_day == 'Fri') $day = "Jumat";
else if ($this_day == 'Sat') $day = "Sabtu";
else if ($this_day == 'Sun') $day = "Minggu";

$status = [];
$jadwal_fix = [];
foreach ($data->where('status_layanan', 'Aktif')->get() as $i => $jdw) {
	$get_hari = [];
	$get_jam = [];
	foreach ($jadwal->where('poli_id', $jdw->id)->get() as $hri) {
		$hari = explode(' - ', $hri->hari);
		$fh = $hari[0];
		$lh = isset($hari[1]) ? $hari[1] : '';
		foreach (array_slice($days, array_search($fh, $days), array_search($lh, $days)+1) as $tes) {
			array_push($get_hari, $tes);
			array_push($get_jam, $hri->jam);
		}
	}

	$index_day = array_search($day, $get_hari);
	if ($index_day > -1) {
		$jam = explode(' - ', $get_jam[$index_day]);
		$nj = date('Hi');
		$fj = str_replace(':', '', $jam[0]);
		$lj = str_replace(':', '', $jam[1]);

		// dd($nj.' '.$fj.' '.$lj);
		if ($fj <= $nj && $nj <= $lj) $status[$i] = "Buka";
		else $status[$i] = "Tutup";
	} else $status[$i] = "Tutup";
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
					<h4 class="page-title">Ambil Antrian</h4>
					<ol class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li class="active">
							Ambil Antrian
						</li>
					</ol>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<div class="card-box table-responsive">
						<h4 class="header-title"><b>Pilih Poli & Ambil Antrian</b></h4>
						<hr>
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6">
								<form class="form-horizontal" role="form">                                    
									<div class="form-group">
										<label class="">Silahkan Pilih Poli Tujuan</label>
										<select class="form-control" name="poli_id" required="">
											<option value="">.::Pilih Poli Tujuan::.</option>
											@foreach ($data->where('status_layanan', 'Aktif')->get() as $i => $dta)
											@if($status[$i] == 'Buka')
											<option value="{{ $dta->id }}">{{ $dta->nama_poli }}</option>
											@else
											<option value="{{ $dta->id }}" disabled="">{{ $dta->nama_poli }} <i>(Sedang Tutup)</i></option>
											@endif
											@endforeach
										</select>
									</div>
									<div class="form-group text-center">
										<button class="btn btn-primary btn-rounded btn-sm"><i class="fa fa-ticket"></i> Ambil Antrian</button>
									</div>
								</form>
							</div>
						</div>
						<h4 class="header-title"><b>Informasi Jumlah Antrian</b></h4>
						<hr>
						<div class="row">
							@foreach ($data->where('status_layanan', 'Aktif')->get() as $i => $dta)
							<div class="col-sm-4">
								<div class="panel panel-color panel-info" style="border: solid #979797 0.2px;">
									<div class="panel-body" style="background: #1AB690; color: black;">
										<div class="text-center">
											<h2 class="text-white">{{ $dta->nama_poli }}</h2>
											<small class="shadow text-{{ ($status[$i] == 'Buka') ? 'success' : 'danger' }}" style="margin-top: 0px">({{ $status[$i] }})</small>
											<hr style="margin-top: 10px; margin-bottom: 10px; border: solid #fff 1px;">
											<h4 style="color: black;"><b>Nomor Antrian Sekarang</b></h4>
											<h1 style="color: black;">A-0051</h1>
										</div>
										<hr style="margin-top: 10px; margin-bottom: 10px;">
										<div class="m-b-0 row text-white text-center">
											<div class="col-md-6">
												<span>Antri dilayani:</span><br> 
												<b>A-0011</b>
											</div>
											<div class="col-md-6">
												<span>Sisa antrian:</span><br> 
												<b>40 Antrian</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
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

	});
</script>
@endsection