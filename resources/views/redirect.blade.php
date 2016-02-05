<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Redirect Page</title>
  <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
  <center><h1>Redirect Page</h1></center>
    <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
    </fb:login-button>

    <div id="status">
    </div>
<button id="testAPI">testAPI</button>
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="{{url('assets/js/common.js')}}"></script>
  <script src="{{url('assets/js/redirect.js')}}"></script>
</body>
</html>
