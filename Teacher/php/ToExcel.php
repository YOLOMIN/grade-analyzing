<?php
require_once("../../conn/db.php");
require_once '../../conn/Classes/PHPExcel.php';

$db = new db($school);      //实例化db类链接数据库
$objPHPExcel = new PHPExcel();    //实例化PHPExcel

$actSheet = $objPHPExcel->getActiveSheet();     //获取当前活动的Sheet
$sql = "select * from score where 1=1";
$result = $db->getResult($sql);

$actSheet->setCellValue("A1","学号")->setCellValue("B1","课程")->setCellValue("C1","分数")->setCellValue("D1","时间");
$i = 2;
foreach($result as $key => $val){
    $actSheet->setCellValue("A".$i,$val["studentno"])->setCellValue("B".$i,$val["courseno"])->setCellValue("C".$i,$val["score"])->setCellValue("D".$i,$val["time"]);
    $i++;
}
$writer = PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel5");
$writer->save("score1.xls");
echo "<script> alert('数据导出成功！！！') </script>";

?>
