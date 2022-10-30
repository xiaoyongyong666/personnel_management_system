<?php
require 'include/session.php';
require 'include/globle.inc.php';
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
    <script language='javascript'>
      function checkmes() {
        if ( document.addform.name.value == '' ) {
          window.alert('请输入姓名^_^');
          document.addform.xyname.focus();
          return false;
        }
        if ( document.addform.position.value == '' ) {
          window.alert('请输入职位！');
          document.addform.name.focus();
          return false;
        }

        return true;}
    </script>

</head>
<body >
<div id="loader" >页面加载中...</div>
<div id="result" class="result none"></div>
<div class="mainbox">
  <div id="nav" class="mainnav_title">
    <ul>
      <a href="manage_person.php">人员管理</a>| <a href="add_person.php">添加人员</a>
    </ul>
  </div>
  <script>
    	var onurl ='add_person.php';
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
  <div id="msg"></div>
  <form name="addform" id="addform" action="?act=ok" method="post">
    <table cellpadding=0 cellspacing=0 class="table_form" width="100%">
    <tr>
        <td width="10%" >姓 名</td>
        <td width="90%" >
          <input type="text" class="input-text" name="xm"  id="xm"  size="55" value="<?php echo $e_rs['name'];?>" />
          </td>
      </tr>
	  <tr>
        <td width="10%" >职 位</td>
        <td width="90%" >
          <input type="text" class="input-text" name="zw"  id="zw"  size="55" value="<?php echo $e_rs['position'];?>" />
          </td>
      </tr>
      <tr>
        <td width="10%" >电 话</td>
        <td width="90%" >
        <input type="text" class="input-text" name="dh"  id="dh"  size="55" value="<?php echo $e_rs['b_tel'];?>" />
      </tr>
      <tr>
        <td width="10%" >邮 箱</td>
        <td width="90%" >
        <input type="email" class="input-text" name="maila"  id="maila"  size="55" value="<?php echo $e_rs['b_mail'];?>" />
      </tr>
    </table>
    <div id="bootline"></div>
    <div id="btnbox" class="btn">
      <INPUT TYPE="submit"  value="提交" class="button" onClick='javascript:return checkmes()'>
      <input TYPE="reset"  value="取消" class="button">
    </div>
  </form>
</div>
</body>
</html>
<?php
//返回字符串（正在使用）
if($_GET["act"]==ok){
	$ap_name=trim($_POST['xm']);
  $ap_position=trim($_POST['zw']);

	$ap_tel=trim($_POST['dh']);
  $ap_mail=trim($_POST['maila']);
	$siteinfo = array(
      'name'=>$ap_name,
      'position'=>$ap_position,
      'b_tel'=>$ap_tel,
      'b_mail'=>$ap_mail,
      'c_date' =>strtotime(date('Y-m-d'))
  );
	$db->insert("member", $siteinfo);
	$db->close();
	ok_info('manage_person.php',"添加成功");
	}
?>