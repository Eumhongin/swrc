<?
	//*******************  Information  ***********************
	//	Program Title	:	대구센터 졸업업체 현황
	//	File Name		  :	graduation.php
	//	Company			  :	(주)나우아이텍 (053)955-9055
	//	Creator			  :	이 혜 진   
	//					        박 성 연  2004. 01
	//*********************************************************

	include("../../../config/mysql.inc.php");     //** 접속통계
	include("../../../config/comm.inc.php");
  
  $mysql = new Mysql_DB;
	$mysql->Connect();
		
	if ($mode == "OK" ) {
				
      $qry = "update members set user_pass = password('$p_newpwd') where user_id='$user_id'";
      $mysql->ParseExec($qry); 
      
      $mess  = "<font color=#1C73B3 size=3><b>". $user_id . "</b></font>님의 비밀번호가 변경 되었습니다";
      $mess .= "<br><br>주의) 타인에게 비밀번호를 누설하지 마세요";
      $mess_mode = "yes";

	} else {
		
		$mess = "주의) 타인에게 비밀번호를 누설하지 마세요";
		$mess_mode = "no" ;

  }
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=EUC-KR'>
<title>비밀번호변경</title>
<link href="/css/dip.css" rel="stylesheet" type="text/css">
<script src='/js/eButton.js'></script>
<script type="text/javascript" src="/js/comm.js"></script>
<script type="text/javascript" src="/js/user.js"></script>
<script type="text/javascript">
	function editPWD(){
		f = document.frm;
		if(f.p_newpwd.value ==''){
			alert('비밀번호를 입력해 주십시요!');
			f.p_newpwd.focus();
			return;
		}
		if(f.p_pwd_ok.value ==''){
			alert('비밀번호를 입력해 주십시요!');
			f.p_pwd_ok.focus();
			return;
		}
		if(f.p_newpwd.value != f.p_pwd_ok.value){
			alert('비밀번호가 서로 일치하지 않습니다!');
			f.p_newpwd.focus();
			return;
		}
		f.submit();


	}
</script>
</head>
<body bgcolor="#FFFFFF" background="/image/fbg.gif" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<form name="frm" method="post" action="pwd_modify.php">
<input type="hidden" name="user_id" value="<? echo $user_id ?>">
<input type="hidden" name="mode" value="OK">
<table width="420" height="35" border="0" cellpadding="0" cellspacing="0">
  <tr bgcolor="#EEA144">
    <td width="30" style=padding-left:10px><img src="/images/icon01.gif"></td>
    <td style=font-size:9pt;color:black;><b><? echo $user_id ?>님의 비밀번호변경</b></td>
    <td align="right" style=padding-right:15px></td>
  </tr>
</table>
<table border="0" width=420 height=100 cellpadding="5" cellspacing="0">
 <tr>
	<td align=center><br>
		<table border="0" cellpadding="10" cellspacing="2" width="97%" valign="top" align="center" style="border: #C7C7C7 solid 1px;">
			<tr>
				<td bgcolor="#F5F5F5" style="line-height:140%;padding:8pt">
					<table border="0" width=100% cellpadding="0" cellspacing="0">
						<? if($mess_mode == "yes") { ?>
						<tr>
							<td align="center" height="102"><? echo $mess ?> </td>
						<? } else { ?>
						<tr>
							<td colspan="4" height="37">
								비밀번호는 4~10자 이내로 영문/숫자만 사용하실 수 있습니다 
							</td>
						</tr>
					  <tr>
							<td width="50"></td>
							<td width="110"><b>새 비밀번호</b></td>
							<td width="90"><input type="password" name="p_newpwd" maxlength="12"></td>
							<td width="80">&nbsp;</td>
						</tr>
						<tr>
							<td width="50"></td>
							<td width="110"><b>비밀번호 확인</b></td>
							<td width="90"><input type="password" name="p_pwd_ok" maxlength="12"></td>
							<td width="80">&nbsp;</td>
						</tr>
						<tr>	
							<td colspan="4" height="22" align="center">
								<? echo $mess ?> 
							</td>
						</tr>
						<? } ?>
					</table>
				</td>
			</tr>
		</table>
	</td>
 	<tr>
    <td align=center valign=middle height="15"></td>
  </tr>
</table>
<table width=420 cellpadding="0" cellspacing="0">
<tr>
	<td height="34" bgcolor="#E6E6E6" align="center">
		<table cellpadding="0" cellspacing="5">
			<tr>
				<? if($mess_mode == "no") { ?>
				<td><script>T2Button('수 정', 'javascript:editPWD(); ' , 70)</script></td>
				<? } ?>
				<td><script>T2Button('닫 기', 'javascript:window.close(); ' , 70)</script></td>
			</tr>
		</table>
	</td>
</tr>
</TABLE>
</form>
</body>
</html>
