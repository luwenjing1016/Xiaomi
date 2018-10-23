
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>角色列表</h1>
@stop

@section('content')
    @foreach($buttons as $key => $button)
        <h3>
            @if(!empty($button)&&$button==1)
                <a href="{{url("admin/role/role")}}" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-plus">添加角色</span>
                </a>
            @endif
        </h3>
    @endforeach
    <table class="table table-bordered table-striped dataTable" >
        <tr>
            <td>角色ID</td>
            <td>角色名称</td>
            <td>操作</td>
        </tr>
        @foreach($roles as $key => $role)
            <tr>
                <td>{{$role['rid']}}</td>
                <td>{{$role['rname']}}</td>
                <td>
                    @foreach($buttons as $key => $button)
                        @if(!empty($button)&&$button==2)
                            <a href="{{url("admin/role/updateRole?rid=$role[rid]")}}">
                                <button type="button" class="btn btn-default btn-sm" style="background-color:green;color:#fff">
                                    <span class="glyphicon glyphicon-edit"></span>编辑
                                </button>
                            </a>
                        @else
                            <a href="{{url("admin/role/updateRole?rid=$role[rid]")}}" hidden>
                                <button type="button" class="btn btn-default btn-sm" style="background-color:green;color:#fff">
                                    <span class="glyphicon glyphicon-edit"></span>编辑
                                </button>
                            </a>
                        @endif
                    @endforeach
                        |
                    @foreach($buttons as $key => $button)
                        @if(!empty($button)&&$button==3)
                            <a href="{{url("admin/role/doDelete?rid=$role[rid]")}}">
                                <button type="button" class="btn btn-default btn-sm" style="background-color:red;color:#fff" >
                                    <span class="glyphicon glyphicon-trash"></span>删除
                                </button>
                            </a>
                        @else
                            <a href="{{url("admin/role/doDelete?rid=$role[rid]")}}" hidden>
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



