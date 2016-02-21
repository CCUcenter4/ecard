@extends('web.init')

@section('css')
<title>節慶卡片</title>
<link rel="stylesheet" href="{{url('assets/css/web/index.css')}}">
<link rel="stylesheet" href="{{url('assets/css/web/carousel.css')}}">
<link rel="stylesheet" href="{{url('assets/css/web/card.css')}}">

@stop

@section('js')
<script src="{{url('assets/js/web/normal.js')}}"></script>
@stop

@section('content')
@include('web.modal.card')
<input type="hidden" value="{{$parent_id}}" id="parent_id">
<input type="hidden" value="{{$child_id}}" id="child_id">

<!-- Header -->
<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/web">中正大學電子賀卡</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/web">首頁</a></li>
                        <li class="active"><a href="/web/festival/1/1">節慶卡片</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
            <li><a href="/web/person">個人設定頁面</a></li>
            @else
            <li><a data-toggle="modal" data-target="#loginModal">登入</a></li>
            <li><a data-toggle="modal" data-target="#registerModal">註冊</a></li>
            @endif
        </ul>
    </div>
</div>
    </nav>
</div>
</div>

<!-- Card -->
<div id="main" class="container marketing">
    <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
            <div class="list-group">
                @for($i=0; $i<count($list); $i++)
                    @if($list[$i]->child == $active_id)
                    <a href="/web/festival/{{$parent_id}}/{{$list[$i]->child}}" class="list-group-item active">
                    {{$list[$i]->name}}
                    </a>
                    @else
                    <a href="/web/festival/{{$parent_id}}/{{$list[$i]->child}}" class="list-group-item">
                    {{$list[$i]->name}}
                    </a>
                    @endif
                @endfor
            </div>
        </div><!--/.sidebar-offcanvas-->

        <div class="col-xs-12 col-sm-9">
            <p class="pull-right visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
            </p>
            <div class="jumbotron">
                <h1>新年賀卡</h1>
                <p>此區塊為暫定樣式</p>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <a data-toggle="modal" data-target="#card">
                            <img class="featurette-image img-responsive center-block" data-src="holder.js/280x200/auto" alt="Generic placeholder image">
                        </a>
                        <div class="caption">
                            <h3>標題</h3>
                            <p>描述</p>
                            <p><a class="btn btn-default" href="#" role="button"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> 25</a>
                                <a class="btn btn-default" href="#" role="button"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

