@extends('admin.layouts.comment')
@section('content')
    <body>
    <link href="/admin/edit/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <div class="x-body layui-anim layui-anim-up">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="L_title" class="layui-form-label">
                    <span class="x-red">*</span>标题
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_title" name="title" required="" lay-verify="title" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_name" class="layui-form-label">
                    <span class="x-red">*</span>分类
                </label>
                <div class="layui-input-inline">
                    <input type="hidden" name="sort_id" value="{{ $sort->id }}">
                    {{ $sort->name }}
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_order" class="layui-form-label">
                    <span class="x-red">*</span>内容
                </label>
                <div class="layui-input-inline">
                    <script type="text/plain" id="myEditor" style="width:600px;height:240px;"></script>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button  class="layui-btn" lay-filter="add" lay-submit="">
                    增加
                </button>
            </div>
        </form>
    </div>
    <script type="text/javascript" charset="utf-8" src="/admin/edit/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/admin/edit/umeditor.min.js"></script>
    <script type="text/javascript" src="/admin/edit/lang/zh-cn/zh-cn.js"></script>
    <script>
        var um = UM.getEditor('myEditor',{
            textarea:'content'
        });

        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form
                ,layer = layui.layer;

            //自定义验证规则
            form.verify({
                title: function(value){
                    if(value == ''){
                        return '名称不能为空';
                    }
                }
            });

            //监听提交
            form.on('submit(add)', function(data){

                var content = $('#myEditor').html();
                if(content.length < 15){
                    layer.alert('内容不能为空');
                    return false;
                }

                $.post('/wp-book/book/create',{title:data.field.title,content:content,sort_id:data.field.sort_id})
                    .done(function (e) {
                        layer.alert(e.message, {icon: 6},function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                            window.location.reload();
                        });
                    })
                    .fail(function (xhr) {
                        layer.msg(jsonForm(xhr.responseJSON));
                    });
                return false;
            });


        });
    </script>
    </body>

@stop