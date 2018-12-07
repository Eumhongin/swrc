<?php
	
	session_start();

	include("../../../config/comm.inc.php"); 
	
	$p_id = $_REQUEST["p_id"];
	$p_pass = $_REQUEST["p_pass"];

	if($p_pass == "softadmin01" && $p_id == "admin" ) {
		 
		$duid        = "admin";
		$duname      = "관리자";
		$duchmember  = "99";
		$dupower     = "2";

	/*
		session_register("duid");
		session_register("duname");
		session_register("duchmember"); 
		session_register("dupower"); 
	*/
		$_SESSION['duid'] = $duid;
		$_SESSION['duname'] = $duname;
		$_SESSION['duchmember'] = $duchmember;
		$_SESSION['dupower'] = $dupower;
		
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

?>