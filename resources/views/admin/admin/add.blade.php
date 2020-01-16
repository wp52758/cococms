<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>添加</title>
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

</head>

<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">

                <div class="layui-form-item">
                    <label for="user_name" class="layui-form-label">
                        <span class="x-red">*</span>登录名</label>
                    <div class="layui-input-inline">
                        <input type="text" id="user_name" name="user_name" required="" lay-verify="user_name" autocomplete="off"
                               class="layui-input input_width">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="email" class="layui-form-label">
                        <span class="x-red">*</span>邮箱</label>
                    <div class="layui-input-inline">
                        <input type="text" id="email" name="email" required="" lay-verify="email"
                               autocomplete="off" class="layui-input input_width">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><span class="x-red">*</span>角色</label>
                    <div class="layui-input-block">

                        @foreach($roles as $val)
                            <input type="checkbox" name="roles[]" value="{{ $val['id'] }}" lay-skin="primary" title="{{ $val['role_name'] }}">
                        @endforeach

                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="password" class="layui-form-label">
                        <span class="x-red">*</span>密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="password" id="password" name="password" required="" lay-verify="password"
                               autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        6到16个字符
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="repassword" class="layui-form-label">
                        <span class="x-red">*</span>确认密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="password" id="repassword" name="repassword" required="" lay-verify="repassword"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>


                <div class="layui-form-item">
                    <label for="state" class="layui-form-label">
                        状态</label>
                    <div class="layui-input-inline">
                        <div class="layui-input-inline">
                            <input type="radio" name="state" value="1" title="启用" checked>
                            <input type="radio" name="state" value="0" title="关闭">
                        </div>
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

<script>layui.use(['form', 'layer','jquery'],
        function () {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //自定义验证规则
            form.verify({
                user_name: function (value) {
                    if (value.length < 2) {
                        return '登录名至少两个字';
                    }
                },
                email: function (value) {
                    if (!value || value.length < 1) {
                        return '请填写邮箱';
                    }
                },

                password: [/(.+){6,12}$/, '密码必须6到12位'],
                repassword: function(value) {
                    if ($('#password').val() != $('#repassword').val()) {
                        return '两次密码不一致';
                    }
                }

            });

            //监听提交
            form.on('submit(add)',
                function (data) {
                    console.log(data);
                    //发异步，把数据提交给php
                    $.post('/admin/admin/add',data.field,function (data) {
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


        });

</script>

</body>

</html>
