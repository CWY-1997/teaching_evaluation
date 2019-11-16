<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"D:\WebSite\htdocs\teaching_evaluation\public/../application/index\view\teacher\timetable.html";i:1573741182;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> 教师个人课程表信息</title>
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
        <a href="">教师课程管理</a>
        <a>
          <cite>教师课程表</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
        <div class="layui-row">
            <div class="layui-form layui-col-md12 x-so" style="   margin-bottom: 0px;">
                <input type="text" id="stu_idcard"  placeholder="请输入课程名称" autocomplete="off" class="layui-input">
                <button class="layui-btn"  lay-submit="" lay-filter="sreach" onclick="search()"><i class="layui-icon">&#xe615;</i></button>
                <span class="x-right" style="line-height:40px">共有数据：<?php echo $getListCount; ?> 条</span>
            </div>
        </div>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>序号</th>
            <th>课程名称</th>
            <th>课程年份</th>
            <th>学期</th>
            <th>班级名称</th>
            <th>学分</th>
            <th>合班</th>
            <th>人数</th>
            <th>考试/考查</th>
            <th>上课周期</th>
            <th>课程状态</th>
            <th>课程状态切换</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($getList) || $getList instanceof \think\Collection || $getList instanceof \think\Paginator): $i = 0; $__LIST__ = $getList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $list['course_name']; ?></td>
            <td><font style="color:#FF5722"><?php echo $list['course_year']; ?>年</font></td>
            <?php if($list['course_semester'] == 0): ?>
            <td><font style="color: #0b927b">上学期</font></td>
            <?php endif; if($list['course_semester'] == 1): ?>
            <td><font style="color: #1E9FFF">下学期</font></td>
            <?php endif; if($list['course_semester'] == 2): ?>
            <td><font style="color:#2F4056">全学年</font></td>
            <?php endif; ?>
            <td><?php echo $list['classes_name']; ?></td>
            <td><?php echo $list['course_credit']; ?></td>
            <?php if($list['course_type'] == 0): ?>
            <td><font style="color:#1E9FFF">小班</font></td>
            <?php endif; if($list['course_type'] == 1): ?>
            <td><font style="color:#0b927b">合班</font></td>
            <?php endif; ?>
            <td><?php echo $list['course_number']; ?>人</td>
            <?php if($list['course_examine'] == 0): ?>
            <td><font style="color:#1E9FFF">考试</font></td>
            <?php endif; if($list['course_examine'] == 1): ?>
            <td><font style="color:#0b927b">考查</font></td>
            <?php endif; ?>
            <td><?php echo $list['course_cycle']; ?>周</td>
            <?php if($list['teaching_status'] == 0): ?>
            <td><font style="color:#0b927b">待授课</font></td>
            <td>
                <button class="layui-btn" onclick="beingCourse(this,'<?php echo $list['teaching_id']; ?>')">正在授课</button>
            </td>
            <?php endif; if($list['teaching_status'] == 1): ?>
            <td><font style="color:#1E9FFF">正在授课</font></td>
            <td>
                <button class="layui-btn layui-btn-danger" onclick="endCourse(this,'<?php echo $list['teaching_id']; ?>')">授课结束</button>
            </td>
            <?php endif; if($list['teaching_status'] == 2): ?>
            <td><font style="color:#0b927b">授课结束</font></td>
            <td>
                授课结束
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="page">
        <div>
            <?php echo $getList->render(); ?>
        </div>
    </div>
</div>
</body>
<script>
    /*修改为正在授课*/
    function beingCourse(obj,id){
        layer.confirm('确认要修改吗？',function(index){
            //发异步删除数据
            $.ajax({
                type: 'POST',
                url: 'http://te.com/index/Teacher/beingCourse',
                data: {teaching_id:id},
                success:
                    function (stu) {
                        var data = JSON.parse(stu);
                        if(data.code==1){
                            layer.msg(data.msg,{icon:1});
                            location.reload();
                        }else if(data.code==-1){
                            layer.alert(data.msg, {icon: 5});
                        }
                        return false;
                    },
                error: function (data) {
                    alert("error");
                }
            });
        });
    }
    /*修改为结束授课*/
    function endCourse(obj,id){
        layer.confirm('确认要修改吗？',function(index){
            //发异步删除数据
            $.ajax({
                type: 'POST',
                url: 'http://te.com/index/Teacher/endCourse',
                data: {teaching_id:id},
                success:
                    function (stu) {
                        var data = JSON.parse(stu);
                        if(data.code==1){
                            layer.msg(data.msg,{icon:1});
                            location.reload();
                        }else if(data.code==-1){
                            layer.alert(data.msg, {icon: 5});
                        }
                        return false;
                    },
                error: function (data) {
                    alert("error");
                }
            });
        });
    }
</script>
</html>