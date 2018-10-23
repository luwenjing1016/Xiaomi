@extends('adminlte::page')
@section('content_header')
    <h1>添加管理员</h1>
@stop

@section('content')
    <form action='addRole' method="post">
        @csrf
        <table class="table table-bordered table-striped dataTable" >
            <tr>
                <td>角色名称</td>
                <td><input type="text" name="rname" value=""></td>
            </tr>
            <tr>
                <td align="center">
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

