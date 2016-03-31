<?php
/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/3/8
 * Time: 16:19
 */
    require_once 'ConnectSQL.php';
    session_start();

    if(isset($_POST["submit"]) && $_POST["submit"] == "修改") {
        $old_password = $_POST["old_password"];
        $new_password = $_POST["new_password"];
        $email = $_SESSION["email"];

        $connectSQL = new connectSQL();
        $sql = "select email, password from user where password = '$old_password' AND email = '$email'"; //SQL语句
        $result = $connectSQL->execute_dql($sql);    //执行SQL语句
        $num = mysqli_num_rows($result); //统计执行结果影响的行数
        if($num) {
            $sqlUpdate = "update user set password = '$new_password' WHERE email = '$email'";
            $result = $connectSQL->execute_dql($sqlUpdate);
            $affect = mysqli_affected_rows($connectSQL->conn);
            if($affect) {
                echo "<script>alert('修改成功！'); history.go(-1);</script>";
            }
            else {
                echo "<script>alert('系统繁忙，请稍后再试！'); history.go(-1);</script>";
            }
        }
        else {
            echo "<script>alert('旧密码错误！'); history.go(-1);</script>";
        }
    }
    else {
        echo "<script>alert('系统繁忙，请稍后再试！'); history.go(-1);</script>";
    }