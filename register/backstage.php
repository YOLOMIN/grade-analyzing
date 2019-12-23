<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/2/12
 * Time: 13:13
 */


    require_once ("../conn/conn.php");     //首先连接数据库

    //打开制定数据库
    mysqli_select_db($con,'school');

    $username=$_POST['username'];
    $password=$_POST['password'];
    $pwd_again=$_POST['pwd_again'];
    $usertype='游客';

    if($username==""||$password==""||$pwd_again==""){
        //如果信息存在空

        echo "<script> alert('请确认信息完整!');parent.location.href='../register/register.php'; </script>";

    }else{

//        echo $username;
//        echo $password;
//        echo $pwd_again;


        if($password!=$pwd_again){

           //页面跳转回注册界面
            echo "<script> alert('两次输入的密码不一致，请重新输入!');parent.location.href='../register/register.php'; </script>";


        }else{


            //进行用户表查表，如果已经存在相同的用户名，则再次进行注册！

            $select="select * from user where username='".$username."'";
            $result_select=mysqli_query($con,$select);
            $usernumber=mysqli_num_rows($result_select);





            //检测查询用户表的sql语句
            echo $select;



            //如果用户表中不存在该数据，则进行注册
            if(!$usernumber){
                $select='select * from user';

                $result=mysqli_query($con,$select);

                //从结果集中获取数据记录的个数
                $numcount=mysqli_num_rows($result);

                $numcount=$numcount+1;


                $sql="insert into user(id,userno,password,usertype) values('$numcount','$username','$password','$usertype')";

                //  echo $sql;

                $result=mysqli_query($con,$sql);

                //判断数据是否成功插入数据库
                if(!$result){

                    //页面跳转回注册界面

                    echo "<script> alert('注册失败');parent.location.href='../register/register.php'; </script>";

                }else{

                    //页面跳转用户验证界面

                    echo "<script> alert('注册成功，请完善用户信息!');parent.location.href='../authentication/authentication.php'; </script>";


                }


            }else{

                //已经存在相关数据
                echo "<script> alert('注册失败，该用户名已经存在!');parent.location.href='../register/register.php'; </script>";

            }







        }

    }

    //关闭数据库
    mysqli_close($con);


?>