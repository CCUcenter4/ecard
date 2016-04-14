@extends('web.init')

@section('css')
    <title>
        @for($i=0; $i<count($navbar); $i++)
            @if($navbar[$i]->id == $navbar_id)
                {{$navbar[$i]->name}} - {{$navbar[$i]->child_name}}
            @endif
        @endfor
    </title>
    <link rel="stylesheet" href="{{url('assets/css/web/index.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/web/carousel.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/web/card.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/web/normal.css')}}">

@stop

@section('js')
    <script src="{{url('assets/js/web/normal.js')}}"></script>
@stop

@section('content')
    @include('web.modal.card')
    <input type="hidden" value="{{$navbar_id}}" id="navbar_id">
    <input type="hidden" value="{{$parent_id}}" id="parent_id">
    <input type="hidden" value="{{$child_id}}" id="child_id">
    <input type="hidden" id="currentCardId">

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
                            @for($i=0; $i<count($navbar); $i++)
                                @if($navbar_id == $navbar[$i]->id)
                                    <li class="active">
                                        <a href="/web/normal/{{$navbar[$i]->id}}/{{$navbar[$i]->parent_id}}/{{$navbar[$i]->child_id}}">{{$navbar[$i]->name}}</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="/web/normal/{{$navbar[$i]->id}}/{{$navbar[$i]->parent_id}}/{{$navbar[$i]->child_id}}">{{$navbar[$i]->name}}</a>
                                    </li>
                                @endif
                            @endfor
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            @if(Auth::check())
                                <li><a href="/web/person">個人設定頁面</a></li>
                                <li><a href="/web/logout">登出</a></li>
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
                            <a href="/web/normal/{{$navbar_id}}/{{$parent_id}}/{{$list[$i]->child}}" class="list-group-item active">
                                {{$list[$i]->name}}
                            </a>
                        @else
                            <a href="/web/normal/{{$navbar_id}}/{{$parent_id}}/{{$list[$i]->child}}" class="list-group-item">
                                {{$list[$i]->name}}
                            </a>
                        @endif
                    @endfor
                </div>
            </div><!--/.sidebar-offcanvas-->

            <div class="col-xs-12 col-sm-9">
                <div class="row" id="cardContainer">
                </div>
            </div>
        </div>
    </div>
@stop

