<?
session_start();
include "../lib/admin_session_chk.php";
include "../inc/mysql.php";

$pagesize = 20;

$page = (!$page) ? 1 : $page;
$startnum = ($page - 1) * $pagesize;

$addquery = ($keyword) ? " and $searchby LIKE '%$keyword%'" : "";
$addparameter = ($keyword) ? "&searchby=$searchby&keyword=$keyword" : "";

$query = "SELECT COUNT(uid) FROM edu_screen WHERE 1=1 ".$addquery;
$query .= " ORDER BY uid DESC";
$rs = mysql_query($query,$connect);
$total = mysql_result($rs,0,0);
$totalpages = ceil($total/$pagesize);
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

<script language=javascript>
function searchGo()
{
	if (!document.searchForm.keyword.value)
	{
		return false;
	}
}
</script>


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

function go_edit(uid)
{
	var left = (screen.width/2) - (660/2);
	var top = (screen.height/2) - (588/2); 
	window.open ("../admin/edu_screen_edit.php?uid=" + uid,"editform","width=400,height=250,top="+top+",left="+left+",status=no,toolbar=no,menubar=no,location=no,fullscreen=no,scrollbars=no,resizable=no");
}


function go_del(subject, uid)
{
	var yesno
	yesno=confirm("'"+subject+"'를(을) 삭제하시겠습니까?");
	if (yesno == true)
	{
		location.href="edu_screen_del_db.php?uid="+uid;
	}
}
//-->
</Script>




<script language="JavaScript">
<!--
function resizeSelf() 
{
	if (document.body.scrollHeight > 250 )
	{
		self.resizeTo(document.body.scrollWidth , document.body.scrollHeight + 10);
	} else {
		self.resizeTo(document.body.scrollWidth , 250 + 10);
	}
}

function na_open_window(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable)
{
	toolbar_str = toolbar ? 'yes' : 'no';
	menubar_str = menubar ? 'yes' : 'no';
	statusbar_str = statusbar ? 'yes' : 'no';
	scrollbar_str = scrollbar ? 'yes' : 'no';
	resizable_str = resizable ? 'yes' : 'no';
	window.open(url, name, 'left='+left+',top='+top+',width='+width+',height='+height+',toolbar='+toolbar_str+',menubar='+menubar_str+',status='+statusbar_str+',scrollbars='+scrollbar_str+',resizable='+resizable_str);
}
//-->
</script>
<DIV ID='overDiv' STYLE='position: absolute; z-index: 50; width: 160; visibility: hidden'></DIV>
<script language="javascript">
var x = 0;
var y = 0;
var snow = 0;
var sw = 0;
var cnt = 0;
var dir = 1;
var offsetx = 3;
var offsety = 3;
var width = 260;
var height = 50;

over = overDiv.style;
document.onmousemove = mouseMove;

function view(text, title) { dts(1,text); }

function noview() {
	if ( cnt >= 1 ) { sw = 0 };
	if ( sw == 0 ) { snow = 0; hideObject(over); }
	else { cnt++; }
}

function dts(d,text) 
{
	txt = "<TABLE WIDTH=160 STYLE=\"border:1 #D9CEA5 solid\" CELLPADDING=5 CELLSPACING=0 BORDER=0><TR><TD BGCOLOR=#ffffff CLASS=cal>"+text+"</TD></TR></TABLE>"
	layerWrite(txt);
	dir = d;
	disp();
}

function disp() 
{
	if (snow == 0) {
	if (dir == 2) { moveTo(over,x+offsetx-(width/2),y+offsety); } // Center
	if (dir == 1) { moveTo(over,x+offsetx,y+offsety); } // Right
	if (dir == 0) { moveTo(over,x-offsetx-width,y+offsety); } // Left
	showObject(over);
	snow = 1;
}
}

function mouseMove(e) 
{
	x=event.x + document.body.scrollLeft+10
	y=event.y + document.body.scrollTop
	if (x+width-document.body.scrollLeft > document.body.clientWidth) x=x-width-25;
	if (y+height-document.body.scrollTop > document.body.clientHeight) y=y-document.body.scrollTop;

	if (snow) 
	{
		if (dir == 2) { moveTo(over,x+offsetx-(width/2),y+offsety); } // Center
		if (dir == 1) { moveTo(over,x+offsetx,y+offsety); } // Right
		if (dir == 0) { moveTo(over,x-offsetx-width,y+offsety); } // Left
	}
}

function cClick() { hideObject(over); sw=0; }
function layerWrite(txt) { document.all["overDiv"].innerHTML = txt }
function showObject(obj) { obj.visibility = "visible" }
function hideObject(obj) { obj.visibility = "hidden" }
function moveTo(obj,xL,yL) { obj.left = xL; obj.top = yL; }
</script>



<table width=660 cellpadding=0 cellspacing=0>
<tr><td height="53" background="../images/common/top_title_bg.gif">

			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr><td width="10"></td>
				<td width="163"><b>상영안내</b></td>
				<td align="right"></td>
				<td width="10"></td>
			</tr>
			</table>

	</td>
</tr>
<tr><td height="15"></td></tr>
<tr><td valign="top">



			<!----// 상영프로 board s ---->
			<table width="100%"  border="0" cellpadding="0" cellspacing="0">
			<tr><td width="10"></td>
				<td align=left>

						<!----// 상영 프로 등록 s ---->
						<form name=thisform method=post action="edu_screen_db.php" enctype="multipart/form-data">
						<table width="70%" border=0 cellspacing=1 cellpadding=0 bgcolor=999999>
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
	if($pyear == $i) { $sel_year = "selected"; } else { $sel_year = ''; }
?>
									<option value=<?=$i?> <?=$sel_year?>><?=$i?>
<?
}
?>
								</select> 년 

								<select name=cmonth>
<?
for($i = 1; $i <= 12; $i++)
{
	if($pmonth == $i) { $sel_month = "selected"; } else { $sel_month = ''; }
?>
									<option value=<?=$i?> <?=$sel_month?>><?=$i?>
<?
}
?>
								</select> 월 

								<select name=cday>
<?
for($i = 1; $i <= 31; $i++)
{
	if($pday == $i) { $sel_day = "selected"; } else { $sel_day = ''; }
?>
									<option value=<?=$i?> <?=$sel_day?>><?=$i?>
<?
}
?>
								</select> 일 &nbsp; P.M. 1:00
							</td>
						</tr>
						<tr align=center bgcolor=EAEAEA>
							<td >영화제목</td>
							<td align=left style="padding:0 5 0 5" bgcolor=FFFFFF><input type=text name=subject></td>
						</tr>
						<tr align=center bgcolor=EAEAEA>
							<td>내용</td>
							<td align=left style="padding:0 5 0 5" bgcolor=FFFFFF><textarea name="content" id="content"style="HEIGHT: 60 px; width: 100%;" class="sinput">감독 :
출연 : 
기타 :</textarea>
						<tr height=25>
							<td align=center bgcolor=EAEAEA>포스터 이미지</td>
							<td style="padding-left:5" bgcolor=FFFFFF><input type=file name=add_file></td>
						</tr>
						</table>


						<table width="70%" border=0 cellspacing=0 cellpadding=0>
						<tr><td align=center height=30><input type=button value="등록" onClick="chk_form()"></td></tr>
						</table>
						</form>

				</td>
				<td width="10"></td>
			</tr>
			<tr>
				<td></td>
				<td valign="top">

						<!----// 상영 프로 s ---->
						<table width="100%"  border="0" cellspacing="1" cellpadding="0">
						<tr height=25 align=center bgcolor=EAEAEA>
							<td width=13%></td>
							<td width=20%>상영날짜</td>
							<td width=50%>영화제목</td>
							<td width=17%>수정/삭제</td>
						</tr>
<?	
$query = "SELECT * FROM edu_screen WHERE 1=1 ".$addquery." ORDER BY stime DESC LIMIT $startnum, $pagesize";
$rs  = mysql_query($query, $connect);
$loop_num = 0;
WHILE($RES = mysql_fetch_array($rs))
{
	$uid		= $RES[uid];
	$subject	= stripslashes($RES[subject]);
	$stime		= date("Y.m.d", $RES[stime]);
	$content	= $RES[content];
	$up_file	= $RES[up_file];

	$view_data = "<table width=100% cellpadding=0 cellspacing=0 border=0><tr><td>test</td></tr><tr><td>test2</td></tr></table>";
?>
						<tr align=center onmouseover="this.style.backgroundColor='#f6f6f6'" onmouseout="this.style.backgroundColor='#FFFFFF'">
							<td height="30"><img src="../up_file/edu_screen/<?=$up_file?>" width=59 height=81 border=0></td>
							<td><?=$stime?></td>
							<td><a href="#" align='absmiddle' onMouseOver="view(''); return true;" onMouseOut="noview(); return true;"><?=$subject?></a></td>
							<td><input type=button value="수정" onClick="go_edit('<?=$uid?>')"> <input type=button value="삭제" onClick="go_del('<?=$subject?>','<?=$uid?>')"></td>
						<tr><td colspan="4" height="1" style="background-image:url('../images/common/dot_line.gif'); background-repeat:repeat-x;"></td></tr>
<?
	$record_num--;
	$loop_num++;
}

if($loop_num < 10)
{
	for($i = 1; $i <= 10 - $loop_num ; $i++)
	{
	?>
						<tr>
							<td height="30"></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr><td colspan="4" height="1" style="background-image:url('../images/common/dot_line.gif'); background-repeat:repeat-x;"></td></tr>
	<?
	}
}


$prevpageone = ($page != 1) ? $page - 1 : 1;
$nextpageone = ($page != $totalpages) ? $page + 1 : $totalpages;

// paging
$startpage = ((ceil(($page/10) - 0.01) - 1) * 10) + 1;
$endpage = $startpage + 9;
$endpage = ($totalpages < $endpage) ? $totalpages : $endpage;

$prevpage = ($startpage != 1) ? $startpage - 10 : 1 ;
$nextpage = (($endpage + 1) > $totalpages) ? $totalpages : $endpage + 1;

?>
						<tr><td height="10" colspan="6"></td></tr>
						</table>


				<!----// 상영 프로 e ---->
				</td>
				<td></td>
			<tr><td colspan=3 height=40>

						<table width=100% cellpadding=0 cellspacing=0 border=0>
						<tr align=center>
							<td width=30%> 
								<a href='./edu_screen.php?page=<?=$prevpageone.$addparameter;?>&kind=<?=$kind?>'>[이전]</a>&nbsp;
								<a href='./edu_screen.php?page=<?=$nextpageone.$addparameter;?>&kind=<?=$kind?>'>[다음]</a>
							</td>
							<td width=40%>
								<a href='./edu_screen.php?page=<?=$prevpage.$addparameter?>&kind=<?=$kind?>'><</a>
<?
for ($i = $startpage; $i <= $endpage; $i++)
{
?>
								<a href='./edu_screen.php?page=<?=$i.$addparameter?>&kind=<?=$kind?>'><font class=pagev><?=($i==$page)?"<b>$i</b>":$i?></font></a> 
<?
}
?>
								<a href='./edu_screen.php?page=<?=$nextpage.$addparameter?>&kind=<?=$kind?>'>></a>
							</td>
							<td width=30%></td>
						</tr>
						</table>
			
				
				</td>
			</tr>
			<tr><td colspan=3>

						<table width=100% cellpadding=0 cellspacing=0 border=0>
						<form name=searchForm method=get action='./edu_screen.php' onsubmit='return searchGo()'>
						<input type=hidden name=c1_uid value="<?=$c1_uid?>">
						<input type=hidden name=chk_c2_uid value="<?=$chk_c2_uid?>">
						<tr><td height=30 colspan=6 align=center>
								<font class=searchtag>
								<select name=searchby class=searchtag>
									<option value=subject <?=($searchby == "subject" or !$searchby) ? " selected" : ""; ?>>제목
									<option value=content <?=($searchby == "content") ? " selected" : ""; ?>>내용
								</select>
								</font>
							<input type=text name=keyword class=searchtag style='border: 1 solid #444444' align=absmiddle value='<?=$keyword;?>'><input type=submit value="찾기" border=0 align=absmiddle style='margin-top:2'></td>
						</tr>
						</form>


				</td>
			</tr>
			</table>
			<!----// edu_screen (교육강좌소개-정규강좌) board e ---->


	</td>
</tr>
</table>



<br><br><br>


</BODY>
</HTML>