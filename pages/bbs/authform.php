<?
	//*******************  Information  ***********************
	//	Program Title	:	�Խ��� 
	//	File Name		  :	authform.php
	//	Company			  :	(��)��������� (053)955-9055
	//	Creator			  :	�� �� ��   2003. 12
	//							  : ���α�     2003. 12
	//*********************************************************
	

	$wb_num = $_REQUEST["wb_num"];
	$mode = $_REQUEST["mode"];
	$a_idx = $_REQUEST["a_idx"];
	$b_num = $_REQUEST["b_num"];
	$category = $_REQUEST["category"];
	$look = $_REQUEST["look"];
	
	$m_del = "Y";

	include("../config/bbs_lib.inc.php");  
	

	$mysql = new Mysql_DB;
	$mysql->Connect();

	// *** �Խ��� ȯ�� **** 
	Bbs_Config($a_idx);

  if($mode == "delete" and $b_num <> "") { /////////// �����ϱ� /////////////////////
		
    // *** ���� ���� ***
		if (!($m_del == "Y" or $HTTP_SESSION_VARS[duchmember] == 99)) {
				message("���� ������ �����ϴ�");
			
		}
		$qry = "Select * From $a_tablename Where b_num = $b_num";
		$mysql->ParseExec($qry);
		if ($mysql->RowCount() < 1) {
			 message("��ϵ� ���� �������� �ʽ��ϴ�");
		}
    $mysql->FetchInto(&$row);

    // *** ���� ����(�����)***
    if($mode == "delete" and $row[b_open] == 1 and $open_pass <> $row[b_pass]) {
      message("���� ������ �����ϴ�");
    } 

    $auth_title = "�����ϱ�";

  } else {                                  //////////����������//////////////////////////

    $auth_title = "������ ����";
		
	}
	
?>
<html>
<head>
<title><? echo $a_bbsname ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" type="text/css" href="/css/dip.css">
<script src="js/comm.js"></script>
</head>
<body onload="<? if($mode == "delete") { ?>frm.b_pass.focus()<? } else { ?>frm.m_id.focus()<? } ?>;">
<?
	//top include ����
	if (Trim($a_include_top) <> "")  Bbs_Top();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
		<? //left include ���� 
			if($a_include_left <> "") {
		?>
		<td width="180" valign="top"><? Bbs_Left(); ?></td> 
		<? } ?>
		<td valign="top" align="<? echo $a_align ?>">
			<? //�Խ��� �Ӹ���
				if (Trim($a_include_header) <> "") include("../$a_include_header");
        if (Trim($a_header) <> "") Bbs_Header();
			?>
			<table width="640" height="300" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="10"></td>
          <td width="630"><br>
					  <form name="frm" method="post" action="regist.php">
            <input type="hidden" name="a_idx" value="<? echo $a_idx ?>">
            <input type="hidden" name="b_num" value="<? echo $b_num ?>">
            <input type="hidden" name="mode" value="<? echo $mode ?>">
            <input type="hidden" name="category" value="<? echo $category ?>">
            <table width="<? echo $a_width ?>" height="60%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center">
                  <table width="300" border="0" cellspacing="0" cellpadding="0">
                    <tr bgcolor="000000"> 
                      <td height="1"></td>
                    </tr>
                    <tr bgcolor="<? echo $a_title_border ?>"> 
                      <td height="3"></td>
                    </tr>
                    <tr>
                      <td height="50" align="center">
                        <table width="100%" border="0" cellspacing="0" cellpadding="3">
                          <tr height="10">
                            <td colspan="2" align="center" bgcolor="<? echo $a_title_bgcolor ?>"><? echo $auth_title ?></td>
                          </tr>
                          <tr height="5"><td></td></tr>
                          <? if($mode == "delete") { ?>
                          <tr>
                            <td align="center"><img src="image/key.gif" border="0"><font color="<? echo $a_font_color ?>">��й�ȣ</font></td>
                            <td><input type="password" name="b_pass" size="10" maxlength="10" style='width:150;height:18px' class='tbox'></td>
                          </tr>
                          <? } else { ?>
                          <tr>
                            <td align="center"><img src="image/key.gif" border="0"><font color="<? echo $a_font_color ?>">���̵�</font></td>
                            <td><input type="text" name="m_id" size="10" maxlength="10" style='width:100;height:18px' class='tbox'></td>
                          </tr>
                          <tr>
                            <td align="center"><img src="image/key.gif" border="0"><font color="<? echo $a_font_color ?>">��й�ȣ</font></td>
                            <td><input type="password" name="m_pass" size="10" maxlength="10" style='width:150;height:18px' class='tbox'></td>
                          </tr>
                          <? } ?>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" height="20" background="image/dot_line.gif"></td>
                    </tr>
                    <tr>
                      <td align="center"><a href="javascript:<? if($mode == "delete") { ?>del_checkfrm()<? } else { ?>admin_checkfrm()<?} ?>">Ȯ��</a>&nbsp;<a href="javascript:history.back()" >�ڷΰ���</a></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            </form>
    			</td>
				</tr>
			</table>
	   <?
				//�Խ��� ������
				if (Trim($a_detail) <> "")  Bbs_Detail();
			?>
		</td>
		<td valign="top">
			<? //right include ����
			 if($a_include_right <> "") Bbs_Right(); 
			?>
		</td> 
  </tr>
</table>
<?
  //bottom include ����
  if (Trim($a_include_bottom) <> "")  Bbs_Bottom();
?>
</body>
</html>

