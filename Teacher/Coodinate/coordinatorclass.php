<?php
//用户登陆验证

require_once ("../../authentication/CheckUser.php")

?>
<!--班主任：班级成绩-->
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>成绩分析决策系统-班级成绩</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">



    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/dashboard.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">成绩分析决策系统</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#"> <span id="Label7"><?php echo $name ?></span></a>
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
                        <a class="nav-link" href="coordinatorclass.php">
                            <span data-feather="file"></span>
                            班级成绩
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="coordinatorstudent.php">
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

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">班级排名分析图</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-outline-secondary">Share</button>
                        <button class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        This week
                    </button>
                </div>
            </div>

            <canvas class="my-4" id="myChart" width="900" height="380"></canvas>

            <h2>班级各科成绩</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm" style="text-align:center">
                    <thead>
                    <tr>
                        <th>考试时间</th>
                        <th>语文平均成绩</th>
                        <th>数学平均成绩</th>
                        <th>英语平均成绩</th>
                        <th>语文成绩名次</th>
                        <th>数学成绩名次</th>
                        <th>英语成绩名次</th>
                        <th>成绩总排名</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>2018-9-12</td>
                        <td>89</td>
                        <td>78</td>
                        <td>88</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
<br />
<div class="bg-dark" style="color:#fff;text-align:center;width:100%;position:fixed;bottom:0;left:0;">
    @GXNU2018
</div>






<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../../javaScript/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="../../javaScript/popper.min.js"></script>
<script src="../../javaScript/bootstrap.min.js"></script>

<!-- Icons -->
<script src="../../javaScript/feather.min.js"></script>

<!-- Graphs -->
<script src="../../javaScript/Chart.min.js"></script>
<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            datasets: [{
                data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false,
            }
        }
    });
</script>
</body>
</html>
