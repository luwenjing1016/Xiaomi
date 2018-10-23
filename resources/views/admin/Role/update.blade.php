@extends('adminlte::page')
@section('content_header')
    <h1>修改角色</h1>
@stop

@section('content')
    <form action='doUpdate' method="post">
        @csrf
        <table class="table table-bordered table-striped dataTable" >
            <input type="text" name="rid" value="{{$role['rid']}}" hidden>
            <tr>
                <td>角色名称</td>
                <td><input type="text" name="rname" value="{{$role['rname']}}"></td>
            </tr>
            <tr>
                <td align="center">
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

