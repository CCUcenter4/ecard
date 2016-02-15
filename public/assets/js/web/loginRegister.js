$(function() {
  modalBtnEvent();
});

function modalBtnEvent() {
  $('#loginBtn').unbind('click');
  $('#loginBtn').click(function() {
    var request = {};

    request.account = $('#Account').val();
    request.password = $('#Password').val();

    console.log(request);
    var from = $('#From').val();
    if(from == 1) {// login ecard
      $.post('/api/auth/login/ecard', request, function(result) {
        console.log(result);
      });
    }else if(from == 2) {// login sso

    }
  });

  $('#registerBtn').unbind('click');
  $('#registerBtn').click(function() {
    var request = {};
    request.account = $('#RegAccount').val();
    request.password = $('#RegPassword').val();
    request.name = $('#RegName').val();

    console.log(request);
    $.post('/api/auth/register', request, function(result) {
      console.log(result);
    });
  });
}
