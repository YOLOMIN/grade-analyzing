<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/2/22
 * Time: 17:02
 */

    session_start();

    if(isset($_SESSION['username'])){

        session_unset();    //free all session  variable
        session_destroy();      //销毁一个会话中所有的数据

        echo "<script> alert('注销成功');parent.location.href='../index.php'; </script>";
    }else{

        echo"<script>alert('注销失败');history.go(-1);</script>";

    }




?>