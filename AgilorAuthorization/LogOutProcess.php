<?php
/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/3/9
 * Time: 14:39
 */
    require_once "common.php";
//    checkUserValidate();
    session_start();
    session_unset();
    session_destroy();

    foreach($_COOKIE as $key=>$val){
        setcookie($key,"",time()-100);
    }
    header ( "location:Logout.php" );