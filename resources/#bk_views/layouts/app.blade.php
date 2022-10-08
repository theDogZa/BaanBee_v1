<!DOCTYPE html>
<html lang="en">
@include('partials._head')
<body class="nav-md" >
    <!-- Simple splash screen-->
<!-- <div class="splash"> <div class="color-line"></div><div class="splash-title"><h1><?php echo 'nameeeee'; ?></h1><p><?php echo 'Loading'; ?>.... </p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div> -->
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="container body">
    <div class="main_container">
    {{--top nav--}}
        @include('partials._sidenav')
    {{--/topnav--}}

    <!-- top navigation -->
    @include('partials._topnav')
    <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" >
            @if( _get_controller()!='home' && _get_controller()!='profiles')
                @include('partials._secondtopnav')
            @endif
            <div class="page-title">
                <div class="title_left">
                    <h3>@yield('title')</h3>
                </div>

                <div class="pull-right" style="padding-top:10px;">
                    @yield('title-right')
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="data-pjax">
                @yield('content')
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
    @include('partials._footer')
    <!-- /footer content -->
    </div>
</div>


  @stack('scripts')
    <!-- app Theme Scripts -->
    <script src="{{asset('js/app.js')}}"></script>
    {{--Scripts--}}
    @yield('scripts')   
    <script src="{{asset('js/core.js')}}"></script>
    @include('partials._notification')
    @yield('styles_2')
</body>
</html>
<style>

    /* Splash style */
.splash {
  position: fixed;
  z-index: 99999;
  background: white;
  color: gray;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
}
.splash-title {
  text-align: center;
  max-width: 500px;
  margin: 15% auto;
  padding: 20px;
}
.splash-title h1 {
  font-size: 26px;
}
.spinner {
  margin: 20px auto;
  width: 60px;
  height: 50px;
  text-align: center;
  font-size: 15px;
}
.spinner > div {
  background-color: #62cb31;
  height: 100%;
  width: 8px;
  display: inline-block;
  -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
  animation: sk-stretchdelay 1.2s infinite ease-in-out;
}
.spinner .rect2 {
  -webkit-animation-delay: -1.1s;
  animation-delay: -1.1s;
}
.spinner .rect3 {
  -webkit-animation-delay: -1s;
  animation-delay: -1s;
}
.spinner .rect4 {
  -webkit-animation-delay: -0.9s;
  animation-delay: -0.9s;
}
.spinner .rect5 {
  -webkit-animation-delay: -0.8s;
  animation-delay: -0.8s;
}
@-webkit-keyframes sk-stretchdelay {
  0%,
  40%,
  100% {
    -webkit-transform: scaleY(0.4);
  }
  20% {
    -webkit-transform: scaleY(1);
  }
}
@keyframes sk-stretchdelay {
  0%,
  40%,
  100% {
    transform: scaleY(0.4);
    -webkit-transform: scaleY(0.4);
  }
  20% {
    transform: scaleY(1);
    -webkit-transform: scaleY(1);
  }
}
</style>
<script>
  $(window).bind("load", function () {
    // Remove splash screen after load
   // $('.splash').css('display', 'none');
    // $('.container').css('display', 'block');
   // container
  });
</script>