<?php
$file = $_FILES['file'];
$tmpname = $file['tmp_name'];  //文件临时存储路径名 /home/php0e23.txt
$filename = $file['name'];  //文件名 a.txt
$filetype = $file['type'];  //文件类型 text/plain
if($file['size']>2048000){ //文件大小超过2MB
    echo '文件过大';
    exit();
}
if($file['error']){  //存在错误
    echo '未获取到上传的文件';
    exit();
}
if(is_uploaded_file($tmpname)){  //临时文件存在
    $mvd = move_uploaded_file($tmpname,$filename); //移动到自定义的位置
    if(!$mvd){
        echo '上传失败，文件转存过程出错';
        exit(500);
    }
}


echo "文件上传成功";
?>