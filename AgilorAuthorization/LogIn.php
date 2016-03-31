<!--/**
* Created by PhpStorm.
* User: AKITO
* Date: 2016/1/27
* Time: 15:12
*/-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <title>Agilor用户登陆</title>
    <link href="LogIn.css" rel="stylesheet" type="text/css">
    <link href="FontSize.css" rel="stylesheet" type="text/css">
    <script src="LogIn.js" type="text/javascript"></script>
</head>
<body>
    <div id="iscas" class="font24">安 捷 （Agilor） 实 时 数 据 库 系 统</div>
    <div id="banner"></div>
    <div id="main">
        <h2 id="tip_title" class="font36">
            <span class="pull-left font-thin">欢迎回来</span>
            <small class="font12 pull-right">
                没有账号？
                <a href="Register.php" class="link_blue">立即注册</a>
            </small>
        </h2>
        <form autocomplete="off" action="LogInProcess.php" method="post" onSubmit="return InputCheck(this)">
            <div class="form-group">
                <label for="user_email">我的账号</label>
                <div class="inps">
                    <input id="user_email" name="user_email" class="form-control" type="email"
                           placeholder="请输入邮箱账号" autocomplete="off" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="user_password">登陆密码</label>
                <div class="inps">
                    <input id="user_password" name="user_password" class="form-control" type="password"
                           placeholder="请输入账号密码" autocomplete="off" value="">
                </div>
            </div>
            <br><br>
            <button id="login" name="login" type="submit" class="btn-login font18" value="login">
                立即登录
            </button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <a class="font14 link_grey">
                （若您用IE浏览，请确保IE版本在9.0或以上）
            </a>
        </form>
    </div>
</body>
</html>