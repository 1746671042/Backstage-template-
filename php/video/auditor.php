<?php
$id = isset($_GET["id"])?$_GET["id"]:1;
$auditor = isset($_GET["auditor"])?$_GET["auditor"]:"";
$date = date('Y-m-d H:i:s');

include '../mysqldb.php';
$link = mysqlDb::getIntance("app");
$sql = "select name from admin,video where admin.id=video.admin_id";
$name =$link->queryAll($sql);
foreach($name as $k=>$v){
    $name = $v;
}
$name = $name["name"];

if($auditor ==2){
    $sql = "update video set is_Auditor = '{$auditor}',Auditor_time ='{$date}',Auditor ='{$name}',auditor_Remarks = '内容包括暴力色情等！' where id= '{$id}'";
}
elseif ($auditor ==1) {
    $sql = "update video set is_Auditor = '{$auditor}',Auditor_time ='{$date}',Auditor ='{$name}',auditor_Remarks = '未审核！' where id= '{$id}'";
}else{
    $sql = "update video set is_Auditor = '{$auditor}',Auditor_time ='{$date}',Auditor ='{$name}',auditor_Remarks = '通过' where id= '{$id}'";
}
$result =$link->update($sql);
if($result){
    echo "<script>alert('审核成功！');window.location.href = './videoList.php';</script>";
    exit();
}else{
    echo "<script>alert('审核失败！');window.history.go(-1);</script>";
    exit();
}
