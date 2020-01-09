<!DOCTYPE html>
<html class="x-admin-sm">

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.2</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/lib/layui/layui.js" charset="utf-8"></script>
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
<div class="x-nav">
            <span class="layui-breadcrumb">
                <a href="/admin/index">首页</a>
                <a>
                    <cite>文章分类</cite></a>
            </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
    </a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">

                <div class="layui-card-header">
                    <button class="layui-btn layui-btn-danger" onclick="delAll()">
                        <i class="layui-icon"></i>批量删除
                    </button>
                    <button class="layui-btn" onclick="xadmin.open('增加分类','/admin/category/add',500,500)" lay-submit=""
                            lay-filter="sreach"><i class="layui-icon"></i>增加分类
                    </button>
                </div>


                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th width="20">
                                <input type="checkbox" id="checkbox-all" name="" lay-skin="primary">
                            </th>
                            <th width="70">ID</th>
                            <th>分类名</th>
                            <th width="50">排序</th>
                            <th width="80">状态</th>
                            <th width="250">操作</th>
                        </thead>
                        <tbody class="x-cate">

                        @foreach($list as $value)
                            <tr cate-id='{{ $value['id'] }}' fid='{{ $value['parent_id'] }}'>
                                <td>
                                    <input type="checkbox" name="{{ $value['id'] }}" lay-skin="primary">
                                </td>
                                <td>{{ $value['id'] }}</td>
                                <td>
                                    @if(count($value['child']) > 0)
                                        <i class="layui-icon x-show" status='true'>&#xe623;</i>@else &nbsp; @endif
                                    {{ $value['name'] }}
                                </td>
                                <td><input type="text" class="layui-input x-sort" name="order" value="1"></td>
                                <td>
                                    <input type="checkbox" name="switch" lay-text="开启|停用"
                                           @if($value['is_open'] == 1) checked @endif
                                           lay-skin="switch" id="{{ $value['id'] }}">
                                </td>
                                <td class="td-manage">
                                    <button class="layui-btn layui-btn layui-btn-xs"
                                            onclick="xadmin.open('编辑','/admin/category/edit/{{ $value['id'] }}',500,500)"><i
                                                class="layui-icon">&#xe642;</i>编辑
                                    </button>
                                    <button class="layui-btn layui-btn-warm layui-btn-xs"
                                            onclick="xadmin.open('添加子栏目','/admin/category/addChild/{{ $value['id'] }}',500,500)">
                                        <i class="layui-icon">&#xe642;</i>添加子栏目

                                    </button>
                                    <button class="layui-btn-danger layui-btn layui-btn-xs"
                                            onclick="delOne('{{ $value['id'] }}',this)" href="javascript:;"><i
                                                class="layui-icon">&#xe640;</i>删除
                                    </button>
                                </td>
                            </tr>
                            @foreach($value['child'] as $child)
                                <tr cate-id='{{ $child['id'] }}' fid='{{ $child['parent_id'] }}'>
                                    <td>
                                        <input type="checkbox" name="{{ $child['id'] }}" lay-skin="primary">
                                    </td>
                                    <td>{{ $child['id'] }}</td>
                                    <td>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        @if(count($child['child']) > 0)<i class="layui-icon x-show" status='true'>&#xe623;</i>@else
                                            ├ @endif
                                        {{ $child['name'] }}
                                    </td>
                                    <td><input type="text" class="layui-input x-sort" name="order" value="1"></td>
                                    <td>
                                        <input type="checkbox" name="switch" lay-text="开启|停用"
                                               @if($child['is_open'] == 1) checked @endif
                                               lay-skin="switch" id="{{ $child['id'] }}">
                                    </td>
                                    <td class="td-manage">
                                        <button class="layui-btn layui-btn layui-btn-xs"
                                                onclick="xadmin.open('编辑','/admin/category/edit/{{ $child['id'] }}',500,500)"><i
                                                    class="layui-icon">&#xe642;</i>编辑
                                        </button>
                                        <button class="layui-btn layui-btn-warm layui-btn-xs"
                                                onclick="xadmin.open('添加子栏目','/admin/category/addChild/{{ $child['id'] }}',500,500)">
                                            <i class="layui-icon">&#xe642;</i>添加子栏目
                                        </button>
                                        <button class="layui-btn-danger layui-btn layui-btn-xs"
                                                onclick="delOne('{{ $child['id'] }}',this)" href="javascript:;"><i
                                                    class="layui-icon">&#xe640;</i>删除
                                        </button>
                                    </td>
                                </tr>

                                @foreach($child['child'] as $cd)
                                    <tr cate-id='{{ $cd['id'] }}' fid='{{ $cd['parent_id'] }}'>
                                        <td>
                                            <input type="checkbox" name="{{ $cd['id'] }}" lay-skin="primary">
                                        </td>
                                        <td>{{ $cd['id'] }}</td>
                                        <td>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            ├{{ $cd['name'] }}
                                        </td>
                                        <td><input type="text" class="layui-input x-sort" name="order" value="1"></td>
                                        <td>
                                            <input type="checkbox" name="switch" lay-text="开启|停用"
                                                   @if($cd['is_open'] == 1) checked @endif
                                                   lay-skin="switch" id="{{ $cd['id'] }}">
                                        </td>
                                        <td class="td-manage">
                                            <button class="layui-btn layui-btn layui-btn-xs"
                                                    onclick="xadmin.open('编辑','/admin/category/edit/{{ $cd['id'] }}',500,500)">
                                                <i class="layui-icon">&#xe642;</i>编辑
                                            </button>
                                            <button class="layui-btn layui-btn-warm layui-btn-xs"
                                                    onclick="xadmin.open('添加子栏目','/admin/category/addChild/{{ $cd['id'] }}',500,500)">
                                                <i class="layui-icon">&#xe642;</i>添加子栏目
                                            </button>
                                            <button class="layui-btn-danger layui-btn layui-btn-xs"
                                                    onclick="delOne('{{ $cd['id'] }}',this)" href="javascript:;"><i
                                                        class="layui-icon">&#xe640;</i>删除
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    layui.use(['form'], function () {
        form = layui.form;

    });

    /*删除一个*/
    function delOne(id,obj) {
        var ids = [id];
        del(ids);
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
            $.post('/admin/category/del', {ids: ids}, function (data) {
                console.log(data);
                if (data.code === 200) {
                    if(obj) $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                } else {
                    layer.msg('已删除失败!', {icon: 1, time: 1000});
                }
            })
        });
    }

    // 分类展开收起的分类的逻辑
    //
    $(function () {
        $("tbody.x-cate tr[fid!='0']").hide();
        // 栏目多级显示效果
        $('.x-show').click(function () {
            if ($(this).attr('status') == 'true') {
                $(this).html('&#xe625;');
                $(this).attr('status', 'false');
                cateId = $(this).parents('tr').attr('cate-id');
                $("tbody tr[fid=" + cateId + "]").show();
            } else {
                cateIds = [];
                $(this).html('&#xe623;');
                $(this).attr('status', 'true');
                cateId = $(this).parents('tr').attr('cate-id');
                getCateId(cateId);
                for (var i in cateIds) {
                    $("tbody tr[cate-id=" + cateIds[i] + "]").hide().find('.x-show').html('&#xe623;').attr('status', 'true');
                }
            }
        });


        $('thead .layui-form-checkbox').on('click', function () {
            if ($(this).hasClass('layui-form-checked')) {
                $('tbody .layui-form-checkbox').addClass('layui-form-checked');
            } else {
                $('tbody .layui-form-checkbox').removeClass('layui-form-checked');
            }
        });


        // 切换开启和停用状态
        $('.layui-form-switch').on('click', function () {

            var that = $(this);
            var id = $(this).prev().attr('id');

            $.post('/admin/category/status/' + id, function (data) {
                console.log(data);
                if (data.data.status === 1) {
                    that.addClass('layui-form-onswitch');
                    that.html('<em>启用</em>')
                } else {
                    that.removeClass('layui-form-onswitch');
                    that.html('<em>停用</em>')
                }
            })

        });


    });

    var cateIds = [];

    function getCateId(cateId) {
        $("tbody tr[fid=" + cateId + "]").each(function (index, el) {
            id = $(el).attr('cate-id');
            cateIds.push(id);
            getCateId(id);
        });
    }

</script>
</body>
</html>
