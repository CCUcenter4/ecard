@extends('web.init')

@section('css')
    <title>
        @for($i=0; $i<count($list); $i++)
            @if($list[$i]->child == $active_id)
                {{$list_name = $list[$i]->name}}
            @endif
        @endfor
    </title>
    <link rel="stylesheet" href="{{url('assets/css/web/index.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/web/carousel.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/web/card.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/web/normal.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/multiple-select.css')}}">

@stop

@section('js')
    <script src="{{url('assets/js/web/normal.js')}}"></script>
@stop

@section('content')
    <input type="hidden" value="{{$navbar_id}}" id="navbar_id">
    <input type="hidden" value="{{$parent_id}}" id="parent_id">
    <input type="hidden" value="{{$child_id}}" id="child_id">
    <input type="hidden" id="currentCardId">

    <!-- Header -->
    <!-- Static navbar -->
    <div class="container">
        <nav class="navbar navbar-inverse navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/web"><span class="glyphicon glyphicon-send text-muted"></span> 中正大學電子賀卡</a>
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




        <!-- Card -->
            <div class="row row-offcanvas row-offcanvas-left">
                <div class="col-xs-12 col-sm-12">
                    <div class="alert alert-success"><strong>端午節快到了！</strong>寄幾張卡片表達你對好友們的關心～</div>
                </div>
                <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
                    <div class="list-group">
                        @for($i=0; $i<count($list); $i++)
                            @if($list[$i]->child == $active_id)
                                <a href="/web/normal/{{$navbar_id}}/{{$parent_id}}/{{$list[$i]->child}}" class="list-group-item active">
                                    {{$list[$i]->name}}
                                    <?php $list_name_date = $list[$i]->festDate; ?>
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
                    <p class="pull-left visible-xs">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="offcanvas"><span class="glyphicon glyphicon-arrow-left"></span> 選單列</button>
                    </p>
                    @if(isset($list_name))
                        <div class="well" >
                            <h2>
                                {{$list_name}}
                                @if(isset($list_name_date) && $list_name_date != '0000-00-00')
                                    <p><small>{{$list_name_date}}</small></p>
                                @endif
                            </h2>
                        </div>
                    @endif
                    <div class="row" id="cardContainer">
                    </div>
                </div>
            </div>
    </div>
    <script src="{{url('assets/js/multiple-select.js')}}"></script>
    <script>
        $("#contactSelect").multipleSelect({
            placeholder: "選擇要寄送的聯絡人",
            filter: true
        });
        $("#refreshAdd").click(function() {
            var validateEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(!validateEmail.test($("#inputEmail").val())) {
                toastr['warning']('信箱格式不合');
                return;
            }
            var $select = $("select"),
                    $inputEmail = $("#inputEmail"),
                    $inputName = $("#inputName"),
                    valueEmail = $.trim($inputEmail.val()),
                    valueName = $.trim($inputName.val()),
                    $opt = $("<option />", {
                        value: valueName+"/"+valueEmail,
                        text: "   "+valueName+" 	<"+valueEmail+">"
                    }).attr('selected','selected');
            if (!valueEmail) {
                $inputEmail.focus();
                return;
            }
            $inputEmail.val("");
            $inputName.val("");
            $select.append($opt).multipleSelect("refresh");
            toastr['success']('新增聯絡人成功');
        });
        $(document).ready(function () {
            $('[data-toggle="offcanvas"]').click(function () {
                $('.row-offcanvas').toggleClass('active')
            });
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

    </script>
@stop
@include('web.modal.card')