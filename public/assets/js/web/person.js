$(function() {
  // init
  btnEvent();
  getCardName();
});

var cardName;

function getCardName() {
  $.get('/api/card/name', function(result) {
    cardName = result;
    $('.nav-tabs li:first').click();
  }).fail(function() {
    toastr['error']('取得卡片名稱');
  });
}

function getHistory() {
  $.get('/api/person/history', function(result) {
    console.log(result);
    toastr['success']('成功取得歷史紀錄');
    if(result != '') {
      produceHistory(result);
    }else {
      toastr['warning']('目前沒有歷史紀錄');
    }
  }).fail(function(result) {
    toastr['error']('取得歷史紀錄失敗');
  });
}

function getReservation() {
  $.get('/api/person/reservation/', function(result) {
    console.log(result);
    toastr['success']('成功取得預約紀錄');
    if(result != '') {
      produceReservation(result);
    }else {
      toastr['warning']('目前沒有預約紀錄');
    }
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

    $('#list').html('');// empty
    if(type == 'reservation') {
      getReservation();
    }else {
      getHistory();
    }
  });
}

function produceHistory(list) {
  var text = '';
  var i;
  text += `<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">`;

  var reciever_name;
  var reciever_email;
  var id;
  var card_id;
  var message;
  var mail_time;
  var created_at;

  for(i=0; i<list.length; i++) {
    reciever_name = _.trim(list[i].reciever_name);
    reciever_email = _.trim(list[i].reciever_email);
    id = list[i].id;
    card_id = list[i].card_id;
    message = _.trim(list[i].message);
    mail_time = list[i].mail_time;
    created_at = list[i].created_at;

    text += `<div class="panel panel-default">`;
    text += `<div class="panel-heading" role="tab" id="heading${i}">`;
    text += `<h4 class="panel-title">`;
    text += `<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse${i}" aria-expanded="true" aria-controls="collapse${i}">`;
    text += `收件人:${reciever_name} 信箱:${reciever_email}`;
    text += `</a>`;
    text += `</h4>`;
    text += `</div>`;// end heading
    text += `<div id="collapse${i}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading${i}">`;
    text += `<div class="panel-body">`;
    text += `<p>卡片名稱:<a href="/web/card/${card_id}">${cardName[card_id]}</a></p>`;
    text += `<p>訊息內容:${message}<p>`;
    text += `<p>寄送時間:${created_at}</p>`;
    text += `</div>`;// end body
    text += `</div>`;
    text += `</div>`;
  }
  text += `</div>`;
  $('#list').append(text);
  $('.collapse').collapse();
  dataEvent();
}

function produceReservation(list) {
  var text = '';
  var i;
  text += `<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">`;

  var reciever_name;
  var reciever_email;
  var id;
  var card_id;
  var message;
  var mail_time;

  for(i=0; i<list.length; i++) {
    reciever_name = _.trim(list[i].reciever_name);
    reciever_email = _.trim(list[i].reciever_email);
    id = list[i].id;
    card_id = list[i].card_id;
    message = _.trim(list[i].message);
    mail_time = list[i].mail_time;

    text += `<div class="panel panel-default">`;
    text += `<div class="panel-heading" role="tab" id="heading${i}">`;
    text += `<h4 class="panel-title">`;
    text += `<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse${i}" aria-expanded="true" aria-controls="collapse${i}">`;
    text += `收件人:${reciever_name} 信箱:${reciever_email}`;
    text += `</a>`;
    text += `</h4>`;
    text += `</div>`;// end heading
    text += `<div id="collapse${i}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading${i}">`;
    text += `<div class="panel-body">`;
    text += `<p>卡片名稱:<a href="/web/card/${card_id}">${cardName[card_id]}</a></p>`;
    text += `<p>訊息內容:${message}<p>`;
    text += `<p>預約時間:${mail_time}</p>`;
    text += `<button class="btn btn-danger reservation_delete" data-id="${id}">刪除</button>`
    text += `</div>`;// end body
    text += `</div>`;
    text += `</div>`;
  }
  text += `</div>`;
  $('#list').append(text);
  $('.collapse').collapse();
  dataEvent();
}

