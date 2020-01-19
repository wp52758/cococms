<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>网站设置</title>
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
        .input_with {
            width: 500px;
        }
    </style>
</head>
<body>
<div class="layui-fluid">

    <div class="layui-row">
        <form class="layui-form" style="background: #fff;padding-top: 30px; padding-bottom: 30px;">
            <div class="layui-form-item">
                <label for="L_name" class="layui-form-label">
                    <span class="x-red">*</span>网站名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_name" name="name" required="" lay-verify="name" autocomplete="off"
                           class="layui-input input_with" value="{{ $data['name'] }}">
                </div>

            </div>
            <div class="layui-form-item">

                <label for="L_logo" class="layui-form-label">
                    <span class="x-red">*</span>LOGO
                </label>
                <div class="layui-input-inline">

                    <button type="button" class="layui-btn" id="L_logo"  required="" lay-verify="logo" autocomplete="off" >
                        <i class="layui-icon">&#xe67c;</i>上传图片
                    </button>
                    <input type="hidden" id="i_logo" name="logo" value="{{ $data['logo'] }}">
                    <img id="logo" src="{{ $data['logo'] }}"  style="margin-top: 20px; @if(empty($data['logo'])) display: none @endif">
                </div>

            </div>
            <div class="layui-form-item">
                <label for="L_url" class="layui-form-label">
                    <span class="x-red">*</span>网址
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_url" name="url" required="" lay-verify="url" autocomplete="off"
                           class="layui-input input_with" value="{{ $data['url'] }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_copyright" class="layui-form-label">
                    版权信息
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_copyright" name="copyright" required="" lay-verify="copyright" autocomplete="off"
                           class="layui-input input_with" value="{{ $data['copyright'] }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_hotline" class="layui-form-label">
                    客服热线
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_hotline" name="hotline" required="" lay-verify="hotline" autocomplete="off"
                           class="layui-input input_with" value="{{ $data['hotline'] }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_contact" class="layui-form-label">
                    联系人
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_contact" name="contact" required="" lay-verify="contact" autocomplete="off"
                           class="layui-input input_with" value="{{ $data['contact'] }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_mobile" class="layui-form-label">
                    联系人电话
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_mobile" name="mobile" required="" lay-verify="mobile" autocomplete="off"
                           class="layui-input input_with" value="{{ $data['mobile'] }}">
                </div>
            </div>

            {{--<div class="layui-form-item">--}}
                {{--<label for="L_email" class="layui-form-label">--}}
                    {{--Email--}}
                {{--</label>--}}
                {{--<div class="layui-input-inline">--}}
                    {{--<input type="text" id="L_email" name="email" required="" lay-verify="email" autocomplete="off"--}}
                           {{--class="layui-input input_with">--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="layui-form-item">
                <label for="L_record_sn" class="layui-form-label">
                备案号
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_record_sn" name="record_sn" required="" lay-verify="record_sn" autocomplete="off"
                           class="layui-input input_with" value="{{ $data['record_sn'] }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_address" class="layui-form-label">
                    公司地址
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_address" name="address" required="" lay-verify="address" autocomplete="off"
                           class="layui-input input_with" value="{{ $data['address'] }}">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="L_statistics" class="layui-form-label">
                    流量统计
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_statistics" name="statistics" required="" lay-verify="statistics" autocomplete="off"
                           class="layui-input input_with" value="{{ $data['statistics'] }}">
                </div>
            </div>


            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label"></label>
                <button class="layui-btn" lay-filter="add" lay-submit="">保存</button>
            </div>
        </form>
    </div>
</div>
<script>layui.use(['form', 'layer', 'jquery','upload'],
        function () {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //自定义验证规则
            form.verify({
                name: function (value) {
                    if (value.length < 2) {
                        return '网站名称至少得2个字符';
                    }
                },
                pass: [/(.+){6,12}$/, '密码必须6到12位'],
                repass: function (value) {
                    if ($('#L_pass').val() != $('#L_repass').val()) {
                        return '两次密码不一致';
                    }
                }
            });

            //监听提交
            form.on('submit(add)',
                function (data) {
                    console.log(data.field);
                    //发异步，把数据提交给php
                    AjaxPost('/admin/siteSetting/',data.field,function (data) {
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


                });

            var upload = layui.upload;
            //执行实例
            var uploadInst = upload.render({
                elem: '#L_logo' //绑定元素
                ,url: '/admin/upload/' //上传接口
                ,done: function(res){

                    //上传完毕回调
                    if(res.code=== 200 ){
                        $('#i_logo').val(res.data.file);
                        $('#logo').attr('src',res.data.file).show();
                    }

                }
                ,error: function(){
                    //请求异常回调
                }
            });

        });
</script>

</body>

</html>