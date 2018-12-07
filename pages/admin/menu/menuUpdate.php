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
	$pageUrl .= "메뉴관리";
	$SiteCode = getParameter($_REQUEST["site_code"], "505000000");


	//등록일 경우
	if(!$isEdit){		
		
		$idx = getNewMenuIdx();
		$parentMenuRow = getMenuRow($parentIdx);
		
		if($parentMenuRow){
			$row = mysql_fetch_array($parentMenuRow);
			$depth = $row[menu_depth]+1;
			
			//더이상 하위로 메뉴를 등록하지 못할 경우
			if($depth >= 6){
				message_url("더 이상 하위 메뉴를 등록할 수 없습니다.", "menuList.php");
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

		//해당 Depth 에 1을 더해준다	
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
	
	//각 타입에 따라 변수들 설정
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
	//해당 메뉴의 매칭 키워드 설정
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
			//CMS 일 겨우 기존의 menu와 cms 매필 테이블 값들 삭제 구문
			// 해당 메뉴의 모든 매칭 키워드 삭제 구문
			// kimna 차후 작업
		*/


	}else{
		
		if(insertMenuRow($menuRow)){
			$isUpdate = true;
		}else{
			$isUpdate = false;
		}

	}

	// 위에서 작업이 완료 되고, 링크타입이 CMS 일 경우
	if($isUpdate && $menuRow[link_type] == CMS_LINK_TYPE){
		$idUpdate = insertMenu2Cms($menu2CmsArr);
	}

	if($isUpdate){
		if($isEdit){		
			message_url("수정되었습니다.",$pageUrl . "&amp;page=/pages/admin/menu/menuList.php&amp;site_code=".$SiteCode."&amp;idx=".$idx."&amp;parentIdx=".$parentIdx." ");
		}else{
			message_url("등록되었습니다.",$pageUrl . "&amp;page=/pages/admin/menu/menuList.php&amp;site_code=".$SiteCode."&amp;parentIdx=".$parentIdx." ");
		}

	}else{
		if($isEdit){
			message("메뉴 수정에 실패하였습니다.");
		}else{
			message("메뉴 등록에 실패하였습니다.");
		}

	}

?>