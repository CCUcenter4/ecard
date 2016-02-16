<div id="cardDetail" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <form id="cardFileForm">
          <input type="file" name="thumbFile">
          <input type="file" name="webFile">
          <input type="file" name="appFile">
        </form>
        <div class="dialogContent">
          <div>
            <label for="cardName">卡片名稱：</label>
            <input class="form-control" type="text" name="cardName" id="cardName">
          </div>
          <div>
            <p>卡片縮圖<b class="fileType">（限制格式為jpg, png）</b></p>
            <p><b class="fileType">檔案大小不能超過10mb</b></p>
            <button id="thumbBtn" class="btn btn-primary">選擇縮圖檔案</button>
              <!--
            <span id="thumbName"></span>
              -->
            <span id="thumbWrapper" class="previewWrapper"></span>
          </div>
          <div>
            <p>web 卡片<b class="fileType">（限制格式為swf, jpg, png）</b></p>
            <p><b class="fileType">檔案大小不能超過10mb</b></p>
            <button id="webBtn" class="btn btn-primary">選擇卡片檔案</button>
              <!--
              <span id="webName"></span>
              -->
            <span id="webWrapper" class="previewWrapper"></span>
          </div>
          <div>
            <p>app, mobile 卡片<b class="fileType">（限制格式為）</b></p>
            <p><b class="fileType">檔案大小不能超過10mb</b></p>
            <button id="appBtn" class="btn btn-primary">選擇app卡片檔案</button>
              <!--
              <span id="appName"></span>
              -->
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


