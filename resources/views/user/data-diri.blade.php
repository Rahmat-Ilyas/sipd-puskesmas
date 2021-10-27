@extends('user.layout')
@section('content')
@php
$user = new App\Models\User;
$data = $user->where('id', Auth::user()->id)->first();
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
												<td width="180">NIK</td><td width="10">:</td>
												<td>{{ $data->nik }}</td>
											</tr>
											<tr>
												<td>No. Rekam Medik</td><td>:</td>
												<td>{{ $data->no_rekam_medik }}</td>
											</tr>
											<tr>
												<td>Nama Lengkap</td><td>:</td>
												<td>{{ $data->nama }}</td>
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
												<td>Jaminan Kesehatan</td><td>:</td>
												<td>{{ $data->jaminan_kesehatan }}</td>
											</tr>
											<tr>
												<td>Status Perkawinan</td><td>:</td>
												<td>{{ $data->status_perkawinan }}</td>
											</tr>
											<tr>
												<td>Tanggal Terdaftar</td><td>:</td>
												<td>{{ date('d/m/Y', strtotime($data->created_at)) }}</td>
											</tr>
										</tbody>
									</table>
									<button class="btn btn-default btn-rounded" id="btn-edit-data-diri"><i class="fa fa-edit"></i> Edit Data Saya</button>
								</div>
								<div id="edit-data-diri" hidden="">
									<form method="POST" action="{{ url('user/update/datadiri') }}">
										@csrf
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">No. Rekam Medik</label>
											<div class="col-sm-9">
												<input type="text" name="no_rekam_medik" class="form-control" required="" autocomplete="off" placeholder="No. Rekam Medik.." value="{{ $data->no_rekam_medik }}" readonly="">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">NIK</label>
											<div class="col-sm-9">
												<input type="hidden" name="id" value="{{ $data->id }}">
												<input type="number" name="nik" class="form-control" required="" autocomplete="off" placeholder="NIK.." value="{{ $data->nik }}">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">Nama Lengkap</label>
											<div class="col-sm-9">
												<input type="text" name="nama" class="form-control" required="" autocomplete="off" placeholder="Nama Lengkap.." value="{{ $data->nama }}">
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
														if ($jnk == $data->jenis_kelamin) $select = 'selected';
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
												<input type="text" name="tempat_lahir" class="form-control" required="" placeholder="Tempat Lahir.." autocomplete="off" value="{{ $data->tempat_lahir }}">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">Tanggal Lahir</label>
											<div class="col-sm-9">
												<input type="date" name="tanggal_lahir" class="form-control" required="" placeholder="Tanggal Lahir.." autocomplete="off" value="{{ $data->tanggal_lahir }}">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">Alamat Lengkap</label>
											<div class="col-sm-9">
												<textarea name="alamat" class="form-control" required="" placeholder="Alamat.." rows="3">{{ $data->alamat }}</textarea>
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
														if ($jks == $data->jaminan_kesehatan) $select = 'selected';
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
														if ($jnk == $data->status_perkawinan) $select = 'selected';
														else $select = '';
														echo '<option value="'.$jnk.'"'.$select.'>'.$jnk.'</option>';
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
	});
</script>
@endsection