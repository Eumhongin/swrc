<?php
	
	session_start();

	include("../../../config/comm.inc.php"); 
	
	$p_id = $_REQUEST["p_id"];
	$p_pass = $_REQUEST["p_pass"];

	if($p_pass == "softadmin01" && $p_id == "admin" ) {
		 
		$duid        = "admin";
		$duname      = "������";
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
	<title>������</title>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
	<link rel="stylesheet" href="/bbs/style.css">
	</head>
	<body>
	<div align=center>
	<META HTTP-EQUIV="refresh" CONTENT="1; url=../main.php">
	<table width=660>
			<tr><td>
				<br><b><center>[����� �������]</b><br><br>
			</td></tr>
			<tr><td>	<center>��������!!  ��ø� ��ٸ��ø� ����ȭ���� ���ɴϴ�.</td></tr>
	</table>
	</DIV>
	</body>
	</html>
<?
   }
		else{
   
			message_url("ȸ�������� ��Ȯ���� �ʽ��ϴ�. �ٽ� �Է��� �ֽʽÿ�.", "loginForm.php");
   
	 }

?>