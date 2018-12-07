
<?
session_start();
include "../lib/admin_session_chk.php";
include "../inc/mysql.php";
include "../inc/admin_top.php";


$que = mysql_query("SELECT * FROM edu_screen WHERE uid = ".$uid);
$res = mysql_fetch_array($que);

$subject	= stripslashes($res[subject]);
$dbyear		= date("Y", $res[stime]);
$dbmonth	= date("m", $res[stime]);
$dbday		= date("d", $res[stime]);
$content	= stripslashes($res[content]);

?>


<script language="JavaScript" type="text/JavaScript">
<!--
function chk_form()
{
		if(!document.thisform.subject.value)
		{
				alert("제목을 입력하여주십시오.");
				document.thisform.subject.focus();
				return;
		}


		document.thisform.submit();
}
//-->
</script>


<form name=thisform method=post action="edu_screen_edit_db.php" enctype="multipart/form-data">
<input type=hidden name=uid value="<?=$uid?>">
<table width="100%" border=0 cellspacing=0 cellpadding=5>
<tr><td>


				<table width="100%" border=0 cellspacing=1 cellpadding=0 bgcolor=999999>
				<tr height=25 align=center bgcolor=EAEAEA>
					<td width="30%">상영날짜</td>
					<td width="70%" align=left style="padding-left:5" bgcolor=FFFFFF>
						<?
						$pyear	= date("Y", time());
						$pmonth = date("m", time());
						$pday		= date("d", time());

						$vyear = date("Y", time()) +1;
						?>
						<select name=cyear>
							<?
							if($check_year == ''){ $check_year = 2007;}

							for($i = 2006; $i <= $vyear ; $i++)
							{
								if($dbyear == $i) { $sel_year = "selected"; } else { $sel_year = ''; }
								echo "<option value=".$i." ".$sel_year.">".$i;
							}
							?>
						</select> 년 

						<select name=cmonth>
							<?
							for($i = 1; $i <= 12; $i++)
							{
								if($dbmonth == $i) { $sel_month = "selected"; } else { $sel_month = ''; }
								echo "<option value=".$i." ".$sel_month.">".$i;
							}
							?>
						</select> 월 

						<select name=cday>
							<?
							for($i = 1; $i <= 31; $i++)
							{
								if($dbday == $i) { $sel_day = "selected"; } else { $sel_day = ''; }
								echo "<option value=".$i." ".$sel_day.">".$i;
							}
							?>
						</select> 일 &nbsp; P.M. 1:00
					</td>
				</tr>
				<tr align=center bgcolor=EAEAEA>
					<td >영화제목</td>
					<td align=left style="padding:0 5 0 5" bgcolor=FFFFFF><input type=text name=subject value="<?=$subject?>"></td>
				</tr>
				<tr align=center bgcolor=EAEAEA>
					<td>내용</td>
					<td align=left style="padding:0 5 0 5" bgcolor=FFFFFF><textarea name="content" id="content"style="HEIGHT: 60 px; width: 100%;" class="sinput"><?=$content?></textarea>
				<tr height=25>
					<td align=center bgcolor=EAEAEA>포스터 이미지</td>
					<td style="padding-left:5" bgcolor=FFFFFF><input type=file name=add_file></td>
				</tr>
				</table>


				<table width="100%" border=0 cellspacing=0 cellpadding=0>
				<tr><td align=center height=30><input type=button value="등록" onClick="chk_form()"></td></tr>
				</table>

				</form>

		</td>
</tr>
</table>