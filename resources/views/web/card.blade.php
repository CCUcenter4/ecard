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
<script src="{{url('assets/js/web/card.js')}}"></script>
@stop

@section('content')
<input type="hidden" id="currentCardId" value="{{$card_id}}">

<!-- Header -->
<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/web">中正大學電子賀卡</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        @for($i=0; $i<count($navbar); $i++)
                            <li><a href="/web/normal/{{$navbar[$i]->id}}/1/1">{{$navbar[$i]->name}}</a></li>
                        @endfor
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
                          @if(Auth::check())
                        <hr>
                        <div class="row">
                            <ul class="nav nav-tabs">
                                <li role="mailTool" data-type="normal" class="active"><a href="#">一般</a></li>
                                <li role="mailTool" data-type="reservation"><a href="#">預約</a></li>
                                @if(Auth::check() && Auth::user()->role != 'user')
                                <li role="mailTool" data-type="multi"><a href="#">大量寄信</a></li>
                                @endif
                            </ul>
                            <form id="mailForm" onsubmit="return false;">
                                <div class="col-lg-12">
                                    <label for="reciever_name">收件人姓名</label>
                                    <input type="text" id="reciever_name" placeholder="Name" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="reciever_email">收件人信箱</label>
                                    <input type="text" id="reciever_email" placeholder="Email" class="form-control">
                                </div>
                                    <div id="reservationWrapper">
                                        <div class="col-lg-12">
                                            <label for="reservation_date">預約日期</label>
                                            <input id="reservation_date" type="date" class="form-control" value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-1 col-sm-1"></div>
                                            <div class="col-xs-3 col-sm-3">
                                                <select id="hour" class="form-control">
                                                    <option disabled>小時</option>
                                                    @for($i=0; $i<24; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-xs-3 col-sm-3">
                                                <select id="hour" class="form-control">
                                                    <option disabled>分鐘</option>
                                                    <option>00</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-3 col-sm-3">
                                                <select id="hour" class="form-control">
                                                    <option disabled>秒鐘</option>
                                                    <option>00</option>
                                                </select>
                                            </div>
                                        </div>
                                      </div>
                                      <div id="multiWrapper">
                                        <div class="col-lg-12">
                                          <label for="excel">請選擇檔案</label>
                                          <input type="file" id="excel" name="excel" class="form-control">
                                        </div>
                                      </div>
                                <div class="col-lg-12">
                                    <label for="message">想說的話</label>
                                    <textarea id="message" class="form-control" placeholder="Message" style="resize:none;"></textarea>
                                </div>
                                <br>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-default" id="mailBtn">寄送</button>
                                    <button type="submit" class="btn btn-default" id="reservationBtn">預約</button>
                                    <button type="submit" class="btn btn-default" id="multiBtn">大量寄送</button>
                                </div>
                              </form>
                              @endif
                        </div>
                    </div>
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
        </div>
@stop
