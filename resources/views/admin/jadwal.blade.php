@extends('admin.layout')
@section('content')
@php
$data = new App\Models\Poli;
$get_dokter = new App\Models\Doctor;
$dokter = [];
foreach ($get_dokter->where('status_pegawai', 'Aktif')->get() as $dtr) {
	$dokter[] = [
		"id" => $dtr->id,
		"nama" => $dtr->nama,
	];
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
					<h4 class="page-title">Atur Jadwal</h4>
					<ol class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li class="active">
							Atur Jadwal
						</li>
					</ol>
				</div>
			</div>


			<div class="row">
				<div class="col-sm-12">
					<div class="card-box table-responsive">
						<h4 class="header-title"><b>Atur Jadwal</b></h4>
						<hr>
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th rowspan="2" class="m-b-20">No</th>
									<th rowspan="2">Nama Poli</th>
									<th rowspan="2">Dokter Penanggung Jawab</th>
									<th colspan="2" class="text-center">Jadwal</th>
									<th rowspan="2">Aksi</th>
								</tr>
								<tr>
									<th>Hari</th>
									<th>Jam</th>
								</tr>
							</thead>
							<tbody>
								<?php  $no=1; foreach ($data->all() as $dta) { ?>
								<tr>
									<td>{{ $no }}</td>
									<td>{{ $dta->nama_poli }}</td>
									<td>{{ $dta->dokter->nama }}</td>

									<td>
										Seni - Jumat
									</td>
									<td>
										07:00 - 15:00
									</td>

									<td width="80">
										<button class="btn btn-sm btn-primary" data-toggle="modal" data-target=".modal-jadwal{{ $dta->id }}" data-toggle1="tooltip" title="Atur Jadwal"><i class="fa fa-clock-o"></i> Atur Jadwal</button>
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
<!-- MODAL ATUR JADWAL -->
<div class="modal modal-jadwal{{ $dta->id }}" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Atur Jadwal {{ $dta->nama_poli }}</h4>
			</div>
			<div class="modal-body" style="padding-bottom: 0;">
				<form method="POST" action="{{ url('admin/store/datapoli') }}">
					@csrf
					<div class="form-group row">
						<div class="col-sm-12">
							<label class="col-form-label">Dokter Penanggung Jawab</label>
						</div>
						<div class="col-sm-8">
							<select name="dokter_id" class="form-control" required="">
								<option value="">.::Dokter Penanggung Jawab::.</option>
								@php
								foreach ($dokter as $dtr) {
									if ($dtr['id'] == $dta->dokter_id) $select = 'selected';
									else $select = '';
									echo '<option value="'.$dtr['id'].'"'.$select.'>'.$dtr['nama'].'</option>';
								}
								@endphp
							</select>
						</div>
					</div>
					<div class="set-jadwal">
						<label class="col-form-label">Atur Jadwal</label>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="210">Hari</th>
									<th width="210">Jam</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="form-inline">
											<select class="form-control input-sm hari-awal">
												<option value="">-Pilih-</option>
												<option>Senin</option>
												<option>Selasa</option>
												<option>Rabu</option>
												<option>Kamis</option>
												<option>Jumat</option>
												<option>Sabtu</option>
												<option>Minggu</option>
											</select>
											<small><b>s/d</b></small>
											<select class="form-control input-sm hari-akhir" disabled="">
												<option></option>
												<option>Senin</option>
												<option>Selasa</option>
												<option>Rabu</option>
												<option>Kamis</option>
												<option>Jumat</option>
												<option>Sabtu</option>
												<option>Minggu</option>
											</select>
										</div>
									</td>
									<td>
										<div class="form-inline">
											<input type="time" class="form-control input-sm jam-awal" name="">
											<small><b>s/d</b></small>
											<input type="time" class="form-control input-sm jam-akhir" name="">
										</div>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Tambah</button>
									</td>
								</tr>
							</tbody>							
						</table>
						<small class="text-info info" hidden="">Info: Silahkan kosongkan pilihan hari selanjutnya jika jadwal hanya 1 hari </small>
					</div>
					<div class="text-right">
						<hr>
						<button type="submit" class="btn btn-default">Simpan Jadwal</button>
						<button type="" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach


<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->	
@endsection

@section('javascript')
<script>
	$(document).ready(function() {
		$(document).on('change', '.hari-awal', function(event) {
			var value = $(this).val();
			var days = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
			var days_cut = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
			var index_day = days_cut.indexOf(value);
			var next_day = days_cut.splice(index_day+1, days_cut.length);

			var option = '<option></option>';
			$.each(days, function(index, val) {
				if (next_day.indexOf(val) != -1) option += '<option>'+val+'</option>';
				else option += '<option disabled="">'+val+'</option>';
			});

			$(this).parents('.set-jadwal').find('.hari-akhir').html(option);
			$(this).parents('.set-jadwal').find('.hari-akhir').removeAttr('disabled');
			$(this).parents('.set-jadwal').find('.info').removeAttr('hidden');

			if (value == '') {
				$(this).parents('.set-jadwal').find('.hari-akhir').attr('disabled', '');
				$(this).parents('.set-jadwal').find('.info').attr('hidden', '');
			}
		});

		$(document).on('change', '.jam-akhir', function(event) {
			var jam_awal = $(this).parents('.set-jadwal').find('.jam-awal').val();
			var jam_akhir = $(this).val();

			if (jam_awal>jam_akhir) {
				console.log("OK");
			}
		});
	});
</script>
@endsection