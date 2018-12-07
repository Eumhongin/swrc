<?php

	//include("../../config/stringBuffer.inc.php"); 
	include("../../config/mysql.inc.php");
	include("../../config/webConfig.inc.php");
	include("../../config/menuUtil.inc.php");
	include("../../config/comm.inc.php");
	include("../../query/menu/menuQuery.php");

	$idx = $_REQUEST["idx"];
	$cmsIdx = $_REQUEST["cmsIdx"];
	$cmsDefaultIdx = $_REQUEST["cmsDefaultIdx"];
	$site_group = $_REQUEST["site_group"];
	$title = euckrToUtf8($_REQUEST["title"]);
	$division = euckrToUtf8($_REQUEST["division"]);
	$chargeUserName = euckrToUtf8($_REQUEST["chargeUserName"]);
	$chargeUserTel = $_REQUEST["chargeUserTel"];
	$linkType = $_REQUEST["linkType"];
	$useFlag = $_REQUEST["useFlag"];
	$urlLink = $_REQUEST["urlLink"];
	$urlTarget = $_REQUEST["urlTarget"];
	$javascriptLink = $_REQUEST["javascriptLink"];
	$parentIdx = $_REQUEST["parentIdx"];
	$searchCategoryIdx = $_REQUEST["searchCategoryIdx"];

	$isEdit = false;
	if($idx > 0){
		$isEdit = true;
	}
	$depth = 0;
	$topIdx = 0;
	$maxCode = "";
	$menuRow = array();
	$menu2CmsArr = array();
	$pageUrl .= "�޴�����";
	$SiteCode = getParameter($_REQUEST["site_code"], "505000000");


	//����� ���
	if(!$isEdit){		
		
		$idx = getNewMenuIdx();
		$parentMenuRow = getMenuRow($parentIdx);
		
		if($parentMenuRow){
			$row = mysql_fetch_array($parentMenuRow);
			$depth = $row[menu_depth]+1;
			
			//���̻� ������ �޴��� ������� ���� ���
			if($depth >= 6){
				message_url("�� �̻� ���� �޴��� ����� �� �����ϴ�.", "menuList.php");
			}	

			if(!$isEdit && $row[menu_depth] == 0){
				$topIdx = $idx;
			}else{
				$topIdx = $row[menu_top_idx];
			}

			if($parentIdx > 0){
				$maxCode = getMaxChildCode($parentIdx);

				if($maxCode == ""){
					$maxCode = $row[menu_code];					
				}
			}else{
				$maxCode = "000000000";
			}
		
		}else{
			$depth = 1;
			$topIdx = $idx;
		}
		
		//plusCode($maxCode, $depth, 1);

		//�ش� Depth �� 1�� �����ش�	
		$menuRow[code] = plusCode($maxCode, $depth, 1);
		$menuRow[top_idx] = $topIdx;
		$menuRow[parent_idx] = $parentIdx;
		$menuRow[depth] = $depth;
		$menuRow[write_name] = $duname;
		$menuRow[write_id] = $duid;
		$menuRow[write_ip] = $REMOTE_ADDR;

	}else{
		$menuRow[edit_id] = $duid;
		$menuRow[edit_name] = $duname;
		$menuRow[edit_ip] = $REMOTE_ADDR;
	}

	$menuRow[idx] = $idx;
	$menuRow[site_code] = $SiteCode;
	$menuRow[site_group] = $SiteGroup;
	$menuRow[title] = $title;
	$menuRow[division] = $division;
	$menuRow[link_type] = $linkType;
	$menuRow[charge_user_id] = $chargeUserId;
	$menuRow[charge_user_name] = $chargeUserName;
	$menuRow[charge_user_tel] = $chargeUserTel;
	
	//�� Ÿ�Կ� ���� ������ ����
	switch ($linkType){
		case INCLUDE_LINK_TYPE :
		case URL_LINK_TYPE :
				$menuRow[urlLink] = $urlLink;
				$menuRow[target] = $urlTarget;
			break;
		case CMS_LINK_TYPE :
					
			if($cmsIdx != ""){
				$menu2CmsArr[menu_idx] = $idx;
				$menu2CmsArr[management_idx] = $cmsIdx;
				$menu2CmsArr[default_flag] = "Y";
			}
		
			break;
		case JAVASCRIPT_LINK_TYPE :
				$menuRow[urlLink] = $javascriptLink;
			break;		


	}

	/*
	//�ش� �޴��� ��Ī Ű���� ����
	if ($matchKeywords != "" && $matchKeywords.length > 0){
	
	}
	*/

	$menuRow[use_flag] = $useFlag;
	$isUpdate = false;

	if($isEdit){

		if(updateMenuRow($menuRow)){
			if($menuRow[link_type] == CMS_LINK_TYPE){
				deleteMenu2Cms($idx);
			}
			
			$isUpdate = true;
		}

		/*
			//CMS �� �ܿ� ������ menu�� cms ���� ���̺� ���� ���� ����
			// �ش� �޴��� ��� ��Ī Ű���� ���� ����
			// kimna ���� �۾�
		*/


	}else{
		
		if(insertMenuRow($menuRow)){
			$isUpdate = true;
		}else{
			$isUpdate = false;
		}

	}

	// ������ �۾��� �Ϸ� �ǰ�, ��ũŸ���� CMS �� ���
	if($isUpdate && $menuRow[link_type] == CMS_LINK_TYPE){
		$idUpdate = insertMenu2Cms($menu2CmsArr);
	}

	if($isUpdate){
		if($isEdit){		
			message_url("�����Ǿ����ϴ�.",$pageUrl . "&amp;page=/pages/admin/menu/menuList.php&amp;site_code=".$SiteCode."&amp;idx=".$idx."&amp;parentIdx=".$parentIdx." ");
		}else{
			message_url("��ϵǾ����ϴ�.",$pageUrl . "&amp;page=/pages/admin/menu/menuList.php&amp;site_code=".$SiteCode."&amp;parentIdx=".$parentIdx." ");
		}

	}else{
		if($isEdit){
			message("�޴� ������ �����Ͽ����ϴ�.");
		}else{
			message("�޴� ��Ͽ� �����Ͽ����ϴ�.");
		}

	}

?>