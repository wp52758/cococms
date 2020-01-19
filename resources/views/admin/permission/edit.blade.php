<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>编辑</title>
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
                <label for="menu_id" class="layui-form-label">
                    <span class="x-red">*</span>菜单</label>
                <div class="layui-input-inline">
                    <select name="menu_id" id="menu_id" lay-verify="menu_id">
                        <option value="">请选择</option>
                        @foreach($menu as $value)
                            <option value="{{ $value['id'] }}" @if($value['id'] == $permission['menu_id']) selected @endif @if(count($value['child']) > 0) disabled @endif>{{ $value['name'] }}</option>
                            @foreach($value['child'] as $child)
                                <option value="{{ $child['id'] }}" @if($child['id'] == $permission['menu_id']) selected @endif @if(count($child['child']) > 0) disabled @endif>&nbsp;&nbsp;&nbsp;├ {{ $child['name'] }}</option>
                                @foreach($child['child'] as $item)
                                    <option value="{{ $item['id'] }}" @if($item['id'] == $permission['menu_id']) selected @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├ {{ $item['name'] }}</option>
                                @endforeach
                            @endforeach
                        @endforeach
                    </select>

                </div>
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>权限名</label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="name" required="" lay-verify="name" autocomplete="off"
                               class="layui-input" value="{{ $permission['name'] }}">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="path" class="layui-form-label"><span class="x-red">*</span>路径</label>
                    <div class="layui-input-inline">
                        <input type="text" id="path" name="path" required="" lay-verify="path"
                               autocomplete="off" class="layui-input" value="{{ $permission['path'] }}" }>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label"></label>
                    <button class="layui-btn" lay-filter="add" lay-submit="">编辑</button>
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
                menu_id: function (value) {
                    if (!value) {
                        return '请选择菜单';
                    }
                },
                name: function (value) {
                    if (!value || value.length < 1) {
                        return '请填写权限名';
                    }
                    if (value.length > 30) {
                        return '权限名太长';
                    }
                },
                path: function (value) {
                    if (!value || value.length < 1) {
                        return '请填写路径名';
                    }
                    if (value.length > 50) {
                        return '路径名太长';
                    }
                },

            });

            //监听提交
            form.on('submit(add)',
                function (data) {
                    console.log(data);
                    //发异步，把数据提交给php
                    AjaxPost('/admin/permission/edit/{{ $permission['id'] }}',data.field,function (data) {
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
