$(function(){
  bootstrapEvent();
  pjaxEvent();
});

function bootstrapEvent() {
  // carousel
  $('.myCarousel').carousel();
}

function getCard() {
  var request = {};
  request.parent = $('meta[name="parent"]').attr('content');

  $.get('/api/card/get', request, function(response) {

  });
}

function produceCard() {
  var text = '';
  var i;
  var j;

}
