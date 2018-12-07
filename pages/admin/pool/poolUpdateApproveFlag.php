<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();
	
	if($pool_idx == ""){
		message("오류가 발생하였습니다.");
	}

	$query  = " Update t_pool Set pool_approve_flag = '".$approveUpdate."', pool_approve_date = now() ";
	$query .= " Where pool_idx = '".$pool_idx."' ";

	$mysql->ParseExec($query);
	
	$mysql->Disconnect();

	message_url("승인여부를 수정하였습니다.", $pageUrl."&page=/pages/admin/pool/poolView.php&pool_idx=".$pool_idx);
?>