<?php

/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/2/23
 * Time: 12:55
 */

//连接数据库
require_once ("../../conn/conn.php");
require_once ("../../authentication/CheckUser.php");
?>

<html>
<head>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">

</head>
<body>

<?php


//获取用户表中的数据

$sql="select * from teacher,class where teacher.tname='".$name."' and class.teacherno=class.teacherno";
//执行sql语句

//执行sql语句
$result=mysqli_query($con,$sql);

?>

<!---显示数据表格中的数据--->

<div class="container">
    <h1 class="h2" style="text-align:center">个人信息</h1>
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead class="thead-light" align="center">
        <tr>

            <th align="center">工号</th>

            <th align="center">姓名</th>

            <th align="center">工作单位</th>
            <th align="center">管理班级编号</th>
            <th align="center">管理班级名称</th>
        </tr>
        </thead>
        <?php

            //以关联数组形式获取数据表中的记录
            $array=mysqli_fetch_assoc($result);

            ?>
            <tr>

                <td align="center"><?php echo $array['teacherno'] ?></td>
                <td align="center"><?php echo $array['tname'] ?></td>

                <td align="center"><?php echo $array['workunit'] ?></td>
                <td align="center"><?php echo $array['classno'] ?></td>
                <td align="center"><?php echo $array['classname'] ?></td>

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
</html>
