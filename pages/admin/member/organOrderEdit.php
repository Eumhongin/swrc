<?
	include ("../../config/mysql.inc.php");
	include ("../../query/organ/organQuery.php");
	include ("../../config/comm.inc.php");

	if($mode == "" || $idx == "" || $order == "" || $organ_code == "") message('������ �߻��Ͽ����ϴ�.');

	if($mode == "up"){
		$result = getUpperOrderIdx($idx, $order, $organ_code);
		$row = mysql_fetch_array($result);

		if($row[idx] == "") message("�ֻ��� �Դϴ�.");

	}else if($mode == "down"){
		$result = getLowerOrderIdx($idx, $order, $organ_code);
		$row = mysql_fetch_array($result);

		if($row[idx] == "") message("������ �Դϴ�.");

	}

	//����� ����
	$changeIdx = $row[idx];
	$changeOrder = $row[organ_order];

	updateOrganOrder($idx, $changeOrder);
	updateOrganOrder($changeIdx, $order);

	message_url("������ ����Ǿ����ϴ�.", $pageUrl."&page=/pages/admin/member/organ.php&sel_organ_code=".$organ_code);

?>