$(function() {
  getParentList();
  getNavbarList();
  getNotUserList();
  btnEvent();
});

var parent_data;
var navbar_data;
var not_user_data;
var search_data;

function getParentList() {
  $.get('/api/category/parent/get', function(result) {
    console.log(result);
    parent_data = result;
    produceParent();
  });
}

function produceParent() {
  var text = '<option disabled>父元素</option>';
  var i;
  var id;
  var name;

  for(i=0; parent_data[i]!=null; i++) {
    id = parent_data[i]['id'];
    name = parent_data[i]['name'];
    text += `<option value="${id}">${name}</option>`;
  }
  $('#parent').html(text);
}

function getNavbarList() {
  $.get('/api/env/navbar/get', function(result) {
    console.log(result);
    navbar_data = result;
    produceNavbarList();
    btnEvent();
  }).fail(function() {

  });
}

function produceNavbarList() {
  var i;
  var text = '';
  var name;
  var id;
  var short='col-lg-1 col-md-1 col-sm-1 col-xs-1';
  var medium='col-lg-2 col-md-2 col-sm-2 col-xs-2';
  var long='col-lg-9 col-md-9 col-sm-9 col-xs-9';

  for(i=0; navbar_data[i]!=null; i++) {
    id = navbar_data[i].id;
    name = navbar_data[i].name;
    text += '<div class="row" style="padding-bottom:4px;">';
    text += `<div class="${short}"><b>${i+1}</b></div>`;
    text += `<div class="${medium}"><button class="deleteNavbarBtn btn btn-danger" data-id="${id}">刪除</button></div>`;
    text += `<div class="${long}">${name}</div>`;
    text += '</div>';
  }
  $('#navbar').html(text);
}

function getNotUserList() {
  $.get('/api/account/getNotUser', function(result) {
    console.log(result);
    not_user_data = result;
    produceNotUserList();
    btnEvent();
  });
}

function produceNotUserList() {
  var i;
  var text = '';
  var account;
  var type;
  var role;
  var id;
  var short='col-lg-1 col-md-1 col-sm-1 col-xs-1';
  var medium='col-lg-2 col-md-2 col-sm-2 col-xs-2';
  var long='col-lg-9 col-md-9 col-sm-9 col-xs-9';


  for(i=0; not_user_data[i]!=null; i++) {
    id = not_user_data[i].id;
    type = not_user_data[i].type;
    role = not_user_data[i].role;
    account = not_user_data[i].account;

    text += '<div class="row" style="padding-bottom:4px;">';
    text += `<div class="${short}"><b>${i+1}</b></div>`;
    text += `<div class="${medium}"><button class="deleteRoleBtn btn btn-danger" data-id="${id}">刪除</button></div>`;
    text += `<div class="${long}">Account : ${account}<br>Type : ${type}<br>Role : ${role}</div>`;
    text += '</div>';
  }
  $('#notUserList').html(text);
}

function produceSearchList() {
  var i;
  var text = '';
  var account;
  var type;
  var role;
  var id;
  var short='col-lg-1 col-md-1 col-sm-1 col-xs-1';
  var medium='col-lg-2 col-md-2 col-sm-2 col-xs-2';
  var long='col-lg-9 col-md-9 col-sm-9 col-xs-9';


  for(i=0; search_data[i]!=null; i++) {
    id = search_data[i].id;
    type = search_data[i].type;
    account = search_data[i].account;

    text += '<div class="row" style="padding-bottom:4px;">';
    text += `<div class="${short}"><b>${i+1}</b></div>`;
    text += `<div class="${medium}"><button class="addRoleBtn btn btn-primary" data-id="${id}">新增</button></div>`;
    text += `<div class="${long}">Account : ${account}<br>Type : ${type}</div>`;
    text += '</div>';
  }
  $('#searchList').html(text);
}

function btnEvent() {
  $('#createNavbarBtn').unbind('click');
  $('#createNavbarBtn').click(function() {
    var parent_id = $('#parent').val();
    if(parent_id == null) {
      toastr['warning']('還沒選擇父元素');
      return;
    }

    console.log(parent_id);
    $.post('/api/env/navbar/create/' + parent_id, function(result) {
      console.log(result);
      toastr['success']('新增成功');
      getNavbarList();
    }).fail(function() {
      toastr['error']('新增失敗');
    });
  });

  $('.deleteNavbarBtn').unbind('click');
  $('.deleteNavbarBtn').click(function() {
    var id = $(this).data('id');
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: '/api/env/navbar/delete/' + id,
      method: 'delete',
      data: data,
      success: function(result) {
        toastr['success']('刪除成功');
        getNavbarList();
      },
      fail: function() {
        toastr['error']('刪除失敗');
      }
    });
  });

  $('#searchBtn').unbind('click');
  $('#searchBtn').click(function() {
    $('.searchDiv').hide();
    var data = {};
    data.pattern = $('#account').val();

    if(_.trim(data.pattern) == '') {
      toastr['warning']('請輸入欲搜尋帳號名稱');
      return;
    }

    $.post('/api/account/searchUser', data, function(result) {
      console.log(result);
      if(result == '') {
        toastr['warning']('沒有符合條件的搜尋結果');
      }else {
        search_data = result;
        $('.searchDiv').show();
        produceSearchList();
        btnEvent();
      }
    });
  });

  $('.addRoleBtn').unbind('click');
  $('.addRoleBtn').click(function() {
    var id = $(this).data('id');
    var role = $('#role').val();
    var target = $(this);

    $.post(`/api/account/changeRole/${id}/${role}`, function(result) {
      console.log(result);
      toastr['success']('變更成功');
      getNotUserList();
      target.parent().parent().remove();
    }).fail(function() {
      toastr['error']('變更失敗');
    });
  });

  $('.deleteRoleBtn').unbind('click');
  $('.deleteRoleBtn').click(function() {
    var id = $(this).data('id');
    var role = 'user';

    $.post(`/api/account/changeRole/${id}/${role}`, function(result) {
      console.log(result);
      toastr['success']('變更成功');
      getNotUserList();
    }).fail(function() {
      toastr['error']('變更失敗');
    });
  });
}
