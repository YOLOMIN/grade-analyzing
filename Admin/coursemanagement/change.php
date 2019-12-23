<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/18
 * Time: 11:05
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

    $select="select * from course where id=".$id;

    //执行sql语句--返回结果
    $result=mysqli_query($con,$select);


    //从结果集中抽取数据
    $array=mysqli_fetch_array($result);


    //从结果集中调用数据

    $cname=$array["cname"];
    $courserno=$array["courserno"];
    $classno=$array["classno"];
    $teacherno=$array["teacherno"];



    //释放查询的结果集资源
    mysqli_free_result($result);
}



?>

<html>
<head>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body>

<form  class="form-horizontal"  method="post" action="save.php">
    <input name="ID" type="hidden" value="<?php echo $id?>"/>

    <div class="form-group">
        <label class="col-sm-2 control-label">课程编号:</label>
        <div class="col-sm-8">
            <input name="courserno" type="text" value="<?php echo $courserno;?>" class="form-control"  placeholder="请输入课程编号" >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">课程名:</label>
        <div class="col-sm-8">
            <input name="cname" type="text" class="form-control" value="<?php echo $cname;?>"  placeholder="请输入课程名">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">班级编号:</label>
        <div class="col-sm-8">
            <input name="classno" type="text" class="form-control" value="<?php echo $classno;?>"  placeholder="请输入课程编号">
        </div>

    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">教师编号:</label>
        <div class="col-sm-8">
            <input name="teacherno" type="text" class="form-control" value="<?php echo $teacherno?>"  placeholder="请输入教师编号">
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
