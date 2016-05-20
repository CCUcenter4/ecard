@extends('email.init')

@section('content')
<p>
  @if(isset($person['reciever_name']) && isset($person['reciever_email']))
    <b>{{trim($person['reciever_name'])}}({{trim($person['reciever_email'])}})</b>：您好
    @elseif(isset($personName) && isset($personEmail))
    <b>{{trim($personName)}}({{trim($personEmail)}})</b>：您好
  @endif
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
  <p>CCU&copy</p>
@stop


