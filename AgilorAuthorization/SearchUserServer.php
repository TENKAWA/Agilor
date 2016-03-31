<?php
/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/3/14
 * Time: 16:56
 */
    require_once 'ConnectSQL.php';

    if(isset($_POST["search"]) && $_POST["search"] == "search") {
        session_start();
        $connectSQL = new connectSQL();

        $oneUser = $_POST["user_search"];
        $sql = "select * from user where email = '$oneUser'";
        $result = $connectSQL->execute_dql($sql);
        if($row = mysqli_fetch_assoc($result)) {
            $_SESSION["oneUser"] = &$row;
            header("location:SearchUser.php");
        }
        else{
            echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
        }

    }

