<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/18
 * Time: 11:56
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

    $select="select * from class where id=".$id;

    //执行sql语句--返回结果
    $result=mysqli_query($con,$select);


    //从结果集中抽取数据
    $array=mysqli_fetch_array($result);


    //从结果集中调用数据

    $classname=$array["classname"];
    $classno=$array["classno"];
    $student_num=$array["student_num"];
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
    <input name="ID" type="hidden" value="<?php echo $id;?>"/>

    <div class="form-group">
        <label class="col-sm-2 control-label">班级编号:</label>
        <div class="col-sm-8">
            <input name="classno" type="text" value="<?php echo $classno?>" class="form-control"  placeholder="请输入班级编号" >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">班级名称:</label>
        <div class="col-sm-8">
            <input name="classname" type="text" class="form-control" value="<?php echo $classname; ?>"  placeholder="请输入班级名称">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">学生数量:</label>
        <div class="col-sm-8">
            <input name="student_num" type="text" class="form-control" value="<?php echo $student_num;?>"  placeholder="请输入学生数量">
        </div>

    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">班主任编号:</label>
        <div class="col-sm-8">
            <input name="teacherno" type="text" class="form-control" value="<?php echo $teacherno; ?>"  placeholder="请输入班主任编号">
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


