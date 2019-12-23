<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/31
 * Time: 22:27
 */


//用于绘图的数据传值

require ('../../conn/conn.php');
require('../../authentication/CheckUser.php');

$searchItem=$_POST['searchItem'];

if($searchItem=="语文"){
    $sql = "select distinct score.studentno,score.score as score  from score,student where courseno='1' and score.studentno=student.studentno and student.classno='2016001' and score.time='2019-01-01'";
}
if($searchItem=="数学"){
    $sql = "select distinct score.studentno,score.score as score  from score,student where courseno='2' and score.studentno=student.studentno and student.classno='2016001' and score.time='2019-01-01'";
}
if($searchItem=="英语"){
    $sql = "select distinct score.studentno,score.score as score  from score,student where courseno='3' and score.studentno=student.studentno and student.classno='2016001' and score.time='2019-01-01'";
}

//检测sql语句
echo $sql;


$result=mysqli_query($con,$sql);

$data="";

class User{
    public $score;
}

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $user=new User();
    $user->score=$row['score'];
    $array[] = $user;
}

$data=json_encode($array);

mysqli_free_result($class_result);
mysqli_close($con);

echo $data;
