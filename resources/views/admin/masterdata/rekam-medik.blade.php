@extends('admin.layout')
@section('content')
    @php
    $get_pasien = new App\Models\Pemeriksaan();
    $pasien = $get_pasien
        ->groupBy('user_id')
        ->orderBy('user_id', 'asc')
        ->get(['user_id']);
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
                                        <th>No. Rek Medik</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jaminan Kesehatan</th>
                                        <th>Jumlah Kunjungan</th>
                                        <th width="170">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pasien as $i => $dta)
                                        @php
                                            $kunjungan = $get_pasien->where('user_id', $dta->user->id)->get();
                                        @endphp
                                        <tr>
                                            <td>{{ (int) $i + 1 }}</td>
                                            <td>{{ $dta->user->no_rekam_medik }}</td>
                                            <td>{{ $dta->user->nama }}</td>
                                            <td>{{ $dta->user->jenis_kelamin }}</td>
                                            <td>{{ $dta->user->jaminan_kesehatan }}</td>
                                            <td>{{ count($kunjungan) }}x berkunjung</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target=".modal-detail{{ $dta->user->id }}" data-toggle1="tooltip"
                                                    title="Detail Pasien"><i class="fa fa-list"></i> Detail</button>
                                                <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target=".modal-rekam-medik{{ $dta->user->id }}"
                                                    data-toggle1="tooltip" title="Lihat Rekam Medik"><i
                                                        class="fa fa-stethoscope"></i> Rekam Medik</button>
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

    @foreach ($pasien as $dta)
        @php
            $rekam_medik = $get_pasien->where('user_id', $dta->user->id)->get();
        @endphp

        <!-- MODAL DETAIL -->
        <div class="modal modal-detail{{ $dta->user->id }}" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pasien</h5>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>NIK</td>
                                    <td>:</td>
                                    <td>{{ $dta->user->nik }}</td>
                                </tr>
                                <tr>
                                    <td>No. Rekam Medik</td>
                                    <td>:</td>
                                    <td>{{ $dta->user->no_rekam_medik }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>:</td>
                                    <td>{{ $dta->user->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>{{ $dta->user->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td>Tempat & Tggl Lahir</td>
                                    <td>:</td>
                                    <td>{{ $dta->user->tempat_lahir . ', ' . date('d/m/Y', strtotime($dta->user->tanggal_lahir)) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $dta->user->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Jaminan Kesehatan</td>
                                    <td>:</td>
                                    <td>{{ $dta->user->jaminan_kesehatan }}</td>
                                </tr>
                                <tr>
                                    <td>Status Perkawinan</td>
                                    <td>:</td>
                                    <td>{{ $dta->user->status_perkawinan }}</td>
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

        <!-- MODAL REKAM MEDIK -->
        <div class="modal modal-rekam-medik{{ $dta->user->id }}" role="dialog" aria-labelledby="staticModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-full" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="full-width-modalLabel">Data Rekam Medik</h4>
                    </div>
                    <div class="modal-body">
                        <table id="data-Table" class="table table-striped table-bordered" style="margin-top: 20px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Kunjungan</th>
                                    <th>Tggl Berkunjung</th>
                                    <th>Poli</th>
                                    <th>Dokter</th>
                                    <th>Keluhan</th>
                                    <th>Diagnosis</th>
                                    <th>Status Pulang</th>
                                    <th>PRB</th>
                                    <th>Prolanis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekam_medik as $i => $dta)
                                    <tr>
                                        <td>{{ (int) $i + 1 }}</td>
                                        <td>18030302-{{ sprintf('%05s', $dta->id) }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($dta->tggl_pemeriksaan)) }}</td>
                                        <td>{{ $dta->poli->nama_poli }}</td>
                                        <td>{{ $dta->dokter ? $dta->dokter->nama : '-' }}
                                        </td>
                                        <td>{{ $dta->keluhan }}</td>
                                        <td>{{ $dta->diagnosis }}</td>
                                        <td>{{ $dta->status_pulang }}</td>
                                        <td>{{ $dta->prb }}</td>
                                        <td>{{ $dta->prolanis }}</td>
                                    </tr>
                                @endforeach
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

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#data-Table').dataTable();
        });
    </script>
@endsection
