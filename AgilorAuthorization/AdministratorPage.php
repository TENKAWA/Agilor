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
    <title>管理员，您好</title>
    <link href="AdministratorPage.css" rel="stylesheet" type="text/css">
    <link href="FontSize.css" rel="stylesheet" type="text/css">
    <script src="jquery-1.7.2.min.js" type="text/javascript"></script>
    <script src="AdministratorPage.js" type="text/javascript"></script>

<body>
    <div id="iscas" class="font24">安 捷 （Agilor） 实 时 数 据 库 系 统</div>
    <div id="banner"></div>
    <?php
        require_once 'ConnectSQL.php';
        session_start();
        if(!isset($_SESSION['isAdmin'])) {
            header("location:LogIn.php");
        }
        else {
            $countAll = 0;
            $countTrial = 0;
            $countRegged = 0;
            $connectSQL = new connectSQL();
            $sql = "select * from user";
            $result = $connectSQL->execute_dql($sql);//执行SQL语句
            $users = array();
            while($rows = mysqli_fetch_array($result)) {
                $users[] = $rows;
                if($rows["trial"] == 1) {
                    $countTrial++;
                }
                if($rows["authorization"] == 1) {
                    $countRegged++;
                }
                $countAll++;
            }
        }
    ?>
    <div id="main">
        <form method="post" action="SearchUserServer.php">
            <div >
                <button type="submit" id="search" name="search" class="btn-search " value="search">查找</button>
                <input id="user_search" name="user_search" class="form-control pull-left" type="email"
                       placeholder="请输入需要查看的邮箱账号" autocomplete="off">
                <div class="font16 pull-right">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    管理员，您好！&nbsp
                    <a href="LogOutProcess.php?action=logout" class="link_green" type="submit">注销</a>
                </div>
                <div class="font16 pull-right link_blue">
                    <?php echo $countRegged-1; ?>&nbsp&nbsp&nbsp
                </div>
                <div class="font16 pull-right">
                    当前付费人数：
                </div>
                <div class="font16 pull-right link_blue">
                    <?php echo $countTrial-1; ?>&nbsp&nbsp&nbsp
                </div>
                <div class="font16 pull-right">
                    当前试用人数：
                </div>
                <div class="font16 pull-right link_blue">
                    <?php echo $countAll-1; ?>&nbsp&nbsp&nbsp
                </div>
                <div class="font16 pull-right">
                    当前注册人数：
                </div>
        </form><br>
        <br>
        <table id="users" class="data-table"></table>
        <script type="text/javascript">
            $(function(){
                var data = [];
                var arr = [];
                arr = <?=json_encode($users)?>;
                var length = "<?=$countAll?>";

                for(var i=0;i<length;i++) {
                    data[i] = {id:i+1, email:String(arr[i]["email"]), name:String(arr[i]["name"]), trailKey:String(arr[i]["trialKey"]), reggedKey:String(arr[i]["reggedKey"])};
                }
                var userOptions = {
                    "id":"users",                                //必须 表格id
                    "head":["序号","用户名","姓名","试用Key","付费Key"],   //必须 thead表头
                    "body":data,                                    //必须 tbody 后台返回的数据展示
                    "foot":true,                                    // true/false  是否显示tfoot --- 默认false
                    "displayNum": 10,                               //必须   默认 10  每页显示行数
                    "groupDataNum":10,                             //可选    默认 10  组数
                    "clickEventCallBack":function(data_index,tr_index){ //可选 给tbody tr绑定事件回调
                        console.log("tr_index: "+tr_index+" data_index: "+data_index);
                    },
                    sort:true,                                    // 点击表头是否排序 true/false  --- 默认false
                    search:true,                                  // 默认为false 没有搜索
                    lang:{
                        gopageButtonSearchText:"搜索"
                    }
                };
                var cs = new KingTable(null,userOptions);
            })
        </script>
    </div>
</body>
</html>