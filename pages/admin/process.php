<?php

	session_start();
	
	include("../../config/request.inc.php"); 

	$pg = getParameter($_REQUEST["page"], "/pages/admin/blank.php");
	
	$pageUrl .= $pageName;
	session_register("pageUrl");
	$processUrl .= $pageName;
	session_register("processUrl");


?>
			<?php
				include($_SERVER["DOCUMENT_ROOT"].$pg);
			?>