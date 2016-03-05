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
                            寄送次數 : <b id="mailTime"></b>
                            分享次數 : <b id="shareTime"></b>
                        </p>
                        <hr>
                        <div class="row">
                            <form id="mailForm" onsubmit="return false;">
                                <div class="col-lg-12">
                                    <label for="reciever_email">收件人信箱</label>
                                    <input type="text" id="reciever_email" placeholder="Email" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="message">想說的話</label>
                                    <textarea id="message" class="form-control" placeholder="Message" style="resize:none;"></textarea>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-default" id="mailBtn">Submit</button>
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


