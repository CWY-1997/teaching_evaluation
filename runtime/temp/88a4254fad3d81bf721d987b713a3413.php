<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:109:"D:\WebSite\htdocs\teaching_evaluation\public/../application/index\view\teacher\homework-correction-model.html";i:1573821691;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> 作业提交学生</title>
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
        <a href="">作业提交情况</a>
        <a>
          <cite>作业提交学生</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
        <div class="layui-row">
            <div class="layui-form layui-col-md12 x-so" style="   margin-bottom: 0px;">
                <input type="text" id="stu_idcard"  placeholder="请输入学生学号" autocomplete="off" class="layui-input">
                <button class="layui-btn"  lay-submit="" lay-filter="sreach" onclick="search()"><i class="layui-icon">&#xe615;</i></button>
                <span class="x-right" style="line-height:40px">共有数据：<?php echo $getListCount; ?> 条</span>
            </div>
        </div>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>序号</th>
            <th>上传学生学号</th>
            <th>上传学生姓名</th>
            <th>文件下载</th>
            <th>成绩</th>
            <th>上传时间</th>
            <th>批改状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($getList) || $getList instanceof \think\Collection || $getList instanceof \think\Paginator): $i = 0; $__LIST__ = $getList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $list['user_number']; ?></td>
            <td><?php echo $list['stu_name']; ?></td>
            <td><?php echo $list['course_submi_path']; ?></td>
            <td><input type="text" placeholder="可以不填或填入成绩" autocomplete="off" class="layui-input"></td>
            <td><?php echo $list['course_submi_time']; ?></td>
            <?php if($list['course_submi_tatus'] == 0): ?>
            <td><font style="color: #0b927b">待批改</font></td>
            <td>
                <button class="layui-btn layui-btn-danger">已批改</button>
                <button class="layui-btn layui-btn-danger">不合格</button>
            </td>
            <?php endif; if($list['course_submi_tatus'] == 1): ?>
            <td><font style="color: #0b927b">已批改</font></td>
            <td><font style="color: #0b927b">合格</font></td>
            <?php endif; if($list['course_submi_tatus'] == 2): ?>
            <td><font style="color: #0b927b">已批改</font></td>
            <td><font style="color: #0b927b">不合格</font></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <tr colspan="8" style="text-align: center;">
            <td colspan="8">
                <button class="layui-btn layui-btn-danger" >一键提交批改</button>
            </td>
        </tr>
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