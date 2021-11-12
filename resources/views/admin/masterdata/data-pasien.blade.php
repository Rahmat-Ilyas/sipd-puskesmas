@extends('admin.layout')
@section('content')
@php
$data = new App\Models\User;
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
					<h4 class="page-title">Data Pasien</h4>
					<ol class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li>
							<a href="#">Master Data</a>
						</li>
						<li class="active">
							Data Pasien
						</li>
					</ol>
				</div>
			</div>


			<div class="row">
				<div class="col-sm-12">
					<div class="card-box table-responsive">
						<h4 class="header-title"><b>Data Pasien</b></h4>
						<hr>
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>NIK</th>
									<th>No. Rek Medik</th>
									<th>Nama Lengkap</th>
									<th>Jenis Kelamin</th>
									<th>Tempat & Tggl Lahir</th>
									<th>Jaminan Kesehatan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php  $no=1; foreach ($data->all() as $dta) { ?>
								<tr>
									<td>{{ $no }}</td>
									<td>{{ $dta->nik }}</td>
									<td>{{ $dta->no_rekam_medik }}</td>
									<td>{{ $dta->nama }}</td>
									<td>{{ $dta->jenis_kelamin }}</td>
									<td>
										{{ $dta->tempat_lahir.', '.date('d/m/Y', strtotime($dta->tanggal_lahir)) }}
									</td>
									<td>{{ $dta->jaminan_kesehatan }}</td>
									<td width="80">
										<button class="btn btn-sm btn-info" data-toggle="modal" data-target=".modal-detail{{ $dta->id }}" data-toggle1="tooltip" title="Detail Pasien"><i class="fa fa-list"></i></button>
										<button class="btn btn-sm btn-success" data-toggle="modal" data-target=".modal-edit{{ $dta->id }}" data-toggle1="tooltip" title="Edit Pasien"><i class="fa fa-edit"></i></button>
									</td>
								</tr>									
								<?php $no++; } ?>
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

@foreach ($data->all() as $dta)
<!-- MODAL EDIT -->
<div class="modal modal-edit{{ $dta->id }}" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Edit Data Pasien</h4>
			</div>
			<div class="modal-body" style="padding: 20px 50px 0 50px">
				<form method="POST" action="{{ url('admin/update/datapasien') }}">
					@csrf
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">NIK</label>
						<div class="col-sm-9">
							<input type="hidden" name="id" value="{{ $dta->id }}">
							<input type="number" name="nik" class="form-control" required="" autocomplete="off" placeholder="NIK.." value="{{ $dta->nik }}" readonly="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">No. Rekam Medik</label>
						<div class="col-sm-9">
							<input type="text" name="no_rekam_medik" class="form-control" required="" autocomplete="off" placeholder="No. Rekam Medik.." value="{{ $dta->no_rekam_medik }}" readonly="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Nama Lengkap</label>
						<div class="col-sm-9">
							<input type="text" name="nama" class="form-control" required="" autocomplete="off" placeholder="Nama Lengkap.." value="{{ $dta->nama }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Jenis Kelamin</label>
						<div class="col-sm-9">
							<select name="jenis_kelamin" class="form-control" required="">
								<option value="">.::Jenis Kelamin::.</option>
								@php
								$jenis_kelamin = ['Laki-laki', 'Perempuan'];
								foreach ($jenis_kelamin as $jnk) {
									if ($jnk == $dta->jenis_kelamin) $select = 'selected';
									else $select = '';
									echo '<option value="'.$jnk.'"'.$select.'>'.$jnk.'</option>';
								}
								@endphp
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Tempat Lahir</label>
						<div class="col-sm-9">
							<input type="text" name="tempat_lahir" class="form-control" required="" placeholder="Tempat Lahir.." autocomplete="off" value="{{ $dta->tempat_lahir }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Tanggal Lahir</label>
						<div class="col-sm-9">
							<input type="date" name="tanggal_lahir" class="form-control" required="" placeholder="Tanggal Lahir.." autocomplete="off" value="{{ $dta->tanggal_lahir }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Alamat Lengkap</label>
						<div class="col-sm-9">
							<textarea name="alamat" class="form-control" required="" placeholder="Alamat.." rows="3">{{ $dta->alamat }}</textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Jaminan Kesehatan</label>
						<div class="col-sm-9">
							<select name="jaminan_kesehatan" class="form-control" required="">
								<option value="">.::Jaminan Kesehatan::.</option>
								@php
								$jaminan_kesehatan = ['BPJS', 'KIS', 'JKN', 'Tidak Ada'];
								foreach ($jaminan_kesehatan as $jks) {
									if ($jks == $dta->jaminan_kesehatan) $select = 'selected';
									else $select = '';
									echo '<option value="'.$jks.'"'.$select.'>'.$jks.'</option>';
								}
								@endphp
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Status Kawin</label>
						<div class="col-sm-9">
							<select name="status_perkawinan" class="form-control" required="">
								<option value="">.::Status Kawin::.</option>
								@php
								$status_perkawinan = ['Belum Menikah', 'Menikah', 'Cerai'];
								foreach ($status_perkawinan as $jnk) {
									if ($jnk == $dta->status_perkawinan) $select = 'selected';
									else $select = '';
									echo '<option value="'.$jnk.'"'.$select.'>'.$jnk.'</option>';
								}
								@endphp
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Password</label>
						<div class="col-sm-9">
							<input type="text" name="password" class="form-control" placeholder="Password.." autocomplete="off">
							<small class="text-warning">Masukkan Password baru untuk mengganti password</small>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-3"></div>
						<div class="col-sm-9">
							<button type="submit" class="btn btn-default">Simpan</button>
							<button type="" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Batal</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- MODAL DETAIL -->
<div class="modal modal-detail{{ $dta->id }}" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Pasien</h5>
			</div>
			<div class="modal-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>NIK</td><td>:</td>
							<td>{{ $dta->nik }}</td>
						</tr>
						<tr>
							<td>No. Rekam Medik</td><td>:</td>
							<td>{{ $dta->no_rekam_medik }}</td>
						</tr>
						<tr>
							<td>Nama Lengkap</td><td>:</td>
							<td>{{ $dta->nama }}</td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td><td>:</td>
							<td>{{ $dta->jenis_kelamin }}</td>
						</tr>
						<tr>
							<td>Tempat & Tggl Lahir</td><td>:</td>
							<td>{{ $dta->tempat_lahir.', '.date('d/m/Y', strtotime($dta->tanggal_lahir)) }}</td>
						</tr>
						<tr>
							<td>Alamat</td><td>:</td>
							<td>{{ $dta->alamat }}</td>
						</tr>
						<tr>
							<td>Jaminan Kesehatan</td><td>:</td>
							<td>{{ $dta->jaminan_kesehatan }}</td>
						</tr>
						<tr>
							<td>Status Perkawinan</td><td>:</td>
							<td>{{ $dta->status_perkawinan }}</td>
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