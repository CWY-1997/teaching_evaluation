<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"D:\WebSite\htdocs\teaching_evaluation\public/../application/index\view\login\login.html";i:1573735794;}*/ ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>软件工程教学管理系统</title>
    <script type="text/javascript" src="/static/index/js/xadmin.js"></script>
    <link rel="stylesheet" href="/static/index/css/style.css">
    <script type="text/javascript" src="/static/index/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="/static/index/js/jquery.md5.js"></script>
</head>
<body class="login-bg">
<div class="dowebok" id="dowebok">
    <div class="form-container sign-up-container">
        <div>
            <h1>联系方式</h1>
            <input type="text" placeholder="姓名:陈先生" >
            <input type="text" placeholder="联系电话：1841718****">
            <input type="text" placeholder="地址：9栋**">
        </div>
    </div>
    <div class="form-container sign-in-container">
        <div>
            <h1>登录</h1>
            <input type="text" placeholder="账号" id="username">
            <input type="password" placeholder="密码" id="password">
            <button class="but">登录</button>
        </div>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>已有帐号？</h1>
                <p>请使用您的帐号进行登录</p>
                <button class="ghost" id="signIn">登录</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>没有帐号？</h1>
                <p>立即联系管理员，分配一个账号给您吧</p>
                <button class="ghost" id="signUp">帮助</button>
            </div>
        </div>
    </div>
</div>
<script src="/static/index/js/index.js"></script>
<script>
    $(".but").on("click",function () {
        var user_password= $.md5($("#password").val());
        $.ajax({
            type: 'POST',
            url: 'http://te.com/index/Login/login',
            data: {user_number: $("#username").val(), user_pass: user_password},
            success:
                function (stu) {
                    var data = JSON.parse(stu);
                    if(data.code==1){
                      window.location.href="http://te.com/index/Common/index";
                    }else if(data.code==-1){
                        alert(data.msg);
                        return false
                    }
                    return false;
                },
            error: function (data) {
                alert("error");
            }
        }); //ajax结束
    })
</script>
</body>
</html>