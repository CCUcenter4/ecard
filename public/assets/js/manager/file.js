function postFileEvent(){
  var name;
  var file_name;

  $('#updateCardBtn').unbind('click');
  $('#updateCardBtn').click(function(){
    var data = {};
    var thumb_t = $('input[name="thumbFile"]');
    var web_t   = $('input[name="webFile"]');
    var app_t   = $('input[name="appFile"]');

    data.id          = $(this).data('id');
    data.name         = $('input[name="cardName"]').val();
    data.thumb_type   = -1;
    data.web_type     = -1;
    data.app_type     = -1;

    if(thumb_t[0].files[0]!=null){
      name            = thumb_t[0].files[0].name;
      file_name       = name.substring(name.lastIndexOf('.')+1).toLowerCase();
      data.thumb_type = thumb_name[file_name];
    }

    if(web_t[0].files[0]!=null){
      name          = web_t[0].files[0].name;
      file_name     = name.substring(name.lastIndexOf('.')+1).toLowerCase();
      data.web_type = web_name[file_name];
    }

    console.log(data);
    $('#cardFileForm').ajaxSubmit({
      url     : '/api/card/update',
      method  : 'POST',
      data    : data,
      success : function(result){
        console.log(result);
      },
      fail    : function(){
        alert('更新卡片失敗');
      }
    });
  });

  $('#createCardBtn').unbind('click');
  $('#createCardBtn').click(function(){
    var data = {};
    var thumb_t = $('input[name="thumbFile"]');
    var web_t   = $('input[name="webFile"]');
    var app_t   = $('input[name="appFile"]');

    data.category     = $('#addCard').data('category');
    data.group        = $('#addCard').data('group');
    data.name         = $('input[name="cardName"]').val();
    data.thumb_type   = -1;
    data.web_type     = -1;
    data.app_type     = -1;

    if(thumb_t[0].files[0]!=null){
      name            = thumb_t[0].files[0].name;
      file_name       = name.substring(name.lastIndexOf('.')+1).toLowerCase();
      data.thumb_type = thumb_name[file_name];
    }else{
      alert('縮圖不能為空');
      return;
    }

    if(web_t[0].files[0]!=null){
      name          = web_t[0].files[0].name;
      file_name     = name.substring(name.lastIndexOf('.')+1).toLowerCase();
      data.web_type = web_name[file_name];
    }

    console.log(data);
    $('#cardFileForm').ajaxSubmit({
      url     : '/api/manage/createCard',
      method  : 'POST',
      data    : data,
      success : function(result){
        console.log(result);
      },
      fail    : function(){
        alert('新增卡片失敗');
      }
    });
  });
}
