<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon_1.ico') }}">

    <title>UPT Puskesmas Bontonompo II</title>

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
                            <span><img src="{{ asset('assets/images/logo_sm.png') }}"/> <small>UPT Bontonompo</small></span>
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
                                <a href="{{ url('user/') }}" class="waves-effect"><i class="ti-home"></i> <span> Home </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="{{ url('user/antrian') }}" class="waves-effect"><i class="ti-ticket"></i> <span> Ambil Antrian </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="{{ url('user/rekam-medik') }}" class="waves-effect"><i class="ti-agenda"></i> <span> Rekam Medik Saya </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="{{ url('user/jadwal') }}" class="waves-effect"><i class="ti-time"></i> <span> Lihat Jadwal </span></a>
                            </li>

                            <li class="text-muted menu-title">Data Diri & Akun</li>

                            <li class="has_sub">
                                <a href="{{ url('user/data-diri') }}" class="waves-effect"><i class="ti-id-badge"></i> <span> Data Diri </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="#" class="waves-effect" data-toggle="modal" data-target=".modal-akun"><i class="ti-user"></i> <span> Akun </span></a>
                            </li>


                            <li class="has_sub">
                                <a href="{{ url('user/logout') }}" class="waves-effect"><i class="ti-power-off text-danger"></i> <span> Logout </span></a>
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
                                    <td width="150">No. Rekam Medik</td><td>:</td>
                                    <td>{{ Auth::user()->no_rekam_medik }}</td>
                                </tr>
                                <tr>
                                    <td width="150">NIK</td><td>:</td>
                                    <td>{{ Auth::user()->nik }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td><td>:</td>
                                    <td>{{ Auth::user()->nama }}</td>
                                </tr>
                            </tbody>                            
                        </table>
                        <form method="POST" action="{{ url('user/update/akun') }}" id="edit-akun" hidden="">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No. Rekam Medik</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                    <input type="text" name="no_rekam_medik" class="form-control" required="" autocomplete="off" placeholder="No. Rekam Medik.." value="{{ Auth::user()->no_rekam_medik }}" readonly="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nik" class="form-control" required="" autocomplete="off" placeholder="NIK.." value="{{ Auth::user()->nik }}" readonly="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama" class="form-control" required="" autocomplete="off" placeholder="Nama.." value="{{ Auth::user()->nama }}">
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

        <script>
            $(document).ready(function () {
                $('#datatable').dataTable();

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
            });
        </script>
        @yield('javascript')
    </body>
    </html>