@extends('adminlte::page')
@section('content_header')
    <h1>添加管理员</h1>
@stop

@section('content')
    <form action='doAdd' method="post">
        @csrf
        <table class="table table-bordered table-striped dataTable" >
            <tr>
                <td>管理员名字</td>
                <td><input type="text" name="uname" value=""></td>
            </tr>
            <tr>
                <td>邮箱</td>
                <td><input type="email" name="email" value=""></td>
            </tr>
            <tr>
                <td>手机号</td>
                <td><input type="number" name="mobile" value=""></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="password" value=""></td>
            </tr>
            <tr>
                <td>选择角色</td>
                <td>
                    @foreach($roles as $key => $role)
                        <input type="checkbox" value="{{$role['rid']}}" name="role[]">{{$role['rname']}}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>是否为超级管理员</td>
                <td>
                    <input type="radio" name="is_supper" value="1">是
                    <input type="radio" name="is_supper" value="0" checked>否
                </td>
            </tr>
            <tr>
                <td>状态</td>
                <td>
                    <input type="radio" name="is_freeze" value="1" checked>可用
                    <input type="radio" name="is_freeze" value="0">冻结
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" class="btn btn-primary" value="确认添加">
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

