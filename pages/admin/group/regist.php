<?
	//*******************  Information  ***********************
	//	Program Title	:	ȸ���׷����
	//	File Name		  :	regist.asp
	//	Company			  :	(��)��������� (053)955-9055
	//	Creator			  :	�� �� ��   2003. 12
	//*********************************************************

	include("../../config/mysql.inc.php");  
	include("../../config/comm.inc.php");  

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();
	
	
	//**  �Է� ***
	if ($mode == "write") {
		
		//DB�� ����
		$qry = "Insert Into m_level(l_level, l_levelname, l_power, l_check, l_regdate, l_ip)";
		$qry = $qry. " Values($p_level, '$p_levelname', '$p_power', 'n', now(), '$REMOTE_ADDR')";
		$mysql->ParseExec($qry); 


	//**  ���� ***
	} elseif ($mode == "modify") {

		$qry = "Update m_level Set l_levelname = '$p_levelname', l_power='$p_power' Where l_level = $p_level";
		$mysql->ParseExec($qry); 

	//**  ���� ***
	} elseif ($mode == "delete") {

		$qry = "Delete From m_level Where l_level = $p_level";
		$mysql->ParseExec($qry); 

  //**  ȸ�����Խ� ���  ***
	} elseif ($mode == "base") {

		// ���� ȸ������� y���� n���� ����
		$qry = "Update m_level Set l_check = 'n' Where l_check = 'y'";
		$mysql->ParseExec($qry); 

		// M_L_Check�� y�̸� ȸ�����Խ� ���� �Ǵ� ȸ�����
		$qry = "Update m_level Set l_check = 'y' Where l_level = $p_level";
		$mysql->ParseExec($qry); 	
	}

	movepage("$pageUrl&page=/pages/admin/group/group.php");

?>