@extends('web.initIndex')

@section('css')
    <title>首頁</title>
    <link rel="stylesheet" href="{{url('assets/css/web/index.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/web/carousel.css')}}">
@stop

@section('js')
    <script src="{{url('assets/js/web/index.js')}}"></script>
@stop

@section('content')
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
                                <li><a href="/web/normal/{{$navbar[$i]->id}}/1/1">{{$navbar[$i]->name}}</a></li>
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

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="myCarousel" data-slide-to="0" class="active"></li>
            @for($i = 1; $i < 10 ; $i++)
                <li data-target="myCarousel" data-slide-to="{{$i}}"></li>
            @endfor
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{{url('card/web/'.$popular[0]->id)}}" style="height: auto !important;">
                <div class="carousel-caption">
                    {{$popular[0]->description}}
                </div>
            </div>
            @for($i = 1; $i < 10 ; $i++)
                <div class="item">
                    <img src="{{url('card/web/'.$popular[$i]->id)}}" style="height: auto !important;">
                    <div class="carousel-caption">
                        {{$popular[$i]->description}}
                    </div>
                </div>
            @endfor
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div id="main">
    </div>
@stop

