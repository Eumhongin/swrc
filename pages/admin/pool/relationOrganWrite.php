<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	if($mode == "write" ){

		$query  = " INSERT INTO t_relation_organ ( ";
		$query .= "		organ_name, ";
		$query .= "		organ_address, ";
		$query .= "		organ_address_detail, ";
		$query .= "		organ_zip_code, ";
		$query .= "		organ_tel, ";
		$query .= "		organ_homepage, ";
		$query .= "		organ_date, ";
		$query .= "		organ_kind_idx ";
		$query .= "		) VALUES ( ";
		$query .= "		'$organ_name', ";
		$query .= "		'$pool_address', ";
		$query .= "		'$pool_address_detail', ";
		$query .= "		'$pool_zip_code', ";
		$query .= "		'$organ_tel', ";
		$query .= "		'$organ_homepage', ";
		$query .= "		now(), ";
		$query .= "		'$selectOrganKind' ";
		$query .= " ) ";

		$mysql->ParseExec($query);

		message_url("��� �Ϸ�Ǿ����ϴ�.", $pageUrl."&page=/pages/admin/pool/relationOrgan.php" );

	}elseif($mode == "edit"){

		if($organ_idx == "") message_url("������ �߻��Ͽ����ϴ�.\\n\\n �����ڿ��� �����Ͽ� �ֽñ� �ٶ��ϴ�.", $pageUrl."&page=/pages/admin/pool/relationOrgan.php");

		$query  = " UPDATE t_relation_organ SET ";
		$query .= " organ_name = '$organ_name', ";
		$query .= " organ_address = '$pool_address', ";
		$query .= " organ_address_detail = '$pool_address_detail', ";
		$query .= " organ_zip_code = '$pool_zip_code', ";
		$query .= " organ_tel = '$organ_tel', ";
		$query .= " organ_homepage = '$organ_homepage', ";
		$query .= " organ_kind_idx = '$selectOrganKind' ";
		$query .= " Where organ_idx = '".$organ_idx."' ";

		$mysql->ParseExec($query);

		message_url("������ �Ϸ�Ǿ����ϴ�.", $pageUrl."&page=/pages/admin/pool/relationOrganWriteForm.php&organ_idx=".$organ_idx."&mode=edit" );

	}else if($mode == "delete"){

		if($organ_idx == "") message_url("������ �߻��Ͽ����ϴ�.\\n\\n �����ڿ��� �����Ͽ� �ֽñ� �ٶ��ϴ�.", $pageUrl."&page=/pages/admin/pool/relationOrgan.php");

		$query  = " DELETE FROM t_relation_organ ";
		$query .= " WHERE organ_idx = '".$organ_idx."' ";

		$mysql->ParseExec($query);

		message_url("���������� �����Ǿ����ϴ�.", $pageUrl."&page=/pages/admin/pool/relationOrgan.php" );
	}

	$mysql->Disconnect();
?>