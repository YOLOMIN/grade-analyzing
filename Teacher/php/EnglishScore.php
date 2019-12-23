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
$english_sql="select distinct score.studentno,score.score as english
from score,student 
where courseno='3' and time='2019-01-01' and score.studentno = any( select studentno from student where classno='".$classno."');";

$english_result=mysqli_query($con,$english_sql);

$data="";

class User{
    public $english;
}

while($row=mysqli_fetch_array($english_result,MYSQLI_ASSOC)){
    $user=new User();
    $user->english=$row['english'];
    $array[] = $user;
}

$data=json_encode($array);

mysqli_free_result($english_result);
mysqli_close($con);

echo $data;


