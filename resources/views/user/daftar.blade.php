<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon_1.ico') }}">

    <title>Halaman Pendaftaran - UPT Puskesmas Bontonompo II</title>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js') }} IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js') }} doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js') }}/1.3.0/respond.min.js') }}"></script>
    <![endif]-->

    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>

</head>

<body>

    <div class="container row m-t-10">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="card-box">
                <div class="panel-heading">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/logo_sm.png') }}" />
                    </div>
                    <h3 class="text-center"><strong class="text-custom">PENDAFTARAN USER BARU</strong> </h3>
                    <h3 class="text-center">Puskesmas Bontonompo II</h3>
                    <hr style="margin-bottom: -5px;">
                </div>
                <div class="panel-body">
                    <form class="form-horizontal m-t-0" method="POST" action="{{ route('user.daftar.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">NIK</label>
                                    <div class="col-sm-7">
                                        <input type="number" name="nik" class="form-control" required=""
                                            placeholder="NIK.." autocomplete="off" value="{{ old('nik') }}">
                                        @if ($errors->any())
                                            @if ($errors->first('nik') == 'The nik must not be greater than 16 characters.')
                                                <small class="text-danger">NIK yang diinputkan harus 16 karakter</small>
                                            @else
                                                <small class="text-danger">NIK yang anda masukkan sudah
                                                    terdaftar</small>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama Lengkap</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="nama" class="form-control" required=""
                                            placeholder="Nama Lengkap.." autocomplete="off"
                                            value="{{ old('nama') }}">
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
                                                    if ($jnk == old('jenis_kelamin')) {
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
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tempat Lahir</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="tempat_lahir" class="form-control" required=""
                                            placeholder="Tempat Lahir.." autocomplete="off"
                                            value="{{ old('tempat_lahir') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tanggal Lahir</label>
                                    <div class="col-sm-7">
                                        <input type="date" name="tanggal_lahir" class="form-control" required=""
                                            placeholder="Tanggal Lahir.." autocomplete="off"
                                            value="{{ old('tanggal_lahir') }}">
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
                                                    if ($jnk == old('jaminan_kesehatan')) {
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
                                                    if ($jnk == old('status_perkawinan')) {
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
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Password</label>
                                    <div class="col-sm-7">
                                        <input type="password" name="password" class="form-control" required=""
                                            placeholder="Password.." autocomplete="off"
                                            value="{{ old('password') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <hr style="margin-top: 2px;">
                                <div class="form-group">
                                    <button type="submit"
                                        class="btn btn-lg  btn-primary btn-rounded waves-effect waves-light"
                                        style="padding: 10px 50px 10px 50px;">
                                        Daftar Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <p>Sudah punya akun? Silahkan login <a href="{{ url('user/login') }}"
                                class="text-primary m-l-5"><b>disini</b></a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/detect.js') }}"></script>
    <script src="{{ asset('assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>


    <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.app.js') }}"></script>

</body>

</html>
