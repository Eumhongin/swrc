<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>소프트웨어 연구소 홈페이지 <?=$menuHistoryName?></title>
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
        <li><a href="#topLogo">로고 바로가기</a></li>
        <li><a href="#topMenu">메인메뉴 바로가기</a></li>
        <li><a href="#subMenu">서브메뉴 바로가기</a></li>
        <li><a href="#subContents">본문내용 바로가기</a></li>
        <li><a href="#bottomCopy">하단메뉴 바로가기</a></li>
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

		//3depth 에서 사용하기 위한 flag 
		$isfirstTreeDpt = true;

		$DisplayLi = false;

		$MenuLength = mysql_num_rows($subMenuList);

		for($i = 0; $i < $MenuLength; $i++){
			$row = mysql_fetch_array($subMenuList);
			$useFlag = $row[menu_use_flag];

			//미사용일 경우 건너뛴다.
			if($row[menu_use_flag] == "N") continue;
			//표시안함 설정 && 2depth 이상일경우 건너뛴다.
			if($row[menu_use_flag] == "U" && $row[menu_depth] > 1 ) continue;

			//회원 메뉴 로그인 구분
			if($row[menu_idx] == 69 || $row[menu_idx] == 70 || $row[menu_idx] == 71 ){
				if($HTTP_SESSION_VARS[duid] != "") continue;
			}

			if($row[menu_idx] == 72 || $row[menu_idx] == 73 || $row[menu_idx] == 74 ){
				if($HTTP_SESSION_VARS[duid] == "") continue;
			}


			// URL 지정
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
					$TargetImg = "<img src=\"/images/common/point_blank.gif\" alt=\"새창\" />";
					$hardTitle = "title=\"새창\"";
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
			// 나머지
			else {
				$URL = "./sub.php?menuIdx=".$row[menu_idx];
			}

			// 링크 선택 스타일 지정
			 if( $TwoDepthMenuIdx == $row[menu_idx]  ) 
				 $cssName = "sm_".$mMenu;
			 else
				 $cssName = "sm_off";
			
			 if( $ThreeDepthMenuIdx == $row[menu_idx]  ) 
				 $ThreeCss = "class=\"".$ThreeClass."\"";
			 else 
				 $ThreeCss = "";

			//메뉴 설정
			$sMenuExplode = explode("_", $row[menu_division]);
			$smon = "";
			//if($sMenuExplode[0] == $row[menu_division]) $smon = "class=\"sm_on\" ";
			if($menuIdx == $row[menu_idx]) $smon = "ok";

			//2depth 에 한번이라도 들어왔다 나오면 </li> 를 찍어준다.
			if($isfirstTreeDpt){
				if($DisplayLi && $row[menu_depth] != 3){
					echo "</li >";
					$DisplayLi = false;
				}
			}

			switch ($row[menu_depth]){
				
				case		1	:
				?><h2><img src="/images/menu/left_title_<?=$row[menu_division]?>.jpg" alt="<?=utf8ToEuckr($row[menu_title])?>" class="pad_l5 mar_b10"/></h2>
						<ul><? // 제일첨음 시작 UL

						if($row[menu_idx] == 3 || $row[menu_idx] == 17 ){
							?>
							<?
								//3Depth 메뉴가 뿌려진 뒤 2Depth 일경우
								if(!$isfirstTreeDpt){
									echo "</ul >\n";
									echo "</li>\n";
									$isfirstTreeDpt = true;
								}
							?>

						<?	// 회원 계시판 숨기기
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
								//3Depth 메뉴가 뿌려진 뒤 2Depth 일경우
								if(!$isfirstTreeDpt){
									echo "</ul >\n";
									echo "</li>\n";
									$isfirstTreeDpt = true;
								}
							?>

						<?	// 회원 계시판 숨기기
							if($HTTP_SESSION_VARS[duid] == "" && $row[menu_idx] == 16) continue;?>
						<li><a href="<?=$URL?>" <?=$Target?><?=$hardTitle?>><?if($smon=="ok"){?><img src="/images/menu/left_menu_<?=$row[menu_idx]?>_on.jpg" class="mar_l24"><?}else{?><img src="/images/menu/left_menu_<?=$row[menu_idx]?>_off.jpg" class="mar_l30 mar_t4"><?}?></a><?=$TargetImg?>
						<img src="/images/menu/left_menu_bar2.jpg" class="pad_l20 mar_t4 <?if($row[menu_idx] == 10){?>mar_b33<?}else if($row[menu_idx] == 18){?>mar_b20<?}else if($row[menu_idx] == 3 || $row[menu_idx] == 17){?>mar_b80<?}else if($row[menu_idx] == 18){if($HTTP_SESSION_VARS[duid] == ""){?>mar_b80<?}}else if($row[menu_idx] == 8){?>mar_b20<?}?>" >
					<?
						$DisplayLi = true;
					break;
				case		3	:
						if( $TwoDepthMenuIdx != $row[menu_parent_idx]  ) continue; // two depth 메뉴 idx 와 현재 메뉴의 부모 idx 가 같아야만 3depth 하위 메뉴 출력

						//if( PtempMenuBean.getDepth() == 2 ) // 이전 메뉴 depth 2 이고 현재 depth 3 이면 시작
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

			//3Depth 메뉴가 뿌려진 뒤 더 이상 메뉴가 없는 경우.
			if(!$isfirstTreeDpt){
				echo "</ul >\n";
				$isfirstTreeDpt = true;
			}

			//2Depth가 마지막에 뿌려지는 경우
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