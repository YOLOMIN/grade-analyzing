<?php

/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/30
 * Time: 16:19
 */

//用于绘图的数据传值

require('../../conn/conn.php');
session_start();
$classno = $_SESSION['classno'];
$chinese_sql = "select distinct score.studentno,score.score as chinese
from score,student 
where courseno='2' and time='2019-01-01' and score.studentno = any( select studentno from student where classno='".$classno."');";

$chinese_result = mysqli_query($con, $chinese_sql);

$data = "";

class User
{
    public $chinese;
}

while ($row = mysqli_fetch_array($chinese_result, MYSQLI_ASSOC)) {
    $user = new User();
    $user->chinese = $row['chinese'];
    $array[] = $user;
}

$data = json_encode($array);

mysqli_free_result($chinese_result);
mysqli_close($con);

echo $data;

