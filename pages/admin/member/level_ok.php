<?

	include("../../config/mysql.inc.php");  
	include("../../config/comm.inc.php");
	
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();
		
	$value = Split(",", $p_level);
	
	// ¼öÁ¤
	$qry = " Update members Set ch_member= '$value[1]' Where user_id='$value[0]'";
	$mysql->ParseExec($qry); 

	$mysql->Disconnect();

	$url = $pageUrl."&page=/pages/admin/member/list.php&pageIdx=$pageIdx&search=$search&keyword=$keyword&keyword2=$keyword2";
	movepage($url);       

?>

