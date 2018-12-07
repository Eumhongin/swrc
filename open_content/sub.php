<?php

	include("../config/stringBuffer.inc.php");
	include("../config/mysql.inc.php");
	include("../config/webConfig.inc.php");
	include("../config/request.inc.php");
	include("../config/comm.inc.php");
	include("../query/menu/menuQuery.php");
	include("../query/cms/cmsQuery.php");

	session_start();

	$pn = $_REQUEST["pn"];

	$isSubMain = false;

	$menuIdx = $_REQUEST["menuIdx"];
	$page = $_REQUEST["page"];

	$pageUrl = "/open_content/sub.php?menuIdx=".$menuIdx;
	$pageUrl = str_replace("<", "&lt;", $pageUrl);
	//session_register("pageUrl");

	$processUrl = "/open_content/process.php?menuIdx=".$menuIdx;
	//session_register("processUrl");

	//$menuIdx �� �������
	if($menuIdx <= 0){
		message("�ش� �޴��� ���� ������ ������ �� �����ϴ�.");
	}

	//menu�� ���� ������ �ҷ��´�.
	$menuArr = getMenuRow($menuIdx);

	//������� ������ ����� Row �� ��´�.
	if(!$menuArr){
		message("�ش� �޴��� ���� ������ ������ �� �����ϴ�!.");
	}else{
		$menuArrRow = mysql_fetch_array($menuArr);
	}

	//$cmsIdx ���� ���� ���
	if($cmsIdx > 0 ){
		$menu2CmsArr = getMenu2CmsArr2($menuIdx, $cmsIdx);
	}else{
		$menu2CmsArr[cms_description] = $menuArrRow[cms_description];
		$menu2CmsArr[cms_idx] = $menuArrRow[cms_idx];
		$menu2CmsArr[cms_content_idx] = $menuArrRow[cms_content_idx];
	}

	//�ۼ���
	$menuWriteDate = $menuArrRow[menu_write_date];
	//������
	$menuEditDate = $menuArrRow[menu_edit_date];
	//�����
	$menuChargeUserId = $menuArrRow[menu_charge_user_id];
	$menuChargeUserName = $menuArrRow[menu_charge_user_name];
	$menuChargeUserTel = $menuArrRow[menu_charge_user_tel];

	//�ֻ��� �޴� ����Ʈ
	$topMenuList = getAllDepthMenuList(1, $menuArrRow[menu_site_code]);
	//2 depth ��ü �޴� ����Ʈ
	$sub2DepthAllMenuList = getAllDepthMenuList(2, $menuArrRow[menu_site_code]);
	//3 depth ������ ���� �޴�
	$subMenuList = getTop2SubMenuList($menuArrRow[menu_top_idx], 3);
	// ���� �޴��� 4Depth�� ��� 4Depth �޴� ����Ʈ�� �����´�.
	/*if($menuArrRow[menu_depth] == 4){
		$sub4DepthMenuList = getParent2MenuList2($menuArrRow[menu_parent_idx]);
	}*/

	//�޴� History
	$menuHistoryList = getMenuHistoryList($menuIdx);
	//menuHistoryList ���� ������
	//���� �޴����� ���� �޴��� ������ �ҷ����� ���� ����. 3Depth ������ ��� �Ұ���.
	if($menuHistoryList){
		$row = mysql_fetch_array($menuHistoryList);
		//1depth �޴��� �ƴϸ�
		if($row[parent_idx]>0)	$menuHistoryFirstUpList = getMenuHistoryList($row[parent_idx]);
		//mysql Data �� �ǵ�����.
		mysql_data_seek($menuHistoryList, 0);
			if($menuHistoryFirstUpList){
				$row = mysql_fetch_array($menuHistoryFirstUpList);
				if( $row[parent_idx] > 0 ) $menuHistorySecondUpList = getMenuHistoryList($row[parent_idx]);
				mysql_data_seek($menuHistoryFirstUpList, 0);

				if($menuHistorySecondUpList){
					$row = mysql_fetch_array($menuHistorySecondUpList);
					if( $row[parent_idx] > 0 ) $menuHistoryThirdUpList = getMenuHistoryList($row[parent_idx]);
					mysql_data_seek($menuHistorySecondUpList, 0);
				}
			}
	}

	//��ܿ� ������ ����� $mergeMenuHistoryArray �迭�� ��´�.
	if($menuHistoryFirstUpList)
		$mergeMenuHistoryArr = array_merge((array)$menuHistoryFirstUpList, (array)$menuHistoryList);
	if($menuHistorySecondUpList)
		$mergeMenuHistoryArr = array_merge((array)$menuHistorySecondUpList, (array)$mergeMenuHistoryArr);
	if($menuHistoryThirdUpList)
		$mergeMenuHistoryArr = array_merge((array)$menuHistoryThirdUpList, (array)$mergeMenuHistoryArr);

	//CMS�� ���
	if($menuArrRow[menu_link_type] == CMS_LINK_TYPE){

		//Content�� ���� ���
		if(!$menu2CmsArr){
			message("���� �������� ��ϵ� �������� �����ϴ�. \n\n�����ڿ��� �����Ͻñ� �ٶ��ϴ�.");
		}

		$cmsDescription = $menu2CmsArr[cms_description];

	}

	//���� history ����� ����
	$menuHistoryNameBuffer = new stringBuffer();
	$menuHistoryBuffer = new stringBuffer();

	for($i = 0; $i < count($mergeMenuHistoryArr); $i++){
		$row = mysql_fetch_array($mergeMenuHistoryArr[$i]);

		//$i == 1 �϶� 1�� �޴�
		if($i == 1){
			$mMenu = $row[division];
		}

		//$i == 2 �϶� 2�� �޴�
		if($i == 2){
			$TwoDepthMenuIdx = $row[idx];
			$TwoDepthDivision = $row[division];
		}

		if($i == 3){
			$ThreeDepthMenuIdx = $row[idx];
			$ThreeDepthMenuTitle = utf8ToEuckr($row[title]);
			$ThreeDepthDivision = $row[division];
			echo "<script>console.log('.$ThreeDepthMenuTitle.')</script>";
		}

		if($row[idx] == $menuIdx){
			$menuHistoryNameBuffer->append(utf8ToEuckr($row[title]));
		}

		if($row[depth] == 0){
			//History�� ��ũ����
			//$menuHistoryBuffer->append("<a href=\"./index.php\" title=\"".$row[title]." ������������ �̵��մϴ�.\">"."HOME"."</a>  &gt; ");
			$menuHistoryBuffer->append("HOME &gt; ");
		}else{

			//���� ���� �޴��� �������ش�.
			if($row[idx] == $menuIdx){
				$menuHistoryBuffer->append("<span class=\"cont_state\">");
				$menuHistoryBuffer->append(utf8ToEuckr($row[title]));
				$menuHistoryBuffer->append("</span>");
				$menuHistoryName = utf8ToEuckr($row[title]);
			}//�ƴҰ�� ��ũ�� �Ǵ�.
			else{
				//Ÿ��Ʋ ���� ������ �ڸ��� ����. ���� �߰� kimna

				//URL
				if($row[link_type] == URL_LINK_TYPE){
					//History�� ��ũ����

					$menuHistoryBuffer->append("<a href=\"");
					if($row[link] == ""){
						$menuHistoryBuffer->append("#");
					}else{
						$menuHistoryBuffer->append($row[link]);
					}
					$menuHistoryBuffer->append("\" ");

				}
				//Javascript
				else if($row[link_type] == JAVASCRIPT_LINK_TYPE){
					$menuHistoryBuffer->append("<a href=\"#self\" onclick=\"javascript:".$row[link]."\" ");
				}
				//������
				else{
					$menuHistoryBuffer->append("<a href=\"./sub.php?menuIdx=".$row[idx]."\" ");
				}

				if($row[target] != ""){
					$menuHistoryBuffer->append("target=\"".$row[target]."\" ");
				}

				//History�� ��ũ����
				//$menuHistoryBuffer->append("class=\"basic uline\" title=\"".$row[title]."�������� �̵��մϴ�.\">");
				$menuHistoryBuffer->append(utf8ToEuckr($row[title]));
				//$menuHistoryBuffer->append("</a>");
				$menuHistoryBuffer->append(" &gt; ");
			}

		}//End if $row[depth] == 0

		if($i == count($mergeMenuHistoryArr)-1){
			$menuTitle = utf8ToEuckr($row[title]);
			$menuDivision = $row[division];
		}
	}// End for($i = 0; $i < count($mergeMenuHistoryArr); $i++)

	$menuHistoryNameStr = $menuHistoryNameBuffer->getStringValue();
	$menuHistoryStr = $menuHistoryBuffer->getStringValue();
	//���� history ����� ��

	$sMenu = 0;
	if($menuArrRow[menu_depth] == 3 || $menuArrRow[menu_depth] == 4) {
		$sMenu = (int)$TwoDepthDivision;
	}else{
		if($menuArrRow[menu_depth] == 1) //����������
		{
			$sMenu = 0;
			$isSubMain = true;
		}else{
			$sMenu = (int)$menuArrRow[menu_division];
		}
	}

include ("../include/topHtml.php");
?>
	<div id="ContLocation">
		<p class="cont"><?= $menuHistoryStr ?></p>
	</div>
<?
	//�޴� ����
	$MenuDivisionExplode = explode("_", $menuDivision);
	if($MenuDivisionExplode[0]) $firstTitleImageNum = $MenuDivisionExplode[0];
	else $firstTitleImageNum = $sMenu;

	if($MenuDivisionExplode[1]) $secondTitleImageNum = $MenuDivisionExplode[1];
	else $secondTitleImageNum = 1;

?>
	<h3 id="ContTitle">
		<img src="../images/sub/sub_title_<?=$mMenu?>_<?=$secondTitleImageNum?>.jpg">
		<img src="../images/<?=$mMenu?>/title0<?=$firstTitleImageNum?>_0<?=$secondTitleImageNum?>.gif" alt="<?=$menuTitle?>" />
		<span class="bold f_18"><?=utf8ToEuckr($menuTitle)?></span>
	</h3>
	<div id="Contents">
<?php
	//������ ���� Ÿ��Ʋ
	if ($cmsDescription != "") echo $cmsDescription;

	//4Depth �� ����. kimna

	$cmsPageUrl = "";

	//�ְ� �켱�� page ���� �Ѿ�� �Ϳ� ���� ó���̴�.
	if($page != ""){
		$page = $_SERVER[DOCUMENT_ROOT].$page;
		include ($page);
	}
	//�޴��� CMS Ÿ���� ���
	else if($menuArrRow[menu_link_type] == CMS_LINK_TYPE){
		//$cmsPageUrl = $cmsContentsPagesPath."/".$menu2CmsArr[cms_idx]."/".$menu2CmsArr[cms_content_idx].".php";
		$cmsPageUrl = $cmsContentsPagesPath."/".$menu2CmsArr[cms_idx].".php";

		include ($cmsPageUrl);
	}
	//�޴��� include Ÿ���� ���
	else if($menuArrRow[menu_link_type] == INCLUDE_LINK_TYPE){
		if($menuArrRow[link])
			include ($menuArrRow[link]);
	}
?>
	</div> <!-- Contents end -->
<?php
	include ("../include/bottomHtml.php");
?>
