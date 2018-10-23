@extends('adminlte::page')
@section('content_header')
    <h1>权限分配</h1>
@stop

@section('content')
    <form action='allotRole' method="post">
        @csrf
        <table class="table table-bordered table-striped dataTable" >
            <div>
                <tr>
                    <td width="10%">选择角色</td>
                    <td>
                        <select name="rid" id="">
                            <option value="">选择角色</option>
                            @foreach($roles as $key => $role)
                                <option value="{{$role['rid']}}">{{$role['rname']}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </div>
            <div>
                <td>分配权限</td>
                <td>
                    @foreach($powers as $key => $power)
                        <tr>
                            <td></td>
                            <td><input type="checkbox" class="pid" name="pid[]" value="{{$power['mid']}}">{{$power['text']}}</td>
                        </tr>
                        @if($power['submenu'])
                            <tr>
                                <td></td>
                                <td>&emsp;&emsp;&emsp;&emsp;<input type="checkbox" class="all">全选
                                    @foreach($power['submenu'] as $k => $p)
                                    &emsp;&emsp;<input type="checkbox" class="power" data-pid="{{$power['mid']}}" name="mid[]" value="{{$p['mid']}}">{{$p['text']}}
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </td>
            </div>
            <div>
                <td>按钮权限</td>
                <td>
                    @foreach($buttons as $k => $button)
                        <input type="checkbox" class="power" name="bid[]" value="{{$button['bid']}}">{{$button['name']}}&emsp;&emsp;
                    @endforeach
                </td>
            </div>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" class="btn btn-primary" value="取消">
                    <input type="submit" class="btn btn-primary" value="确定">
                </td>
            </tr>
        </table>
    </form>
@stop

@section('css')
@stop
@section('js')
    <script type="text/javascript">
        $(function(){
            $('.pid').click(function () {
                var pid = $(this).val();
                if($(this).is(':checked')){//父级选中
//                    alert(pid);
                    $("[data-pid="+pid+"]").each(function () {
                        $(this).prop('checked',true);
                    })
                }else{//父级未选中
                    $("[data-pid="+pid+"]").each(function () {
                        $(this).prop('checked',false);
                    })
                }
            })
            $('.power').click(function () {
                var pid = $(this).data('pid');
//                alert(pid);
                if($(this).is(':checked')){
                    //子类选中 父类自动选中
                    $("[class='pid'][value="+pid+"]").prop('checked',true);
                }
            })
        })
    </script>
@stop

@push('css')

@push('js')

