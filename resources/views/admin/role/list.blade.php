<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>角色列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <link rel="stylesheet" href="/css/pagination.css">
    <script src="/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/xadmin.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
<div class="x-nav">
            <span class="layui-breadcrumb">
                <a href="/admin/index">首页</a>
                <a href="#">角色列表</a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
    </a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">

                <div class="layui-card-header">
                    <button class="layui-btn layui-btn-danger" onclick="delAll()">
                        <i class="layui-icon"></i>批量删除</button>
                    <button class="layui-btn" onclick="xadmin.open('添加','/admin/role/add',800,800)">
                        <i class="layui-icon"></i>添加</button></div>
                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="" lay-skin="primary">
                            </th>
                            <th>ID</th>
                            <th>角色名</th>
                            <th>操作</th></tr>
                        </thead>
                        <tbody>

                        @foreach($role as $value)
                            <tr>
                                <td>
                                    <input type="checkbox" name="{{ $value['id'] }}" lay-skin="primary"></td>
                                <td>{{ $value['id'] }}</td>
                                <td>{{ $value['role_name'] }}</td>
                                <td class="td-manage">
                                    <a title="编辑" onclick="xadmin.open('编辑','/admin/role/edit/{{ $value['id'] }}',800,800)" href="javascript:;">
                                        <i class="layui-icon">&#xe642;</i></a>
                                    <a title="删除" onclick="delOne('{{ $value['id'] }}',this)" href="javascript:;">
                                        <i class="layui-icon">&#xe640;</i></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
<script>
    layui.use(['laydate', 'form'],
        function() {
            var laydate = layui.laydate;

            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });

            $('thead .layui-form-checkbox').on('click', function () {

                if ($(this).hasClass('layui-form-checked')) {
                    $('tbody .layui-form-checkbox').addClass('layui-form-checked');
                } else {
                    $('tbody .layui-form-checkbox').removeClass('layui-form-checked');
                }
            });


        });

    /*删除一个*/
    function delOne(id,obj) {
        var ids = [id];
        del(ids,obj);
    }

    function delAll() {
        var ids = [];
        $('tbody .layui-form-checkbox').each(function (i, elm) {
            if ($(this).hasClass('layui-form-checked')) {
                var id = $(this).prev().attr('name');
                ids.push(id);
            }
        });

        console.log(ids);
        del(ids);

    }

    function del(ids, obj) {
        layer.confirm('确认要删除吗？', function (index) {
            AjaxPost('/admin/role/del', {ids: ids}, function (data) {
                console.log(data);
                if (data.code === 200) {
                    if(obj){
                        $(obj).parents("tr").remove();
                    }else {
                        xadmin.father_reload();
                    }
                    layer.msg('已删除!', {icon: 1, time: 1000});

                } else {
                    layer.msg('已删除失败!', {icon: 1, time: 1000});
                }
            })
        });
    }

</script>

</html>