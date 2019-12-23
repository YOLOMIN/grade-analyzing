<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/18
 * Time: 8:46
 */

//连接数据库
require_once ("../../conn/conn.php");



//注意：添加功能需要查看是否存在相同的主键，如果相同则进行提醒


//如果添加按钮提交
if(isset($_POST['addbtn'])){

    $studentno=$_POST['studentno'];
    $id=$_POST['ID'];
    $username=$_POST['username'];
    $sname=$_POST['sname'];
    $sex=$_POST['sex'];
    $school=$_POST['school'];
    $classno=$_POST['classno'];

    $sql="insert into student(id,studentno,username,sname,sex,school,classno) values('$id','$studentno','$username','$sname','$sex','$school','$classno')";

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
    $username=$_POST['username'];
    $sname=$_POST['sname'];
    $sex=$_POST['sex'];
    $school=$_POST['school'];
    $classno=$_POST['classno'];


    $updat="update student set studentno='".$studentno."',username='".$username."',sname='".$sname."',sex='".$sex."',school='".$school."',classno='".$classno."' where id=".$id;

    $result1=mysqli_query($con,$updat);

    if($result1){
        //修改成功
        // echo "修改成功";

        echo "<script> alert('修改成功');  window.location.href=\"../studentmanagement.php\"; </script>";

    }else{
        //修改失败
        echo "修改失败";

        echo $updat;
    }









}




//关闭数据库连接
mysqli_close($con);












?>