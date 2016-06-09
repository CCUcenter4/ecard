@extends('web.initIndex')

@section('css')
    <title>中正電子賀卡</title>
    <link rel="stylesheet" href="{{url('assets/css/web/indexSpecialize.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/web/carousel.css')}}">
    <style>
        body {
            padding: 0px !important;
        }
        .site-wrapper img {
            -webkit-filter: grayscale(100%); /* Chrome, Safari, Opera */
            filter: grayscale(100%);
        }
    </style>
@stop

@section('js')
    <script src="{{url('assets/js/web/index.js')}}"></script>
@stop

@section('content')

    <!-- Header -->
    <div class="site-wrapper" style="background-image: url('http://ecard.csie.io/card/web/129'); background-size: cover;">
        <div class="site-wrapper-inner">

            <div class="cover-container">

                <div class="navbar-wrapper">
                    <div class="container">
                        <nav class="navbar navbar-inverse navbar-static-top">
                            <div class="container">
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
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="inner cover pull-right col-xs-12">
                    <h4>
                        <span class="glyphicon glyphicon-heart" style="color: red; text-shadow: 0 1px 3px rgba(0,0,0,.5);"></span>
                    </h4>
                    <h5 style="color: #ffffff; text-shadow: 0 1px 3px rgba(0,0,0,.5);">
                        <p>精選</p>
                    </h5>
                    <h1 class="cover-heading" style="color: #ffffff; font-family: Serif; text-shadow: 0 1px 3px rgba(0,0,0,.5);">蓮</h1>
                    <p class="lead" style="color: #fffff0; font-family: Serif; text-shadow: 0 1px 3px rgba(0,0,0,.5);">含苞待放，殷殷期盼</p>
                    <p class="lead">
                        <a href="/web/normal/{{$navbar[0]->id}}/{{$navbar[0]->parent_id}}/{{$navbar[0]->child_id}}" class="btn btn-sm btn-default">
                            <span class="glyphicon glyphicon-thumbs-up"></span> 欣賞更多卡片
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

@stop

