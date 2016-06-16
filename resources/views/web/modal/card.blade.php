<!-- Modal -->
<div class="modal fade" id="card" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="cardTitle"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <img class="pull-right" id="modalCard" style="width: 100%;">
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">

                        <h3 class="text-center">
                            <span id="cardName"></span>
                            <br><br>
                            <small id="cardAuthor"></small>
                        </h3>

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
                                            <p id="cardDescription"></p>
                                            <hr>
                                            <p class="text-center">
                                                <button type="button" class="btn btn-primary shareFB" data-from="modal" data-toggle="tooltip" data-placement="bottom" title="覺得卡片不錯嗎？分享到 FB 吧">
                                                    <i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i><b> </b><b id="shareTime"></b>
                                                </button>
                                                <button type="button" class="btn btn-success" data-from="modal" data-toggle="tooltip" data-placement="bottom" title="寄這張卡片表達你的祝福～">
                                                    <i class="fa fa-envelope " aria-hidden="true"></i><b> </b><b id="mailTime"></b>
                                                </button>
                                                <button type="button" class="btn btn-danger like" data-from="modal" data-toggle="tooltip" data-placement="bottom" title="喜歡">
                                                    <i class="fa fa-heart " aria-hidden="true"></i><b> </b><b id="likeTime"></b>
                                                </button>
                                                <button type="button" class="btn btn-warning collect" data-from="modal" data-toggle="tooltip" data-placement="bottom" title="收藏">
                                                    <i class="fa fa-star " aria-hidden="true"></i><b> </b><b id="collectTime"></b>
                                                </button>
                                            </p>
                                            <hr>
                                        </div>
                                        <form id="mailForm" onsubmit="return false;">
                                            <br>
                                            <!--<div class="form-group" id="reciever_name_Wrapper">
                                                <label class="sr-only" for="reciever_name">收件人姓名</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                                    <input type="text" id="reciever_name" class="form-control" placeholder="請輸入收件人姓名">
                                                </div>
                                            </div>-->
                                            <div class="form-group" id="reciever_email_Wrapper">
                                                <!--<label class="sr-only" for="reciever_email">收件人信箱</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                                    <input type="text" id="reciever_email" class="form-control" placeholder="請輸入收件人信箱">
                                                </div>-->
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
                                                    <a class="btn btn-sm btn-success" href="{{url('assets/files/contactExcel.pdf')}}" target="_blank">上傳格式請點我看教學</a>
                                                </div>
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
                                                    <textarea id="message" class="form-control" rows="5" placeholder="您想跟對方說什麼呢？"></textarea>
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
</div>
</div>


