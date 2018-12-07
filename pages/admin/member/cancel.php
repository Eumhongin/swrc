<?

  include("../../config/mysql.inc.php");  
  include("../../config/comm.inc.php");

  $pageUrl .= $pageName;
  if($user_flag != "") $not_user = $user_flag;

  $mysql = new Mysql_DB;
  $mysql->Connect();
  
  $not_date = date("Y-m-d");
  
  $qry = "update members set not_user='0' where user_id='$user_id'";
  $mysql->ParseExec($qry); 
  
  $url = "$pageUrl&page=/pages/admin/member/list.php&user_flag=$not_user&pageIdx=$pageIdx&search=$search&keyword=$keyword&keyword2=$keyword2";
  movepage($url);       
  
?>
