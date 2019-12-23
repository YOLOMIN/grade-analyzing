<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/18
 * Time: 8:46
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

    $select="select * from student where id=".$id;

    //执行sql语句--返回结果
    $result=mysqli_query($con,$select);


    //从结果集中抽取数据
    $array=mysqli_fetch_array($result);


    //从结果集中调用数据

    $studentno=$array["studentno"];
    $username=$array["username"];
    $sname=$array["sname"];
    $sex=$array["sex"];
    $school=$array["school"];
    $classno=$array["classno"];



    //释放查询的结果集资源
    mysqli_free_result($result);
}



?>

<form  class="form-horizontal"  method="post" action="save.php">
    <input name="ID" type="hidden" value="<?php echo $id?>"/>

    <div class="form-group">
        <label class="col-sm-2 control-label">学号:</label>
        <div class="col-sm-8">
            <input name="studentno" type="text" value="<?php echo $studentno;?>" class="form-control"  placeholder="请输入学号" >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">用户名:</label>
        <div class="col-sm-8">
            <input name="username" type="text" class="form-control" value="<?php echo $username;?>"  placeholder="请输入用户名">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">姓名:</label>
        <div class="col-sm-8">
            <input name="sname" type="text" class="form-control" value="<?php echo $sname;?>"  placeholder="请输入姓名">
        </div>

    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">性别:</label>
        <div class="col-sm-8">
            <input name="sex" type="text" class="form-control" value="<?php echo $sex;?>"  placeholder="请输入性别">
        </div>

    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">学校:</label>
        <div class="col-sm-8">
            <input name="school" type="text" class="form-control" value="<?php echo $school;?>"  placeholder="请输入学校">
        </div>

    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">班级编号:</label>

        <div class="col-sm-8">

            <input name="classno" type="text" class="form-control" value="<?php echo $classno;?>"  placeholder="请输入班级编号">
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
