<?php
include '../mysqldb.php';
$link = mysqlDb::getIntance("app");
$name = isset($_POST["name"])?$_POST["name"]:"";
$pwd = isset($_POST["pwd"])?$_POST["pwd"]:"";
if($name =="" || $pwd ==""){
    echo "<script>alert('用户名或密码不能为空！');window.history.go(-1);</script>";
    exit();
}
$pwd = md5($pwd);
$sql = "insert into admin (name,pwd) values ('{$name}','{$pwd}')";
$result = $link->add($sql);
if($result){
    echo "<script>alert('添加成功！');window.location.href = 'adminList.php';</script>";
    exit();
}else{
    echo "<script>alert('添加失败！');window.history.go(-1);</script>";
    exit();
}