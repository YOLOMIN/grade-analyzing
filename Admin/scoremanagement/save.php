<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/17
 * Time: 21:08
 */



//连接数据库
require_once ("../../conn/conn.php");

//如果添加按钮提交
if(isset($_POST['addbtn'])){

    $studentno=$_POST['studentno'];
    $id=$_POST['ID'];
    $courseno=$_POST['courseno'];
    $score=$_POST['score'];
    $time=$_POST['time'];

    $sql="insert into score(id,studentno,courseno,score,time) values('$id','$studentno','$courseno','$score','$time')";

    // echo $sql;

    $result=mysqli_query($con,$sql);

    //判断数据是否成功插入数据库
    if(!$result){

        //页面跳转回注册界面

        //检查插入的sqlyuju
       // echo $sql;


        //关闭数据库连接
        mysqli_close($con);

        echo "<script> alert('添加失败');  window.location.href=\"../scoremanagement.php\"; </script>";
    }else{


        //关闭数据库连接
        mysqli_close($con);



        echo "<script> alert('添加成功');  window.location.href=\"../scoremanagement.php\"; </script>";

    }


}




//如果提交修改按钮
if(isset($_POST['changebtn'])){

    $studentno=$_POST['studentno'];
    $id=$_POST['ID'];
    $courseno=$_POST['courseno'];
    $score=$_POST['score'];
    $time=$_POST['time'];

    $updat="update score set studentno='".$studentno."',courseno='".$courseno."',score='".$score."' where id=".$id;

    $result1=mysqli_query($con,$updat);

    if($result1){
        //修改成功
        // echo "修改成功";

        echo "<script> alert('修改成功');  window.location.href=\"../scoremanagement.php\"; </script>";

    }else{
        //修改失败
        echo "修改失败";

        echo $updat;
    }









}




//关闭数据库连接
mysqli_close($con);






?>