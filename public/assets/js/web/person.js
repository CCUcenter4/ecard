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
    //toastr['success']('成功取得歷史紀錄');
    if(result != '') {
      produceHistory(result);
    }else {
      toastr['warning']('目前沒有歷史紀錄');
    }
  }).fail(function(result) {
    toastr['error']('取得歷史紀錄失敗');
  });
}

function getCollect() {
  $.get('/api/person/collect', function(result) {
    if(result.length == 0) {
      toastr['warning']('此分類暫無卡片，敬請期待');
    }
    console.log(result);
    card_list = result;

    produceCard();
  });
}
function getReservation() {
  $.get('/api/person/reservation/', function(result) {
    console.log(result);
    //toastr['success']('成功取得預約紀錄');
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
    }else if (type == 'history') {
      getHistory();
    }else if (type == 'like') {
      getLike();
    }else if (type == 'collect') {
      getCollect();
    }
  });
}

function produceHistory(list) {
  var text = '';
  var i;
  //text += `<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">`;
  text += `<table class="table table-hover">`;
  text += `<thead> <tr><td>收件人</td><td>信箱</td><td>卡片名稱</td><td>訊息內容</td><td>寄送時間</td></tr> </thead>`;
  text += `<tbody>`;

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

    text += `<tr><td>${reciever_name}</td><td>${reciever_email}</td><td><a href="/web/card/${card_id}/HISTORY/NONE">${cardName[card_id]}</a></td><td>${message}</td><td>${created_at}</td></tr>`;

    /*text += `<div class="panel panel-default">`;
    text += `<div class="panel-heading" role="tab" id="heading${i}">`;
    text += `<h4 class="panel-title">`;
    text += `<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse${i}" aria-expanded="true" aria-controls="collapse${i}">`;
    text += `收件人:${reciever_name} 信箱:${reciever_email}`;
    text += `</a>`;
    text += `</h4>`;
    text += `</div>`;// end heading
    text += `<div id="collapse${i}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading${i}">`;
    text += `<div class="panel-body">`;
    text += `<p>卡片名稱:<a href="/web/card/${card_id}/HISTORY/NONE">${cardName[card_id]}</a></p>`;
    text += `<p>訊息內容:${message}<p>`;
    text += `<p>寄送時間:${created_at}</p>`;
    text += `</div>`;// end body
    text += `</div>`;
    text += `</div>`;*/
  }
  text += `</tbody>`;
  text += `</table>`;
  //text += `</div>`;

  $('#list').append(text);
 /*
  $('.collapse').collapse();*/
  dataEvent();
}

function produceReservation(list) {
  var text = '';
  var i;
  //text += `<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">`;
  text += `<table class="table table-hover">`;
  text += `<thead> <tr><td>收件人</td><td>信箱</td><td>卡片名稱</td><td>訊息內容</td><td>預約時間</td></tr> </thead>`;
  text += `<tbody>`;

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


    text += `<tr><td>${reciever_name}</td><td>${reciever_email}</td><td><a href="/web/card/${card_id}/RESERVE/NONE">${cardName[card_id]}</a></td><td>${message}</td><td>${mail_time}<button class="btn btn-danger reservation_delete" data-id="${id}">刪除</button></td></tr>`;

    /*
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
    text += `<p>卡片名稱:<a href="/web/card/${card_id}/RESERVE/NONE">${cardName[card_id]}</a></p>`;
    text += `<p>訊息內容:${message}<p>`;
    text += `<p>預約時間:${mail_time}</p>`;
    text += `<button class="btn btn-danger reservation_delete" data-id="${id}">刪除</button>`
    text += `</div>`;// end body
    text += `</div>`;
    text += `</div>`;
    */
  }
  text += `</tbody>`;
  text += `</table>`;
  //text += `</div>`;

  $('#list').append(text);
  /*
  $('.collapse').collapse();*/
  dataEvent();
}

function produceCard() {
  var text;
  var i;
  var j;
  var card_id;
  var card_name;
  var mail_times;
  var share_times;
  var imgClass='featurette-image img-responsive center-block thumb';

  text += `<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">`;
  text = '<div class="row">';
  for(i=0; i<card_list.length;) {
    for(j=0; j<3 && i<card_list.length; j++, i++) {
      card_id = card_list[i].card_id;
      card_name = card_list[i].name;
      mail_times = card_list[i].mail_times;
      share_times = card_list[i].share_times;

      text += '<div class="col-lg-4 col-md-4 col-sm-6">';
      text += '<div class="thumbnail">';
      text += `<a data-toggle="modal" data-target="#card" class="list" data-card_id="${card_id}">`;
      text += `<a href="/web/card/${card_id}/COLLECT/NONE"><img class="${imgClass}" src="/card/web/${card_id}"></a>`;
      text += '</a>';
      text += '<div class="caption">';
      text += `<h3 style="font-size: 140%;" class="text-center">${card_name}</h3>`;
      text += '</div>';//end caption
      text += '</div>';//end thumbnail
      text += '</div>';
    }
  }
  text += '</div>';
  text += `</div>`;
  $('#list').append(text);
  $('.collapse').collapse();
  dataEvent();
}