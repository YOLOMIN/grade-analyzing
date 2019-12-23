<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/12
 * Time: 21:14
 */
?>
<?php
/**
* Created by PhpStorm.
* User: lenovo
* Date: 2019/2/23
* Time: 15:48
*/

//打开数据库连接
require_once ("../conn/conn.php");
require_once ("../authentication/CheckUser.php");
//打开指定数据库


?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>个人中心 - 学生成绩分析系统</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<?php

//获取成绩表中数据

$sql = "select * from  student where username='$name' ";

//执行sql语句
$result = mysqli_query($con, $sql);

//获取数据表中的行数
$rownum = mysqli_num_rows($result);
$array = mysqli_fetch_array($result);

//echo $sql;

?>

<div class="container">
    <h1 class="h2" style="text-align:center">个人信息</h1>
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead class="thead-light" align="center">
        <tr>



            <th align="center">学号</th>

            <th align="center">用户名</th>
            <th align="center">姓名</th>
            <th align="center">性别</th>
            <th align="center">学校</th>
            <th align="center">班级</th>


        </tr>
        </thead>

        <tr>

            <td align="center"><?php echo $array['studentno'] ?></td>
            <td align="center"><?php echo $array['username'] ?></td>

            <td align="center"><?php echo $array['sname'] ?></td>
            <td align="center"><?php echo $array['sex'] ?></td>
            <td align="center"><?php echo $array['school'] ?></td>
            <td align="center"><?php echo $array['classno'] ?></td>

        </tr>






    </table>
</div>



</body>
<?php

//释放查询的结果集资源
mysqli_free_result($result);

//关闭数据库连接
mysqli_close($con);
?>
<!---  创建表格显示数据--->
