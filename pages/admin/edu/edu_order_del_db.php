<?

include("../../config/mysql.inc.php");

$pageUrl .= $pageName;

$mysql = new Mysql_DB;
$mysql->Connect();

$que = mysql_query("DELETE FROM edu_order WHERE ouid = ".$ouid."");

#header("Location: ./edu_order.php");
?>
<!--<META HTTP-EQUIV='refresh' CONTENT='0; url=./edu_order.php'>-->

<script type="text/javascript">
<!--
	alert('�����Ǿ����ϴ�.');
	location.href='<?=$pageUrl?>&page=/pages/admin/edu/edu_order.php';
-->
</script>