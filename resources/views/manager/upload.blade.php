@extends('manager.init')

@section('css')
<title>ECARD後台 - 卡片管理</title>
  {!!Html::style('assets/css/manager/upload.css')!!}
  {!!Html::style('assets/css/manager/cardDialog.css')!!}
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<script src="{{url('assets/js/manager/upload.js')}}"></script>
<script src="{{url('assets/js/manager/file.js')}}"></script>
@stop

@section('content')
  @include('manager.cardModal')
  @include('manager.parentModal')
  @include('manager.childModal')
  @include('manager.header')

  <div class="menuWrapper">
    <div class="parent">
      <h3>Category</h3>
      <span id="addParent" class="listBtn"><b>新增大類別</b></span>
      <br>
        <div class="listRow">
          <span class="editParent editIcon"></span>
          <span class="content" category="">
          </span>
        </div>
    </div>
    <div class="child">
      <h3>Group</h3>
      <span id="addChild" class="listBtn"><b>新增子類別</b></span>
      <br>
    </div>
  </div>

  <ul class="cardContent">
  </ul>
@stop

