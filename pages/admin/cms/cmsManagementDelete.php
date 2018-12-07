<?php

	include("../../config/mysql.inc.php");
	include("../../config/webConfig.inc.php");
	include("../../config/comm.inc.php");
	include("../../query/cms/cmsQuery.php");

	DeleteCmsManagement($idx);
	
	message_url("能刨明啊 昏力登菌嚼聪促.", "/pages/admin/main.php?pageName=能刨明包府&page=/pages/admin/cms/cmsManagementList.php");

?>