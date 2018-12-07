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

	//수정일 경우
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

			//상위 메뉴에 대한 정보
			$UpperMenuArr = getUpperMenuRow($parentIdx, $code);
			$UpperRow = mysql_fetch_array(&$UpperMenuArr);
			$UpperIdx = $UpperRow[idx];
			$UpperCode = $UpperRow[code];

			$LowerMenuArr = getLowerMenuRow($parentIdx, $code);
			$LowerRow = mysql_fetch_array(&$LowerMenuArr);
			$LowerIdx = $LowerRow[idx];
			$LowerCode = $LowerRow[code];
			
			$childCount = getChildMenuCount($idx);

			//charger 에 관한게 들어가야함 kimna 차후 넣을 것.
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
			message_url("해당 메뉴가 존재하지 않습니다.", "menuList.php");
		}


		//상위 idx 가 있을 경우
		if($parentIdx > 0){
			// 부모메뉴 정보
			$pMenuArr = getMenuRow($parentIdx);
			if($pMenuArr){
				$row = mysql_fetch_array($pMenuArr);
				$SiteCode = $row[menu_site_code];
				$Sitegroup = $row[menu_site_group];
				
				//menuHistoryList 보완 해야함 kimna
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
<title>CMS 추가 팝업</title>
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
	
	// 첨에 호출되는 함수
	function init() {
		
		$("title").focus();
	}

	// 링크타입이 변경될 때 호출되는 함수
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
	
	// CMS를 등록할 수 있는 list 팝업을 띄운다.
	function appendCmsPopup() {

		window.open("/pages/admin/menu/cmsAppendList.php?site_code=<?=$SiteCode?>", "cmsAppendPopup", "width=937,height=650,top=100,left=100,scrollbars=yes,resizable=no");
	}
	
	// CMS 데이터를 추가하는 함수.
	function appendCmsData(appendCmsDataList) {
		var cmsListTable = $("cmsListTable");
	
		for (var i = 0; i < appendCmsDataList.length; i++) {			
			if (cmsDataList[appendCmsDataList[i].idx + ""] == null) {
				// 등록된 CMS가 없다는 메세지 삭제
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
				newCell.innerHTML = "<a href=\"javascript:cmsManagementPopup(" + appendCmsDataList[i].idx + ");\" title=\"" + appendCmsDataList[i].title + " 콘텐츠 수정\">" + appendCmsDataList[i].title + "</a>";
				newCell.innerHTML += "<input type=\"hidden\" id=\"cmsIdx\" name=\"cmsIdx\" value=\"" + appendCmsDataList[i].idx + "\" />";
				
				newCell = newRow.insertCell(2);
				newCell.innerHTML = "<input type=\"radio\" id=\"cmsDefaultIdx\" name=\"cmsDefaultIdx\" value=\"" + appendCmsDataList[i].idx + "\" />";
				
				newCell = newRow.insertCell(3);
				newCell.innerHTML = "<a href=\"/open_content/sub.php?menuIdx=<?= $idx ?>&page=/contents/pages/" + appendCmsDataList[i].idx + ".php\" target=\"_blank\" class=\"btn_bgBlue\" title=\"" + appendCmsDataList[i].title + " 콘텐츠 미리보기\">미리보기</a> ";
				
				newCell.innerHTML += "<a href=\"javascript:deleteCmsData(" + appendCmsDataList[i].idx + ");\" class=\"btn_bgBlue\" title=\"CMS 삭제\">삭제</a>";
				
				newRow = cmsListTable.insertRow(cmsListTable.rows.length);
				newCell = newRow.insertCell(0);
				newCell.colSpan = "4";
				newCell.bgColor = "#e1e1e1";
				newCell.height = "1";
				
				cmsDataList.dataLength++;
			}
		}
	}
	
	// CMS 데이터를 삭제하는 함수.
	function deleteCmsData(idx) {
		var cmsListTable = $("cmsListTable");
		cmsDataList[idx + ""];
		var tableRow = cmsDataList[idx + ""].tableRow;
		
		//cmsListTable.deleteRow(tableRow + 1);
		cmsListTable.deleteRow(tableRow);
		cmsDataList[idx + ""] = null;
		cmsDataList.dataLength--;
		
		// 삭제된 Row보다 큰 tableRow들에 -2을 해준다.
		cmsDataList.each(function(element, index) {
			if (element != null && element.tableRow > tableRow) {
				element.tableRow -= 2;
			}
		});
		
		// 추가된 CMS가 없을 때.
		if (cmsDataList.dataLength == 0) {
		/*	var newRow = cmsListTable.insertRow(cmsListTable.rows.length);
			var newCell = newRow.insertCell(0);
			newRow.height = "25";
			newRow.className = "tcpad";
			newRow.align = "center";
			newCell.colSpan = "4";
			newCell.innerHTML = "등록된 CMS가 없습니다.";
			
			newRow = cmsListTable.insertRow(cmsListTable.rows.length);
			newCell = newRow.insertCell(0);
			newCell.colSpan = "4";
			newCell.bgColor = "#e1e1e1";
			newCell.height = "1";
		*/
		}
	}
	
	// 입력된 키워드를 추가해주는 함수
	function addMatchKeyword() {
		var matchKeywords = $("matchKeywords").options;
		var matchKeyword = $F("matchKeyword");
		
		if (matchKeyword.blank()) {
			alert("추가할 키워드를 입력해주세요.");
			$("matchKeyword").focus();
			return;
		}
		
		var isAppend = true;
	
		// 이미 등록된게 있으면 패스한다.
		for (var i = 0; i < matchKeywords.length; i++) {
			if (matchKeyword == matchKeywords[i].value) {
				isAppend = false;
				break;
			}
		}
		
		if (!isAppend) {
			alert("이미 등록된 키워드입니다.");
			$("matchKeyword").focus();
			return;
		}
		
		matchKeywords[matchKeywords.length] = new Option(matchKeyword, matchKeyword);
		$("matchKeyword").value = "";
		$("matchKeyword").focus();
	}
	
	// 선택된 키워드를 삭제하는 함수.
	function deleteMatchKeyword() {
		var matchKeywords = $("matchKeywords");
		var selectedIdx = matchKeywords.selectedIndex;
		
		if (selectedIdx >= 0) {
			matchKeywords.options.remove(selectedIdx);
		}
	}
	
	// select 객체에 하나만 선택가능하게 하기 위해서
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
	
	// 메뉴 등록/수정 함수.
	function updateMenu() {
		var processUrl = parent.frmPnt.PROCESS_URL.value; 
		var pageUrl =  parent.frmPnt.PAGE_URL.value; 
		pageUrl += "메뉴관리";
		
		var menuForm = $("menuForm");
		//var matchKeywords = $("matchKeywords");
		
		if ($F("title").blank()) {
			alert("제목을 입력해주세요.");
			$("title").focus();
			return;
		}
		
		// Include, URL
		if ($F("linkType") == "<?= INCLUDE_LINK_TYPE ?>" || $F("linkType") == "<?= URL_LINK_TYPE ?>") {
		}
		// CMS
		else if ($F("linkType") == "<?= CMS_LINK_TYPE ?>") {
			if (cmsDataList.dataLength <= 0) {
				alert("최소 하나 이상의 Content를 등록해주세요.");
				return;
			} else if (!$RF("cmsDefaultIdx")) {
				alert("기본 콘텐츠를 선택해주세요.");
				return;
			}
		}
		// Javascript
		else {
			if ($F("javascriptLink").blank()) {
				alert("Javascript를 입력해주세요.");
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
	
	// 담당자를 선택할 수 있는 팝업을 띄운다.
	function menuChargePopup() {
		window.open("/pages/admin/menu/userPopList.php", "menuChargePopup", "width=537,height=500,top=100,left=100,scrollbars=yes,resizable=no");
	}
	
	function choiceCharge(chargeUserId, chargeUserName) {
		
		$("chargeUserSpan").innerHTML = chargeUserName;
		$("chargeUserId").value		= chargeUserId;
		$("chargeUserName").value	= chargeUserName;

	}
	
	// 담당 초기화 함수
	function resetCharge() {
		$("chargeUserSpan").innerHTML = "미지정";
		$("chargeUserId").value = " ";
	}
	
	// CMS 관리 팝업을 띄우는 함수.
	function cmsManagementPopup(idx) {
		window.open("/pages/admin/cms/cmsManagementPopupForm.php?site_code=<?=$SiteCode?>&amp;idx=" + idx, "cmsManagementPopup", "width=817,height=600,top=100,left=100,scrollbars=yes,resizable=no");
	}

	// 메뉴 삭제 함수
	function deleteMenu(idx) {
		var processUrl = parent.frmPnt.PROCESS_URL.value; 
		if (confirm("정말 삭제하시겠습니까?")) {
			parent.document.location.href = processUrl+"&page=/pages/admin/menu/menuDelete.php&amp;parentIdx=<?=$parentIdx?>&amp;idx=" + idx;
		}
	}
	function moveDownMenu(idx){
		//var processUrl = parent.frmPnt.PROCESS_URL.value;
		var pageUrl =  parent.frmPnt.PAGE_URL.value; 
		pageUrl += "메뉴관리";
		parent.document.location.href  = pageUrl+"&page=/pages/admin/menu/menuSortEdit.php&amp;nowIdx="+idx+"&amp;nowCode=<?= $code?>&amp;action=down&changeIdx=<?=$LowerIdx?>&changeCode=<?=$LowerCode?>";
	}
	function moveUpMenu(idx){
		//var processUrl = parent.frmPnt.PROCESS_URL.value; 
		var pageUrl =  parent.frmPnt.PAGE_URL.value; 
		pageUrl += "메뉴관리";
		parent.document.location.href  = pageUrl+"&page=/pages/admin/menu/menuSortEdit.php&amp;nowIdx="+idx+"&amp;nowCode=<?=$code?>&amp;action=up&changeIdx=<?=$UpperIdx?>&changeCode=<?=$UpperCode?>";
	}

//-->
</script>

<form id="menuForm" name="menuForm" action="javascript:updateMenu();" method="post"  style="margin:0px;">
<input type="hidden" id="site_code" name="site_code"  value="<?=$SiteCode?>">
<input type="hidden" id="site_group" name="site_group"  value="<?=$SiteGroup?>">

<table width="100%" height="26" cellpadding="0" cellspacing="0">
  <tr>
	<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> 메뉴 관리 - 
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
		
<table class="bbsCont" cellspacing="0" summary="메뉴 등록 폼">		
		<colgroup>
			<col width="15%" />
			<col width="35%" />
			<col width="12%" />
			<col width="38%" />
		</colgroup>
		<tbody>	
			<tr>
				<th><label for="title">* 메뉴명</label></th>
				<td colspan="3" class="tal">
					<input type="text" id="title" name="title" value="<? if ($isEdit) { echo $title; } ?>" class="basic" style="width:200px;" maxlength="100" />
				</td>
			</tr>
			<tr>
				<th><label for="division">구분코드</label></th>
				<td class="tal">
					<input type="text" id="division" name="division" value="<? if ($isEdit) { echo $division; } ?>" class="basic" style="width:200px;" maxlength="30" />
				</td>
				<th><label for="useFlag">담당자</label></th>
				<td class="tal">

					이름 :<input type="text" name="chargeUserName" id="chargeUserName" class="basic"  style="width:100px;" value="관리자"/>&nbsp;
					<input type="hidden" name="chargeUserTel" id="chargeUserTel" value="0000000000"/>

					<!--<a href="javascript:menuChargePopup();" class="btn_bgBlue" title="담당자 찾기">
						<img src="/pages/admin/images/bbs/btn_find.gif" alt="찾기" />
					</a>-->

				</td>
			</tr>
			<tr>
				<th><label for="linkType">* 링크타입</label></th>
				<td class="tal">
					<select id="linkType" name="linkType" onchange="changeLinkType();" class="basic">
						<option value="<?= INCLUDE_LINK_TYPE ?>"<?= $isEdit && INCLUDE_LINK_TYPE == $linkType ? " selected" : "" ?>><?=INCLUDE_LINK_TYPE_STR?></option>
						<option value="<?= CMS_LINK_TYPE ?>"<?= $isEdit && CMS_LINK_TYPE == $linkType ? " selected" : "" ?>><?= CMS_LINK_TYPE_STR ?></option>
						<option value="<?= URL_LINK_TYPE ?>"<?= $isEdit && URL_LINK_TYPE == $linkType ? " selected" : "" ?>><?= URL_LINK_TYPE_STR ?></option>
						<option value="<?= JAVASCRIPT_LINK_TYPE ?>"<?= $isEdit && JAVASCRIPT_LINK_TYPE == $linkType ? " selected" : "" ?>><?= JAVASCRIPT_LINK_TYPE_STR ?></option>
					</select>
				</td>
			<th><label for="useFlag">* 사용여부</label></th>
			<td class="tal">
				<select id="useFlag" name="useFlag" onchange="changeLinkType();" class="basic">
					<option value="Y" <?= $isEdit ? (("Y" == $useFlag ) ? " selected" : " ") : " selected" ?> /> 사용</option>
					<option value="N" <?= $isEdit ? (("N" == $useFlag ) ? " selected" : " ") : "" ?> /> 사용 안함</option> 
					<option value="U" <?= $isEdit ? (("U" == $useFlag ) ? " selected" : " ") : "" ?> /> 표시 안함</option> 
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
				<table class="bbsCont" cellspacing="0" summary="CMS 리스트" >
					<caption>
						CMS 리스트
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
							<th>콘텐츠 명</th>
							<th>기본</th>
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
							<!--<a href="javascript:cmsManagementPopup(<?=$row[idx] ?>);" title="<?= $row[title] ?> 콘텐츠 수정"><?=$row[title]?></a>-->
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
							<a href="/open_content/sub.php?menuIdx=<?= $idx ?>&amp;page=/contents/pages/<?=$row[idx] ?>.php" target="_blank" class="btn_bgBlue" title="<?=utf8ToEuckr($row[title]) ?> 콘텐츠 미리보기">
							<img src="/pages/admin/images/bbs/btn_preview.gif" alt="미리보기" />
							</a>
							<!--
							<a href="javascript:cmsManagementPopup(<?=$row[idx]?>);" class="btn_bgBlue" title="<?=$row[title] ?> 콘텐츠 수정">
							<img src="/pages/admin/images/bbs/btn_modify.gif" alt="수정" />
							</a>-->
							<a href="javascript:deleteCmsData(<?= $row[idx] ?>);" class="btn_bgBlue" title="CMS 삭제">
							<img src="/pages/admin/images/bbs/btn_delete.gif" alt="삭제" />
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
						<img src="/pages/admin/images/bbs/btn_add.gif" alt="추가" />
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
		<img src="/pages/admin/images/bbs/btn_ok_big.gif" alt="저장" />
		</a>
		<a href="javascript:deleteMenu(<?=$idx?>);" class="btn_bgBlue">
			<img src="/pages/admin/images/bbs/btn_delete_big.gif" alt="삭제" />
		</a>

		<?if($childCount < 1){ //하위 메뉴가 없을 경우에만?>
			<? if ($LowerIdx) { ?>
			<a href="javascript:moveDownMenu(<?=$idx?>);" class="btn_bgBlue">▼</a>
			<? } ?>
			<? if ($UpperIdx){ ?>
			<a href="javascript:moveUpMenu(<?=$idx?>);" class="btn_bgBlue">▲ </a>
			<? } ?>
		<?}?>

		<!-- a href="<?= $pageUrl ?>&page=/pages/admin/menu/menuList.php&parentIdx=<?= $parentIdx ?>&searchCategoryIdx=<?= $searchCategoryIdx ?>" class="btn_bgBlue">목록</a -->
	</div>
	
	<input type="hidden" id="idx" name="idx" value="<?= $idx ?>" />
	<input type="hidden" id="parentIdx" name="parentIdx" value="<?= $parentIdx ?>" />
	<input type="hidden" id="searchCategoryIdx" name="searchCategoryIdx" value="<?= $searchCategoryIdx ?>" />
</form>