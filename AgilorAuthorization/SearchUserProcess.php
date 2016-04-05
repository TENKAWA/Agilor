<?php
/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/3/14
 * Time: 16:56
 */
    require_once 'ConnectSQL.php';
    session_start();

    if(isset($_POST["authorize"]) && $_POST["authorize"] == "authorize") {
        $connectSQL = new connectSQL();
        $email = $_SESSION['oneUser']['email'];
        $userAuthorization = $_POST["user_authorization"];
        if($userAuthorization == 1) {
            $sqlUpdate = "update user set authorization = '$userAuthorization' WHERE email = '$email'";
            $result = $connectSQL->execute_dql($sqlUpdate);
            $affect = mysqli_affected_rows($connectSQL->conn);
            if($affect) {
                echo "<script>alert('成为付费用户！'); history.go(-1);</script>";
            }
            else {
                echo "<script>alert('无修改！'); history.go(-1);</script>";
            }
        }
        else {
            $sqlUpdate = "update user set authorization = '$userAuthorization' WHERE email = '$email'";
            $result = $connectSQL->execute_dql($sqlUpdate);
            $affect = mysqli_affected_rows($connectSQL->conn);
            if($affect) {
                echo "<script>alert('设置为免费用户！'); history.go(-1);</script>";
            }
            else {
                echo "<script>alert('无修改！'); history.go(-1);</script>";
            }
        }
    }
    else if(isset($_POST["active"]) && $_POST["active"] == "active") {
        $connectSQL = new connectSQL();
        $email = $_SESSION['oneUser']['email'];
        $userActive = $_POST["user_active"];
        if($userActive == 1) {
            $sqlUpdate = "update user set active = '$userActive' WHERE email = '$email'";
            $result = $connectSQL->execute_dql($sqlUpdate);
            $affect = mysqli_affected_rows($connectSQL->conn);
            if($affect) {
                echo "<script>alert('用户已激活！'); history.go(-1);</script>";
            }
            else {
                echo "<script>alert('无修改！'); history.go(-1);</script>";
            }
        }
        else {
            $sqlUpdate = "update user set active = '$userActive' WHERE email = '$email'";
            $result = $connectSQL->execute_dql($sqlUpdate);
            $affect = mysqli_affected_rows($connectSQL->conn);
            if($affect) {
                echo "<script>alert('设置为未激活用户！'); history.go(-1);</script>";
            }
            else {
                echo "<script>alert('无修改！'); history.go(-1);</script>";
            }
        }
    }