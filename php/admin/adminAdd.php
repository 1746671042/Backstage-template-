<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>无标题文档</title>
        <link href="../../css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <div class="place">
            <span>位置：</span>
            <ul class="placeul">
                <li><a href="#">管理信息</a></li>
                <li><a href="#">管理员</a></li>
                <li><a href="#">管理员添加</a></li>
            </ul>
        </div>

        <div class="formbody">

            <div class="formtitle"><span>基本信息</span></div>
            <form action="./adminInsert.php" method="post">
                <ul class="forminfo">
                    <li><label>用户名：</label><input name="name" type="text" class="dfinput" /><i>用户名称不能超过30个字符</i></li>
                    <li><label>密码：</label><input name="pwd" type="password" class="dfinput" /><i></i></li>
                    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="登录"/></li>
                </ul>
            </form>

        </div>
    </body>
</html>
