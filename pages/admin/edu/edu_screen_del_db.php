<?
session_start();
include "../lib/admin_session_chk.php";
include "../inc/mysql.php";


$que = mysql_query("DELETE FROM edu_screen WHERE uid = ".$uid);

if(!$que)
{
	?>

	<script language="JavaScript" type="text/JavaScript">
	<!--
			alert("ERROR : 0013");
			return;
	//-->
	</script>
	<?
	exit;
}
else
{
	?>
	<script language="JavaScript" type="text/JavaScript">
	<!--
			alert("삭제되었습니다.");
			location.href="edu_screen.php";
	//-->
	</script>
	<?

}
?>