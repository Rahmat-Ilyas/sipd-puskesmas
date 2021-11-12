@extends('admin.layout')
@section('content')
@php
$pemeriksaan = new App\Models\Pemeriksaan;
$pemeriksaan = $pemeriksaan->orderBy('id', 'desc')->get();
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
					<h4 class="page-title">Riwayat Pasien</h4>
					<ol class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li class="active">
							Riwayat Pasien
						</li>
					</ol>
				</div>
			</div>


			<div class="row">
				<div class="col-sm-12">
					<div class="card-box table-responsive">
						<h4 class="m-t-0 header-title"><b>Riwayat Pasien</b></h4>
						<hr>
						<table id="datatable" class="table table-striped table-bordered" style="margin-top: 20px;">
							<thead>
								<tr>
									<th>No</th>
									<th width="100">No Kunjungan</th>
									<th>Tggl Berkunjung</th>
									<th>No. Pasien</th>
									<th width="100">Nama Pasien</th>
									<th width="100">Poli</th>
									<th width="100">Dokter</th>
									<th>Status Pulang</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($pemeriksaan as $i => $dta)
								<tr>
									<td>{{ (int)$i + 1 }}</td>
									<td>18030302-{{ sprintf('%05s', $dta->id) }}</td>
									<td>{{ date('d/m/Y', strtotime($dta->tggl_pemeriksaan)) }}</td>
									<td>{{ $dta->user->no_rekam_medik }}</td>
									<td>{{ $dta->user->nama }}</td>
									<td>{{ $dta->poli->nama_poli }}</td>
									<td>{{ $dta->dokter->nama }}</td>
									<td>{{ $dta->status_pulang }}</td>
									<td width="80" class="text-center">
										<button class="btn btn-sm btn-info" data-toggle="modal" data-target=".modal-detail{{ $dta->id }}"><i class="fa fa-list"></i> Detail</button>
									</td>
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

@foreach ($pemeriksaan as $i => $dta)
<!-- MODAL DETAIL -->
<div class="modal modal-detail{{ $dta->id }}" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Pemeriksaan</h5>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td colspan="3" class="text-center"><b>Data Pasien</b></td>
						</tr>
						<tr>
							<td width="200">No. Rekam Medik</td><td width="10">:</td>
							<td>{{ $dta->user->no_rekam_medik }}</td>
						</tr>
						<tr>
							<td>Nama Lengkap</td><td>:</td>
							<td>{{ $dta->user->nama }}</td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td><td>:</td>
							<td>{{ $dta->user->jenis_kelamin }}</td>
						</tr>
						<tr>
							<td>Tempat & Tggl Lahir</td><td>:</td>
							<td>{{ $dta->user->tempat_lahir.', '.date('d/m/Y', strtotime($dta->user->tanggal_lahir)) }}</td>
						</tr>
						<tr>
							<td>Alamat</td><td>:</td>
							<td>{{ $dta->user->alamat }}</td>
						</tr>
					</tbody>
				</table>

				<table class="table table-bordered">
					<tbody>
						<tr>
							<td colspan="3" class="text-center"><b>Data Pemeriksaan</b></td>
						</tr>
						<tr>
							<td width="200">Tanggal Pemeriksaan</td><td width="10">:</td>
							<td>{{ date('d-m-Y H:i', strtotime($dta->tggl_pemeriksaan)) }}</td>
						</tr>
						<tr>
							<td>Dokter</td><td>:</td>
							<td>{{ $dta->dokter->nama }}</td>
						</tr>
						<tr>
							<td>Poli</td><td>:</td>
							<td>{{ $dta->poli->nama_poli }}</td>
						</tr>
						<tr>
							<td>Keluhan</td><td>:</td>
							<td>{{ $dta->keluhan }}</td>
						</tr>
						<tr>
							<td>Diagnosis</td><td>:</td>
							<td>{{ $dta->diagnosis }}</td>
						</tr>
						<tr>
							<td>Status Pulang</td><td>:</td>
							<td>{{ $dta->status_pulang }}</td>
						</tr>
						<tr>
							<td>PRB</td><td>:</td>
							<td>{{ $dta->prb }}</td>
						</tr>
						<tr>
							<td>Prolanis</td><td>:</td>
							<td>{{ $dta->prolanis }}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer form-inline">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
@endforeach


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->	
@endsection