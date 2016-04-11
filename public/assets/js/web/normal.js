$(function(){
  bootstrapEvent();
  mailEvent();
  getCard();
  $.ajaxSetup({ cache: true  });
  $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
      FB.init({
        appId      : '1680047898922505',
        version: 'v2.5' // or v2.0, v2.1, v2.2, v2.3
      });
    });
});

function bootstrapEvent() {
  // carousel
  $('.myCarousel').carousel();
}

var card_list;
var card_detail;

function getCard() {
  var parent_id = $('#parent_id').val();
  var child_id = $('#child_id').val();

  $.get('/api/card/list/' + parent_id + '/' + child_id, function(result) {
    if(result.length == 0) {
      toastr['warning']('此分類暫無卡片，敬請期待');
    }
    console.log(result);
    card_list = result;

    produceCard();
  });
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

  text = '<div class="row">';
  for(i=0; i<card_list.length;) {
    for(j=0; j<3 && i<card_list.length; j++, i++) {
      card_id = card_list[i].id;
      card_name = card_list[i].name;
      mail_times = card_list[i].mail_times;
      share_times = card_list[i].share_times;

      text += '<div class="col-lg-4 col-md-4 col-sm-6">';
      text += '<div class="thumbnail">';
      text += `<a data-toggle="modal" data-target="#card" class="list" data-card_id="${card_id}">`;
      text += `<img class="${imgClass}" src="/card/web/${card_id}">`;
      text += '</a>';
      text += '<div class="caption">';
      text += `<h3 class="text-left">${card_name}`;
      text += '<span style="float:right;">'
      text += `<b>${mail_times}</b><span class="glyphicon glyphicon-send"></span>`;
      text += `<b>${share_times}</b><span class="glyphicon glyphicon-share-alt"></span>`;
      text += '</span>';
      text += '</h3>';
      text += '</div>';//end caption
      text += '</div>';//end thumbnail
      text += '</div>';
    }
  }
  text += '</div>';
  $('#cardContainer').append(text);

  cardEvent();
}

function cardEvent() {
  $('.list').click(function() {
    var id = $(this).data('card_id');

    $.get('/api/card/detail/' + id, function(result) {
      console.log(result);

      // current Card
      $('#currentCardId').val(id);

      // insert Modal
      $('#cardTitle').text(result.name);
      $('#cardName').text(result.name);
      $('#mailTime').text(result.mail_times);
      $('#shareTime').text(result.share_times);
      $('#cardDescription').text(result.description);
      $('#cardAuthor').text(result.author);
      $('#modalCard').attr('src', '/card/web/' + id);

      // reset type
      $('.nav-tabs li').removeClass('active');
      $('.nav-tabs li:first').addClass('active');
      $('#mailBtn').show();
      $('#reservationWrapper').hide();
      $('#reservationBtn').hide();
      $('#multiWrapper').hide();
      $('#multiBtn').hide();
    })
  });

  $('.shareFB').unbind('click');
  $('.shareFB').click(function() {
    var from = $(this).data('from');
    var id;
    if(from == 'modal') {
      id = $('#currentCardId').val();
    }

    console.log(id);
    FB.ui({
      method: 'share',
      href: 'http://demonic.csie.io:8001/web/card/' + id
    });

    $.post('/api/card/fb_share_increment/' + id, function(result) {

    }).fail(function() {

    });
  });

  $('.nav-tabs li').unbind('click');
  $('.nav-tabs li').click(function() {
    var type = $(this).attr('data-type');
    var nameWrapper = $('#reciever_name').parent();
    var emailWrapper = $('#reciever_email').parent();
    $('.nav-tabs li').removeClass('active');
    $(this).addClass('active');

    if(type == 'reservation') {
      $('#reservationWrapper').show();
      $('#reservationBtn').show();
      nameWrapper.show();
      emailWrapper.show();

      $('#mailBtn').hide();
      $('#multiBtn').hide();
      $('#multiWrapper').hide();
    }else if(type == 'normal'){
      $('#mailBtn').show();
      nameWrapper.show();
      emailWrapper.show();

      $('#reservationWrapper').hide();
      $('#reservationBtn').hide();
      $('#multiBtn').hide();
      $('#multiWrapper').hide();
    }else if(type == 'multi'){
      $('#multiBtn').show();
      $('#multiWrapper').show();

      $('#mailBtn').hide();
      $('#reservationWrapper').hide();
      $('#reservationBtn').hide();
      nameWrapper.hide();
      emailWrapper.hide();
    }
  });
}

function mailEvent() {
  $('#mailBtn').unbind('click');
  $('#mailBtn').click(function() {
    var id = $('#currentCardId').val();
    var validateEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var data = {};
    data.reciever_name = $('#reciever_name').val();
    data.reciever_email = $('#reciever_email').val();
    data.message = $('#message').val();

    if(_.trim(data.reciever_name) == '' || _.trim(data.reciever_email) == '') {
      toastr['warning']('信箱跟姓名欄位都要填');
      return;
    }

    if(!validateEmail.test(data.reciever_email)) {
      toastr['warning']('信箱格式不合');
      return;
    }

    $.post('/api/card/mail/' + id, data, function(result) {
      console.log(result);
      toastr['success']('寄信成功');
    }).fail(function() {
      toastr['error']('寄信失敗');
    });
  });

  $('#reservationBtn').unbind('click');
  $('#reservationBtn').click(function() {
    var id = $('#currentCardId').val();
    var validateEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var data = {};
    data.reciever_name = $('#reciever_name').val();
    data.reciever_email = $('#reciever_email').val();
    data.message = $('#message').val();
    data.mail_time = `${$('#reservation_date').val()} ${$('#hour')}:00:00`;

    if(_.trim(data.reciever_name) == '' || _.trim(data.reciever_email) == '') {
      toastr['warning']('信箱跟姓名欄位都要填');
      return;
    }

    if(!validateEmail.test(data.reciever_email)) {
      toastr['warning']('信箱格式不合');
      return;
    }

    $.post('/api/person/reservation/create/' + id, data, function(result) {
      console.log(result);
      toastr['success']('預約成功');
    }).fail(function() {
      toastr['error']('預約失敗');
    });
  });

  $('#multiBtn').unbind('click');
  $('#multiBtn').click(function() {
    var id = $('#currentCardId').val();
    var data = {};
    data._token = $('meta[name="csrf-token"]').attr('content');
    data.message = $('#message').val();

    if($('#excel')[0].files[0] == null) {
      toastr['warning']('需選擇檔案');
      return;
    }

    console.log(data);
    $('#mailForm').ajaxSubmit({
      url: '/api/card/multiMail/' + id,
      method: 'POST',
      data: data,
      success: function(result) {
        console.log(result);
        toastr['success']('大量寄送成功');
      },
      fail: function() {
        toastr['error']('解析excel失敗');
      }
    });
  });
}
