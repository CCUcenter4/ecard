<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
    <link rel="icon" href="assets/css/favicon.ico">
  -->


    <!-- Bootstrap Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- bootstrap style plugin-->
    <link rel="stylesheet" href="{{url('assets/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/icon_css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/web/common.css')}}">
    <!-- JS framework -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    @yield('css')

</head>
<body style="background-color: #e7e7e7;">
<div class="container">
    @yield('content')
</div>


@if(Auth::check())

@else
    @include('web.modal.login')
    @include('web.modal.register')
@endif



<!-- Bootstrap Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!-- bootstrap style plugin-->
<script src="{{url('/assets/js/toastr.min.js')}}" defer></script>

<!-- Lib -->
<script src="{{url('/assets/js/lodash.min.js')}}" defer></script>
<script src="{{url('/assets/js/autosize.min.js')}}" defer></script>
<script src="{{url('assets/js/jquery.form.min.js')}}"></script>

<!-- Demonic Write -->
<script src="{{url('assets/js/common.js')}}"></script>

<!-- FB -->
<script>
  $.ajaxSetup({ cache: true  });
  $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
      FB.init({
          appId      : '1173354366022486',
          version: 'v2.5' // or v2.0, v2.1, v2.2, v2.3
      });
  });
</script>

@if(Auth::check())
@else
    <script src="{{url('assets/js/web/loginRegister.js')}}"></script>
@endif
@yield("js")

</body>
</html>
