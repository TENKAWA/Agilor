<?php
/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/3/3
 * Time: 23:40
 */
    require_once 'LogInServer.php';

    if(isset($_POST["login"]) && $_POST["login"] == "login") {
        $email = trim($_POST["user_email"]);//用户名
        $password = trim($_POST["user_password"]);//密码

        //session初始化
        session_start();

        //声明一个LogInServer实例
        $LogInServer=new LogInServer();
        //调用【检查用户名、密码是否合法】方法
        if ($LogInServer->checkUser($email, $password)) {
            //将【用户名】设置为【登录用户】
            $_SESSION['email'] = $email;
//            if($keep==0) {
//                if(empty($_COOKIE['UserName'])) {
//                    setcookie("UserName",$email,time()-3600);
//                }
//            }
//            else {
            setcookie("email",$email,time()+7*2*24*3600);
//            }
            header ( "location:GuestPage.php" );
            exit;
        }
        else if($LogInServer->checkAdmin($email,$password)) {
            //标记为管理员
            $_SESSION['isAdmin'] = 1;
            //根据用户的选择，保存或删除登录状态cookie信息
//            if($keep==0) {
//                if(!empty($_COOKIE['UserName'])) {
//                    setcookie("UserName",$email,time()-3600);
//                }
//                if(!empty($_COOKIE['Admin'])) {
//                    setcookie("Admin",$_SESSION['IsAdmin'],time()-3600);
//                }
//            }
//            else {
            setcookie("email",$email,time()+7*2*24*3600);
            //setcookie("Admin",$_SESSION['IsAdmin'],time()+7*2*24*3600);
//            }
            header ( "location:AdministratorPage.php" );
            exit;
        }
        else {
            echo "<script>alert('用户名或密码错误！'); history.go(-1);</script>";
            exit;
        }


    }


