<?php
/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/3/14
 * Time: 16:56
 */
    require_once 'ConnectSQL.php';

    if(isset($_POST["authorize"]) && $_POST["authorize"] == "authorize") {
        session_start();
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