<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/2
 * Time: 23:12
 */

//连接数据库
require_once ("../../conn/conn.php");


//获取用户表中的最大id

$select_max='select max(id) from user';

$result1=mysqli_query($con,$select_max);

//获取数据集中的最大值
$max_num=mysqli_fetch_array($result1);

//用于检查$max_num的值
//  echo $max_num['max(id)'];

//释放查询结果
mysqli_free_result($result1);


//需要对$max_num进行数据转换
$numcount=$max_num['max(id)']+1;

$numcount=$numcount+1;

?>

<html>
<head>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body>

<form  class="form-horizontal"  method="post" action="saveupdate.php">
    <input name="ID" type="hidden" value="<?php echo $numcount?>"/>

    <div class="form-group">
        <label class="col-sm-2 control-label">用户名:</label>
        <div class="col-sm-8">
            <input name="name" type="text" value="" class="form-control"  >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">密码:</label>
        <div class="col-sm-8">
            <input name="pwd" type="text" class="form-control" value="">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">用户类型:</label>
        <div class="col-sm-8">
            <input name="type" type="text" class="form-control" value="">
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
