<?php
	/* cms �Է�, ���� �� ������
	* 2011 01 25
	* kimna
	*/

	//�޾ƿ��� �Ķ����
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

	//�Ķ���� ���� ����
	$listParameter = "pageIdx=".$pageIdx."&searchCategoryIdx=".$searchCategoryIdx."&listCount=".$listCount."&searchKeyword=".$searchKeyword."&orderByColumn=".$orderByColumn."&isOrderByAsc=".$isOrderByAsc;

	//����Ʈ ����� �����´�.
	$siteList = getSiteList();

	//��ü ī�װ��� �����´�.
	$allCmsCategoryList = getAllCmsCategoryList($SiteCode);
	$allCmsCategoryListCount = mysql_num_rows($allCmsCategoryList);
		
	//������ ���
	if( $idx > 0 ){

		//�����̸� listParameter �� idx �� �߰�
		$listParameter = $listParameter."&idx=".$idx;
	
		$isEdit = true;

		$cmsManagementRow = getCmsManagementRow($idx);

		// �ش� ���� ������ �������� ���� ���
		if(!$cmsManagementRow){
			//message("�ش� Content�� �������� �ʽ��ϴ�.");
		}else{
			//�̸� ������� �迭�� ��´�.
			$cmsManagementResult = mysql_fetch_array($cmsManagementRow);
		}

		/*
			CMS ���� ���� ���� Ȯ���Ͽ� 
			�ش� Content ������ ��ȿ���� �ʴٸ� null�� �����Ѵ�.
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
					{ text:"Ȯ��", handler:submitMemoHandler, isDefault:true },
					{ text:"���", handler:cancelMemoHandler }
				]
			}
		);
		
		YAHOO.cms.memoDialog.render(document.body);
	}
	
	YAHOO.util.Event.onDOMReady(YAHOO.cms.init);

	// UploadType �� ����� �� ȣ��Ǵ� �Լ�.
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
	
	// ���� ���� ����/������ �� ȣ��Ǵ� �Լ�.
	function updateCmsManagement(step, memo) {
		var cmsManagementForm = $("cmsManagementForm");
		
		if ($F("title").blank()) {
			alert("������ �Է����ּ���.");
			$("title").focus();
			
			return false;
		}
		
		// ���� ÷�����Ϸ� �Է�
		if ($RF("uploadType") == "file") {
			if ($F("contentFile").blank()) {
				alert("���ε��� ������ �������ּ���.");
				
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
	
	// ���� �������� ���� ������ �˾����� ���.
	function beforeContentPopup() {
		window.open("/pages/admin/cms/cmsBeforeContentList.php?managementIdx=<?= $idx ?>", "cmsBeforeContentPopup", "width=637,height=500,top=100,left=100,scrollbars=yes,resizable=no");
	}
	
	// ���Ѱ��� �������� ����.
	function authorityManagementPopup() {
		window.open("/pages/admin/cms/cmsAuthorityUpdateForm.php?managementIdx=<?= $idx ?>", "cmsAuthorityManagementPopup", "width=537,height=500,top=100,left=100,scrollbars=yes,resizable=no");
	}
	
	// CMS ������ ȣ��Ǵ� �Լ�
	function deleteManagement() {
		if (!confirm("���� �����Ͻðڽ��ϱ�?")) { 
			return;
		}
		
		document.location.href = "<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementDelete.php&<?= $listParameter."&site_code=".$SiteCode?>";
	}
//-->
</script>

<p class="contTitle">CMS ���</p>


<form id="cmsManagementForm" name="cmsManagementForm" onsubmit="return updateCmsManagement();" method="post" style="margin:0px;" enctype="multipart/form-data">
	<table class="bbsCont" cellspacing="0" summary="�޴� ��� ��">
		<colgroup>
			<col width="120" />
			<col />
		</colgroup>
		<tbody>	
			<tr>
				<th><label for="site_code">* ����Ʈ����</label></th>
				<td class="tal">
<?
		// Site ��� HTML Option Value ��
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
			<th><label for="categoryIdx">* �з�</label></th>
			<td class="tal">
				<select id="categoryIdx" name="categoryIdx">
					<option value="">����</option>
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
			<th><label for="title">* ����</label></th>
			<td class="tal">
				<input type="text" id="title" name="title" value="<? if ($isEdit) { ?><?=utf8ToEuckr($cmsManagementResult[management_title])?><?}?>" style="width:400;" maxlength="50" class="basic"/>
			</td>
			</tr>

			<tr>
			<th><label for="description">����</label></th>
			<td class="tal">
				<textarea id="description" name="description" cols="45" rows="5" style="width:100%; height:200;"><? if ($isEdit) { echo "$cmsManagementResult[management_description]"; } ?></textarea>
			</td>
			</tr>

			<tr>
			<th><label for="useFlag">��뿩��</label></th>
			<td class="tal">
				<label for="useFlagYes"><input type="radio" id="useFlagYes" name="useFlag" value="Y" <?if($isEdit){?> <?if($cmsManagementResult[management_use_flag] == "Y"){?>checked<?}}else{?>checked<?}?> /> ���
				</label>
				&nbsp;
				<label for="useFlagNo"><input type="radio" id="useFlagNo" name="useFlag" value="N"<?if($isEdit){?> <?if($cmsManagementResult[management_use_flag] != "Y"){?>checked<?}}?> /> ��� ����</label> 
			</td>
			</tr>

			<tr>
			<th><label for="uploadType">���� ���ε� ���</label></th>
			<td class="tal">
				<label for="uploadTypeText"><input type="radio" id="uploadTypeText" name="uploadType" value="text" onclick="changeUploadType('text');" checked /> HTML</label>
				&nbsp;
				<label for="uploadTypeFile"><input type="radio" id="uploadTypeFile" name="uploadType" value="file" onclick="changeUploadType('file');" /> FILE</label> 
			</td>
			</tr>

			<tr id="textTr">
			<th><label for="uploadType">HTML ����</label></th>
			<td class="tal">
				<!--
						kimna ���� �Ұ�.
				-->
				<textarea id="contentText" name="contentText" cols="45" rows="5" style="width:100%; height:480;"><?if($isEdit){
						//���� ������ ���� ���
						if(file_exists($cmsContentsPagesPath."/".$idx.".php")){
							//������ �д´�.
							$readFile = fopen($cmsContentsPagesPath."/".$idx.".php", "r");
							//���� ������ ������ ������ ��´�.
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
					<a href="javascript:beforeContentPopup();" title="���� ������ ����">
					<img src="/pages/admin/images/bbs/btn_precontents.gif" alt="���� ������ ����" />
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
					<option value="">�⺻ (<?//= webConfig.getSystemDefaultCharset() ?>)</option>
					<option value="EUC-KR">�Ϲ� ���� (EUC-KR)</option>
					<option value="MS949">�Ϲ� ���� (MS949)</option>
				</select>-->
				<input type="file" id="contentFile" name="contentFile" style="width:400;" class="basic" />
<?
	if ($isEdit) {
?>
				<div align="right">
					<a href="javascript:beforeContentPopup();">
					<img src="/pages/admin/images/bbs/btn_precontents.gif" alt="���� ������ ����" />
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
				<input type="image" src="/pages/admin/images/bbs/btn_save_big.gif" value="����" alt="����" />
<?
	// ������ ���� ���� ����.
	if ($isEdit) {
?>
				<a href="javascript:deleteManagement();">
					<img src="/pages/admin/images/bbs/btn_delete_big.gif" alt="����" />
				</a>
<?
	}
?>
				<a href="<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementList.php&<?= $listParameter?>">
					<img src="/pages/admin/images/bbs/btn_list_big.gif" alt="���" />
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
	// �����Ͻ� checksum.
	if ($isEdit) {
?>
	<input type="hidden" id="orgChecksum" name="orgChecksum" value="<?=$cmsManagementResult[content_checksum]?>" />
<?
	}
?>
</form>

<div id="memoDialog" style="visibility:hidden;">
	<div>�޸� �Է����ּ���.</div>
	<div>
		CMS�� ������ ����Ǿ�߸� ����˴ϴ�.<br />
		<label for="memoForm">�޸� : </label><input type="text" id="memoForm" name="memoForm" style="width:230px;" />
	</div>
</div>