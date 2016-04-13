$(function() {
  getParentList();
  getNavbarList();
  btnEvent();
});

var parent_data;
var navbar_data;
var multimail_data;

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

function getMultimailList() {
  $.get('/api/env/multimail/get', function(result) {
    console.log(result);
    multimail_data = result;
    produceMultimailList();
  });
}

function produceMultimailList() {

}

function produceSearchList() {

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
    var data = {};
    data.pattern = $('#account').val();

    if(_.trim(data.pattern) == '') {
      toastr['warning']('請輸入欲搜尋帳號名稱');
      return;
    }

    $.post('/api/env/multimail/search', data, function(result) {
      console.log(result);
    })
  });

  $('.addMultimailBtn').unbind('click');
  $('.addMultimailBtn').click(function() {
    var account_id = $(this).data('account_id');

    $.post('/api/env/multimail/create/' + account_id, function(result) {
      console.log(result);
      toastr['success']('新增成功');
      getNavbarList();
    }).fail(function() {
      toastr['error']('新增失敗');
    });
  });

  $('.deleteMultimailBtn').unbind('click');
  $('.deleteMultimailBtn').click(function() {
    var account_id = $(this).data('account_id');
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: '/api/env/multimail/delete/' + account_id,
      method: 'delete',
      data: data,
      success: function(result) {
        toastr['success']('刪除成功');
        getMultimailList();
      },
      fail: function() {
        toastr['error']('刪除失敗');
      }
    });
  });
}
