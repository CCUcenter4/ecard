$(function(){
  bootstrapEvent();
  getCard();
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
  var imgClass='featurette-image img-responsive center-block thumb';

  text = '<div class="row">';
  for(i=0; i<card_list.length;) {
    for(j=0; j<3 && i<card_list.length; j++, i++) {
      card_id = card_list[i].id;
      card_name = card_list[i].name;

      text += '<div class="col-lg-4 col-md-4 col-sm-6">';
      text += '<div class="thumbnail">';
      text += `<a data-toggle="modal" data-target="#card" class="list" data-card_id="${card_id}">`;
      text += `<img class="${imgClass}" src="/card/web/${card_id}">`;
      text += '</a>';
      text += '<div class="caption">';
      text += `<h3 class="text-left">${card_name}</h3>`;
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
      $('#cardTitle').text(result.name);
      $('#cardName').text(result.name);
      $('#mailTime').text(result.mail_times);
      $('#shareTime').text(result.share_times);
      $('#cardDescription').text(result.description);
      $('#cardAuthor').text(result.author);
      $('#modalCard').attr('src', '/card/web/' + id);
    })
  });

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
    }

    if(!validateEmail.test(data.reciever_email)) {
      toastr['warning']('信箱格式不合');
    }

    return;
    $.post('/api/card/mail/' + id, data, function(result) {
      console.log(result);
      toastr['success']('寄信成功');
    }).fail(function() {
      toastr['error']('寄信失敗');
    });
  });
}
