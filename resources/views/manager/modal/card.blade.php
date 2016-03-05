<div id="cardDetail" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="dialogContent">
                    <div>
                        <label for="cardName">卡片名稱：</label>
                        <input class="form-control" type="text" id="cardName">
                    </div>
                    <div>
                        <label for="cardDescription">卡片描述：</label>
                        <textarea id="cardDescription" placeholder="description" class="form-control" style="resize:none;"></textarea>
                    </div>
                    <div>
                        <p>web 卡片<b class="fileType">（限制格式為jpg, png, JPG, PNG）</b></p>
                        <p><b class="fileType">檔案大小不能超過10mb</b></p>
                        <form id="cardFileForm">
                            <input type="file" name="webFile">
                        </form>
                    </div>
                    <div id="updateCardWrapper" class="btnWrapper">
                        <button id="updateCardBtn" class="btn btn-warning">更新</button>
                        <button id="deleteCardBtn" class="btn btn-danger">刪除</button>
                    </div>
                    <div id="createCardWrapper" class="btnWrapper">
                        <button id="createCardBtn" class="btn btn-warning">新增</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


