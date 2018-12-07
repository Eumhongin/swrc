<?
	include("../../config/mysql.inc.php");  

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$query = " Insert into t_admin_menu (menu_name) values('통계관리') ";
	
	//mysql_query($query);

	$mysql->Disconnect();
?>