<?php
//用户登陆验证

require_once ("../../authentication/CheckUser.php")

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
                            <a class="nav-link active" href="coordinatorclass.php">
                                <span data-feather="home"></span>
                                班级成绩 <span class="sr-only">(current)</span>
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
                <!--
              <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
                    -->
                <!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
                <div id="main" style="width:100%;height:600px;"></div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm" style="text-align:center">
                <thead>
                <tr>
                    <th>考试时间</th>
                    <th>姓名</th>
                    <th>学号</th>
                    <th>总成绩</th>
                    <th>名次</th>
                </tr>
                </thead>
            </table>
        </div>
        </main>
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

    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        setTimeout(function () {

            var china = ['语文及格人数', 60];
            var math = ['数学及格人数', 86];
            var english = ['英语及格人数', 24];
            option = {
                legend: {},
                tooltip: {
                    trigger: 'axis',
                    showContent: false
                },
                title: {
                    text: '学生成绩分析曲线图'
                },
                dataset: {
                    source: [
                        ['product', '2012', '2013', '2014', '2015', '2016', '2017'],
                        china,
                        math,
                        english,
                        away
                    ]
                },
                xAxis: { type: 'category' },
                yAxis: { gridIndex: 0 },
                grid: { top: '55%' },
                series: [
                    { type: 'line', smooth: true, seriesLayoutBy: 'row' },
                    { type: 'line', smooth: true, seriesLayoutBy: 'row' },
                    { type: 'line', smooth: true, seriesLayoutBy: 'row' },
                    { type: 'line', smooth: true, seriesLayoutBy: 'row' },
                    {
                        type: 'pie',
                        id: 'pie',
                        radius: '30%',
                        center: ['50%', '25%'],
                        label: {
                            formatter: '{b}: {@2012} ({d}%)'
                        },
                        encode: {
                            itemName: 'product',
                            value: '2012',
                            tooltip: '2012'
                        }
                    }
                ]
            };

            myChart.on('updateAxisPointer', function (event) {
                var xAxisInfo = event.axesInfo[0];
                if (xAxisInfo) {
                    var dimension = xAxisInfo.value + 1;
                    myChart.setOption({
                        series: {
                            id: 'pie',
                            label: {
                                formatter: '{b}: {@[' + dimension + ']} ({d}%)'
                            },
                            encode: {
                                value: dimension,
                                tooltip: dimension
                            }
                        }
                    });
                }
            });

            myChart.setOption(option);

        });

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>


    <script src="../../javaScript/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

    <!-- Graphs -->
    <script src="../../javaScript/Chart.min.js"></script>


</form>
</body>
</html>
