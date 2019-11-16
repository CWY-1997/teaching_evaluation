<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"D:\WebSite\htdocs\teaching_evaluation\public/../application/index\view\Login\sys_index.html";i:1573919123;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>系统管理员主页</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="shortcut icon" href="/static/index/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/static/index/css/font.css">
    <link rel="stylesheet" href="/static/index/css/xadmin.css">
    <link rel="stylesheet" href="/static/index/font-awesome-4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="/static/index/js/jquer.min.js"></script>
    <script src="/static/index/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/static/index/js/xadmin.js"></script>
    <style>
        .imgss{
            width: 35px;
            height: 35px;
            margin: 0px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<!-- 顶部开始 -->
<div class="container">
    <div class="logo"><a href="./index.html">软件工程教学管理系统</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="iconfont">&#xe699;</i>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item"> <img src="/portrait/<?php echo \think\Request::instance()->session('USER_IMG'); ?>"class="imgs imgss"/></li>
        <li class="layui-nav-item">
        <li class="layui-nav-item"><?php echo \think\Request::instance()->session('TEA_NAME'); ?></a></li>
        <li class="layui-nav-item to-index"><a href="<?php echo url('Login/signOut'); ?>">退出</a></li>
        </li>
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
                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                    <cite>用户管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('faculty_management/listFaculty'); ?>">
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                            <cite>手动添加用户</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="<?php echo url('faculty_management/listFaculty'); ?>">
                            <i class="fa fa-file-text" aria-hidden="true"></i>
                            <cite>批量添加用户</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="<?php echo url('faculty_management/listFaculty'); ?>">
                            <i class="fa fa-user-o" aria-hidden="true"></i>
                            <cite>设置用户账户权限</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="<?php echo url('student_registration/listStuden'); ?>">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            <cite>用户密码重置</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <cite>功能管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('class_info/listClass'); ?>">
                            <i class="fa fa-power-off" aria-hidden="true"></i>
                            <cite>功能开启</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                    <cite>日志管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('student_registration/listStuden'); ?>">
                            <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                            <cite>登陆日志</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('student_registration/listStuden'); ?>">
                            <i class="fa fa-hand-o-up" aria-hidden="true"></i>
                            <cite>操作日志</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-file-code-o" aria-hidden="true"></i>
                    <cite>数据备份</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('student_registration/listStuden'); ?>">
                            <i class="fa fa-square" aria-hidden="true"></i>
                            <cite>数据库备份</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('student_registration/listStuden'); ?>">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                            <cite>数据更新</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <cite>个人信息</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('student_fileManage/deleStudentFile'); ?>">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <cite>密码修改</cite>
                        </a>
                    </li >
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
            <li class="home"><i class="layui-icon">&#xe68e;</i>我的桌面</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src="<?php echo url('Login/welcome'); ?>" frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="page-content-bg"></div>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
<!-- 底部开始 -->
<div class="footer">
    <div class="copyright">Copyright ©2019  All Rights Reserved</div>
</div>
<!-- 底部结束 -->
</body>
</html>