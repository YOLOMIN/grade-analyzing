<?php

//用户登陆验证

require_once ("../authentication/CheckUser.php");


?>

<html xmlns="http://www.w3.org/1999/xhtml">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>
        成绩分析决策系统-管理员
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description">
    <meta name="author">
    <link rel="icon" href="../favicon.ico">
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
    <style>
        .head-padding {
            padding: 0px;
        }
        .seach-margin {
            margin: 10px 0px;
        }
        .btn-left-margin {
            margin-left: 10px;
        }
        .margin-top {
            margin-left: 0;
            margin-right: 0;
            margin-bottom: 20px;
        }
        tbody > tr {
            height: 50px;
            font-size: 16px;
        }
        tr > th, td {
            padding-left: 15px;
            width: 206px;
        }
        th {
            background-color: #eee;
            font-size: 16px;
            font-weight: 600;
        }
        tr:hover {
            background-color: #fafafa;
            border-top: 1px solid #eee;
        }
    </style>
</head>

<body>
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
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky  bg-dark col-md-12">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="usermanagement.php" target="main">
                                <span data-feather="home">
                                </span>
                        用户管理
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="scoremanagement.php" target="main">
                                <span data-feather="file">
                                </span>
                        成绩管理
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="teachermanagement.php" target="main">
                                <span data-feather="file">
                                </span>
                        教师管理
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="studentmanagement.php" target="main">
                                <span data-feather="file">
                                </span>
                        学生管理
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="coursemanagement.php" target="main">
                                <span data-feather="file">
                                </span>
                        科目管理
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="classmanagement.php" target="main">
                                <span data-feather="file">
                                </span>
                        班级管理
                    </a>
                </li>



                <li class="nav-item">
                    <a class="nav-link" href="../authentication/loginout.php">
                                <span data-feather="bar-chart-2">
                                </span>
                        登出系统
                    </a>
                </li>
            </ul>
        </div>
    </nav>



    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

        <!--可以添加内容-->



        <iframe name="main" src="usermanagement.php" width="100%" height="100%" scrolling="auto" frameborder="0" align="top">

        </iframe>
        <!---end--->


    </main>

</div>
<div class="bg-dark" style="color:#fff; text-align:center; width:100%; position:fixed; bottom: 0; left: 0;z-index: 9999">
    @GXNU2018
</div>
<!-- Bootstrap core JavaScript==================================================-->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../javaScript/jquery-3.2.1.slim.min.js">
</script>
<script src="../javaScript/bootstrap.min.js">
</script>
<!-- Icons -->
<script src="../javaScript/feather.min.js">
</script>
<script>
    feather.replace()
</script>
<!-- Graphs -->
<script src="../javaScript/Chart.min.js">
</script>
</body>

</html>