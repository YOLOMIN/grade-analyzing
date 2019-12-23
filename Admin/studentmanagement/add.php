<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/18
 * Time: 8:46
 */


//连接数据库
require_once ("../../conn/conn.php");


//获取用户表中的最大id

$select_max='select max(id) from student';

$result1=mysqli_query($con,$select_max);

//获取数据集中的最大值
$max_num=mysqli_fetch_array($result1);

//用于检查$max_num的值
//  echo $max_num['max(id)'];

//释放查询结果
mysqli_free_result($result1);


//需要对$max_num进行数据转换
$numcount=$max_num['max(id)']+1;


?>


<html>
<head>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body>

<form  class="form-horizontal"  method="post" action="save.php">
    <input name="ID" type="hidden" value="<?php echo $numcount?>"/>

    <div class="form-group">
        <label class="col-sm-2 control-label">学号:</label>
        <div class="col-sm-8">
            <input name="studentno" type="text" value="" class="form-control"  placeholder="请输入学号" >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">用户名:</label>
        <div class="col-sm-8">
            <input name="username" type="text" class="form-control" value=""  placeholder="请输入用户名">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">姓名:</label>
        <div class="col-sm-8">
            <input name="sname" type="text" class="form-control" value=""  placeholder="请输入姓名">
        </div>

    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">性别:</label>
        <div class="col-sm-8">
            <input name="sex" type="text" class="form-control" value=""  placeholder="请输入性别">
        </div>

    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">学校:</label>
        <div class="col-sm-8">
            <input name="school" type="text" class="form-control" value=""  placeholder="请输入学校">
        </div>

    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">班级编号:</label>

        <div class="col-sm-8">

            <input name="classno" type="text" class="form-control" value=""  placeholder="请输入班级编号">
        </div>

    </div>

    <div class="form-group" >
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="addbtn" class="btn" value="添加"/>
        </div>
    </div>

</form>


</body>
</html>

