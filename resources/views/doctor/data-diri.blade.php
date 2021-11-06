@extends('doctor.layout')
@section('content')
@php
$doctor = new App\Models\Doctor;
$data = $doctor->where('id', Auth::user()->id)->first();
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
					<h4 class="page-title">Data Diri</h4>
					<ol class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li class="active">
							Data Diri
						</li>
					</ol>
				</div>
			</div>


			<div class="row">
				<div class="col-sm-12">
					<div class="card-box table-responsive">
						<h4 class="header-title"><b>Data Diri Saya</b></h4>
						<hr>
						<div class="row">
							<div class="col-sm-2"></div>
							<div class="col-sm-8">
								<div id="detail-data-diri">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td width="180">NIP</td><td width="10">:</td>
												<td>{{ $data->nip }}</td>
											</tr>
											<tr>
												<td>Nama Lengkap</td><td>:</td>
												<td>{{ $data->nama }}</td>
											</tr>
											<tr>
												<td>Spesialis</td><td>:</td>
												<td>{{ $data->spesialis }}</td>
											</tr>
											<tr>
												<td>Jenis Kelamin</td><td>:</td>
												<td>{{ $data->jenis_kelamin }}</td>
											</tr>
											<tr>
												<td>Tempat & Tggl Lahir</td><td>:</td>
												<td>{{ $data->tempat_lahir.', '.date('d/m/Y', strtotime($data->tanggal_lahir)) }}</td>
											</tr>
											<tr>
												<td>Alamat</td><td>:</td>
												<td>{{ $data->alamat }}</td>
											</tr>
											<tr>
												<td>Status Pegawai</td><td>:</td>
												<td>{{ $data->status_pegawai }}</td>
											</tr>
										</tbody>
									</table>
									<button class="btn btn-default btn-rounded" id="btn-edit-data-diri"><i class="fa fa-edit"></i> Edit Data Saya</button>
								</div>
								<div id="edit-data-diri" hidden="">
									<form method="POST" action="{{ url('doctor/update/datadiri') }}">
										@csrf
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">NIP</label>
											<div class="col-sm-9">
												<input type="hidden" name="id" value="{{ $data->id }}">
												<input type="number" name="nip" class="form-control" required="" autocomplete="off" placeholder="NIP.." value="{{ $data->nip }}">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">Nama Lengkap</label>
											<div class="col-sm-9">
												<input type="text" name="nama" class="form-control" required="" autocomplete="off" placeholder="Nama Lengkap.." value="{{ old('nama') ? old('nama') : $data->nama }}">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">Jenis Kelamin</label>
											<div class="col-sm-9">
												<select name="jenis_kelamin" class="form-control" required="">
													<option value="">.::Jenis Kelamin::.</option>
													@php
													$jenis_kelamin = ['Laki-laki', 'Perempuan'];
													$cek_jnk = old('jenis_kelamin') ? old('jenis_kelamin') : $data->jenis_kelamin;
													foreach ($jenis_kelamin as $jnk) {
														if ($jnk == $cek_jnk) $select = 'selected';
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
												<input type="text" name="tempat_lahir" class="form-control" required="" placeholder="Tempat Lahir.." autocomplete="off" value="{{ old('tempat_lahir') ? old('tempat_lahir') : $data->tempat_lahir }}">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">Tanggal Lahir</label>
											<div class="col-sm-9">
												<input type="date" name="tanggal_lahir" class="form-control" required="" placeholder="Tanggal Lahir.." autocomplete="off" value="{{ old('tanggal_lahir') ? old('tanggal_lahir') : $data->tanggal_lahir }}">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">Alamat Lengkap</label>
											<div class="col-sm-9">
												<textarea name="alamat" class="form-control" required="" placeholder="Alamat.." rows="3">{{ old('alamat') ? old('alamat') : $data->alamat }}</textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">Status Pegawai</label>
											<div class="col-sm-9">
												<select name="status_pegawai" class="form-control" required="">
													<option value="">.::Status Pegawai::.</option>
													@php
													$status_pegawai = ['Aktif', 'Tida Aktif'];
													$cek_stk = old('status_pegawai') ? old('status_pegawai') : $data->status_pegawai;
													foreach ($status_pegawai as $stk) {
														if ($stk == $cek_stk) $select = 'selected';
														else $select = '';
														echo '<option value="'.$stk.'"'.$select.'>'.$stk.'</option>';
													}
													@endphp
												</select>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9">
												<button type="submit" class="btn btn-default">Update</button>
												<button type="button" class="btn btn-primary" id="batal-edit-data-diri">Batal</button>
											</div>
										</div>
									</form>
								</div>
							</div>
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
		$('#btn-edit-data-diri').click(function(event) {
			$('#edit-data-diri').removeAttr('hidden');
			$('#detail-data-diri').attr('hidden', '');
		});

		$('#batal-edit-data-diri').click(function(event) {
			$('#edit-data-diri').attr('hidden', '');
			$('#detail-data-diri').removeAttr('hidden');
		});

		@if(old('nip'))
		$('#edit-data-diri').removeAttr('hidden');
		$('#detail-data-diri').attr('hidden', '');
		@endif
	});
</script>
@endsection