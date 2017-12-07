<?php
include '../mysqldb.php';
$link = mysqlDb::getIntance("app");
$sql = "select * from admin";
$data = $link->queryAll($sql);
/*-------------------------------------------------查询------------------------------------------------------*/
//分页
$page =isset($_GET["page"])?$_GET["page"]:1;  ///当前页数
$num =5;   //每页显示的条数
$start =($page-1) * $num;   //0
/*-------------------------------------------总页数 ----------------------*/
$sql = "select * from admin";
$result = $link->queryNum($sql);
//$result = mysqli_query($con, $sql);
$countpage= ceil($result/$num);
//echo $result;
/*-------------------------------------------总页数 ----------------------*/
/*-------------------------------------------每页数据 ----------------------*/
//echo $num;
$sql ="select * from admin limit {$start},{$num} ";
$results = $link ->queryAll($sql);
/*-------------------------------------------每页数据 ----------------------*/
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
        <link href="../../css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../../js/jquery.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $(".click").click(function () {
                    $(".tip").fadeIn(200);
                });

                $(".tiptop a").click(function () {
                    $(".tip").fadeOut(200);
                });

                $(".sure").click(function () {
                    $(".tip").fadeOut(100);
                });

                $(".cancel").click(function () {
                    $(".tip").fadeOut(100);
                });

            });
        </script>


    </head>


    <body>

        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="#">管理信息</a></li>
                <li><a href="#">管理员</a></li>
                <li><a href="#">管理员列表</a></li>
            </ul>
        </div>

        <div class="rightinfo">

            <div class="tools">

                <ul class="toolbar">
                    <a href="./adminAdd.php" target="rightFrame"> <li class="click"><span><img src="../../images/t01.png" /></span>添加</li></a>

                </ul>


            </div>


            <table class="tablelist">
                <thead>
                    <tr>
                        <th>id<i class="sort"><img src="../../images/px.gif" /></i></th>
                        <th>用户</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $k => $v) { ?>
                        <tr>
                            <td><?php echo $v["id"] ?></td>
                            <td><?php echo $v["name"] ?></td>
                            <td><a href="./adminUpdatepwd.php?id=<?php echo $v["id"] ?>" class="tablelink">重置密码</a>   
                                <?php if($v["name"]!="admin") { ?>
                                <a href="./adminDelete.php?id=<?php echo $v["id"] ?>"" class="tablelink"> 删除</a></td>
                                <?php }?>
                        </tr> 
                    <?php } ?>

                </tbody>
            </table>


            <div class="pagin">
                <div class="message">共<i class="blue"><?php echo $result?></i>条记录，当前显示第&nbsp;<i class="blue">&nbsp;</i><?php echo $page?>页</div>
                
                  <?php if($countpage >1) {?>
	    		<ul class="paginList">  
                            <?php 
                                $startpage =$page-2;
                                $endpage =$page+2;
                              
                                if($countpage>=4){
                                    if($startpage<=0){
                                        $startpage = 1;
                                        $endpage = 4;
                                    }
                                    if($endpage>$countpage){
                                        $endpage=$countpage;
                                        $startpage=$endpage-1;
                                    }
                                }
                                else{
                                    $startpage=1;
                                    $endpage=$countpage;
                                }
                            ?>          
                            
                            <?php if($page>1) { ?>
                            <li class="paginItem"><a href="adminList.php?page=<?php echo $page-1;?>"><span class="pagepre"></span></a></li>
<!--	    			<li>
                                    <a href="adminList.php?page=<?php echo $page-1;?>"><</a>
                                </li>-->
                            <?php }?>
<!--                                 <li class="paginItem"><a href="javascript:;">1</a></li>
                                <li class="paginItem current"><a href="javascript:;">2</a></li>
                                <li class="paginItem"><a href="javascript:;">3</a></li>
                                <li class="paginItem more"><a href="javascript:;">...</a></li>-->
                                
                            <?php for($i =$startpage;$i<=$endpage;$i++) { ?>
                                 <?php if($i==$page) { ?>
                                <li class="paginItem"><a href="adminList.php?page=<?php echo $i;?>" class="pageone"><?php echo $i;?></a></li>
                                 <?php } else { ?>
                                <li class="paginItem"><a href="adminList.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                                 <?php } ?>
                            <?php }?>
<!--	    			<li class="pageone">1</li>	-->
<!--	    			<li>2</li>	
	    			<li>3</li>-->
                            <?php if($page <$countpage) { ?>
                                <li class="paginItem"><a href="adminList.php?page=<?php echo $page+1;?>"><span class="pagenxt"></span></a></li>
<!--	    			<li>
                                    <a href="adminList.php?page=<?php echo $page+1;?>">></a>
                                </li>-->
                            <?php }?>
	    		</ul>
                    <?php }?>
            </div>


            <div class="tip">
                <div class="tiptop"><span>提示信息</span><a></a></div>

                <div class="tipinfo">
                    <span><img src="../../images/ticon.png" /></span>
                    <div class="tipright">
                        <p>是否确认对信息的修改 ？</p>
                        <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
                    </div>
                </div>

                <div class="tipbtn">
                    <input name="" type="button"  class="sure" value="确定" />&nbsp;
                    <input name="" type="button"  class="cancel" value="取消" />
                </div>

            </div>




        </div>

        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>
