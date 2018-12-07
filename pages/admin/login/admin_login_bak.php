<?php
	
	session_start();

	include("../../../config/comm.inc.php"); 
	include("../../../config/mysql.inc.php"); 

	$mysql = new Mysql_DB;
	$mysql->Connect();

	
  $qry   = " select user_id, user_name, ch_member,l_power from members, m_level ";
  $qry  .= " where ch_member = l_level and (l_power = 2 or l_level = 99)";
  $qry  .= " and user_id='$p_id' AND (user_pass=old_password('$p_pass') OR user_pass=password('$p_pass'))";
 
  $mysql->ParseExec($qry); 

	if($mysql->RowCount() > 0 ) {

		 $mysql->FetchInto(&$col);
			 
		 $duid        = $col[user_id];
		 $duname      = $col[user_name];
		 $duchmember  = $col[ch_member];
		 $dupower     = $col[l_power];

		 session_register("duid");
		 session_register("duname");
		 session_register("duchmember"); 
		 session_register("dupower"); 
		
	// **** 권한 등급에 따른 관리자 메뉴 보이고, 숨기고 설정
	if($duchmember != 99){
		$memberMenuFlag = false;
		$menuMenuFlag = false;
		$eduMenuFlag = false;
		$contentMenuFlag = false;
		$boardMenuFlag = false;
		$poolMenuFlag = false;
		$companyMenuFlag = false;
		$countMenuFlag = false;
		$smsMenuFlag = false;

		//등급에 따른 권한 설정 정보
		//$qry = "select * from t_admin_menu_authority where p_level ='$duchmember' order by menu_idx ";
		$qry = " select am.menu_name AS menu_name from t_admin_menu AS am, t_admin_menu_authority AS ama ";
		$qry .= " where ama.menu_idx = am.idx AND ama.p_level = '$duchmember' ";
		$mysql->ParseExec($qry); 

		while($mysql->FetchInto(&$row)) {
			if($row[menu_name] == "회원관리"){
				$memberMenuFlag = true;
			}else if($row[menu_name] == "메뉴관리"){
				$menuMenuFlag = true;
			}else if($row[menu_name] == "교육관리"){
				$eduMenuFlag = true;
			}else if($row[menu_name] == "콘텐츠관리"){
				$contentMenuFlag = true;
			}else if($row[menu_name] == "게시판관리"){
				$boardMenuFlag = true;
			}else if($row[menu_name] == "포럼관리"){
				$poolMenuFlag = true;
			}else if($row[menu_name] == "기업관리"){
				$companyMenuFlag = true;
			}else if($row[menu_name] == "통계관리"){
				$countMenuFlag = true;
			}else if($row[menu_name] == "SMS"){
				$smsMenuFlag = true;
			}
		}
	}else{
		$memberMenuFlag = true;
		$menuMenuFlag = true;
		$eduMenuFlag = true;
		$contentMenuFlag = true;
		$boardMenuFlag = true;
		$poolMenuFlag = true;
		$companyMenuFlag = true;
		$countMenuFlag = true;
		$smsMenuFlag = true;
	}
	 session_register("memberMenuFlag");
	 session_register("menuMenuFlag");
	 session_register("eduMenuFlag"); 
	 session_register("contentMenuFlag");
	 session_register("boardMenuFlag");
	 session_register("poolMenuFlag"); 
	 session_register("companyMenuFlag");
	 session_register("countMenuFlag");
	 session_register("smsMenuFlag");


	?>
	<html>
	<head>
	<title>관리자</title>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
	<link rel="stylesheet" href="/bbs/style.css">
	</head>
	<body>
	<div align=center>
	<META HTTP-EQUIV="refresh" CONTENT="1; url=../main.php">
	<table width=660>
			<tr><td>
				<br><b><center>[사용자 인증결과]</b><br><br>
			</td></tr>
			<tr><td>	<center>인증성공!!  잠시만 기다리시면 관리화면이 나옵니다.</td></tr>
	</table>
	</DIV>
	</body>
	</html>
<?
   }
		else{
   
			message_url("회원정보가 정확하지 않습니다. 다시 입력해 주십시오.", "loginForm.php");
   
	 }

   // 데이터베이스 연결 종료
   $mysql->Disconnect();
?>