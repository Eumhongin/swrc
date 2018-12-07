
<?
	include("../../config/mysql.inc.php");
	include("../../query/menu/menuQuery.php");

	$pageUrl .= "메뉴관리";

	updateMenuOrder($nowIdx, $changeCode);
	updateMenuOrder($changeIdx, $nowCode);
?>
<script type="text/javascript">
	location.href="<?=$pageUrl?>&page=/pages/admin/menu/menuList.php";
</script>