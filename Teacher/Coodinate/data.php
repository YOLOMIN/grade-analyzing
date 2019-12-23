<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/30
 * Time: 16:19
 */

//用于绘图的数据传值

require ('../../conn/conn.php');
require('../../authentication/CheckUser.php');


$sql="select distinct score.studentno,score.score as score  from score,student where courseno='1' and score.studentno=student.studentno and student.classno='2016001' and score.time='2019-01-01'";



$class_result=mysqli_query($con,$sql);

$data="";

class User{
    public $score;
}

while($row=mysqli_fetch_array($class_result,MYSQLI_ASSOC)){
    $user=new User();
    $user->score=$row['score'];
    $array[] = $user;
}

$data=json_encode($array);

mysqli_free_result($class_result);
mysqli_close($con);

echo $data;