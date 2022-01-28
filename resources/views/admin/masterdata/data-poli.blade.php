@extends('admin.layout')
@section('content')
    @php
    $data = new App\Models\Poli();
    $get_dokter = new App\Models\Doctor();
    $dokter = [];
    foreach ($get_dokter->where('status_pegawai', 'Aktif')->get() as $dtr) {
        $dokter[] = [
            'id' => $dtr->id,
            'nama' => $dtr->nama,
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
                        <h4 class="page-title">Data Poli</h4>
                        <ol class="breadcrumb">
                            <li>
                                <a href="#">Dashboard</a>
                            </li>
                            <li>
                                <a href="#">Master Data</a>
                            </li>
                            <li class="active">
                                Data Poli
                            </li>
                        </ol>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="header-title"><b>Data Poli Puskesma Bontonompo 2</b></h4>
                            <hr>
                            <button class="btn btn-primary btn-rounded m-b-20" data-toggle="modal"
                                data-target=".modal-add"><i class="fa fa-plus-circle"></i> Tambah Poli</button>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Poli</th>
                                        <th>Nama Poli</th>
                                        <th>Dokter Penanggung Jawab</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $no=1; foreach ($data->all() as $dta) { ?>
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td><b>{{ $dta->kode_poli }}</b></td>
                                        <td>{{ $dta->nama_poli }}</td>
                                        <td>{{ $dta->dokter ? $dta->dokter->nama : '-' }}</td>
                                        <td>{{ $dta->keterangan }}</td>
                                        <td>
                                            @if ($dta->status_layanan == 'Aktif')
                                                <span class="badge badge-success">{{ $dta->status_layanan }}</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $dta->status_layanan }}</span>
                                            @endif
                                        </td>
                                        <td width="80">
                                            <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target=".modal-edit{{ $dta->id }}" data-toggle1="tooltip"
                                                title="Edit Data"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target=".modal-del{{ $dta->id }}" data-toggle1="tooltip"
                                                title="Hapus Data"><i class="fa fa-trash"></i></button>
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
    <div class="modal modal-add" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Tambah Data Poli</h4>
                </div>
                <div class="modal-body" style="padding: 20px 50px 0 50px">
                    <form method="POST" action="{{ url('admin/store/datapoli') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Poli</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_poli" class="form-control" required="" autocomplete="off"
                                    placeholder="Nama Poli..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Dokter Penanggung Jawab</label>
                            <div class="col-sm-9">
                                <select name="dokter_id" class="form-control" required="">
                                    <option value="">.::Dokter Penanggung Jawab::.</option>
                                    @php
                                        foreach ($dokter as $dtr) {
                                            if ($dtr['id'] == old('dokter_id')) {
                                                $select = 'selected';
                                            } else {
                                                $select = '';
                                            }
                                            echo '<option value="' . $dtr['id'] . '"' . $select . '>' . $dtr['nama'] . '</option>';
                                        }
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea name="keterangan" class="form-control" required="" placeholder="Keterangan.."
                                    rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status Layanan</label>
                            <div class="col-sm-9">
                                <select name="status_layanan" class="form-control" required="">
                                    @php
                                        $status_layanan = ['Aktif', 'Tidak Aktif'];
                                        foreach ($status_layanan as $jnk) {
                                            if ($jnk == old('status_layanan')) {
                                                $select = 'selected';
                                            } else {
                                                $select = '';
                                            }
                                            echo '<option value="' . $jnk . '"' . $select . '>' . $jnk . '</option>';
                                        }
                                    @endphp
                                </select>
                                {{-- <small class="text-warning">Gunakan Kode Poli yang digenerate otomatis untuk login ke dashboard Poli dan Password default adalah <b>12345</b></small> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-default">Simpan</button>
                                <button type="" class="btn btn-primary" data-dismiss="modal"
                                    aria-hidden="true">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($data->all() as $dta)
        <!-- MODAL EDIT -->
        <div class="modal modal-edit{{ $dta->id }}" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Edit Data Poli</h4>
                    </div>
                    <div class="modal-body" style="padding: 20px 50px 0 50px">
                        <form method="POST" action="{{ url('admin/update/datapoli') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kode Poli</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{ $dta->id }}">
                                    <input type="text" class="form-control" required="" autocomplete="off"
                                        placeholder="Kode Poli.." value="{{ $dta->kode_poli }}" readonly="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Poli</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_poli" class="form-control" required=""
                                        autocomplete="off" placeholder="Nama Poli.." value="{{ $dta->nama_poli }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Dokter Penanggung Jawab</label>
                                <div class="col-sm-9">
                                    <select name="dokter_id" class="form-control" required="">
                                        <option value="">.::Dokter Penanggung Jawab::.</option>
                                        @php
                                            foreach ($dokter as $dtr) {
                                                if ($dtr['id'] == $dta->dokter_id) {
                                                    $select = 'selected';
                                                } else {
                                                    $select = '';
                                                }
                                                echo '<option value="' . $dtr['id'] . '"' . $select . '>' . $dtr['nama'] . '</option>';
                                            }
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <textarea name="keterangan" class="form-control" required=""
                                        placeholder="Keterangan.." rows="3">{{ $dta->keterangan }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status Layanan</label>
                                <div class="col-sm-9">
                                    <select name="status_layanan" class="form-control" required="">
                                        @php
                                            $status_layanan = ['Aktif', 'Tidak Aktif'];
                                            foreach ($status_layanan as $jnk) {
                                                if ($jnk == $dta->status_layanan) {
                                                    $select = 'selected';
                                                } else {
                                                    $select = '';
                                                }
                                                echo '<option value="' . $jnk . '"' . $select . '>' . $jnk . '</option>';
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
                                    <button type="" class="btn btn-primary" data-dismiss="modal"
                                        aria-hidden="true">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL HAPUS -->
        <div class="modal modal-del{{ $dta->id }}" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Data</h5>
                    </div>
                    <div class="modal-body">
                        <p>Yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer form-inline">
                        <a href="{{ url('admin/delete/datapoli/' . $dta->id) }}" role="button"
                            class="btn btn-danger">Hapus</a>
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
