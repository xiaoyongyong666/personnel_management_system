<?php
require 'include/session.php';
require 'include/globle.inc.php';
if($_GET["act"]==ok){
	$e_name=strtolower(trim($_POST['rname']));
	$e_pos=strtolower(trim($_POST['position']));
	$e_tel=$_POST['b_tel'];
	$e_mail=trim($_POST['b_mail']);
	$e_qq=trim($_POST['b_qq']);

		$siteinfo = array(
	    'name'=>$e_name,
		'position'=>$e_pos,
		'b_tel'=>$e_tel,
        'b_mail'=>$e_mail,
        'b_qq'=>$e_qq
		);
		$db->update("member", $siteinfo);
		ok_info('manage_person.php',"修改成功！");
	
}
$sxid=$_GET["id"];
$e_rs=$db->get_one("select * from `member` where id=$sxid",MYSQL_ASSOC);

//管理员权限控制
    $sql = "select * from `admin_user` where u_name='".$_SESSION['m_name']."'";  
    $result =$db->query($sql);//查询pid的子类的分类 
    $userinfos = mysql_fetch_array($result);//变量容器

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>信息添加</title>
<script type="text/javascript" src="Js/jquery.min.js"></script>
<link href="style/style.css" type="text/css" rel="stylesheet" />
</head>
<body >
<div id="loader" >页面加载中...</div>
<div id="result" class="result none"></div>
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_person.php">人员管理</a> | <a href="add_personr.php">添加人员</a>
    </ul>
    <div class="clear"></div>
  </div>
<script language='javascript'>


/*必填选项输入验证*/
function checkmess() {
if (document.addform.name.value == '' ) {
window.alert('请输入姓名^_^');
document.addform.name.focus();
return false;}
if ( document.addform.position.value == '' ) {
window.alert('请输入职位！');
document.addform.position.focus();
return false;}
return true;
}


</script>
  <div id="msg"></div>
  <form name="addform" id="addform" action="?act=ok" method="post">
    <table cellpadding=0 cellspacing=0 class="table_form" width="100%">
      <tr>
        <td width="10%" >姓 名</td>
        <td width="90%" >
          <input type="text" class="input-text" name="rname"  id="rname"  size="55" value="<?php echo $e_rs['name'];?>" />
          </td>
      </tr>
	  <tr>
        <td width="10%" >职 位</td>
        <td width="90%" >
          <input type="text" class="input-text" name="position"  id="position"  size="55" value="<?php echo $e_rs['position'];?>" />
          </td>
      </tr>
      <tr>
        <td width="10%" >电 话</td>
        <td width="90%" >
        <input type="text" class="input-text" name="b_tel"  id="b_tel"  size="55" value="<?php echo $e_rs['b_tel'];?>" />
      </tr>
      <tr>
        <td width="10%" >邮 箱</td>
        <td width="90%" >
        <input type="text" class="input-text" name="b_mail"  id="b_mail"  size="55" value="<?php echo $e_rs['b_mail'];?>" />
      </tr>
      <tr>
        <td width="10%" >QQ</td>
        <td width="90%" >
        <input type="text" class="input-text" name="b_qq"  id="b_qq"  size="55" value="<?php echo $e_rs['b_qq'];?>" />
      </tr>
    </table>
    <div id="bootline"></div>
    <div id="btnbox" class="btn">
      <INPUT TYPE="submit"  value="提交" class="button" onClick='javascript:return checkmess()'>
      <input TYPE="reset"  value="取消" class="button">
    </div>
  </form>
</div>
</body>
</html>