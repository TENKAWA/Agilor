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
    <title>亲爱的用户，您好</title>
    <link href="GuestPage.css" rel="stylesheet" type="text/css">
    <link href="FontSize.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="iscas" class="font24">安 捷 （Agilor） 实 时 数 据 库 系 统</div>
    <div id="banner"></div>
    <div id="main">
        <div class="pull-right">
            <span class="font15">
                亲爱的
                <label class="link-green">
                    <?php
                        session_start();
                        if(isset($_SESSION['email'])) {
                            echo $_SESSION["user"]['email'];
                        }
                        else {
                            header("location:LogIn.php");
                        }
                    ?>
                </label>
                ，您好！&nbsp
                <a href="EditPassword.php" class="link_blue">更改密码</a>&nbsp|
                <a href="LogOutProcess.php?action=logout" class="link_blue" type="submit">注销</a>
            </span>
        </div>
        <br><br><br>
        <form method="post" action="GuestPageProcess.php">
            <label class="font16 link_blue" for="user_key">请输入您的Agilor授权码：</label>
            <input id="user_key" name="user_key" class="user-control " type="text" autocomplete="off" value="<?php echo $_SESSION['user']['userKey'] ?>">
            <br><br>
            <button type="submit" id="btn_trial" name="btn_trial" class="btn-getKey btn-blue" value="trial" >
                获取试用KEY
            </button><br><br>
            <textarea id="trail_key" name="trail_key" class="textarea-control" readonly="readonly"><?php
                    require_once 'ConnectSQL.php';
                    $connectSQL = new connectSQL();
                    $email = $_SESSION["email"];
                    $sql = "select trialKey, trialDate from user where email = '$email'";
                    $result = $connectSQL->execute_dql($sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        $_SESSION["isTrial"] = $row;
                    }
                    if($_SESSION["isTrial"]['trialKey'] != "" && $_SESSION["isTrial"]['trialDate'] != "") {
                        echo "试用版：".trim($_SESSION["isTrial"]['trialKey'])."\r\n";
                        echo "获取时间：".$_SESSION["isTrial"]['trialDate'];
                    }
                    else if(isset($_SESSION["code"])) {
                        echo $_SESSION["trialKey"];
                    }
                    else {
                        echo " ";
                    }
                ?>
            </textarea>
            <br><br>
            <button type="submit" id="btn_regged" name="btn_regged" class="btn-getKey btn-green" value="regged">
                获取付费KEY
            </button><br><br>
            <textarea id="regged_key" name="regged_key" class="textarea-control" readonly="readonly"><?php
                    require_once 'ConnectSQL.php';
                    $connectSQL = new connectSQL();
                    $email = $_SESSION["email"];
                    $sql = "select authorization, trialKey, trialDate from user where email = '$email'";
                    $result = $connectSQL->execute_dql($sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        $_SESSION["isRegged"] = $row;
                    }
                    if($_SESSION["isRegged"]['authorization'] == 0) {
                        echo "请致电010-62661561进行咨询！";
                    }
                    else {
                        echo " ";
                    }
                ?>
            </textarea>
        </form>
    </div>
</body>
</html>