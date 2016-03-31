<?php
/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/3/4
 * Time: 0:04
 */
    require_once 'ConnectSQL.php';

    class LogInServer {
        public function checkUser($email, $password) {
            //查询语句
            $sql = "select * from user where email = '$email' and permission='0'";
            //声明一个sqlHelper的实例
            $connectSQL = new connectSQL();
            //调用查询方法，返回结果
            $ip = $connectSQL->getIp();
            $result = $connectSQL->execute_dql($sql);
            if($row = mysqli_fetch_assoc($result)) {
                if($password == $row["password"]) {
                    $sqlUpdate = "update user set ip = '$ip' WHERE email = '$email'";
                    $res = $connectSQL->execute_dql($sqlUpdate);
                    $_SESSION["user"] = &$row;
                    return true;
                }
            }
            //释放资源
            mysqli_free_result($result);
            //关闭连接
            $connectSQL->close_connect();
            return false;
        }

        public function checkAdmin($email, $password) {
            //查询语句
            $sql = "select * from user where email = '$email' and permission='1' ";
            //声明一个sqlHelper的实例
            $connectSQL = new connectSQL();
            //调用查询方法，返回结果
            $result = $connectSQL->execute_dql($sql);
            if($row = mysqli_fetch_assoc($result)) {
                if($password == $row["password"]) {
                    $_SESSION["admin"] = &$row;
                    return true;
                }
            }
            //释放资源
            mysqli_free_result($result);
            //关闭连接
            $connectSQL->close_connect();
            return false;
        }
    }
