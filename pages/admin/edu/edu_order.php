<?

include("../../config/mysql.inc.php");

$pageUrl .= $pageName;

$mysql = new Mysql_DB;
$mysql->Connect();

if(!$sYear)		{ $sYear = date("Y", time());	}
#if(!$sMonth)	{ $sMonth = date("n", time());	}

$pagesize		= 15;

$pageIdx			= (!$pageIdx) ? 1 : $pageIdx;
$startnum		= ($pageIdx - 1) * $pagesize;

if($sYear)
{
	if($sMonth)
	{
		$end_day = date('t', mktime(23,59,59, $sMonth, 1, $sYear));
		$addquery = " AND (b.sdate > ".mktime(0,0,1, $sMonth, 1, $sYear)." AND b.sdate < ".mktime(23,59,59, $sMonth, $end_day, $sYear).")";
	}
	else
	{
		$addquery = " AND (b.sdate > ".mktime(0,0,1, 1,1, $sYear)." AND b.sdate < ".mktime(23,59,59, 12,31, $sYear).") ";
	}

	$select_edu_option = $addquery;
}

$addparameter   = "&sYear=$sYear&sMonth=$sMonth";

$addquery		= ($keyword AND $searchby) ? " and $searchby LIKE '%$keyword%'".$addquery : $addquery;
$addparameter	= ($keyword AND $searchby) ? "&searchby=$searchby&keyword=$keyword".$addparameter : $addparameter;

#자주있는 질문 : code2필요...
$addquery		= ($code)	? " AND code = '$code'".$addquery	: $addquery;
$addquery		= ($code2)	? " AND code2 = '$code2'".$addquery : $addquery;
$addquery		= ($uid)	? " AND b.uid = '$uid'".$addquery	: $addquery;
$addparameter	= ($code)	? "&code=$code".$addparameter		: $addparameter;
$addparameter	= ($code2)	? "&code2=$code2".$addparameter		: $addparameter;
$addparameter	= ($sort)	? "&sort=$sort".$addparameter		: $addparameter;
$addparameter	= ($uid)	? "&uid=$uid".$addparameter			: $addparameter;


if		($sort == "b.subject")	{	$orderby = "b.subject";	}
else if	($sort == "b.sdate")	{	$orderby = "b.sdate";	}
else if	($sort == "b.state")	{	$orderby = "b.sdate";	}
else							{	$orderby = "a.ouid";	}


$query = "SELECT COUNT(a.ouid) AS ouid FROM edu_order AS a, edu AS b, members AS c WHERE  a.uid = b.uid AND a.id = c.user_id ".$addquery;
$query .= " ORDER BY $orderby DESC";
$rs = mysql_query($query);
$row = mysql_fetch_array($rs);
$total = $row[ouid];
$totalpages = ceil($total/$pagesize);
$record_num = $total - $pagesize * ($pageIdx - 1);


?>
<script type="text/javascript" src="../js/ms_patch.js"></script>
<script type="text/javascript">
function searchGo()
{
	if (!document.searchForm.keyword.value)
	{
		return false;
	}
}
</script>

		<script type="text/javascript">
			<!--
			function go_state(ouid)
			{
				document.thisform.ouid.value = ouid;
				document.thisform.submit();
			}

			function go_del(ouid)
			{
				var yesno
				yesno=confirm("정말 삭제하시겠습니까?");
				if (yesno == true)
				{
					location.href="<?=$pageUrl?>&page=/pages/admin/edu/edu_order_del_db.php&ouid="+ouid;
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


				



		<table width="100%" height="26" cellpadding="0" cellspacing="0">
		<form name="frm" method=post action="<?=$pageUrl?>&page=/pages/admin/edu/edu_order.php">
		<input type=hidden name=searchby value="<?=$searchby?>">
		<input type=hidden name="sort"	 value="<?=$sort?>">
		<input type=hidden name="pageIdx"   value="<?=$pageIdx?>">
		<tr><td align=left height=30>
						<select name=sYear onChange="document.frm.submit();">
							<?
							for($i = 2007 ; $i <= date("Y",time()) ; $i++)
							{
								echo "<option value=$i ".(($i == $sYear) ? "selected" : "").">".$i;
							}
							?>
						</select>
						년 
						
						<select name=sMonth onChange="document.frm.submit();">
							<option value="">
							<?
							for($i = 1 ; $i <= 12 ; $i++)
							{
								echo "<option value=$i ".(($i == $sMonth) ? "selected" : "").">".$i;
							}
							?>
						</select>
						월


						<select name="uid" onChange="document.frm.submit();">
							<option value=''>
							<?
							if($sMonth)
							{
								$edu_sql = "SELECT uid,kind,subject FROM edu WHERE 1=1 AND (sdate > ".mktime(0,0,0, $sMonth,1, $sYear)." AND sdate < ".mktime(23,59,59, $sMonth,$end_day, $sYear).") ORDER BY sdate ASC";
							}
							else
							{
								$edu_sql = "SELECT uid,kind,subject FROM edu WHERE 1=1 AND (sdate > ".mktime(0,0,0, 1,1, $sYear)." AND sdate < ".mktime(23,59,59, 12,31, $sYear).") ORDER BY sdate ASC";
							}
							
							$edu_que = mysql_query($edu_sql);
							while($edu_res = mysql_fetch_array($edu_que))
							{
								echo "<option value={$edu_res[uid]} ".(($uid == $edu_res[uid])?"selected":"").">{$edu_res[subject]}";
							}
							?>
						</select>

					</td>
					<td align=right>
						정렬:
						<select name=sort onChange="document.frm.submit();">
							<option value="">
							<option value="b.subject" <?=($sort == "b.subject")?"selected":"";?>>강좌
							<option value="b.sdate" <?=($sort == "b.sdate")?"selected":"";?>>날짜
							<option value="a.state" <?=($sort == "b.state")?"selected":"";?>>승인
						</select>
					</td>
				</tr>
				</form>
		</table>
		
		<!----// 교육프로그램 > 교육강좌소개 > 정규강좌 s ---->
		<table class="bbsCont" cellspacing="0" summary="전문가 목록 보기">	
			<colgroup>
				<col width="8%"/>
				<col />
				<col width="10%"/>
				<col width="12%"/>
				<col width="12%"/>
				<col width="15%"/>
				<col width="10%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">강좌명</th>
					<th scope="col">이름</th>
					<th scope="col">시작일</th>
					<th scope="col">수강료</th>
					<th scope="col">승인</th>
					<th scope="col">삭제</th>
				</tr>
			</thead>
			<form name="thisform" method="post" action="<?=$pageUrl?>&page=/pages/admin/edu/edu_order_db.php">
			<input type="hidden" name="ouid" value="">
			<input type="hidden" name="sort"	 value="<?=$sort?>">
			<input type="hidden" name="sYear"  value="<?=$sYear?>">
			<input type="hidden" name="sMonth" value="<?=$sMonth?>">
			<input type="hidden" name="pageIdx"   value="<?=$pageIdx?>">
			<input type="hidden" name="uid"	 value="<?=$uid?>">
			<tbody>
				<?
				$c1_que = "SELECT c1_num, c1_name FROM edu_c1";
				$c1_rs	= mysql_query($c1_que);
				while($c1_row = mysql_fetch_array($c1_rs))
				{
					$view_c1_name[$c1_row[c1_num]] = $c1_row[c1_name];
				}

				if($kind) { $c1_addquery = " AND a.kind = ".$kind." "; }

				$query	= "SELECT * FROM edu_order AS a, edu AS b, members AS c WHERE  a.uid = b.uid AND a.id = c.user_id ".$c1_addquery.$addquery." ORDER BY $orderby DESC LIMIT $startnum, $pagesize";
				$rs		= mysql_query($query);

				$loop_num=0;
				while ($row = mysql_fetch_array($rs))
				{
					$ouid		= $row[ouid];
					$uid		= $row[uid];
					$c1_num		= $row[c1_num];
					$id			= $row[id];
					$kind_name	= $view_c1_name[$row[kind]];
					$subject	= $row[subject];
					$sdate		= date("Y.m.d",$row[sdate]);
					$edate		= date("Y.m.d",$row[edate]);
					$t_time		= $row[t_time];
					$price		= $row[price];
					$room		= $row[room];
					$t_person	= $row[t_person];
					$teach		= $row[teach];
					$user_name	= $row[user_name];
					$damdang	= $row[damdang];
					$content1	= $row[content1];
					$content2	= $row[content2];
					$up_file	= $row[up_file]; 
					$state		= $row[state];
					$bank		= $row[bank];

					?>
					<tr>
						<td>
							<?=$record_num?>
						</td>
						<td class="tal">
							<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu_view.php&uid=<?=$uid?>"/><?=$subject?></a>
						</td>
						<td><?=$user_name?></td>
						<td><?=$sdate?></td>
						<td><?=number_format($price)?>원</td>
						<td>
							<select name=state[<?=$ouid?>] onChange="go_state('<?=$ouid?>')">
								<option value="1" <?=($state == "1") ? " selected" : ""; ?>>승인대기
								<option value="2" <?=($state == "2") ? " selected" : ""; ?>>승인완료
								<option value="3" <?=($state == "3") ? " selected" : ""; ?>>승인취소
							</select>
						</td>
						<td><input type="image" src="/pages/admin/images/bbs/btn_delete.gif" value="삭제" onClick="go_del('<?=$ouid?>')"></td>
					</tr>
					<?
					$record_num--;
					$loop_num++;
				}

				?>
				</tbody>
				</form>
				<tfoot>
				<?
					// paging
					$startpage = ((ceil(($pageIdx/10) - 0.01) - 1) * 10) + 1;
					$endpage = $startpage + 9;
					$endpage = ($totalpages < $endpage) ? $totalpages : $endpage;

					$prevpage = ($startpage != 1) ? $startpage - 10 : 1 ;
					$nextpage = (($endpage + 1) > $totalpages) ? $totalpages : $endpage + 1;
				?>
					<tr>
						<td colspan="7">
							<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu_order.php&pageIdx=1">
							[처음]
							</a>
							<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu_order.php&pageIdx=<?=$prevpage?><?=$addparameter?>">&lt;</a>

								<?
								for ($i = $startpage; $i <= $endpage; $i++)
								{
									echo "<a href='{$pageUrl}&page=/pages/admin/edu/edu_order.php&pageIdx=$i$addparameter'><font class=pagev>";
									echo ($i == $pageIdx) ? "<b>$i</b>" : $i;
									echo "</font></a> ";
								}
								?>
							<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu_order.php&pageIdx=<?=$nextpage?><?=$addparameter?>">&gt;</a> <a href="<?=$pageUrl?>&page=/pages/admin/edu/edu_order.php&pageIdx=<?=$totalpages?><?=$addparameter?>">[맨뒤]</a>
						</td>
					</tr>
					<tr>
						<td colspan="8">
							<form name=searchForm method=post action="<?=$pageUrl?>&page=/pages/admin/edu/edu_order.php" onsubmit='return searchGo()'>
							<input type=hidden name="pageIdx" value="<?=$pageIdx?>">
							<input type=hidden name="sort" value="<?=$sort?>">
							<input type=hidden name="sYear" value="<?=$sYear?>">
							<input type=hidden name="sMonth" value="<?=$sMonth?>">

									<select name="searchby" style="background-color:FFFFFF;color:#555555;font-size:12px;width:77;height:18">
										<option value=''>선택</option>
										<option value="b.subject" <?=($searchby == 'b.subject') ? "selected" : "";?>>강좌명
									</select>
									<input type="text" name="keyword" class="basic" title="검색어" value="<?=$keyword?>" />
									<input type="image" src="/pages/admin/images/bbs/btn_search.gif" value="검색" alt="검색" class="vmiddle" />
							</form>				
						</td>
					</tr>
				</tfoot>
				</table>