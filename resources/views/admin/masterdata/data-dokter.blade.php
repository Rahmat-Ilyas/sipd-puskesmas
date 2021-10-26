@extends('admin.layout')
@section('content')
@php
$data = new App\Models\Doctor;
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
					<h4 class="page-title">Data Dokter</h4>
					<ol class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li>
							<a href="#">Master Data</a>
						</li>
						<li class="active">
							Data Dokter
						</li>
					</ol>
				</div>
			</div>


			<div class="row">
				<div class="col-sm-12">
					<div class="card-box table-responsive">
						<h4 class="header-title"><b>Data Dokter Puskesma Bontonompo 2</b></h4>
						<hr>
						<button class="btn btn-primary btn-rounded m-b-20" data-toggle="modal" data-target=".modal-add"><i class="fa fa-plus-circle"></i> Tambah Data Dokter</button>
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>NIP</th>
									<th>Nama</th>
									<th>Spesialis</th>
									<th>Jenis Kelamin</th>
									<th>Tempat & Tggl Lahir</th>
									<th width="140">Alamat</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php  $no=1; foreach ($data->all() as $dta) { ?>
								<tr>
									<td>{{ $no }}</td>
									<td>{{ $dta->nip }}</td>
									<td>{{ $dta->nama }}</td>
									<td>{{ $dta->spesialis }}</td>
									<td>{{ $dta->jenis_kelamin }}</td>
									<td>
										{{ $dta->tempat_lahir.', '.date('d/m/Y', strtotime($dta->tanggal_lahir)) }}
									</td>
									<td>{{ strlen($dta->alamat) > 20 ? substr($dta->alamat, 0, 20)."..." : $dta->alamat }}</td>
									<td>
										@if($dta->status_pegawai == 'Aktif')
										<span class="badge badge-success">{{ $dta->status_pegawai }}</span>
										@else
										<span class="badge badge-secondary">{{ $dta->status_pegawai }}</span>
										@endif
									</td>
									<td width="80">
										<button class="btn btn-sm btn-primary" data-toggle="modal" data-target=".modal-edit{{ $dta->id }}" data-toggle1="tooltip" title="Edit Data"><i class="fa fa-edit"></i></button>
										<button class="btn btn-sm btn-danger" data-toggle="modal" data-target=".modal-del{{ $dta->id }}" data-toggle1="tooltip" title="Hapus Data"><i class="fa fa-trash"></i></button>
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

<!-- MODAL TAMBAH -->
<div class="modal modal-add" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Tambah Data Dokter</h4>
			</div>
			<div class="modal-body" style="padding: 20px 50px 0 50px">
				<form method="POST" action="{{ url('admin/store/datadokter') }}">
					@csrf
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">NIP</label>
						<div class="col-sm-9">
							<input type="number" name="nip" class="form-control" required="" autocomplete="off" placeholder="NIP..">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Nama Lengkap</label>
						<div class="col-sm-9">
							<input type="text" name="nama" class="form-control" required="" autocomplete="off" placeholder="Nama Lengkap..">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Spesialis</label>
						<div class="col-sm-9">
							<input type="text" name="spesialis" class="form-control" required="" autocomplete="off" placeholder="Spesialis..">
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
									if ($jnk == old('jenis_kelamin')) $select = 'selected';
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
							<input type="text" name="tempat_lahir" class="form-control" required="" placeholder="Tempat Lahir.." autocomplete="off">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Tanggal Lahir</label>
						<div class="col-sm-9">
							<input type="date" name="tanggal_lahir" class="form-control" required="" placeholder="Tanggal Lahir.." autocomplete="off">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Alamat Lengkap</label>
						<div class="col-sm-9">
							<textarea name="alamat" class="form-control" required="" placeholder="Alamat.." rows="3"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Status Pegawai</label>
						<div class="col-sm-9">
							<select name="status_pegawai" class="form-control" required="">
								@php
								$status_pegawai = ['Aktif', 'Tidak Aktif'];
								foreach ($status_pegawai as $jnk) {
									if ($jnk == old('status_pegawai')) $select = 'selected';
									else $select = '';
									echo '<option value="'.$jnk.'"'.$select.'>'.$jnk.'</option>';
								}
								@endphp
							</select>
							{{-- <small class="text-warning">Password default untuk login dokter sama dengan NIP yang terdaftar</small> --}}
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

@foreach ($data->all() as $dta)
<!-- MODAL EDIT -->
<div class="modal modal-edit{{ $dta->id }}" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Edit Data Dokter</h4>
			</div>
			<div class="modal-body" style="padding: 20px 50px 0 50px">
				<form method="POST" action="{{ url('admin/update/datadokter') }}">
					@csrf
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">NIP</label>
						<div class="col-sm-9">
							<input type="hidden" name="id" value="{{ $dta->id }}">
							<input type="number" name="nip" class="form-control" required="" autocomplete="off" placeholder="NIP.." value="{{ $dta->nip }}" readonly="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Nama Lengkap</label>
						<div class="col-sm-9">
							<input type="text" name="nama" class="form-control" required="" autocomplete="off" placeholder="Nama Lengkap.." value="{{ $dta->nama }}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Spesialis</label>
						<div class="col-sm-9">
							<input type="text" name="spesialis" class="form-control" required="" autocomplete="off" placeholder="Spesialis.." value="{{ $dta->spesialis }}">
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
						<label class="col-sm-3 col-form-label">Status Pegawai</label>
						<div class="col-sm-9">
							<select name="status_pegawai" class="form-control" required="">
								@php
								$status_pegawai = ['Aktif', 'Tidak Aktif'];
								foreach ($status_pegawai as $jnk) {
									if ($jnk == $dta->status_pegawai) $select = 'selected';
									else $select = '';
									echo '<option value="'.$jnk.'"'.$select.'>'.$jnk.'</option>';
								}
								@endphp
							</select>
						</div>
					</div>
					{{-- <div class="form-group row">
						<label class="col-sm-3 col-form-label">Password</label>
						<div class="col-sm-9">
							<input type="text" name="password" class="form-control" placeholder="Password.." autocomplete="off">
							<small class="text-warning">Masukkan Password baru untuk mengganti password</small>
						</div>
					</div> --}}
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

<!-- MODAL HAPUS -->
<div class="modal modal-del{{ $dta->id }}" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Hapus Data</h5>
			</div>
			<div class="modal-body">
				<p>Yakin ingin menghapus data ini?</p>
			</div>
			<div class="modal-footer form-inline">
				<a href="{{ url('admin/delete/datadokter/'.$dta->id) }}" role="button" class="btn btn-danger">Hapus</a>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>
@endforeach


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->	
@endsection