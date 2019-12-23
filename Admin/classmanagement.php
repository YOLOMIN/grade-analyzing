<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/18
 * Time: 11:52
 */


//打开数据库连接
require_once ("../conn/conn.php");

?>

<html>
<head>

    <link rel="stylesheet" href="../css/bootstrap.min.css">

</head>
<body>


<?php


//控制页数
if(!isset($_GET['page']))
    $page=1;
else
    $page=$_GET['page'];        //取得当前要显示的页面

//设置每页显示的行数
$pageSize=7;

//计算当前页中开始显示的数据行号
$offset=($page-1)*$pageSize;


//获取用户表中的数据

$sql="select * from class";

//执行sql语句
$result=mysqli_query($con,$sql);

//获取数据表中的记录数
$rownum=mysqli_num_rows($result);

//获取总页数----ceil想上取整
$pageCount=ceil($rownum/$pageSize);

//释放结果集中的记录
mysqli_free_result($result);

//编写sql获取分页数据 select * from 表名 limit 起始位置，显示条数
$sql=$sql." limit $offset,$pageSize";

//执行sql语句
$result=mysqli_query($con,$sql);

$num_result = $result->num_rows; //获得当前页需要显示的行数

?>



<!--创建显示数据的表格--->
<div class="container">
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead class="thead-light" align="center">
        <tr>


            <th align="center">班级编号</th>
            <th align="center">班级名称</th>
            <th align="center">学生数量</th>
            <th align="center">班主任编码</th>
            <th align="center">操作1</th>
            <th align="center">操作2</th>
        </tr>
        </thead>

        <?php
        for($i=0;$i<$num_result;$i++) {

            //获取数据 表中的记录
            $array = mysqli_fetch_array($result);

            ?>
            <!---创建表格显示数据--->

            <tr>

                <td align="center"><?php echo $array['classno']?></td>
                <td align="center"><?php echo $array['classname']?></td>
                <td align="center"><?php echo $array['student_num']?></td>
                <td align="center"><?php echo $array['teacherno']?></td>
                <td align="center"><a href='classmanagement/change.php?id=<?php echo $array['id'];?>'><input type="submit" name="del" class="btn" value="修改"/></a></td>
                <td align="center"><a href='classmanagement/delet.php?id=<?php echo $array['id'];?>'><input type="submit" name="del" class="btn" value="删除"/></a></td>


            </tr>




            <?php
        }
        ?>
    </table>






</div>


<!--翻页-->
<div align="center">

            <span>

                <a href="classmanagement/add.php"><input name="addNew" type="button" class="btn" value="添加" /></a>

            </span>


    <span align="center">

                [记录数:<?php echo $rownum ?>|当前第:<?php echo $page ?>页/共:<?php echo $pageCount?>页]

                <?php
                if($page>1) {
                    echo "<a href=classmanagement.php?page=1><input class='btn' type='submit' value='首页'></a>";
                    echo "<a href=classmanagement.php?page=".($page - 1)."><input class='btn' type='submit' value='上一页'></a>";

                }
                ?>
            </span>
    <apan align="center">
        <?php

        if($page<$pageCount) {             //S_SESSION获取当前的网址
            echo "<a href=classmanagement.php?page=" . ($page + 1) . "><input class='btn' type='submit' value='下一页'></a>";
            echo "<a href=classmanagement.php?page=$pageCount><input class='btn' type='submit' value='尾页'></a>";
        }
        ?>
    </apan>


</div>

<!---end---->

</body>


<?php

//释放资源集中的数据
mysqli_free_result($result);

//关闭数据库连接
mysqli_close($con);

?>
</html>





