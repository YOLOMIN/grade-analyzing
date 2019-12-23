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

$strarttime=$_POST['starttime'];
$endtime=$_POST['endtime'];
$sname=$_POST['sname'];



$sql="select * from teacher where username='$name'";

$result=mysqli_query($con,$sql);

$rownum = mysqli_num_rows($result);

$array1 = mysqli_fetch_array($result);



$sql = "select student.studentno,student.sname,course.cname,score.score,score.time
from teacher,student,score,course
where teacher.classno=student.classno
and student.studentno=score.studentno
and teacher.teacherno=course.teacherno
and course.id=score.courseno
and teacher.teacherno='".$array1['teacherno']."'
and score.time<='$endtime'
and score.time>='$strarttime'
and student.sname='".$sname."'";




//
/////获取班级数据
//$sql1 = "select student.studentno,student.sname,course.cname,score.score,score.time
//from teacher,student,score,course
//where teacher.classno=student.classno
//and student.studentno=score.studentno
//and teacher.teacherno=course.teacherno
//and course.id=score.courseno
//and teacher.teacherno='$name'
//and score.time<='$endtime'
//and score.time>='".$strarttime."'";



//echo $sql1;


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