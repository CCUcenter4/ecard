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

      text += '<div class="col-lg-4">';
      text += '<a data-toggle="modal" data-target="#card">';
      text += `<img class="${imgClass}" src="/card/thumb/${card_id}">`;
      text += '</a>';
      text += `<h3>${card_name}</h3>`;
      text += '</div>';
    }
    text += '</div>';

    $('#main').append(text);
  }
}
