{{--@extends('Admin.common')--}}
@extends('adminlte::page')

@section('title', 'Dashboard')

{{--@section('content_header')--}}
    {{--<h1>管理员列表</h1>--}}
{{--@stop--}}

@section('content')
    <table class="table table-bordered table-striped dataTable" >
        @foreach($buttons as $key => $button)
            <h3>
            @if(!empty($button)&&$button==1)
                <a href="{{url("admin/add")}}" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-plus">添加管理员</span>
                </a>
            @endif
            </h3>
        @endforeach

            <tr>
            <td>用户ID</td>
            <td>用户名</td>
            <td>手机号</td>
            <td>用户状态</td>
            <td>操作</td>
        </tr>
        @foreach($users as $key => $user)
            <tr>
                <td>{{$user['uid']}}</td>
                <td>{{$user['uname']}}</td>
                <td>{{$user['mobile']}}</td>
                <td>{{$user['is_freeze']?'可用':'冻结'}}</td>
                <td>
                    @foreach($buttons as $key => $button)
                        @if(!empty($button)&&$button==2)
                            <a href="{{url("admin/doUpdate?uid=$user[uid]")}}">
                                <button type="button" class="btn btn-default btn-sm" style="background-color:green;color:#fff">
                                    <span class="glyphicon glyphicon-edit"></span>编辑
                                </button>
                            </a>
                        @else
                            <a href="{{url("admin/doUpdate?uid=$user[uid]")}}" hidden>
                                <button type="button" class="btn btn-default btn-sm" style="background-color:green;color:#fff">
                                    <span class="glyphicon glyphicon-edit"></span>编辑
                                </button>
                            </a>
                        @endif
                    @endforeach
                     |
                    @foreach($buttons as $key => $button)
                        @if(!empty($button)&&$button==3)
                            <a href="{{url("admin/doDelete?uid=$user[uid]")}}">
                                <button type="button" class="btn btn-default btn-sm" style="background-color:red;color:#fff" >
                                    <span class="glyphicon glyphicon-trash"></span>删除
                                </button>
                            </a>
                        @else
                            <a href="{{url("admin/doDelete?uid=$user[uid]")}}" hidden>
                                <button type="button" class="btn btn-default btn-sm" style="background-color:red;color:#fff" >
                                    <span class="glyphicon glyphicon-trash"></span>删除
                                </button>
                            </a>
                        @endif
                    @endforeach
                </td>
            </tr>
        @endforeach
    </table>
@stop

@section('css')
@stop
@section('js')
@stop

@push('css')

@push('js')

