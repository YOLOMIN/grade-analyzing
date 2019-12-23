<?php
/**
 * Created by PhpStorm.
 * User: HuangLC
 * Date: 2019/3/6
 * Time: 15:11
 */
require_once("../../conn/db.php");
$studentno = $_POST["studentno"];
$course = $_POST["course"];
$score = $_POST["score"];
$time = $_POST["time"];

$sql = "insert into score values('$studentno','$course','$score','$time')";
$db = new db($school);
if($db->insertRow($sql) == 1){
    echo "<script>alert('插入成功！！！')</script>";
    header("Refresh:0;url=../AddScore.html");
}else{
    echo "<script>alert('插入失败！！！')</script>";
    header("Refresh:0;url=../AddScore.html");
}
