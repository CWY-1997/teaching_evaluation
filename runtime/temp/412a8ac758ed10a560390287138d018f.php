<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:100:"D:\WebSite\htdocs\teaching_evaluation\public/../application/index\view\teacher\tea-add-guidance.html";i:1573806882;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> 添加指导学生</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/static/index/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/static/index/css/font.css">
    <link rel="stylesheet" href="/static/index/css/xadmin.css">
    <script type="text/javascript" src="/static/index/js/jquer.min.js"></script>
    <script type="text/javascript" src="/static/index/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/static/index/js/xadmin.js"></script>
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
        <a href="">学生毕业设计</a>
        <a>
          <cite>添加指导学生名单</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
        <div class="layui-input-inline">
            <input type="text" id="user_number" required lay-verify="required" placeholder="请输入学生学号" autocomplete="off" class="layui-input">
        </div>
        <button class="layui-btn" onclick="member_add()"><i class="layui-icon"></i>添加新学生</button>
        <span class="x-right" style="line-height:40px">共有数据： <?php echo $getListCount; ?>条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>序号</th>
            <th>指导年份</th>
            <th>学生学号</th>
            <th>学生姓名</th>
            <th>手机</th>
            <th>审核状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($getList) || $getList instanceof \think\Collection || $getList instanceof \think\Paginator): $i = 0; $__LIST__ = $getList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $list['guidance_year']; ?></td>
            <td><?php echo $list['user_number']; ?></td>
            <td><?php echo $list['stu_name']; ?></td>
            <td><?php echo $list['stu_phone']; ?></td>
            <?php if($list['guidance_status'] == 0): ?>
            <td><font style="color:#01AAED">待审核</font></td>
            <?php endif; if($list['guidance_status'] == 1): ?>
            <td><font style="color: #0b927b">已通过</font></td>
            <?php endif; if($list['guidance_status'] == 2): ?>
            <td><font style="color:#FF5722">未通过</font></td>
            <?php endif; ?>
            <td class="td-manage">
                <a title="删除" onclick="member_del(this,'<?php echo $list['guidance_id']; ?>')" href="javascript:;">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
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
<script>
    /*添加学生*/
    function member_add(){
        layer.confirm('确认要添加学生吗？',function(index){
            //发异步删除数据
            $.ajax({
                type: 'POST',
                url: 'http://te.com/index/Teacher/addStudent',
                data: {user_number:$("#user_number").val()},
                success:
                    function (stu) {
                        var data = JSON.parse(stu);
                        if(data.code==1){
                            layer.msg(data.msg,{end:function(){location.reload();}, icon:1,time:500});
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
    /*删除学生*/
    function member_del(obj,id){
        layer.confirm('确认要删除学生吗？',function(index){
            //发异步删除数据
            $.ajax({
                type: 'POST',
                url: 'http://te.com/index/Teacher/deleStudent',
                data: {guidance_id:id},
                success:
                    function (stu) {
                        var data = JSON.parse(stu);
                        if(data.code==1){
                            layer.msg(data.msg,{end:function(){location.reload();}, icon:1,time:500});
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
</body>

</html>