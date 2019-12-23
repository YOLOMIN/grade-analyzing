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
$math_sql="select distinct AVG(score) as math
from score,student 
where courseno='1' and score.studentno = any( select studentno from student where classno='$classno')
GROUP BY time;";

$chinese_sql="select distinct AVG(score) as chinese
from score,student 
where courseno='2' and score.studentno = any( select studentno from student where classno=$classno)
GROUP BY time;";

$english_sql="select distinct AVG(score) as english
from score,student 
where courseno='3' and score.studentno = any( select studentno from student where classno=".$classno.")
GROUP BY time;";

$math_result=mysqli_query($con,$math_sql);
$chinese_result = mysqli_query($con,$chinese_sql);
$english_result = mysqli_query($con,$english_sql);

$data="";

class User{
    public $math;
    public $chinese;
    public $english;
}

while($row=mysqli_fetch_array($math_result,MYSQLI_ASSOC)){
    $user=new User();
    $user->math=$row['math'];
    $row1=mysqli_fetch_array($chinese_result,MYSQLI_ASSOC);
    $user->chinese=$row1['chinese'];
    $row2=mysqli_fetch_array($english_result,MYSQLI_ASSOC);
    $user->english=$row2['english'];
    $array[] = $user;
}

$data=json_encode($array);

mysqli_free_result($math_result);
mysqli_close($con);

echo $data;

