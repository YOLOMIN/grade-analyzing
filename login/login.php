<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/2/3
 * Time: 15:28
 */

    require_once ("../conn/conn.php");     //首先连接数据库


    session_start();

    $name1=$_POST['user'];
    $password1=$_POST['pwd'];

    $select='select * from user where userno="'."$name1".'" and password="'."$password1".'"';



    $result=mysqli_query($con,$select);

        //从结果集中获取数据记录的个数
        $numcount=mysqli_num_rows($result);

        $numcount=$numcount+1;

    if($numcount){

        // echo "查询成功";

        $rownum=mysqli_fetch_array($result);

        $name2=$rownum['username'];
        //进行用户类型验证

        $_SESSION['username']="$name2";
        $_SESSION['userno']="$name1";

        if($rownum['usertype']=='学生'){
            //跳转学生界面

            echo "<script> alert('登陆成功，欢迎同学您！');parent.location.href='../student/student.php'; </script>";

        }else if($rownum['usertype']=='教师'){
            //跳转教师界面

            $_SESSION['username']="$name1";

            echo "<script> alert('登陆成功，欢迎老师您！');parent.location.href='../Teacher/teacher.php'; </script>";

        }else if($rownum['usertype']=='管理员'){

            $_SESSION['username']="$name1";

            echo "<script> alert('登陆成功，欢迎您，管理员！');parent.location.href='../Admin/administrator.php'; </script>";


        }else if($rownum['usertype']=='班主任'){
            $sql_classno = "select * from teacher where teacherno =".$name1;
            $classno_result=mysqli_query($con,$sql_classno);
            $row_classno=mysqli_fetch_array($classno_result);
            $_SESSION['classno'] = $row_classno['classno'];
            echo "<script> alert('登陆成功，欢迎班主任您！ ');parent.location.href='../Teacher/Coodinate/coordinator.php'; </script>";
        }else{

            echo "<script> alert('请您验证身份信息！');parent.location.href='../authentication/authentication.php'; </script>";

            //游客登陆 进行用户类型判定

        }

    }else{

        //echo $select;
        //echo $numcount;

        echo "<script> alert('登陆失败');parent.location.href='#'; </script>";


    }


    mysqli_free_result($result);        //释放查询的结果集资源
    mysqli_close($con);
    ?>