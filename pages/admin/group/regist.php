<?
	//*******************  Information  ***********************
	//	Program Title	:	회원그룹생성
	//	File Name		  :	regist.asp
	//	Company			  :	(주)나우아이텍 (053)955-9055
	//	Creator			  :	이 혜 진   2003. 12
	//*********************************************************

	include("../../config/mysql.inc.php");  
	include("../../config/comm.inc.php");  

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();
	
	
	//**  입력 ***
	if ($mode == "write") {
		
		//DB에 저장
		$qry = "Insert Into m_level(l_level, l_levelname, l_power, l_check, l_regdate, l_ip)";
		$qry = $qry. " Values($p_level, '$p_levelname', '$p_power', 'n', now(), '$REMOTE_ADDR')";
		$mysql->ParseExec($qry); 


	//**  수정 ***
	} elseif ($mode == "modify") {

		$qry = "Update m_level Set l_levelname = '$p_levelname', l_power='$p_power' Where l_level = $p_level";
		$mysql->ParseExec($qry); 

	//**  삭제 ***
	} elseif ($mode == "delete") {

		$qry = "Delete From m_level Where l_level = $p_level";
		$mysql->ParseExec($qry); 

  //**  회원가입시 등급  ***
	} elseif ($mode == "base") {

		// 이전 회원등급을 y에서 n으로 수정
		$qry = "Update m_level Set l_check = 'n' Where l_check = 'y'";
		$mysql->ParseExec($qry); 

		// M_L_Check가 y이면 회원가입시 적용 되는 회원등급
		$qry = "Update m_level Set l_check = 'y' Where l_level = $p_level";
		$mysql->ParseExec($qry); 	
	}

	movepage("$pageUrl&page=/pages/admin/group/group.php");

?>