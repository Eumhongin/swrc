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
<title>STRC ������</title>
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
				<td><a href="<?=$pageUrl."�޴�����"?>&page=/pages/admin/menu/menuList.php" class="mmenu">�޴�����</a></td>
				<td><a href="<?=$pageUrl."����������"?>&page=/pages/admin/cms/cmsManagementList.php" class="mmenu">����������</a></td>
				<td><a href="<?=$pageUrl."�Խ��ǰ���"?>&page=/pages/admin/bbs/bbs_admin.php" class="mmenu">�Խ��ǰ���</a></td>
				<!--<td><a href="<?= $pageUrl."�˸�â����"?>&page=/pages/admin/imageWindow/imageWindowList.php" class="mmenu">�˸�â����</a></td>-->
				<td><a href="<?= $pageUrl."ȸ������"?>&page=/pages/admin/member/list.php" class="mmenu">ȸ������</a></td>
				<td><a href="<?= $pageUrl."������"?>&page=/pages/admin/counter/total.php" class="mmenu">������</a></td>
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
            <!-- �α��� -->
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
            <!-- �α��� �� -->
            <!-- ����޴� -->
            <table width="206" cellpadding="0" cellspacing="0">
              <tr>
                <td><img src="/pages/admin/images/common/smenu_top.gif"></td>
              </tr>
              <tr>
                <td style="background:url('/pages/admin/images/common/smenu_back.gif')">
<?
	if($pageName == "�޴�����"){
?>
				<table width="170" cellpadding="0" cellspacing="0" align="center">
                    <tr height="24">
                      <td class="f_blue f_14 bold"><img src="/pages/admin/images/common/bullet_folder.gif"> �޴�����</td>
                    </tr>
                    <tr>
                      <td height="1" bgcolor="#CCCCCC"></td>
                    </tr>
                    <tr>
                      <td height="8"></td>
                    </tr>
                    <tr height="22">
                      <td>
                      <!--<img src="/pages/admin/images/common/bullet_arrow_blue.gif"> �޴��� ������ �ּ���.
                      -->
                      </td>
                    </tr>
                  </table>	
<?
	}else if ($pageName == "����������"){
?>
		<table width="170" cellpadding="0" cellspacing="0" align="center">
			<tr height="24">
			  <td class="f_blue f_14 bold"><img src="/pages/admin/images/common/bullet_folder.gif"> ����������</td>
			</tr>
			<tr>
			  <td height="1" bgcolor="#CCCCCC"></td>
			</tr>
			<tr>
			  <td height="8"></td>
			</tr>
			<tr height="22">
			  <td><img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."����������"?>&amp;page=/pages/admin/cms/cmsManagementList.php" <?= $pageName == "����������" ? "class=\"bold\"" : "" ?>>����������</a></td>
			</tr>
		  </table>	
<?
	}else if ($pageName == "�Խ��ǰ���"){
?>
		<table width="170" cellpadding="0" cellspacing="0" align="center">
			<tr height="24">
			  <td class="f_blue f_14 bold"><img src="/pages/admin/images/common/bullet_folder.gif"> �Խ��ǰ���</td>
			</tr>
			<tr>
			  <td height="1" bgcolor="#CCCCCC"></td>
			</tr>
			<tr>
			  <td height="8"></td>
			</tr>
			<tr height="22">
			  <td><img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."�Խ��ǰ���"?>&amp;page=/pages/admin/bbs/bbs_admin.php" <?= $pageName == "�Խ��ǰ���" ? "class=\"bold\"" : "" ?>>�Խ��ǰ���</a></td>
			</tr>
		  </table>
<?
	}else if ($pageName == "������" || $pageName == "�б⺰" || $pageName == "�Ϻ�" || $pageName == "�ð���" || $pageName == "����"|| $pageName == "���Ϻ�"){
?>
		<table width="170" cellpadding="0" cellspacing="0" align="center">
			<tr height="24">
			  <td class="f_blue f_14 bold"><img src="/pages/admin/images/common/bullet_folder.gif"> ������</td>
			</tr>
			<tr>
			  <td height="1" bgcolor="#CCCCCC"></td>
			</tr>
			<tr>
			  <td height="8"></td>
			</tr>
			<tr height="22">
			  <td>
				<img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."������"?>&amp;page=/pages/admin/counter/total.php" <?= $pageName == "������" ? "class=\"bold\"" : "" ?>>������</a>
			  </td>
			</tr>
			<tr height="22">
			  <td>
				<img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."�б⺰"?>&amp;page=/pages/admin/counter/quater.php" <?= $pageName == "�б⺰" ? "class=\"bold\"" : "" ?>>�б⺰</a>
			  </td>
			</tr>
			<tr height="22">
			  <td>
				<img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."�Ϻ�"?>&amp;page=/pages/admin/counter/day.php" <?= $pageName == "�Ϻ�" ? "class=\"bold\"" : "" ?>>�Ϻ�</a>
			  </td>
			</tr>
			<tr height="22">
			  <td>
				<img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."�ð���"?>&amp;page=/pages/admin/counter/time.php" <?= $pageName == "�ð���" ? "class=\"bold\"" : "" ?>>�ð���</a>
			  </td>
			</tr>
			<tr height="22">
			  <td>
				<img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."����"?>&amp;page=/pages/admin/counter/month.php" <?= $pageName == "����" ? "class=\"bold\"" : "" ?>>����</a>
			  </td>
			</tr>
			<tr height="22">
			  <td>
				<img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."���Ϻ�"?>&amp;page=/pages/admin/counter/week.php" <?= $pageName == "���Ϻ�" ? "class=\"bold\"" : "" ?>>���Ϻ�</a>
			  </td>
			</tr>
		  </table>
<?
	}else if ($pageName == "�˸�â����"){
?>
		<table width="170" cellpadding="0" cellspacing="0" align="center">
			<tr height="24">
			  <td class="f_blue f_14 bold"><img src="/pages/admin/images/common/bullet_folder.gif"> �˸�â����</td>
			</tr>
			<tr>
			  <td height="1" bgcolor="#CCCCCC"></td>
			</tr>
			<tr>
			  <td height="8"></td>
			</tr>
			<tr height="22">
			  <td><img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."�˸�â����"?>&amp;page=/pages/admin/imageWindow/imageWindowList.php" <?= $pageName == "�˸�â����" ? "class=\"bold\"" : "" ?>>�˸�â����</a></td>
			</tr>
		  </table>	


<?
	}else if ($pageName == "ȸ������"){
?>
		<table width="170" cellpadding="0" cellspacing="0" align="center">
			<tr height="24">
			  <td class="f_blue f_14 bold"><img src="/pages/admin/images/common/bullet_folder.gif"> ȸ������</td>
			</tr>
			<tr>
			  <td height="1" bgcolor="#CCCCCC"></td>
			</tr>
			<tr>
			  <td height="8"></td>
			</tr>
			<tr height="22">
			  <td><img src="/pages/admin/images/common/bullet_arrow_blue.gif" /><a href="<?= $pageUrl."ȸ������"?>&amp;page=/pages/admin/member/list.php" <?= $pageName == "ȸ������" ? "class=\"bold\"" : "" ?>>ȸ������</a></td>
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
            <!-- ����޴� �� -->
          </td>
          <td>