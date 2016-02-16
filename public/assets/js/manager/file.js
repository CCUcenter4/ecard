$(function() {
  filePostEvent();
  fileChangeEvent();
});
var card_detail;

function filePostEvent(){
  var thumb_name = {
    'jpg' : 0,
    'png' : 1
  };
  var web_name = {
    'jpg' : 1,
    'png' : 2
  };

  var name;
  var file_name;

  $('#updateCardBtn').unbind('click');
  $('#updateCardBtn').click(function(){
    var data = {};
    var thumb_t = $('input[name="thumbFile"]');
    var web_t   = $('input[name="webFile"]');
    var app_t   = $('input[name="appFile"]');

    data._token       = $('meta[name="csrf-token"]').attr('content');
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
      url     : '/api/card/update/' + data.id,
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
    var temp;
    var data = {};
    var thumb_t = $('input[name="thumbFile"]');
    var web_t   = $('input[name="webFile"]');
    var app_t   = $('input[name="appFile"]');

    data._token       = $('meta[name="csrf-token"]').attr('content');
    data.parent       = $('#parent').val();
    temp = $('#child').val();
    data.child        = $('#child option[value="' + temp + '"]').data('child_id');
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
      url     : '/api/card/create',
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

function cardModalEvent() {
  $('#addCard').unbind('click');
  $('#addCard').click(function(){
    emptyDetail();

    var text;
    text = '<img id="thumbImg" style="background:url(/card/unknown.jpg); background-size:100% 100%;">';
    $('#cardDetail #thumbWrapper').append(text);

    $('#cardDetail').modal('show');
    $('#cardDetail .btnWrapper').hide();
    $('#createCardWrapper').show();
  });

}

function fileChangeEvent() {
  $('.editIcon').unbind('hover');
  $('.editIcon').hover(function(){
    $(this).removeClass('editIcon').addClass('editIconHover');
  }, function(){
    $(this).addClass('editIcon').removeClass('editIconHover');
  });

  $('input[name="thumbFile"]').unbind('change');
  $('input[name="thumbFile"]').change(function(){
    var size = $(this)[0].files[0].size/1024/1024;
    if(size>=10){
      alert('檔案大小超過10mb');
      $(this).val(null);
      return;
    }

    var name = $(this)[0].files[0].name;
    var file_name = name.substring(name.lastIndexOf('.')+1).toLowerCase();

    if(file_name != 'jpg' && file_name!='png'){
      alert('檔案格式必須是jpg, png');
      $(this).val(null);
      return;
    }

    $('#thumbName').html(name);

    var reader = new FileReader();
    reader.onload = function(){
      var dataURL = reader.result;

      $('#thumbWrapper *').remove();
      var text = '<img id="thumbImg">';
      $('#thumbWrapper').append(text);

      var output  = document.getElementById('thumbImg');
      output.src = dataURL;
    };

    reader.readAsDataURL($(this)[0].files[0]);
  });

  $('input[name="webFile"]').unbind('change');
  $('input[name="webFile"]').change(function(){
    var size = $(this)[0].files[0].size/1024/1024;
    if(size>=10){
      alert('檔案大小超過10mb');
      $(this).val(null);
      return;
    }

    var name = $(this)[0].files[0].name;
    var file_name = name.substring(name.lastIndexOf('.')+1).toLowerCase();

    if(file_name!='swf' && file_name != 'jpg' && file_name!='png'){
      alert('檔案格式必須是swf, jpg, png');
      $(this).val(null);
      return;
    }
  });
}

function cardBtnEvent() {
  $('#addCard').unbind('click');
  $('#addCard').click(function(){
    emptyDetail();

    var text;
    text = '<img id="thumbImg" style="background:url(/card/unknown.jpg); background-size:100% 100%;">';
    $('#cardDetail #thumbWrapper').append(text);

    $('#cardDetail').modal('show');
    $('#cardDetail .btnWrapper').hide();
    $('#createCardWrapper').show();
  });

  $('.thumbFile').unbind('click');
  $('.thumbFile').click(function(){
    var data = {};
    data.id = $(this).data('id');

    console.log('get Detail ' + data.id);
    $.get('/api/card/detail/' + data.id, function(result){
      console.log(result);
      card_detail = result;
      $('#cardDetail #updateCardBtn').data('id', data.id);

      emptyDetail();
      insertDetail();
    });
  });

  $('#thumbBtn').unbind('click');
  $('#thumbBtn').click(function(){
    $('input[name="thumbFile"]').click();
  });

  $('#webBtn').unbind('click');
  $('#webBtn').click(function(){
    $('input[name="webFile"]').click();
  });

  $('#appBtn').unbind('click');
  $('#appBtn').click(function(){
    $('input[name="appFile"]').click();
  });
}

function produceCard(){
  var i;
  var text;
  var temp;

  for(i=0; card_data[i]!=null; i++){
    text  = '<li class="thumbFile">';
    text += '<span>';
    text += card_data[i]['name'];
    text += '</span>';
    text += '<div ';
    text += 'style="background:url(/card/thumb/';
    text += card_data[i]['id'];
    text += ');background-size:cover;"></div></li>';

    $('.cardContent').append(text);
    $('.cardContent li:last')
      .attr('data-id', card_data[i]['id']);
  }

  cardBtnEvent();
}

function emptyDetail(){
  $('.previewWrapper *').remove();
  $('#cardDetail input').val(null);
}

function insertDetail(){
  $('#cardDetail').modal('show');
  $('#cardDetail .btnWrapper').hide();
  $('#updateCardWrapper').show();

  $('input[name="cardName"]').val(card_detail['name']);
  var text;

  text = '<img id="thumbImg" style="background:url(/card/thumb/';
  text+= card_detail['id'];
  text+= '); background-size:100% 100%;">';
  $('#thumbWrapper').append(text);

  text = '<img id="webImg" style="background:url(/card/web/';
  text+= card_detail['id'];
  text+= '); background-size:100% 100%;">';
  $('#webWrapper').append(text);
}
