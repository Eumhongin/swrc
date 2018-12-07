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

if($chk_date6)
{
	if($ddate == '') { $ddate = $chk_date6;}
	else			 { $ddate = $ddate.", ".$chk_date6;}
}

if($chk_date0 == 0)
{
	if($ddate == '') { $ddate = $chk_date0;}
	else			 { $ddate = $ddate.", ".$chk_date0;}
}

$sql = "UPDATE edu_detail SET sdate = '".mktime($study_stime,0,0,$smonth,$sday,$syear)."', edate = '".mktime($study_etime,0,0,$emonth,$eday,$eyear)."', ddate = '".$ddate."', stime = '".mktime($study_stime,0,0,$smonth,$sday,$syear)."', etime = '".mktime($study_etime,0,0,$emonth,$eday,$eyear)."', price = '".$price."', room = '".$room."', teach = '".$teach."', capacity = '".$capacity."' WHERE duid = ".$duid."";

$que = mysql_query($sql);


if($que)
{
?>
	<script language="javascript">
	<!--
	alert("정상적으로 수정되었습니다.");
	//-->
	</script>
<?
}
?>

<script language="javascript">
<!--
opener.window.location.href="edu.php?kind=<?=$kind?>&page=<?=$page?>";
history.back(-1);
//self.close();
-->
</script>