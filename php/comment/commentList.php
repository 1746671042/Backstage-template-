<?php
include '../mysqldb.php';
$link = mysqlDb::getIntance("app");
$sql = "select * from comment";
$data = $link->queryAll($sql);
$show = 1;



//分页
$page =isset($_GET["page"])?$_GET["page"]:1;  ///当前页数
$num =5;   //每页显示的条数
$start =($page-1) * $num;   //0
/*-------------------------------------------总页数 ----------------------*/
$sql = "select * from comment";
$result = $link->queryNum($sql);
//$result = mysqli_query($con, $sql);
$countpage= ceil($result/$num);
//echo $result;
/*-------------------------------------------总页数 ----------------------*/
/*-------------------------------------------每页数据 ----------------------*/
//echo $num;
$sql ="select * from comment limit {$start},{$num} ";
$results = $link ->queryAll($sql);
/*-------------------------------------------每页数据 ----------------------*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="../../css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script language="javascript">
            $(function () {
                //导航切换
                $(".imglist li").click(function () {
                    $(".imglist li.selected").removeClass("selected")
                    $(this).addClass("selected");
                })
            })
        </script>
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
                <li><a href="#">首页</a></li>
                <li><a href="#">图片列表</a></li>
            </ul>
        </div>

        <div class="rightinfo">

            <div class="tools">

                <ul class="toolbar">
                    <li><span><img src="../../images/t03.png" /></span>删除</li>

                </ul>
            </div>


            <table class="imgtable">

                <thead>
                    <tr>
                        <th>id</th>
                        <th>user_id</th>
                        <th>video_id</th>
                        <th>add_time</th>
                        <th>content</th>
                        <th>is_auditor</th>
                        <th>&nbsp;&nbsp;操作&nbsp;&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($results as $k => $v) { ?>
                        <tr>
                            <td><?php echo $v["id"] ?></td>
                            <td><?php echo $v["user_id"] ?></td>
                            <td><?php echo $v["video_id"] ?></td>
                            <td><?php echo $v["add_time"] ?></td> 
                            
                            <?php if($v["is_auditor"] ==1){?>
                            <td><?php echo $v["content"] ?></td>
                            <?php }else {?>
                            <td><?php echo "" ?></td>
                            <?php }?>
                            <td><?php echo $v["is_auditor"] ?></td> 
                            <td>
                                <!--                    <a href="" class="tablelink">查看</a>-->
                                <?php if($v["is_auditor"] == 1){?>
                                    <a href="./commentContent.php?id=<?php echo $v["id"]?>&show=2" class="tablelink">不显示</a>
                                <?php }else{ ?>
                                    <a href="./commentContent.php?id=<?php echo $v["id"]?>&show=1 " class="tablelink">显示</a>
                                <?php }?>
                                
                                

                            </td>
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
                            <li class="paginItem"><a href="commentList.php?page=<?php echo $page-1;?>"><span class="pagepre"></span></a></li>
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
                                <li class="paginItem"><a href="commentList.php?page=<?php echo $i;?>" class="pageone"><?php echo $i;?></a></li>
                                 <?php } else { ?>
                                <li class="paginItem"><a href="commentList.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
                                 <?php } ?>
                            <?php }?>
<!--	    			<li class="pageone">1</li>	-->
<!--	    			<li>2</li>	
	    			<li>3</li>-->
                            <?php if($page <$countpage) { ?>
                                <li class="paginItem"><a href="commentList.php?page=<?php echo $page+1;?>"><span class="pagenxt"></span></a></li>
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
                    <span><img src="images/ticon.png" /></span>
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

        <div class="tip">
            <div class="tiptop"><span>提示信息</span><a></a></div>

            <div class="tipinfo">
                <span><img src="images/ticon.png" /></span>
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

        <script type="text/javascript">
            $('.imgtable tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>
