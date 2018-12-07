<?

	if($mode == "stop") {
    FormStop_OK();
  } else {
    FormStop();
  }
  
  function FormStop() {
    global $user_id, $not_user;
    global $pageIdx, $search, $keyword, $keyword2;
 
?>	
<html>
<head>
<title>사유</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="/css/dip.css">
<script src='/js/eButton.js'></script>
<script language="JavaScript" type="text/JavaScript">
<!--
function checkform(){
	
	if (document.frm.not_conts.value == "") {
		 alert("해지 이유를 입력하여 주십시오");
		 document.frm.not_conts.focus();
		 return;
	}

	if (document.frm.not_conts.value.length > 20) {
		 alert("20자 이내로 입력하여 주십시오");
		 return;
	}

	document.frm.submit();
}

//-->
</script>

<form name="frm" method="post">
<input type="hidden" name="user_id" value="<?=$user_id ?>">
<input type="hidden" name="mode" value="stop">
<input type="hidden" name="not_user" value="<?=$not_user ?>">
<input type="hidden" name="pageIdx" value="<?=$pageIdx ?>">
<input type="hidden" name="search" value="<?=$search ?>">
<input type="hidden" name="keyword" value="<?=$keyword ?>">
<input type="hidden" name="keyword2" value="<?=$keyword2 ?>">
<table width="380" border="0" align="center" cellpadding="2" cellspacing="0">
	<tr>
		<td style="padding:10">
			<table border=0 cellspacing=0 cellpadding=0>
			<tr> 
				<td width=15 align=center height=24></td>
			<td><b>ID : <? echo $user_id ?></b></td>
			</tr>
			<tr> 
				<td width=15 align=center height=24></td>
				<td><b>회원 가입을 해지하고자 하는 이유는 무엇입니까?</b></td>
			</tr>
			<tr> 
				<td align=center height=24>&nbsp;</td>
				<td><textarea name="not_conts" rows="13" cols="50"></textarea></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
      <table height="30" border="0" cellpadding="2" cellspacing="0">
        <tr>
          <td><script>T2Button("확인","javascript:checkform()", 55)</script></td>
          <td><script>T2Button("닫기","javascript:window.close()", 55)</script></td>
        </tr>
      </table>
		</td>
	</tr>
</table>
</form>
<?
  }

  Function FormStop_OK() {
    global $user_id, $not_conts,$not_user;
    global $pageIdx, $search, $keyword, $keyword2;
    global $mysql;
    include("../../../config/mysql.inc.php");  
    
    $mysql = new Mysql_DB;
    $mysql->Connect();
    
    $not_date = date("Y-m-d");
    
    $qry = "update members set not_user='1',not_user_day='$not_date',not_user_conts='$not_conts' where user_id='$user_id'";
    $mysql->ParseExec($qry); 
		
		echo "<script type='text/javascript'>";
		echo "window.opener.location.href='/pages/admin/main.php?pageName=회원관리&page=/pages/admin/member/list.php&user_flag=$not_user&pageIdx=$pageIdx&search=$search&keyword=$keyword&keyword2=$keyword2';";
		echo "window.close();";
		echo "</script>";
  }

?>
