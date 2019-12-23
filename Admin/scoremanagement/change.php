<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/17 0017
 * Time: 16:35
 */


//连接数据库
require_once ("../../conn/conn.php");

?>



<html>
<head>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body>

<?php
//有ID传递过来，默认为修改信息
if(isset($_GET["id"])){

    $id=$_GET['id'];

    $select="select * from score where id=".$id;

    //执行sql语句--返回结果
    $result=mysqli_query($con,$select);


    //从结果集中抽取数据
    $array=mysqli_fetch_array($result);


    //从结果集中调用数据

    $studentno=$array["studentno"];
    $courseno=$array["courseno"];
    $score=$array["score"];
    $time=$array["time"];



    //释放查询的结果集资源
    mysqli_free_result($result);
}



?>

<form  class="form-horizontal"  method="post" action="save.php">
    <input name="ID" type="hidden" value="<?php echo $id?>"/>

    <div class="form-group">
        <label class="col-sm-2 control-label">学号:</label>
        <div class="col-sm-8">
            <input name="studentno" type="text" value="<?php echo $studentno?>" class="form-control"  placeholder="请输入学号" >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">课程号</label>
        <div class="col-sm-8">
            <input name="courseno" type="text" class="form-control" value="<?php echo $courseno?>"  placeholder="请输入课程号">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">成绩:</label>
        <div class="col-sm-8">
            <input name="score" type="text" class="form-control" value="<?php echo $score?>"  placeholder="请输入成绩">
        </div>

    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">时间:</label>
        <div class="col-sm-8">
            <input name="time" type="text" class="form-control" value="<?php echo $time?>"  placeholder="请输入时间">
        </div>

    </div>

    <div class="form-group" >
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="changebtn" class="btn" value="修改"/>
        </div>
    </div>

</form>


</body>
</html>
