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
		if ($fj <= $nj && $nj <= $lj) $status[$i] = "BUKA";
		else $status[$i] = "TUTUP";
	} else $status[$i] = "TUTUP";
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
					<h4 class="page-title">Lihat Jadwal</h4>
					<ol class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li class="active">
							Lihat Jadwal
						</li>
					</ol>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<div class="card-box table-responsive">
						<h4 class="header-title"><b>Jadwal Poli Puskesmas Bontonompo 2</b></h4>
						<hr>
						<div class="row">
							@foreach ($data->where('status_layanan', 'Aktif')->get() as $i => $dta)
							<div class="col-sm-4">
								<div class="panel panel-color panel-info" style="border: solid #979797 0.2px; height: 400px;">
									<div class="panel-heading">
										<h3 class="panel-title" style="font-size: 20px">{{ $dta->nama_poli }}</h3>
									</div>
									<div class="panel-body">
										<div>
											<h4 class="text-{{ ($status[$i] == 'BUKA') ? 'success' : 'danger' }} m-t-0"><b>{{ $status[$i] }}</b></h4>
											<span>{{ $dta->keterangan }}</span>
										</div>
										<hr style="margin-top: 10px; margin-bottom: 10px;">
										<div class="m-b-10">
											<b>Dokter Jaga</b><br>
											<span>{{ $dta->dokter->nama }}</span>
										</div>
										<b>Jadwal</b>
										<table class="table table-bordered">
											<tbody>
												<?php $ada = 0;
												foreach ($jadwal->where('poli_id', $dta->id)->get() as $hri) { ?>
												<tr>
													<td>{{ $hri->hari }}</td>
													<td>{{ $hri->jam }}</td>
												</tr>
												<?php 
												$ada++; } if ($ada == 0) { ?>
												<tr>
													<td class="text-center"><i>Tidak ada jadwal tersedia</i></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
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