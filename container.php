<?php
!defined('BOOK') && exit('FORBIDDEN');
?>
<div class="container">
    <?php echo person_list();?>
</div>

<?php
    function person_list() {
        global $db;
        $query = 'SELECT * FROM member';
        $result = mysql_query($query) or die('数据库错误,错误原因: ' + mysql_error() + ' ,请联系 程序管理员 或 程序制作者');

        //如果有数据为真
        while (!!$row = mysql_fetch_array($result)) {
               if ($row == false) {
                echo "666";
                // echo "<div class='person_head' style='text-align:center'>";
                // echo "<h1><i class='glyphicon glyphicon-exclamation-sign'></i>  暂无人员!</h1>";
                // echo "</div>";
               }
               else if ($row == true){
                echo "<table width='100%' cellspacing='0'>";
                echo "<thead>";
                echo "<caption width='100%'  style='text-align:center;font-weight:bold;'><h3>人员列表</h3><hr></caption>";
                echo "<tr>";
                echo "<th width='180' style='text-align:center;'>ID</th><th width='180' style='text-align:center;'>姓名</th><th width='180' style='text-align:center;'>职位</th><th width='180' style='text-align:center;'>电话</th><th width='180' style='text-align:center;'>邮箱</th><th width='180' style='text-align:center;'>创建日期</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                echo"<tr><td width='180' style='text-align:center;'>".$row["id"]."</td><td width='180' style='text-align:center;'>".$row["name"]."</td><td width='180' style='text-align:center;'>".$row["position"]."</td><td width='180' style='text-align:center;'>".$row["b_tel"]."</td><td width='180' style='text-align:center;'>".$row["b_mail"]."</td><td width='180' style='text-align:center;'>".date("Y-m-d",$row["c_date"])."</td></tr>";
                echo "</tbody>";
                echo "</table>";
                
               }
        }
    }
?>