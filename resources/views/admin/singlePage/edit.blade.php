<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>编辑单页</title>
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
                            <option value="{{ $value['id'] }}" @if($value['id'] == $singlePage['category_id']) selected @endif  @if(count($value['child']) > 0) disabled @endif>{{ $value['name'] }}</option>
                            @foreach($value['child'] as $child)
                                <option value="{{ $child['id'] }}" @if($value['id'] == $singlePage['category_id']) selected @endif  @if(count($value['child']) > 0) disabled @endif>&nbsp;&nbsp;&nbsp;├ {{ $child['name'] }}</option>
                                @foreach($child['child'] as $item)
                                    <option value="{{ $item['id'] }}" @if($value['id'] == $singlePage['category_id']) selected @endif >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├ {{ $item['name'] }}</option>
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
                               class="layui-input input_width" value="{{ $singlePage['title'] }}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="keywords" class="layui-form-label">
                        关键字</label>
                    <div class="layui-input-inline">
                        <input type="text" id="keywords" name="keywords" required="" lay-verify="keywords"
                               autocomplete="off" class="layui-input input_width" value="{{ $singlePage['keywords'] }}">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="description" class="layui-form-label">
                        描述</label>
                    <div class="layui-input-inline">
                        <input type="text" id="description" name="description" required="" lay-verify="description"
                               autocomplete="off" class="layui-input input_width" value="{{ $singlePage['description'] }}">
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
                        <input type="hidden" id="i_main_pic" name="main_pic" value="{{ $singlePage['main_pic'] }}">
                        <img  src="{{ $singlePage['main_pic'] }}" style="margin-top: 20px; width: 300px;  @if(empty($singlePage['main_pic'])) display: none @endif">

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
                        <input type="hidden" id="i_group_pic" name="group_pic" value="{{ $singlePage['group_pic'] }}">
                        @php $groupPic =  explode(',', $singlePage['group_pic']); @endphp
                        @foreach($groupPic as $pic)
                            <img  src="{{ $pic }}" style="margin-top: 20px; width: 300px;">
                        @endforeach
                    </div>
                </div>


                <div class="layui-form-item layui-form-text">
                    <label for="desc" class="layui-form-label">内容</label>
                    <div class="layui-input-block">
                        <script id="container" name="content" type="text/plain">{!! $singlePage['content'] !!}</script>
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
                    AjaxPost('/admin/singlePage/edit/{{ $singlePage['id'] }}',data.field,function (data) {
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
