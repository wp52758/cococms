<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>CMS TEST</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <!-- <link rel="stylesheet" href="./css/theme5.css"> -->
    <script src="/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        // 是否开启刷新记忆tab功能
        // var is_remember = false;
    </script>
</head>
<body class="index">
<!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a href="/admin/index">CMS TEST</a></div>
    <div class="left_open">
        <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
    </div>

    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">admin</a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="xadmin.open('个人信息','http://www.baidu.com')">个人信息</a>
                </dd>
                <dd>
                    <a href="/admin/login">退出</a>
                </dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index">
            <a href="/">前台首页</a></li>
    </ul>
</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->

<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="首页">&#xe6d7;</i>
                    <cite>首页</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>

            </li>
            <li>
                <a onclick="xadmin.add_tab('网址配置','/admin/siteSetting')">
                    <i class="iconfont left-nav-li" lay-tips="网址配置">&#xe6ae;</i>
                    <cite>网站配置</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>

            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="文章管理">&#xe6fc;</i>
                    <cite>文章管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('文章分类','/admin/category/list')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>文章分类</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('文章列表','/admin/article/list')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>文章列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('单页','/admin/singlePage/list')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>单页</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a onclick="xadmin.add_tab('在线留言','/admin/message/list')">
                    <i class="iconfont left-nav-li" lay-tips="在线留言">&#xe72d;</i>
                    <cite>在线留言</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>

            </li>
            <li>
                <a onclick="xadmin.add_tab('友情链接','/admin/friendLink/list')">
                    <i class="iconfont left-nav-li" lay-tips="友情链接">&#xe6f7;</i>
                    <cite>友情链接</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>

            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="管理员管理">&#xe726;</i>
                    <cite>管理员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('管理员列表','admin-list.html')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>管理员列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('角色管理','admin-role.html')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>角色管理</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('权限分类','admin-cate.html')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>菜单管理</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('权限管理','admin-rule.html')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限管理</cite></a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>

<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">

    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title">
            <li class="home">
                <i class="layui-icon">&#xe68e;</i>我的桌面
            </li>
        </ul>
        <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
            <dl>
                <dd data-type="this">关闭当前</dd>
                <dd data-type="other">关闭其它</dd>
                <dd data-type="all">关闭全部</dd>
            </dl>
        </div>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='/admin/welcome' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
        </div>
        <div id="tab_show"></div>
    </div>

</div>
<div class="page-content-bg"></div>
<style id="theme_style"></style>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->

</body>

</html>

​