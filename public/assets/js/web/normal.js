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

  for(i=0; i<card_list.length;) {
    text = '<div class="row">';
    for(j=0; j<3 && i<card_list.length; j++, i++) {
      card_id = card_list[i].id;
      card_name = card_list[i].name;

      text += '<div class="col-lg-4 col-md-4 col-sm-6">';
      text += '<div class="thumb_nail">';
      text += `<a data-toggle="modal" data-target="#card" class="list" data-card_id="${card_id}">`;
      text += `<img class="${imgClass}" src="/card/web/${card_id}">`;
      text += '</a>';
      text += '<div class="caption">';
      text += `<h3>${card_name}</h3>`;
      text += '</div>';//end caption
      text += '</div>';//end thumb_nail
      text += '</div>';
    }
    text += '</div>';

    $('#cardContainer').append(text);
  }

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

  });
}
