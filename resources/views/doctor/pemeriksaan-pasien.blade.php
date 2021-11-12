@extends('doctor.layout')
@section('content')
@php
if (!isset($_GET['antrian_id'])) {
	header('location: '.url('doctor/antrian-pasien'));
	exit();
}

$antrian_id = $_GET['antrian_id'];

$antrian = new App\Models\Antrian;
$user = new App\Models\User;
$antrian = $antrian->where('id', $antrian_id)->first();
$user = $user->where('id', $antrian->user_id)->first();
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
					<h4 class="page-title">Pemeriksaan Pasien</h4>
					<ol class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li>
							<a href="#">Antrian Pasien</a>
						</li>
						<li class="active">
							Pemeriksaan Pasien
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
						<h4 class="m-t-0 header-title"><b>Pemeriksaan Pasien</b></h4>
						<hr class="m-b-10">
						<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-6">
								<table class="table table-bordered" id="detail-akun">
									<tbody>
										<tr>
											<td colspan="3" class="text-center"><b>Data Pasien</b></td>
										</tr>
										<tr>
											<td width="180">Nomor Rekam Medik</td><td>:</td>
											<td>{{ $user->no_rekam_medik }}</td>
										</tr>
										<tr>
											<td>Nama Lengkap</td><td>:</td>
											<td>{{ $user->nama }}</td>
										</tr>
										<tr>
											<td>Jenis Kelamin</td><td>:</td>
											<td>{{ $user->jenis_kelamin }}</td>
										</tr>
										<tr>
											<td>Tempat & Tggl Lahir</td><td>:</td>
											<td>{{ $user->tempat_lahir.', '.date('d/m/Y', strtotime($user->tanggal_lahir)) }}</td>
										</tr>
									</tbody>                            
								</table>
								<div class="card-box">
									<h4 class="text-center m-t-20"><u>Lengkapi Data Pemeriksaan</u></h4>
									<form class="m-t-20" method="POST" action="{{ url('doctor/store/pemeriksaan') }}">
										@csrf
										<div class="form-group">
											<label>Keluhan Pasien</label>
											<textarea name="keluhan" class="form-control" required="" placeholder="Keluhan Pasien.." rows="5"></textarea>
										</div>
										<div class="form-group">
											<label>Diagnosis Pasien</label>
											<textarea name="diagnosis" class="form-control" required="" placeholder="Diagnosis Pasien.." rows="5"></textarea>
										</div>
										<div class="form-group">
											<label>Status Pulang</label>
											<select class="form-control" name="status_pulang" required="">
												<option value="">.::Status Pulang::.</option>
												@php
												$status_pulang = ['Sembuh', 'Berobat Jalan', 'Rujuk Vertikal', 'Opname'];
												foreach ($status_pulang as $stsp) {
													echo '<option value="'.$stsp.'">'.$stsp.'</option>';
												}
												@endphp
											</select>
										</div>
										<div class="form-group">
											<label>PRB (Optional)</label>
											<input type="text" name="prb" class="form-control" placeholder="PRB.." autocomplete="off" value="">	
										</div>
										<div class="form-group">
											<label>Prolanis (Optional)</label>
											<input type="text" name="prolanis" class="form-control" placeholder="Prolanis.." autocomplete="off" value="">	
										</div>
										<div class="text-center">
											<input type="hidden" name="user_id" value="{{ $user->id }}">
											<input type="hidden" name="dokter_id" value="{{ Auth::user()->id }}">
											<input type="hidden" name="poli_id" value="{{ $antrian->poli_id }}">
											<input type="hidden" name="antrian_id" value="{{ $antrian_id }}">
											<button type="submit" class="btn btn-default">Selesaikan Pemeriksaan</button>
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
		$('.antrian-pasien').addClass('active');
		var url = "{{ url('doctor/config') }}";
		var headers = {
			"Accept": "application/json",
			"X-CSRF-TOKEN" : "{{ csrf_token() }}"
		}

		getAntrian();
		function getAntrian(poli_id) {
			var poli_id = "";
			$.ajax({
				url     : url,
				method  : "POST",
				headers : headers,
				data 	: { 
					req: 'getAntrian',
					poli_id: poli_id
				},
				success : function(data) {
					if (data) $('#data-antrian').html(data);
					else $('#datatable').dataTable().fnClearTable();
				}
			});
		}

		$(document).on('click', '.proses', function(event) {
			var id = $(this).attr('data-id');
			var status = $(this).attr('data-status');

			$(this).attr('disabled', '');
			$(this).find('.fa').removeClass('fa-volume-up').addClass('fa-spinner fa-spin');
			
			$.ajax({
				url     : url,
				method  : "POST",
				headers : headers,
				data 	: { 
					req: 'updateAntrian',
					id: id,
					status: status,
				},
				success : function(data) {
					if (status == 'proccess') 
						location.href="{{ url('/doctor/pemeriksaan-pasien/') }}?pasien_id="+data
					else
						getAntrian();
				}
			});
		});
		
		$(document).on('click', '.disabled', function(event) {
			event.preventDefault();
			$.Notification.autoHideNotify('warning', 'top right', 'Tidak dapat diproses','Mohon proses antrian sesuai urutan');
		});

		// Initiate the Pusher JS library
		Pusher.logToConsole = true;
		var pusher = new Pusher('a5bf0a9f7538a3e6a68f', {
			cluster: 'ap1',
			encrypted: true
		});

		var channel = pusher.subscribe('ambil-antrian');
		channel.bind('ambil-antrian', function(data) {
			getAntrian();
		});
	});
</script>
@endsection