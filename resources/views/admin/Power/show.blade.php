
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    @foreach($buttons as $key => $button)
        <h3>
            @if(!empty($button)&&$button==1)
                <a href="{{url("admin/power/add")}}" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-plus">添加权限</span>
                </a>
            @endif
        </h3>
    @endforeach
    <table class="table table-bordered table-striped dataTable" >
        <tr>
            <td>权限ID</td>
            <td>权限名称</td>
            <td>父级</td>
            <td>路由</td>
            <td>层级关系</td>
            <td>菜单展示</td>
            <td>操作</td>
        </tr>
        @foreach($powers as $key => $power)
            <tr>
                <td>{{$power['mid']}}</td>
                <td>{{$power['text']}}</td>
                <td>{{$power['pid']}}</td>
                <td>{{$power['url']}}</td>
                <td>{{$power['path']}}</td>
                <td>{{$power['is_menu']?"菜单展示":"菜单不展示"}}</td>
                <td>
                    @foreach($buttons as $key => $button)
                        @if(!empty($button)&&$button==2)
                            <a href="{{url("admin/power/update?mid=$power[mid]")}}}">
                                <button type="button" class="btn btn-default btn-sm" style="background-color:green;color:#fff">
                                    <span class="glyphicon glyphicon-edit"></span>编辑
                                </button>
                            </a>
                        @else
                            <a href="{{url("admin/power/update?mid=$power[mid]")}}" hidden>
                                <button type="button" class="btn btn-default btn-sm" style="background-color:green;color:#fff">
                                    <span class="glyphicon glyphicon-edit"></span>编辑
                                </button>
                            </a>
                        @endif
                    @endforeach
                    |
                    @foreach($buttons as $key => $button)
                        @if(!empty($button)&&$button==3)
                            <a href="{{url("admin/power/delete?mid=$power[mid]")}}">
                                <button type="button" class="btn btn-default btn-sm" style="background-color:red;color:#fff" >
                                    <span class="glyphicon glyphicon-trash"></span>删除
                                </button>
                            </a>
                        @else
                            <a href="{{url("admin/power/delete?mid=$power[mid]")}}" hidden>
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



