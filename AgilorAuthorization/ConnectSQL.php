<?php
/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/3/1
 * Time: 9:54
 */
    require_once 'common.php';


    class connectSQL
    {
        public $conn;
        public $host = "localhost";
        public $userName = "root";
        public $passWord = "174509853";
        public $dbName = "agilortest";

        public function __construct() {
            $xmldoc = new DOMDocument();

            if ($xmldoc->load("DBServer.xml")) {
                $this->host = getNodeVal($xmldoc, "host");
                $this->userName = getNodeVal($xmldoc, "username");
                $this->passWord = getNodeVal($xmldoc, "password");
                $this->dbName = getNodeVal($xmldoc, "dbname");
            }
            //连接
            $this->conn = new mysqli($this->host, $this->userName, $this->passWord);
            if (!$this->conn) {
                die("连接失败".mysqli_error($this->conn)) ;
            }
            //设置访问数据库的编码
            mysqli_query($this->conn, "set names utf8") or die(mysqli_error($this->conn));
            //设置要访问的数据库名
            mysqli_select_db($this->conn, $this->dbName);
        }
        //执行dql语句
        public function execute_dql($sql) {
            $result = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
            return $result;
        }
        //执行dql语句，返回数组
        public function execute_dql_returnArr($sql) {
            $arr = array();
            $result = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
            while ($row = mysqli_fetch_assoc($result)){
                $arr[] = $row;
            }
            mysqli_free_result($result);
            return $arr;
        }
        //执行dml语句
        public function execute_dml($sql) {
            $b = mysqli_query($this->conn, $sql);
            if($b) {
                return 0;//执行不正常
            }
            else {
                if (mysqli_affected_rows($this->conn)>0) {
                    return 1;//正常
                }
                else {
                    return 2;//影响行数为0
                }
            }
        }
        //关闭连接
        public function close_connect(){
            if(!empty($this->conn)) {
                mysqli_close($this->conn);
            }
        }

        public function getIp() {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                return $_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            elseif (!empty($_SERVER['REMOTE_ADDR'])) {
                return $_SERVER['REMOTE_ADDR'];
            }
            else {
                return "未知IP";
            }
        }

    }