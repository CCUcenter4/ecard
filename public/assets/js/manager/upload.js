$(function() {
  getParentList();
});

var parent_data;
var child_data;
var card_data;
var card_detail;

function getParentList() {
  $.get('/api/category/parent/get', function(result) {
    console.log(result);
    parent_data = result;

    produceParent();
    getDataEvent();
  })
}

function getDataEvent(){
  $('.parent .content').unbind('click');
  $('.parent .content').click(function(){
    var parent_id = $(this).data('parent');

    $.get('/api/category/child/' + parent_id, function(result){
      console.log(result);
      child_data = result;

      produceGroup(parent_id);
      $('.cardContent *').remove();
    });
  });

  $('.child .content').unbind('click');
  $('.child .content').click(function(){
    var parent_id = $(this).data('parent');
    var child_id = $(this).data('child');

    $.get('/api/card/list/' + parent_id + '/' + child_id, data, function(result){
      console.log(result);
      card_data = result;

      var text;
      text  = '<li id="addCard">';
      text += '<span class="glyphicon glyphicon-plus"></span>';
      text += '</li>';

      $('.cardContent *').remove();
      $('.cardContent').append(text);
      $('#addCard')
        .attr('data-parent', parent_id)
        .attr('data-child', child_id);

      produceCard();
    });
  });

  $('.thumbFile').unbind('click');
  $('.thumbFile').click(function(){
    var card_id = $(this).data('card_id');

    $.get('/api/card/get/' + card_id, function(result){
      console.log(result);
      card_detail = result;
      $('#cardDetail #updateCardBtn').attr('data-card_id', card_id);

      emptyDetail();
      insertDetail();
    });
  });
}


function postDataEvent() {

}

function changeEvent() {

}

function produceParent() {

}

function produceChild(parent_id) {
  $('.child div').remove();

  var text;
  var i;
  for(i=0; child_data[i]!=null; i++){
    text =  '<div class="listRow">'
    text += '<span class="editchild editIcon"></span>'
    text += '<span class="content">';
    text += child_data[i]['name'];
    text += '</span>';
    text += '</div>';

    $('.child').append(text);
    $('.child .content:last')
      .attr('data-parent_id', parent_id);
      .attr('data-child', child_data[i]['child']);
  }

  $('#addChild').attr('data-parent_id', parent_id);

  $('.child').show();
  getDataEvent();
  changeEvent();
  btnEvent();

}
