<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/Public/css/login.css" />
</head>
<body>
<div class="pagewrap">
    <div class="main">
        <div class="header"></div>
        <div class="content">
            <div class="con_right">
                <div class="con_r_top"></div>
                <ul>
                    <li class="con_r_right" style="display: block;">
                        <form name="form1" method="post" action="./admin/action/login_do.php" autocomplete="off">
                            <div class="user">
                                <div><span class="user-icon"></span>
                                    <input type="text" name="username" class="" placeholder="手机号码"/>
                                </div>

                                <div><span class="mima-icon"></span>
                                    <input type="text" name="code" id="code" class="" placeholder="验证码"  style="width:150px;" />
                                    <img id="img" alt="验证码" src="<?php echo U('verify');?>" title="点击刷新" onclick="refresh();"><br />
                                </div>
                                <div><span class="yzmz-icon"></span>
                                    <input id="vdcode" type="password" name="pwd" placeholder="密码" value="" style="width:150px;">
                                    <input id="sendCode" type="button" value="发送验证码" >　　
                                </div>
                                <div>
                                    <button id="btn_Login" type="button">注 册</button>
                                </div>
                            </div><br>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="/Public/js/jquery-3.2.1.min.js"></script>
<script>
    function refresh(){
        var img = $('#img');
        var verifyimg = img.attr("src");
        img.attr('title', '点击刷新');
        img.click(function(){
            if( verifyimg.indexOf('?')>0){
                $(this).attr("src", verifyimg+'&random='+Math.random());
            }else{
                $(this).attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
            }
        });
    }
    $('#btn_Login').on("click",function (){
        refresh();
        var code = $('#code').val();
        $.ajax({
            type:"post",
            url:"<?php echo U('check');?>",
            data:"code="+code,//可有可无
            dataType:"json",//可有可无
            error:function(msg){
                alert("验证码错误");
            },
            success:function(msg){
                if(msg){
                    alert('成功');
                }else{
                    alert("验证码错误");
                }
            }
        });

    });

</script>
</body>
</html>