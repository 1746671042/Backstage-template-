<?php 
include '../mysqldb.php';
$link = mysqlDb::getIntance("app");
$sql = "select * from report";
$data = $link->queryAll($sql);                             


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
                        <th>video_id</th>
                        <th>user_id</th>
                        <th>&nbsp;&nbsp;查看&nbsp;&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $k=>$v) {?>
                    <tr>
                        <td><?php echo $v["id"]?></td>
                        <td><?php echo $v["video_id"]?></td>
                        <td><?php echo $v["user_id"]?></td>
                        <td>
                            <?php 
                            $sql = "select * from video where id='{$v["video_id"]}'";
                            $list = $link->queryAll($sql);
                            $result ="";
                            foreach ($list as $k=>$v){
                                $result = $v;
     
                                $result = $result["video_url"];
                            }
                            ?>
                         
                            <a href="./reportContent.php?video_url=<?php echo $result ?>&video_id= <?php echo $video_id = $v["id"];?>" class="tablelink">查看</a>
                        </td>
                        
                    </tr> 
                    <?php }?>

                </tbody>
            </table>


            <div class="pagin">
                <div class="message">共<i class="blue">16</i>条记录，当前显示第&nbsp;<i class="blue">2&nbsp;</i>页</div>
                <ul class="paginList">
                    <li class="paginItem"><a href="javascript:;"><span class="pagepre"></span></a></li>
                    <li class="paginItem"><a href="javascript:;">1</a></li>
                    <li class="paginItem current"><a href="javascript:;">2</a></li>
                    <li class="paginItem"><a href="javascript:;">3</a></li>
                    <li class="paginItem"><a href="javascript:;">4</a></li>
                    <li class="paginItem"><a href="javascript:;">5</a></li>
                    <li class="paginItem more"><a href="javascript:;">...</a></li>
                    <li class="paginItem"><a href="javascript:;">10</a></li>
                    <li class="paginItem"><a href="javascript:;"><span class="pagenxt"></span></a></li>
                </ul>
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
