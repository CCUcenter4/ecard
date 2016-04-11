<!-- Modal -->
<div class="modal fade" id="card" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="cardTitle"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <img class="center-block" id="modalCard">
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h3 id="cardName"></h3>
                        <cite title="Source Title" id="cardAuthor"></cite><br>
                        <p id="cardDescription"></p>
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
                            @if(Auth::check())
                            <ul class="nav nav-tabs">
                                <li role="mailTool" data-type="normal" class="active"><a href="#">一般</a></li>
                                <li role="mailTool" data-type="reservation"><a href="#">預約</a></li>
                                @if(Auth::check() && Auth::user()->role != 'user')
                                <li role="mailTool" data-type="multi"><a href="#">大量寄信</a></li>
                                @endif
                            </ul>
                            @endif
                            <form id="mailForm" onsubmit="return false;">
                                <div class="col-lg-12">
                                    <label for="reciever_name">收件人姓名</label>
                                    <input type="text" id="reciever_name" placeholder="Name" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="reciever_email">收件人信箱</label>
                                    <input type="text" id="reciever_email" placeholder="Email" class="form-control">
                                </div>
                                @if(Auth::check())
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
                                @endif
                                <div class="col-lg-12">
                                    <label for="message">想說的話</label>
                                    <textarea id="message" class="form-control" placeholder="Message" style="resize:none;"></textarea>
                                </div>
                                <br>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-default" id="mailBtn">寄送</button>
                                    @if(Auth::check())
                                    <button type="submit" class="btn btn-default" id="reservationBtn">預約</button>
                                    <button type="submit" class="btn btn-default" id="multiBtn">大量寄送</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
        </div>
    </div>
</div>
</div>


