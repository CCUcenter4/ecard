$(function(){
  $('.group').hide();
  getDataEvent();
  postDataEvent();
  changeEvent();
  btnEvent();
});

var group_data;
var card_data;
var card_detail;


function getDataEvent(){
  $('.category .content').unbind('click');
  $('.category .content').click(function(){
    var data = {};

    data._token = $('meta[name="csrf-token"]').attr('content');
    data.category = $(this).attr('category');

    $.get('/api/card/group', data, function(result){
      console.log(result);
      group_data = result;
      produceGroup(data.category);
      $('.cardContent *').remove();
    });
  });

  $('.group .content').unbind('click');
  $('.group .content').click(function(){
    var data = {};

    data._token   = $('meta[name="csrf-token"]').attr('content');
    data.category = $(this).data('category');
    data.group    = $(this).data('group');

    $.get('/api/card/list', data, function(result){
      console.log(result);
      card_data = result;

      var text;
      text  = '<li id="addCard">';
      text += '<span class="glyphicon glyphicon-plus"></span>';
      text += '</li>';

      $('.cardContent *').remove();
      $('.cardContent').append(text);
      $('#addCard')
        .data('category', data.category)
        .data('group', data.group);
      produceCard();
    });

  });

  $('.thumbFile').unbind('click');
  $('.thumbFile').click(function(){
    var data = {};

    data._token = $('meta[name="csrf-token"]').attr('content');
    data.id = $(this).data('id');

    $.get('/api/card/detail', data, function(result){
      console.log(result);
      card_detail = result;
      $('#cardDetail #updateCardBtn').data('id', data.id);

      emptyDetail();
      insertDetail();
    });

  });
}

function postDataEvent(){
  var thumb_name = {
    'jpg' : 0,
    'png' : 1
  };
  var web_name = {
    'swf' : 0,
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
      url     : '/api/manage/updateCard',
      method  : 'POST',
      data    : data,
      success : function(result){
        console.log(result);
        $('#cardDetail').modal('hide');
        $('.group .content:data(group=="'+data.group+'")').click();
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

    data._token       = $('meta[name="csrf-token"]').attr('content');
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
        $('#cardDetail').modal('hide');
        $('.group .content:data(group=="'+data.group+'")').click();
      },
      fail    : function(){
        alert('新增卡片失敗');
      }
    });
  });

  $('#createCategoryBtn').unbind('click');
  $('#createCategoryBtn').click(function(){
    var data = {};

    data._token = $('meta[name="csrf-token"]').attr('content');
    data.name     = $('input[name="categoryName"]').val();

    $.post('/api/manage/createCategory', data, function(result){
      console.log(result);
      window.location.reload();
    }).fail(function(){
      alert('新增類別失敗');
    });
  });

  $('#updateCategoryBtn').unbind('click');
  $('#updateCategoryBtn').click(function(){
    var data = {};

    data._token   = $('meta[name="csrf-token"]').attr('content');
    data.category = $(this).data('category');
    data.name     = $('input[name="categoryName"]').val();

    $.post('/api/manage/updateCategory', data, function(result){
      console.log(result);
      window.location.reload();
    }).fail(function(){
      alert('更新類別失敗');
    });
  });

  $('#createGroupBtn').unbind('click');
  $('#createGroupBtn').click(function(){
    var data = {};

    data._token   = $('meta[name="csrf-token"]').attr('content');
    data.category = $(this).data('category');
    data.name     = $('input[name="groupName"]').val();

    $.post('/api/manage/createGroup', data, function(result){
      console.log(result);
      $('#groupDialog').modal('hide');
      $('.category span[category="'+data.category+'"]').click();
    }).fail(function(){
      alert('新增群組失敗');
    });
  });

  $('#updateGroupBtn').unbind('click');
  $('#updateGroupBtn').click(function(){
    var data = {};

    data._token   = $('meta[name="csrf-token"]').attr('content');
    data.category = $(this).data('category');
    data.group    = $(this).data('group');
    data.name     = $('input[name="groupName"]').val();

    console.log(data);
    $.post('/api/manage/updateGroup', data, function(result){
      console.log(result);
      $('#groupDialog').modal('hide');
      $('.category span[category="'+data.category+'"]').click();
    }).fail(function(){
      alert('更新群組失敗');
    });
  });

}

function btnEvent(){
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

  $('#addCategory').unbind('click');
  $('#addCategory').click(function(){
    $('#categoryDialog input').val(null);
    $('#categoryDialog .btnWrapper').hide();
    $('#createCategoryWrapper').show();
    $('#categoryDialog').modal('show');
  });

  $('#addGroup').unbind('click');
  $('#addGroup').click(function(){
    $('#groupDialog input').val(null);
    $('#groupDialog .btnWrapper').hide();
    $('#createGroupWrapper').show();
    $('#createGroupBtn').data('category', $(this).data('category'));
    $('#groupDialog').modal('show');
  });

  $('.editCategory').unbind('click');
  $('.editCategory').click(function(){
    var target = $(this).parent().find('.content');

    $('#categoryDialog input').val(_.trim(target.html()));
    $('#categoryDialog .btnWrapper').hide();
    $('#updateCategoryWrapper').show();
    $('#updateCategoryBtn').data('category', target.attr('category'));
    $('#categoryDialog').modal('show');
  });

  $('.editGroup').unbind('click');
  $('.editGroup').click(function(){
    var target = $(this).parent().find('.content');

    $('#groupDialog input').val(_.trim(target.html()));
    $('#groupDialog .btnWrapper').hide();
    $('#updateGroupWrapper').show();
    $('#updateGroupBtn')
      .data('category', target.data('category'))
      .data('group', target.data('group'));
    $('#groupDialog').modal('show');
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

function changeEvent(){
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

  $('input[name="appFile"]').unbind('change');
  $('input[name="appFile"]').change(function(){

  });
}

function produceGroup(category){
  $('.group div').remove();

  var text;
  var i;
  for(i=0; group_data[i]!=null; i++){
    text =  '<div class="listRow">'
    text += '<span class="editGroup editIcon"></span>'
    text += '<span class="content">';
    text += group_data[i]['name'];
    text += '</span>';
    text += '</div>';

    $('.group').append(text);
    $('.group .content:last')
      .data('category', category)
      .data('group', group_data[i]['group']);
  }
  $('#addGroup').data('category', category);

  $('.group').show();
  getDataEvent();
  changeEvent();
  btnEvent();
}

function produceCard(){
  var i;
  var text;
  var temp;
  var format_type = [
    '.jpg',
    '.png'
  ];

  for(i=0; card_data[i]!=null; i++){
    temp = card_data[i]['thumb_type'];
    if(temp==null){
      console.log(card_data[i]['id']);
      continue;
    }
    text='<li class="thumbFile">';
    text+='<span>';
    text+=card_data[i]['name'];
    text+='</span>';
    text+='<div ';
    text+='style="background:url(/card/thumb_file/';
    text+=card_data[i]['id']+format_type[temp];
    text+=');"></div>';
    text+='</li>';

    $('.cardContent').append(text);
    $('.cardContent li:last')
      .data('id', card_data[i]['id']);
  }

  getDataEvent();
  btnEvent();
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

  var thumb_type = [
      '.jpg',
      '.png'
    ];
  if(card_detail['thumb_type']!=null && (card_detail['thumb_type']>-1 && card_detail['thumb_type']<2)){
    text = '<img id="thumbImg" style="background:url(/card/thumb_file/';
    text+= card_detail['id']+thumb_type[card_detail['thumb_type']];
    text+= '); background-size:100% 100%;">';
  }else{
    text = "檔案不存在";
  }
  $('#thumbWrapper').append(text);

  var web_type = [
      '.swf',
      '.jpg',
      '.png',
      '.fla'
    ];
  if(card_detail['file_type']!=null && (card_detail['file_type']>-1 && card_detail['file_type']<4)){
    switch(card_detail['file_type']){
      case 0:
        text =  '<object id="webImg" data="/card/web/'
        text += card_detail['id']+web_type[card_detail['file_type']];
        text += '"></object>'
        break;
      case 1:
        text = '<img id="webImg" style="background:url(/card/web/';
        text+= card_detail['id']+web_type[card_detail['file_type']];
        text+= '); background-size:100% 100%;">';
        break;
      case 2:
        text = '<img id="webImg" style="background:url(/card/web/';
        text+= card_detail['id']+web_type[card_detail['file_type']];
        text+= '); background-size:100% 100%;">';
        break;
      case 3:
        text = "我他媽不知道如何顯示";
        break;
    }
  }else{
    text = "檔案不存在";
  }
  $('#webWrapper').append(text);
}
