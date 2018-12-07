<?
session_start();
include "../lib/admin_session_chk.php";

if($kind == 1)			{ $kind_name = "정규"; }
else if($kind == 2)	{ $kind_name = "기획"; }
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


<Script language="javascript">
<!--
function chk_form()
{
	var yesno
	yesno=confirm("<?=$subject?> 강좌의 내용을 입력하셨습니다.\n\n등록하시겠습니까?");
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
										<td width="163"><?=$kind_name?> 강좌 등록 <!--&gt; 내용 등록--></td>
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
						
						<!----// edu lecture 등록 폼 s---->


										<table width="100%" cellpadding=0 cellspacing=1 border=0 bgcolor=333333>
										<tr align=center bgcolor="#EAEAEA">
												<td>구분</td>
												<td>영역</td>
												<td>수준</td>
												<td>강좌명</td>
												<td>총 강의시간</td>
												<td>수강료</td>
										</tr>
										<tr align=center bgcolor="#FFFFFF">
												<td><?if($kind==1){echo "정규";}else if($kind==2){echo "기획";}?></td>
												<td><?=$trtr?></td>
												<td><?if($level==1){echo "초급";}else if($level==2){echo "중급";}else if($level==3){echo "고급";}?></td>
												<td><?=$subject?></td>
												<td><?=$t_time?></td>
												<td><?=number_format($price)?> 원</td>
										</tr>
										</table>

										<br>
								
										<table width=100% cellpadding=0 cellspacing=1 border=0 bgcolor=333333>
										<tr align=center>
												<td width=60 bgcolor=EAEAEA>강의개요</td>
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
												<td width=10%>회차</td>
												<td width=60%>강의내용</td>
												<td width=30%>교재 및 자료</td>
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
										<tr><td align=right><input type=button value="등록 완료" onClick="chk_form()"></td>
										</table>
										</form>
				

						<!----// edu lecture 등록 폼 e---->
				</td>
		</tr>
</table>







</BODY>
</HTML>


