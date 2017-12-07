<?php
//重置密码
$id = isset($_GET["id"])?$_GET["id"]:0;
if(is_numeric($id)==false){
     echo "<script>alert('传参格式不正确！');window.history.go(-1);</script>";
    exit();
}
$pwd = md5(123456);
$sql = "update admin set pwd='{$pwd}' where id = {$id}";
include '../mysqldb.php';
$link = mysqlDb::getIntance("app");
$result =$link->update($sql);
if($result){
    echo "<script>alert('重置成功！');window.location.href = 'adminList.php';</script>";
    exit();
}else{
    echo "<script>alert('重置失败！');window.history.go(-1);</script>";
    exit();
}
