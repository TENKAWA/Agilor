<?php
/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/3/1
 * Time: 9:53
 */
    require_once 'ConnectSQL.php';

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

        $sql = "select email from user where email = '$userEmail'"; //SQL语句
        $result = $connectSQL->execute_dql($sql);    //执行SQL语句
        $num = mysqli_num_rows($result); //统计执行结果影响的行数
        if($num)    //如果已经存在该用户
        {
            echo "<script>alert('用户名已存在'); history.go(-1);</script>";
        }
        else    //不存在当前注册用户名称
        {
            $sql_insert = "insert into user (email, password, name, sex, work, telephone, permission, authorization, registerDate, ip, trial)
                          values('$userEmail','$userPassword','$userName'
                          , '$userSex', '$userWork', '$userTel', '$permission', '$authorization', '$regDate', '$ip', '$trial')";
            $res_insert = $connectSQL->execute_dql($sql_insert);;
            //$num_insert = mysql_num_rows($res_insert);
            if($res_insert)
            {
                header("location:RegisterSuccess.php");
            }
            else
            {
                echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
            }
        }

    }
    else {
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";
    }
