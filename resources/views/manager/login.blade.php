@extends('manager.init')

@section('css')
<title>ECARD後台 - 登入</title>
  {!!Html::style('assets/css/manager/login.css')!!}
@stop

@section('js')
@stop

@section('content')
<div class="contentWrapper">
    <form action="/api/auth/login/manager" method="post">
        <div>
            <label for="account">帳號：</label>
            <input id="account" type="text" name="account" placeholder="帳號">
        </div>
        <div>
            <label for="password">密碼：</label>
            <input id="password" type="password" name="password" placeholder="密碼">
        </div>
        <div class="btnWrapper">
            <input type="submit" value="登入" class="btn btn-primary">
        </div>

        <input type="hidden" value="{{csrf_token()}}" name="_token">
    </form>
</div>
@stop
