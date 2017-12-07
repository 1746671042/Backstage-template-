<?php 
include '../mysqldb.php';
$link = mysqlDb::getIntance("app");
$sql = "select * from video";
$data = $link->queryAll($sql);


//分页
$page =isset($_GET["page"])?$_GET["page"]:1;  ///当前页数
$num =4;   //每页显示的条数
$start =($page-1) * $num;   //0
/*-------------------------------------------总页数 ----------------------*/
$sql = "select * from video";
$result = $link->queryNum($sql);
//$result = mysqli_query($con, $sql);
$countpage= ceil($result/$num);
//echo $result;
/*-------------------------------------------总页数 ----------------------*/
/*-------------------------------------------每页数据 ----------------------*/
//echo $num;
$sql ="select * from video limit {$start},{$num} ";
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
                <li><a href="#">视频管理</a></li>
                <li><a href="#">视频列表</a></li>
            </ul>
        </div>

        <div class="rightinfo">

            <div class="tools">

                <ul class="toolbar">
                    <li class="click"><span><img src="../../images/t02.png" /></span>修改</li>
                </ul>
            </div>


            <table class="tablelist">
                <thead>
                    <tr>
                        <th>id<i class="sort"><img src="../../images/px.gif" /></i></th>
                        <th>Username</th>
                        <th>video_url</th>
                        <th>Image_url</th>
                        <th>theme</th>
                        <th>promulgator</th>
                        <th>time</th>
                        <th>see</th>
                        <th>introduce</th>
                        <th>hot</th>
                        <th>look</th>
                        <th>Auditor</th>
                        <th>Auditor_time</th>
                        <th>is_Auditor</th>
                        <th>Auditor_remarks</th>
                        
                        <th>&nbsp;&nbsp;操作&nbsp;&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($results as $k=>$v) {?>
                    <tr>
                        <td><?php echo $v["id"]?></td>
                        <td><?php echo $v["username"]?></td>
                        <td><?php echo $v["video_url"]?></td>
                        <td><?php echo $v["image_url"]?></td>
                        <td><?php echo $v["theme"]?></td>
                        <td><?php echo $v["promulgator"]?></td>
                        <td><?php echo $v["time"]?></td>
                        <td><?php echo $v["see"]?></td>
                        <td><?php echo $v["introduce"]?></td>
                        <td><?php echo $v["hot"]?></td>
                        <td><?php echo $v["look"]?></td>
                        <td><?php echo $v["auditor"]?></td>
                        <td><?php echo $v["auditor_time"]?></td>
                        <td><?php echo $v["is_auditor"]?></td>
                        <td><?php echo $v["auditor_Remarks"]?></td>
                        <td>
                        <a href="./videoContent.php?video_url=<?php echo $v["video_url"]?>&video_id=<?php echo $v["id"]?>" class="tablelink">查看</a>
<!--                    <a href="" class="tablelink">查看</a>-->
<!--                        <a href="./auditor.php?id=<?php echo $v["id"]?>&auditor=1" class="tablelink">未审核(1)</a>-->
                        <?php if($v["is_auditor"] == 1) {?>
                        <a href="./auditor.php?id=<?php echo $v["id"]?>&auditor=2" class="tablelink">未通过</a>
                        <a href="./auditor.php?id=<?php echo $v["id"]?>&auditor=3" class="tablelink">通过</a>
                         <?php }?>
                        <?php if($v["is_auditor"] == 2) {?>
                        <a href="./auditor.php?id=<?php echo $v["id"]?>&auditor=3" class="tablelink">通过</a>
                        <?php }?>
                        <?php if($v["is_auditor"] == 3) {?>
                        <a href="./auditor.php?id=<?php echo $v["id"]?>&auditor=2" class="tablelink">未通过</a>
                        <?php }?>
                        </td>
                    </tr> 
                    <?php }?>

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
                            <li class="paginItem"><a href="videoList.php?page=<?php echo $page-1;?>"><span class="pagepre"></span></a></li>
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
                                <li class="paginItem"><a href="videoList.php?page=<?php echo $i;?>" class="pageone"><?php echo $i;?></a></li>
                                 <?php } else { ?>
                                <li class="paginItem"><a href="videoList.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                                 <?php } ?>
                            <?php }?>
<!--	    			<li class="pageone">1</li>	-->
<!--	    			<li>2</li>	
	    			<li>3</li>-->
                            <?php if($page <$countpage) { ?>
                                <li class="paginItem"><a href="videoList.php?page=<?php echo $page+1;?>"><span class="pagenxt"></span></a></li>
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
