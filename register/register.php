<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/2/12
 * Time: 11:53
 */
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="IE=11.0000"
          http-equiv="X-UA-Compatible">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>成绩分析决策系统-注册页面</title>


    <style>
        body {
            background: #ebebeb;
            font-family: "Helvetica Neue","Hiragino Sans GB","Microsoft YaHei","\9ED1\4F53",Arial,sans-serif;
            color: #222;
            font-size: 12px;
        }

        * {
            padding: 0px;
            margin-left: 0px;
            margin-right: 0px;
            margin-top: 0px;
        }

        .top_div {
            background: #008ead;
            width: 100%;
            height: 400px;
        }

        .ipt {
            border: 1px solid #d3d3d3;
            padding: 10px 10px;
            width: 290px;
            border-radius: 4px;
            padding-left: 35px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }

        .ipt:focus {
            border-color: #66afe9;
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
        }

        .u_logo {
            background: url("../images/username.png") no-repeat;
            padding: 10px 10px;
            position: absolute;
            top: 43px;
            left: 40px;
        }

        .p_logo {
            background: url("../images/password.png") no-repeat;
            padding: 10px 10px;
            position: absolute;
            top: 12px;
            left: 40px;
        }

        a {
            text-decoration: none;
        }

        .tou {
            background: url("../images/tou.png") no-repeat;
            width: 97px;
            height: 92px;
            position: absolute;
            top: -87px;
            left: 140px;
        }

        .left_hand {
            background: url("../images/left_hand.png") no-repeat;
            width: 32px;
            height: 37px;
            position: absolute;
            top: -38px;
            left: 150px;
        }

        .right_hand {
            background: url("../images/right_hand.png") no-repeat;
            width: 32px;
            height: 37px;
            position: absolute;
            top: -38px;
            right: -64px;
        }

        .initial_left_hand {
            background: url("../images/hand.png") no-repeat;
            width: 30px;
            height: 20px;
            position: absolute;
            top: -12px;
            left: 100px;
        }

        .initial_right_hand {
            background: url("../images/hand.png") no-repeat;
            width: 30px;
            height: 20px;
            position: absolute;
            top: -12px;
            right: -112px;
        }

        .left_handing {
            background: url("../images/left-handing.png") no-repeat;
            width: 30px;
            height: 20px;
            position: absolute;
            top: -24px;
            left: 139px;
        }

        .right_handinging {
            background: url("../images/right_handing.png") no-repeat;
            width: 30px;
            height: 20px;
            position: absolute;
            top: -21px;
            left: 210px;
        }
    </style>

    <script type="text/javascript">
        $(function (){
            //得到焦点
            $("#password").focus(function () {
                $("#left_hand").animate({
                    left: "150",
                    top: " -38"
                }, {
                    step: function () {
                        if (parseInt($("#left_hand").css("left")) > 140) {
                            $("#left_hand").attr("class", "left_hand");
                        }
                    }
                }, 2000);
                $("#right_hand").animate({
                    right: "-64",
                    top: "-38px"
                }, {
                    step: function () {
                        if (parseInt($("#right_hand").css("right")) > -70) {
                            $("#right_hand").attr("class", "right_hand");
                        }
                    }
                }, 2000);
            });
            //失去焦点
            $("#password").blur(function () {
                $("#left_hand").attr("class", "initial_left_hand");
                $("#left_hand").attr("style", "left:100px;top:-12px;");
                $("#right_hand").attr("class", "initial_right_hand");
                $("#right_hand").attr("style", "right:-112px;top:-12px");
            });
        });
    </script>

    <meta name="GENERATOR" content="MSHTML 11.00.9600.17496">
</head>
<body>
<form id="form1" action="backstage.php" method="post" >
    <div class="top_div"></div>
    <div style="background: rgb(255, 255, 255); margin: -100px auto auto; border: 1px solid rgb(231, 231, 231); border-image: none; width: 400px; height: 250px; text-align: center;">
        <div style="width: 165px; height: 96px; position: absolute;">
            <div class="tou"></div>
            <div class="initial_left_hand" id="left_hand"></div>
            <div class="initial_right_hand" id="right_hand"></div>
        </div>
        <p style="padding: 30px 0px 10px; position: relative;">
            <span class="u_logo"></span>         <input class="ipt" name="username" type="text" placeholder="请输入账号" name="UserName">
        </p>
        <p style="position: relative;">
            <span class="p_logo"></span>
            <input class="ipt" name="password" type="password" placeholder="请输入密码" name="password">
        </p>

        <p style="position: relative;">
            <span class="p_logo"></span>
            <input class="ipt" name="pwd_again" type="password" placeholder="请重新输入密码" name="password">
        </p>


        <p style="margin: 10px 35px 20px 45px;">

            <span style="float:left;">
                <input type="checkbox" name="remember">
                <a style="color: #383b3f;">同意协议</a>
            </span>
        </p>

        <p style ="margin: 40px 35px 10px 45px;">

            <span style="float:initial;">
                <input type="submit" name="UserLogin" value="注册" id="UserLogin" style="color:White;background-color:#008EAD;border-color:#008EAD;border-width:4px;border-style:solid;height:40px;width:224px;">
            </span>
        </p>

    </div>
</form>
</body>
</html>

