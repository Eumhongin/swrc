<?php

	include("../../../config/mysql.inc.php");
	include("../../../config/webConfig.inc.php");
	include("../../../config/request.inc.php");
	include("../../../query/menu/menuQuery.php");

	$isEdit = false;
	
	$idx = $_REQUEST["idx"];
	$parentIdx = $_REQUEST["parentIdx"];
	$mode = $_REQUEST["mode"];
	$SiteCode = getParameter($_REQUEST["site_code"], "505000000");
	$SiteGroup = "";
	$title = "";
	$division = "";
	$linkType = "";
	$userFlag = "";
	$link = "";
	$target = "";

	//������ ���
	if($idx > 0){
		$isEdit = true;
		$menuArr = getMenuRow($idx);

		if($menuArr){
			$row = mysql_fetch_array($menuArr);
			$SiteCode = $row[menu_site_code];
			$SiteGroup = $row[menu_site_group];
			$parentIdx = $row[menu_parent_idx];
			$title = utf8ToEuckr($row[menu_title]);
			$division = $row[menu_division];
			$linkType = $row[menu_link_type];
			$useFlag = $row[menu_use_flag];
			$link = $row[menu_link];
			$target = $row[menu_target];
			$code = $row[menu_code];

			//���� �޴��� ���� ����
			$UpperMenuArr = getUpperMenuRow($parentIdx, $code);
			$UpperRow = mysql_fetch_array(&$UpperMenuArr);
			$UpperIdx = $UpperRow[idx];
			$UpperCode = $UpperRow[code];

			$LowerMenuArr = getLowerMenuRow($parentIdx, $code);
			$LowerRow = mysql_fetch_array(&$LowerMenuArr);
			$LowerIdx = $LowerRow[idx];
			$LowerCode = $LowerRow[code];
			
			$childCount = getChildMenuCount($idx);

			//charger �� ���Ѱ� ������ kimna ���� ���� ��.
			$charge_user_id = $row[menu_charge_user_id];
			$charge_user_name = $row[menu_charge_user_name];
			$charge_user_tel = $row[menu_charge_user_tel];

			/*
			$chargeMemberInfoArr = getMemberInfo($charge_user_id);
				if($chargeMemberInfoArr){
					$chargeMemberInfoRow = mysql_fetch_array($chargeMemberInfoArr);
					$chargeUserId = $chargeMemberInfoRow[user_id];
					$chargeUserName = $chargeMemberInfoRow[user_name];
				}
			*/
			if($row[menu_link_type] == CMS_LINK_TYPE){
				$menuCmsList = getMenuCmsList($idx);
			}

		}else{
			message_url("�ش� �޴��� �������� �ʽ��ϴ�.", "menuList.php");
		}


		//���� idx �� ���� ���
		if($parentIdx > 0){
			// �θ�޴� ����
			$pMenuArr = getMenuRow($parentIdx);
			if($pMenuArr){
				$row = mysql_fetch_array($pMenuArr);
				$SiteCode = $row[menu_site_code];
				$Sitegroup = $row[menu_site_group];
				
				//menuHistoryList ���� �ؾ��� kimna
				$menuHistoryList = getMenuHistoryList($parentIdx);
			}
		}

		$menuMatchKeywordList = getMenuMatchKeywordList($idx);

	}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>CMS �߰� �˾�</title>
<link rel="stylesheet" type="text/css" href="/pages/admin/css/admin_common.css"/>
<script type="text/javascript" src="/js/prototype.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<!--
<script type="text/javascript">document.domain = "";</script>
-->
<script type="text/javascript">
<!--
	var cmsDataList = new Array();
	cmsDataList.dataLength = 0;

	//Event.observe(window, "load", init);
	
	// ÷�� ȣ��Ǵ� �Լ�
	function init() {
		
		$("title").focus();
	}

	// ��ũŸ���� ����� �� ȣ��Ǵ� �Լ�
	function changeLinkType() {
		var linkType = $F("linkType");
		
		if (linkType == "<?= INCLUDE_LINK_TYPE ?>") {
			$("cmsTable").hide();
			$("urlTable").show();
			$("javascriptTable").hide();
		} else if (linkType == "<?= CMS_LINK_TYPE ?>") {
			$("cmsTable").show();
			$("urlTable").hide();
			$("javascriptTable").hide();
		} else if (linkType == "<?= URL_LINK_TYPE ?>") {
			$("cmsTable").hide();
			$("urlTable").show();
			$("javascriptTable").hide();
		} else {
			$("cmsTable").hide();
			$("urlTable").hide();
			$("javascriptTable").show();
		}
	}
	
	// CMS�� ����� �� �ִ� list �˾��� ����.
	function appendCmsPopup() {

		window.open("/pages/admin/menu/cmsAppendList.php?site_code=<?=$SiteCode?>", "cmsAppendPopup", "width=937,height=650,top=100,left=100,scrollbars=yes,resizable=no");
	}
	
	// CMS �����͸� �߰��ϴ� �Լ�.
	function appendCmsData(appendCmsDataList) {
		var cmsListTable = $("cmsListTable");
	
		for (var i = 0; i < appendCmsDataList.length; i++) {			
			if (cmsDataList[appendCmsDataList[i].idx + ""] == null) {
				// ��ϵ� CMS�� ���ٴ� �޼��� ����
				if (cmsDataList.dataLength == 0) {
				//	cmsListTable.deleteRow(2);
				//	cmsListTable.deleteRow(1);
				}
				
				cmsDataList[appendCmsDataList[i].idx + ""] = {
					idx : appendCmsDataList[i].idx,
					contentIdx : appendCmsDataList[i].contentIdx,
					title : appendCmsDataList[i].title,
					description : appendCmsDataList[i].description,
					useFlag : appendCmsDataList[i].useFlag
				};
				cmsDataList[appendCmsDataList[i].idx + ""].tableRow = cmsListTable.rows.length;
				
				var newRow = cmsListTable.insertRow(cmsListTable.rows.length);
				newRow.height = "25";
				newRow.className = "tcpad";
				newRow.align = "center";
				var newCell = newRow.insertCell(0);
				newCell.innerHTML = appendCmsDataList[i].idx;
				
				newCell = newRow.insertCell(1);
				newCell.align = "left";
				newCell.innerHTML = "<a href=\"javascript:cmsManagementPopup(" + appendCmsDataList[i].idx + ");\" title=\"" + appendCmsDataList[i].title + " ������ ����\">" + appendCmsDataList[i].title + "</a>";
				newCell.innerHTML += "<input type=\"hidden\" id=\"cmsIdx\" name=\"cmsIdx\" value=\"" + appendCmsDataList[i].idx + "\" />";
				
				newCell = newRow.insertCell(2);
				newCell.innerHTML = "<input type=\"radio\" id=\"cmsDefaultIdx\" name=\"cmsDefaultIdx\" value=\"" + appendCmsDataList[i].idx + "\" />";
				
				newCell = newRow.insertCell(3);
				newCell.innerHTML = "<a href=\"/open_content/sub.php?menuIdx=<?= $idx ?>&page=/contents/pages/" + appendCmsDataList[i].idx + ".php\" target=\"_blank\" class=\"btn_bgBlue\" title=\"" + appendCmsDataList[i].title + " ������ �̸�����\">�̸�����</a> ";
				
				newCell.innerHTML += "<a href=\"javascript:deleteCmsData(" + appendCmsDataList[i].idx + ");\" class=\"btn_bgBlue\" title=\"CMS ����\">����</a>";
				
				newRow = cmsListTable.insertRow(cmsListTable.rows.length);
				newCell = newRow.insertCell(0);
				newCell.colSpan = "4";
				newCell.bgColor = "#e1e1e1";
				newCell.height = "1";
				
				cmsDataList.dataLength++;
			}
		}
	}
	
	// CMS �����͸� �����ϴ� �Լ�.
	function deleteCmsData(idx) {
		var cmsListTable = $("cmsListTable");
		cmsDataList[idx + ""];
		var tableRow = cmsDataList[idx + ""].tableRow;
		
		//cmsListTable.deleteRow(tableRow + 1);
		cmsListTable.deleteRow(tableRow);
		cmsDataList[idx + ""] = null;
		cmsDataList.dataLength--;
		
		// ������ Row���� ū tableRow�鿡 -2�� ���ش�.
		cmsDataList.each(function(element, index) {
			if (element != null && element.tableRow > tableRow) {
				element.tableRow -= 2;
			}
		});
		
		// �߰��� CMS�� ���� ��.
		if (cmsDataList.dataLength == 0) {
		/*	var newRow = cmsListTable.insertRow(cmsListTable.rows.length);
			var newCell = newRow.insertCell(0);
			newRow.height = "25";
			newRow.className = "tcpad";
			newRow.align = "center";
			newCell.colSpan = "4";
			newCell.innerHTML = "��ϵ� CMS�� �����ϴ�.";
			
			newRow = cmsListTable.insertRow(cmsListTable.rows.length);
			newCell = newRow.insertCell(0);
			newCell.colSpan = "4";
			newCell.bgColor = "#e1e1e1";
			newCell.height = "1";
		*/
		}
	}
	
	// �Էµ� Ű���带 �߰����ִ� �Լ�
	function addMatchKeyword() {
		var matchKeywords = $("matchKeywords").options;
		var matchKeyword = $F("matchKeyword");
		
		if (matchKeyword.blank()) {
			alert("�߰��� Ű���带 �Է����ּ���.");
			$("matchKeyword").focus();
			return;
		}
		
		var isAppend = true;
	
		// �̹� ��ϵȰ� ������ �н��Ѵ�.
		for (var i = 0; i < matchKeywords.length; i++) {
			if (matchKeyword == matchKeywords[i].value) {
				isAppend = false;
				break;
			}
		}
		
		if (!isAppend) {
			alert("�̹� ��ϵ� Ű�����Դϴ�.");
			$("matchKeyword").focus();
			return;
		}
		
		matchKeywords[matchKeywords.length] = new Option(matchKeyword, matchKeyword);
		$("matchKeyword").value = "";
		$("matchKeyword").focus();
	}
	
	// ���õ� Ű���带 �����ϴ� �Լ�.
	function deleteMatchKeyword() {
		var matchKeywords = $("matchKeywords");
		var selectedIdx = matchKeywords.selectedIndex;
		
		if (selectedIdx >= 0) {
			matchKeywords.options.remove(selectedIdx);
		}
	}
	
	// select ��ü�� �ϳ��� ���ð����ϰ� �ϱ� ���ؼ�
	function oneChoice(list) {
		var optIdx = list.selectedIndex;
		
		for(var i = 0; i < list.options.length; i++) {
			if(i == optIdx) {
				list.options[i].selected = true;
				continue;
			}
			
			list.options[i].selected = false;
		}
	}
	
	// �޴� ���/���� �Լ�.
	function updateMenu() {
		var processUrl = parent.frmPnt.PROCESS_URL.value; 
		var pageUrl =  parent.frmPnt.PAGE_URL.value; 
		pageUrl += "�޴�����";
		
		var menuForm = $("menuForm");
		//var matchKeywords = $("matchKeywords");
		
		if ($F("title").blank()) {
			alert("������ �Է����ּ���.");
			$("title").focus();
			return;
		}
		
		// Include, URL
		if ($F("linkType") == "<?= INCLUDE_LINK_TYPE ?>" || $F("linkType") == "<?= URL_LINK_TYPE ?>") {
		}
		// CMS
		else if ($F("linkType") == "<?= CMS_LINK_TYPE ?>") {
			if (cmsDataList.dataLength <= 0) {
				alert("�ּ� �ϳ� �̻��� Content�� ������ּ���.");
				return;
			} else if (!$RF("cmsDefaultIdx")) {
				alert("�⺻ �������� �������ּ���.");
				return;
			}
		}
		// Javascript
		else {
			if ($F("javascriptLink").blank()) {
				alert("Javascript�� �Է����ּ���.");
				$("javascriptLink").focus();
				return;
			}
		}
		/*
		try {
			for (var i = 0; i < matchKeywords.options.length; i++) {
				matchKeywords.options[i].selected = true;
			}
		} catch (e) {
			for (var i = 0; i < matchKeywords.options.length; i++) {
				matchKeywords.options[i].selected = false;
			}
		}
		*/
		menuForm.target="_top"
		menuForm.action = pageUrl+"&page=/pages/admin/menu/menuUpdate.php";
		menuForm.submit();
	}
	
	// ����ڸ� ������ �� �ִ� �˾��� ����.
	function menuChargePopup() {
		window.open("/pages/admin/menu/userPopList.php", "menuChargePopup", "width=537,height=500,top=100,left=100,scrollbars=yes,resizable=no");
	}
	
	function choiceCharge(chargeUserId, chargeUserName) {
		
		$("chargeUserSpan").innerHTML = chargeUserName;
		$("chargeUserId").value		= chargeUserId;
		$("chargeUserName").value	= chargeUserName;

	}
	
	// ��� �ʱ�ȭ �Լ�
	function resetCharge() {
		$("chargeUserSpan").innerHTML = "������";
		$("chargeUserId").value = " ";
	}
	
	// CMS ���� �˾��� ���� �Լ�.
	function cmsManagementPopup(idx) {
		window.open("/pages/admin/cms/cmsManagementPopupForm.php?site_code=<?=$SiteCode?>&amp;idx=" + idx, "cmsManagementPopup", "width=817,height=600,top=100,left=100,scrollbars=yes,resizable=no");
	}

	// �޴� ���� �Լ�
	function deleteMenu(idx) {
		var processUrl = parent.frmPnt.PROCESS_URL.value; 
		if (confirm("���� �����Ͻðڽ��ϱ�?")) {
			parent.document.location.href = processUrl+"&page=/pages/admin/menu/menuDelete.php&amp;parentIdx=<?=$parentIdx?>&amp;idx=" + idx;
		}
	}
	function moveDownMenu(idx){
		//var processUrl = parent.frmPnt.PROCESS_URL.value;
		var pageUrl =  parent.frmPnt.PAGE_URL.value; 
		pageUrl += "�޴�����";
		parent.document.location.href  = pageUrl+"&page=/pages/admin/menu/menuSortEdit.php&amp;nowIdx="+idx+"&amp;nowCode=<?= $code?>&amp;action=down&changeIdx=<?=$LowerIdx?>&changeCode=<?=$LowerCode?>";
	}
	function moveUpMenu(idx){
		//var processUrl = parent.frmPnt.PROCESS_URL.value; 
		var pageUrl =  parent.frmPnt.PAGE_URL.value; 
		pageUrl += "�޴�����";
		parent.document.location.href  = pageUrl+"&page=/pages/admin/menu/menuSortEdit.php&amp;nowIdx="+idx+"&amp;nowCode=<?=$code?>&amp;action=up&changeIdx=<?=$UpperIdx?>&changeCode=<?=$UpperCode?>";
	}

//-->
</script>

<form id="menuForm" name="menuForm" action="javascript:updateMenu();" method="post"  style="margin:0px;">
<input type="hidden" id="site_code" name="site_code"  value="<?=$SiteCode?>">
<input type="hidden" id="site_group" name="site_group"  value="<?=$SiteGroup?>">

<table width="100%" height="26" cellpadding="0" cellspacing="0">
  <tr>
	<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> �޴� ���� - 
<?
	if ($menuHistoryList) {
		 $i = 0;
		while($row = mysql_fetch_array($menuHistoryList)){
			if($i != 0){
				echo "&gt;";
			}
			$i++;

			echo utf8ToEuckr($row[title]);
		}
	}
?>
</td>
  </tr>
</table>
		
<table class="bbsCont" cellspacing="0" summary="�޴� ��� ��">		
		<colgroup>
			<col width="15%" />
			<col width="35%" />
			<col width="12%" />
			<col width="38%" />
		</colgroup>
		<tbody>	
			<tr>
				<th><label for="title">* �޴���</label></th>
				<td colspan="3" class="tal">
					<input type="text" id="title" name="title" value="<? if ($isEdit) { echo $title; } ?>" class="basic" style="width:200px;" maxlength="100" />
				</td>
			</tr>
			<tr>
				<th><label for="division">�����ڵ�</label></th>
				<td class="tal">
					<input type="text" id="division" name="division" value="<? if ($isEdit) { echo $division; } ?>" class="basic" style="width:200px;" maxlength="30" />
				</td>
				<th><label for="useFlag">�����</label></th>
				<td class="tal">

					�̸� :<input type="text" name="chargeUserName" id="chargeUserName" class="basic"  style="width:100px;" value="������"/>&nbsp;
					<input type="hidden" name="chargeUserTel" id="chargeUserTel" value="0000000000"/>

					<!--<a href="javascript:menuChargePopup();" class="btn_bgBlue" title="����� ã��">
						<img src="/pages/admin/images/bbs/btn_find.gif" alt="ã��" />
					</a>-->

				</td>
			</tr>
			<tr>
				<th><label for="linkType">* ��ũŸ��</label></th>
				<td class="tal">
					<select id="linkType" name="linkType" onchange="changeLinkType();" class="basic">
						<option value="<?= INCLUDE_LINK_TYPE ?>"<?= $isEdit && INCLUDE_LINK_TYPE == $linkType ? " selected" : "" ?>><?=INCLUDE_LINK_TYPE_STR?></option>
						<option value="<?= CMS_LINK_TYPE ?>"<?= $isEdit && CMS_LINK_TYPE == $linkType ? " selected" : "" ?>><?= CMS_LINK_TYPE_STR ?></option>
						<option value="<?= URL_LINK_TYPE ?>"<?= $isEdit && URL_LINK_TYPE == $linkType ? " selected" : "" ?>><?= URL_LINK_TYPE_STR ?></option>
						<option value="<?= JAVASCRIPT_LINK_TYPE ?>"<?= $isEdit && JAVASCRIPT_LINK_TYPE == $linkType ? " selected" : "" ?>><?= JAVASCRIPT_LINK_TYPE_STR ?></option>
					</select>
				</td>
			<th><label for="useFlag">* ��뿩��</label></th>
			<td class="tal">
				<select id="useFlag" name="useFlag" onchange="changeLinkType();" class="basic">
					<option value="Y" <?= $isEdit ? (("Y" == $useFlag ) ? " selected" : " ") : " selected" ?> /> ���</option>
					<option value="N" <?= $isEdit ? (("N" == $useFlag ) ? " selected" : " ") : "" ?> /> ��� ����</option> 
					<option value="U" <?= $isEdit ? (("U" == $useFlag ) ? " selected" : " ") : "" ?> /> ǥ�� ����</option> 
				</select>
			</td>
			</tr>
			
		</tbody>
		<tbody id="urlTable"<?= $isEdit && ($linkType != INCLUDE_LINK_TYPE && $linkType != URL_LINK_TYPE) ? " style=\"display:none;\"" : "" ?>>
			<tr>
			<th><label for="urlLink">URL</label></th>
			<td colspan="3" class="tal">
				<input type="text" id="urlLink" name="urlLink" value="<? if ($isEdit && ($linkType == INCLUDE_LINK_TYPE || $linkType == URL_LINK_TYPE)) { echo $link; } ?>" class="basic" style="width:200px;" maxlength="255" />
			</td>
			</tr>
			<tr>
			<th><label for="urlTarget">Target</label></th>
			<td  colspan="3" class="tal">
				<input type="text" id="urlTarget" name="urlTarget" value="<? if ($isEdit && ($linkType == INCLUDE_LINK_TYPE || $linkType == URL_LINK_TYPE)) { echo $target; } ?>" class="basic" style="width:200px;" maxlength="255" />
			</td>
			</tr>
		</tbody>
		
		<tbody id="cmsTable"<?= !$isEdit || $linkType != CMS_LINK_TYPE ? " style=\"display:none;\"" : "" ?>>
			<tr>
			<th><label>CMS</label></th>
			<td colspan="3" class="tal">
				<table class="bbsCont" cellspacing="0" summary="CMS ����Ʈ" >
					<caption>
						CMS ����Ʈ
					</caption>
					<colgroup>
						<col width="20%">
						<col>
						<col width="20%">
						<col width="20%">
					</colgroup>
					<thead>
						<tr>
							<th>Key</th>
							<th>������ ��</th>
							<th>�⺻</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody id="cmsListTable">

<?php
	if($menuCmsList){

		while ($row = mysql_fetch_array($menuCmsList)){
			
			$description = str_replace("\r\n", "<br />", $row[description]);

?>
						<tr height="25" class="tcpad" align="center">
						<td><?=$row[idx] ?></td>
						<td align="left">
							<!--<a href="javascript:cmsManagementPopup(<?=$row[idx] ?>);" title="<?= $row[title] ?> ������ ����"><?=$row[title]?></a>-->
							<?=utf8ToEuckr($row[title])?>
							
							<script type="text/javascript">
							<!--
								cmsDataList["<?= $row[idx]?>"] = {
									idx : <?= $row[idx]?>,
									contentIdx : <?=$row[content_idx] ?>,
									title : '<?=utf8ToEuckr($row[title]) ?>',
									description : '<?=$description?>',
									useFlag : '<?=$row[default_flag]?>',
									tableRow : <?= i * 2 ?>
								}
								
								cmsDataList.dataLength++;
							//-->
							</script>

							<input type="hidden" id="cmsIdx" name="cmsIdx" value="<?=$row[idx] ?>" />
						</td>
						<td><input type="radio" id="cmsDefaultIdx" name="cmsDefaultIdx" value="<?=$row[idx] ?>"<?= $row[default_flag] ? " checked" : "" ?> /></td>
						<td>
							<a href="/open_content/sub.php?menuIdx=<?= $idx ?>&amp;page=/contents/pages/<?=$row[idx] ?>.php" target="_blank" class="btn_bgBlue" title="<?=utf8ToEuckr($row[title]) ?> ������ �̸�����">
							<img src="/pages/admin/images/bbs/btn_preview.gif" alt="�̸�����" />
							</a>
							<!--
							<a href="javascript:cmsManagementPopup(<?=$row[idx]?>);" class="btn_bgBlue" title="<?=$row[title] ?> ������ ����">
							<img src="/pages/admin/images/bbs/btn_modify.gif" alt="����" />
							</a>-->
							<a href="javascript:deleteCmsData(<?= $row[idx] ?>);" class="btn_bgBlue" title="CMS ����">
							<img src="/pages/admin/images/bbs/btn_delete.gif" alt="����" />
							</a></td>
						</tr>
<?php
		}
	} else {
?>
						
<?php
	}
?>
					</tbody>
				</table>
				<p class="acenter">
					<a href="javascript:appendCmsPopup();" class="btn_bgBlue">
						<img src="/pages/admin/images/bbs/btn_add.gif" alt="�߰�" />
					</a>
				</p>
			</td>
			</tr>
		</tbody>
		
		<tbody id="javascriptTable"<?= !$isEdit || $linkType != JAVASCRIPT_LINK_TYPE ? " style=\"display:none;\"" : "" ?>>
			<tr>
			<th height="25" bgcolor="#f2eee9"><label for="urlLink">Javascript</label></th>
			<td  colspan="3" class="tal">
				<input type="text" id="javascriptLink" name="javascriptLink" value="<? if ($isEdit && $linkType == JAVASCRIPT_LINK_TYPE) { echo($link); } ?>" class="basic" style="width:200px;" maxlength="255" />
			</td>
			</tr>
		</tbody>
	</table>
	<div class="acenter mar_t20">
		<a href="javascript:$('menuForm').submit();" class="btn_bgBlue">
		<img src="/pages/admin/images/bbs/btn_ok_big.gif" alt="����" />
		</a>
		<a href="javascript:deleteMenu(<?=$idx?>);" class="btn_bgBlue">
			<img src="/pages/admin/images/bbs/btn_delete_big.gif" alt="����" />
		</a>

		<?if($childCount < 1){ //���� �޴��� ���� ��쿡��?>
			<? if ($LowerIdx) { ?>
			<a href="javascript:moveDownMenu(<?=$idx?>);" class="btn_bgBlue">��</a>
			<? } ?>
			<? if ($UpperIdx){ ?>
			<a href="javascript:moveUpMenu(<?=$idx?>);" class="btn_bgBlue">�� </a>
			<? } ?>
		<?}?>

		<!-- a href="<?= $pageUrl ?>&page=/pages/admin/menu/menuList.php&parentIdx=<?= $parentIdx ?>&searchCategoryIdx=<?= $searchCategoryIdx ?>" class="btn_bgBlue">���</a -->
	</div>
	
	<input type="hidden" id="idx" name="idx" value="<?= $idx ?>" />
	<input type="hidden" id="parentIdx" name="parentIdx" value="<?= $parentIdx ?>" />
	<input type="hidden" id="searchCategoryIdx" name="searchCategoryIdx" value="<?= $searchCategoryIdx ?>" />
</form>