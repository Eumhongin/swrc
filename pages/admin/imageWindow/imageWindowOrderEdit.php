<?
	include ("../../config/mysql.inc.php");
	include ("../../query/imageWindow/imageWindowQuery.php");
	include ("../../config/comm.inc.php");

	$mode = $_REQUEST["mode"];
	$idx = $_REQUEST["idx"];
	$order = $_REQUEST["order"];

	if($mode == "" || $idx == "" || $order == "") message('오류가 발생하였습니다.');

	if($mode == "up"){
		$result = getUpperOrderIdx($idx, $order);
		$row = mysql_fetch_array($result);

		if($row[idx] == "") message("최상위 입니다.");

	}else if($mode == "down"){
		$result = getLowerOrderIdx($idx, $order);
		$row = mysql_fetch_array($result);

		if($row[idx] == "") message("최하위 입니다.");

	}

	//변경될 정보
	$changeIdx = $row[idx];
	$changeOrder = $row[image_order];

	updateImageWindowOrder($idx, $changeOrder);
	updateImageWindowOrder($changeIdx, $order);

	message_url("순서가 변경되었습니다.", $pageUrl."&page=/pages/admin/imageWindow/imageWindowList.php");

?>