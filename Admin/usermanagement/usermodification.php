<?php

/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/2/23
 * Time: 12:55
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

        $select="select * from user where id=".$id;

        //执行sql语句--返回结果
        $result=mysqli_query($con,$select);


        //从结果集中抽取数据
        $array=mysqli_fetch_array($result);


        //从结果集中调用数据
        $username=$array["userno"];
        $password=$array["password"];
        $usertype=$array["usertype"];

        //释放查询的结果集资源
        mysqli_free_result($result);
    }




?>

<form  class="form-horizontal"  method="post" action="saveupdate.php">
    <input name="ID" type="hidden" value="<?php echo $id?>"/>

    <div class="form-group">
        <label class="col-sm-2 control-label">用户名:</label>
        <div class="col-sm-8">
            <input name="name" type="text" value="<?php echo $username;?>" class="form-control"  >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">密码:</label>
        <div class="col-sm-8">
            <input name="pwd" type="text" class="form-control" value="<?php echo $password; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">用户类型:</label>
        <div class="col-sm-8">
            <input name="type" type="text" class="form-control" value="<?php echo $usertype; ?>">
        </div>

    </div>
    <div class="form-group" >
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="btn" class="btn" value="修改"/>
        </div>
    </div>

</form>




<?php




    //关闭数据库连接
    mysqli_close($con);

?>



</body>

</html>
