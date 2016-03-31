<!--/**
* Created by PhpStorm.
* User: AKITO
* Date: 2016/1/27
* Time: 15:12
*/-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <meta http-equiv="refresh" content="3;LogIn.php">
    <title>注销成功！</title>
    <link href="LogOut.css" rel="stylesheet" type="text/css">
    <link href="FontSize.css" rel="stylesheet" type="text/css">
</head>
<body>
<script type="text/javascript">
    function countDown(secs,surl) {
        jumpTo.innerText = secs;
        if(--secs > 0){
            setTimeout("countDown("+secs+",'"+surl+"')",1000);
        }
        else{
            location.href = surl;
        }
    }
</script>
<div id="iscas" class="font24">安 捷 （Agilor） 实 时 数 据 库 系 统</div>
<div id="banner"></div>
<div id="main" align="center">
    <br>
    <h2  class="font36">
        <span class=" font-thin span-blue">注&nbsp销&nbsp成&nbsp功&nbsp!</span><br>
        <span class=" font-thin span-blue font18">（</span>
        <span id="jumpTo" class=" font-thin span-blue font18">3</span>
        <span class=" font-thin span-blue font18">秒后跳转到登陆界面）</span>
</div>
<script type="text/javascript">
    countDown(3,'LogIn.php');
</script>
</body>
</html>