<?php
$id = isset($_GET["id"])?$_GET["id"]:"";
$show = isset($_GET["show"])?$_GET["show"]:1;
include '../mysqldb.php';
$link = mysqlDb::getIntance("app");
$date = date('Y-m-d H:i:s');
if($show ==1){
    $sql ="update comment set is_auditor=1,add_time='{$date}' where id='{$id}'";
    $list =$link->queryAll($sql);
    echo "<script>window.location.href='commentList.php';</script>";
}else{
    $sql = "update comment set is_auditor=2,add_time='{$date}' where id='{$id}'";
    $list =$link->update($sql);
    echo "<script>window.location.href='commentList.php';</script>";
}
