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
	alert('수정되었습니다.');
	location.href='<?=$pageUrl?>&page=/pages/admin/edu/edu_order.php';
-->
</script>