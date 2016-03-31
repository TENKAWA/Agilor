<!--/**
* Created by PhpStorm.
* User: AKITO
* Date: 2016/3/11
* Time: 15:12
*/-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <title>查询用户</title>
    <link href="SearchUser.css" rel="stylesheet" type="text/css">
    <link href="FontSize.css" rel="stylesheet" type="text/css">
<body>
<div id="iscas" class="font24">安 捷 （Agilor） 实 时 数 据 库 系 统</div>
<div id="banner"></div>
<div id="main">
    <h2 id="tip_title">
        <span class="font18">
            这是
        </span>
        <span class="link_green font18">
            <?php
                session_start();
                if(isset($_SESSION['oneUser'])) {
                    echo $_SESSION['oneUser']['email'];
                }
                else {
                    header("location:LogIn.php");
                }
                ?>
        </span>
        <span class="font18">
            用户的详细信息
        </span>
        <button id="authorize" type="submit" class="btn-back font18 pull-right" onclick="skip()">
            返回
        </button>
    </h2><br>
    <form name="userForm" method="post" action="SearchUserProcess.php">
        <table>
            <tr>
                <td class="td-width100">&nbsp姓名：</td>
                <td class="td-width400">&nbsp
                    <?php
                        echo $_SESSION['oneUser']['name'];
                    ?>
                </td>
                <td class="td-width100">&nbsp性别：</td>
                <td class="td-width400">&nbsp
                    <?php
                        if($_SESSION['oneUser']['sex'] == 0) {
                            echo "男";
                        }
                        else {
                            echo "女";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="td-width100">&nbsp联系方式：</td>
                <td class="td-width400">&nbsp
                    <?php
                        echo $_SESSION['oneUser']['telephone'];
                    ?>
                </td>
                <td class="td-width100">&nbsp工作地点：</td>
                <td class="td-width400">&nbsp
                    <?php
                        echo $_SESSION['oneUser']['work'];
                    ?>
                </td>
            </tr>
            <tr>
                <td class="td-width100">&nbsp注册日期：</td>
                <td class="td-width400">&nbsp
                    <?php
                    echo $_SESSION['oneUser']['registerDate'];
                    ?>
                </td>
                <td class="td-width100">&nbsp上次登录<br>&nbspip：</td>
                <td class="td-width400">&nbsp
                    <?php
                    echo $_SESSION['oneUser']['ip'];
                    ?>
                </td>
            </tr>
            <tr>
                <td class="td-width100">&nbsp试用Key：</td>
                <td class="td-width400">&nbsp
                    <?php
                        echo $_SESSION['oneUser']['trialKey'];
                    ?>
                </td>
                <td class="td-width100">&nbsp获取试用<br>&nbspKey时间：</td>
                <td class="td-width400">&nbsp
                    <?php
                        echo $_SESSION['oneUser']['trialDate'];
                    ?>
                </td>
            </tr>
            <tr>
                <td class="td-width100">&nbsp付费Key：</td>
                <td class="td-width400">&nbsp
                    <?php
                        echo $_SESSION['oneUser']['reggedKey'];
                    ?>
                </td>
                <td class="td-width100">&nbsp获取付费<br>&nbspKey时间：</td>
                <td class="td-width400">&nbsp
                    <?php
                        echo $_SESSION['oneUser']['reggedDate'];
                    ?>
                </td>
            </tr>
            <tr>
                <td class="td-width100">&nbsp付费用户：</td>
                <td class="td-width400">&nbsp
                    <input id="user_man" name="user_authorization" class="radio-control" type="radio" value="1"<?php
                            require_once 'ConnectSQL.php';
                            $connectSQL = new connectSQL();
                            $email = $_SESSION['oneUser']['email'];
                            $sql = "select authorization from user where email = '$email'";
                            $result = $connectSQL->execute_dql($sql);
                            if($row = mysqli_fetch_assoc($result)) {
                                $_SESSION['oneUser']['authorization'] = $row['authorization'];
                            }
                            if($_SESSION['oneUser']['authorization'] == 1) {
                                echo 'checked';
                            }
                        ?>>是
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <input id="user_woman" name="user_authorization" class="radio-control" type="radio" value="0"
                        <?php if($_SESSION['oneUser']['authorization'] == 0){echo 'checked';} ?>>否
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <button id="authorize" type="submit" name="authorize" class="btn-change font18" value="authorize">
                        修改
                    </button>
                </td>
                <td class="td-width100">&nbsp授权码：</td>
                <td class="td-width400">&nbsp
                    <?php
                        echo $_SESSION['oneUser']['userKey'];
                    ?>
                </td>
            </tr>
        </table>
    </form>
    <script type="text/javascript">
        function skip() {
            window.location.href="AdministratorPage.php";
        }
    </script>
</div>
</body>
</html>