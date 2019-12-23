<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/4
 * Time: 11:21
 */
//用户登陆验证
//用户登陆验证

require_once ("../authentication/CheckUser.php");
require_once ("../conn/conn.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>班级成绩</title>
    <script type="text/javascript" src="../js/echarts.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/datetime.js"></script>
</head>
<style>
    .anal-text{
        width: 1200px;
        height: 120px;
        border:1px solid #000;
    }

</style>
<body>
<div id="bar" style="width: 1200px;height: 400px"></div>


<div id="line-anal"  >
    <div id="succeed">

    </div>
</div>

<!--
<div id="bing" style="width: 1300px;height: 400px;margin-left:50px;">
    <div id="chinese-circle" class="bingItem" ></div>
    <div id="math-circle" class="bingItem" ></div>
    <div id="english-circle" class="bingItem" ></div>
</div>


<div id="bing-anal" class="anal-text" >
    <div id="bing-chinese" class="anal-item"></div>
    <div id="bing-math" class="anal-item"></div>
    <div id="bing-english" class="anal-item"></div>
</div>
-->

<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('bar'));

    var chinese_data=[],english_data=[],math_data=[];
    function arrTest(){
        //读取json数据
        $.ajax({
            type:"post",        //请求服务器载入数据
            async:false,           //异步属性
            url:"php/classImg.php",
            data:{},
            dataType:"json",
            success:function(result){
                if(result){
                    for(var i=0;i<result.length;i++){
                        chinese_data.push(result[i].chinese);
                        math_data.push(result[i].math);
                        english_data.push(result[i].english);
                    }
                }
            }
        });
        return chinese_data,english_data,math_data;
    }

    arrTest();


    //先将字符数组转换成字符数组--个人成绩
    var cnumber=chinese_data.map(Number);
    var enumber=english_data.map(Number);
    var mnumber=math_data.map(Number);

    var sum=0;
    //计算在该时间段内，均分的最大值和最小值
    for(var i=0;i<cnumber.length;i++)
        sum+=cnumber[i];

    var chinese_average=sum/chinese_data.length;

   // alert("语文均分"+sum);

    sum=0;

    for(var i=0;i<mnumber.length;i++)
        sum+=mnumber[i];

    var math_average=sum/math_data.length;

   // alert("数学均分"+math_average);


    sum=0;

    for(var i=0;i<enumber.length;i++)
        sum+=enumber[i];

    var english_average=sum/english_data.length;

   // alert("英语均分"+english_average);



    if(english_average<=math_average&&english_average<=chinese_average)
        document.getElementById("succeed").innerHTML="在本年度中，班级中英语均分较低，请班主任加强班级中英语的学习哦！";

    if(math_average<=english_average&&math_average<=chinese_average)
        document.getElementById("succeed").innerHTML="在本年度中，班级中数学均分较低，请班主任加强班级中数学的学习哦！";

    if(chinese_average<=english_average&&chinese_average<=math_average)
        document.getElementById("succeed").innerHTML="在本年度中，班级中语文均分较低，请班主任加强班级中语文的学习哦！";






    <?php

            $sql="select * from teacher where username='$name'";

            $result=mysqli_query($con,$sql);

            $rownum = mysqli_num_rows($result);

            $array = mysqli_fetch_array($result);

            //                echo $sql;


    ?>

    option = {
        title: {
            text: '<?php echo  $array['classno']; ?>班级成绩'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data:['语文','数学','英语']
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
                name:'语文',
                type:'line',
                stack: '平均分',
                data:chinese_data
            },
            {
                name:'数学',
                type:'line',
                stack: '平均分',
                data:math_data
            },
            {
                name:'英语',
                type:'line',
                stack: '平均分',
                data:english_data
            },
        ]
    };
    myChart.setOption(option)




</script>

</body>
</html>