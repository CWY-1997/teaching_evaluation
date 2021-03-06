<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"D:\WebSite\htdocs\teaching_evaluation\public/../application/index\view\secretary\account.html";i:1573750430;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> 账户信息查看</title>
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
    <script type="text/javascript" src="/static/index/js/jquery.md5.js"></script>
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
          <cite>账户查看</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div style="margin-left: 15%;">
    <form class="layui-form">
        <div class="x-body layui-anim layui-anim-up layui-col-md4">
            <div class="layui-form-item">
                    <img src="/portrait//<?php echo $stuInfo['user_img']; ?>" class="imgs"/>
                <button type="button" name="myfile" class="layui-btn" id="myfile">更换头像</button>
            </div>
        </div>
        <div class="x-body layui-anim layui-anim-up layui-col-md4">
            <div class="layui-form-item">
                <label for="stuName" class="layui-form-label">
                    <span class="x-red">*</span>登陆账号
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="stuName" required="" lay-verify="stuName" value="<?php echo $stuInfo['user_number']; ?>"  readonly="true" style="color: #999999"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="stuCard" class="layui-form-label">
                    <span class="x-red">*</span>登陆密码
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="stuPass" required="" lay-verify="stuIdcard" placeholder="如需要修改密码请输入"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="arepass" class="layui-form-label">
                </label>
                <button  class="layui-btn" type="button" onclick="add()">
                    修改密码
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    layui.use('upload', function(){
        var upload=layui.upload;
        upload.render({ //允许上传的文件后缀
            elem: '#myfile'
            ,url: "<?php echo url('Student/account'); ?>"
            ,accept: 'file' //普通文件
            ,exts: 'jpg' //只允许jpg格式
            ,done: function(res){
                if(res.code==1){
                    layer.msg("照片更换成功",{
                        end:function(){
                            location.reload();
                        },
                        icon:1
                    });
                }else{
                    layer.msg('解析失败',{icon:5});
                }
            }
        });
    });
    function add(){
        layer.confirm('确认修改密码吗？',function(index){
            var user_pass= $.md5($("#stuPass").val());
            //发异步删除数据
            $.ajax({
                type: 'POST',
                url: 'http://te.com/index/Student/account',
                data: {user_pass:user_pass},
                success:
                    function (stu) {
                        var data = JSON.parse(stu);
                        if(data.code==1){
                            layer.msg(data.msg,{end:function(){location.reload();}, time:700, icon:1});
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
    };
</script>
</body>
</html>