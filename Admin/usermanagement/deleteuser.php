<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/2
 * Time: 14:07
 */

//连接数据库
require_once ("../../conn/conn.php");

if(isset($_GET["id"])){

    //通过GET的表单传值方式获取id
    $id=$_GET["id"];

    //创建sql语句
    $delet="delete  from user where id=".$id;

    //执行sql语句
//    mysql_query() 仅对 SELECT，SHOW，EXPLAIN 或 DESCRIBE 语句返回一个资源标识符，如果查询执行不正确则返回 FALSE。
//    对于其它类型的 SQL 语句，mysql_query() 在执行成功时返回 TRUE，出错时返回 FALSE。
    $result=mysqli_query($con,$delet);

    //如果删除成功
    if($result){

   //删除成功，提示删除成功，然后进行页面跳转

        echo "<script> alert('删除成功');parent.location.href='../administrator.php'; </script>";


    }else{
        //如果删除不成功，则输出sql语句查看结果

        echo $delet;


    }

}

//关闭数据库连接
mysqli_close($con);



?>