<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"D:\WebSite\htdocs\teaching_evaluation\public/../application/index\view\Login\tea_index.html";i:1573907438;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>教师主页</title>
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
                    <i class="fa fa-server" aria-hidden="true"></i>
                    <cite>教师课程管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('Teacher/timetable'); ?>">
                            <i class="iconfont">&#xe699;</i>
                            <cite>教师课程表</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="<?php echo url('Teacher/onlineCourse'); ?>">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            <cite>申请授课</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('Teacher/courseSelection'); ?>">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                            <cite>学生选课情况</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                    <cite>作业与实验管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('Teacher/homeworkCorrection'); ?>">
                            <i class="iconfont">&#xe699;</i>
                            <cite>作业与实验批改</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="<?php echo url('Teacher/assignment'); ?>">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            <cite>作业布置</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-window-maximize" aria-hidden="true"></i>
                    <cite>课程成绩管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('Teacher/coursePerformance'); ?>">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <cite>课程成绩录入</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('Teacher/graduation'); ?>">
                            <i class="fa fa-window-restore" aria-hidden="true"></i>
                            <cite>优秀毕业成绩</cite>
                        </a>
                    </li >
                </ul>
            </li> <!--班级分类-->
            <li>
                <a href="javascript:;">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <cite>学生毕业设计</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('Teacher/addGuidanceStu'); ?>">
                            <i class="fa fa-window-restore" aria-hidden="true"></i>
                            <cite>添加指导学生名单</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('Teacher/getTopic'); ?>">
                            <i class="fa fa-window-restore" aria-hidden="true"></i>
                            <cite>学生选题情况</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('Teacher/getInspect'); ?>">
                            <i class="fa fa-file-word-o" aria-hidden="true"></i>
                            <cite>学生论文情况</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="<?php echo url('Teacher/getDefence'); ?>">
                            <i class="fa fa-minus-square-o" aria-hidden="true"></i>
                            <cite>学生答辩情况</cite>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-universal-access" aria-hidden="true"></i>
                    <cite>评优管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('Teacher/appEvaluation'); ?>">
                            <i class="fa fa-user-md" aria-hidden="true"></i>
                            <cite>申请优秀指导</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-file-text" aria-hidden="true"></i>
                    <cite>资源管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('Teacher/getResources'); ?>">
                            <i class="fa fa-krw" aria-hidden="true"></i>
                            <cite>所有资源</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('Teacher/upResources'); ?>">
                            <i class="fa fa-bookmark-o" aria-hidden="true"></i>
                            <cite>上传资源</cite>
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
                        <a _href="<?php echo url('Teacher/personalInformation'); ?>">
                            <i class="fa fa-bookmark-o" aria-hidden="true"></i>
                            <cite>基本信息</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('Teacher/account'); ?>">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                            <cite>账户查看</cite>
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