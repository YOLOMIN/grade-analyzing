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
$userno=$_POST['userno'];

if($username==""||$password==""||$pwd_again==""){
    //如果信息存在空

    echo "<script> alert('请确认信息完整！');parent.location.href='../register/register.php'; </script>";

}else{

//        echo $username;
//        echo $password;
//        echo $pwd_again;


    if($password!=$pwd_again){

        //页面跳转回注册界面
        echo "<script> alert('两次输入的密码不一致，请重新输入!');parent.location.href='../register/register.php'; </script>";


    }else{

        //获取用户表中的id
        $select_id="select * from user where userno='$userno'";

        //用户类型身份验证


        //进行学生验证
        $select_st='select * from student where studentno='.$username;

        //进行教师验证
        $select_te='select * from teacher where teacherno='.$username;

        $result_st=mysqli_query($con,$select_st);
        $result_te=mysqli_query($con,$select_te);
        $result_id=mysqli_query($con,$select_id);

        //从结果集中获取数据记录的个数
        $numcount_st=mysqli_num_rows($result_st);
        $numcount_te=mysqli_num_rows($result_te);
        $numcount_id=mysqli_num_rows($result_id);

        //获取数据中的username值
        $row_st=mysqli_fetch_array($result_st);
        $row_te=mysqli_fetch_array($result_te);
        $row_id=mysqli_fetch_array($result_id);


//        echo $select_id."\n";
//        echo $select_st."\n";
//        echo $select_te."\n";

        //判断用户表中是否存在数据
        if($numcount_id){

            //判断是否是学生
            if($numcount_st){

                $usertype='学生';

               // $sql="update user set usertype= '"."$usertype' where username='".$row_st['username']."'";
                $sql="update user set usertype='".$usertype."',username='".$row_id['userno']."',userno='".$row_st['studentno']."' where id=".$row_id['id'];



                $result=mysqli_query($con,$sql);

                //修改成功
                if($result) {
                    //页面跳转回注册界面
                    echo "<script> alert('学生资格验证成功,请登陆');parent.location.href='../index.php'; </script>";

                }else{

                    echo "<script> alert('验证失败,请联系管理员');parent.location.href='authentication.php'; </script>";

                }

                //判断是否是教师
            }else if($result_te){

                $usertype='教师';

              //  $sql="update user set usertype= '"."$usertype' where username='".$row_te['username']."'";

                $sql="update user set usertype='".$usertype."',username='".$row_id['userno']."',userno='".$row_te['teacherno']."' where id=".$row_id['id'];
                $result=mysqli_query($con,$sql);


                if($result) {
                    //页面跳转回登陆界面
                    echo "<script> alert('教师资格验证成功,请登陆');parent.location.href='../index.php'; </script>";
                }else{

                    echo "<script> alert('验证失败,请联系管理员');parent.location.href='authentication.php'; </script>";

                }
            }else{
                //验证失败 重新验证
                echo "<script> alert('验证失败,请联系管理员');parent.location.href='authentication.php'; </script>";

            }









        }



    }

}

//关闭数据库
mysqli_close($con);


?>