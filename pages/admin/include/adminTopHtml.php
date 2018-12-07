<!--

-->
<?
	include ("../../config/mysql.inc.php");
	$duid = $HTTP_SESSION_VARS[dupower];
	$duname = $HTTP_SESSION_VARS[duname];
	$duchmember = $HTTP_SESSION_VARS[duchmember];
	$dupower = $HTTP_SESSION_VARS[dupower];
	$pageName = $_REQUEST["pageName"];
	$page = $_REQUEST["page"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>STRC 관리자</title>
<link rel="stylesheet" type="text/css" href="/pages/admin/css/admin_common.css"/>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<script type="text/javascript" src="/js/common.js"></script>
<script type="text/javascript" src="/js/prototype.js"></script>
</head>

<body style="margin:6">

<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" style="background:url('/pages/admin/images/common/top_back_right.gif') no-repeat right 0; padding:0 25px 0 0;">
      <table width="100%" height="100" cellpadding="0" cellspacing="0" style="background:url('/pages/admin/images/common/top_back_left.gif') no-repeat;">
        <tr valign="top">
          <!--<td style="padding:26 0 0 28">  </td>-->
          <td style="padding:18 28 0 0" align="right">
            <table cellpadding="0" cellspacing="0" class="mar_t5">
              <tr>
                <td><a href="" target="_blank"><img src="/pages/admin/images/common/top_umenu_home.gif"></a></td>
                <td><a href="/pages/admin/login/admin_logout.php"><img src="/pages/admin/images/common/top_umenu_logout.gif"></a></td>
              </tr>
            </table>
            <table id="topMenu" cellpadding="0" cellspacing="0">
              <tr>
				<td><a href="<?=$pageUrl."메뉴관리"?>&page=/pages/admin/menu/menuList.php" class="mmenu">메뉴관리</a></td>
				<td><a href="<?=$pageUrl."콘텐츠관리"?>&page=/pages/admin/cms/cmsManagementList.php" class="mmenu">콘텐츠관리</a></td>
				<td><a href="<?=$pageUrl."게시판관리"?>&page=/pages/admin/bbs/bbs_admin.php" class="mmenu">게시판관리</a></td>
				<!--<td><a href="<?= $pageUrl."알림창관리"?>&page=/pages/admin/imageWindow/imageWindowList.php" class="mmenu">알림창관리</a></td>-->
				<td><a href="<?= $pageUrl."회원관리"?>&page=/pages/admin/member/list.php" class="mmenu">회원관리</a></td>
				<td><a href="<?= $pageUrl."통계관리"?>&page=/pages/admin/counter/total.php" class="mmenu">통계관리</a></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="20" style="background:url('/pages/admin/images/common/middle_back_left.gif') repeat-y;"></td>
    <td width="100%" style="padding:10 0 24 0;">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr valign="top">
          <td width="228">
            <!-- 로그인 -->
            <table width="206" cellpadding="0" cellspacing="0">
              <tr>
                <td height="124" style="background:url('/pages/admin/images/common/login_back.gif')" valign="top">
                  <table width="206" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="pad_t95" width="80">
                        
                      </td>
                      <td width="126">
                        <span class="f_orange bold " ><?=utf8ToEuckr($duname)?></span><br>
                        <a href="/pages/admin/login/admin_logout.php"><img src="/pages/admin/images/common/btn_logout.gif" vspace="5"></a>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center" class="f_11 f_gray">IP:<?=$REMOTE_ADDR?> &nbsp; Date:<?=date(Y.".".m.".".d)?></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
            </table>
            <!-- 로그인 끝 -->
            <!-- 서브메뉴 -->
            <table width="206" cellpadding="0" cellspacing="0">
              <tr>
                <td><img src="/pages/admin/images/common/smenu_top.gif"></td>
              </tr>
              <tr>
                <td style="background:url('/pages/admin/images/common/smenu_back.gif')">
<?
	if($pageName == "메뉴관리"){
?>
				<table width="170" cellpadding="0" cellspacing="0" align="center">
                    <tr height="24">
                      <td class="f_blue f_14 bold"><img src="/pages/admin/images/common/bullet_folder.gif"> 메뉴관리</td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#CCCCCC"></td>
                    </tr>
                    <tr>
                      <td height="8"></td>
                    </tr>
                    <tr height="22">
                      <td>
                      <!--<img src="/pages/admin/images/common/bullet_arrow_blue.gif"> 메뉴를 선택해 주세요.
                      -->
                      </td>
                    </tr>
                  </table>	
<?
	}else if ($pageName == "콘텐츠관리"){
?>
		<table width="170" cellpadding="0" cellspacing="0" align="center">
			<tr height="24">
			  <td class="f_blue f_14 bold"><img src="/pages/admin/images/common/bullet_folder.gif"> 콘텐츠관리</td>
			</tr>
			<tr>
			  <td height="1" bgcolor="#CCCCCC"></td>
			</tr>
			<tr>
			  <td height="8"></td>
			</tr>
			<tr height="22">
			  <td><img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."콘텐츠관리"?>&amp;page=/pages/admin/cms/cmsManagementList.php" <?= $pageName == "콘텐츠관리" ? "class=\"bold\"" : "" ?>>콘텐츠관리</a></td>
			</tr>
		  </table>	
<?
	}else if ($pageName == "게시판관리"){
?>
		<table width="170" cellpadding="0" cellspacing="0" align="center">
			<tr height="24">
			  <td class="f_blue f_14 bold"><img src="/pages/admin/images/common/bullet_folder.gif"> 게시판관리</td>
			</tr>
			<tr>
			  <td height="1" bgcolor="#CCCCCC"></td>
			</tr>
			<tr>
			  <td height="8"></td>
			</tr>
			<tr height="22">
			  <td><img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."게시판관리"?>&amp;page=/pages/admin/bbs/bbs_admin.php" <?= $pageName == "게시판관리" ? "class=\"bold\"" : "" ?>>게시판관리</a></td>
			</tr>
		  </table>
<?
	}else if ($pageName == "통계관리" || $pageName == "분기별" || $pageName == "일별" || $pageName == "시간별" || $pageName == "월별"|| $pageName == "요일별"){
?>
		<table width="170" cellpadding="0" cellspacing="0" align="center">
			<tr height="24">
			  <td class="f_blue f_14 bold"><img src="/pages/admin/images/common/bullet_folder.gif"> 통계관리</td>
			</tr>
			<tr>
			  <td height="1" bgcolor="#CCCCCC"></td>
			</tr>
			<tr>
			  <td height="8"></td>
			</tr>
			<tr height="22">
			  <td>
				<img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."통계관리"?>&amp;page=/pages/admin/counter/total.php" <?= $pageName == "통계관리" ? "class=\"bold\"" : "" ?>>통계관리</a>
			  </td>
			</tr>
			<tr height="22">
			  <td>
				<img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."분기별"?>&amp;page=/pages/admin/counter/quater.php" <?= $pageName == "분기별" ? "class=\"bold\"" : "" ?>>분기별</a>
			  </td>
			</tr>
			<tr height="22">
			  <td>
				<img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."일별"?>&amp;page=/pages/admin/counter/day.php" <?= $pageName == "일별" ? "class=\"bold\"" : "" ?>>일별</a>
			  </td>
			</tr>
			<tr height="22">
			  <td>
				<img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."시간별"?>&amp;page=/pages/admin/counter/time.php" <?= $pageName == "시간별" ? "class=\"bold\"" : "" ?>>시간별</a>
			  </td>
			</tr>
			<tr height="22">
			  <td>
				<img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."월별"?>&amp;page=/pages/admin/counter/month.php" <?= $pageName == "월별" ? "class=\"bold\"" : "" ?>>월별</a>
			  </td>
			</tr>
			<tr height="22">
			  <td>
				<img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."요일별"?>&amp;page=/pages/admin/counter/week.php" <?= $pageName == "요일별" ? "class=\"bold\"" : "" ?>>요일별</a>
			  </td>
			</tr>
		  </table>
<?
	}else if ($pageName == "알림창관리"){
?>
		<table width="170" cellpadding="0" cellspacing="0" align="center">
			<tr height="24">
			  <td class="f_blue f_14 bold"><img src="/pages/admin/images/common/bullet_folder.gif"> 알림창관리</td>
			</tr>
			<tr>
			  <td height="1" bgcolor="#CCCCCC"></td>
			</tr>
			<tr>
			  <td height="8"></td>
			</tr>
			<tr height="22">
			  <td><img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."알림창관리"?>&amp;page=/pages/admin/imageWindow/imageWindowList.php" <?= $pageName == "알림창관리" ? "class=\"bold\"" : "" ?>>알림창관리</a></td>
			</tr>
		  </table>	


<?
	}else if ($pageName == "회원관리"){
?>
		<table width="170" cellpadding="0" cellspacing="0" align="center">
			<tr height="24">
			  <td class="f_blue f_14 bold"><img src="/pages/admin/images/common/bullet_folder.gif"> 회원관리</td>
			</tr>
			<tr>
			  <td height="1" bgcolor="#CCCCCC"></td>
			</tr>
			<tr>
			  <td height="8"></td>
			</tr>
			<tr height="22">
			  <td><img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."회원관리"?>&amp;page=/pages/admin/member/list.php" <?= $pageName == "회원관리" ? "class=\"bold\"" : "" ?>>회원관리</a></td>
			</tr>
		  </table>	


<?
	}
?>
                </td>
              </tr>
              <tr>
                <td><img src="/pages/admin/images/common/smenu_bottom.gif"></td>
              </tr>
            </table>
            <!-- 서브메뉴 끝 -->
          </td>
          <td>