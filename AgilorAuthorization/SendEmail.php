<!--/**
 * Created by PhpStorm.
 * User: AKITO
 * Date: 2016/4/5
 * Time: 10:52
 */-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <title>注册成功！</title>
    <link href="SendEmail.css" rel="stylesheet" type="text/css">
    <link href="FontSize.css" rel="stylesheet" type="text/css">
    <script src="jquery-1.7.2.min.js" type="text/javascript"></script>
</head>
<body>

    <div id="iscas" class="font24">安 捷 （Agilor） 实 时 数 据 库 系 统</div>
    <div id="banner"></div>
    <div id="main" align="center">
        <br>
        <h2  class="font24 link_blue">激活邮件已发送，请到邮箱内查看！</h2><br>
        <form name="btnForm">
            <input class="btn-send btn-green" type="button" value="重新发送注册邮件" name="email" id="email" onclick="showtime(60)">
        </form>
    </div>
    <script type="text/javascript">
        function showtime(t) {
            document.btnForm.email.disabled = true;
            for(var i=1; i<=t; i++) {
                window.setTimeout("update_p(" + i + ","+t+")", i * 1000);
            }
            $.ajax({
                type: "GET",
                url: "RegisterProcess.php",
                data: {email:"email"},
                success: function(msg){
                    alert(msg);

                }
            });
        }

        function update_p(num,t) {
            if(num == t) {
                document.btnForm.email.value =" 重新发送注册邮件 ";
                document.btnForm.email.disabled = false;
            }
            else {
                printnr = t-num;
                document.btnForm.email.value = " (" + printnr +")秒后重新发送";
            }
        }

    </script>
</body>
</html>