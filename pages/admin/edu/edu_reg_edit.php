<?
  session_start();
  include("../admin_security.php");

	include("../../config/mysql.inc.php");     //** 접속통계

  $mysql = new Mysql_DB;
	$mysql->Connect();

#kind 구분 = 1:정규과정, 2:기획강좌
if(!$kind) { $kind = 1; }
if			($kind == 1) { $kind_name = "정규"; }
else if	($kind == 2) { $kind_name = "기획"; }

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
<title>무제 문서</title>
</head>
<TITLE>대구영상미디어센터</TITLE>
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
														alert("강좌명을 입력하여주십시오.");
														document.thisform.subject.focus();
														return;
												}

												if(!document.thisform.t_time.value)
												{
														alert("총강의 시간을 입력하여주십시오.\n\n총강의 시간은 강의내용 등록시 수정하실수 있습니다.");
														document.thisform.t_time.focus();
														return;
												}

												if(!document.thisform.price.value)
												{
														alert("수강료를 입력하여 주십시오.");
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
				alert("강의내용을 입력하여 주십시오.");
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

						<form name=thisform method=post action="edu_edit_db.php">
						<input type=hidden name=kind value="<?=$kind?>">
						<input type=hidden name=uid value="<?=$uid?>">

										<table width="100%" cellpadding=5 cellspacing=1 border=0 bgcolor=333333>
										<tr bgcolor="#EAEAEA">
												<td>강좌명</td>
												<td bgcolor="#FFFFFF"><input type=text name=subject value=<?=$subject?>></td>
												<td>총 강의시간</td>
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
												<td>시작일
												<td bgcolor="#FFFFFF"><select name="sYear">
														<?
														for($i = 2007 ; $i <= $pYear + 1 ; $i++)
														{
															$sel = ($i == $psYear) ? "selected" : "";

															echo "<option value='{$i}' {$sel}>".$i;
														}
														?>
													</select>년&nbsp;&nbsp;
													
													<select name="sMonth">
														<?
														for($i = 1 ; $i <= 12 ; $i++)
														{
															$sel = ($i == $psMonth) ? "selected" : "";

															echo "<option value='{$i}' {$sel}>".$i;
														}
														?>
													</select>월&nbsp;&nbsp;

													<select name="sDay">
														<?
														for($i = 1; $i <=31 ; $i++)
														{
															$sel = ($i == $psDay) ? "selected" : "";

															echo "<option value='{$i}' {$sel}>".$i;
														}
														?>
													</select>일



												</td>
												<td>종료일</td>
												<td bgcolor="#FFFFFF">
													<select name="eYear">
														<?
														for($i = 2007 ; $i <= $pYear + 1 ; $i++)
														{
															$sel = ($i == $peYear) ? "selected" : "";

															echo "<option value='{$i}' {$sel}>".$i;
														}
														?>
													</select>년&nbsp;&nbsp;
													
													<select name="eMonth">
														<?
														for($i = 1 ; $i <= 12 ; $i++)
														{
															$sel = ($i == $peMonth) ? "selected" : "";

															echo "<option value='{$i}' {$sel}>".$i;
														}
														?>
													</select>월&nbsp;&nbsp;

													<select name="eDay">
														<?
														for($i = 1; $i <=31 ; $i++)
														{
															$sel = ($i == $peDay) ? "selected" : "";

															echo "<option value='{$i}' {$sel}>".$i;
														}
														?>
													</select>일


												</td>

										</tr>
										<tr bgcolor="#EAEAEA">
											<td>강의시간
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
											<td>수강료</td>
											<td bgcolor="#FFFFFF"><input type=text name=price></td>
										</tr>
										<tr bgcolor="#EAEAEA">
											<td>강의실</td>
											<td bgcolor="#FFFFFF"><input type=text name=room></td>
											<td>강사명</td>
											<td bgcolor="#FFFFFF"><input type=text name=teach></td>
										</tr>
										<tr bgcolor="#EAEAEA">
											<td>수강인원</td>
											<td bgcolor="#FFFFFF"><input type=text name=t_person></td>
											<td>담당자</td>
											<td bgcolor="#FFFFFF"><input type=text name=damdang></td>
										</tr>
										<tr bgcolor="#EAEAEA">
											<td>과정개요</td>
											<td bgcolor="#FFFFFF" colspan=3><textarea name=content1 style="width:100% ; height:100"></textarea></td>
										</tr>
										<tr bgcolor="#EAEAEA">
											<td>과정내용</td>
											<td bgcolor="#FFFFFF" colspan=3><textarea name=content2 style="width: 100% ; height : 100"></textarea></td>
										</tr>
										<tr bgcolor="#EAEAEA">
											<td>세부교육내용</td>
											<td bgcolor="#FFFFFF" colspan=3><input type=file name="file"></td>
										</tr>
										</table>

										




										<br>
								

										<table width=100% cellpadding=5 cellspacing=0 border=0>
										<tr><td align=right><input type=button value="강의 내용 등록" onClick="chk_form()"></td>
										</table>
										</form>


							</form>

				</td>
		</tr>
</table>

</BODY>
</HTML>
