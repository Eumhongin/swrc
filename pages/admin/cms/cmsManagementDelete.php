<?php

	include("../../config/mysql.inc.php");
	include("../../config/webConfig.inc.php");
	include("../../config/comm.inc.php");
	include("../../query/cms/cmsQuery.php");

	DeleteCmsManagement($idx);
	
	message_url("�������� �����Ǿ����ϴ�.", "/pages/admin/main.php?pageName=����������&page=/pages/admin/cms/cmsManagementList.php");

?>