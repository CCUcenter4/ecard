<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="assets/css/favicon.ico">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- bootstrap style plugin-->
        <link rel="stylesheet" href="{{url('assets/css/toastr.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/manager/common.css')}}">

    @yield('css')

</head>
<body>

  @yield('content')

  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <!-- bootstrap style plugin-->
  <script src="{{url('/assets/js/toastr.min.js')}}" defer></script>

  <!-- Lib -->
  <script src="{{url('/assets/js/lodash.min.js')}}" defer></script>
  <script src="{{url('/assets/js/autosize.min.js')}}" defer></script>
  <!-- Demonic Write -->
  <script src="{{url('assets/js/common.js')}}"></script>

  @yield('js')

  </body>
</html>
