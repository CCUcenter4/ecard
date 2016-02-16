$(function() {
  getParentList();

  btnEvent();
  postDataEvent();
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
    changeEvent();
    getDataEvent();
  })
}

function getDataEvent(){
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
  $('#createParentBtn').unbind('click');
  $('#createParentBtn').click(function(){
    var data = {};
    data.name = $('#parentName').val();

    $.post('/api/category/parent/create', data, function(result){
      console.log(result);
    }).fail(function(){
      alert('新增父元素失敗');
    });
  });

  $('#updateParentBtn').unbind('click');
  $('#updateParentBtn').click(function(){
    var id = $('#parent').val();
    var data = {};
    data.name     = $('#parentName').val();

    $.put('/api/category/parent/update/' + id, data, function(result){
      console.log(result);
    }).fail(function(){
      alert('更新父元素失敗');
    });
  });

  $('#createChildBtn').unbind('click');
  $('#createChildBtn').click(function(){
    var data = {};
    data.parent = $('#parent').val();
    data.name     = $('#childName').val();

    $.post('/api/category/child/create', data, function(result){
      console.log(result);
    }).fail(function(){
      alert('新增子元素失敗');
    });
  });

  $('#updateChildBtn').unbind('click');
  $('#updateChildBtn').click(function(){
    var id = $('#child').val();
    var data = {};
    data.name     = $('#childName').val();

    console.log(data);
    $.post('/api/category/child/update/' + id, data, function(result){
      console.log(result);
    }).fail(function(){
      alert('更新群組失敗');
    });
  });
}

function changeEvent() {
  $('#parent').unbind('change');
  $('#parent').change(function(){
    var parent_id = $(this).val();

    console.log('parent change');
    $.get('/api/category/child/' + parent_id, function(result){
      console.log(result);
      child_data = result;

      produceGroup(parent_id);
      $('.cardContent *').remove();
    });
  });

  $('#child').unbind('change');
  $('#child').change(function(){
    var parent_id = $('#parent').val();
    var child_id = $(this).val();

    console.log('child change');
    $.get('/api/card/list/' + parent_id + '/' + child_id, data, function(result){
      console.log(result);
      card_data = result;

      /*
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
      */
    });
  });


}

function btnEvent() {
  $('.openParentDialog').unbind('click');
  $('.openParentDialog').click(function(){
    var method = $(this).data('method');

    $('#parentDialog .btnWrapper').hide();
    if(method == 'create') {
      $('#parentName').val(null);
      $('#createParentWrapper').show();
    }else{
      var selected = $('#parent').val();
      if(selected == null) {
        alert('尚未選擇父元素');
        return;
      }
      var inputValue = $('#parent option[value="' + selected + '"]').html();

      $('#parentName').val(inputValue);
      $('#updateParentWrapper').show();
    }
    $('#parentDialog').modal('show');
  });

  $('.openChildDialog').unbind('click');
  $('.openChildDialog').click(function(){
    var method = $(this).data('method');

    $('#childDialog .btnWrapper').hide();
    if(method == 'create') {
      $('#childName').val(null);
      $('#createChildWrapper').show();
    }else{
      var selected = $('#child').val();
      if(selected == null) {
        alert('尚未選擇子元素');
        return;
      }
      var inputValue = $('#child option[value="' + selected + '"]').html();

      $('#childName').val(inputValue);
      $('#updateChildWrapper').show();
    }
    $('#childDialog').modal('show');
  });
}

function produceParent() {
  var text = '<option disabled>父元素</option>';
  var i;

  $('#parent').html(text);
  for(i=0; parent_data[i]!=null; i++) {
    text += '<option value="' + parent_data[i]['id'] + '">' + parent_data[i]['name'] + '</option>';
  }

  $('#parent').html(text);
}

function produceChild(parent_id) {
  var text = '<option disabled>子元素</option>';
  var i;

  $('#child').html(text);
  for(i=0; child_data[i]!=null; i++){
    text += '<option value="' + child_data[i]['id'] + '">' + child_data[i]['name'] + '</option>';
    $('#child').append(text);
    $('#child .content:last')
      .attr('data-parent_id', parent_id)
      .attr('data-child', child_data[i]['child']);
  }
}
