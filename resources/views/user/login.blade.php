<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon_1.ico') }}">

    <title>Login User - UPT Puskesmas Bontonompo II</title>

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

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class=" card-box">
                <div class="panel-heading"> 
                    <div class="text-center">
                        <img src="{{ asset('assets/images/logo_sm.png') }}"/>
                    </div>
                    <h3 class="text-center"><strong class="text-custom">LOGIN USER</strong> </h3>
                    <h3 class="text-center">Puskesmas Bontonompo II</h3>
                </div> 


                <div class="panel-body">
                    <form class="form-horizontal m-t-0" method="POST" action="{{ route('user.login.submit') }}">
                        @csrf
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <label class="form-label">NIK / No. Rekam Medik</label>
                                <input class="form-control" type="text" name="username" required="" placeholder="NIK / No. Rekam Medik..." value="{{ old('username') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" name="password" required="" placeholder="Password..." value="{{ old('password') }}">
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-signup" type="checkbox" name="remember">
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>
                                
                            </div>
                        </div>

                        @if ($errors->has('error'))
                        <div class="col-12">
                            <span class="text-danger">{{ $errors->first('error') }}</span>
                        </div>
                        @endif
                        
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-default btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                    </form> 
                    
                </div>   
                <div class="row">
                    <div class="col-sm-12 text-center">
                      <p>Belum punya akun? Silahkan daftar <a href="{{ url('user/daftar') }}" class="text-primary m-l-5"><b>disini</b></a></p>

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

    <script src="{{ asset('assets/plugins/notifyjs/js/notify.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/notify-metro.js') }}"></script>


    <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.app.js') }}"></script>

    <script>
        @if(session('success'))
        $.Notification.autoHideNotify('success', 'top right', 'Pendaftaran Berhasil','{{ session('success') }}');
        @endif
    </script>

</body>
</html>