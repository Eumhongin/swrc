<?
	include ("../../config/mysql.inc.php");
	include ("../../query/imageWindow/imageWindowQuery.php");
	include ("../../config/comm.inc.php");

	$mode = $_REQUEST["mode"];
	$idx = $_REQUEST["idx"];
	$order = $_REQUEST["order"];

	if($mode == "" || $idx == "" || $order == "") message('������ �߻��Ͽ����ϴ�.');

	if($mode == "up"){
		$result = getUpperOrderIdx($idx, $order);
		$row = mysql_fetch_array($result);

		if($row[idx] == "") message("�ֻ��� �Դϴ�.");

	}else if($mode == "down"){
		$result = getLowerOrderIdx($idx, $order);
		$row = mysql_fetch_array($result);

		if($row[idx] == "") message("������ �Դϴ�.");

	}

	//����� ����
	$changeIdx = $row[idx];
	$changeOrder = $row[image_order];

	updateImageWindowOrder($idx, $changeOrder);
	updateImageWindowOrder($changeIdx, $order);

	message_url("������ ����Ǿ����ϴ�.", $pageUrl."&page=/pages/admin/imageWindow/imageWindowList.php");

?>