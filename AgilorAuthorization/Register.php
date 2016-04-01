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
    <title>Agilor用户注册</title>
    <link href="Register.css" rel="stylesheet" type="text/css">
    <link href="FontSize.css" rel="stylesheet" type="text/css">
    <script src="Register.js" type="text/javascript"></script>
</head>
<body>
    <div id="iscas" class="font24">安 捷 （Agilor） 实 时 数 据 库 系 统</div>
    <div id="banner"></div>
    <div id="main">
        <h2 id="tip_title" class="font36">
            <span class="pull-left font-thin">加入我们</span>
            <small class="font12 pull-right">
                已有账号？
                <a href="LogIn.php" class="link_green">立即登陆</a>
            </small>
        </h2>
        <form  name="regForm" method="post" action="RegisterProcess.php" onSubmit="return InputCheck(this)">
            <div class="form-group">
                <label for="user_email">我的账号</label>
                <div class="inps">
                    <input id="user_email" name="user_email" class="form-control" type="email"
                           placeholder="请输入您的电子邮箱" autocomplete="off" value="tenkawa_akito@qq.com">
                </div>
            </div>
            <div class="form-group">
                <label for="user_password">输入密码</label>
                <div class="inps">
                    <input id="user_password" name="user_password" class="form-control" type="password"
                           placeholder="6-20位由数字和字母组成" autocomplete="off" value="123123">
                </div>
            </div>
            <div class="form-group">
                <label for="user_password_confirm">确认密码</label>
                <div class="inps">
                    <input id="user_password_confirm" name="user_password_confirm" class="form-control" type="password"
                           placeholder="请再次确认您的密码" autocomplete="off" value="123123">
                </div>
            </div>
            <div class="form-group">
                <label for="user_name">我的姓名</label>
                <div class="inps">
                    <input id="user_name" name="user_name" class="form-control" type="text"
                           placeholder="请输入您的姓名" autocomplete="off" value="AKITO">
                </div>
            </div>
            <div class="form-group">
                <label>我的性别&nbsp</label>
                <div class="inps">
                    <input id="user_man" name="user_sex" class="radio-control" type="radio" value="0" checked>&nbsp男
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <input id="user_woman" name="user_sex" class="radio-control" type="radio" value="1">&nbsp女
                </div>
            </div>
            <div class="form-group">
                <label for="user_work">工作单位</label>
                <div class="inps">
                    <input id="user_work" name="user_work" class="form-control" type="text"
                           placeholder="请输入您的工作单位" autocomplete="off" value="ISCAS">
                </div>
            </div>
            <div class="form-group">
                <label for="user_tel">联系方式</label>
                <div class="inps">
                    <input id="user_tel" name="user_tel" class="form-control" type="number"
                           placeholder="请输入您的手机号码" autocomplete="off" value="18710023223">
                </div>
            </div>
            <br><br>
            <button id="submit" type="submit" name="submit" class="btn-login font18" value="register">
                立即注册
            </button>
        </form>
    </div>
</body>
</html>