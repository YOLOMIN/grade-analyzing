<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/17
 * Time: 22:51
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

    $select="select * from teacher where id=".$id;

    //执行sql语句--返回结果
    $result=mysqli_query($con,$select);


    //从结果集中抽取数据
    $array=mysqli_fetch_array($result);


    //从结果集中调用数据

    $teacherno=$array["teacherno"];
    $username=$array["username"];
    $tname=$array["tname"];
    $workunit=$array["workunit"];
    $type=$array["type"];
    $classno=$array["classno"];


    //释放查询的结果集资源
    mysqli_free_result($result);
}



?>

<form  class="form-horizontal"  method="post" action="save.php">
    <input name="ID" type="hidden" value="<?php echo $id?>"/>

    <div class="form-group">
        <label class="col-sm-2 control-label">工号:</label>
        <div class="col-sm-8">
            <input name="teacherno" type="text" value="<?php echo $teacherno?>" class="form-control"  placeholder="请输入工号" >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">用户名:</label>
        <div class="col-sm-8">
            <input name="username" type="text" class="form-control" value="<?php echo $username?>"  placeholder="请输入用户名">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">姓名:</label>
        <div class="col-sm-8">
            <input name="tname" type="text" class="form-control" value="<?php echo $tname?>"  placeholder="请输入姓名">
        </div>

    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">类型:</label>
        <div class="col-sm-8">
            <input name="type" type="text" class="form-control" value="<?php echo $type?>"  placeholder="请输入姓名">
        </div>

    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">负责班级:</label>
        <div class="col-sm-8">
            <input name="classno" type="text" class="form-control" value="<?php echo $classno?>"  placeholder="请输入姓名">
        </div>

    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">学校</label>
        <div class="col-sm-8">
            <input name="workunit" type="text" class="form-control" value="<?php echo $workunit?>"  placeholder="请输入学校">
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




