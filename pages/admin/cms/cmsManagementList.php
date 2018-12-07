<?
	/*
	*	콘텐츠 리스트 페이지
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
	$pageUrl .= "콘텐츠관리";

	$siteList = getSiteList();
	
	//$sbSiteList 에 Site 값을 담는다.
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

	//전체 카테고리를 가져온다.
	$allCmsCategoryList = getAllCmsCategoryList($SiteCode);
	$allCmsCategoryListCount = mysql_num_rows($allCmsCategoryList);

	//검색 조건의 리스트 갯수를 가져온다.
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
	// 카테고리 관리
	function cmsCategoryManagementPopup() {
		window.open("/pages/admin/cms/cmsCategoryList.php", "cmsCategoryPopup", "width=387,height=400,top=100,left=100,scrollbars=yes,resizable=no");
	}
	
	// 목록표시 갯수 변경
	function listCount() {
		document.location.href = "<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementList.php&<?= $listParameter?>";
	}
	
	// 목록표시 사이트구분변경
	function listChange(site_code) {
		document.location.href = "<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementList.php&<?= $listParameter?>&site_code="+site_code;
	}

	// 키워드 검색
	function cmsManagementKeywordSearch() {
		var cmsManagementSearchForm = $("cmsManagementSearchForm");
		
		if ($F("searchKeyword").blank()) {
			alert("검색어를 입력해주세요.");
			$("searchKeyword").focus();
			return false;
		}
		
		cmsManagementSearchForm.action = "<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementList.php&<?= $frmParameter?>";

			return true;
			//cmsManagementSearchForm.submit();		
	}	
	// 권한관리 페이지를 띄운다.
	function authorityManagementPopup(managementIdx) {
		window.open("/pages/admin/cms/cmsAuthorityUpdateForm.php?managementIdx=" + managementIdx, "cmsAuthorityManagementPopup", "width=537,height=500,top=100,left=100,scrollbars=yes,resizable=no");
	}
//-->
</script>

<p class="contTitle">
	CMS 관리 - 현재 <?= $pageIdx ?> / 전체  &nbsp;
		<select name="viewListCount" onchange="listCount();" style="vertical-align:middle;">
<?	for ($i = 10; $i <= 100; $i += 10) {	?>
			<option value="<?= $i ?>"<?= $i == $listCount ? " selected" : "" ?>><?= $i ?> 개</option>
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

<table class="bbsCont" cellspacing="0" summary="CMS 분류 관리">
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
				<span class="f_blue">전체</span>
<?
				}else{
?>
				<a href="<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementList.php&site_code=<?=$SiteCode?>&searchCategoryIdx=0" title="전체 ?> 분류로 검색">전체</a>
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
	//5개씩 짤리게 수정.					
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


<table class="bbsCont" cellspacing="0" summary="메뉴 관리" >
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
			<th>분류</th>
			<th>CMS 명</th>
			<th>설명글</th>
			<th>CMS 크기</th>
			<th>사용여부</th>
			<th>등록일</th>
		</tr>
	</thead>
	<tbody>


<?
	// 리스트가 있을 경우
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
				<td class="tal"><?=utf8ToEuckr($row[category_title]) != "" ? utf8ToEuckr($row[category_title]) : "없음" ?></td>
				<td class="tal"><a href="<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementForm.php&<?= $listParameter."&idx=".$row[management_idx]."&site_code=".$row[management_site_code]?>"><?= utf8ToEuckr($row[management_title]) ?></a></td>
				
				<td>
					<?=$row[management_description] != "" ? "등록" : "미등록"  ?>
				</td>
				<td ><?= $row[content_length] ?></td>
			
				<td>
					<?if($row[management_use_flag] == "Y"){?>
						사용
					<?}else{?>
						사용 안함
					<?}?>
				</td>
				<td><?=$row[management_write_date]?></td>
			</tr>

<?
			}//while($row = mysql_fetch_array($cmsManagementList)){
		}
	}
	// 리스트가 없을 경우
	else {
?>
		<tr>
			<td colspan="8">CMS가 존재하지 않습니다.</td>
		</tr>
<?
	}
?>
	</tbody>
	<tfoot>
		
<?
	
	$pageParameter = $listParameter;
	$pageParameter = $pageParameter."&site_code=".$SiteCode;


	// 페이징 처리 태그에서 사용하기 위해...
//	pageContext.setAttribute("pageInfo", paging);
	
//	request.setAttribute("paging",paging);
//	request.setAttribute("pageURL", urlInfo + "/pages/admin/cms/cmsManagementList.php&amp;");
//	request.setAttribute("pageParameter",pageParameter);	
?>	
		<tr>
			<td colspan="10">
				<!-- 페이징 분리 -->
				<!--<jsp:include page="/pages/admin/paging.jsp" />-->
			</td>
		</tr>
		<tr>
			<td colspan="8">
<?
		//	if (baseAuthorityIdx == 0 )
		//	{
?>
			<a href="<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementForm.php&<?=$pageParameter?>"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록" /></a>
<?
		//	}
?>
		</td>
		</tr>
		<tr>
		<td colspan="8">
			<form id="cmsManagementSearchForm" name="cmsManagementSearchForm" onsubmit="return cmsManagementKeywordSearch();" method="post" style="margin:0px;">
				<strong>콘텐츠 검색</strong>
				<input type="text" id="searchKeyword" name="searchKeyword" value="<?= $searchKeyword ?>" style="width:200px" class="basic" />
				<input type="image" src="/pages/admin/images/bbs/btn_search.gif" value="검색" alt="검색" class="vmiddle" />

<?
	// 검색일 경우
	if ($searchKeyword != "") {
?>
				<a href="<?= $pageUrl ?>&page=/pages/admin/cms/cmsManagementList.php&<?= $listParameter?>">
					<img src="/pages/admin/images/bbs/btn_cancel.gif" alt="취소" />
					</a>
<?
	}
?>
			</form>
			</td>
		</tr>
	</tfoot>
</table>