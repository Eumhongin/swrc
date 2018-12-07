<?
session_start();
include "../lib/admin_session_chk.php";
include "../inc/mysql.php";



$ddate = '';
if($chk_date1)
{
	$ddate = $chk_date1;
}
if($chk_date2)
{
	if($ddate == '') { $ddate = $chk_date2;}
	else			 { $ddate = $ddate.", ".$chk_date2;}
}
if($chk_date3)
{
	if($ddate == '') { $ddate = $chk_date3;}
	else			 { $ddate = $ddate.", ".$chk_date3;}
}
if($chk_date4)
{
	if($ddate == '') { $ddate = $chk_date4;}
	else			 { $ddate = $ddate.", ".$chk_date4;}
}
if($chk_date5)
{
	if($ddate == '') { $ddate = $chk_date5;}
	else			 { $ddate = $ddate.", ".$chk_date5;}
}



$cnt_que = mysql_query("SELECT max(duid) AS duid FROM edu_detail");
$cnt_res = mysql_fetch_array($cnt_que);

$new_duid = $cnt_res[duid] + 1;

$sql = "INSERT INTO edu_detail VALUES ('','0',".$uid.",'".mktime($study_stime,0,0,$smonth,$sday,$syear)."', '".mktime($study_etime,0,0,$emonth,$eday,$eyear)."', '".$ddate."','".mktime($study_stime,0,0,$smonth,$sday,$syear)."', '".mktime($study_etime,0,0,$emonth,$eday,$eyear)."', '".$price."', '".$room."', '".$teach."', '".$capacity."')";

$que = mysql_query($sql);



?>

<script language="javascript">
<!--
opener.window.location.href="edu.php?kind=<?=$kind?>&page=<?=$page?>";
self.close();
-->
</script>