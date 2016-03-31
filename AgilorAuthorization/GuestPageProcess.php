<?php
/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/3/9
 * Time: 14:38
 */
    require_once 'ConnectSQL.php';
    require_once 'common.php';

    session_start();
    //接收 客户信息和授权码
    $userKey = trim($_POST["user_key"]);//
    $email = $_SESSION["user"]['email'];
    if (empty($userKey)) {
        echo "<script>alert('请输入授权码！'); history.go(-1);</script>";
        exit();
    }
    //判断授权码长度是否合法
    if (strlen($userKey) != strlen("1D3D5-0F3-E40A0FD-994D-9B7D0F-V42MI")) {
        echo "<script>alert('授权码不正确！'); history.go(-1);</script>";
        exit();
    }

    if(isset($_POST["btn_trial"]) && $_POST["btn_trial"] == "trial") {
        $connectSQL = new connectSQL();
        if($_SESSION["isTrial"]['trialKey'] == null || $_SESSION["isTrial"]['trialDate'] == null) {
            $code="0";//初始化
            $port=2718;
            $ip="11.0.0.103";
            //从XML配置文件中读取IP和Port
            $xmldoc=new DOMDocument();
            if( $xmldoc->load("DBServer.xml"))
            {
                $ip=getNodeVal($xmldoc,"ip");
                $port=getNodeVal($xmldoc,"port");
            }
            //确保在连接客户端时不会超时
            set_time_limit(0);
            /*
            +-------------------------------
            *    @socket连接整个过程
            +-------------------------------
            *    @socket_create
            *    @socket_connect
            *    @socket_write
            *    @socket_read
            *    @socket_close
            +--------------------------------
            */
            //建立socket
            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            if ($socket == false) {
                echo "socket_create() failed: reason: ".socket_strerror(socket_last_error())."\n";
            }
            //建立连接
            $result = socket_connect($socket, $ip, $port);
            if ($result == 0) {
                socket_close($socket);
                echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error()) . "\n";
                return ;
            }
            //创建发送字符串
            $in = "\3".$userKey."\r\n";//正式版为1，试用版为3
            $out = '';
            if(!socket_write($socket, $in, strlen($in))) {
                echo "socket_write() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
            }
            if($out = socket_read($socket, 35)) {
                if(strlen($out)==35)
                {
                    $s1=substr($out,0,1);//
                    $s2=substr($out,1,1);//
                    $s3=substr($out,2);//序列号
                    $s4 = 1; //标记
                    if(ord($s1)==4)
                    {
                        if(ord($s2)==0)
                        {
                            $code=$s3;
                            //date_default_timezone_set('Etc/GMT-8');//PHP默认的不是中国的时区，是格林威治时间。所以设置一下时区
                            $trailDate = date('Y-m-d H:i:s');
                            $sqlUpdate = "update user set userKey = '$userKey', trialKey = '$code', trialDate = '$trailDate', trial = '$s4' WHERE email = '$email'";
                            if($resUpdate = $connectSQL->execute_dql($sqlUpdate)) {
                                $_SESSION["trialKey"] = $code;
                                $_SESSION['user']['userKey'] = $userKey;
                                header("location:GuestPage.php");
                            }
                            else {
                                echo "接收内容有问题";
                            }
                        }
                        else {
                            echo "数据库版本过旧";
                        }
                    }
                    else {
                        echo "接收内容长度有误";
                    }
                }
                else
                {
                    echo "接收内容出错";
                }
                //echo "关闭SOCKET...\n";
                socket_close($socket);
            }
        }
        else {
            echo "<script>alert('您已获取过试用版！'); history.go(-1);</script>";
        }
    }

    if(isset($_POST["btn_regged"]) && $_POST["btn_regged"] == "regged") {
        header("location:GuestPage.php");
    }

