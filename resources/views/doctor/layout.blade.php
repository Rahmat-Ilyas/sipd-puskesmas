@php
$poli = new App\Models\Poli;
$dokter_id = Auth::user()->id;
$cek_poli = $poli->where('dokter_id', $dokter_id)->where('status_layanan', 'Aktif')->get();

if (count($cek_poli) == 1) {
    $this_poli = $poli->where('dokter_id', $dokter_id)->where('status_layanan', 'Aktif')->first();
    session()->put('poli_id', $this_poli->id);
} else if (count($cek_poli) <= 0) {
    session()->forget('poli_id');
}
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured doctor theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon_1.ico') }}">

    <title>Doctor - UPT Puskesmas Bontonompo II</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
    <link href="{{ asset('assets/plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables -->
    <link href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/datatables/dataTables.colVis.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/datatables/fixedColumns.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js') }} IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js') }} doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="{{ asset('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
        <script src="{{ asset('https://oss.maxcdn.com/libs/respond.js') }}/1.3.0/respond.min.js') }}"></script>
    <![endif]-->

        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        
    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        {{-- <a href="index.html" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Ub<i class="md md-album"></i>ld</span></a> --}}
                        <!-- Image Logo here -->
                        <a href="index.html" class="logo">
                            <i class="icon-c-logo"> <img src="{{ asset('assets/images/logo_sm.png') }}" height="42"/> </i>
                            <span><img src="{{ asset('assets/images/logo_sm.png') }}"/> Doctor Page</span>
                        </a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <span style="font-size: 15px; margin-right: 2px;" class="namaView">
                                            <b>{{ Auth::user()->nama }}</b>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>

                        	<li class="text-muted menu-title">Main Menu</li>

                            <li class="has_sub">
                                <a href="{{ url('doctor/') }}" class="waves-effect"><i class="fa fa-home"></i> <span> Dashboard </span></a>
                            </li>
                            @if (count($cek_poli) > 0)
                            <li class="has_sub">
                                <a href="{{ url('doctor/antrian-pasien') }}" class="waves-effect antrian-pasien"><i class="fa fa-sort-numeric-asc"></i> <span> Antrian Pasien </span></a>
                            </li>
                            @endif

                            <li class="has_sub">
                                <a href="{{ url('doctor/data-pasien') }}" class="waves-effect"><i class="fa fa-wheelchair"></i> <span> Data Pasien </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="{{ url('doctor/riwayat') }}" class="waves-effect"><i class="fa fa-history"></i> <span> Riwayat Pemeriksaan </span></a>
                            </li>

                            @if (count($cek_poli) > 1)
                            <li class="has_sub">
                                <a href="#" class="waves-effect" data-toggle="modal" data-target=".modal-pilih-poli"><i class="fa fa-refresh"></i> <span> Pilih Poli </span></a>
                            </li>
                            @endif

                            <li class="text-muted menu-title">Data Diri & Akun</li>

                            <li class="has_sub">
                                <a href="{{ url('doctor/data-diri') }}" class="waves-effect"><i class="ti-id-badge"></i> <span> Data Diri </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="#" class="waves-effect" data-toggle="modal" data-target=".modal-akun"><i class="ti-user"></i> <span> Akun </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="{{ url('doctor/logout') }}" class="waves-effect"><i class="ti-power-off text-danger"></i> <span> Logout </span></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End --> 



            @yield('content')
        </div>
        <!-- END wrapper -->

        {{-- Modal edit akun --}}
        <div class="modal modal-akun" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Pengaturan Akun</h4>
                    </div>
                    <div class="modal-body" style="padding: 20px 50px 0 50px">
                        <table class="table table-bordered" id="detail-akun">
                            <tbody>
                                <tr>
                                    <td>NIP</td><td>:</td>
                                    <td>{{ Auth::user()->nip }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Lengkap</td><td>:</td>
                                    <td>{{ Auth::user()->nama }}</td>
                                </tr>
                            </tbody>                            
                        </table>
                        <form method="POST" action="{{ url('doctor/update/akun') }}" id="edit-akun" hidden="">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">NIP</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                    <input type="number" name="nip" class="form-control" required="" autocomplete="off" placeholder="NIP.." value="{{ Auth::user()->nip }}" readonly="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama" class="form-control" required="" autocomplete="off" placeholder="Nama Lengkap.." value="{{ Auth::user()->nama }}">
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
                                    <button type="button" class="btn btn-primary" id="btn-batal-edit">Batal</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-right" id="akun-kontrol">
                            <button type="" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Tutup</button>                            
                            <button type="button" class="btn btn-primary" id="btn-edit-akun">Edit Akun</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal pilih poli --}}
        <div class="modal modal-pilih-poli" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Poli Anda</h4>
                    </div>
                    <div class="modal-body" style="padding-bottom: 0px;">
                        <span>Akun anda terkait dengan {{ count($cek_poli) }} poli yang berbeda. Silahkan pilih dan masuk di salah satu poli berikut:</span><br><br>
                        @foreach ($cek_poli as $cpl)
                        <button type="button" class="btn btn-primary btn-lg btn-block m-b-20 chage-poli" data-id="{{ $cpl->id }}">{{ strtoupper($cpl->nama_poli) }}</button>
                        @endforeach
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
        <!-- jQuery  -->
        <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>

        {{-- Data Table --}}
        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>

        <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/dataTables.scroller.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/dataTables.colVis.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/dataTables.fixedColumns.min.js') }}"></script>

        <script src="{{ asset('assets/pages/datatables.init.js') }}"></script>


        <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>

        <script src="{{ asset('assets/plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>

        <!-- Todojs  -->
        <script src="{{ asset('assets/pages/jquery.todo.js') }}"></script>

        <!-- chatjs  -->
        <script src="{{ asset('assets/pages/jquery.chat.js') }}"></script>

        <script src="{{ asset('assets/plugins/peity/jquery.peity.min.js') }}"></script>

        <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.app.js') }}"></script>

        <script src="{{ asset('assets/plugins/notifyjs/js/notify.js') }}"></script>
        <script src="{{ asset('assets/plugins/notifications/notify-metro.js') }}"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

        <script>
            $(document).ready(function () {
                var url = "{{ url('doctor/config') }}";
                var headers = {
                    "Accept": "application/json",
                    "X-CSRF-TOKEN" : "{{ csrf_token() }}"
                }

                $('#datatable').dataTable();
                $(document).tooltip({ selector: '[data-toggle1="tooltip"]' });

                $('#btn-edit-akun').click(function(event) {
                    $('#edit-akun').removeAttr('hidden');
                    $('#detail-akun').attr('hidden', '');
                    $('#akun-kontrol').attr('hidden', '');
                });

                $('#btn-batal-edit').click(function(event) {
                    $('#edit-akun').attr('hidden', '');
                    $('#detail-akun').removeAttr('hidden');
                    $('#akun-kontrol').removeAttr('hidden');
                });

                @if(session('success'))
                $.Notification.autoHideNotify('success', 'top right', 'Berhasil Diproses','{{ session('success') }}');
                @endif

                @if($errors->any())
                @foreach ($errors->all() as $error)
                $.Notification.autoHideNotify('error', 'top right', 'Terjadi Kesalahn','{{ $error }}');
                @endforeach
                @endif

                @if (count($cek_poli) > 1 && !session('poli_id'))
                $('.modal-pilih-poli').modal({ backdrop: 'static', keyboard: false });
                $('.modal-pilih-poli').modal('show');
                @endif

                $('.chage-poli').click(function(event) {
                    var id = $(this).attr('data-id');
                    setSessionPoli(id);

                });

                function setSessionPoli(poli_id) {
                    $.ajax({
                        url     : url,
                        method  : "POST",
                        headers : headers,
                        data    : { 
                            req: 'setSessionPoli',
                            poli_id: poli_id
                        },
                        success : function(data) {
                            // $('.modal-pilih-poli').modal('hide');
                            location.href=window.location.href;
                        }
                    });
                }
            });
        </script>
        @yield('javascript')
    </body>
    </html>