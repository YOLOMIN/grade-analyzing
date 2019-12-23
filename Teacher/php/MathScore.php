<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/30
 * Time: 16:19
 */

//用于绘图的数据传值

require ('../../conn/conn.php');
session_start();
$classno = $_SESSION['classno'];
$math_sql="select distinct score.studentno,score.score as math
from score,student 
where courseno='1' and time='2019-01-01' and score.studentno = any( select studentno from student where classno='".$classno."');";

$math_result=mysqli_query($con,$math_sql);

$data="";

class User{
    public $math;
}

while($row=mysqli_fetch_array($math_result,MYSQLI_ASSOC)){
    $user=new User();
    $user->math=$row['math'];
    $array[] = $user;
}

$data=json_encode($array);

mysqli_free_result($math_result);
mysqli_close($con);

echo $data;

