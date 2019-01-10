@extends('admin.layouts.comment')
@section('content')
    <body>
    <div class="x-body layui-anim layui-anim-up">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="L_website" class="layui-form-label">
                    <span class="x-red">*</span>网站名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_title" name="title" required="" lay-verify="title"
                           autocomplete="off" class="layui-input" value="@if(isset($system->title)){{ $system->title }} @endif">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_keyword" class="layui-form-label">
                    <span class="x-red">*</span>关键字
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" id="L_keyword" name="keyword" class="layui-textarea">@if(isset($system->title)){{ $system->keyword }} @endif</textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_description" class="layui-form-label">
                    <span class="x-red">*</span>描述
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" id="L_description" name="description" class="layui-textarea">@if(isset($system->title)){{ $system->description }} @endif</textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_statistical" class="layui-form-label">
                    <span class="x-red">*</span>统计代码
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" id="L_statistical" name="statistical" class="layui-textarea">@if(isset($system->title)){{ $system->statistical }} @endif</textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_notice" class="layui-form-label">
                    网站公告
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" id="L_notice" name="notice" class="layui-textarea">@if(isset($system->title)){{ $system->notice }} @endif</textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_forever" class="layui-form-label">
                    <span class="x-red">*</span>发布页地址
                </label>
                <div class="layui-input-block">
                    <input type="text" id="L_forever" name="forever" required="" lay-verify="forever"
                           autocomplete="off" class="layui-input" value="@if(isset($system->title)){{ $system->forever }} @endif">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button  class="layui-btn" lay-filter="add" lay-submit="">
                    提交
                </button>
            </div>
        </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form
                ,layer = layui.layer;

            //自定义验证规则
            form.verify({
                title: function(value){
                    if(value.length < 2){
                        return '名称至少得2个字符啊';
                    }
                }

            });

            //监听提交
            form.on('submit(add)', function(data){
                $.post('/wp-book/system',data.field)
                    .done(function (e) {
                        layer.msg(e.message);
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