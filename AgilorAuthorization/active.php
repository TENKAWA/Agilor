<?php
/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/4/1
 * Time: 10:56
 */
    include_once("ConnectSQL.php");

    $verify = stripslashes(trim($_GET['verify']));
    $nowTime = time();
    $connectSQL = new connectSQL();

    $sql = "select email, activeTime from user where active = '0' AND token = '$verify'";
    $result = $connectSQL->execute_dql($sql);
    $row = mysqli_fetch_array($result);
    if($row) {
        if($nowTime > $row['activeTime']) { //30min
            echo "<script>alert('您的激活有效期已过，请致电联系管理员！'); history.go(-1);</script>";
        }
        else {
            $email = $row['email'];
            $sql = "update user set active = '1' where email = '$email'";
            $link = $connectSQL->execute_dql($sql);
            $affect = mysqli_affected_rows($connectSQL->conn);
            if($affect) {
                $sql = "update user set token = '' where email = '$email'";
                $link = $connectSQL->execute_dql($sql);
                $affect = mysqli_affected_rows($connectSQL->conn);
                echo "<script>window.location.href = \"RegisterSuccess.php\";</script>";
            }
            else {
                die(0);
            }
        }
    }
    else    {
        $msg = 'error.';
        echo $msg;
    }
