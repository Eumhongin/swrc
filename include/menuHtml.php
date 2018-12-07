	<div id="topLogo">
		<h1><a href="/open_content/main_page.php"><img src="/images/menu/logo2.jpg" alt="swrc" /></a></h1>
	</div>
		<div id="topUtilMenuHome">
			<a href="/"><img src="/images/menu/quick_home.jpg"></a>
        </div>
		<div id="topUtilMenuLogin">
			<?if($HTTP_SESSION_VARS[duid] == ""){?>
				<img src="/images/menu/quick_bar.jpg"><a href="/open_content/sub.php?menuIdx=17"><img src="/images/menu/quick_login.jpg" class="pad_l4"></a>
			<?}else{?>
				<img src="/images/menu/quick_bar.jpg"><a href="/pages/member/logout.php"><img src="/images/menu/logout.jpg" alt="" class="vmiddle pad_t2" /></a>
			<?}?>
        </div>
		<div id="topUtilMenuFavo">
			<img src="/images/menu/quick_bar.jpg"><a href="javascript:window.external.AddFavorite('http://swrc.knu.ac.kr/', 'SWRC 홈페이지');"><img src="/images/menu/quick_favorite.jpg"></a>
        </div>
		<ul id="topMenu">
<?php	
	//상단 메뉴 표시부분
	if($topMenuList)
	{
		$URL = "";
		$cssName = "";
		$useFlag = "";
		$sbMenuListHTML = new stringBuffer();
		$bgcss = "";

		//$topMenuList 의 행 개수.
		$MenuLength = mysql_num_rows($topMenuList);
		
		for($i = 0; $i < $MenuLength; $i++)
		{
			$row = mysql_fetch_array($topMenuList);
			//사용인 경우만
			if($row[menu_use_flag] != "Y") continue;
			
			//URL 지정
			if($row[menu_link_type] == URL_LINK_TYPE){
				$URL = $row[menu_link] == "" ? "#" : $row[menu_link];
			}

			// Javascript
			else if($row[menu_link_type] == JAVASCRIPT_LINK_TYPE){
				$URL = "javascript:".$row[menu_link];
			}
			// 나머지
			else{
				$URL = "./sub.php?menuIdx=".$row[menu_idx];
			}
		?>
		<?if($i==0){?>
		<li class="pad_l50">
		<?}else{?>
		<li class="">
		<?}?>
		<a href="<?=$URL?>"><img src="/images/menu/menu_<?=$i+1?>_off.jpg" alt="<?=utf8ToEuckr($row[menu_title])?>"/><?if($i+1 != 4){?><img src="/images/menu/menu_bar"/><?}?></a>
		<?
			//$i가 0 보다 클땐 $sub2DepthAllMenuList 값을 처음 결과값으로 돌린다.
			if($i > 0) mysql_data_seek($sub2DepthAllMenuList, 0);

			if($sub2DepthAllMenuList){

				$isFirst = true;			

				while($subRow = mysql_fetch_array($sub2DepthAllMenuList)){

					//사용인것이고 해당 1차의 하위인것.
					if($subRow[menu_use_flag] == "Y" && ($row[menu_idx] == $subRow[menu_parent_idx])){
						
						//Sub Menu URL 지정
						if($subRow[menu_link_type] == URL_LINK_TYPE){
							$URL = $subRow[menu_link] == "" ? "#" : $subRow[menu_link];
						}

						// Javascript
						else if($subRow[menu_link_type] == JAVASCRIPT_LINK_TYPE){
							$URL = "javascript:".$subRow[menu_link];
						}
						// 나머지
						else{
							$URL = "./sub.php?menuIdx=".$subRow[menu_idx];
						}

						if ($isFirst){
							$sbMenuListHTML->append("<li class=\"f_sm_".($i+1)." \"><a href=\"".$URL."\"");
							if ( $subRow[menu_target] != "") {
								$sbMenuListHTML->append("target=\"".utf8ToEuckr($subRow[menu_target])."\" title=\"새창\"");
							}
								$sbMenuListHTML->append("><img src=\"/images/menu/submenu_".$subRow[menu_idx].".jpg\"  alt=\"".utf8ToEuckr($subRow[menu_title])."\">");

							if ( $subRow[menu_target] != "") {
								$sbMenuListHTML->append("<img src=\"/images/common/point_blank.gif\" alt=\"새창\" class=\"vmiddle\"/>");
							}
							$sbMenuListHTML->append("</a></li>");
						}else{

							// 회원 계시판은 비회원에게 보이지 않게 한다.
							if($HTTP_SESSION_VARS[duid] == "" && $subRow[menu_idx] == 16) continue;

							$sbMenuListHTML->append("<li><img src=\"/images/menu/submenu_bar.jpg\"><a href=\"".$URL."\"");

							if ( $subRow[menu_target] != "") {
								$sbMenuListHTML->append("target=\"".$subRow[menu_target]."\" title=\"새창\"");
							}
							$sbMenuListHTML->append("><img src=\"/images/menu/submenu_".$subRow[menu_idx].".jpg\"  alt=\"".utf8ToEuckr($subRow[menu_title])."\">");

							if ( $subRow[menu_target] != "") {
								$sbMenuListHTML->append("<img src=\"/images/common/point_blank.gif\" alt=\"새창\" class=\"vmiddle\"/>");
							}
							$sbMenuListHTML->append("</a></li>");							
						}

						$isFirst = false;
					}
				}//End for($k = 0 ; $k < $SubMenuLength; $k++)
				$SubMenuList = $sbMenuListHTML->getStringValue();
				$sbMenuListHTML->init();
				if($SubMenuList != ""){
					?><ul><?=$SubMenuList?></ul><?
				}
				$SubMenuList = "";
			}//End if($sub2DepthAllMenuList)
			?></li><?
		}//End for($i = 0; $i < $MenuLength; $i++)
	}//End if($topMenuList)
?>
		</ul><!--topMenu End-->
<?php
if($mMenu == "1") $mNo = 1;
else if($mMenu == "2") $mNo = 2;
else if($mMenu == "3") $mNo = 3;
else if($mMenu == "4") $mNo = 4;
else $mNo = 1;
?>

		<script type="text/javascript">
		//<![CDATA[
			initNavigation(<?=$mNo?>);
		//]]>
		</script>
		
	<hr/>