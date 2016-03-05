$(function() {
  filePostEvent();
  fileChangeEvent();
});
var card_detail;

function filePostEvent(){
  $('#createCardBtn').unbind('click');
  $('#createCardBtn').click(function(){
    var temp;
    var data = {};
    var web_t   = $('input[name="webFile"]');

    data._token       = $('meta[name="csrf-token"]').attr('content');
    data.parent       = $('#parent').val();
    temp = $('#child').val();
    data.child        = $('#child option[value="' + temp + '"]').data('child_id');
    data.name         = $('#cardName').val();
    data.description  = $('#cardDescription').val();

    if(_.trim(data.name) == '' || _.trim(data.description) == '') {
      alert('所有欄位都必須填寫');
      return;
    }

    if(web_t[0].files[0]==null){
      alert('還沒選擇卡片檔案');
      return;
    }

    temp = web_t[0].files[0].name;
    data.file_extension = temp.substring(temp.lastIndexOf('.')+1).toLowerCase();

    console.log(data);
    $('#cardFileForm').ajaxSubmit({
      url     : '/api/card/create',
      method  : 'POST',
      data    : data,
      success : function(result){
        console.log(result);
        alert('新增卡片成功');
        $('#cardDetail').modal('hide');
        $('#child').change();
      },
      error   : function(){
        alert('新增卡片失敗');
      }
    });
  });

  $('#updateCardBtn').unbind('click');
  $('#updateCardBtn').click(function(){
    var data = {};
    var id = $('input[name="currentEditCardId"]').val();
    var web_t   = $('input[name="webFile"]');
    var temp;

    data._token       = $('meta[name="csrf-token"]').attr('content');
    data.name         = $('#cardName').val();
    data.description  = $('#cardDescription').val();

    if(_.trim(data.name) == '' || _.trim(data.description) == '') {
      alert('所有欄位都必須填寫');
      return;
    }

    if(web_t[0].files[0] != null) {
      data.webFileExist = 1;
      temp = web_t[0].files[0].name;
      data.file_extension = temp.substring(temp.lastIndexOf('.')+1).toLowerCase();
    }else {
      data.webFileExist = 0;
    }

    console.log(data);
    $('#cardFileForm').ajaxSubmit({
      url     : '/api/card/update/' + id,
      method  : 'POST',
      data    : data,
      success : function(result){
        console.log(result);
        alert('更新卡片成功');
        $('#cardDetail').modal('hide');
        $('#child').change();
      },
      fail    : function(){
        alert('更新卡片失敗');
      }
    });
  });

  $('#deleteCardBtn').unbind('click');
  $('#deleteCardBtn').click(function() {
    var id = $('input[name="currentEditCardId"]').val();
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    console.log(id);
    $.post('/api/card/delete/' + id, function(result) {
      alert('刪除成功');
      $('#cardDetail').modal('hide');
        $('#child').change();
    }).fail(function() {
      alert('刪除失敗');
    });
  });
}

function cardModalEvent() {
  $('#addCard').unbind('click');
  $('#addCard').click(function(){
    emptyCardModal();

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

  $('input[name="webFile"]').unbind('change');
  $('input[name="webFile"]').change(function(){
    var size = $(this)[0].files[0].size/1024/1024;
    if(size>=10){
      alert('檔案大小超過10mb');
      $(this).val(null);
      return;
    }

    var name = $(this)[0].files[0].name;
    var file_extension = name.substring(name.lastIndexOf('.')+1).toLowerCase();

    if(file_extension != 'jpg' && file_extension!='png'){
      alert('檔案格式必須是 jpg, png, JPG, PNG');
      $(this).val(null);
      return;
    }

    $('#inputFileName').html(name);
  });
}

function cardBtnEvent() {
  $('#addCard').unbind('click');
  $('#addCard').click(function(){

    $('#cardDetail').modal('show');
    $('#cardDetail .btnWrapper').hide();
    $('#createCardWrapper').show();
  });

  $('.thumbFile').unbind('click');
  $('.thumbFile').click(function(){
    var id = $(this).data('id');
    var data = {} ;
    data._token       = $('meta[name="csrf-token"]').attr('content');

    console.log('card id ' + id);

    $.get('/api/card/detail/' + id, data, function(result) {
      // insert data
      $('#cardName').val(result.name);
      $('#cardDescription').val(result.description);
      $('input[name="currentEditCardId"]').val(id);

      // view
      $('#cardDetail').modal('show');
      $('#cardDetail .btnWrapper').hide();
      $('#updateCardWrapper').show();
    }).fail(function() {
      alert('卡片詳細資料取得失敗');
    })



  });
}

function produceCard(){
  var i;
  var text;
  var temp;
  var id;
  var name;

  for(i=0; card_data[i]!=null; i++){
    id = card_data[i]['id'];
    name = card_data[i]['name'];

    text  = '<li class="thumbFile">';
    text += `<span>${name}</span>`;
    text += `<div style="background:url(/card/web/${id});background-size:cover;">`;
    text += '</div></li>';

    $('.cardContent').append(text);
    $('.cardContent li:last')
      .attr('data-id', id)
      .attr('data-name', name);
  }

  cardBtnEvent();
}

function emptyCardModal() {
  $('#cardName').val(null);
  $('#cardDescription').val(null);
  $('input[name="webFile"]').val(null);
}
