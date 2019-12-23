<?php
//用户登陆验证

require_once ("../../authentication/CheckUser.php")

?>
<?php
require_once('../../conn/conn.php');
?>
<!--班主任：学生成绩-->

<!DOCTYPE html>


<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>成绩分析决策系统-学生成绩</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link rel="icon" href="../../../../favicon.ico"/>


    <!-- 引入 ECharts 文件 -->
    <script src="../../javaScript/echarts.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link href="../../css/dashboard.css" rel="stylesheet"/>
</head>
<body>

<form id="form1" runat="server">

    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">
            成绩分析决策系统
        </a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="#">
                    <?php echo $name ?>
                </a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky  bg-dark">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="classstudent.php">
                                <span data-feather="file"></span>
                                学生名单 <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ClassScore.php">
                                <span data-feather="file"></span>
                                班级成绩
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="StudentScore.php">
                                <span data-feather="file"></span>
                                学生成绩
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="coordinator.php">
                                <span data-feather="users"></span>
                                个人中心
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../authentication/loginout.php">
                                <span data-feather="bar-chart-2"></span>
                                登出系统
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <!---显示数据表格中的数据--->

            <div class="container">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="thead-light" align="center">
                    <tr>

                        <th align="center">序号</th>

                        <th align="center">学号</th>
                        <th align="center">姓名</th>
                        <th align="center">性别</th>
                    </tr>
                    </thead>





                </table>

            </div>


        </main>
        <?php

        //释放查询的结果集资源
        mysqli_free_result($result);

        //关闭数据库连接
        mysqli_close($con);
        ?>

    </div>
    </div>
    <br/>
    <div class="bg-dark" style="color:#fff;text-align:center;width:100%;position:fixed;bottom:0;left:0;">
        @GXNU2018
    </div>






    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->





    <script src="../../javaScript/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../../javaScript/popper.min.js"></script>
    <script src="../../javaScript/bootstrap.min.js"></script>
    <script src="../../javaScript/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

    <!-- Graphs -->
    <script src="../../javaScript/Chart.min.js"></script>


</form>
</body>
</html>