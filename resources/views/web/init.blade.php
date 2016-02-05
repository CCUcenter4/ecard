<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
      <link rel="icon" href="assets/css/favicon.ico">
      -->


      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    @yield('css')

  </head>
  <body>

    <div id="spinTarget"></div>
    <div id="visibleMask"></div>
    @yield('content')

    @include('web.loginModal');
    @include('web.registerModal');

  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  <!-- Lib -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.pjax/1.9.6/jquery.pjax.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/spin.js/2.3.2/spin.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js" defer></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.2/toastr.min.js" defer></script>

  <!-- Demonic Write -->
  <script src="{{url('assets/js/common.js')}}"></script>
  <script src="{{url('assets/js/fb_login.js')}}"></script>

  @yield("js")

  </body>
</html>
