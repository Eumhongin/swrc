<?php

	include("../../config/mysql.inc.php");
	include("../../config/webConfig.inc.php");
	include("../../config/comm.inc.php");
	include("../../query/menu/menuQuery.php");

	//$pageUrl .= "�޴�����";

	$menuArr = getMenuRow($idx);

	if(!$menuArr){
		message("�ش� �޴��� �������� �ʽ��ϴ�.");
	}else{
		$row = mysql_fetch_array($menuArr);

		$parentCount = getChildMenuCount($idx);
		if($parentCount > 0) message("���� �޴��� ���� �����Ͽ� �ּ���.");
		
		if(deleteMenu($idx)){		
			message_url("�����Ǿ����ϴ�.",$pageUrl . "&amp;page=/pages/admin/menu/menuList.php&amp;site_code=".$SiteCode."&amp;idx=".$idx." ");
		}else{
			message("�޴� ������ �����Ͽ����ϴ�.");			
		}

	}

?>