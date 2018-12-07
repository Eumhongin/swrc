<?php
	include("../admin_security.php");
	include("../../../config/stringBuffer.inc.php"); 
	include("../../../config/mysql.inc.php");
	include("../../../config/request.inc.php");
	include("../../../query/menu/menuQuery.php");
	include("../../../query/cms/cmsQuery.php");

	$SiteCode = getParameter($site_code, "505000000");
	$sbSiteList = new stringBuffer;
	$sSiteList = "";

	$urlInfo = $pageUrl."$amp;page=";

	$siteList = getSiteList();
	
	//$sbSiteList �� Site ���� ��´�.
	if($siteList){
		while($row = mysql_fetch_array($siteList)){		
			if($SiteCode == $row[site_code]){
				$sbSiteList->append("<option value=\"".$row[site_code]."\" selected>".utf8ToEuckr($row[title])."\n");
			}else{
				$sbSiteList->append("<option value=\"".$row[site_code]."\">".utf8ToEuckr($row[title])."\n");
			}
		}
	}

	$sSiteList = $sbSiteList->getStringValue();

	//��ü ī�װ��� �����´�.
	$allCmsCategoryList = getAllCmsCategoryList($SiteCode);
	$allCmsCategoryListCount = mysql_num_rows($allCmsCategoryList);

	//�˻� ������ ����Ʈ ������ �����´�.
	$searchCount = getCmsManagementCount($searchCategoryIdx, $searchKeyword, $SiteCode);

	if($searchCount > 0){
		$cmsManagementList = getCmsManagementList($pageIdx, $listCount, $searchCount, $searchCategoryIdx, $searchKeyword, $orderByColumn, $isOrderByAsc, $SiteCode);
	}

	$listParameter = "pageIdx=".$pageIdx."&searchCategoryIdx=".$searchCategoryIdx."&listCount=".$listCount."&searchKeyword=".$searchKeyword."&orderByColumn=".$orderByColumn."&isOrderByAsc=".$isOrderByAsc;

	$FormParameter = "pageIdx=".$pageIdx."&searchCategoryIdx=".$searchCategoryIdx."&listCount=".$listCount."&searchKeyword=".$searchKeyword."&orderByColumn=".$orderByColumn."&isOrderByAsc=".$isOrderByAsc."&site_code=".$SiteCode;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>CMS �߰� �˾�</title>
<link rel="stylesheet" type="text/css" href="/pages/admin/css/admin_common.css"/>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<script type="text/javascript" src="/js/common.js"></script>
<script type="text/javascript" src="/js/prototype.js"></script>
<script type="text/javascript">
<!--
	var cmsDataList = new Array();

	// ���ǥ�� ���� ����
	function listCount() {
		document.location.href = "/pages/admin/menu/cmsAppendList.php?<?= $listParameter?>";
	}

	// ���ǥ�� ����Ʈ���к���
	function listChange(site_code) {
		document.location.href = "/pages/admin/menu/cmsAppendList.php?<%= $listParameter?>";
	}
	
	// Ű���� �˻�
	function cmsManagementKeywordSearch() {
		var cmsManagementSearchForm = $("cmsManagementSearchForm");
		
		if ($F("searchKeyword").blank()) {
			alert("�˻�� �Է����ּ���.");
			$("searchKeyword").focus();
			return;
		}
		
		cmsManagementSearchForm.action = "/pages/admin/menu/cmsAppendList.php?<?=$frmParameter?>"
		cmsManagementSearchForm.submit();
	}
	
	// CMS �߰��ϴ� �Լ�
	function appendCms() {
		var appendIdxs = $("cmsManagementListForm").getInputs("checkbox", "appendIdx");
		
		//2�� �̻� �߰� ���� ���ϰ�..
		if(opener.cmsDataList.dataLength >= 1){
			alert("�̹� ��ϵ� �������� �ֽ��ϴ�.");
			window.close();
		}else{

			if (appendIdxs) {
				var appendCmsDataList = new Array();
				
				for (var i = 0; i < appendIdxs.length; i++) {
					if (appendIdxs[i].checked) {
						appendCmsDataList[appendCmsDataList.length] = cmsDataList[appendIdxs[i].value];
					}
				}

				try {
					opener.appendCmsData(appendCmsDataList);
				} catch (e) {
					alert("Opener ��ü�� �ݱ�ų�, ������ �̵����� ó���� �Ϸ��� �� �����ϴ�.");
					window.close();
					return;
				}
				
				alert("Content�� �߰��Ͽ����ϴ�.");
				window.close();
			}
		}
	}
//-->
</script>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
	<td><img src="/pages/admin/images/common/bullet_box_gray.gif" /> CMS �߰� �˾�</td>
  </tr>
</table>

<table class="bbsCont" cellspacing="0" summary="CMS �з� ����">
		<tr>
		<td width="20">&nbsp;</td>		
<?
			if ($allCmsCategoryList) {
		
					while($row = mysql_fetch_array($allCmsCategoryList)){
?>
		<td width="150" valign="top">
		<ul>
<?
	//5���� ©���� ����.					
						if ($row[idx] == $searchCategoryIdx) {
?>
				<li><?= utf8ToEuckr($row[title]) ?></li>
<?
						} else {
?>
				<li><a href="/pages/admin/menu/cmsAppendList.php?site_code=<?=$SiteCode?>&searchCategoryIdx=<?= $row[idx] ?>" title="<?= utf8ToEuckr($row[title]) ?> �з��� �˻�"><?= utf8ToEuckr($row[title]) ?></a></li>
<?
						}
?>
		</ul>
		</td>
<?
					}

			} else {
					echo "&nbsp;";
			}
?>
	
	</tr>
	<!-- tr>	
	<td align="right" colspan="6">[<a href="javascript:cmsCategoryManagementPopup();">�з�����</a>] &nbsp; </td>	
	</tr -->
</table>

<br style="height:20px" />

<form id="cmsManagementListForm" name="cmsManagementListForm" method="get" style="margin:0px;">
<table class="bbsCont" cellspacing="0">
	<caption style="text-align:right">
	<select id="site_code" name="site_code" onchange="javascript:listChange(this.value)">
	<?=$sSiteList?>
	</select>
		CMS �߰� �˾� - ���� <?= $pageIdx ?> / ��ü  &nbsp;
		<select name="viewListCount" onchange="listCount();" style="vertical-align:middle;">
<?for ($i = 10; $i <= 100; $i += 10) {?>
		<option value="<?= $i ?>"<?= $i == $listCount ? " selected" : "" ?>><?= $i ?> ��</option>
<?}?>
		</select> &nbsp;
	</caption>
	<colgroup>
	<col width="60" />
	<col width="140" />
	<col width="260" />
	<col />
	<col width="80" />
	<col width="80" />
	<col width="120" />
	<col width="60" />
	</colgroup>
	<thead>
		<tr>
		<th>Key</th>
		<th>�з�</th>
		<th>CMS ��</th>
		<th>�����Ͽ���</th>
		<th>CMS ũ��</th>
		<th>��뿩��</th>
		<th>�����</th>
		<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>

<?
	// ����Ʈ�� ���� ���
	if ($searchCount > 0) {
		
		$no = $searchCount;

		/*for (int i = 0; i < cmsManagementList.size(); i++) {
			cmsManagementBean = (CmsManagementBean)cmsManagementList.get(i);
			cmsContentBean = cmsManagementBean.getCmsContentBean();
			tempCmsCategoryBean = cmsManagementBean.getCmsCategoryBean();
*/
		if($cmsManagementList){
			while($row = mysql_fetch_array($cmsManagementList)){

?>
	<tr align="center">
		<td align="left">
			&nbsp;<input type="checkbox" id="appendIdx<?= $row[management_idx] ?>" name="appendIdx" value="<?= $row[management_idx] ?>" />
			<label for="appendIdx<?= $row[management_idx] ?>"><?=$row[management_idx]?></label>			
			<script language="javascript" type="text/javascript">
			<!--
				cmsDataList["<?= $row[management_idx]?>"] = {
					idx : <?= $row[management_idx]?>,
					title : "<?=htmlspecialchars( stripslashes($row[management_title]) )?>",
					description : "<?//= htmlspecialchars($row[management_description])?>",
					useFlag : "<?=$row[management_use_flag]?>"
				}
			//-->
			</script>
		</td>
			<td><?=utf8ToEuckr($row[category_title]) != "" ? utf8ToEuckr($row[category_title]) : "����" ?></td>
			<td align="left"><?= utf8ToEuckr($row[management_title]) ?></td>			
			<td align="left"><?=$row[management_description] != "" ? "���" : "�̵��"  ?></td>
			<td ><?= $row[content_length] ?></td>
			<td>
				<?if($row[management_use_flag] == "Y"){?>
					���
				<?}else{?>
					��� ����
				<?}?>
			</td>
			<td><?=$row[management_write_date]?></td>
			<td>[<a href="/pages/admin/cms/cmsContentPreView.php?idx=<?=$row[content_idx] ?>" title="Content ����" target="_blank">����</a>]</td>
		</tr>

<?
			}//while($row = mysql_fetch_array($cmsManagementList)){
		}
	}
	// ����Ʈ�� ���� ���
	else {
?>
		<tr>
		<td colspan="8">CMS�� �������� �ʽ��ϴ�.</td>
		</tr>
<?
	}
?>
	</tbody>
	<tfoot>
		<tr>
		<td height="40" colspan="10" align="center">
		<!-- ����¡ �и� 
		<jsp:include page="/pages/admin/paging.jsp" />
		-->
		</td>
		</tr>
		<tr>
		<td height="40" colspan="8" align="center">
			<a href="javascript:appendCms();">
				<img src="/pages/admin/images/bbs/btn_write_big.gif" alt="���" />
			</a>
		</td>
		</tr>
		</tfoot>
		</table>
		</form>

<form id="cmsManagementSearchForm" name="cmsManagementSearchForm" action="javascript:cmsManagementKeywordSearch();" method="post" >
<table>
<tr>
<td height="34" colspan="8" align="center">						
<input type="text" id="searchKeyword" name="searchKeyword" value="<?= $searchKeyword ?>" />
<input type="image" src="/pages/admin/images/bbs/btn_search.gif" value="�˻�" alt="�˻�" />
<?if ($searchKeyword != "") {	?>
<a href="/pages/admin/menu/cmsAppendList.php?<?= $listParameter?>"><img src="/pages/admin/images/bbs/btn_cancel.gif"/></a>
<?}?>
</td>
</tr>
</table>
</form>
</body>
</html>