<?php
$id = isset($_GET["id"]) ? $_GET["id"] : "";
$video_id = isset($_GET["video_id"]) ? $_GET["video_id"] : "";
$video_url = isset($_GET["video_url"]) ? $_GET["video_url"] : "";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
        <link href="../../css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <style type="text/css">
            *{
                margin: 0 auto;
            }
            .video-js{
                height: 300px;
                margin-top: 50px;
            }
            embed{
                wmode:transparent;
                display:inline-block;
                margin: 0 auto;
                aligin:center;
                width:600px;
                height:350px;
            }
        </style>
    </head>
    <body>
        <div class="video-js">
            <!--<embed src="<?php echo $video_id ?>"/>-->
            <center>
                <embed src="<?php echo $video_url?>" align="A" width="500" height="400" autostart="true" loop="true" margin-top="50"></embed>
                <div style="margin-top:30px;">
                <a href="./pass_nopass.php?is_auditor=3&video_id=<?php echo $video_id?>" class="tablelink" style="padding:3px 5px; border: 1px solid gainsboro;margin-right:30px;">通过</a>
                <a href="./pass_nopass.php?is_auditor=2&video_id=<?php echo $video_id?>" class="tablelink" style="padding:3px 5px; border: 1px solid gainsboro;margin-right:30px;">未通过</a>
                </div>
            </center>
            
        </div>
    </body>
</html>

