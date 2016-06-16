@extends('web.init')

@section('css')
    <title>個人設定</title>
    <link rel="stylesheet" href="{{url('assets/css/web/index.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/web/person.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/web/normal.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/web/carousel.css')}}">
@stop

@section('js')
    <script src="{{url('assets/js/web/index.js')}}"></script>
    <script src="{{url('assets/js/web/person.js')}}"></script>
@stop

@section('content')
    <!-- Header -->
    <nav class="navbar navbar-inverse navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/web"><span class="glyphicon glyphicon-send text-muted"></span> 中正大學電子賀卡</a>
                </div>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    @for($i=0; $i<count($navbar); $i++)
                        <li>
                            <a href="/web/normal/{{$navbar[$i]->id}}/{{$navbar[$i]->parent_id}}/{{$navbar[$i]->child_id}}">{{$navbar[$i]->name}}</a>
                        </li>
                    @endfor
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        <li><a href="/web/person"><i class="fa fa-cog" aria-hidden="true"></i> 設定</a></li>
                        <li><a href="/web/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> 登出</a></li>
                    @else
                        <li><a data-toggle="modal" data-target="#loginModal"><i class="fa fa-sign-in" aria-hidden="true"></i> 登入</a></li>
                        <li><a data-toggle="modal" data-target="#registerModal"><i class="fa fa-plus" aria-hidden="true"></i> 註冊</a></li>
                    @endif
                </ul>
            </div>
        </div><!--/.container-fluid -->
    </nav>

    <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <ul class="nav nav-tabs">
                <li role="list" data-type="history" class="active"><a href="#">歷史紀錄</a></li>
                <li role="list" data-type="reservation"><a href="#">預約紀錄</a></li>
                <li role="list" data-type="collect"><a href="#">收藏列表</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" id="list"></div>
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" id="collect"></div>
    </div>



@stop

