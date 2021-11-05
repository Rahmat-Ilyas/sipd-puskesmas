{{-- @if (!isset($_GET['type']) || ($_GET['type']!='new' && $_GET['type']!='old'))
<script>location.href='{{ url('/admin/antrian') }}'</script>
@endif --}}

@extends('admin.layout')
@section('content')
@php
$user = new App\Models\User;
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
					<h4 class="page-title">Ambil Antrian</h4>
					<ol class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li>
							<a href="#">Daftar Antrian Pasien</a>
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
						<h5 class="text-dark font-14 pull-right" style="padding-bottom: 20px;">
							<u class=" "><b>Tanggal Peayanan : </b> <i>{{ date('d-m-Y') }}</i></u>
						</h5>
						<h4 class="m-t-0 header-title"><b>Ambil Antrian</b></h4>
						<hr>
						@if (isset($_GET['type']) && $_GET['type']=='new')
						<h3 class="text-center"><u>Daftar Pasien Baru</u></h3>
						<div class="text-center">
							<span class="">Silahkan daftar dan input data pasien baru terlebih dahulu!</span>
						</div>
						<form class="form-horizontal m-t-20" method="POST" action="{{ url('admin/store/pasien') }}">
							@csrf
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="col-sm-4 control-label">NIK</label>
										<div class="col-sm-7">
											<input type="number" name="nik" class="form-control" required="" placeholder="NIK.." autocomplete="off" value="{{ old('nik') }}">
											@if($errors->any())
											<small class="text-danger">NIK yang anda masukkan sudah terdaftar</small>
											@endif
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Nama Lengkap</label>
										<div class="col-sm-7">
											<input type="text" name="nama" class="form-control" required="" placeholder="Nama Lengkap.." autocomplete="off" value="{{ old('nama') }}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Jenis Kelamin</label>
										<div class="col-sm-7">
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
									<div class="form-group">
										<label class="col-sm-4 control-label">Tempat Lahir</label>
										<div class="col-sm-7">
											<input type="text" name="tempat_lahir" class="form-control" required="" placeholder="Tempat Lahir.." autocomplete="off" value="{{ old('tempat_lahir') }}">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Tanggal Lahir</label>
										<div class="col-sm-7">
											<input type="date" name="tanggal_lahir" class="form-control" required="" placeholder="Tanggal Lahir.." autocomplete="off" value="{{ old('tanggal_lahir') }}">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="col-sm-4 control-label">Jaminan Kesehatan</label>
										<div class="col-sm-7">
											<select name="jaminan_kesehatan" class="form-control" required="">
												<option value="">.::Jaminan Kesehatan::.</option>
												@php
												$jaminan_kesehatan = ['BPJS', 'KIS', 'JKN', 'Tidak Ada'];
												foreach ($jaminan_kesehatan as $jnk) {
													if ($jnk == old('jaminan_kesehatan')) $select = 'selected';
													else $select = '';
													echo '<option value="'.$jnk.'"'.$select.'>'.$jnk.'</option>';
												}
												@endphp
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Alamat Lengkap</label>
										<div class="col-sm-7">
											<textarea name="alamat" class="form-control" required="" placeholder="Alamat.." rows="3">{{ old('tempat_lahir') }}</textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Status Kawin</label>
										<div class="col-sm-7">
											<select name="status_perkawinan" class="form-control" required="">
												<option value="">.::Status Kawin::.</option>
												@php
												$status_perkawinan = ['Belum Menikah', 'Menikah', 'Cerai'];
												foreach ($status_perkawinan as $jnk) {
													if ($jnk == old('status_perkawinan')) $select = 'selected';
													else $select = '';
													echo '<option value="'.$jnk.'"'.$select.'>'.$jnk.'</option>';
												}
												@endphp
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"></label>
										<div class="col-sm-7">
											<span class="text-dark">Info: Password default untuk pasien baru adalah <b class="text-danger">BPPASS123</b></span>
											<input type="hidden" name="password" value="BPPASS123">
										</div>
									</div>
								</div>
								<div class="col-sm-12 text-center">
									<hr style="margin-top: 2px;">
									<div class="form-group">
										<button type="submit" class="btn btn-lg  btn-primary btn-rounded waves-effect waves-light" style="padding: 10px 50px 10px 50px;">
											Daftarkan Pasien Baru
										</button>
									</div>
								</div>
							</div>
						</form>
						@else
						<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-6">
								<form method="POST" action="{{ url('admin/store/antrian') }}">
									@csrf
									<div class="form-group">
										<label>No. KTP / No. Rekam Medik / Nama Pasien:</label>
										<select class="form-control select2" id="chg_user" name="user_id" required="">
											<option value="">.::Cari Data Pasien::.</option>
											@foreach ($user->get() as $usr)
											<option value="{{ $usr->id }}">{{ $usr->nik.' / '.$usr->no_rekam_medik }} ({{ $usr->nama }})</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<span>Pilih Poli Tujuan:</span>
										<select class="form-control" id="chg_poli" name="poli_id" required="">
											<option value="">.::Pilih Poli::.</option>
											@foreach ($poli->where('status_layanan', 'Aktif')->get() as $pli)
											<option value="{{ $pli->id }}">{{ $pli->nama_poli }}</option>
											@endforeach
										</select>
									</div>
									<h3 class="text-center">Nomor Antrian Tersedia:</h3>
									<div id="antrian-tersedia">
										<h4 class="text-center"><i>--Pilih Poli--</i></h4>			
									</div>
									<div class="text-center m-t-20">
										<button type="submit" class="btn btn-rounded btn-primary"><i class="fa fa-ticket"></i> Ambil Antrian</button>
									</div>
								</form>
							</div>
						</div>
						@endif
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
		$('.daftar-antrian').addClass('active');
		var url = "{{ url('admin/config') }}";
		var headers = {
			"Accept": "application/json",
			"X-CSRF-TOKEN" : "{{ csrf_token() }}"
		}

		getAntrian();
		function getAntrian(poli_id=null) {
			$.ajax({
				url     : url,
				method  : "POST",
				headers : headers,
				data 	: { 
					req: 'getAntrianLast',
					poli_id: poli_id
				},
				success : function(data) {
					if (poli_id) {
						$('#antrian-tersedia').html('<h1 class="text-center"><b>'+data+'</b></h1>');
					} else {	
						$('#antrian-tersedia').html('<h4 class="text-center"><i>--Pilih Poli--</i></h4>');
					}
				}
			});
		}

		$('#chg_poli').change(function(event) {
			var poli_id = $(this).val();
			getAntrian(poli_id);
		});

		$('#chg_user').change(function(event) {
			var user_id = $(this).val();
			$.ajax({
				url     : url,
				method  : "POST",
				headers : headers,
				data 	: { 
					req: 'cekAntrian',
					user_id: user_id
				},
				success : function(data) {
					if (data) {
						$('.select2').val('').trigger('change');
						swal({
							type: 'warning',
							title: 'Antrian Sudah Ada',
							text: 'Pasien yang dipilih telah mengambil antrian untuk hari ini'
						});
					}
				}
			});
		});

		@if(session('user_id'))
		$('#chg_user').val('{{ session('user_id') }}').trigger('change');
		@endif

		// Initiate the Pusher JS library
		Pusher.logToConsole = true;
		var pusher = new Pusher('a5bf0a9f7538a3e6a68f', {
			cluster: 'ap1',
			encrypted: true
		});

		var channel = pusher.subscribe('ambil-antrian');
		channel.bind('ambil-antrian', function(data) {
			var poli_id = $('#chg_poli').val();
			if (poli_id) getAntrian(poli_id);
		});
	});
</script>
@endsection