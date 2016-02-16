<div id="loginModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="loginLabel">登入 E-Card</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline">
                    <div class="form-group">
                        <label class="sr-only" for="From">From</label>
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-cloud" aria-hidden="true"></span></div>
                            <select id="From" class="form-control">
                                <option value="1" selected>Ecard</option>
                                <option value="2">SSO</option>
                            </select>
                        </div>
                        <br><br>
                        <label class="sr-only" for="Account">Account</label>
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
                            <input type="text" class="form-control" id="Account" placeholder="您的帳號">
                        </div>
                        <br><br>
                        <label class="sr-only" for="Password">Password</label>
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span></div>
                            <input type="text" class="form-control" id="Password" placeholder="您的密碼">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" id="loginBtn">登入</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
