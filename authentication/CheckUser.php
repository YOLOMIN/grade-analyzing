<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/2/22
 * Time: 16:25
 */


    //用于判断用户是否已经登陆

    session_start();
    $name=$_SESSION['username'];

    if(isset($_SESSION['username'])&&!empty($_SESSION['username'])){




        //echo "<script>alert(\"尊敬的$name,欢迎回来\");</script>";

    }else{

        echo "<script> alert('您尚未登陆，请返回登陆!');parent.location.href='../index.php'; </script>";

    }





?>