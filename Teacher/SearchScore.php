<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/31
 * Time: 22:27
 */


//用于绘图的数据传值

require ('../conn/conn.php');
require('../authentication/CheckUser.php');

    $strarttime=$_POST['starttime'];
    $endtime=$_POST['endtime'];


    $sql = "select student.studentno,student.sname,course.cname,score.score,score.time
from teacher,student,score,course
where teacher.classno=student.classno
and student.studentno=score.studentno
and teacher.teacherno=course.teacherno
and teacher.teacherno='$name'
and score.time<='$endtime'
and score.time>='$strarttime'";

//
//$sql = "select student.studentno,student.sname,course.cname,score.score,score.time
//from teacher,student,score,course
//where teacher.classno=student.classno
//and student.studentno=score.studentno
//and teacher.teacherno=course.teacherno
//and teacher.teacherno='.$name.'
//and score.time<='.$endtime.'
//and score.time>='".$strarttime."'";



//echo $sql;


$result=mysqli_query($con,$sql);

$data="";

class User{
    public $sno;

    public $name;
    public $cname;
    public $score;
    public $time;
}


while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

    $user=new User();
    $user->sno=$row['studentno'];
    $user->name=$row['sname'];
    $user->cname=$row['cname'];
    $user->score=$row['score'];

    $user->time=$row['time'];
    $array[]=$user;

}


$data=json_encode($array);
echo $data;


mysqli_free_result($result);
mysqli_close($con);






?>