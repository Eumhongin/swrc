<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();
	
	if($pool_idx == ""){
		message("������ �߻��Ͽ����ϴ�.");
	}

	$query  = " Update t_pool Set pool_approve_flag = '".$approveUpdate."', pool_approve_date = now() ";
	$query .= " Where pool_idx = '".$pool_idx."' ";

	$mysql->ParseExec($query);
	
	$mysql->Disconnect();

	message_url("���ο��θ� �����Ͽ����ϴ�.", $pageUrl."&page=/pages/admin/pool/poolView.php&pool_idx=".$pool_idx);
?>