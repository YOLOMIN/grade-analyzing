<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>班级成绩</title>
    <script type="text/javascript" src="../../js/echarts.js"></script>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/datetime.js"></script>
</head>
<style>
    .anal-text{
        width: 1200px;
        height: 120px;
        border:1px solid #000;
    }
    .anal-item{
        width: 1200px;
        height: 30px;
        padding: 5px 5px 5px 5px;
    }
    .bingItem{
        display: inline-block;
        width: 390px;
        height: 400px;
    }
</style>
<body>

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

<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('bar'));

    var chinese_data=[],english_data=[],math_data=[];
    function arrTest(){
        //读取json数据
        $.ajax({
            type:"post",        //请求服务器载入数据
            async:false,           //异步属性
            url:"../php/classImg.php",
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
    option = {
        title: {
            text: '班级成绩'
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



<!--饼图-->
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('math-circle'));

    var good = 0;
    var soso = 0;
    var bad = 0;
    function arrTest(){
        //读取json数据
        $.ajax({
            type:"post",        //请求服务器载入数据
            async:false,           //异步属性
            url:"../php/MathScore.php",
            data:{},
            dataType:"json",
            success:function(result){
                if(result){
                    for(var i=0;i<result.length;i++){
                        if(result[i].math > 80){
                            good++;
                        }
                        else if(result[i].math < 60){
                            bad++;
                        }
                        else{
                            soso++;
                        }

                    }
                }
            }
        });
        return good,soso,bad;
    }
    arrTest();
    var good_rate = (good/(good+soso+bad)*100).toFixed(2);
    var soso_rate = (soso/(good+soso+bad)*100).toFixed(2);
    var bad_rate = (bad/(good+soso+bad)*100).toFixed(2);
    //优秀>=20%为高
    //良好>=60%为高
    //不及格>=15%为高
    //在最近一次考试中，数学优秀占比%s，良好占比%s，不及格占比%s，优秀占比较高，班级数学成绩较好，望后期继续努力！
    //在最近一次考试中，数学优秀占比%s，良好占比%s，不及格占比%s，良好占比较高，优秀与不及格占比较低，望后期加强对数学尖子生的培养！
    //在最近一次考试中，数学优秀占比%s，良好占比%s，不及格占比%s，不及格占比较高，班级数学成绩较弱，望后期继续努力！
    //在最近一次考试中，数学优秀占比%s，良好占比%s，不及格占比%s，不及格占比偏高且多数同学处于良好层次，成绩不够理想，望后期继续努力！
    //在最近一次考试中，数学优秀占比%s，良好占比%s，不及格占比%s，优秀占比较高，不及格占比偏高,出现两极分化，望后期加强对数学偏弱的同学的辅导！

    if(good_rate >= 20 && bad_rate >= 15){
        document.getElementById("bing-math").innerText="在最近一次考试中，数学优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，优秀占比、不及格占比偏高，出现两极分化，望后期加强对数学偏弱的同学的辅导！";
    }else if(bad_rate >= 15 && good_rate < 20 && soso_rate >= 60){
        document.getElementById("bing-math").innerText="在最近一次考试中，数学优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，不及格占比偏高且多数同学处于良好层次，成绩不够理想，望后期继续努力！";
    }else if(bad_rate >= 15 && good_rate <20 && soso_rate < 60){
        document.getElementById("bing-math").innerText="在最近一次考试中，数学优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，不及格占比较高，班级数学成绩较弱，望后期加强对数学的学习！";
    }else if(good_rate < 20 && bad_rate < 15 & soso_rate >= 60){
        document.getElementById("bing-math").innerText="在最近一次考试中，数学优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，良好占比较高，优秀与不及格占比较低，望后期加强对数学尖子生的培养！";
    }else if(good_rate >= 20 && bad_rate < 15){
        document.getElementById("bing-math").innerText="在最近一次考试中，数学优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，优秀占比较高，班级数学成绩较好，望后期继续努力！";
    }
    option = {
        backgroundColor: '#fff',

        title: {
            text: '数学成绩概况',
            left: 'center',
            top: 20,
            textStyle: {
                color: '#ccc'
            }
        },

        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },

        visualMap: {
            show: false,
            min: 4,
            max: 20,
            inRange: {
                colorLightness: [0, 1]
            }
        },
        series : [
            {
                name:'数学成绩概况',
                type:'pie',
                radius : '55%',
                center: ['50%', '50%'],
                data:[
                    {value:good, name:'优秀'},
                    {value:soso, name:'良好'},
                    {value:bad, name:'不及格'},
                ].sort(function (a, b) { return a.value - b.value; }),
                roseType: 'radius',
                label: {
                    normal: {
                        textStyle: {
                            color: 'rgba(0, 0, 0, 0.3)'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        lineStyle: {
                            color: 'rgba(0, 0, 0, 0.3)'
                        },
                        smooth: 0.2,
                        length: 10,
                        length2: 20
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#c23531',
                        shadowBlur: 200,
                        shadowColor: 'rgba(255, 0, 0, 0.5)'
                    }
                },

                animationType: 'scale',
                animationEasing: 'elasticOut',
                animationDelay: function (idx) {
                    return Math.random() * 200;
                }
            }
        ]
    };
    myChart.setOption(option)
</script>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('chinese-circle'));

    var good = 0;
    var soso = 0;
    var bad = 0;
    function arrTest(){
        //读取json数据
        $.ajax({
            type:"post",        //请求服务器载入数据
            async:false,           //异步属性
            url:"../php/ChineseScore.php",
            data:{},
            dataType:"json",
            success:function(result){
                if(result){
                    for(var i=0;i<result.length;i++){
                        if(result[i].chinese > 80){
                            good++;
                        }
                        else if(result[i].chinese < 60){
                            bad++;
                        }
                        else{
                            soso++;
                        }

                    }
                }
            }
        });
        return good,soso,bad;
    }

    arrTest();
    var good_rate = (good/(good+soso+bad)*100).toFixed(2);
    var soso_rate = (soso/(good+soso+bad)*100).toFixed(2);
    var bad_rate = (bad/(good+soso+bad)*100).toFixed(2);
    //优秀>=20%为高
    //良好>=60%为高
    //不及格>=15%为高

    if(good_rate >= 20 && bad_rate >= 15){
        document.getElementById("bing-chinese").innerText="在最近一次考试中，语文优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，优秀占比、不及格占比偏高，出现两极分化，望后期加强对语文偏弱的同学的辅导！";
    }else if(bad_rate >= 15 && good_rate < 20 && soso_rate >= 60){
        document.getElementById("bing-chinese").innerText="在最近一次考试中，语文优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，不及格占比偏高且多数同学处于良好层次，成绩不够理想，望后期继续努力！";
    }else if(bad_rate >= 15 && good_rate <20 && soso_rate < 60){
        document.getElementById("bing-chinese").innerText="在最近一次考试中，语文优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，不及格占比较高，班级语文成绩较弱，望后期加强对语文的学习！";
    }else if(good_rate < 20 && bad_rate < 15 & soso_rate >= 60){
        document.getElementById("bing-chinese").innerText="在最近一次考试中，语文优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，良好占比较高，优秀与不及格占比较低，望后期加强对语文尖子生的培养！";
    }else if(good_rate >= 20 && bad_rate < 15){
        document.getElementById("bing-chinese").innerText="在最近一次考试中，语文优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，优秀占比较高，班级语文成绩较好，望后期继续努力！";
    }
    option = {
        backgroundColor: '#fff',

        title: {
            text: '语文成绩概况',
            left: 'center',
            top: 20,
            textStyle: {
                color: '#ccc'
            }
        },

        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },

        visualMap: {
            show: false,
            min: 4,
            max: 20,
            inRange: {
                colorLightness: [0, 1]
            }
        },
        series : [
            {
                name:'语文成绩概况',
                type:'pie',
                radius : '55%',
                center: ['50%', '50%'],
                data:[
                    {value:good, name:'优秀'},
                    {value:soso, name:'良好'},
                    {value:bad, name:'不及格'},
                ].sort(function (a, b) { return a.value - b.value; }),
                roseType: 'radius',
                label: {
                    normal: {
                        textStyle: {
                            color: 'rgba(0, 0, 0, 0.3)'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        lineStyle: {
                            color: 'rgba(0, 0, 0, 0.3)'
                        },
                        smooth: 0.2,
                        length: 10,
                        length2: 20
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#c23531',
                        shadowBlur: 200,
                        shadowColor: 'rgba(255, 0, 0, 0.5)'
                    }
                },

                animationType: 'scale',
                animationEasing: 'elasticOut',
                animationDelay: function (idx) {
                    return Math.random() * 200;
                }
            }
        ]
    };
    myChart.setOption(option)
</script>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('english-circle'));

    var good = 0;
    var soso = 0;
    var bad = 0;
    function arrTest(){
        //读取json数据
        $.ajax({
            type:"post",        //请求服务器载入数据
            async:false,           //异步属性
            url:"../php/EnglishScore.php",
            data:{},
            dataType:"json",
            success:function(result){
                if(result){
                    for(var i=0;i<result.length;i++){
                        if(result[i].english > 80){
                            good++;
                        }
                        else if(result[i].english < 60){
                            bad++;
                        }
                        else{
                            soso++;
                        }

                    }
                }
            }
        });
        return good,soso,bad;
    }

    arrTest();
    var good_rate = (good/(good+soso+bad)*100).toFixed(2);
    var soso_rate = (soso/(good+soso+bad)*100).toFixed(2);
    var bad_rate = (bad/(good+soso+bad)*100).toFixed(2);
    //优秀>=20%为高
    //良好>=60%为高
    //不及格>=15%为高

    if(good_rate >= 20 && bad_rate >= 15){
        document.getElementById("bing-english").innerText="在最近一次考试中，英语优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，优秀占比、不及格占比偏高，出现两极分化，望后期加强对英语偏弱的同学的辅导！";
    }else if(bad_rate >= 15 && good_rate < 20 && soso_rate >= 60){
        document.getElementById("bing-english").innerText="在最近一次考试中，英语优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，不及格占比偏高且多数同学处于良好层次，成绩不够理想，望后期继续努力！";
    }else if(bad_rate >= 15 && good_rate <20 && soso_rate < 60){
        document.getElementById("bing-english").innerText="在最近一次考试中，英语优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，不及格占比较高，班级英语成绩较弱，望后期加强对英语的学习！";
    }else if(good_rate < 20 && bad_rate < 15 & soso_rate >= 60){
        document.getElementById("bing-english").innerText="在最近一次考试中，英语优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，良好占比较高，优秀与不及格占比较低，望后期加强对英语尖子生的培养！";
    }else if(good_rate >= 20 && bad_rate < 15){
        document.getElementById("bing-english").innerText="在最近一次考试中，英语优秀占比" + good_rate + "%，良好占比" + soso_rate + "%，不及格占比" + bad_rate + "%，优秀占比较高，班级英语成绩较好，望后期继续努力！";
    }
    option = {
        backgroundColor: '#fff',

        title: {
            text: '英语成绩概况',
            left: 'center',
            top: 20,
            textStyle: {
                color: '#ccc'
            }
        },

        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },

        visualMap: {
            show: false,
            min: 4,
            max: 20,
            inRange: {
                colorLightness: [0, 1]
            }
        },
        series : [
            {
                name:'英语成绩概况',
                type:'pie',
                radius : '55%',
                center: ['50%', '50%'],
                data:[
                    {value:good, name:'优秀'},
                    {value:soso, name:'良好'},
                    {value:bad, name:'不及格'},
                ].sort(function (a, b) { return a.value - b.value; }),
                roseType: 'radius',
                label: {
                    normal: {
                        textStyle: {
                            color: 'rgba(0, 0, 0, 0.3)'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        lineStyle: {
                            color: 'rgba(0, 0, 0, 0.3)'
                        },
                        smooth: 0.2,
                        length: 10,
                        length2: 20
                    }
                },
                itemStyle: {
                    normal: {
                        color: '#c23531',
                        shadowBlur: 200,
                        shadowColor: 'rgba(255, 0, 0, 0.5)'
                    }
                },

                animationType: 'scale',
                animationEasing: 'elasticOut',
                animationDelay: function (idx) {
                    return Math.random() * 200;
                }
            }
        ]
    };
    myChart.setOption(option)
</script>
</body>
</html>