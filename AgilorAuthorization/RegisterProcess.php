<?php
/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/3/1
 * Time: 9:53
 */
    require_once 'ConnectSQL.php';
    session_start();

    if(isset($_POST["submit"]) && $_POST["submit"] == "register") {
        $connectSQL = new connectSQL();

        $userEmail = $_POST["user_email"];
        $userPassword = $_POST["user_password"];
        $userPasswordConfirm = $_POST["user_password_confirm"];
        $userName = $_POST["user_name"];
        $userSex = $_POST["user_sex"];
        $userWork = $_POST["user_work"];
        $userTel = $_POST["user_tel"];
        $permission = 0;
        $authorization = 0;
        $regDate = date('Y-m-d H:i:s');
        $ip = $connectSQL->getIp();
        $trial = 0;
        $active = 0;
        $regTime = time();
        $token = md5($userEmail.$userPassword.$regTime);
        $tokenTime = time()+60*60*24; //过期时间为24小时后
        $_SESSION["emailTo"] = $userEmail;
        $_SESSION["token"] = $token;
        $_SESSION["userName"] = $userName;

        $sql = "select email from user where email = '$userEmail'"; //SQL语句
        $result = $connectSQL->execute_dql($sql);    //执行SQL语句
        $num = mysqli_num_rows($result); //统计执行结果影响的行数
        if($num)    //如果已经存在该用户
        {
            echo "<script>alert('用户名已存在'); history.go(-1);</script>";
        }
        else    //不存在当前注册用户名称
        {
            $sql_insert = "insert into user (email, password, name, sex, work, telephone, permission, authorization, registerDate, ip, trial, active, activeTime, token)
                          values('$userEmail','$userPassword','$userName'
                          , '$userSex', '$userWork', '$userTel', '$permission', '$authorization', '$regDate', '$ip', '$trial', '$active', '$tokenTime', '$token')";
            $res_insert = $connectSQL->execute_dql($sql_insert);;
            //$num_insert = mysql_num_rows($res_insert);
            if($res_insert)
            {
                include_once("smtp.class.php");
                $smtpServer = "smtp.163.com"; //SMTP服务器
                $smtpServerPort = 25; //SMTP服务器端口
                $smtpUserMail = "tenkawa_akito@163.com"; //SMTP服务器的用户邮箱
                $smtpUser = "tenkawa_akito@163.com"; //SMTP服务器的用户帐号
                $smtpPassword = "akito19871012"; //SMTP服务器的用户密码
                $smtpHeader = "";

                $smtp = new Smtp($smtpServer, $smtpServerPort, true, $smtpUser, $smtpPassword); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
                $emailType = "HTML"; //信件类型，文本:text；网页：HTML
                $smtpEmailTo = $userEmail;
                $smtpEmailFrom = $smtpUserMail;
                $emailSubject = "用户帐号激活";
                $emailBody = "亲爱的" . $userName . "：<br>感谢您在我站注册了新帐号。<br>请点击链接激活您的帐号。<br/><a href='http://10.0.0.122/active.php?verify=" . $token . "' target='_blank'>http://10.0.0.122/active.php?verify=" . $token . "</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- Agilor团队 敬上</p>";
                $rs = $smtp->sendmail($smtpEmailTo, $smtpEmailFrom, $smtpHeader, $emailSubject, $emailBody, $emailType);
                if ($rs == 1) {
                    $msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';
                }
                else {
                    $msg = $rs;
                    echo $msg;
                }
                header("location:SendEmail.php");
            }
            else
            {
                echo "<script>alert('系统繁忙，请稍候！');</script>";
                header("location:SendEmail.php");
            }
        }

    }
    else if($_GET["email"] == "email") {
        $userEmail = $_SESSION["emailTo"];
        $token = $_SESSION["token"];
        $userName = $_SESSION["userName"];

        $connectSQL = new connectSQL();
        $sql = "select active from user where email = '$userEmail'";
        $result = $connectSQL->execute_dql($sql);    //执行SQL语句
        $row = mysqli_fetch_array($result);
        if($row["active" == 1]) {
            echo "账号已激活，请登录！";
        }
        else {
            include_once("smtp.class.php");
            $smtpServer = "smtp.163.com"; //SMTP服务器
            $smtpServerPort = 25; //SMTP服务器端口
            $smtpUserMail = "tenkawa_akito@163.com"; //SMTP服务器的用户邮箱
            $smtpUser = "tenkawa_akito@163.com"; //SMTP服务器的用户帐号
            $smtpPassword = "akito19871012"; //SMTP服务器的用户密码
            $smtpHeader = "";

            $smtp = new Smtp($smtpServer, $smtpServerPort, true, $smtpUser, $smtpPassword); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
            $emailType = "HTML"; //信件类型，文本:text；网页：HTML
            $smtpEmailTo = $userEmail;
            $smtpEmailFrom = $smtpUserMail;
            $emailSubject = "用户帐号激活";
            $emailBody = "亲爱的" . $userName . "：<br>感谢您在我站注册了新帐号。<br>请点击链接激活您的帐号。<br/><a href='http://10.0.0.122/active.php?verify=" . $token . "' target='_blank'>http://10.0.0.122/active.php?verify=" . $token . "</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- Agilor团队 敬上</p>";
            $rs = $smtp->sendmail($smtpEmailTo, $smtpEmailFrom, $smtpHeader, $emailSubject, $emailBody, $emailType);
            if ($rs == 1) {
                echo "邮件已发送，请到邮箱内查看！";
            }
            else {
                $msg = $rs;
                echo $msg;
            }
        }
    }
    else {
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";
    }
