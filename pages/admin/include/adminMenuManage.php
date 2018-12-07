<?php

	include("../../config/stringBuffer.inc.php"); 
	include("../../config/mysql.inc.php");
	include("../../query/menu/menuQuery.php");
	
	$pageUrl .= $pageName;

	$SiteCode = getParameter($_REQUEST["site_code"], "505000000");
	$idx = $_REQUEST["idx"];
	$parentIdx = $_REQUEST["parentIdx"];
	if($parentIdx == "") $parentIdx = -1;
	$sbSiteList = new stringBuffer;
	$sSiteList = "";
	$sbTreeJs = new stringBuffer;
	$sTreeJs = "";
	$tmpStr = "";

	$menuList = getParent2MenuList(-1,$parentIdx);
	//사이트 목록을 받아온다
	$siteList = getSiteList();
	
	$sbSiteList->append("");

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

	$menuTree = getMenuTree($SiteCode);

	// 메뉴 Tree JS 값 생성
	$sbTreeJs->append("d = new dTree('d');\n");
	if($menuTree){
		while($row = mysql_fetch_array($menuTree)){
			if("Y" == $row[use_flag]){
				$tmpStr = utf8ToEuckr($row[title]);
			}else{
				$tmpStr = utf8ToEuckr($row[title])."(x)";
			}

			$sbTreeJs->append("d.add(".$row[idx].",".$row[parent_idx].",'".$tmpStr."','javascript:SetMenuUid(".$row[idx].");'); \n");
		}
	}
	$sbTreeJs->append("document.write(d);\n");
	$sTreeJs = $sbTreeJs->getStringValue();

	//상위 idx 가 있을 경우
	if($parentIdx > 0 && $menuIdx == 0){
		$parentMenuArr = getMenuRow($parentIdx);	
	}	

?>
<link rel="StyleSheet" href="/css/dtree.css" type="text/css" />
<script type="text/javascript" src="/js/dtree.js" charset='utf-8'></script>
<script type="text/javascript">
<!--
	function chageSite(site_code){

		document.location.href = "<?= $pageUrl ?>&amp;page=/pages/admin/menu/menuList.php&amp;parentIdx=0&amp;site_code=" + site_code;
	}

	// 메뉴 삭제 함수
	function deleteMenu(idx) {
		if (confirm("이 메뉴가 삭제되면 하위메뉴도 함께 삭제됩니다.\n\n정말 삭제하시겠습니까?")) {
			document.location.href = "<?= $processUrl ?>&amp;page=/pages/admin/menu/menuDelete.php&amp;parentIdx=<?= parentIdx ?>&amp;idx=" + idx;
		}
	}

// iframe auto resize
function resizeIFrame(ifrName) { 

	var min_h = 500;
	var oIFrame = document.getElementById(ifrName);

	try {          
	  
		var oDoc = oIFrame.contentDocument || oIFrame.contentWindow.document;        

		if (/MSIE/.test(navigator.userAgent)) {
			var frmHeight = oDoc.body.scrollHeight;
		} else {
			var s = oDoc.body.appendChild(document.createElement('DIV'))
			s.style.clear = 'both';

			var frmHeight = s.offsetTop;
			s.parentNode.removeChild(s);
		}

		if (frmHeight < min_h) 
			frmHeight = min_h;

		oIFrame.style.height = frmHeight+"px";

	} catch (e) { }
}
	var mnu_siteid;
	var viewFrm= "yearView";
	var oldObj;

	function viewInfo(ct){

		if ( document.frmPnt.C_UID.value == "" ) {
				alert("분류를 선택해주세요.");
				return;
		}

		var enableStyle		= "background-color:#FFFFFF;border-top:1px inset #C0C0C0;border-left:1px inset #C0C0C0;border-right:1px inset #C0C0C0;";
		var disableStyle	= "background:parent.bgcolor;border-bottom:1px solid black";

		switch (ct)
		{
			case 'mnuInfo': 
						document.getElementById("mnuInfo").style.cssText		= enableStyle;
						document.getElementById("mnuAdd").style.cssText		= disableStyle;
						iFrmCategoryInfo.location.href="/pages/admin/menu/menuForm.php?idx="+document.frmPnt.C_UID.value + "&mode=view&site_code=<?=$SiteCode?>";
				break;
			case	 'mnuAdd'	:	
						document.getElementById("mnuInfo").style.cssText		= disableStyle;
						document.getElementById("mnuAdd").style.cssText		= enableStyle;
						iFrmCategoryInfo.location.href="/pages/admin/menu/menuForm.php?parentIdx="+document.frmPnt.C_UID.value + "&mode=add&site_code=<?=$SiteCode?>";
				break;
			case	 'mnuHTML'	 :
					if( iFrmCategoryInfo.document.getElementById("cont_Mnu_Uid").value > 0  ){
						document.getElementById("mnuInfo").style.cssText		= disableStyle;
						document.getElementById("mnuAdd").style.cssText		= disableStyle;

						iFrmCategoryInfo.location.href="menu_content_write.htm?idx="+document.frmPnt.C_UID.value + "&mode=add&mnu_siteid=<?=$SiteCode?>";
					}
					else{
						alert("해당메뉴내용은 관리될수 없는 프로그램이나 링크 관련 메뉴입니다");
					}
				break;
		}
	}
	
	  function SetMenuUid(mnu_uid)
	  {
			document.frmPnt.C_UID.value=mnu_uid;
			viewInfo('mnuInfo');
	  }
//-->
</script><noscript>
<p>자바스크립트를 사용할 수 없는 브라우저입니다.<br />현재 페이지를 이용하시기 위해서는 다른 브라우저로 접속해 주시기 바랍니다.</p> 
</noscript>


<form name="frmPnt" id="frmPnt">
	<input type="hidden" id="C_UID" name="C_UID" value="">
	<input type="hidden" id="pageName" name="pageName" value="<?=$pageName?>">
	<input type="hidden" id="PAGE_URL" name="PAGE_URL" value="<?=$pageUrl?>">
	<input type="hidden" id="PROCESS_URL" name="PROCESS_URL" value="<?=$processUrl?>">
</form>
						<table width="170" cellpadding="0" cellspacing="0" align="center">
							<tr height="24">
								<!--<td class="f_blue f_14 bold"><img src="/pages/admin/images/common/bullet_folder.gif"> 메뉴관리</td>-->
							</tr>
							<tr>
								<td height="1" bgcolor="#CCCCCC"></td>
							</tr>
							<tr>
								<td height="8"></td>
							</tr>
							<tr>
								<td>
								<select id="site_code" name="site_code" OnChange="javascript:chageSite(this.value)">
								<?=$sSiteList?>
								</select>
								<script type="text/javascript" >
								<!--
								<?=$sTreeJs?>
								//-->
								</script>
								</td>
							</tr>
							<tr>
								<td height="8"></td>
							</tr>
						</table>

<script type="text/javascript">
<!--	//
function setMenu(){

}
 
//-->
</script>