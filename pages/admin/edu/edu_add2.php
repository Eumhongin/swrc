<?
session_start();
include "../lib/admin_session_chk.php";

if($kind == 1)			{ $kind_name = "����"; }
else if($kind == 2)	{ $kind_name = "��ȹ"; }
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"> 
<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>���� ����</title>
</head>
<TITLE>�뱸����̵���</TITLE>
<link href=../css/default_admin.css rel="StyleSheet" type="text/css">
<script language="JavaScript" src="../js/ms_patch.js"></script>
</HEAD>
<BODY>


<Script language="javascript">
<!--
function chk_form()
{
	var yesno
	yesno=confirm("<?=$subject?> ������ ������ �Է��ϼ̽��ϴ�.\n\n����Ͻðڽ��ϱ�?");
	if (yesno == true)
	{
		document.thisform.submit();
	}
}
//-->
</Script>


<table width=660 cellpadding=0 cellspacing=0>
		<tr>
				<td height="53" background="../images/common/top_title_bg.gif">
						
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr>
										<td width="10"></td>
										<td width="163"><?=$kind_name?> ���� ��� <!--&gt; ���� ���--></td>
										<td align="right"></td>
										<td width="10"></td>
								</tr>
						</table>
						
				</td>
		</tr>
		<tr>
				<td height="15"></td>
		</tr>
		<tr>
				<td valign="top">
						
						<!----// edu lecture ��� �� s---->


										<table width="100%" cellpadding=0 cellspacing=1 border=0 bgcolor=333333>
										<tr align=center bgcolor="#EAEAEA">
												<td>����</td>
												<td>����</td>
												<td>����</td>
												<td>���¸�</td>
												<td>�� ���ǽð�</td>
												<td>������</td>
										</tr>
										<tr align=center bgcolor="#FFFFFF">
												<td><?if($kind==1){echo "����";}else if($kind==2){echo "��ȹ";}?></td>
												<td><?=$trtr?></td>
												<td><?if($level==1){echo "�ʱ�";}else if($level==2){echo "�߱�";}else if($level==3){echo "���";}?></td>
												<td><?=$subject?></td>
												<td><?=$t_time?></td>
												<td><?=number_format($price)?> ��</td>
										</tr>
										</table>

										<br>
								
										<table width=100% cellpadding=0 cellspacing=1 border=0 bgcolor=333333>
										<tr align=center>
												<td width=60 bgcolor=EAEAEA>���ǰ���</td>
												<td align=left style="padding:5 5 5 5" bgcolor=FFFFFF><?=nl2br($content)?></td>
										</tr>
										</table>



										<br>

										<table width=100% cellpadding=0 cellspacing=0 border=0>
										<tr align=center>
												<td width=100% height=2 bgcolor=666666></td>
										</tr>
										</table>

										<form name="thisform" method="post" action="edu_add2_db.php">
										<input type="hidden" name="kind"			value="<?=$kind?>">
										<input type="hidden" name="trtr"			value="<?=$trtr?>">
										<input type="hidden" name="level"		value="<?=$level?>">
										<input type="hidden" name="subject"	value="<?=$subject?>">
										<input type="hidden" name="content"	value="<?=$content?>">
										<input type="hidden" name="t_time"		value="<?=$t_time?>">
										<input type="hidden" name="price"		value="<?=$price?>">

										<table width=100% cellpadding=0 cellspacing=1 border=0>
										<tr align=center bgcolor="#EAEAEA">
												<td width=10%>ȸ��</td>
												<td width=60%>���ǳ���</td>
												<td width=30%>���� �� �ڷ�</td>
										</tr>
										<?
										$edu_list = array();
										for($i=1 ; $i <= $t_time ; $i++)
										{
												echo "	<tr align=center style='padding:0 5 0 5 '>";
												echo "			<td>".$i."</td>";
												echo "			<td align=left><input type=text name=l_subject[".$i."] style='width=100%'></td>";
												echo "			<td><input type=text name=other[".$i."] style='width=100%'></td>";
												echo "	</tr>";
										}
										?>
										</table>


										<table width=100% cellpadding=5 cellspacing=0 border=0>
										<tr><td align=right><input type=button value="��� �Ϸ�" onClick="chk_form()"></td>
										</table>
										</form>
				

						<!----// edu lecture ��� �� e---->
				</td>
		</tr>
</table>







</BODY>
</HTML>


