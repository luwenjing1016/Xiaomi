@extends('adminlte::page')
@section('content_header')
    <h1>删除管理员</h1>
@stop

@section('content')
    <table class="table table-bordered table-striped dataTable" >
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
                    <a href="{{url("admin/doDelete?uid=$user[uid]")}}"><button type="button" class="btn btn-primary">删除</button></a>
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



