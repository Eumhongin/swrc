<?
  session_start();
  include("../admin_security.php");

	include("../../config/mysql.inc.php");     //** �������

  $mysql = new Mysql_DB;
	$mysql->Connect();

#kind ���� = 1:���԰���, 2:��ȹ����
if(!$kind) { $kind = 1; }
if			($kind == 1) { $kind_name = "����"; }
else if	($kind == 2) { $kind_name = "��ȹ"; }

$SQL = "SELECT * FROM edu WHERE uid = ".$uid;
$QUE = mysql_query($SQL);
$RES = mysql_fetch_array($QUE);

$uid		= $RES[uid];
$subject	= $RES[subject];
$sdate		= $RES[sdate];
$edate		= $RES[edate];
$stime		= $RES[stime];
$etime		= $RES[etime];
$t_time		= $RES[t_time];
$price		= $RES[price];
$room		= $RES[room];
$t_person	= $RES[t_person];
$teach		= $RES[teach];
$damdang	= $RES[damdang];
$content1	= nl2br(stripslashes($RES[content1]));
$content2	= nl2br(stripslashes($RES[content2]));
$up_file	= $RES[up_file];




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

										<script language="JavaScript" type="text/JavaScript">
										<!--
										function chk_form()
										{
												if(!document.thisform.subject.value)
												{
														alert("���¸��� �Է��Ͽ��ֽʽÿ�.");
														document.thisform.subject.focus();
														return;
												}

												if(!document.thisform.t_time.value)
												{
														alert("�Ѱ��� �ð��� �Է��Ͽ��ֽʽÿ�.\n\n�Ѱ��� �ð��� ���ǳ��� ��Ͻ� �����ϽǼ� �ֽ��ϴ�.");
														document.thisform.t_time.focus();
														return;
												}

												if(!document.thisform.price.value)
												{
														alert("�����Ḧ �Է��Ͽ� �ֽʽÿ�.");
														document.thisform.price.focus();
														return;
												}

												document.thisform.submit();
										}
										//-->
										</script>



<script language="javascript">
<!--
function go_list()
{
	location.href="edu_view.php?kind=<?=$kind?>&uid=<?=$uid?>";
}
-->
</script>

<script language="JavaScript" type="text/JavaScript">
<!--
function list_add()
{
		if(!document.thisform.l_subject_add.value)
		{
				alert("���ǳ����� �Է��Ͽ� �ֽʽÿ�.");
				document.thisform.l_subject_add.focus();
				return;
		}

		l_subject = document.thisform.l_subject_add.value;
		other = document.thisform.other_add.value;

		location.href="edu_edit_adb.php?kind=<?=$kind?>&uid=<?=$uid?>&l_subject="+l_subject+"&other="+other;
}
//-->
</script>



<table width=660 cellpadding=0 cellspacing=0>
		<tr>
				<td height="53" background="../images/common/top_title_bg.gif">
						
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr>
										<td width="10"></td>
										<td width="163"><?=$kind_name?> ���� </td>
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
						
						<!-- main contents S-->

						<form name=thisform method=post action="edu_edit_db.php">
						<input type=hidden name=kind value="<?=$kind?>">
						<input type=hidden name=uid value="<?=$uid?>">

										<table width="100%" cellpadding=5 cellspacing=1 border=0 bgcolor=333333>
										<tr bgcolor="#EAEAEA">
												<td>���¸�</td>
												<td bgcolor="#FFFFFF"><input type=text name=subject value=<?=$subject?>></td>
												<td>�� ���ǽð�</td>
												<td bgcolor="#FFFFFF"><input type=text name=t_time value=<?=$t_time?>></td></tr>

										<?
										$pYear = date("Y", time());
										$pMonth = date("m", time());
										$pDay = date("d", time());

										$psYear = date("Y", $sdate);
										$psMonth = date("m", $sdate);
										$psDay = date("d",$sdate);
										$peYear = date("Y", $edate);
										$peMonth = date("m", $edate);
										$peDay = date("d",$edate);

										?>
										<tr bgcolor="#EAEAEA">
												<td>������
												<td bgcolor="#FFFFFF"><select name="sYear">
														<?
														for($i = 2007 ; $i <= $pYear + 1 ; $i++)
														{
															$sel = ($i == $psYear) ? "selected" : "";

															echo "<option value='{$i}' {$sel}>".$i;
														}
														?>
													</select>��&nbsp;&nbsp;
													
													<select name="sMonth">
														<?
														for($i = 1 ; $i <= 12 ; $i++)
														{
															$sel = ($i == $psMonth) ? "selected" : "";

															echo "<option value='{$i}' {$sel}>".$i;
														}
														?>
													</select>��&nbsp;&nbsp;

													<select name="sDay">
														<?
														for($i = 1; $i <=31 ; $i++)
														{
															$sel = ($i == $psDay) ? "selected" : "";

															echo "<option value='{$i}' {$sel}>".$i;
														}
														?>
													</select>��



												</td>
												<td>������</td>
												<td bgcolor="#FFFFFF">
													<select name="eYear">
														<?
														for($i = 2007 ; $i <= $pYear + 1 ; $i++)
														{
															$sel = ($i == $peYear) ? "selected" : "";

															echo "<option value='{$i}' {$sel}>".$i;
														}
														?>
													</select>��&nbsp;&nbsp;
													
													<select name="eMonth">
														<?
														for($i = 1 ; $i <= 12 ; $i++)
														{
															$sel = ($i == $peMonth) ? "selected" : "";

															echo "<option value='{$i}' {$sel}>".$i;
														}
														?>
													</select>��&nbsp;&nbsp;

													<select name="eDay">
														<?
														for($i = 1; $i <=31 ; $i++)
														{
															$sel = ($i == $peDay) ? "selected" : "";

															echo "<option value='{$i}' {$sel}>".$i;
														}
														?>
													</select>��


												</td>

										</tr>
										<tr bgcolor="#EAEAEA">
											<td>���ǽð�
											<td bgcolor="#FFFFFF">
												<select name=sTime>
													<?
													for($i = 1 ; $i <= 24 ; $i++)
													{
														echo "<option value='$i'>$i";
													}
													?>
												</select> 
												~ 
												<select name=eTime>
													<?
													for($i = 1 ; $i <= 24 ; $i++)
													{
														echo "<option value='$i'>$i";
													}
													?>
												</select>
											</td>
											<td>������</td>
											<td bgcolor="#FFFFFF"><input type=text name=price></td>
										</tr>
										<tr bgcolor="#EAEAEA">
											<td>���ǽ�</td>
											<td bgcolor="#FFFFFF"><input type=text name=room></td>
											<td>�����</td>
											<td bgcolor="#FFFFFF"><input type=text name=teach></td>
										</tr>
										<tr bgcolor="#EAEAEA">
											<td>�����ο�</td>
											<td bgcolor="#FFFFFF"><input type=text name=t_person></td>
											<td>�����</td>
											<td bgcolor="#FFFFFF"><input type=text name=damdang></td>
										</tr>
										<tr bgcolor="#EAEAEA">
											<td>��������</td>
											<td bgcolor="#FFFFFF" colspan=3><textarea name=content1 style="width:100% ; height:100"></textarea></td>
										</tr>
										<tr bgcolor="#EAEAEA">
											<td>��������</td>
											<td bgcolor="#FFFFFF" colspan=3><textarea name=content2 style="width: 100% ; height : 100"></textarea></td>
										</tr>
										<tr bgcolor="#EAEAEA">
											<td>���α�������</td>
											<td bgcolor="#FFFFFF" colspan=3><input type=file name="file"></td>
										</tr>
										</table>

										




										<br>
								

										<table width=100% cellpadding=5 cellspacing=0 border=0>
										<tr><td align=right><input type=button value="���� ���� ���" onClick="chk_form()"></td>
										</table>
										</form>


							</form>

				</td>
		</tr>
</table>

</BODY>
</HTML>
