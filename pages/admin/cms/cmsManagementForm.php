<?php
	/* cms 입력, 수정 폼 페이지
	* 2011 01 25
	* kimna
	*/

	//받아오는 파라미터
	//$pageUrl, $processUrl, $SiteCode, $idx, $pageIdx, $searchCategoryIdx,
	//$listcount, $searchKeyword, $orderByColumn, $isOrderByAsc

	include("../../config/stringBuffer.inc.php"); 
	include("../../config/mysql.inc.php");
	include("../../config/webConfig.inc.php");
	include("../../config/comm.inc.php");
	include("../../config/stringUtils.inc.php");
	include("../../query/cms/cmsQuery.php");
	include("../../query/menu/menuQuery.php");

	$SiteCode = $_REQUEST["SiteCode"];
	$idx = $_REQUEST["idx"];
	$pageIdx = $_REQUEST["pageIdx"];
	$searchCategoryIdx = $_REQUEST["searchCategoryIdx"];
	$listcount = $_REQUEST["listcount"];
	$searchKeyword = $_REQUEST["searchKeyword"];
	$orderByColumn = $_REQUEST["orderByColumn"];
	$isOrderByAsc = $_REQUEST["isOrderByAsc"];

	$SiteCode = getParameter($site_code, "505000000");

	$sbSiteList = new stringBuffer;
	$sSiteList = "";

	$isEdit = false;

	//파라미터 빌더 세팅
	$listParameter = "pageIdx=".$pageIdx."&searchCategoryIdx=".$searchCategoryIdx."&listCount=".$listCount."&searchKeyword=".$searchKeyword."&orderByColumn=".$orderByColumn."&isOrderByAsc=".$isOrderByAsc;

	//사이트 목록을 가져온다.
	$siteList = getSiteList();

	//전체 카테고리를 가져온다.
	$allCmsCategoryList = getAllCmsCategoryList($SiteCode);
	$allCmsCategoryListCount = mysql_num_rows($allCmsCategoryList);
		
	//수정일 경우
	if( $idx > 0 ){

		//수정이면 listParameter 에 idx 값 추가
		$listParameter = $listParameter."&idx=".$idx;
	
		$isEdit = true;

		$cmsManagementRow = getCmsManagementRow($idx);

		// 해당 관리 정보가 존재하지 않을 경우
		if(!$cmsManagementRow){
			//message("해당 Content가 존재하지 않습니다.");
		}else{
			//미리 결과값을 배열에 담는다.
			$cmsManagementResult = mysql_fetch_array($cmsManagementRow);
		}

		/*
			CMS 파일 존재 여부 확인하여 
			해당 Content 파일이 유효하지 않다면 null로 세팅한다.
		*/		

	}
?>
<link rel="stylesheet" href="/js/yui_2_3/fonts/fonts-min.css" type="text/css" media="all" />
<link rel="stylesheet" href="/js/yui_2_3/button/assets/skins/sam/button.css" type="text/css" media="all" />
<link rel="stylesheet" href="/js/yui_2_3/container/assets/skins/sam/container.css" type="text/css" media="all" />
<script type="text/javascript" src="/js/yui_2_3/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="/js/yui_2_3/dragdrop/dragdrop-min.js" ></script>
<script type="text/javascript" src="/js/yui_2_3/utilities/utilities.js" ></script>
<script type="text/javascript" src="/js/yui_2_3/button/button-beta-min.js" ></script>
<script type="text/javascript" src="/js/yui_2_3/container/container-min.js"></script>
<script type="text/javascript">
<!--
	YAHOO.namespace("cms");
	
	YAHOO.cms.init = function() {
		var submitMemoHandler = function() {
			updateCmsManagement(2, $F('memoForm'));
		};
		
		var cancelMemoHandler = function() {
			YAHOO.cms.memoDialog.hide();
		};
		
		YAHOO.cms.memoDialog = new YAHOO.widget.Dialog("memoDialog", 
			{
				width : "300px",
				fixedcenter : true,
				visible : false,
				modal : true,
				constraintoviewport : true,
				buttons : [
					{ text:"확인", handler:submitMemoHandler, isDefault:true },
					{ text:"취소", handler:cancelMemoHandler }
				]
			}
		);
		
		YAHOO.cms.memoDialog.render(document.body);
	}
	
	YAHOO.util.Event.onDOMReady(YAHOO.cms.init);

	// UploadType 이 변경될 때 호출되는 함수.
	function changeUploadType(type) {
		// text
		if (type == "text") {
			$("textTr").style.display = "";
			$("fileTr").style.display = "none";
			$("contentFileCharset").style.display = "none";
		}
		// file
		else {
			$("textTr").style.display = "none";
			$("fileTr").style.display = "";
			$("contentFileCharset").style.display = "";
		}
	}
	
	// 현재 값을 저장/변경할 때 호출되는 함수.
	function updateCmsManagement(step, memo) {
		var cmsManagementForm = $("cmsManagementForm");
		
		if ($F("title").blank()) {
			alert("제목을 입력해주세요.");
			$("title").focus();
			
			return false;
		}
		
		// 내용 첨부파일로 입력
		if ($RF("uploadType") == "file") {
			if ($F("contentFile").blank()) {
				alert("업로드할 파일을 선택해주세요.");
				
				return false;
			}
		}

		if (step == 1) {
			YAHOO.cms.memoDialog.show();
			return false;
		}
		
		$("memo").value = memo;

		cmsManagementForm.action = "<?= $processUrl ?>&page=/pages/admin/cms/cmsManagementUpdate.php";
		return true;
		//cmsManagementForm.submit();
	}
	
	// 이전 콘텐츠에 대한 내용이 팝업으로 뜬다.
	function beforeContentPopup() {
		window.open("/pages/admin/cms/cmsBeforeContentList.php?managementIdx=<?= $idx ?>", "cmsBeforeContentPopup", "width=637,height=500,top=100,left=100,scrollbars=yes,resizable=no");
	}
	
	// 권한관리 페이지를 띄운다.
	function authorityManagementPopup() {
		window.open("/pages/admin/cms/cmsAuthorityUpdateForm.php?managementIdx=<?= $idx ?>", "cmsAuthorityManagementPopup", "width=537,height=500,top=100,left=100,scrollbars=yes,resizable=no");
	}
	
	// CMS 삭제시 호출되는 함수
	function deleteManagement() {
		if (!confirm("정말 삭제하시겠습니까?")) { 
			return;
		}
		
		document.location.href = "<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementDelete.php&<?= $listParameter."&site_code=".$SiteCode?>";
	}
//-->
</script>

<p class="contTitle">CMS 등록</p>


<form id="cmsManagementForm" name="cmsManagementForm" onsubmit="return updateCmsManagement();" method="post" style="margin:0px;" enctype="multipart/form-data">
	<table class="bbsCont" cellspacing="0" summary="메뉴 등록 폼">
		<colgroup>
			<col width="120" />
			<col />
		</colgroup>
		<tbody>	
			<tr>
				<th><label for="site_code">* 사이트구분</label></th>
				<td class="tal">
<?
		// Site 목록 HTML Option Value 값
		if ($siteList != ""){
			while($row = mysql_fetch_array($siteList)){
				if($SiteCode == $row[site_code]) echo utf8ToEuckr($row[title]);
			}
		}
?>
			<input type="hidden" id="site_code" name="site_code" value="<?=$SiteCode?>" />
			</td>
			</tr>

			<tr>
			<th><label for="categoryIdx">* 분류</label></th>
			<td class="tal">
				<select id="categoryIdx" name="categoryIdx">
					<option value="">없음</option>
<?
	if ($allCmsCategoryList && $allCmsCategoryListCount > 0){
		while($row = mysql_fetch_array($allCmsCategoryList)){
?>
			<option value="<?=$row[idx]?>" <?if($isEdit && $cmsManagementResult[category_idx] == $row[idx]){echo "selected";}?>> <?=utf8ToEuckr($row[title])?>
			</option>
<?
		}
	}
?>
				</select>
			</td>
			</tr>

			<tr>
			<th><label for="title">* 제목</label></th>
			<td class="tal">
				<input type="text" id="title" name="title" value="<? if ($isEdit) { ?><?=utf8ToEuckr($cmsManagementResult[management_title])?><?}?>" style="width:400;" maxlength="50" class="basic"/>
			</td>
			</tr>

			<tr>
			<th><label for="description">설명</label></th>
			<td class="tal">
				<textarea id="description" name="description" cols="45" rows="5" style="width:100%; height:200;"><? if ($isEdit) { echo "$cmsManagementResult[management_description]"; } ?></textarea>
			</td>
			</tr>

			<tr>
			<th><label for="useFlag">사용여부</label></th>
			<td class="tal">
				<label for="useFlagYes"><input type="radio" id="useFlagYes" name="useFlag" value="Y" <?if($isEdit){?> <?if($cmsManagementResult[management_use_flag] == "Y"){?>checked<?}}else{?>checked<?}?> /> 사용
				</label>
				&nbsp;
				<label for="useFlagNo"><input type="radio" id="useFlagNo" name="useFlag" value="N"<?if($isEdit){?> <?if($cmsManagementResult[management_use_flag] != "Y"){?>checked<?}}?> /> 사용 안함</label> 
			</td>
			</tr>

			<tr>
			<th><label for="uploadType">내용 업로드 방식</label></th>
			<td class="tal">
				<label for="uploadTypeText"><input type="radio" id="uploadTypeText" name="uploadType" value="text" onclick="changeUploadType('text');" checked /> HTML</label>
				&nbsp;
				<label for="uploadTypeFile"><input type="radio" id="uploadTypeFile" name="uploadType" value="file" onclick="changeUploadType('file');" /> FILE</label> 
			</td>
			</tr>

			<tr id="textTr">
			<th><label for="uploadType">HTML 내용</label></th>
			<td class="tal">
				<!--
						kimna 수정 할것.
				-->
				<textarea id="contentText" name="contentText" cols="45" rows="5" style="width:100%; height:480;"><?if($isEdit){
						//기존 파일이 있을 경우
						if(file_exists($cmsContentsPagesPath."/".$idx.".php")){
							//파일을 읽는다.
							$readFile = fopen($cmsContentsPagesPath."/".$idx.".php", "r");
							//읽은 파일의 내용을 변수에 담는다.
							while(!feof($readFile)){
								$fileContents .= fgets($readFile);
							}
							fclose($readFile);
							echo escapeHtml($fileContents);
						};
					}?></textarea>
<?
	if ($isEdit) {
?>				<!--
				<div align="right">
					<a href="javascript:beforeContentPopup();" title="이전 콘텐츠 보기">
					<img src="/pages/admin/images/bbs/btn_precontents.gif" alt="이전 콘텐츠 보기" />
					</a>
				</div>
				-->
<?
	}
?>
			</td>
			</tr>
			<tr id="fileTr" style="display:none;">
			<th><label for="uploadType">File Upload</label></th>
			<td class="tal">
				<!--<select id="contentFileCharset" name="contentFileCharset">
					<option value="">기본 (<?//= webConfig.getSystemDefaultCharset() ?>)</option>
					<option value="EUC-KR">일반 파일 (EUC-KR)</option>
					<option value="MS949">일반 파일 (MS949)</option>
				</select>-->
				<input type="file" id="contentFile" name="contentFile" style="width:400;" class="basic" />
<?
	if ($isEdit) {
?>
				<div align="right">
					<a href="javascript:beforeContentPopup();">
					<img src="/pages/admin/images/bbs/btn_precontents.gif" alt="이전 콘텐츠 보기" />
					</a>
				</div>
<?
	}
?>
			</td>
			</tr>
		</tbody>
		<tfoot>

			<tr>
			<td colspan="2">
				<input type="image" src="/pages/admin/images/bbs/btn_save_big.gif" value="저장" alt="저장" />
<?
	// 수정일 때만 삭제 가능.
	if ($isEdit) {
?>
				<a href="javascript:deleteManagement();">
					<img src="/pages/admin/images/bbs/btn_delete_big.gif" alt="삭제" />
				</a>
<?
	}
?>
				<a href="<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementList.php&<?= $listParameter?>">
					<img src="/pages/admin/images/bbs/btn_list_big.gif" alt="목록" />
				</a>
			</td>
			</tr>
		</tfoot>
	</table>
	
<?
	if ($isEdit) {
?>
	<input type="hidden" id="idx" name="idx" value="<?= $idx ?>" />
<?
	}
?>
	<input type="hidden" id="pageIdx" name="pageIdx" value="<?= $pageIdx ?>" />
	<input type="hidden" id="searchCategoryIdx" name="searchCategoryIdx" value="<?= $searchCategoryIdx ?>" />
	<input type="hidden" id="listCount" name="listCount" value="<?= $listCount ?>" />
	<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?= $searchKeyword ?>" />
	<input type="hidden" id="orderByColumn" name="orderByColumn" value="<?= $orderByColumn ?>" />
	<input type="hidden" id="isOrderByAsc" name="isOrderByAsc" value="<?= $isOrderByAsc ?>" />
	
	<input type="hidden" id="memo" name="memo" />
<?
	// 수정일시 checksum.
	if ($isEdit) {
?>
	<input type="hidden" id="orgChecksum" name="orgChecksum" value="<?=$cmsManagementResult[content_checksum]?>" />
<?
	}
?>
</form>

<div id="memoDialog" style="visibility:hidden;">
	<div>메모를 입력해주세요.</div>
	<div>
		CMS의 내용이 변경되어야만 저장됩니다.<br />
		<label for="memoForm">메모 : </label><input type="text" id="memoForm" name="memoForm" style="width:230px;" />
	</div>
</div>