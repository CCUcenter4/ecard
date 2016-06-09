@extends('web.init')

@section('css')
<meta property="fb:app_id" content="{{$fb_app_id}}">
<meta property="og:title" content="【中正電子卡片系統】{{$card_name}}">
<meta property="og:description" content="{{$card_description}}">
<meta property="og:site_name" content="中正電子卡片系統" />
<meta property="og:image" content="{{url('card/web/'.$card_id)}}">

<link rel="stylesheet" href="{{url('assets/css/web/index.css')}}">
<link rel="stylesheet" href="{{url('assets/css/web/card.css')}}">
<link rel="stylesheet" href="{{url('assets/css/web/carousel.css')}}">
<link rel="stylesheet" href="{{url('assets/css/multiple-select.css')}}">
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

<br><br><br><br><br>
<div id="card" class="container">
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
                @if(Auth::check() && Auth::user()->role != 'user')
                  <li role="mailTool" data-type="multi"><a href="#"><i class="fa fa-copy" aria-hidden="true"></i> <span id="tab_multi_send">大量寄信</span></a></li>
                @endif
              </ul>
              <div class="tab-content">
                <div class="tab-pane active">
                  <div id="informationWrapper">
                    <br>
                    <p id="cardDescription">{{$card_description}}</p>
                    <hr>
                    <!-- <p>

                       <button type="button" class="btn btn-sm btn-primary shareFB" data-from="modal">
                         <i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i><b> </b><b id="shareTime"></b>
                       </button>
                       <button type="button" class="btn btn-sm btn-success" data-from="modal">
                         <i class="fa fa-envelope " aria-hidden="true"></i><b> </b><b id="mailTime"></b>
                       </button>
                       <button type="button" class="btn btn-sm btn-danger like" data-from="modal">
                         <i class="fa fa-heart " aria-hidden="true"></i><b> </b><b id="likeTime"></b>
                       </button>
                       <button type="button" class="btn btn-sm btn-warning collect" data-from="modal">
                         <i class="fa fa-star " aria-hidden="true"></i><b> </b><b id="collectTime"></b>
                       </button>
                     </p>
                     <hr>-->
                  </div>
                  <form id="mailForm" onsubmit="return false;">
                    <br>
                    <div class="form-group" id="reciever_name_Wrapper">
                    </div>
                    <div class="form-group" id="reciever_email_Wrapper">
                      <p class="text-muted"><span class="glyphicon glyphicon-search"></span> 選取聯絡人</p>
                      <select multiple="multiple" id="contactSelect" name="contactSelect[]" >
                        @foreach($contact as $contacts)
                          <option value="{{$contacts->des}}/{{$contacts->email}}">   {{$contacts->des}} 	&lt;{{$contacts->email}}&gt;</option>
                        @endforeach
                      </select>
                      <br> <br> <p class="text-muted"><span class="glyphicon glyphicon-plus"></span> 新增聯絡人</p>
                      <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-user"></span></span>
                        <input id="inputName" type="text" class="form-control" placeholder="請輸入收件人姓名" aria-describedby="sizing-addon3">
                      </div>
                      <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input id="inputEmail" type="text" class="form-control" placeholder="請輸入收件人信箱" aria-describedby="sizing-addon3">
                      </div>
                      <br>
                      <button id="refreshAdd" class="btn btn-sm btn-success">新增聯絡人</button>
                      <br>
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
                  @else
                    <div class="alert alert-info text-center" style="margin-top: 20%;">
                      <h4><span style="color: red;" class="glyphicon glyphicon-heart"></span> </h3>
                      <h4>喜歡這張卡片嗎？</h4>
                      <p>登入後您將享有更多功能</p>
                      <br>
                      <p><a class="btn btn-warning"  data-toggle="modal" data-target="#registerModal">註冊</a> <a class="btn btn-success" data-toggle="modal" data-target="#loginModal">登入</a></p>
                    </div>
                  @endif
                </div>
              </div>
            </div>
        </div>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->
  </div>
</div>
<script src="{{url('assets/js/multiple-select.js')}}"></script>
<script>
  $("#contactSelect").multipleSelect({
    placeholder: "選擇要寄送的聯絡人",
    filter: true
  });
  $("#refreshAdd").click(function() {
    var validateEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!validateEmail.test($("#inputEmail").val())) {
      toastr['warning']('信箱格式不合');
      return;
    }
    var $select = $("select"),
            $inputEmail = $("#inputEmail"),
            $inputName = $("#inputName"),
            valueEmail = $.trim($inputEmail.val()),
            valueName = $.trim($inputName.val()),
            $opt = $("<option />", {
              value: valueName+"/"+valueEmail,
              text: "   "+valueName+" 	<"+valueEmail+">",
            }).attr('selected','selected');
    if (!valueEmail) {
      $inputEmail.focus();
      return;
    }
    $inputEmail.val("");
    $inputName.val("");
    $select.append($opt).multipleSelect("refresh");
    toastr['success']('新增聯絡人成功');
  });
</script>
@stop

