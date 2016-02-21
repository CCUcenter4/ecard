@extends('web.init')

@section('css')
<title>首頁</title>
<link rel="stylesheet" href="{{url('assets/css/web/index.css')}}">
<link rel="stylesheet" href="{{url('assets/css/web/carousel.css')}}">
@stop

@section('js')
<script src="{{url('assets/js/web/index.js')}}"></script>
@stop

@section('content')
<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">中正大學電子賀卡</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbarHref">
                        <li class="active"><a href="/web">首頁</a></li>
                        <li><a href="/web/festival/1/1">節慶卡片</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
            <li><a href="/web/person">個人設定頁面</a></li>
            @else
            <li><a data-toggle="modal" data-target="#loginModal">登入</a></li>
            <li><a data-toggle="modal" data-target="#registerModal">註冊</a></li>
            @endif
        </ul>
    </div>
</div>
    </nav>
</div>
</div>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="myCarousel" data-slide-to="1"></li>
        <li data-target="myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==">
            <div class="carousel-caption">
        First
    </div>
</div>
<div class="item">
    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==">
    <div class="carousel-caption">
        Second
    </div>
</div>
<div class="item">
    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==">
    <div class="carousel-caption">
        Third
    </div>
</div>

<!-- Controls -->
<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>
  </div>

  <div id="main">
      <h1>Index</h1>
  </div>
@stop

