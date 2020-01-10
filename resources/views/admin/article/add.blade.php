<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>添加文章</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <script type="text/javascript" src="/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .input_width {
            width: 500px;
        }
    </style>

</head>

<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="category_id" class="layui-form-label">
                    <span class="x-red">*</span>分类</label>
                <div class="layui-input-inline">
                    <select name="category_id" id="category_id" lay-verify="category_id">
                        <option value="">请选择</option>
                        @foreach($category as $value)
                            <option value="{{ $value['id'] }}" @if(count($value['child']) > 0) disabled @endif>{{ $value['name'] }}</option>
                            @foreach($value['child'] as $child)
                                <option value="{{ $child['id'] }}" @if(count($child['child']) > 0) disabled @endif>&nbsp;&nbsp;&nbsp;├ {{ $child['name'] }}</option>
                                @foreach($child['child'] as $item)
                                    <option value="{{ $item['id'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├ {{ $item['name'] }}</option>
                                @endforeach
                            @endforeach
                        @endforeach

                    </select>

                </div>
                <div class="layui-form-item">
                    <label for="title" class="layui-form-label">
                        <span class="x-red">*</span>标题</label>
                    <div class="layui-input-inline">
                        <input type="text" id="title" name="title" required="" lay-verify="title" autocomplete="off"
                               class="layui-input input_width">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="abstract" class="layui-form-label">
                        摘要</label>
                    <div class="layui-input-inline">
                        <input type="text" id="abstract" name="abstract" required="" lay-verify="abstract"
                               autocomplete="off" class="layui-input input_width">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="keyword" class="layui-form-label">
                        关键字</label>
                    <div class="layui-input-inline">
                        <input type="text" id="keyword" name="keyword" required="" lay-verify="keyword"
                               autocomplete="off" class="layui-input input_width">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="main_pic" class="layui-form-label">
                        主图</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="L_main_pic" required="" lay-verify="main_pic"
                                autocomplete="off">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="hidden" id="i_main_pic" name="main_pic" value="">
                        <img  src="" style="margin-top: 20px; width: 300px;  @if(empty($data['main_pic'])) display: none @endif">

                    </div>

                </div>

                <div class="layui-form-item">
                    <label for="group_pic" class="layui-form-label">
                        组图</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="L_group_pic" required="" lay-verify="group_pic"
                                autocomplete="off">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="hidden" id="i_group_pic" name="group_pic" value="">

                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="link" class="layui-form-label">
                        链接</label>
                    <div class="layui-input-inline">
                        <input type="text" id="link" name="link" required="" lay-verify="link"
                               autocomplete="off" class="layui-input"></div>
                </div>

                <div class="layui-form-item">
                    <label for="is_top" class="layui-form-label">
                        是否置顶</label>
                    <div class="layui-input-inline">
                        <div class="layui-input-inline">
                            <input type="radio" name="is_top" value="0" title="否" checked>
                            <input type="radio" name="is_top" value="1" title="是">
                        </div>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="is_recommended" class="layui-form-label">
                        是否推荐</label>
                    <div class="layui-input-inline">
                        <div class="layui-input-inline">
                            <input type="radio" name="is_recommended" value="0" title="否" checked>
                            <input type="radio" name="is_recommended" value="1" title="是">
                        </div>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="is_release" class="layui-form-label">
                        是否发布</label>
                    <div class="layui-input-inline">
                        <div class="layui-input-inline">
                            <input type="radio" name="is_release" value="0" title="否">
                            <input type="radio" name="is_release" value="1" title="是" checked>
                        </div>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="sort" class="layui-form-label">
                        排序</label>
                    <div class="layui-input-inline">
                        <input type="text" id="sort" name="sort" required="" lay-verify="sort"
                               autocomplete="off" class="layui-input" value="0">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="file" class="layui-form-label">
                        上传文件</label>
                    <div class="layui-input-inline">

                        <button type="button" class="layui-btn" id="L_file" required="" lay-verify="file"
                                autocomplete="off">
                            <i class="layui-icon">&#xe67c;</i>上传文件
                        </button>
                        <input type="hidden" id="i_file" name="file" value="">
                        <div></div>
                    </div>
                </div>


                <div class="layui-form-item layui-form-text">
                    <label for="desc" class="layui-form-label">内容</label>
                    <div class="layui-input-block">
                        <script id="container" name="content" type="text/plain"></script>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label"></label>
                    <button class="layui-btn" lay-filter="add" lay-submit="">增加</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- 配置文件 -->
<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
</script>
<script>layui.use(['form', 'layer', 'upload'],
        function () {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //自定义验证规则
            form.verify({
                category_id: function (value) {
                    if (!value) {
                        return '请选择分类';
                    }
                },
                title: function (value) {
                    if (!value || value.length < 1) {
                        return '请填写标题';
                    }
                    if (value.length > 50) {
                        return '标题太长';
                    }
                },

            });

            //监听提交
            form.on('submit(add)',
                function (data) {
                    console.log(data);
                    //发异步，把数据提交给php
                    $.post('/admin/article/add',data.field,function (data) {
                        console.log(data);

                        layer.alert(data.msg, {
                                icon: 6
                            },
                            function () {
                                //关闭当前frame
                                xadmin.close();

                                // 可以对父窗口进行刷新
                                xadmin.father_reload();
                            });
                        return false;
                    });
                    return false;
;
                });

            var upload = layui.upload;
            var imgPath = '';
            //执行实例
            oneFileUpload(upload,'#L_main_pic',1);
            oneFileUpload(upload,'#L_group_pic',2);
            oneFileUpload(upload,'#L_file',3);

        });

    function oneFileUpload(upload,bindElem,type) {
        upload.render({
            elem: bindElem //绑定元素
            , url: '/admin/upload/' //上传接口
            , done: function (res) {
                //上传完毕回调
                if (res.code === 200) {
                    if(type == 1){
                        $(bindElem).siblings('input').attr('value',res.data.file);
                        $(bindElem).siblings('img').attr('src', res.data.file).show();
                    }
                    if(type == 2){

                        var v = $(bindElem).siblings('input').attr('value');
                        if(typeof(v) === "undefined"){
                            v = '';
                        }
                        v = v + res.data.file+',';
                        $(bindElem).siblings('input').attr('value',v );
                        $(bindElem).after('<img src="'+ res.data.file +'" style="margin-top: 20px; width: 300px;">');
                    }
                    if(type == 3){
                        $(bindElem).siblings('input').attr('value',res.data.file);
                        $(bindElem).siblings('div').html(res.data.file);
                    }

                }
            }
            , error: function () {
                //请求异常回调
            }
        });
    }

</script>

</body>

</html>
