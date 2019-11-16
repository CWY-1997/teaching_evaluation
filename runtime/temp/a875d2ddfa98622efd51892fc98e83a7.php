<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:100:"D:\WebSite\htdocs\teaching_evaluation\public/../application/index\view\secretary\stu-evaluation.html";i:1573916938;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> 学生评优材料查看</title>
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
        <a href="">评优管理</a>
        <a>
          <cite>申请材料查看</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
        <div class="layui-row">
            <div class="layui-form layui-col-md12 x-so" style="   margin-bottom: 0px;">
                <input type="text" id="stu_idcard"  placeholder="请输入学生身份证" autocomplete="off" class="layui-input">
                <button class="layui-btn"  lay-submit="" lay-filter="sreach" onclick="search()"><i class="layui-icon">&#xe615;</i></button>
                <span class="x-right" style="line-height:40px">共有数据：<?php echo $getListCount; ?> 条</span>
            </div>
        </div>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>序号</th>
            <th>姓名</th>
            <th>申请年份</th>
            <th>文件名称</th>
            <th>文件下载</th>
            <th>审核备注</th>
            <th>审核状态</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($getList) || $getList instanceof \think\Collection || $getList instanceof \think\Paginator): $i = 0; $__LIST__ = $getList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $list['stu_name']; ?></td>
            <td><?php echo $list['stu_excellent_year']; ?></td>
            <td><a title="下载"  href="http://te.com/appraising/student/<?php echo $list['stu_excellent_path']; ?>"><font style="color: red">下载</font></a></td>
            <td><?php echo $list['stu_excellent_name']; ?></td>
            <?php if($list['stu_examine_remarks'] == ''): ?>
            <td><font style="color: #0b927b">无</font></td>
            <?php endif; if($list['stu_examine_remarks'] != ''): ?>
            <td><?php echo $list['stu_examine_remarks']; ?></td>
            <?php endif; if($list['stu_excellent_status'] == 0): ?>
            <td><font style="color: #0b927b">待审批</font></td>
            <?php endif; if($list['stu_excellent_status'] == 1): ?>
            <td><font style="color: #01AAEE">已通过</font></td>
            <?php endif; if($list['stu_excellent_status'] == 2): ?>
            <td><font style="color: red">未通过</font></td>
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
<script>
    /*审核通过*/
    function member_del(obj,id){
        layer.confirm('确认审核通过吗？',function(index){
            //发异步删除数据
            $.ajax({
                type: 'POST',
                url: 'http://te.com/index/Teaching/adoptEvaluation',
                data: {stu_excellent_id:id},
                success:
                    function (stu) {
                        var data = JSON.parse(stu);
                        if(data.code==1){
                            $(obj).parents("tr").remove();
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
</body>

</html>