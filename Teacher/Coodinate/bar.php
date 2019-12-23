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


$sql="select * from teacher where username='$name'";

$result=mysqli_query($con,$sql);

$rownum = mysqli_num_rows($result);

$array1 = mysqli_fetch_array($result);

//                echo $sql;




    $sql = "select student.studentno,student.sname,course.cname,score.score,score.time
from teacher,student,score,course
where teacher.classno=student.classno
and student.studentno=score.studentno
and teacher.teacherno=course.teacherno
and course.id=score.courseno
and teacher.teacherno=".$array1["teacherno"]."
ORDER BY score.time asc";


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

//if(isset($_POST['btn']))
// echo "<script> alert('查找成功');  window.location.href=\"SeachScore.html\"; </script>";

mysqli_free_result($result);
mysqli_close($con);


?>