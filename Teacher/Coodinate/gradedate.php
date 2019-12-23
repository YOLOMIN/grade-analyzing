<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/30
 * Time: 16:19
 */

//用于绘图的数据传值

require ('../../conn/conn.php');

$classone_sql="select distinct AVG(score) as classone
from score,student 
where courseno='1' and score.studentno = any( select studentno from student where classno='2016001')
GROUP BY time;";

$classtwo_sql="select distinct AVG(score) as classtwo
from score,student 
where courseno='1' and score.studentno = any( select studentno from student where classno='2016002')
GROUP BY time;";

$classthree_sql="select distinct AVG(score) as classthree
from score,student 
where courseno='1' and score.studentno = any( select studentno from student where classno='2016003')
GROUP BY time;";

$classfour_sql="select distinct AVG(score) as classfour
from score,student 
where courseno='1' and score.studentno = any( select studentno from student where classno='2016004')
GROUP BY time;";

$classone_result=mysqli_query($con,$classone_sql);
$classtwo_result = mysqli_query($con,$classtwo_sql);
$classthree_result = mysqli_query($con,$classthree_sql);
$classfour_result = mysqli_query($con,$classfour_sql);

$data="";

class User{


    public $classone;
    public $classtwo;
    public $classthree;
    public $classfour;
}

while($row=mysqli_fetch_array($classone_result,MYSQLI_ASSOC)){
    $user=new User();
    $user->classone=$row['classone'];
    $row1=mysqli_fetch_array($classtwo_result,MYSQLI_ASSOC);
    $user->classtwo=$row1['classtwo'];
    $row2=mysqli_fetch_array($classthree_result,MYSQLI_ASSOC);
    $user->classthree=$row2['classthree'];
    $row3=mysqli_fetch_array($classfour_result,MYSQLI_ASSOC);
    $user->classfour=$row3['classfour'];
    $array[] = $user;
}

$data=json_encode($array);

mysqli_free_result($classone_result);
mysqli_close($con);

echo $data;

