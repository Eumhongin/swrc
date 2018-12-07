<?

$pageUrl .= $pageName;

include("../../config/mysql.inc.php");     //** 접속통계

$mysql = new Mysql_DB;
$mysql->Connect();

if($code == 'del')
{

	
	$del_que = "DELETE FROM edu WHERE uid = ".$uid;

	$del_rs  = mysql_query($del_que);
}

$pagesize = 20;

$pageIdx = (!$pageIdx) ? 1 : $pageIdx;
$startnum = ($pageIdx - 1) * $pagesize;

$addquery = ($keyword) ? " and $searchby LIKE '%$keyword%'" : "";
$addparameter = ($keyword) ? "&searchby=$searchby&keyword=$keyword" : "";

$query = "SELECT COUNT(uid) AS uid FROM edu WHERE 1=1 ".$addquery;
$query .= " ORDER BY uid DESC";

$rs = mysql_query($query);
$row = mysql_fetch_array($rs);

$total = $row[uid];
$totalpages = ceil($total/$pagesize);
$record_num = $total - $pagesize * ($pageIdx - 1);
?>


	<script type="text/javascript" src="../js/ms_patch.js"></script>

	<!----// edu lecture (교육강좌소개-정규강좌) board s ---->
	<script type="text/javascript">
	<!--
	function go_kind()
	{
		kind = document.moveform.kind.value;
		location.href="<?=$pageUrl?>&page=/pages/admin/edu/edu.php&kind="+kind;
	}
	//-->
	</script>
	<script type="text/javascript">
	<!--
		
		function go_del(uid)
		{
			var yesno
			yesno=confirm("정말 삭제하시겠습니까?");
			if (yesno == true)
			{
				location.href="<?=$pageUrl?>&page=/pages/admin/edu/edu.php&code=del&uid="+uid;
			}
		}
	-->
	</script>

	<script type="text/javascript">
	<!--
	function open_window(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable)
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

			<p class="contTitle">교육과정 관리</p>
			
			<table class="bbsCont" cellspacing="0" summary="전문가 목록 보기">
				<colgroup>
					<col width="8%"/>
					<col />
					<col width="10%"/>
					<col width="10%"/>
					<col width="10%"/>
					<col width="7%"/>
					<col width="8%"/>
					<col width="8%"/>
				</colgroup>
				<thead>
					<tr>
						<th scope="col">번호</th>
						<th scope="col">강좌명</th>
						<th scope="col">시간</th>
						<th scope="col">총정원/현재</th>
						<th scope="col">수강료</th>
						<th scope="col">상태</th>
						<th scope="col">수정</th>
						<th scope="col">삭제</th>
					</tr>
				</thead>
				<tbody>

<?	
$query = "SELECT * FROM edu WHERE 1=1 ".$addquery." ORDER BY uid DESC LIMIT $startnum, $pagesize";
$rs = mysql_query($query);
$loop_num = 0;
WHILE($RES = mysql_fetch_array($rs))
{
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



	if($total > 0)
	{
		$chk_sdate = $RES[sdate];
		$chk_edate = $RES[edate];

		$present_time = time();

		if($present_time > $chk_sdate AND $present_time < $chk_edate)
		{
			$p_state = "<font color=blue>강의중</font>";
			$reg_button = "";
			$use_button = " disabled ";
		}
		else if($present_time < $chk_sdate AND $present_time < $chk_edate)
		{
			$p_state = "<font color=brown>준비중</font>";
			$reg_button = "";
			$use_button = " disabled ";
		}
		else #if($present_time > $chk_sdate AND $present_time > $chk_edate)
		{
			$p_state = "<font color=red>종강</font>";
			$reg_button = "javascript:open_window('open_window', 'edu_reg.php?uid=$uid&kind=$kind&pageIdx=$pageIdx', 100, 100, 700, 600, 0, 0, 0, 1, 0)";
			$use_button = "";
		}
	}
	else
	{
		$p_state = "";
		$reg_button = "javascript:open_window('open_window', 'edu_reg.php?uid=$uid&kind=$kind&pageIdx=$pageIdx', 100, 100, 700, 600, 0, 0, 0, 1, 0)";
		$use_button = "";
	}



	$cnt_que = "select count(ouid) AS ouid FROM edu_order WHERE uid = '".$uid."' AND id != ''";
	$cnt_rs	 = mysql_query($cnt_que);
	$cnt_row = mysql_fetch_array($cnt_rs);

	?>
			<tr>
				<td><?=$record_num?></td>
				<td class="tal">
					<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu_view.php&uid=<?=$uid?>"><?=$subject?></a>
				</td>
				<td><?=date("Y.m.d", $sdate)?> ~ <?=date("Y.m.d", $edate)?></td>
				<td><?=$t_person?> / <?=number_format($cnt_row[ouid])?></td>
				<td><?=number_format($price)?></td>
				<td><?=$p_state?></td>
				<td>
					<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu_edit.php&uid=<?=$uid?>&kind=<?=$kind?>&pageIdx=<?=$pageIdx?>"><img src="/pages/admin/images/bbs/btn_modify.gif">
					</a>
				</td>
				<td>
					<input type="image" src="/pages/admin/images/bbs/btn_delete.gif" value="삭제" onClick="go_del(<?=$uid?>)">
				</td>
			</tr>
	<?
	$record_num--;
	$loop_num++;
}
?>

<?

$prevpageone = ($pageIdx != 1) ? $pageIdx - 1 : 1;
$nextpageone = ($pageIdx != $totalpages) ? $pageIdx + 1 : $totalpages;

// paging
$startpage = ((ceil(($pageIdx/10) - 0.01) - 1) * 10) + 1;
$endpage = $startpage + 9;
$endpage = ($totalpages < $endpage) ? $totalpages : $endpage;

$prevpage = ($startpage != 1) ? $startpage - 10 : 1 ;
$nextpage = (($endpage + 1) > $totalpages) ? $totalpages : $endpage + 1;


?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="8">
						<!-- 기본 paging -->
							<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu.php&pageIdx=<?=$prevpageone.$addparameter;?>&kind=<?=$kind?>">[이전]</a>&nbsp;
							<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu.php&amp;pageIdx=<?=$prevpage.$addparameter?>&kind=<?=$kind?>"> < </a>								
							<?
							for ($i = $startpage; $i <= $endpage; $i++)
							{
							?>
							<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu.php&pageIdx=<?=$i.$addparameter?>&kind=<?=$kind?>"><font class=pagev><?=($i==$pageIdx)?"<b>$i</b>":$i?></font></a> 
							<?
							}
							?>
							<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu.php&pageIdx=<?=$nextpage.$addparameter?>&kind=<?=$kind?>"> > </a>
							<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu.php&pageIdx=<?=$nextpageone.$addparameter;?>&kind=<?=$kind?>">[다음]</a>
					</td>
				</tr>
				<tr>
					<td colspan="8">
						<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu_add.php&amp;kind=<?=$kind?>">
							<img src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록"/>
						</a>
					</td>
				</tr>
				<tr>
					<td colspan="8">
						<form name="searchForm" method="post" action="<?=$pageUrl?>&page=/pages/admin/edu/edu.php" >
						<input type="hidden" name="kind" value="<?=$kind?>">			
						<select name="searchby" id="searchby" title="검색분류">
							<option value="subject" <?=($searchby == "subject" or !$searchby) ? " selected" : ""; ?>>제목
							<option value=content <?=($searchby == "content") ? " selected" : ""; ?>>내용
						</select>
						<input type="text" name="keyword" value="<?=$keyword?>" id="keyword" class="basic" title="검색어" />
						<input type="image" src="/pages/admin/images/bbs/btn_search.gif" value="검색" alt="검색" class="vmiddle" />
						</form>					
					</td>
				</tr>
			</tfoot>
		</table>					
