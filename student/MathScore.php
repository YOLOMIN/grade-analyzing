<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/6
 * Time: 18:30
 */

?>
<?php

/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/2/23
 * Time: 12:55
 */

//连接数据库
require_once ("../conn/conn.php");
//require_once ("../authentication/CheckUser.php");
session_start();
$name=$_SESSION['userno'];
?>

<html>
<head>

    <link rel="stylesheet" href="../css/bootstrap.min.css">

</head>
<body>
<tr>
    <td align="center"><a href='SearchScore.php'><input type="submit" name="del" class="btn" value="全部"/></a></td>
</tr>
<tr>
    <td align="center"><a href='SingleSubjectScore.php'><input type="submit" name="del" class="btn" value="语文"/></a></td>
</tr>
<tr>
    <td align="center"><a href='Englishscore.php'><input type="submit" name="del" class="btn" value="英语"/></a></td>
</tr>

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
$sql="select student.studentno,student.sname,course.courserno,course.cname,score.score,score.time
from student,score,course
where student.studentno=score.studentno
and score.courseno=course.id
and score.courseno='2'
and student.studentno='$name'
GROUP BY time";

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

<!---显示数据表格中的数据--->

<div class="container">
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead class="thead-light" align="center">
        <tr>
            <th align="center">序号</th>
            <th align="center">课程</th>
            <th align="center">分数</th>
            <th align="center">时间</th>
        </tr>
        </thead
        <?php
        for($i=0;$i<$num_result;$i++){


            //以关联数组形式获取数据表中的记录
            $array=mysqli_fetch_assoc($result);

            ?>
            <tr>
                <td>
                    <?php if($page>1) echo $i+$offset;else echo $i+1; ?></td>
                <td><?php echo $array['cname'] ?></td>
                <td><?php echo $array['score'] ?></td>
                <td><?php echo $array['time'] ?></td>
            </tr>
            <?php
        }
        ?>




    </table>

    <!--翻页-->
    <div align="center">


        <span align="center">

                [记录数:<?php echo $rownum ?>|当前第:<?php echo $page ?>页/共:<?php echo $pageCount?>页]

                <?php
                if($page>1) {
                    echo "<a href=MathScore.php?page=1><input class='btn' type='submit' value='首页'></a>";
                    echo "<a href=MathScore.php?page=".($page - 1)."><input class='btn' type='submit' value='上一页'></a>";

                }
                ?>
            </span>
        <apan align="center">
            <?php

            if($page<$pageCount) {             //S_SESSION获取当前的网址
                echo "<a href=MathScore.php?page=" . ($page + 1) . "><input class='btn' type='submit' value='下一页'></a>";
                echo "<a href=MathScore.php?page=$pageCount><input class='btn' type='submit' value='尾页'></a>";
            }
            ?>
        </apan>


    </div>

    <!--end-->
</div>





</body>
<?php

//释放查询的结果集资源
mysqli_free_result($result);

//关闭数据库连接
mysqli_close($con);
?>
</html>
