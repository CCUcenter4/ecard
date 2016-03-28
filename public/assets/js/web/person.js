$(function() {
  // init
  btnEvent();
  $('.nav-tabs li:first').click();
});

function getHistory() {
  $.get('/api/person/history', function(result) {
    console.log(result);
    toastr['success']('成功取得歷史紀錄');
  }).fail(function(result) {
    toastr['error']('取得歷史紀錄失敗');
  });
}

function getReservation() {
  $.get('/api/person/reservation/', function(result) {
    console.log(result);
    toastr['success']('成功取得預約紀錄');
    produceReservation(result);
  }).fail(function(result) {
    toastr['error']('取得預約紀錄失敗');
  });
}

function dataEvent() {
  $('.reservation_delete').unbind('click');
  $('.reservation_delete').click(function() {
    var id = $(this).data('id');
    var outside = $(this);
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: `/api/person/reservation/delete/${id}`,
      method: 'delete',
      data: data,
      success: function(result) {
        toastr['success']('刪除預約紀錄成功');
        outside.parent().parent().parent().remove();
      },
      fail: function(result) {
        toastr['error']('刪除預約紀錄失敗');
      }
    });
  });
}

function btnEvent() {
  $('.nav-tabs li').unbind('click');
  $('.nav-tabs li').click(function() {
    var type = $(this).attr('data-type');
    $('.nav-tabs li').removeClass('active');
    $(this).addClass('active');

    if(type == 'reservation') {
      $('#list').html('');
      getReservation();
    }else {
      $('#list').html('');
      getHistory();
    }
  });
}

function produceHistory() {

}

function produceReservation(list) {
  var text = '';
  var i;
  text += `<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">`;

  for(i=0; i<list.length; i++) {
    text += `<div class="panel panel-default">`;
    text += `<div class="panel-heading" role="tab" id="heading${i}">`;
    text += `<h4 class="panel-title">`;
    text += `<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse${i}" aria-expanded="true" aria-controls="collapse${i}">`;
    text += `${_.trim(list[i].reciever_name)} ${_.trim(list[i].reciever_email)}`;
    text += `</a>`;
    text += `</h4>`;
    text += `</div>`;// end heading
    text += `<div id="collapse${i}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading${i}">`;
    text += `<div class="panel-body">`;
    text += `${_.trim(list[i].message)}`;
    text += `<button class="btn btn-danger reservation_delete" data-id="${list[i].id}">刪除</button>`
    text += `</div>`;// end body
    text += `</div>`;
    text += `</div>`;
  }
  text += `</div>`;
  $('#list').append(text);
  $('.collapse').collapse();
  dataEvent();
}

