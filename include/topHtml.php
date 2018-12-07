<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>����Ʈ���� ������ Ȩ������ <?=$menuHistoryName?></title>
<link rel="stylesheet" type="text/css" href="/css/common.css"/>
<link rel="stylesheet" type="text/css" href="/css/layout.css"/>
<link rel="stylesheet" type="text/css" href="/css/contents.css"/>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<script type="text/javascript" src="/js/common.js"></script>
<script type="text/javascript" src="/js/member.js" ></script>

<script type="text/javascript" src="/js/jquery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.cookie.js"></script>
<script type="text/javascript" src="/js/jquery/zoom.js"></script>

</head>
<body class="sub">

<div id="accessibility">
    <ul>
        <li><a href="#topLogo">�ΰ� �ٷΰ���</a></li>
        <li><a href="#topMenu">���θ޴� �ٷΰ���</a></li>
        <li><a href="#subMenu">����޴� �ٷΰ���</a></li>
        <li><a href="#subContents">�������� �ٷΰ���</a></li>
        <li><a href="#bottomCopy">�ϴܸ޴� �ٷΰ���</a></li>
    </ul>
</div>
<hr/>

<div id="Wrap_sub">
<div id="Wrap">
	<div id="topWrap">
<?php
	include("menuHtml.php");
?>
	 </div><!-- //topWrap -->


    <div id="subWrap">

        <div id="subMenu">
<?php

	if($subMenuList){

		//3depth ���� ����ϱ� ���� flag 
		$isfirstTreeDpt = true;

		$DisplayLi = false;

		$MenuLength = mysql_num_rows($subMenuList);

		for($i = 0; $i < $MenuLength; $i++){
			$row = mysql_fetch_array($subMenuList);
			$useFlag = $row[menu_use_flag];

			//�̻���� ��� �ǳʶڴ�.
			if($row[menu_use_flag] == "N") continue;
			//ǥ�þ��� ���� && 2depth �̻��ϰ�� �ǳʶڴ�.
			if($row[menu_use_flag] == "U" && $row[menu_depth] > 1 ) continue;

			//ȸ�� �޴� �α��� ����
			if($row[menu_idx] == 69 || $row[menu_idx] == 70 || $row[menu_idx] == 71 ){
				if($HTTP_SESSION_VARS[duid] != "") continue;
			}

			if($row[menu_idx] == 72 || $row[menu_idx] == 73 || $row[menu_idx] == 74 ){
				if($HTTP_SESSION_VARS[duid] == "") continue;
			}


			// URL ����
			$Target	= "";
			if ($row[menu_link_type] == URL_LINK_TYPE) {
				$URL = $row[menu_link] == "" ? "#" : $row[menu_link];

				$Target = "target=\"".$row[menu_target] == "" ? "_self" : $row[menu_target]."\"";

				if($row[menu_target] == ""){
					$Target = "target=\"_self\"";
				}else{
					$Target = "target=\"".$row[menu_target]."\"";
				}

				if($row[menu_target] == "_blank")
				{
					$TargetImg = "<img src=\"/images/common/point_blank.gif\" alt=\"��â\" />";
					$hardTitle = "title=\"��â\"";
				}
				else {
					$TargetImg = "";
					$hardTitle = "";
				}
			}
			// Javascript
			else if ($row[menu_link_type] == JAVASCRIPT_LINK_TYPE) {
				$URL = "javascript:".$row[menu_link];
			}
			// ������
			else {
				$URL = "./sub.php?menuIdx=".$row[menu_idx];
			}

			// ��ũ ���� ��Ÿ�� ����
			 if( $TwoDepthMenuIdx == $row[menu_idx]  ) 
				 $cssName = "sm_".$mMenu;
			 else
				 $cssName = "sm_off";
			
			 if( $ThreeDepthMenuIdx == $row[menu_idx]  ) 
				 $ThreeCss = "class=\"".$ThreeClass."\"";
			 else 
				 $ThreeCss = "";

			//�޴� ����
			$sMenuExplode = explode("_", $row[menu_division]);
			$smon = "";
			//if($sMenuExplode[0] == $row[menu_division]) $smon = "class=\"sm_on\" ";
			if($menuIdx == $row[menu_idx]) $smon = "ok";

			//2depth �� �ѹ��̶� ���Դ� ������ </li> �� ����ش�.
			if($isfirstTreeDpt){
				if($DisplayLi && $row[menu_depth] != 3){
					echo "</li >";
					$DisplayLi = false;
				}
			}

			switch ($row[menu_depth]){
				
				case		1	:
				?><h2><img src="/images/menu/left_title_<?=$row[menu_division]?>.jpg" alt="<?=utf8ToEuckr($row[menu_title])?>" class="pad_l5 mar_b10"/></h2>
						<ul><? // ����÷�� ���� UL

						if($row[menu_idx] == 3 || $row[menu_idx] == 17 ){
							?>
							<?
								//3Depth �޴��� �ѷ��� �� 2Depth �ϰ��
								if(!$isfirstTreeDpt){
									echo "</ul >\n";
									echo "</li>\n";
									$isfirstTreeDpt = true;
								}
							?>

						<?	// ȸ�� ����� �����
							if($HTTP_SESSION_VARS[duid] == "" && $row[menu_idx] == 16) continue;?>
						<li><a href="<?=$URL?>" <?=$Target?><?=$hardTitle?>><?if($smon=="ok"){?><img src="/images/menu/left_menu_<?=$row[menu_idx]?>_on.jpg" class="mar_l24"><?}else{?><img src="/images/menu/left_menu_<?=$row[menu_idx]?>_off.jpg" class="mar_l30 mar_t4"><?}?></a><?=$TargetImg?>
						<img src="/images/menu/left_menu_bar2.jpg" class="pad_l20 mar_t4 <?if($row[menu_idx] == 10){?>mar_b33<?}else if($row[menu_idx] == 18){?>mar_b20<?}else if($row[menu_idx] == 3 || $row[menu_idx] == 17){?>mar_b80<?}else if($row[menu_idx] == 18){if($HTTP_SESSION_VARS[duid] == ""){?>mar_b80<?}}else if($row[menu_idx] == 8){?>mar_b20<?}?>" >
						<?
							$DisplayLi = true;
						}

				break;

				case		2	:						
					?>
							<?
								//3Depth �޴��� �ѷ��� �� 2Depth �ϰ��
								if(!$isfirstTreeDpt){
									echo "</ul >\n";
									echo "</li>\n";
									$isfirstTreeDpt = true;
								}
							?>

						<?	// ȸ�� ����� �����
							if($HTTP_SESSION_VARS[duid] == "" && $row[menu_idx] == 16) continue;?>
						<li><a href="<?=$URL?>" <?=$Target?><?=$hardTitle?>><?if($smon=="ok"){?><img src="/images/menu/left_menu_<?=$row[menu_idx]?>_on.jpg" class="mar_l24"><?}else{?><img src="/images/menu/left_menu_<?=$row[menu_idx]?>_off.jpg" class="mar_l30 mar_t4"><?}?></a><?=$TargetImg?>
						<img src="/images/menu/left_menu_bar2.jpg" class="pad_l20 mar_t4 <?if($row[menu_idx] == 10){?>mar_b33<?}else if($row[menu_idx] == 18){?>mar_b20<?}else if($row[menu_idx] == 3 || $row[menu_idx] == 17){?>mar_b80<?}else if($row[menu_idx] == 18){if($HTTP_SESSION_VARS[duid] == ""){?>mar_b80<?}}else if($row[menu_idx] == 8){?>mar_b20<?}?>" >
					<?
						$DisplayLi = true;
					break;
				case		3	:
						if( $TwoDepthMenuIdx != $row[menu_parent_idx]  ) continue; // two depth �޴� idx �� ���� �޴��� �θ� idx �� ���ƾ߸� 3depth ���� �޴� ���

						//if( PtempMenuBean.getDepth() == 2 ) // ���� �޴� depth 2 �̰� ���� depth 3 �̸� ����
						if ($isfirstTreeDpt) echo "<ul>\n";
						?>
						<li <?if($ThreeDepthDivision == $row[menu_division]){?>class="cm_fc"<?}?>><a href="<?=$URL?>" <?=$Target?> <?if( $row[menu_target] == "_blank") {?><?=$hardTitle?><?}?>><?=utf8ToEuckr($row[menu_title])?></a> <?=$TargetImg?></li>
						<?
						$isfirstTreeDpt = false;
					break;
				default	 :

					break;

			}

		}//End for($i = 0; $i < $MenuLength; $i++)

			//3Depth �޴��� �ѷ��� �� �� �̻� �޴��� ���� ���.
			if(!$isfirstTreeDpt){
				echo "</ul >\n";
				$isfirstTreeDpt = true;
			}

			//2Depth�� �������� �ѷ����� ���
			if($DisplayLi) echo "</li>";


	}//End if($subMenuList)
?>

		</ul>
		
        </div><!-- //subMenu -->
		
		<div id="contactus">
			<img src="/images/menu/contactus.jpg">
		</div>


        <hr/>

        <div id="subContents">