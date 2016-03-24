@extends('web.init')

@section('css')
<meta property="fb:app_id" content="{{$fb_app_id}}">
<meta property="og:title" content="{{$card_name}}">
<meta property="og:description" content="{{$card_description}}">
<meta property="og:image" content="{{url('card/web/'.$card_id)}}">

<link rel="stylesheet" href="{{url('assets/css/web/index.css')}}">
<link rel="stylesheet" href="{{url('assets/css/web/card.css')}}">
@stop

@section('js')
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
                        <li><a href="/web">首頁</a></li>
                        <li><a href="/web/festival/1/1">節慶卡片</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
            <li class="active"><a href="/web/person">個人設定頁面</a></li>
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

<div id="card">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="cardTitle">{{$card_name}}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <img class="center-block" id="modalCard" src="/card/web/{{$card_id}}">
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4 col-md-4 col-sm-4">
                <h3 id="cardName">{{$card_name}}</h3>
                <cite title="Source Title" id="cardAuthor"></cite><br>
                <p id="cardDescription">{{$card_description}}</p>
                <p>
                    <button type="button" class="btn btn-sm btn-primary shareFB" data-from="modal">
                                分享到 FB<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
                            </button>
                        </p>
                        <p>
                            寄送次數 : <b id="mailTime"></b>
                            分享次數 : <b id="shareTime"></b>
                        </p>
                        <hr>
                        <div class="row">
                            <form id="mailForm" onsubmit="return false;">
                                <div class="col-lg-12">
                                    <label for="reciever_name">收件人姓名</label>
                                    <input type="text" id="reciever_name" placeholder="Name" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="reciever_email">收件人信箱</label>
                                    <input type="text" id="reciever_email" placeholder="Email" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="message">想說的話</label>
                                    <textarea id="message" class="form-control" placeholder="Message" style="resize:none;"></textarea>
                                </div>
                                <br>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-default" id="mailBtn">寄送</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
        </div>
@stop
