<?
	//*******************  Information  ***********************
	//	Program Title	:	회원삭제
	//	File Name		  :	delete.php
	//	Company			  :	(주)나우아이텍 (053)955-9055
	//	Creator			  :	이 혜 진   
	//					        박 성 연  2004. 01
	//*********************************************************

  session_start();
	include("../admin_security.php");
		
  include("../../config/mysql.inc.php");  
  include("../../config/comm.inc.php");


  $pageIdx = $_REQUEST["pageIdx"];
	$search = $_REQUEST["search"];
	$keyword = $_REQUEST["keyword"];
	$keyword2 = $_REQUEST["keyword2"];
	$user_id = $_REQUEST["user_id"];


  $mysql = new Mysql_DB;
  $mysql->Connect();
 
  
  $qry = "delete from members where user_id='$user_id'";
  $mysql->ParseExec($qry); 
  
 // $url = "list.php?not_user=$not_user&page=$page&search=$search&keyword=$keyword&keyword2=$keyword2";
//	echo $pageUrl;
	message_url("삭제되었습니다.","$pageUrl&page=/pages/admin/member/list.php&pageIdx=$pageIdx&search=$search&keyword=$keyword");

 // movepage($url);       
  
?>
