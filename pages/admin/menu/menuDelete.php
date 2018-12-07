<?php

	include("../../config/mysql.inc.php");
	include("../../config/webConfig.inc.php");
	include("../../config/comm.inc.php");
	include("../../query/menu/menuQuery.php");

	//$pageUrl .= "메뉴관리";

	$menuArr = getMenuRow($idx);

	if(!$menuArr){
		message("해당 메뉴가 존재하지 않습니다.");
	}else{
		$row = mysql_fetch_array($menuArr);

		$parentCount = getChildMenuCount($idx);
		if($parentCount > 0) message("하위 메뉴를 먼저 삭제하여 주세요.");
		
		if(deleteMenu($idx)){		
			message_url("삭제되었습니다.",$pageUrl . "&amp;page=/pages/admin/menu/menuList.php&amp;site_code=".$SiteCode."&amp;idx=".$idx." ");
		}else{
			message("메뉴 삭제에 실패하였습니다.");			
		}

	}

?>