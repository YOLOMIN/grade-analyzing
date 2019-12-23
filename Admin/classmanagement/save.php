<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/18
 * Time: 11:56
 */






//连接数据库
require_once ("../../conn/conn.php");

//如果添加按钮提交
if(isset($_POST['addbtn'])){

$classno=$_POST['classno'];
$id=$_POST['ID'];
$classname=$_POST['classname'];
$student_num=$_POST['student_num'];
$teacherno=$_POST['teacherno'];

$sql="insert into class (id,classname,classno,student_num,teacherno) values('$id','$classname','$classno','$student_num','$teacherno')";

// echo $sql;

$result=mysqli_query($con,$sql);

//判断数据是否成功插入数据库
if(!$result){

//页面跳转回注册界面

//检查插入的sqlyuju
//  echo $sql;


//关闭数据库连接
mysqli_close($con);

echo "<script> alert('添加失败');  window.location.href=\"../classmanagement.php\"; </script>";
}else{


//关闭数据库连接
mysqli_close($con);



echo "<script> alert('添加成功');  window.location.href=\"../classmanagement.php\"; </script>";

}


}




//如果提交修改按钮
if(isset($_POST['changebtn'])){


    $classno=$_POST['classno'];
    $id=$_POST['ID'];
    $classname=$_POST['classname'];
    $student_num=$_POST['student_num'];
    $teacherno=$_POST['teacherno'];

    $updat="update class set classname='".$classname."',classno='".$classno."',student_num='".$student_num."',teacherno='".$teacherno."' where id=".$id;

    $result1=mysqli_query($con,$updat);

    if($result1){
        //修改成功
        // echo "修改成功";

        echo "<script> alert('修改成功');  window.location.href=\"../coursemanagement.php\"; </script>";

    }else{
        //修改失败
        echo "修改失败";

        echo $updat;
    }




}




//关闭数据库连接
mysqli_close($con);






?>