$(function(){
  bootstrapEvent();
  pjaxEvent();
});

function bootstrapEvent() {
  // navbar switch
  $('.navbar-nav li').unbind('click');
  $('.navbar-nav li').click(function() {
    $(this).parent()
      .find('li')
      .removeClass('active');
    $(this).addClass('active');
  });

  // carousel
  $('.myCarousel').carousel();
}

function pjaxEvent(){
  $(document).pjax('a', '#main');
  $('#main')
    .on('pjax:start', function() {
      console.log('start');
    })
    .on('pjax:end', function() {
      console.log('end');
    });
}
