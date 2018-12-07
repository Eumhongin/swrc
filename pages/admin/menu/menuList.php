<?php
	//include("./admin_security.php");
	include("./include/adminMenuManage.php");
?>

<table class="base_table" >
  <tr>
	  <td  valign="top">
		<table cellspacing="0" class="contents_wrap_table">
		<tr>
			<td valign="top">
				<div class="ct_btn_area">
					<ul>
						<li id="mnuInfo"><a href="javascript:viewInfo('mnuInfo')">분류보기</a></li>
						<li id="mnuAdd"><a href="javascript:viewInfo('mnuAdd')">분류등록</a></li>
					</ul>
				</div>
			</td>
		</tr>
		<tr>
			<td height="100%" valign="top">
				<iframe onload="javascript:resizeIFrame('iFrmCategoryInfo')" id="iFrmCategoryInfo" name="iFrmCategoryInfo" src="" width="100%" height="100%" frameborder="0" scrolling="yes"></iframe>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<script type="text/javascript">
<!--
document.onload = setMenu(); 
//-->
</script>