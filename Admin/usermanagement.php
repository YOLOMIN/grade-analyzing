<?php

/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/2/23
 * Time: 12:55
 */

    //连接数据库
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

        $sql="select * from user";

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

                    <th align="center">用户名</th>
                    <th align="center">密码</th>
                    <th align="center">用户类型</th>
                    <th align="center">操作1</th>
                    <th align="center">操作2</th>
                </tr>
            </thead>
            <?php

                for($i=0;$i<$num_result;$i++){


                    //以关联数组形式获取数据表中的记录
                    $array=mysqli_fetch_assoc($result);

                    ?>
            <tr>


             <td><?php  if($page>1) echo $i+$offset+1;else echo $i+1; ?></td>

             <td><?php echo $array['userno'] ?></td>
             <td><?php echo $array['password'] ?></td>
             <td><?php echo $array['usertype'] ?></td>
                <td align="center"><a href='usermanagement/usermodification.php?id= <?php echo $array['id']; ?> '><input type="submit" name="del" class="btn" value="修改"/></a></td>
              <td align="center"><a href='usermanagement/deleteuser.php?id=<?php echo $array['id']; ?>'><input type="submit" name="del" class="btn" value="删除"/></a></td>

            </tr>
            <?php
            }
            ?>





        </table>

        <!--翻页-->
        <div align="center">

            <span>

                <a href="usermanagement/adduser.php"><input name="addNew" type="button" class="btn" value="添加" /></a>

            </span>


            <span align="center">

                [记录数:<?php echo $rownum ?>|当前第:<?php echo $page ?>页/共:<?php echo $pageCount?>页]

                <?php
                if($page>1) {
                    echo "<a href=usermanagement.php?page=1><input class='btn' type='submit' value='首页'></a>";
                    echo "<a href=usermanagement.php?page=".($page - 1)."><input class='btn' type='submit' value='上一页'></a>";

                }
                ?>
            </span>
            <apan align="center">
                <?php

                    if($page<$pageCount) {             //S_SESSION获取当前的网址
                        echo "<a href=usermanagement.php?page=" . ($page + 1) . "><input class='btn' type='submit' value='下一页'></a>";
                        echo "<a href=usermanagement.php?page=$pageCount><input class='btn' type='submit' value='尾页'></a>";
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
