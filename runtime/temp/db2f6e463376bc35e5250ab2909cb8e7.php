<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"D:\WebSite\htdocs\teaching_evaluation\public/../application/index\view\Login\stu_index.html";i:1573722253;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学生主页</title>
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
</head>
<body>
<!-- 顶部开始 -->
<div class="container">
    <div class="logo"><a href="./index.html">软件工程专业教学系统</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="iconfont">&#xe699;</i>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;"><?php echo \think\Request::instance()->session('TEA_NAME'); ?></a>
        </li>
        <li class="layui-nav-item to-index"><a href="<?php echo url('Login/signOut'); ?>">退出</a></li>
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
                    <cite>课程管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('Student/situationCourse'); ?>">
                            <i class="iconfont">&#xe699;</i>
                            <cite>个人课程表</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="<?php echo url('Student/situClassCourse'); ?>">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            <cite>班级课程表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                    <cite>选课管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('Student/onlineCourse'); ?>">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                            <cite>在线选课</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('Student/onlineCourse'); ?>">
                            <i class="fa fa-file-archive-o" aria-hidden="true"></i>
                            <cite>补考课程</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-window-maximize" aria-hidden="true"></i>
                    <cite>成绩管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('Student/coursePerformance'); ?>">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <cite>课程成绩</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('Student/graduationResults'); ?>">
                            <i class="fa fa-file-archive-o" aria-hidden="true"></i>
                            <cite>毕业设计成绩</cite>
                        </a>
                    </li >
                </ul>
            </li> <!--班级分类-->
            <li>
                <a href="javascript:;">
                    <i class="fa fa-clipboard" aria-hidden="true"></i>
                    <cite>学分管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('Student/getCredit'); ?>">
                            <i class="fa fa-th" aria-hidden="true"></i>
                            <cite>预警科目</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('Student/getCredit'); ?>">
                            <i class="fa fa-wpforms" aria-hidden="true"></i>
                            <cite>学分查询</cite>
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
                        <a _href="<?php echo url('Student/getResources'); ?>">
                            <i class="fa fa-krw" aria-hidden="true"></i>
                            <cite>所有资源</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <cite>毕业设计</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="<?php echo url('Student/topicList'); ?>">
                            <i class="fa fa-window-restore" aria-hidden="true"></i>
                            <cite>选题情况</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('Student/inspectList'); ?>">
                            <i class="fa fa-file-word-o" aria-hidden="true"></i>
                            <cite>论文情况</cite>
                        </a>
                    </li>
                    <li>
                        <a _href="<?php echo url('Student/defenceList'); ?>">
                            <i class="fa fa-minus-square-o" aria-hidden="true"></i>
                            <cite>答辩情况</cite>
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
                        <a _href="<?php echo url('Student/appEvaluation'); ?>">
                            <i class="fa fa-user-md" aria-hidden="true"></i>
                            <cite>申请优秀毕业生</cite>
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
                        <a _href="<?php echo url('Student/personalInformation'); ?>">
                            <i class="fa fa-bookmark-o" aria-hidden="true"></i>
                            <cite>档案查看</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="<?php echo url('Student/account'); ?>">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                            <cite>账户查看</cite>
                        </a>
                    </li >
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