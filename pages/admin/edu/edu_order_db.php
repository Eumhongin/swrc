<?
include("../../config/mysql.inc.php");

$pageUrl .= $pageName;

$mysql = new Mysql_DB;
$mysql->Connect();

#echo ("UPDATE edu_order SET state = ".$state[$ouid]." WHERE ouid = ".$ouid."");

#exit;
$que = mysql_query("UPDATE edu_order SET state = ".$state[$ouid]." WHERE ouid = ".$ouid."");


#header("Location: ./edu_order.php");
?>
<script type="text/javascript">
<!--
	alert('�����Ǿ����ϴ�.');
	location.href='<?=$pageUrl?>&page=/pages/admin/edu/edu_order.php';
-->
</script>