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
    <script type="text/javascript" src="../../js/echarts.js"></script>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/datetime.js"></script>
    <script type="text/javascript" src="../../js/laydate/laydate.js"></script>


</head>
<body>




<!---显示数据表格中的数据--->


<div class="container" >

    <form action="" method="post" style="margin-left: 70%" oncheck>
        <select name="searchItem" id="searchItem">
            <option value="">请选择科目</option>
            <option value="0" >语文</option>
            <option value="1" >数学</option>
            <option value="2" >英语</option>
        </select>&nbsp;
        <input class="btn" name="search" type="submit" value="查询" onclick="chaxun()" />
    </form>
    <div id="firstPieChart" style="width:100%; height:70%;margin: auto"></div>

</div>

<!--饼图-->
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('firstPieChart'));
    var text="班级语文成绩";

    var excellent = 0;
    var well = 0;
    var pass = 0;
    var fail = 0;
    function arrTest(){

        //读取json数据
        $.ajax({
            type:"post",        //请求服务器载入数据
            async:false,           //异步属性
            url:"data.php",
            data:{},
            dataType:"json",
            success:function(result){
                if(result){
                    for(var i=0;i<result.length;i++){
                        if(result[i].score < 60){
                            fail++;
                        }
                        else if(result[i].score >=60&&result[i].score < 70){
                            pass++;
                        }
                        else if(result[i].score >=70&&result[i].score < 80){
                            well++;
                        }
                        else{
                            excellent++;
                        }
                    }
                }
            }
        });
        return excellent,well,pass,fail;
    }

    //通过提交表单的形式，重新绘制图像
    function cricle(){

        //通过ajax的方式提交数据，在后台通过sql查询重新修改数据集
        //在ajax的数据成功返回的地方重新调用图像绘制函数

        //  var endtime=document.getElementById('test2').value();

        var searchItem=document.getElementById('searchItem').value;
        if(searchItem==0){
            var text="班级语文成绩";
        }
        if(searchItem==1){
            var text="班级数学成绩";
        }
        if(searchItem==2) {
            var text="班级英语成绩";
        }

        $.ajax({
            type:"POST",        //方法
            async:false,
            url:"passdate.php",             //表单接受url
            data:{
                'searchItem':searchItem
            },
            datatype:"json",
            success:function(result){
                //提交成功
                // alert("提交成功!");


                excellent = 0;
                well = 0;
                pass = 0;
                fail = 0;


                var obj;

                //检查json数据返回是否是对象类型
                if((typeof result=='object')&&result.constructor==Object){
                    obj=result;

                }else{
                    //如果json数据是字符串类型，进行转换
                    obj=eval("("+result+")");
                }

                //获取json数据
                if(obj){

                    for(var i=0;i<result.length;i++){
                        if(result[i].score < 60){
                            fail++;
                        }
                        else if(result[i].score >=60&&result[i].score < 70){
                            pass++;
                        }
                        else if(result[i].score >=70&&result[i].score < 80){
                            well++;
                        }
                        else{
                            excellent++;
                        }
                    }
                }


            },
            error:function(){
                //提交失败
                alert("提交失败!");
            }

        });

        alert("提交表单,ajax刷新数据");
        return excellent,well,pass,fail;
    }

    arrTest();

    //进行图像绘制
    //配置图像参数

    option = {
        title : {
            text:text,
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: ['优秀','良好','及格','不及格']
        },
        series : [
            {
                name: '成绩',
                type: 'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[
                    {value:excellent, name:'优秀'},
                    {value:well, name:'良好'},
                    {value:pass, name:'及格'},
                    {value:fail, name:'不及格'},
                ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };
    myChart.setOption(option)

    function chaxun(){

        var array=cricle();

        alert('excellent'+array[0]+'  well:'+array[1]+' pass:'+array[2]+' fail:'+array[3]);
        //进行图像绘制
        //配置图像参数
        var option = {
            title : {
                text:text,
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: ['优秀','良好','及格','不及格']
            },
            series : [
                {
                    name: '成绩',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                        {value:excellent, name:'优秀'},
                        {value:well, name:'良好'},
                        {value:pass, name:'及格'},
                        {value:fail, name:'不及格'},
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };

        //绘画图像
        myChart.setOption(option);

    }
</script>


</body>
</html>
