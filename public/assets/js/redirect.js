$(function() {
  $.ajaxSetup({ cache: true  });
  $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
      FB.init({
        appId      : '1680047898922505',
        version: 'v2.5' // or v2.0, v2.1, v2.2, v2.3
      });
      });
});
