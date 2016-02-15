<div id="registerModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">註冊帳號</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline">
                    <div class="form-group">
                        <label class="sr-only" for="RegAccount">RegAccount</label>
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></div>
                            <input type="text" class="form-control" id="RegAccount" placeholder="您的電子郵件地址(將被當作帳號使用)">
                        </div>
                        <br><br>
                        <label class="sr-only" for="RegPassword">RegPassword</label>
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span></div>
                            <input type="text" class="form-control" id="RegPassword" placeholder="您的密碼">
                        </div>
                        <br><br>
                        <label class="sr-only" for="RegName">RegName</label>
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
                            <input type="text" class="form-control" id="RegName" placeholder="您的姓名">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="registerBtn">確認註冊</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
