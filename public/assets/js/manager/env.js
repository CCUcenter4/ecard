$(function() {
  getParentList();
});

var parent_data;

function getParentList() {
  $.get('/api/category/parent/get', function(result) {
    console.log(result);
    parent_data = result;
    produceParent();
  });
}

function produceParent() {
  var text = '<option disabled>父元素</option>';
  var i;
  var id;
  var name;

  for(i=0; parent_data[i]!=null; i++) {
    id = parent_data[i]['id'];
    name = parent_data[i]['name'];
    text += `<option value="${id}">${name}</option>`;
  }
  $('#parent').html(text);
}
