@extends('adminlte::page')
@section('content_header')
    <h1>修改管理员信息</h1>
@stop

@section('content')
    <form action='toUpdate' method="post">
        @csrf
        <table class="table table-bordered table-striped dataTable" >
            <input type="text" name="uid" value="{{$adminMessage['uid']}}" hidden>
            <tr>
                <td>管理员名字</td>
                <td><input type="text" name="uname" value="{{$adminMessage['uname']}}"></td>
            </tr>
            <tr>
                <td>邮箱</td>
                <td><input type="email" name="email" value="{{$adminMessage['email']}}"></td>
            </tr>
            <tr>
                <td>手机号</td>
                <td><input type="number" name="mobile" value="{{$adminMessage['mobile']}}"></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="password" value="{{$adminMessage['password']}}"></td>
            </tr>
            <tr>
                <td>是否为超级管理员</td>
                <td>
                    @if($adminMessage['is_supper']==1)
                        <input type="radio" name="is_supper" value="1" checked>是
                        <input type="radio" name="is_supper" value="0">否
                    @else
                        <input type="radio" name="is_supper" value="1">是
                        <input type="radio" name="is_supper" value="0" checked>否
                    @endif

                </td>
            </tr>
            <tr>
                <td>状态</td>
                <td>
                    @if($adminMessage['is_freeze']==1)
                        <input type="radio" name="is_freeze" value="1" checked>可用
                        <input type="radio" name="is_freeze" value="0">冻结
                    @else
                        <input type="radio" name="is_freeze" value="1">可用
                        <input type="radio" name="is_freeze" value="0" checked>冻结
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" class="btn btn-primary" value="确认修改">
                </td>
            </tr>
        </table>
    </form>
@stop

@section('css')
@stop
@section('js')
@stop

@push('css')

@push('js')

