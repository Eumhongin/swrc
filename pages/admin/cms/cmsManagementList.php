<?
	/*
	*	������ ����Ʈ ������
	*	2011 01 24 kimna
	*/
	include("../../config/stringBuffer.inc.php"); 
	include("../../config/mysql.inc.php");
	include("../../config/webConfig.inc.php");
	include("../../query/cms/cmsQuery.php");
	include("../../query/menu/menuQuery.php");

	

	$SiteCode = getParameter($_REQUEST["site_code"], "505000000");
	$sbSiteList = new stringBuffer;
	$sSiteList = "";


	$processUrl = $_REQUEST["processUrl"];
	$pageIdx = $_REQUEST["pageIdx"];
	$searchCategoryIdx = $_REQUEST["searchCategoryIdx"];
	$listcount = $_REQUEST["listcount"];
	$searchKeyword = $_REQUEST["searchKeyword"];
	$orderByColumn = $_REQUEST["orderByColumn"];
	$isOrderByAsc = $_REQUEST["isOrderByAsc"];

	$urlInfo = $pageUrl."&amp;page=";
	$pageUrl .= "����������";

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
<script type="text/javascript" src="/js/prototype.js"></script>
<script type="text/javascript">
<!--
	// ī�װ� ����
	function cmsCategoryManagementPopup() {
		window.open("/pages/admin/cms/cmsCategoryList.php", "cmsCategoryPopup", "width=387,height=400,top=100,left=100,scrollbars=yes,resizable=no");
	}
	
	// ���ǥ�� ���� ����
	function listCount() {
		document.location.href = "<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementList.php&<?= $listParameter?>";
	}
	
	// ���ǥ�� ����Ʈ���к���
	function listChange(site_code) {
		document.location.href = "<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementList.php&<?= $listParameter?>&site_code="+site_code;
	}

	// Ű���� �˻�
	function cmsManagementKeywordSearch() {
		var cmsManagementSearchForm = $("cmsManagementSearchForm");
		
		if ($F("searchKeyword").blank()) {
			alert("�˻�� �Է����ּ���.");
			$("searchKeyword").focus();
			return false;
		}
		
		cmsManagementSearchForm.action = "<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementList.php&<?= $frmParameter?>";

			return true;
			//cmsManagementSearchForm.submit();		
	}	
	// ���Ѱ��� �������� ����.
	function authorityManagementPopup(managementIdx) {
		window.open("/pages/admin/cms/cmsAuthorityUpdateForm.php?managementIdx=" + managementIdx, "cmsAuthorityManagementPopup", "width=537,height=500,top=100,left=100,scrollbars=yes,resizable=no");
	}
//-->
</script>

<p class="contTitle">
	CMS ���� - ���� <?= $pageIdx ?> / ��ü  &nbsp;
		<select name="viewListCount" onchange="listCount();" style="vertical-align:middle;">
<?	for ($i = 10; $i <= 100; $i += 10) {	?>
			<option value="<?= $i ?>"<?= $i == $listCount ? " selected" : "" ?>><?= $i ?> ��</option>
<?	}	?>
		</select>
<?
	//		if (baseAuthorityIdx == 0 )
	//		{
?>
		<select id="site_code" name="site_code" OnChange="javascript:listChange(this.value)">
		<?=$sSiteList?>
		</select>
<?
	//		}
?>
</p>

<?
	//	if ($baseAuthorityIdx == 0 )
	//	{
?>

<table class="bbsCont" cellspacing="0" summary="CMS �з� ����">
		<tr>	
<?
			if ($allCmsCategoryList) {
?>
		<th width="150" valign="top">
			<ul>
				<li>
<?
				if($searchCategoryIdx == 0)	{
?>
				<span class="f_blue">��ü</span>
<?
				}else{
?>
				<a href="<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementList.php&site_code=<?=$SiteCode?>&searchCategoryIdx=0" title="��ü ?> �з��� �˻�">��ü</a>
<?
				}
?>
				</li>
			</ul>
		</th>
<?		
					while($row = mysql_fetch_array($allCmsCategoryList)){
?>
		<th width="150" valign="top">
			<ul>
<?
	//5���� ©���� ����.					
						if ($row[idx] == $searchCategoryIdx) {
?>
				<li><span class="f_blue"><?= utf8ToEuckr($row[title]) ?></span></li>
<?
						} else {
?>
				<li><a href="<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementList.php&site_code=<?=$SiteCode?>&searchCategoryIdx=<?= $row[idx] ?>">&nbsp;<?= utf8ToEuckr($row[title]) ?></a></li>
<?
						}
?>
			</ul>
		</th>
<?
					}// End while

			} else {
					echo "&nbsp;";
			}
?>
	
	</tr>
</table>
<?
//			}	if ($baseAuthorityIdx == 0 )
?>


<table class="bbsCont" cellspacing="0" summary="�޴� ����" >
	<colgroup>
		<col width="8%" />
		<col width="15%" />
		<col />
		<col width="8%"/>
		<col width="10%" />
		<col width="10%" />
		<col width="15%" />
	</colgroup>
	
	<thead>
		<tr>
			<th>Key</th>
			<th>�з�</th>
			<th>CMS ��</th>
			<th>�����</th>
			<th>CMS ũ��</th>
			<th>��뿩��</th>
			<th>�����</th>
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
			<tr>
				<td><?=$row[management_idx]?></td>
				<td class="tal"><?=utf8ToEuckr($row[category_title]) != "" ? utf8ToEuckr($row[category_title]) : "����" ?></td>
				<td class="tal"><a href="<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementForm.php&<?= $listParameter."&idx=".$row[management_idx]."&site_code=".$row[management_site_code]?>"><?= utf8ToEuckr($row[management_title]) ?></a></td>
				
				<td>
					<?=$row[management_description] != "" ? "���" : "�̵��"  ?>
				</td>
				<td ><?= $row[content_length] ?></td>
			
				<td>
					<?if($row[management_use_flag] == "Y"){?>
						���
					<?}else{?>
						��� ����
					<?}?>
				</td>
				<td><?=$row[management_write_date]?></td>
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
		
<?
	
	$pageParameter = $listParameter;
	$pageParameter = $pageParameter."&site_code=".$SiteCode;


	// ����¡ ó�� �±׿��� ����ϱ� ����...
//	pageContext.setAttribute("pageInfo", paging);
	
//	request.setAttribute("paging",paging);
//	request.setAttribute("pageURL", urlInfo + "/pages/admin/cms/cmsManagementList.php&amp;");
//	request.setAttribute("pageParameter",pageParameter);	
?>	
		<tr>
			<td colspan="10">
				<!-- ����¡ �и� -->
				<!--<jsp:include page="/pages/admin/paging.jsp" />-->
			</td>
		</tr>
		<tr>
			<td colspan="8">
<?
		//	if (baseAuthorityIdx == 0 )
		//	{
?>
			<a href="<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementForm.php&<?=$pageParameter?>"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="���" /></a>
<?
		//	}
?>
		</td>
		</tr>
		<tr>
		<td colspan="8">
			<form id="cmsManagementSearchForm" name="cmsManagementSearchForm" onsubmit="return cmsManagementKeywordSearch();" method="post" style="margin:0px;">
				<strong>������ �˻�</strong>
				<input type="text" id="searchKeyword" name="searchKeyword" value="<?= $searchKeyword ?>" style="width:200px" class="basic" />
				<input type="image" src="/pages/admin/images/bbs/btn_search.gif" value="�˻�" alt="�˻�" class="vmiddle" />

<?
	// �˻��� ���
	if ($searchKeyword != "") {
?>
				<a href="<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementList.php&<?= $listParameter?>">
					<img src="/pages/admin/images/bbs/btn_cancel.gif" alt="���" />
					</a>
<?
	}
?>
			</form>
			</td>
		</tr>
	</tfoot>
</table>