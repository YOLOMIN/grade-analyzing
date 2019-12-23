<?php
/**
 * 一个操作mysql数据库的类
 */

require_once("dbconfig.php");
require_once("Classes/PHPExcel.php");

class db{
    public $con = null;

    //构造函数，初始化$con
    public function __construct($config){
        $this->con = mysqli_connect($config["host"],$config["username"],$config["password"]) or die("Connection failed:".mysqli_connect_error());  //创建连接对象
        mysqli_select_db($this->con,$config["database"]);      //选择连接的数据库
        mysqli_set_charset($this->con,$config["charset"]);     //选择编码方式
    }

    //根据传入的sql查询语句，返回查询结果
    public function getResult($sql){
        $resource = mysqli_query($this->con,$sql);     //执行查询语句并将查询结果赋给$resource
        $res = array();
        while(($row = mysqli_fetch_assoc($resource))!= false){      //循环遍历$resource，将$resource内容保存在$res中
            $res[] = $row;
        }
        return $res;
    }

    //根据传入的sql插入语句，将数据插入数据表（单行插入）
    public function insertRow($sql){
        if(mysqli_query($this->con,$sql)){
            return 1;   //插入成功返回1
        }else{
            return -1;
        }
    }

}

?>