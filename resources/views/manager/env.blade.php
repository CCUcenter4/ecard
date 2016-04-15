@extends('manager.init')

@section('css')
<title>ECARD後台 - 環境設定</title>
<link rel="stylesheet" href="{{url('assets/css/manager/env.css')}}">
  {!!Html::style('assets/css/manager/upload.css')!!}
@stop

@section('js')
<script src="{{url('assets/js/manager/env.js')}}"></script>
@stop

@section('content')
  @include('manager.header')
@if(Auth::user()->role != 'manager')
<h1>請先登入管理者帳號</h1>
<center><a href="{{url('manager/login')}}">登入</a></center>
@else

  <div class="row">
      <div class="col-sm-1 col-md-1 col-lg-1"></div><!-- space -->
      <div class="col-sm-3 col-md-3 col-lg-3">
          <h3>NavBar 設定</h3>
      </div>
  </div>
  <div class="row">
      <div class="col-sm-1 col-md-1 col-lg-1"></div><!-- space -->
      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
          <button id="createNavbarBtn" class="btn btn-primary">新增</button>
          <select id="parent" class="form-control"></select>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="navbar">
      </div>
  </div>

  <div class="row">
      <div class="col-sm-1 col-md-1 col-lg-1"></div><!-- space -->
      <div class="col-sm-3 col-md-3 col-lg-3">
          <h3>帳號權限 設定</h3>
      </div>
  </div>
  <div class="row">
      <div class="col-sm-1 col-md-1 col-lg-1"></div><!-- space -->
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <input type="text" class="form-control" id="account" placeholder="欲搜尋帳號">
      </div>
      <div class="col-sm-3 col-md-3 col-lg-3">
          <button id="searchBtn" class="btn btn-primary">搜尋</button>
      </div>
  </div>
  <br>
  <div class="row searchDiv">
      <div class="col-sm-1 col-md-1 col-lg-1"></div><!-- space -->
      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
          <select id="role" class="form-control">
            <option disabled>權限 (新增權限時使用)</option>
            <option value="designer">designer</option>
            <option value="multimailer">multimailer</option>
        </select>
      </div>
  </div>
  <div class="row searchDiv">
      <div class="col-lg-12" id="searchList"></div>
  </div>

  <div class="row">
      <div class="col-sm-1 col-md-1 col-lg-1"></div><!-- space -->
      <div class="col-sm-3 col-md-3 col-lg-3">
          <h3>有權限的帳號列表</h3>
      </div>
  </div>
  <div class="row">
      <div class="col-lg-12" id="notUserList"></div>
  </div>
  @endif
@stop

