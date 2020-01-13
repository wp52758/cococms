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
                    <label for="role_name" class="layui-form-label">
                        <span class="x-red">*</span>角色名</label>
                    <div class="layui-input-inline">
                        <input type="text" id="role_name" name="role_name" required="" lay-verify="role_name" autocomplete="off"
                               class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="role_name" class="layui-form-label">
                        <span class="x-red">*</span>权限</label>
                    <table  class="layui-table">
                        <tbody>

                        @foreach($menus as $menu)
                        <tr>
                            <td>

                                <div>
                                    {{ $menu['name'] }}
                                    @if(count($menu->permission) > 0)
                                        <div class="layui-input-block">
                                            @foreach($menu->permission as $item)
                                                <input name="id[]" lay-skin="primary" type="checkbox" title="{{ $item['name'] }}" value="{{ $item['id'] }}">
                                            @endforeach
                                        </div>
                                    @endif

                                    @foreach($menu['child'] as $child2)
                                        @php $px = $loop->depth * 20 @endphp
                                        <div style="margin-left: {{ $px }}px">
                                            {{ $child2['name'] }}
                                            @if(count($child2->permission) > 0)
                                                <div class="layui-input-block">
                                                    @foreach($child2->permission as $p2)
                                                        <input name="id[]" lay-skin="primary" type="checkbox" title="{{ $p2['name'] }}" value="{{ $p2['id'] }}">
                                                    @endforeach
                                                </div>
                                            @endif

                                            @foreach($child2['child'] as $child3)
                                                @php $px = $loop->depth * 20 @endphp
                                                <div style="margin-left: {{ $px }}px">
                                                    <input name="id[]" lay-skin="primary" type="checkbox" title="{{ $child3['name'] }}">

                                                    @if(count($child3->permission) > 0)
                                                        <div class="layui-input-block">
                                                            @foreach($child3->permission as $p3)
                                                                <input name="id[]" lay-skin="primary" type="checkbox" title="{{ $p3['name'] }}" value="{{ $p3['id'] }}">
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>

                                            @endforeach

                                        </div>



                                    @endforeach
                                </div>

                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>


                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label"></label>
                    <button class="layui-btn" lay-filter="add" lay-submit="">增加</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>layui.use(['form', 'layer', 'jquery'],
        function () {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //自定义验证规则
            form.verify({
                role_name: function (value) {
                    if (!value) {
                        return '请选填写角色名';
                    }
                },


            });

            $('.layui-form-checkbox').on('click',function () {


                if ($(this).hasClass('layui-form-checked')) {
                    $(this).next('div').children('div').addClass('layui-form-checked')
                    $(this).nextAll('div').children('div').addClass('layui-form-checked')
                    $(this).next('div').children('div').children('div').addClass('layui-form-checked')
                    $(this).nextAll('div').children('div').children('div').addClass('layui-form-checked')

                    $(this).parent('div').prev('div').parent('div').parent('div').children('div').eq(0).addClass('layui-form-checked')

                } else {

                    var s1 = $(this).siblings('div').hasClass('layui-form-checked');

                    console.log(s1)

                    $(this).next('div').children('div').removeClass('layui-form-checked')
                    $(this).nextAll('div').children('div').removeClass('layui-form-checked')

                    $(this).next('div').children('div').children('div').removeClass('layui-form-checked')
                    $(this).nextAll('div').children('div').children('div').removeClass('layui-form-checked')




                    if(!s1){
                        //

                    }


                    // 任何叶子节点都没有被选中的话，



                }



            });

            //监听提交
            form.on('submit(add)',
                function (data) {
                    console.log(data);
                    return false;
                    //发异步，把数据提交给php
                    $.post('/admin/role/add',data.field,function (data) {
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
