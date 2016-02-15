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
    @yield('css')

</head>
<body>
    @yield('content')
    @include('web.footer')

@if(Auth::check())

@else
    @include('web.loginModal');
    @include('web.registerModal');
@endif


<!-- JS framework -->
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Bootstrap Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<!-- Lib -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.pjax/1.9.6/jquery.pjax.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js" defer></script>

<!-- Demonic Write -->
<script src="{{url('assets/js/common.js')}}"></script>

  @yield("js")

  </body>
</html>
