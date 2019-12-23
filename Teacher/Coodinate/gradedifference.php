<?php
require ('../../conn/conn.php');
require('../../authentication/CheckUser.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>年级均分统计</title>
    <script type="text/javascript" src="../../js/echarts.js"></script>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/datetime.js"></script>
</head>

<body>

<div id="bar" style="width: 1200px;height: 400px"></div>
<div class="row" style="width: 1200px;">

    <div id="succeed">

    </div>

</div>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('bar'));

    var classone=[],classtwo=[],classthree=[],classfour=[];
    function arrTest(){
        //读取json数据
        $.ajax({
            type:"post",        //请求服务器载入数据
            async:false,           //异步属性
            url:"gradedate.php",
            data:{},
            dataType:"json",
            success:function(result){
                if(result){
                    for(var i=0;i<result.length;i++){
                        classone.push(result[i].classone);
                        classtwo.push(result[i].classtwo);
                        classthree.push(result[i].classthree);
                        classfour.push(result[i].classfour);
                    }
                }
            }
        });
        return classone,classtwo,classthree,classfour;
    }

    arrTest();

    //先将字符数组转换成字符数组--个人成绩
    var one=classone.map(Number);
    var two=classtwo.map(Number);
    var three=classthree.map(Number);
    var four=classfour.map(Number);

    var sum=0;

    function sortNumber(a, b)
    {
        return b - a
    }

    for(var i=0;i<one.length;i++)
        sum+=one[i];
    var one_average=sum/one.length;

    sum=0;

    for(var i=0;i<two.length;i++)
            sum+=two[i];
    var two_average=sum/two.length;

    sum=0;

    for(var i=0;i<three.length;i++)
        sum+=three;
    var three_average=sum/three.length;

    sum=0;

    for(var i=0;i<four.length;i++)
        sum+=four[i];
    var four_average=sum/four.length;

    sum=0;

    var array=[one_average,two_average,three_average,four_average];

    var number=array.sort(sortNumber);

    for(var i=0;i<number.length;i++){

        //如果该找到该班级的数据
        if(one_average==number[i]){

            <?php

            $sql="select * from teacher where username='$name'";

            $result=mysqli_query($con,$sql);

            $rownum = mysqli_num_rows($result);

            $array = mysqli_fetch_array($result);

            //                echo $sql;


            ?>

            document.getElementById("succeed").innerHTML="在本年度中，<?php echo  $array['classno']; ?>班级总成绩均分处于第"+i+"位哦！";
        }
    }




    option = {
        title: {
            text: '各班语文平均分'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data:['2016001班','2016002班','2016003班','2016004班']
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['一月','二月','三月','四月','五月','六月','七月','九月','十月','十一月','十二月']
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name:'2016001班',
                type:'line',
                stack: '平均分',
                data:classone
            },
            {
                name:'2016002班',
                type:'line',
                stack: '平均分',
                data:classtwo
            },
            {
                name:'2016003班',
                type:'line',
                stack: '平均分',
                data:classthree
            },
            {
                name:'2016004班',
                type:'line',
                stack: '平均分',
                data:classfour
            },
        ]
    };
    myChart.setOption(option)
</script>


</body>
</html>