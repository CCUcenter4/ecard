$(function() {
  getParentList();

  categoryBtnEvent();
  categoryEditEvent();
});

var parent_data;
var child_data;
var card_data;

function getParentList() {
  $.get('/api/category/parent/get', function(result) {
    console.log(result);
    parent_data = result;

    produceParent();
    categoryChangeEvent();
    $('#parent').change();
  })
}

function categoryEditEvent() {
  $('#createParentBtn').unbind('click');
  $('#createParentBtn').click(function(){
    var data = {};
    data.name = $('#parentName').val();
    data._token = $('meta[name="csrf-token"]').attr('content');

    if(_.trim(data.name)=='') {
      toastr['warning']('名字不能為空');
      return;
    }
    $.post('/api/category/parent/create', data, function(result){
      console.log(result);
      getParentList();
      $('#parentDialog').modal('hide');
      toastr['success']('新增父元素成功');
    }).fail(function(){
      toastr['error']('新增父元素失敗');
    });
  });

  $('#updateParentBtn').unbind('click');
  $('#updateParentBtn').click(function(){
    var id = $('#parent').val();
    var data = {};
    data.name     = $('#parentName').val();
    data._token = $('meta[name="csrf-token"]').attr('content');

    if(_.trim(data.name)=='') {
      toastr['warning']('名字不能為空');
      return;
    }
    $.post('/api/category/parent/update/' + id, data, function(result){
      console.log(result);
      getParentList();
      $('#parentDialog').modal('hide');
      toastr['success']('更新父元素成功');
    }).fail(function(){
      toastr['error']('更新父元素失敗');
    });
  });

  $('#deleteParentBtn').unbind('click');
  $('#deleteParentBtn').click(function() {
    var id = $('#parent').val();
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.post('/api/category/parent/delete/' + id, data, function(result) {
      console.log(result);
      getParentList();
      $('#parentDialog').modal('hide');
      toastr['success']('刪除父元素成功');
    }).fail(function() {
      toastr['error']('刪除父元素失敗');
    });
  });

  $('#createChildBtn').unbind('click');
  $('#createChildBtn').click(function(){
    var parent_id = $('#parent').val();
    var data = {};
    data.name     = $('#childName').val();
    data._token = $('meta[name="csrf-token"]').attr('content');

    if(_.trim(data.name)=='') {
      toastr['warning']('名字不能為空');
      return;
    }

    $.post('/api/category/child/create/' + parent_id, data, function(result){
      console.log(result);
      $('#parent').change();
      $('#childDialog').modal('hide');
      toastr['success']('新增子元素成功');
    }).fail(function(){
      toastr['error']('新增子元素失敗');
    });
  });

  $('#updateChildBtn').unbind('click');
  $('#updateChildBtn').click(function(){
    var id = $('#child').val();
    var data = {};
    data.name     = $('#childName').val();
    data._token = $('meta[name="csrf-token"]').attr('content');

    if(_.trim(data.name)=='') {
      toastr['warning']('名字不能為空');
      return;
    }
    console.log(data);
    $.post('/api/category/child/update/' + id, data, function(result){
      console.log(result);
      $('#parent').change();
      $('#childDialog').modal('hide');
      toastr['success']('更新子元素成功');
    }).fail(function(){
      toastr['error']('更新子元素失敗');
    });
  });

  $('#deleteChildBtn').unbind('click');
  $('#deleteChildBtn').click(function() {
    var id = $('#child').val();
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.post('/api/category/child/delete/' + id, data, function(result) {
      console.log(result);
      $('#parent').change();
      $('#childDialog').modal('hide');
      toastr['success']('刪除子元素成功');
    }).fail(function() {
      toastr['error']('刪除子元素失敗');
    });
  });
}

function categoryChangeEvent() {
  $('#parent').unbind('change');
  $('#parent').change(function(){
    var parent_id = $(this).val();

    console.log('parent change');
    $.get('/api/category/child/get/' + parent_id, function(result){
      console.log(result);
      child_data = result;

      produceChild(parent_id);
      $('#child').change();
      $('.cardContent *').remove();
    });
  });

  $('#child').unbind('change');
  $('#child').change(function(){
    var parent_id = $('#parent').val();
    var temp = $(this).val();
    var child_id = $('#child option[value="' + temp + '"]').data('child_id');

    if(child_id == null) {
      return;
    }
    console.log(parent_id + ' ' + child_id);
    $.get('/api/card/list/' + parent_id + '/' + child_id, function(result){
      console.log(result);
      card_data = result;

      var text;
      text  = '<li id="addCard">';
      text += '<span class="glyphicon glyphicon-plus"></span>';
      text += '</li>';

      $('.cardContent *').remove();
      $('.cardContent').append(text);

      produceCard();
    });
  });
}

function categoryBtnEvent() {
  $('.openParentDialog').unbind('click');
  $('.openParentDialog').click(function(){
    var method = $(this).data('method');

    $('#parentDialog .btnWrapper').hide();
    if(method == 'create') {
      $('#parentName').val(null);
      $('#createParentWrapper').show();
    }else{
      var selected = $('#parent').val();
      if(selected == null) {
        toastr['warning']('尚未選擇父元素');
        return;
      }
      var inputValue = $('#parent option[value="' + selected + '"]').html();

      $('#parentName').val(inputValue);
      $('#updateParentWrapper').show();
    }
    $('#parentDialog').modal('show');
  });

  $('.openChildDialog').unbind('click');
  $('.openChildDialog').click(function(){
    var method = $(this).data('method');
    var selectedParent = $('#parent').val();
    var selectedChild = $('#child').val();

    $('#childDialog .btnWrapper').hide();
    if(method == 'create') {
      if(selectedParent == null) {
        toastr['warning']('尚未選擇父元素');
        return;
      }
      $('#childName').val(null);
      $('#createChildWrapper').show();
    }else{
      if(selectedChild == null) {
        toastr['warning']('尚未選擇子元素');
        return;
      }
      var inputValue = $('#child option[value="' + selected + '"]').html();

      $('#childName').val(inputValue);
      $('#updateChildWrapper').show();
    }
    $('#childDialog').modal('show');
  });
}

function produceParent() {
  var text = '<option disabled>父元素</option>';
  var i;

  for(i=0; parent_data[i]!=null; i++) {
    text += '<option value="' + parent_data[i]['id'] + '">' + parent_data[i]['name'] + '</option>';
  }

  $('#parent').html(text);
}

function produceChild(parent_id) {
  var text = '<option disabled>子元素</option>';
  var i;

  for(i=0; child_data[i]!=null; i++){
    text += '<option value="' + child_data[i]['id'] + '"';
    text += 'data-child_id="' + child_data[i]['child'] + '">'
    text += child_data[i]['name'] + '</option>';
  }
  $('#child').html(text);
}

