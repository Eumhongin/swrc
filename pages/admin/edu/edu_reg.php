<?
session_start();
include "../lib/admin_session_chk.php";
include "../inc/mysql.php";

#kind ���� = 1:���԰���, 2:��ȹ����
if(!$kind) { $kind = 1; }
if			($kind == 1) { $kind_name = "����"; }
else if	($kind == 2) { $kind_name = "��ȹ"; }

$SQL = "SELECT * FROM edu WHERE uid = ".$uid;
$QUE = mysql_query($SQL);
$RES = mysql_fetch_array($QUE);

$trtr			= $RES[trtr];
$level		= $RES[level];
$subject	= $RES[subject];
$content	= $RES[content];
$t_time		= $RES[t_time];
$price		= $RES[price];


$SQL2 = "SELECT * FROM edu_list WHERE uid = ".$uid." ORDER BY luid ASC";
$QUE2 = mysql_query($SQL2);

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



<table width=660 cellpadding=0 cellspacing=0 align=center>
<tr><td height=10></td></tr>
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

						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
						<tr><td height="15" colspan="3"></td></tr>
						<tr><td width="10"></td>
							<td height="30" valign="middle" bgcolor="EAEAEA">


										<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="10"></td>
											<td><b>�����̾� ������</b></td>
											<td width="2"><img src="../images/edu/edu_lecture_view_line.gif" width="2" height="15" align="absmiddle"></td>
											<td width="60"><center>���԰���</center></td>
											<td width="10">&nbsp;</td>
										</tr>
										</table>

							</td>
							<td width="10"></td>
						</tr>
						<tr>
							<td width="10"></td>
							<td height="2"></td>
							<td width="10"></td>
						</tr>
						<tr>
							<td width=10></td>
							<td>


										<script language="javascript">
										<!--
										function go_reg()
										{
											form = document.thisform;
											if(form.chk_date1.checked != true && form.chk_date2.checked != true && form.chk_date3.checked != true && form.chk_date4.checked != true && form.chk_date5.checked != true)
											{
												alert("���ǿ����� �ּ��� �Ϸ�� �����ϼž� �մϴ�.");
												form.chk_date1.focus();
												return;
											}

											if(!form.teach.value)
											{
												alert("������� �Է��Ͽ� �ֽʽÿ�.");
												form.teach.focus();
												return;
											}

											if(!form.room.value)
											{
												alert("���ǽ��� �Է��Ͽ� �ֽʽÿ�.");
												form.room.focus();
												return;
											}

											if(!form.capacity.value)
											{
												alert("�� ������ �Է��Ͽ� �ֽʽÿ�.");
												form.capacity.focus();
												return;
											}

											form.submit();
										}
										//-->
										</script>


										<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<form name=thisform method=method action="edu_reg_db.php">
										<input type=hidden name=uid value="<?=$uid?>">
										<input type=hidden name=price value="<?=$price?>">
										<tr><td width="10" bgcolor="E5EBEA" height="22"></td>
											<td width="90" bgcolor="E5EBEA">���ǱⰣ</td>
											<td width="10"></td>
											<td><select name=syear>
													<?
													$p_year = date("Y", time());

													for($i=$p_year;$i <= $p_year+1; $i++)
													{
													?>
														<option value="<?=$i?>"><?=$i?>
													<?
													}
													?>
												</select> ��&nbsp; 

												<select name=smonth>
													<?
													for($i=1;$i<=12;$i++)
													{
													?>
														<option value="<?=$i?>"><?=$i?>
													<?
													}
													?>
												</select> ��&nbsp;

												<select name=sday>
													<?
													for($i=1;$i<=31;$i++)
													{
													?>
														<option value="<?=$i?>"><?=$i?>
													<?
													}
													?>
												</select> ��
											
												����

												<select name=eyear>
													<?
													$p_year = date("Y", time());

													for($i=$p_year;$i <= $p_year+1; $i++)
													{
													?>
														<option value="<?=$i?>"><?=$i?>
													<?
													}
													?>
												</select> ��&nbsp; 

												<select name=emonth>
													<?
													for($i=1;$i<=12;$i++)
													{
													?>
														<option value="<?=$i?>"><?=$i?>
													<?
													}
													?>
												</select> ��&nbsp;

												<select name=eday>
													<?
													for($i=1;$i<=31;$i++)
													{
													?>
														<option value="<?=$i?>"><?=$i?>
													<?
													}
													?>
												</select> �� ����
											</td>
										</tr>
										<tr><td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td></tr>
										<tr><td width="10" bgcolor="E5EBEA" height="22"></td>
											<td bgcolor="E5EBEA">���ǿ���</td>
											<td width="10"></td>
											<td>												
												<input type=checkbox name=chk_date1 value="1">�� 
												<input type=checkbox name=chk_date2 value="2">ȭ 
												<input type=checkbox name=chk_date3 value="3">�� 
												<input type=checkbox name=chk_date4 value="4">�� 
												<input type=checkbox name=chk_date5 value="5">��
												<input type=checkbox name=chk_date6 value="6">��
												<input type=checkbox name=chk_data0 value="0">��
											</td>
										</tr>
										<tr><td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td></tr>
										<tr><td width="10" bgcolor="E5EBEA" height="22"></td>
											<td bgcolor="E5EBEA">���ǽ��۽ð�</td>
											<td width="10"></td>
											<td><select name=study_stime>
													<?
													for($i = 9; $i <= 22; $i++)
													{
													?>
														<option value="<?=$i?>"><?=$i?>
													<?
													}
													?>
												</select> �ú���

												<select name=study_etime>
													<?
													for($i = 9; $i <= 22; $i++)
													{
													?>
														<option value="<?=$i?>"><?=$i?>
													<?
													}
													?>
												</select>
											</td>
										</tr>
										<tr><td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td></tr>
										<tr><td width="10" bgcolor="E5EBEA" height="22"></td>
											<td bgcolor="E5EBEA">�����</td>
											<td width="10"></td>
											<td><input type=text name=teach size=10></td>
										</tr>
										<tr><td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td></tr>
										<tr><td width="10" bgcolor="E5EBEA" height="22"></td>
											<td bgcolor="E5EBEA">���ǽ�</td>
											<td width="10"></td>
											<td><input type=text name=room size=10></td>
										</tr>
										<tr><td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td></tr>
										<tr><td width="10" bgcolor="E5EBEA" height="22"></td>
											<td bgcolor="E5EBEA">����</td>
											<td width="10"></td>
											<td><input type=text name=capacity size=10></td>
										</tr>
										<tr>
											<td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td>
										</tr>
										</form>
										</table>

							
							</td>
							<td width=10></td>
						<tr>
								<td width="10"></td>
								<td height="2"></td>
								<td width="10"></td>
						</tr>
						<tr>
								<td width="10" rowspan="3"></td>
								<td>
										
										
										<!----// �������α׷� > �������¼Ұ� > ���԰��� s ---->
										<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr>
												<td width="10" bgcolor="E5EBEA" height="22"></td>
												<td width="90" bgcolor="E5EBEA">����</td>
												<td width="10"></td>
												<td ><?=$trtr?></td>
										</tr>
										<tr>
												<td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td>
										</tr>
										<tr>
												<td bgcolor="E5EBEA" height="22"></td>
												<td bgcolor="E5EBEA">����</td>
												<td></td>
												<td > <?if($level==1){echo "�ʱ�";}else if($level==2){echo "�߱�";}else if($level==3){echo "���";}?></td>
										</tr>
										<tr>
												<td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td>
										</tr>
										<tr>
												<td bgcolor="E5EBEA" height="22"></td>
												<td bgcolor="E5EBEA">�Ѱ��ǽð�</td>
												<td></td>
												<td ><?=$t_time?></td>
										</tr>
										<tr>
												<td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td>
										</tr>
										<tr>
												<td bgcolor="E5EBEA" height="22"></td>
												<td bgcolor="E5EBEA">������</td>
												<td></td>
												<td ><?=number_format($price)?> ��</td>
										</tr>
										<tr>
												<td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td>
										</tr>
										<tr>
												<td height="22" bgcolor="E5EBEA"></td>
												<td height="40" valign="top" bgcolor="E5EBEA" style="padding-top:3px;">����</td>
												<td></td>
												<td style="padding:3 0 3 0"><?=nl2br(stripslashes($content))?></td>
										</tr>
										<tr>
												<td colspan="4" height="2" bgcolor="#666666"></td>
										</tr>
										</table>
										<!----// �������α׷� > �������¼Ұ� > ���԰��� e ---->


								</td>
								<td width="10" rowspan="3"></td>
						</tr>
						<tr>
								<td height="10"></td>
						</tr>
						<tr>
								<td>
								
								
										<table width="100%"  border="0" cellspacing="0" cellpadding="0">
												<tr>
														<td width="32" align="center" bgcolor="DCE2E1" height="22">ȸ��</td>
														<td background="../images/common/space2.gif" width="1"></td>
														<td width="388" align="center" bgcolor="DCE2E1">���ǳ���</td>
														<td background="../images/common/space2.gif" width="1"></td>
														<td width="167" align="center" bgcolor="DCE2E1"><span class="style6">���� �� �ڷ�</span></td>
												</tr>
										</table>


										<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="C3CBCA">
												<?
												$loop_num=1;
												WHILE($RES2 = mysql_fetch_array($QUE2))
												{
														$luid				= $RES2[luid];
														$l_subject	= $RES2[l_subject];
														$other			= $RES2[other];
														?>
														<tr bgcolor="#FFFFFF">
																<td width="32" align="center" height="22"><?=$loop_num?></td>
																<td width="388" style="padding-left:5px;"><?=$l_subject?></td>
																<td width="165" style="padding-left:5px;"><?=$other?></td>
														</tr>
														<?
														$loop_num++;
												}
												?>
												<tr bgcolor="#FFFFFF">
														<td colspan="3"></td>
												</tr>
										</table>


										<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr><td height="5"></td></tr>
										<tr><td align="center"><input type=button value=" ��� " onClick="go_reg()"></td></tr>
										<tr><td colspan="2" height="10"></td></tr>
										</table>


										<!--
										<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr>
												<td height="5" colspan="2"></td>
										</tr>
										<tr>
												<td><img src="../images/edu/edu_app.gif" width="52" height="20"></td>
												<td width="100" align="right"><img src="../images/edu/edu_lecture_view_list.gif" width="44" height="20"> <img src="../images/edu/edu_lecture_view_scrap.gif" width="44" height="20"></td>
										</tr>
										<tr>
												<td colspan="2" height="10"></td>
										</tr>
										</table>
										


										<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr>
												<td height="1" bgcolor="#198F85"></td>
										</tr>
										<tr>
												<td height="45" style="padding-left:15px;"><p>������: ���� �� ������ ��µ˴ϴ�.<br>
														������: ���� �� ������ ��µ˴ϴ�.</p></td>
										</tr>
										<tr>
												<td height="1" bgcolor="#198F85"></td>
										</tr>
										</table>
										-->
										

								</td>
							</tr>
							</table>


				</td>
		</tr>
</table>

</BODY>
</HTML>
