<?php
/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/2/29
 * Time: 16:35
 */
//    //验证用户是否合法
//    function  checkUserValidate() {
//        session_start();
//        if (empty($_SESSION['LoginUser'])) {
//            header("location:Login.php?err=2");
//        }
//    }
    //获取节点下某个标签的值
    function getNodeVal($MyNode,$tagName) {
        return $MyNode->getElementsByTagName($tagName)->item(0)->nodeValue;
    }
    //获取节点下某个节点
    function getNode($MyNode,$tagName) {
        return $MyNode->getElementsByTagName($tagName)->item(0);
    }

