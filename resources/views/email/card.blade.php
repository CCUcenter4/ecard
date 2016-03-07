@extends('email.init')

@section('content')
<p>
    <b>{{trim($person['reciever_name'])}}({{trim($person['reciever_email'])}})</b>：您好
</p>
<p>從中正大學電子賀卡系統寄送了一封卡片給您</p>
<p>{{trim($person['message'])}}</p>



  <img src="{{url('card/web/'.$card->id)}}"
      width="550"
      height="400"
      border="0"
    >
  <p>我們將永久為您保存這張卡片，不過還是因為儘速前往瀏覽，以免錯過重要訊息</p>

  <p>國立中正大學電子卡片寄送服務</p>
  <a href="https://ecard.ccu.edu.tw">https://ecard.ccu.edu.tw</a>
  <p>Ecard 粉絲團</p>
  <a href="https://www.facebook.com/ccuecard?fref=ts">https://www.facebook.com/ccuecard?fref=ts</a>
  <p>我們還有Ecard專屬的Android App，歡迎前往我們的網站下載</p>
  <img src="{{url('assets/img/web/common/QR_app.jpg')}}"
    style="
      width:250px;
      height:200px;
    "
  >
  <p>CCU&copy;2010-15</p>
@stop


