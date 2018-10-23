@extends('adminlte::page')
@section('content_header')
    <h1>添加权限</h1>
@stop

@section('content')
    <form action='addPower' method="post">
        @csrf
        <table class="table table-bordered table-striped dataTable" >
            <tr>
                <td width="10%">权限名称</td>
                <td><input type="text" name="text" value=""></td>
            </tr>
            <tr>
                <td>权限路由</td>
                <td><input type="text" name="url" value=""></td>
            </tr>
            <tr>
                <td>父类权限</td>
                <td>
                    <select name="pid" id="">
                        <option value="0">请选择父类权限</option>
                        @foreach($powers as $key => $pid)
                            <option value="{{$pid['mid']}}" name="pid">{{$pid['text']}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>菜单是否显示</td>
                <td>
                    <input type="radio" name="is_menu" value="1" checked>是
                    <input type="radio" name="is_menu" value="0">否
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
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

