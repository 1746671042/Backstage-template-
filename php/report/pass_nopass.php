<?php
include '../mysqldb.php';
$link = mysqlDb::getIntance("app");
$is_auditor = isset($_GET["is_auditor"]) ? $_GET["is_auditor"] : "";
$video_id = isset($_GET["video_id"]) ? $_GET["video_id"] : "";
$date = date('Y-m-d H:i:s');
if($is_auditor ==2){
    $sql = "update video set is_Auditor = '{$is_auditor}',Auditor_time ='{$date}',auditor_Remarks = '内容包括暴力色情等！' where id= '{$video_id}'";
}
elseif ($is_auditor ==1) {
    $sql = "update video set is_Auditor = '{$is_auditor}',Auditor_time ='{$date}',auditor_Remarks = '未审核！' where id= '{$video_id}'";
}else{
    $sql = "update video set is_Auditor = '{$is_auditor}',Auditor_time ='{$date}',auditor_Remarks = '通过' where id= '{$video_id}'";
}
$result =$link->update($sql);
if($result){
    echo "<script>alert('修改成功！');window.location.href = './reportList.php';</script>";
    exit();
}else{
    echo "<script>alert('修改失败！');window.history.go(-1);</script>";
    exit();
}
