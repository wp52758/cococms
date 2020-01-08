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

                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>网址名</label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="name" required="" lay-verify="name" autocomplete="off"
                               class="layui-input input_width">
                    </div>
                </div>




                <div class="layui-form-item">
                    <label for="logo" class="layui-form-label">LOGO</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="L_logo" required="" lay-verify="logo"
                                autocomplete="off">
                            <i class="layui-icon">&#xe67c;</i>上传LOGO
                        </button>
                        <input type="hidden" id="i_logo" name="logo" value="">
                        <img  src="" style="margin-top: 20px; width: 300px; ">

                    </div>

                </div>

                <div class="layui-form-item">
                    <label for="url" class="layui-form-label">url</label>
                    <div class="layui-input-inline">
                        <input type="text" id="url" name="url" required="" lay-verify="url"
                               autocomplete="off" class="layui-input input_width">
                    </div>
                </div>


                <div class="layui-form-item">
                    <label for="is_public" class="layui-form-label">
                        是否开放</label>
                    <div class="layui-input-inline">
                        <div class="layui-input-inline">
                            <input type="radio" name="is_public" value="0" title="否" checked>
                            <input type="radio" name="is_public" value="1" title="是">
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
                    <label for="L_repass" class="layui-form-label"></label>
                    <button class="layui-btn" lay-filter="add" lay-submit="">增加</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>layui.use(['form', 'layer', 'upload'],
        function () {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //自定义验证规则
            form.verify({
                name: function (value) {
                    if (!value) {
                        return '请填写网址名称';
                    }
                },
                url: function (value) {
                    if (!value || value.length < 1) {
                        return '请填写网址';
                    }
                    if (value.length > 50) {
                        return '网址太长';
                    }
                },

            });

            //监听提交
            form.on('submit(add)',
                function (data) {
                    console.log(data);
                    //发异步，把数据提交给php
                    $.post('/admin/friendLink/add',data.field,function (data) {
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
            oneFileUpload(upload,'#L_logo',1);

        });

    function oneFileUpload(upload,bindElem,type) {
        upload.render({
            elem: bindElem //绑定元素
            , url: '/admin/upload/' //上传接口
            , done: function (res) {
                //上传完毕回调
                if (res.code === 200) {
                    $(bindElem).siblings('input').attr('value',res.data.file);
                    $(bindElem).siblings('img').attr('src', res.data.file).show();
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
