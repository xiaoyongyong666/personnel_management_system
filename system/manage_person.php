<?php
require 'include/session.php';
require 'include/globle.inc.php';
require IN . 'Libs/Class/page.class.php'; 
$x_m=$_GET['act'];
$x_keys=$_POST['keyword'];
if($x_m=='search' and $x_keys!=""){
	$xy_sql="select * from book where b_title like '%$x_keys%' order by id desc,c_date desc";
}else{
	$xy_sql="select * from book order by id desc,c_date desc";
}
$result=$db->query($xy_sql); 


//管理员权限控制
    $sql = "select * from `admin_user` where u_name='".$_SESSION['m_name']."'";  
	
    $result =$db->query($sql);//查询pid的子类的分类 
    $userinfos = mysql_fetch_array($result);//变量容器

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>信息管理</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="Js/check.js"></script>
<script language="javascript">
function ask(msg) {
	if( msg=='' ) {
		msg='警告：删除后将不可恢复，可能造成意想不到后果？';
	}
	if (confirm(msg)) {
		return true;
	} else {
		return false;
	}
}
</script>
<?php
	if ($userinfos['type']!='9'){
	echo ("
<style>
#admindel{display: none;}
</style>
");}?>
</head>
<body style="overflow-x:hidden;">
<div id="loader" >页面加载中...</div>
<div id="result" class="result none"></div>
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_person.php">人员管理</a>| <a href="add_person.php">添加人员</a>
    </ul>
  </div>
  <script>
	//|str_replace=.'/index.php','',###
	var onurl ='manage_book.php';
	jQuery(document).ready(function(){
		$('#nav ul a ').each(function(i){
		if($('#nav ul a').length>1){
			var thisurl= $(this).attr('href');
			if(onurl.indexOf(thisurl) == 0 ) $(this).addClass('on').siblings().removeClass('on');
		}else{
			$('#nav ul').hide();
		}
		});
		if($('#nav ul a ').hasClass('on')==false){
		$('#nav ul a ').eq(0).addClass('on');
		}
	});
	</script>
  <form name="addform" id="addform" action="?del=checkbox" method="post">
   <?php 
   $total=$db->num_rows($result);
   $page=new page_link($total,30);
   $xy_sql.=" limit $page->firstcount,$page->displaypg";
   $result=$db->query($xy_sql);
   ?>
    <div class="table-list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="40">ID</th>
            <th>姓名</th>
            <th width="180">职位</th>
            <th width="180">电话</th>
            <th width="180">邮箱</th>
			<th width="180">创建日期</th>
			<th width="180">管理操作</th>
          </tr>
        </thead>
        <tbody>
		  <?php echo get_list();?>		  
        </tbody>
      </table>
    </div>
  </form>
</div>
<div id="pages" class="page">
<?php echo $page->show_link();?>
</div>
</body>
</html>
<?php
function getcategoryname($catid){
	global $db;
	$sql="select title from book_class where id=$catid";
	$result =$db->query($sql);
	if($result && mysql_affected_rows()){
		$row =$db->get_one($sql,MYSQL_ASSOC);
		echo "[<font color='green'>".$row['title']."</font>]";
	}else{
		return '';
	}
}

function getnums($catid){
	global $db;
	$sql="select id from book_reply where b_id=$catid";
	$result =$db->query($sql);
	if($result && mysql_affected_rows()){
		echo "[<font color='#FF0000'>".$db->num_rows($result)."</font>]";
	}else{
		echo "[<font color='#FF0000'>0</font>]";
	}
}

if($_GET['del']=='checkbox'){
	$ids=$_POST['id'];
	if(empty($ids)){
		echo"<script>alert('必须选择一个ID,才可以操作!');history.back(-1);</script>";  
        exit; 
	}else{
		$cz_lx=$_POST['lx'];
		if($cz_lx==''){
			echo"<script>alert('必须选择一个有效操作!');history.back(-1);</script>";  
			exit;
		}
		$id=implode(",",$ids);
		switch($cz_lx){
			case 1:
			$sql="UPDATE book set is_view=1 where id in ($id)";
			break;
			case 2:
			$sql="UPDATE book set is_view=0 where id in ($id)";
			break;
			case 3:
			$sql="DELETE FROM book where id in ($id)";
			break;
		}
		$db->query($sql);
		echo "<script>alert('恭喜你，操作成功！');window.location.href='manage_book.php';</script>";  
	}
}
$db->close();
?>

<?php
//返回字符串（正在使用）
function get_list() { 
    global $db;
    $sql = "select * from `member` where id !='0' order by id asc";  
	//隐藏ID为0的账号
    $result =$db->query($sql);//查询pid的子类的分类 
    if($result && mysql_affected_rows()){//如果有子类 
        while ($row = mysql_fetch_array($result)) { //循环记录集
		    $str .="<tr>";
      
    $rq_time = date("Y-m-d ", $row['c_date']);
	$str .="<td align='center'>".$row['id']."</td>";
	$str .="<td align='center'>".$row['name']."</td>";
	$str .="<td align='center'>".$row['position']."</td>";
	$str .="<td align='center'>".$row['b_tel']."</td>";
	$str .="<td align='center'>".$row['b_mail']."</td>";
	$str .="<td align='center'>".$rq_time."</td>";
    $str .="<td align='center'><a href='edit_person.php?id=".$row['id']."' class='a_btn'>修改</a> | <a href=\"javascript:if(ask('警告：删除后将不可恢复，可能造成意想不到后果？')) location.href='del_person.php?id=".$row['id']."';\" onClick=\"delcfm();\" class='a_btn'>删除</a></td>";
		$str .="</tr>";  
        } 
    } 
    return $str; 
} 
?>