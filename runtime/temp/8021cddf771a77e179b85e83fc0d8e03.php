<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:98:"D:\WebSite\htdocs\teaching_evaluation\public/../application/index\view\teacher\tea-topic-list.html";i:1573796870;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> 学生选题情况</title>
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
        <a href="">毕业设计管理</a>
        <a>
          <cite>学生选题情况</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
        <div class="layui-row">
            <div class="layui-form layui-col-md12 x-so" style="   margin-bottom: 0px;">
                <input type="text" id="tea_idcard"  placeholder="请输入学号" autocomplete="off" class="layui-input">
                <button class="layui-btn"  lay-submit="" lay-filter="sreach" onclick="search()"><i class="layui-icon">&#xe615;</i></button>
                <button type="button" name="myfile" class="layui-btn" >查看所有未审核</button>
                <button type="button" name="myfile" class="layui-btn" >查看所有审核通过</button>
                <button type="button" name="myfile" class="layui-btn" >查看所有审核不通过</button>
                <span class="x-right" style="line-height:40px">共有数据：<?php echo $getListCount; ?> 条</span>
            </div>
        </div>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>序号</th>
            <th>学号</th>
            <th>姓名</th>
            <th>申请年份</th>
            <th>选题名称</th>
            <th>材料下载</th>
            <th>审核提示</th>
            <th>审核状态</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($getList) || $getList instanceof \think\Collection || $getList instanceof \think\Paginator): $i = 0; $__LIST__ = $getList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $list['user_number']; ?></td>
            <td><?php echo $list['stu_name']; ?></td>
            <td><?php echo $list['topic_year']; ?></td>
            <td><?php echo $list['topic_subject']; ?></td>
            <td><a title="下载"  href="http://te.com/topic/<?php echo $list['topic_path']; ?>" download="<?php echo $list['stu_name']; ?>-<?php echo $list['topic_subject']; ?>"><font style="color: red">下载</font></a></td>
            <td><font style="color: #01AAED"><?php echo $list['topic_remarks']; ?></font></td>
            <?php if($list['topic_status'] == 0): ?>
            <td>
                <button type="button" name="myfile" class="layui-btn layui-btn-radius layui-btn-warm"  onclick="adopt(this,'<?php echo $list['topic_id']; ?>',1)">审核通过</button>
                <button type="button" name="myfile" class="layui-btn layui-btn-radius layui-btn-danger" onclick="adopt(this,'<?php echo $list['topic_id']; ?>',2)" >审核不通过</button>
            </td>
            <?php endif; if($list['topic_status'] == 1): ?>
            <td><font style="color: #0b927b">已通过</font></td>
            <?php endif; if($list['topic_status'] == 2): ?>
            <td><font style="color: #0b927b">审核不通过</font></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
<script>
    /*教师审核学生选题情况*/
    function adopt(obj,id,type){
        if(type == 1){
            var tis = '确定审核通过吗'
        }else{
            var tis = '确定审核不通过吗'
        }
        layer.confirm(tis,function(index){
            //发异步删除数据
            $.ajax({
                type: 'POST',
                url: 'http://te.com/index/Teacher/adoptTopic',
                data: {topic_id:id,topic_type:type},
                success:
                    function (stu) {
                        var data = JSON.parse(stu);
                        if(data.code==1){
                            layer.msg(data.msg,{end:function(){location.reload();}, icon:1});
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