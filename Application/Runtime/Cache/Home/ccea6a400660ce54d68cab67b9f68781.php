<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style type="text/css">
        body{
            margin:0;
            padding:0;
            text-align:center;
            background:lightyellow;
        }
        #container{
            width:966px;
            margin:0 auto;
            text-align:left;
            height:800px
        }
        #content{
            padding:0;
            width:500px;
            margin:100px auto;
            text-align:center;
            height:200px
        }
        .clear{
            height:5px;
            clear:both;
        }
        #sendICode{
            height:30px;
        }
    </style>
</head>
<body>
<div id="container">
    <div id="content">
        <form action="<?php echo U('index');?>" method="post">
            <input style="width:210px;height:30px;border:solid 1px;" type="text" placeholder="请输入手机号"><br />
            <div class="clear"></div>
            <input style="width:100px;height:30px;border:solid 1px;" type="text" placeholder="请输入验证码">
            <img alt="验证码" src="<?php echo U('verify');?>" title="点击刷新"><br />
            <div class="clear"></div>
            <input style="width:125px;height:30px;border:solid 1px;" type="password" placeholder="请输入密码">
            <button id="sendICode">发送密码</button>
        </form>
    </div>
</div>
</body>
</html>