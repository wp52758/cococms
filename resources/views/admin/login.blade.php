
<!doctype html>
<html  class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>后台登录-X-admin2.2</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/xadmin.js"></script>
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-bg">

<div class="login layui-anim layui-anim-up">
    <div class="message">TEST CMS</div>
    <div id="darkbannerwrap"></div>

    <form method="post" class="layui-form" >
        <input name="user_name" placeholder="登录名"  type="text" lay-verify="required" class="layui-input" >
        <hr class="hr15">
        <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
        <hr class="hr15">
        <div class="layui-form-item">
            <div class="layui-row">
                <div class="layui-col-xs7">
                    <input type="text" name="vercode" id="LAY-user-login-vercode" lay-verify="required" placeholder="图形验证码"
                           class="layui-input" autocomplete="off">
                </div>
                <div class="layui-col-xs5">
                    <div style="margin-left: 10px;">
                        <img src="" class="layadmin-user-login-codeimg" id="LAY-user-get-vercode">
                    </div>
                </div>
            </div>
        </div>
        <hr class="hr15">
        <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
        <hr class="hr20" >
    </form>
</div>

<script>
    $(function  () {
        layui.use(['form','layer','jquery'], function(){
            var form = layui.form;

            //监听提交
            form.on('submit(login)', function(data){

                AjaxPost('/admin/login',data.field,function (data) {
                    console.log(data);

                    if(data.code !== 200){
                        layer.msg(data.msg);

                    }else{
                        location.href='/admin/index'
                    }

                });
                return false;

            });
        });
    });

    $('#LAY-user-get-vercode').click(function () {
        captcha();
    });

    captcha();
    function captcha() {
        $.getJSON('/captcha', function (data) {
            $('#LAY-user-get-vercode').attr('src', data.data);
        });
    }

</script>
<!-- 底部结束 -->

</body>
</html>