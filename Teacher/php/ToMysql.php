<?php
require_once("../../conn/db.php");

require_once("../../conn/conn.php");

require_once '../../conn/Classes/PHPExcel/IOFactory.php';

$db = new db($school);

//$dir = $_FILES["file"]["tmp_name"];


    $file = $_FILES['file'];
    $dir = $file['tmp_name'];  //文件临时存储路径名 /home/php0e23.txt
   // $dir = $_FILES['file']['name'];
    $objPHPExcel = PHPExcel_IOFactory::load($dir);  //加载ecel文件
    $sheet = $objPHPExcel->getActiveSheet();
    $count = $sheet->getChartCount();

    //先对成绩表进行查询，获取行数，然后在数据表之后进行id自增插入

    $sql='select * from score';

     $result=mysqli_query($con,$sql);

    //获取数据表中的行数
    $rownum=mysqli_num_rows($result);

    //释放资源集中的数据
    mysqli_free_result($result);

    //用于增加数据表id
    $j=$rownum+1;

    foreach ($sheet->getRowIterator() as $row) {      //逐行遍历excel表格
        if ($row->getRowIndex() < 2) {
            continue;
        }
        $val = array();



        $i = 0;
        foreach ($row->getCellIterator() as $cell) {      //遍历每行的单元格
            $val[$i] = $cell->getValue();      //获取单元格数据
            $i++;
        }
        if ($val[0] == "" && $val[1] == "" && $val[2] == "" && $val[3] == "") {
            break;
        }
        $sql = "insert into score values('$j','$val[0]','$val[1]','$val[2]','$val[3]')";


        $j++;

        if ($db->insertRow($sql) < 0) {

            echo "导入失败";

         //   echo "<script>alert('导入失败！！！')</script>";

           // header("Refresh:0;url=../Teacher/AddScore.html");
        }
    }

    echo "导入成功";

    //echo "<script>alert('导入成功！！！')</script>";
   // header("Refresh:0;url=../AddScore.html");




?>