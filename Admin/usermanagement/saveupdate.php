<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/2
 * Time: 17:36
 */


//连接数据库
require_once ("../../conn/conn.php");



//判断添加表单是否提交

if(isset($_POST['addbtn'])){

    $name=$_POST["name"];
    $pwd=$_POST['pwd'];
    $type=$_POST["type"];

    //获取用户表中的最大id

    $select_max='select max(id) from user';

    $result1=mysqli_query($con,$select_max);

    //获取数据集中的最大值
    $max_num=mysqli_fetch_array($result1);

//用于检查$max_num的值
  //  echo $max_num['max(id)'];

    //释放查询结果
    mysqli_free_result($result1);


    //需要对$max_num进行数据转换
    $id=$max_num['max(id)']+1;


    $sql="insert into user(id,userno,password,usertype) values('$id','$name','$pwd','$type')";

    // echo $sql;

    $result=mysqli_query($con,$sql);

    //判断数据是否成功插入数据库
    if(!$result){

        //页面跳转回注册界面

        //检查插入的sqlyuju

//        echo $sql;


       echo "<script> alert('添加失败');parent.location.href='../administrator.php'; </script>";

    }else{

        //页面跳转用户验证界面

        echo "<script> alert('添加成功');parent.location.href='../administrator.php'; </script>";


    }




}








//判修改表单是否提交
if(isset($_POST["btn"])){
    $id=$_POST["ID"];
    $name=$_POST["name"];
    $pwd=$_POST['pwd'];
    $type=$_POST["type"];


    $updat="update user set username='".$name."',password='".$pwd."',usertype='".$type."' where id=".$id;

    $result1=mysqli_query($con,$updat);



    if($result1){
        //修改成功
       // echo "修改成功";

      echo "<script> alert('修改成功');  window.location.href=\"../usermanagement.php\";; </script>";

    }else{
        //修改失败
        echo "修改失败";

        echo $updat;
    }


}else{


    $id=$_POST["ID"];
    echo $id;
    echo "没有表单提交";
}

//关闭数据库连接
mysqli_close($con);




?>


