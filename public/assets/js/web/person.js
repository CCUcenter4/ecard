$(function() {
  // init
  getHistory();
  getReservation();
  btnEvent();
});

function getHistory() {
  $.get('/api/person/history', function(result) {
    console.log(result);
    toastr['success']('成功取得歷史紀錄');
  }).fail(function(result) {
    toastr['error']('取得歷史紀錄失敗');
  });
}

function getReservation() {
  $.get('/api/person/reservation/', function(result) {
    console.log(result);
    toastr['success']('成功取得預約紀錄');
  }).fail(function(result) {
    toastr['error']('取得預約紀錄失敗');
  });
}

function dataEvent() {

}

function btnEvent() {

}

function produceHistory() {

}

function produceReservation() {

}
