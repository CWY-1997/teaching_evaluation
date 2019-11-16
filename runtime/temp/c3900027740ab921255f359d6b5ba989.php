<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:105:"D:\WebSite\htdocs\teaching_evaluation\public/../application/index\view\teaching\personal-information.html";i:1573750387;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> 个人信息查看</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/static/index/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/static/index/css/font.css">
    <link rel="stylesheet" href="/static/index/css/xadmin.css">
    <script type="text/javascript" src="/static/index/js/jquer.min.js"></script>
    <script type="text/javascript" src="/static/index/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/static/index/js/xadmin.js"></script>
    <script type="text/javascript" src="/static/index/js/jquery-1.11.0.min.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="/static/index/html5.min.js"></script>
    <script src="/static/index/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">个人信息</a>
        <a>
          <cite>教师信息查看</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div style="margin-left: 15%;">
    <form class="layui-form">
        <div class="x-body layui-anim layui-anim-up layui-col-md12">
            <div class="layui-form-item">
                <label for="stuName" class="layui-form-label">
                    <span class="x-red">*</span>姓名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="stuName" required="" lay-verify="stuName" value="<?php echo $getList['tea_name']; ?>"  readonly="true"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>教师姓名
                </div>
                <label for="stuCard" class="layui-form-label">
                    <span class="x-red">*</span>身份证
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="stuCard" required="" lay-verify="stuIdcard" value="<?php echo $getList['tea_idcard']; ?>"  readonly="true"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>学生身份证
                </div>
            </div>
            <div class="layui-form-item">
                <label for="stuNative" class="layui-form-label">
                    <span class="x-red"></span>手机
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="stuNative" required="" value="<?php echo $getList['tea_phone']; ?>"  readonly="true"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red"></span>教师手机
                </div>
            </div>
            <div class="layui-form-item">
                <label for="userNumber" class="layui-form-label">
                    <span class="x-red"></span>工号
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="userNumber" required="" value="<?php echo $getList['tea_number']; ?>"  readonly="true"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red"></span>教师工号
                </div>
                <label for="stuCollege" class="layui-form-label">
                    <span class="x-red"></span>学院
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="stuCollege" required="" value="<?php echo $getList['tea_college']; ?>"  readonly="true"
                           autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red"></span>教师所在学院
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>