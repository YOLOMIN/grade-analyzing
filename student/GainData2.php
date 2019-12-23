<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2019/3/30
 * Time: 16:19
 */

//用于绘图的数据传值

require ('../conn/conn.php');
require('../authentication/CheckUser.php');
//session_start();
$name1=$_SESSION['userno'];

    $starttime=$_POST['starttime'];
    $endtime=$_POST['endtime'];
//    echo $starttime;
//    echo $endtime;
    //获取个人成绩
    $sql_Chinese = "select student.studentno,student.sname,course.courserno,course.cname,score.score,score.time
from student,score,course
where student.studentno=score.studentno
and score.courseno=course.id
and score.courseno='1'
and student.studentno='$name1'
and score.time<='".$endtime."'
GROUP BY time";
    $sql_Math = "select student.studentno,student.sname,course.courserno,course.cname,score.score,score.time
from student,score,course
where student.studentno=score.studentno
and score.courseno=course.id
and score.courseno='2'
and student.studentno='$name1'
and score.time<='".$endtime."'
GROUP BY time";
    $sql_English = "select student.studentno,student.sname,course.courserno,course.cname,score.score,score.time
from student,score,course
where student.studentno=score.studentno
and score.courseno=course.id
and score.courseno='3'
and student.studentno='$name1'
and score.time<='".$endtime."'
GROUP BY time";
    //获取班级课程平均分
    $chinese_AVG="select distinct AVG(score) as chinese
from score,student,(select classno from student where studentno='$name1')as A
where courseno='1' 
and score.studentno = any( select studentno from student where classno=A.classno)
and score.time<='".$endtime."'
GROUP BY time";

    $math_AVG="select distinct AVG(score) as math
from score,student,(select classno from student where studentno='$name1')as A
where courseno='2' 
and score.studentno = any( select studentno from student where classno=A.classno)
and score.time<='".$endtime."'
GROUP BY time";

    $english_AVG="select distinct AVG(score) as english
from score,student,(select classno from student where studentno='$name1')as A
where courseno='3' 
and score.studentno = any( select studentno from student where classno=A.classno)
and score.time<='".$endtime."'
GROUP BY time";
//获取年级课程平均分
    $ChineseGradeAVG="select distinct AVG(score) as ChineseGrade
from score,student
where courseno='1' 
and score.studentno = any( select studentno from student where studentno like '2016%')
and score.time<='".$endtime."'
GROUP BY time";
    $MathGradeAVG="select distinct AVG(score) as MathGrade
from score,student
where courseno='2' 
and score.studentno = any( select studentno from student where studentno like '2016%')
and score.time<='".$endtime."'
GROUP BY time";
    $EnglishGradeAVG="select distinct AVG(score) as EnglishGrade
from score,student
where courseno='3' 
and score.studentno = any( select studentno from student where studentno like '2016%')
and score.time<='".$endtime."'
GROUP BY time";

$result1=mysqli_query($con,$sql_Chinese);//获取个人成绩
$result2=mysqli_query($con,$sql_Math);
$result3=mysqli_query($con,$sql_English);

$resultC=mysqli_query($con,$chinese_AVG);//获取班级平均分
$resultM=mysqli_query($con,$math_AVG);
$resultE=mysqli_query($con,$english_AVG);

$resultCG=mysqli_query($con,$ChineseGradeAVG);//获取年纪平均分
$resultMG=mysqli_query($con,$MathGradeAVG);
$resultEG=mysqli_query($con,$EnglishGradeAVG);
$data="";

class User{
    public $Chinese;//个人成绩
    public $Math;
    public $English;
    public $C_Chinese;//班级平均分
    public $C_Math;
    public $C_English;
    public $G_Chinese;//年纪平均分
    public $G_Math;
    public $G_English;
    public $SumScore;
    public $ClassSumScore;
    public $GradeSumScore;
    public $time;

}
while($row1=mysqli_fetch_array($result1,MYSQLI_ASSOC)){
    $user=new User();

    $rowC=mysqli_fetch_array($resultC,MYSQLI_ASSOC);
    $user->Chinese=$row1['score'];
    $user->C_Chinese=$rowC['chinese'];
    $rowCG=mysqli_fetch_array($resultCG,MYSQLI_ASSOC);
    $user->G_Chinese=$rowCG['ChineseGrade'];

    $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
    $user->Math=$row2['score'];
    $rowM=mysqli_fetch_array($resultM,MYSQLI_ASSOC);
    $user->C_Math=$rowM['math'];
    $rowMG=mysqli_fetch_array($resultMG,MYSQLI_ASSOC);
    $user->G_Math=$rowMG['MathGrade'];

    $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
    $user->English=$row3['score'];
    $rowE=mysqli_fetch_array($resultE,MYSQLI_ASSOC);
    $user->C_English=$rowE['english'];
    $rowEG=mysqli_fetch_array($resultEG,MYSQLI_ASSOC);
    $user->G_English=$rowEG['EnglishGrade'];

    $user->time=$row1['time'];
    $user->SumScore= $row1['score']+$row2['score']+$row3['score'];
    $user->ClassSumScore= $user->C_Chinese+ $user->C_Math+ $user->C_English;
    $user->GradeSumScore=$user->G_Chinese+$user->G_Math+$user->G_English;
    $array[]=$user;
}
$data=json_encode($array);
echo $data;



mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_free_result($result3);
mysqli_close($con);


?>