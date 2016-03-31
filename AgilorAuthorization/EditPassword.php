<!--/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/3/8
 * Time: 15:58
*/-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <title>更改密码</title>
    <link href="EditPassword.css" rel="stylesheet" type="text/css">
    <link href="FontSize.css" rel="stylesheet" type="text/css">
    <script src="EditPassword.js" type="text/javascript"></script>
</head>
<body>
<div id="iscas" class="font24">安 捷 （Agilor） 实 时 数 据 库 系 统</div>
<div id="banner"></div>
<div id="main">
    <h2 id="tip_title" class="font36">
        <span class="pull-left font-thin">修改密码</span>
    </h2>
    <form  name="regForm" method="post" action="EditPasswordProcess.php" onSubmit="return InputCheck(this)">
        <div class="form-group">
            <label for="old_password">输入旧密码</label>
            <div class="inps">
                <input id="old_password" name="old_password" class="form-control" type="text"
                       placeholder="请输入您的旧密码" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="new_password">输入新密码</label>
            <div class="inps">
                <input id="new_password" name="new_password" class="form-control" type="text"
                       placeholder="请输入您的新密码，由6-20位的字母和数字组成" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="new_password_confirm">确认新密码</label>
            <div class="inps">
                <input id="new_password_confirm" name="new_password_confirm" class="form-control" type="text"
                       placeholder="请确认您的新密码" autocomplete="off">
            </div>
        </div>
        <br><br>
        <button id="submit" type="submit" name="submit" class="btn-edit font18" value="修改">
            确认修改
        </button>&nbsp&nbsp&nbsp
        <button id="authorize" type="button" class="btn-back font18" onclick="skip()">
            返回
        </button>
    </form>
    <script type="text/javascript">
        function skip() {
            window.location.href="GuestPage.php";
        }
    </script>
</div>
</body>
</html>