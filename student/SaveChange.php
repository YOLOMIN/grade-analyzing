<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/2
 * Time: 17:36
 */


//连接数据库
require_once ("../conn/conn.php");


//判修改表单是否提交
if(isset($_POST["btn"])){
    $username=$_POST["username"];
    $studentno=$_POST["studentno"];
    $sex=$_POST["sex"];
    $sname=$_POST["sname"];
    $classno=$_POST["classno"];


    $updat="update student set username='".$username."',studentno='".$studentno."',sex='".$sex."',classno='".$classno."',sname='".$sname."'where studentno=".$studentno;

    $result1=mysqli_query($con,$updat);



    if($result1){
        //修改成功
        // echo "修改成功";

        echo "<script> alert('修改成功');  window.location.href=\"SaveChange.php\";; </script>";
    }else{
        //修改失败
        echo "修改失败";

        echo $updat;
    }
    }//else{
    //$username=$_POST["username"];
   // echo $username;
//    echo "没有表单提交";
//}
//关闭数据库连接
mysqli_close($con);

?>



