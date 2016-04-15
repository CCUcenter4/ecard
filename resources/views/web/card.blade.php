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
            <li><a href="/web/logout">登出</a></li>
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
          <img class="center-block" id="modalCard" src="{{url('card/web/'.$card_id)}}">
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4 col-md-4 col-sm-4">

          <h3><span id="cardName">{{$card_name}}</span> <br><small id="cardAuthor">{{$author}}</small></h3>

          <br>

          @if(Auth::check())
          <div>
            <ul class="nav nav-tabs">
              <li role="mailTool" data-type="information" class="active"><a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i> <span id="tab_information">卡片內容</span></a></li>
              <li role="mailTool" data-type="normal" class="active"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> <span id="tab_send">卡片寄送</span></a></li>
              <li role="mailTool" data-type="reservation"><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> <span id="tab_reservation_send">預約寄送</span></a></li>
              @if(Auth::user()->role == 'multimailer' || Auth::user()->role == 'manager')
              <li role="mailTool" data-type="multi"><a href="#"><i class="fa fa-copy" aria-hidden="true"></i> <span id="tab_multi_send">大量寄信</span></a></li>
              @endif
            </ul>
            <div class="tab-content">
              <div class="tab-pane active">
                <div id="informationWrapper">
                  <br>
                  <p id="cardDescription"></p>
                  <hr>
                  <p>
                    <button type="button" class="btn btn-sm btn-primary shareFB" data-from="modal">
                      <i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i><b> </b><b id="shareTime"></b>
                    </button>
                    <button type="button" class="btn btn-sm btn-success" data-from="modal">
                      <i class="fa fa-envelope " aria-hidden="true"></i><b> </b><b id="mailTime"></b>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" data-from="modal">
                      <i class="fa fa-heart " aria-hidden="true"></i><b> 0</b>
                    </button>
                    <button type="button" class="btn btn-sm btn-warning" data-from="modal">
                      <i class="fa fa-star " aria-hidden="true"></i><b> 0</b>
                    </button>
                  </p>
                  <hr>
                </div>
                <form id="mailForm" onsubmit="return false;">
                  <br>
                  <div class="form-group" id="reciever_name_Wrapper">
                    <label class="sr-only" for="reciever_name">收件人姓名</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
                      <input type="text" id="reciever_name" class="form-control" placeholder="請輸入收件人姓名">
                    </div>
                  </div>
                  <div class="form-group" id="reciever_email_Wrapper">
                    <label class="sr-only" for="reciever_email">收件人信箱</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                      <input type="text" id="reciever_email" class="form-control" placeholder="請輸入收件人信箱">
                    </div>
                  </div>
                  <div id="reservationWrapper">
                    <div class="form-group">
                      <label class="sr-only" for="reservation_date">預約時間</label>
                      <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                        <input id="reservation_date" type="date" class="form-control" value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}">
                      </div>
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
                    <br>
                  </div>
                  <div id="multiWrapper">
                    <div class="form-group">
                      <label class="sr-only" for="excel">請選擇檔案</label>
                      <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></div>
                        <input type="file" id="excel" name="excel" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group" id="reciever_message_Wrapper">
                    <label class="sr-only" for="message">想說的話</label>
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-commenting" aria-hidden="true"></i></div>
                      <textarea id="message" class="form-control" rows="10" placeholder="您想跟對方說什麼呢？"></textarea>
                    </div>
                  </div>
                  <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-primary" id="mailBtn"><i class="fa fa-send" aria-hidden="true"></i> 寄送</button>
                    <button type="submit" class="btn btn-primary" id="reservationBtn"><i class="fa fa-clock-o" aria-hidden="true"></i> 預約</button>
                    <button type="submit" class="btn btn-primary" id="multiBtn"><i class="fa fa-copy" aria-hidden="true"></i> 大量寄送</button>
                  </div>
                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->
  </div>
</div>
@stop
