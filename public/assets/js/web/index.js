$(function(){
  bootstrapEvent();
  pjaxEvent();
});

function bootstrapEvent(){
  $('.navbarHref li').unbind('click');
  $('.navbarHref li').click(function() {
    $(this).parent()
      .find('li')
      .removeClass('active');
    $(this).addClass('active');
  });

  $('.myCarousel').carousel();
}

function pjaxEvent(){
  $(document).pjax('.pjax', '#main', function() {
    alert('click');
  });
}
