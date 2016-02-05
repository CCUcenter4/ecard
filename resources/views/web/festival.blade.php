@extends('web.init')

@section('css')
<title>節慶卡片</title>
<link rel="stylesheet" href="{{url('assets/css/web/index.css')}}">
<link rel="stylesheet" href="{{url('assets/css/web/carousel.css')}}">
@stop

@section('js')
<script src="{{url('assets/js/web/festival.js')}}"></script>
@stop

@section('content')
<div class="navbar-wrapper">
  <div class="container">
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/web">中正大學電子賀卡</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="/web">首頁</a></li>
            <li class="active"><a href="/web/festival">節慶卡片</a></li>
            <li><a href="/web/complex">綜合卡片</a></li>
            <li><a href="/web/school">校慶卡片</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a data-toggle="modal" data-target="#login">登入</a></li>
            <li><a data-toggle="modal" data-target="#reg">註冊</a></li>
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
    <h1>Festival</h1>
  </div>
@stop

