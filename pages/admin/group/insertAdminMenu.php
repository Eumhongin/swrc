<?
	include("../../../config/mysql.inc.php"); 

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$qry  = "Insert into t_admin_menu(menu_name) ";
	$qry .= " Values ('SMS')";
	$mysql->ParseExec($qry);
?>