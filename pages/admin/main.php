<?php
	session_start();
	include("./admin_security.php");
	include("../../config/request.inc.php"); 

	$pg = getParameter($_REQUEST["page"], "/pages/admin/blank.php");
	$pageUrl = "/pages/admin/main.php?pageName=";
	//session_register("pageUrl");
	$_SESSION['pageUrl'] = $pageUrl;
	$processUrl = "/pages/admin/process.php?pageName=";
	//session_register("processUrl");
	$_SESSION['processUrl'] = $processUrl;

	include_once "./include/adminTopHtml.php";
?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="center">
				<!-- 타이틀 -->
				<table width="100%" cellpadding="0" cellspacing="0">
				<tr height="41">
					<td style="background:url('/pages/admin/images/common/sub_title_left.gif'); padding:2 0 0 14;"  align="left" class="pad_l20 pad_t5">
						<img src="/pages/admin/images/common/bullet_title.gif" /> <span class="f_blue f_14 bold"><?=$pageName?></span>
					</td>
					<td style="background:url('/pages/admin/images/common/sub_title_right.gif') right"></td>
				<tr>
					<td colspan="2" height="20"></td>
				</tr>
				</table>
				<!-- 타이틀 끝 -->
				<?php
					include($_SERVER["DOCUMENT_ROOT"].$pg);
				?>
			</td>
		</tr>
	</table>

<?php
	include_once "./include/adminBottomHtml.php";
?>