<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:102:"D:\WebSite\htdocs\teaching_evaluation\public/../application/index\view\teacher\tea-add-evaluation.html";i:1573749563;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> 评优材料添加</title>
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
          <cite>申请优秀指导</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
            <button type="button" name="myfile" class="layui-btn" id="myfile"><i class="layui-icon"></i>上传申请材料文件</button>
        <span style="color: #01AAED; font-weight: bold">只允许上传{word文档，压缩包}</span><span class="x-right" style="line-height:40px">共有数据：<?php echo $getListCount; ?> 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>序号</th>
            <th>姓名</th>
            <th>申请年份</th>
            <th>文件名称</th>
            <th>审核备注</th>
            <th>审核状态</th>
            <th >操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($getList) || $getList instanceof \think\Collection || $getList instanceof \think\Paginator): $i = 0; $__LIST__ = $getList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $list['tea_name']; ?></td>
            <td><?php echo $list['tea_excellent_year']; ?></td>
            <td><?php echo $list['tea_excellent_name']; ?></td>
            <?php if($list['tea_excellent_remarks'] == ''): ?>
            <td><font style="color: #0b927b">无</font></td>
            <?php endif; if($list['tea_excellent_remarks'] != ''): ?>
            <td><?php echo $list['tea_excellent_remarks']; ?></td>
            <?php endif; if($list['tea_excellent_status'] == 0): ?>
            <td><font style="color: #0b927b">待审批</font></td>
            <?php endif; if($list['tea_excellent_status'] == 1): ?>
            <td><font style="color: #01AAEE">已通过</font></td>
            <?php endif; if($list['tea_excellent_status'] == 2): ?>
            <td><font style="color: red">未通过</font></td>
            <?php endif; ?>
            <td class="td-manage">
                <a title="删除" onclick="member_del(this,'<?php echo $list['tea_excellent_id']; ?>')" href="javascript:;">
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
    //文件上传
    layui.use('upload', function(){
        var upload=layui.upload;
        upload.render({ //允许上传的文件后缀
            elem: '#myfile'
            ,url: "<?php echo url('Teacher/fileUpload'); ?>"
            ,accept: 'file' //普通文件
            ,exts: 'doc|docx|zip|rar' //只允许上传压缩文件
            ,done: function(res){
                if(res.code==1){
                    layer.msg(res.msg,{end:function(){location.reload();}, icon:1});
                }else{
                    layer.msg('上传失败',{icon:5});
                }
            }
        });
    });
    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $.ajax({
                type: 'POST',
                url: 'http://te.com/index/Teacher/deleEvaluation',
                data: {tea_excellent_id:id},
                success:
                    function (stu) {
                        var data = JSON.parse(stu);
                        if(data.code==1){
                            $(obj).parents("tr").remove();
                            layer.msg('已移除!',{icon:1});
                            location.reload();
                            // layer.msg(data.msg,{end:function(){location.reload();}, icon:1},$(obj).parents("tr").remove());
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