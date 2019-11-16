<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:106:"D:\WebSite\htdocs\teaching_evaluation\public/../application/index\view\student\stu-graduation-results.html";i:1573579097;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> 学生毕业设计成绩</title>
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
        <a href="">成绩管理</a>
        <a>
          <cite>毕业设计成绩</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
        <font style="color:#FF5722"> 未显示的成绩请等待公布，如对成绩有疑问请联系相关老师</font>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>学号</th>
            <th>姓名</th>
            <th>年份</th>
            <th>选题名称</th>
            <th>选题分数</th>
            <th>论文撰写分数</th>
            <th>答辩分数</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $list['user_number']; ?></td>
            <td><?php echo $list['stu_name']; ?></td>
            <td><font style="color:#FF5722"><?php echo $list['grad_year']; ?>年</font></td>
            <?php if($list['topic_subject'] == ''): ?>
            <td><font style="color: #0b927b">待选题</font></td>
            <?php endif; if($list['topic_subject'] != ''): ?>
            <td><font style="color: #1E9FFF"><?php echo $list['topic_subject']; ?></font></td>
            <?php endif; if($list['grad_fraction'] == ''): ?>
            <td><font style="color: #1E9FFF">待公布</font></td>
            <?php endif; if($list['grad_fraction'] != ''): ?>
            <td><font style="color: #0b927b"><?php echo $list['grad_fraction']; ?></font></td>
            <?php endif; if($list['grad_inspect'] == ''): ?>
            <td><font style="color: #0b927b">待公布</font></td>
            <?php endif; if($list['grad_inspect'] != ''): ?>
            <td><font style="color: #1E9FFF"><?php echo $list['grad_inspect']; ?></font></td>
            <?php endif; if($list['grad_defence'] == ''): ?>
            <td><font style="color: #1E9FFF">待公布</font></td>
            <?php endif; if($list['grad_inspect'] != ''): ?>
            <td><font style="color: #0b927b"><?php echo $list['grad_defence']; ?></font></td>
            <?php endif; ?>
        </tr>

        </tbody>
    </table>
</div>
</body>
</html>