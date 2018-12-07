<?
	include ("../../config/mysql.inc.php");
	include ("../../query/organ/organQuery.php");
	include ("../../config/comm.inc.php");

	if($mode == "" || $idx == "" || $order == "" || $organ_code == "") message('오류가 발생하였습니다.');

	if($mode == "up"){
		$result = getUpperOrderIdx($idx, $order, $organ_code);
		$row = mysql_fetch_array($result);

		if($row[idx] == "") message("최상위 입니다.");

	}else if($mode == "down"){
		$result = getLowerOrderIdx($idx, $order, $organ_code);
		$row = mysql_fetch_array($result);

		if($row[idx] == "") message("최하위 입니다.");

	}

	//변경될 정보
	$changeIdx = $row[idx];
	$changeOrder = $row[organ_order];

	updateOrganOrder($idx, $changeOrder);
	updateOrganOrder($changeIdx, $order);

	message_url("순서가 변경되었습니다.", $pageUrl."&page=/pages/admin/member/organ.php&sel_organ_code=".$organ_code);

?>