<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/17
 * Time: 23:04
 */


//连接数据库
require_once ("../../conn/conn.php");



//注意：添加功能需要查看是否存在相同的主键，如果相同则进行提醒


//如果添加按钮提交
if(isset($_POST['addbtn'])){

    //获取参数
    $teacherno=$_POST['teacherno'];
    $id=$_POST['ID'];
    $username=$_POST['username'];
    $tname=$_POST['tname'];
    $workunit=$_POST['workunit'];
    $type=$_POST['type'];

    $classno=$_POST['classno'];


    $sql="insert into teacher(id,teacherno,username,tname,workunit,type,classno) values('$id','$teacherno','$username','$tname','$workunit','$type','$classno')";

    //echo $sql;

    $result=mysqli_query($con,$sql);

    //判断数据是否成功插入数据库
    if(!$result){


        //检查插入的sqlyuju
        // echo $sql;

        //关闭数据库连接
        mysqli_close($con);

       echo "<script> alert('添加失败');  window.location.href=\"../teachermanagement.php\"; </script>";
    }else{

        //关闭数据库连接
        mysqli_close($con);

        //页面跳转用户验证界面

        echo "<script> alert('添加成功');  window.location.href=\"../teachermanagement.php\"; </script>";

    }


}






//如果提交修改按钮
if(isset($_POST['changebtn'])){

    $teacherno=$_POST['teacherno'];
    $id=$_POST['ID'];
    $username=$_POST['username'];
    $tname=$_POST['tname'];
    $workunit=$_POST['workunit'];
    $type=$_POST['type'];

    $classno=$_POST['classno'];

    $updat="update teacher set teacherno='".$teacherno."',username='".$username."',tname='".$tname."',workunit='".$workunit."',type='".$type."',classno='".$classno."' where id=".$id;

    $result1=mysqli_query($con,$updat);

    if($result1){
        //修改成功
        // echo "修改成功";

        echo "<script> alert('修改成功');  window.location.href=\"../teachermanagement.php\"; </script>";

    }else{
        //修改失败
        echo "修改失败";

        echo $updat;
    }




}


//关闭数据库连接
mysqli_close($con);



?>