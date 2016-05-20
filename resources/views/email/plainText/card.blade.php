由於您的信箱不支援html
系統只能寄給您純文字的郵件
@if(isset($person['reciever_name']) && isset($person['reciever_email']))
    From:{{$person['reciever_name']}} {{$person['reciever_email']}}
@elseif(isset($personName) && isset($personEmail))
    From:{{$personName}} {{$personEmail}}
@endif
{{trim($person['message'])}}
