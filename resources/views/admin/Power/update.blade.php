@extends('adminlte::page')
@section('content_header')
    <h1>修改权限信息</h1>
@stop

@section('content')
    <form action='doUpdate' method="post">
        <input type="text" name="mid" value="{{$updateMsg['mid']}}" hidden>
        @csrf
        <table class="table table-bordered table-striped dataTable" >
            <tr>
                <td width="10%">权限名称</td>
                <td><input type="text" name="text" value="{{$updateMsg['text']}}"></td>
            </tr>
            <tr>
                <td>权限路由</td>
                <td><input type="text" name="url" value="{{$updateMsg['url']}}"></td>
            </tr>
            <tr>
                <td>父类权限</td>
                <td>
                    <select name="pid" id="">
                        <option value="0">请选择父级</option>
                        @foreach($powers as $key => $pid)
                            @if($updateMsg['pid']==$pid['mid'])
                                <option value="{{$pid['mid']}}" name="pid" selected>{{$pid['text']}}</option>
                            @else
                                <option value="{{$pid['mid']}}" name="pid">{{$pid['text']}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>菜单是否显示</td>
                <td>
                    @if($updateMsg['is_menu']==1)
                        <input type="radio" name="is_menu" value="1" checked>是
                        <input type="radio" name="is_menu" value="0">否
                    @else
                        <input type="radio" name="is_menu" value="1">是
                        <input type="radio" name="is_menu" value="0" checked>否
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
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

