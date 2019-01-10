@extends('admin.layouts.comment')
@section('content')
    <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">文章</a>
        <a>
          <cite>{{ $sort->name }}</cite></a>
      </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
            <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <div class="layui-row">
            <form class="layui-form layui-col-md12 x-so" method="get" action="/wp-book/book/search">
                <input type="text" name="title"  placeholder="请输入标题" autocomplete="off" class="layui-input">
                <button class="layui-btn" type="submit"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </form>
        </div>
        <xblock>
            <button class="layui-btn" onclick="x_admin_show('添加文章','/wp-book/book/{{ $sort->id }}/create',800,500)">
                <i class="layui-icon"></i>增加
            </button>
            <span class="x-right" style="line-height:40px">共有数据：{{ $books->total() }} 条</span>
        </xblock>
        <table class="layui-table layui-form">
            <thead>
            <tr>
                <th width="20">
                    <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                </th>
                <th width="70">ID</th>
                <th>标题</th>
                <th>显示</th>
                <th>时间</th>
                <th width="220">操作</th>
            </thead>
            <tbody>
            @foreach($books as $item)
                <tr>
                    <td>
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id=''><i class="layui-icon">&#xe605;</i></div>
                    </td>
                    <td>{{ $item->id }}</td>
                    <td>
                        {{ $item->title }}
                    </td>
                    <td>{{ $item->view }}</td>
                    <td>@if(isset($item->created_at)){{ $item->created_at->format('Y-m-d H:i:s') }} @endif</td>
                    <td class="td-manage">
                        <button class="layui-btn layui-btn layui-btn-xs"  onclick="x_admin_show('编辑','/wp-book/book/{{ $item->id }}/edit')" ><i class="layui-icon">&#xe642;</i>编辑</button>
                        <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,'{{ $item->id }}')" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="page">
            <div>
                {{ $books->links() }}
            </div>
        </div>
    </div>
    <style type="text/css">

    </style>
    <script>
        layui.use(['form'], function(){
            form = layui.form;

        });

        /*用户-删除*/
        function member_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                if(id == ''){
                    layer.msg('请选择链接!',{icon:1,time:1000});
                    return false;
                }

                $.ajax({
                    method:"delete",
                    url:"/wp-book/book/" + id + '/delete',
                    dataType:"json"
                })
                    .done(function (e) {
                        $(obj).parents("tr").remove();
                        layer.msg(e.message,{icon:1,time:1000});
                    })
                    .fail(function (xhr) {
                        layer.msg(jsonForm(xhr.responseJSON),{icon:1,time:1000});
                    });

            });
        }
        $(".layui-btn-normal").click(function () {
            let _this = $(this);
            let id = _this.data('id');
            if(id == ''){
                layer.msg('请选择链接!',{icon:1,time:1000});
                return false;
            }

            $.ajax({
                method:"put",
                url:"/fileStore/link/" + id,
                dataType: 'json'
            })
                .done(function (e) {
                    _this.parents("tr").remove();
                    layer.msg(e.message,{icon:1,time:1000});
                })
                .fail(function (xhr) {
                    layer.msg(jsonForm(xhr.responseJSON),{icon:1,time:1000});
                });

        });
    </script>
    </body>
@stop