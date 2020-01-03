<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.2</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <link rel="stylesheet" href="/css/pagination.css">
    <script src="/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="/admin/index">首页</a>
            <a href="#">在线留言</a>
          </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">

                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>

                            <th>标题</th>
                            <th>用户名</th>
                            <th>手机号</th>
                            <th>邮箱</th>
                            <th>地址</th>
                            <th>内容</th>
                            <th>阅读状态</th>
                            <th>提交时间</th>
                        </thead>
                        <tbody>
                        @foreach($list as $val)
                        <tr>
                            <td>{!! $val['title'] !!}</td>
                            <td>{!! $val['name'] !!}</td>
                            <td>{!! $val['mobile'] !!}</td>
                            <td>{!! $val['email'] !!}</td>
                            <td>{!! $val['address'] !!}</td>
                            <td>{!! $val['content'] !!}</td>
                            <td>{!! $val['state'] !!}</td>
                            <td>{{ $val['created_at'] }}</td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="layui-card-body ">
                    {{ $list->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    layui.use(['laydate','form'], function(){
        var laydate = layui.laydate;
        var form = layui.form;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });


</script>

</html>