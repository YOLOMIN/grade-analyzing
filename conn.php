<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/2/3
 * Time: 14:39
 */

//    header("Content-type:text/html;charset=utf-8");     //设置编码
//    $con=mysqli_connect("localhost","root","") or die("数据库连接失败");
//    mysqli_select_db('login',$con) or die('指定的数据库不能打开');
 //  mysqli_query("set names utf8");         //设置数据库的字符集


    $servername="localhost";
    $username="root";
    $password="";

    //创建连接
    $con=mysqli_connect($servername,$username,$password);
    mysqli_set_charset( $con ,'utf8' );
    //检测连接
    if(!$con){
        //如果连接错误，输出错误信息

        die("Connection failedd:".mysqli_connect_error());
    }

   // echo "连接成功";
//打开指定数据库
    mysqli_select_db($con,'school');

?>