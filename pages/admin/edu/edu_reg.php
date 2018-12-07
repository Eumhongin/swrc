<?
session_start();
include "../lib/admin_session_chk.php";
include "../inc/mysql.php";

#kind 구분 = 1:정규과정, 2:기획강좌
if(!$kind) { $kind = 1; }
if			($kind == 1) { $kind_name = "정규"; }
else if	($kind == 2) { $kind_name = "기획"; }

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
<title>무제 문서</title>
</head>
<TITLE>대구영상미디어센터</TITLE>
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
										<td width="163"><?=$kind_name?> 강좌 </td>
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
											<td><b>프리미어 돌리기</b></td>
											<td width="2"><img src="../images/edu/edu_lecture_view_line.gif" width="2" height="15" align="absmiddle"></td>
											<td width="60"><center>정규강좌</center></td>
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
												alert("강의요일은 최소한 하루는 석택하셔야 합니다.");
												form.chk_date1.focus();
												return;
											}

											if(!form.teach.value)
											{
												alert("강사명을 입력하여 주십시오.");
												form.teach.focus();
												return;
											}

											if(!form.room.value)
											{
												alert("강의실을 입력하여 주십시오.");
												form.room.focus();
												return;
											}

											if(!form.capacity.value)
											{
												alert("총 정원을 입력하여 주십시오.");
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
											<td width="90" bgcolor="E5EBEA">강의기간</td>
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
												</select> 년&nbsp; 

												<select name=smonth>
													<?
													for($i=1;$i<=12;$i++)
													{
													?>
														<option value="<?=$i?>"><?=$i?>
													<?
													}
													?>
												</select> 월&nbsp;

												<select name=sday>
													<?
													for($i=1;$i<=31;$i++)
													{
													?>
														<option value="<?=$i?>"><?=$i?>
													<?
													}
													?>
												</select> 일
											
												에서

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
												</select> 년&nbsp; 

												<select name=emonth>
													<?
													for($i=1;$i<=12;$i++)
													{
													?>
														<option value="<?=$i?>"><?=$i?>
													<?
													}
													?>
												</select> 월&nbsp;

												<select name=eday>
													<?
													for($i=1;$i<=31;$i++)
													{
													?>
														<option value="<?=$i?>"><?=$i?>
													<?
													}
													?>
												</select> 일 까지
											</td>
										</tr>
										<tr><td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td></tr>
										<tr><td width="10" bgcolor="E5EBEA" height="22"></td>
											<td bgcolor="E5EBEA">강의요일</td>
											<td width="10"></td>
											<td>												
												<input type=checkbox name=chk_date1 value="1">월 
												<input type=checkbox name=chk_date2 value="2">화 
												<input type=checkbox name=chk_date3 value="3">수 
												<input type=checkbox name=chk_date4 value="4">목 
												<input type=checkbox name=chk_date5 value="5">금
												<input type=checkbox name=chk_date6 value="6">토
												<input type=checkbox name=chk_data0 value="0">일
											</td>
										</tr>
										<tr><td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td></tr>
										<tr><td width="10" bgcolor="E5EBEA" height="22"></td>
											<td bgcolor="E5EBEA">강의시작시간</td>
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
												</select> 시부터

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
											<td bgcolor="E5EBEA">강사명</td>
											<td width="10"></td>
											<td><input type=text name=teach size=10></td>
										</tr>
										<tr><td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td></tr>
										<tr><td width="10" bgcolor="E5EBEA" height="22"></td>
											<td bgcolor="E5EBEA">강의실</td>
											<td width="10"></td>
											<td><input type=text name=room size=10></td>
										</tr>
										<tr><td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td></tr>
										<tr><td width="10" bgcolor="E5EBEA" height="22"></td>
											<td bgcolor="E5EBEA">정원</td>
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
										
										
										<!----// 교육프로그램 > 교육강좌소개 > 정규강좌 s ---->
										<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr>
												<td width="10" bgcolor="E5EBEA" height="22"></td>
												<td width="90" bgcolor="E5EBEA">영역</td>
												<td width="10"></td>
												<td ><?=$trtr?></td>
										</tr>
										<tr>
												<td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td>
										</tr>
										<tr>
												<td bgcolor="E5EBEA" height="22"></td>
												<td bgcolor="E5EBEA">수준</td>
												<td></td>
												<td > <?if($level==1){echo "초급";}else if($level==2){echo "중급";}else if($level==3){echo "고급";}?></td>
										</tr>
										<tr>
												<td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td>
										</tr>
										<tr>
												<td bgcolor="E5EBEA" height="22"></td>
												<td bgcolor="E5EBEA">총강의시간</td>
												<td></td>
												<td ><?=$t_time?></td>
										</tr>
										<tr>
												<td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td>
										</tr>
										<tr>
												<td bgcolor="E5EBEA" height="22"></td>
												<td bgcolor="E5EBEA">수강료</td>
												<td></td>
												<td ><?=number_format($price)?> 원</td>
										</tr>
										<tr>
												<td colspan="4" style="background-image:url('../images/common/dot_line2.gif'); background-repeat:repeat-x;" height="2"></td>
										</tr>
										<tr>
												<td height="22" bgcolor="E5EBEA"></td>
												<td height="40" valign="top" bgcolor="E5EBEA" style="padding-top:3px;">개요</td>
												<td></td>
												<td style="padding:3 0 3 0"><?=nl2br(stripslashes($content))?></td>
										</tr>
										<tr>
												<td colspan="4" height="2" bgcolor="#666666"></td>
										</tr>
										</table>
										<!----// 교육프로그램 > 교육강좌소개 > 정규강좌 e ---->


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
														<td width="32" align="center" bgcolor="DCE2E1" height="22">회차</td>
														<td background="../images/common/space2.gif" width="1"></td>
														<td width="388" align="center" bgcolor="DCE2E1">강의내용</td>
														<td background="../images/common/space2.gif" width="1"></td>
														<td width="167" align="center" bgcolor="DCE2E1"><span class="style6">교재 및 자료</span></td>
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
										<tr><td align="center"><input type=button value=" 등록 " onClick="go_reg()"></td></tr>
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
												<td height="45" style="padding-left:15px;"><p>이전글: 이전 글 제목이 출력됩니다.<br>
														다음글: 다음 글 제목이 출력됩니다.</p></td>
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
