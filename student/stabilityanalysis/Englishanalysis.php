<?php
/**
 * Created by PhpStorm.
 * User: HuangLC
 * Date: 2019/5/21
 * Time: 3:26
 */
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>学生成绩查询</title>

    <script type="text/javascript" src="../../js/echarts.js"></script>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/datetime.js"></script>
    <script type="text/javascript" src="../../js/laydate/laydate.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <script>

        laydate.render({
            elem: '#starttime'
        });
        laydate.render({
            elem: '#endtime'
        });
    </script>





</head>

<body>






<div style="position:relative;overflow:hidden;width:1538px;height:760px;padding:0px;border-width:0px;cursor:default;"/>


<div id="bar" style="height:400px;width: 1200px;"></div>


<form action="#" method="post" id="form1" onsubmit="return false">
    <fieldset>
        <div class="row">


            <div class="col-md-3">

                <label >起始时间:</label>
                <input type="text" id="starttime" name="starttime">


            </div>
            <div class="col-md-3">
                <label >终止时间:</label>
                <input type="text" id="endtime" name="endtime">
            </div>

            <div class="col-md-3">


                <input type="submit" class="btn" value="数据分析" name="btn" onclick="tijiao()">



                <!--
                <div class="col-md-1">
                <input type="submit" class="btn" value="提交" name="btn" onclick="tijiao()">
                </div>
                <div class="col-md-1">
                <input type="submit" class="btn" value="方差计算" name="btn" onclick="dv()">
                </div>
                <div class="col-md-1">

                </div>
                -->
            </div>







        </div>



    </fieldset>
</form>
<div class="row" style="width: 1200px;">
    <div class="col-md-6 text-left">
        <div>
            <p>
                <span>方差估值:</span>
                <span id="dv0">请等待......</span>
            </p>

            <p>
                <span>均值估值:</span>
                <span id="dv1">请等待......</span>
            </p>

            <p>
                <span>（数据的稳定性）标准差估值:</span>
                <span id="dv2">请等待......</span>
            </p>



        </div>
    </div>
    <div class="col-md-6 text-left">
        <p>
            <span>班级方差估值:</span>
            <span id="dv3">请等待......</span>
        </p>

        <p>
            <span>班级均值估值:</span>
            <span id="dv4">请等待......</span>
        </p>

        <p>
            <span>（数据的稳定性）班级标准差估值:</span>
            <span id="dv5">请等待......</span>
        </p>

    </div>

</div>
<div class="row" style="width: 1200px;">

    <div id="succeed">

    </div>

</div>


<script type="text/javascript">



    //var myChart=echarts.init(document.getElementById('bar'));
    var myChart = echarts.init(document.getElementById('bar'));

    //获取个人成绩信息
    var studentno=[],sname=[],cname=[],score=[],time=[];

    //获取班级成绩信息
    var csno=[],csname=[],ccname=[],cscore=[],ctime=[];




    //获取班级数据
    function classscore(){
        //读取json数据
        var starttime=document.getElementById('starttime').value;
        var endtime=document.getElementById('endtime').value;

        $.ajax({
            type:"post",        //请求服务器载入数据
            async:false,           //异步属性
            url:"classscore.php",
            data:{
                'starttime':starttime,
                'endtime':endtime
            },
            dataType:"json",
            success:function(result1){
                if(result1){
                    csno=[];
                    csname=[];
                    ccname=[];
                    cscore=[];
                    ctime=[];

                    for(var i=0;i<result1.length;i++){
                        csno.push(result1[i].sno);
                        csname.push(result1[i].name);
                        ccname.push(result1[i].cname);
                        cscore.push(result1[i].score);
                        ctime.push(result1[i].time);
                    }
                }

            }

        });
        //  alert("ajax刷新数据"+result);
        return csno,csname,ccname,cscore,ctime;
    }



    //通过提交表单的形式，重新绘制图像
    function selfscore(){

        //通过ajax的方式提交数据，在后台通过sql查询重新修改数据集
        //在ajax的数据成功返回的地方重新调用图像绘制函数

        //  var endtime=document.getElementById('test2').value();

        var starttime=document.getElementById('starttime').value;
        var endtime=document.getElementById('endtime').value;


        $.ajax({
            type:"POST",        //方法
            async:false,
            url:"englishselfscore.php",             //表单接受url
            data:{
                'starttime':starttime,
                'endtime':endtime
            },
            datatype:"json",
            success:function(result){
                //提交成功
                // alert("提交成功!");


                studentno=[];
                sname=[];
                cname=[];
                score=[];
                time=[];


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


                    for(var i=0;i<obj.length;i++){
                        studentno.push(obj[i].sno);
                        sname.push(obj[i].name);
                        cname.push(obj[i].cname);
                        score.push(obj[i].score);
                        time.push(obj[i].time);

                    }
                    // alert('ajax获取time'+time);
                    // alert('ajax读取数据'+obj[0].time);
                    // alert('ajax获取result结果值:'+obj);
                    // alert('ajax获取result结果值:'+sname);
                }


            },
            error:function(){
                //提交失败
                alert("提交失败!");
            }

        });

        // alert("查询成功,刷新数据中....");
        return time,studentno,sname,cname,score;
    }


    //获取班级成绩
    function personalscore(){

        //通过ajax的方式提交数据，在后台通过sql查询重新修改数据集
        //在ajax的数据成功返回的地方重新调用图像绘制函数

        //  var endtime=document.getElementById('test2').value();

        $.ajax({
            type:"POST",        //方法
            async:false,
            url:"personalenglish.php",             //表单接受url
            data:{

            },
            datatype:"json",
            success:function(result){
                //提交成功
                // alert("提交成功!");


                studentno=[];
                sname=[];
                cname=[];
                score=[];
                time=[];


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


                    for(var i=0;i<obj.length;i++){
                        studentno.push(obj[i].sno);
                        sname.push(obj[i].name);
                        cname.push(obj[i].cname);
                        score.push(obj[i].score);
                        time.push(obj[i].time);

                    }
                    // alert('ajax获取time'+time);
                    // alert('ajax读取数据'+obj[0].time);
                    // alert('ajax获取result结果值:'+obj);
                    // alert('ajax获取result结果值:'+sname);
                }


            },
            error:function(){
                //提交失败
                alert("提交失败!");
            }

        });

        // alert("查询成功,刷新数据中....");
        return time,studentno,sname,cname,score;
    }

    personalscore();

    //进行图像绘制
    //配置图像参数
    var option={
        title:{
            text:"英语成绩折线图"
        },
        tooltip:{
            show:true,
            trigger:'axis'
        },
        legend:{
            data:cname[0]
        },
        grid:{
            left:'3%',
            right:'4%',
            bottom:'3%',
            containLabel:true
        },
        xAxis:[
            {
                type:'category',
                data:time
            }
        ],
        yAxis: [
            {
                type:'value',

            }
        ],
        series:[
            {
                name:cname[0],
                type:"line",
                data:score
            }
        ]
    };

    //绘画图像
    myChart.setOption(option);






    function tijiao(){

        //获取个人成绩
        selfscore();

        //获取班级成绩
        classscore();

        //alert('time'+array[0]+'  score:'+array[4]);
        //进行图像绘制
        //配置图像参数
        var option={
            //标题组件配置
            title:{
                text:"英语成绩折线图"
            },
            //提示框组件配置
            tooltip:{
                show:true,
                trigger:'axis'
            },
            // 图例组件配置
            //展现不同系列的标记，颜色和名字
            legend:{

                //图例的数据数据
                data:[cname[0]]

            },
            //直角坐标系内绘图网格，单个grid内最多可以防止上下两个X轴
            grid:{
                //grid组件离容器左侧的距离
                left:'3%',
                //grid组件离容器右侧的距离
                right:'4%',
                //grid组件离容器下侧的距离
                bottom:'3%',
                //grid区域是否包含坐标轴的刻度标签
                //常用于 防止标签溢出的场景

                //标签溢出质的是，标签长度动态变化时，可能会溢出容器或者覆盖其他组件

                containLabel:true
            },
            //直角坐标系grid中的x轴
            xAxis:[
                {
                    //坐标轴类型 ‘value’数值轴 'category'类目轴，适用于连续的数目数据
                    //'time'时间轴  ‘log’对数轴，适用于对数数据
                    type:'category',
                    //类目轴数据 ,在类目轴(type:'category'）中有效,指明的是'category'轴的取值范围
                    data:time
                }
            ],
            //直角坐标系grid中的y轴
            yAxis: [
                {
                    //'value'数值轴,适用于连续数据,data数据默认使用series.data
                    type:'value',
                }
            ],
            //系列列表，每个系列通过type决定自己的图表类型
            series:[
                {
                    //系列名称，用于tooltip的显示，legend的图例筛选
                    name:cname[0],

                    //指定绘图类型
                    type:"line",

                    //系列中的数据内容数组，数组项通常为具体的数据项
                    data:score
                },
                // {
                //     //绘制班级成绩曲线
                //     name:ccname[0],
                //     type:"line",
                //     data:cscore
                // }
            ]
        };

        //绘画图像
        myChart.setOption(option);

        //调用数据分析函数
        dv();
    }




    function dv() {

        //先将字符数组转换成字符数组--个人成绩
        var number=score.map(Number);

        //班级成绩
        var numberclass=cscore.map(Number);

        //个人均分
        var mean=0;

        //班级均分
        var classmean=0;

        //个人总分
        var sum=0;

        //班级总分
        var classsum=0;

//alert('确认数据传输:'+number[0]);

        //计算个人总分
        for(var i=0;i<number.length;i++){
            sum+=number[i];
            sum=Math.round(sum);
            //  alert('第'+i+'次计算:'+sum);
        }

        //计算班级总分
        for(var i=0;i<numberclass.length;i++){
            classsum+=numberclass[i];
            classsum=Math.round(classsum);
        }


//alert('确认sum数据:'+sum)
        //个人均分计算
        mean=sum/number.length;
        //班级均分
        // var classpeople=csname.method3();
        classmean=classsum/numberclass.length;


        sum=0;
        classsum=0;

//alert("确认mean数据:"+mean);

        for(var i=0;i<number.length;i++){
            sum+=Math.pow(number[i]-mean,2);
        }

        for(var i=0;i<numberclass.length;i++){
            classsum+=Math.pow(numberclass[i]-mean,2);
        }


//alert("确认最终sum:"+sum);
        //个人情况
        document.getElementById("dv0").innerHTML=Math.round((sum/number.length)*100)/100;
        document.getElementById("dv1").innerHTML=Math.round(mean*100)/100;
        document.getElementById("dv2").innerHTML=Math.round(Math.sqrt(sum/number.length)*100)/100;

        document.getElementById("dv3").innerHTML=Math.round((classsum/numberclass.length)*100)/100;
        document.getElementById("dv4").innerHTML=Math.round(classmean*100)/100;
        document.getElementById("dv5").innerHTML=Math.round(Math.sqrt(classsum/numberclass.length)*100)/100;


        studentdv=Math.round(Math.sqrt(sum/number.length)*100)/100;
        classdv=Math.round(Math.sqrt(classsum/numberclass.length)*100)/100;

        // alert("确认最终个人标准差结果"+studentdv);
        // alert("确认最终班级标准差结果"+classdv);

        if(studentdv<classdv){
            document.getElementById("succeed").innerHTML="亲(づ￣3￣)づ╭❤～ 目前,您在班级中处于较稳定阶段哦,请继续保持！";
        }else if(studentdv>classdv){
            document.getElementById("succeed").innerHTML="(づ￣3￣)づ╭❤～亲，请注意您的成绩有点飘了，记得努力学习哦！";
        }else if(studentdv==classdv){
            document.getElementById("succeed").innerHTML="很好，亲您的成绩很稳呢，请继续保持哦！";
        }
    }

</script>
</body>
</html>
