
<?
	include("../../config/mysql.inc.php");
	include("../../query/menu/menuQuery.php");

	$pageUrl .= "�޴�����";

	updateMenuOrder($nowIdx, $changeCode);
	updateMenuOrder($changeIdx, $nowCode);
?>
<script type="text/javascript">
	location.href="<?=$pageUrl?>&page=/pages/admin/menu/menuList.php";
</script>