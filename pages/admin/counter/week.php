<?
session_start();
include ("../../config/mysql.inc.php");

$mysql = new Mysql_DB;
$mysql->Connect();

$year = $_REQUEST["year"];
$month = $_REQUEST["month"];
$day = $_REQUEST["day"];
$code = $_REQUEST["code"];
$mode = $_REQUEST["mode"];


if(!$year)	$year=date("Y");
if(!$month) $month=date("m");
if(!$day)	$day=date("d");

$month = (strlen($month) == 1) ? "0".$month : $month;
$day = (strlen($day) == 1) ? "0".$day : $day;


$end_day = date("t", mktime(0,0,0,$month,1,$year)); //달의 마지막 이 몇일인지 리턴


$qry = "SELECT SUM(total) AS total FROM counter2 WHERE year = '$year' AND month = '$month'";
$mysql->ParseExec($qry); 
$mysql->FetchInto(&$col);
$total_cnt = $col[total];

$query = "SELECT * FROM counter2 WHERE year = '$year' AND month = '$month'";
$rs = mysql_query($query);
while($row = mysql_fetch_array($rs))
{
	if($row[day])
	{
		if		(date("w", mktime(0,0,0,$month, $row[day], $year)) == 0) { $week_cnt[0] += $row[total]; }
		else if	(date("w", mktime(0,0,0,$month, $row[day], $year)) == 1) { $week_cnt[1] += $row[total]; }
		else if	(date("w", mktime(0,0,0,$month, $row[day], $year)) == 2) { $week_cnt[2] += $row[total]; }
		else if	(date("w", mktime(0,0,0,$month, $row[day], $year)) == 3) { $week_cnt[3] += $row[total]; }
		else if	(date("w", mktime(0,0,0,$month, $row[day], $year)) == 4) { $week_cnt[4] += $row[total]; }
		else if	(date("w", mktime(0,0,0,$month, $row[day], $year)) == 5) { $week_cnt[5] += $row[total]; }
		else if	(date("w", mktime(0,0,0,$month, $row[day], $year)) == 6) { $week_cnt[6] += $row[total]; }
	}	
}

$week_per[0] = ($week_cnt[0] == 0) ? "0" : $week_cnt[0]/$total_cnt*100;
$week_per[1] = ($week_cnt[1] == 0) ? "0" : $week_cnt[1]/$total_cnt*100;
$week_per[2] = ($week_cnt[2] == 0) ? "0" : $week_cnt[2]/$total_cnt*100;
$week_per[3] = ($week_cnt[3] == 0) ? "0" : $week_cnt[3]/$total_cnt*100;
$week_per[4] = ($week_cnt[4] == 0) ? "0" : $week_cnt[4]/$total_cnt*100;
$week_per[5] = ($week_cnt[5] == 0) ? "0" : $week_cnt[5]/$total_cnt*100;
$week_per[6] = ($week_cnt[6] == 0) ? "0" : $week_cnt[6]/$total_cnt*100;
?>


<script type="text/javascript">
<!--
	function setting()
	{
		form = document.Form1;
		form.YY.value = '<? echo $YY ?>';
		form.MM.value = '<? echo $MM ?>';
	}
	function rbar (st,col) { st.style.backgroundColor = '#F0F3F4';return;}
	function cbar (st) { st.style.backgroundColor = '';return;}
-->
</script>

		<form name="count" method="post" action="<?=$pageUrl.$pageName?>&page=/pages/admin/counter/week.php">
		<input type="hidden" name="code" value="<?=$code?>">
		<input type="hidden" name="mode" value="<?=$mode?>">
		<table width="100%" height="26" cellpadding="0" cellspacing="0">
		  <tr>
			<td>
				<img src="/pages/admin/images/common/bullet_box_gray.gif"> 총 : <strong><?=number_format($total_cnt)?></strong> 명
			</td>
			<td class="aright">
				<select name="year">
					<? for($y=2013;$y<=date('Y');$y++){ ?>
					<option value="<?=$y?>" <?=($y == $year)?"selected":"";?>><?=$y?></option>
					<? } ?>
				</select> 년
				<select name="month">
					<?
					for($m=1;$m<13;$m++){ 
					?>
					<option value="<?=$m?>" <?=($m == $month)?"selected":"";?>><?=$m?></option>
					<? } ?>
				</select> 월
				<input type="submit" value="검색" class="vmiddle">
			</td>
		  </tr>
		</table>
		</form>

		<table class="bbsCont" cellspacing="0" summary="요일별 통계 목록 보기">
			<colgroup>
				<col width="10%"/>
				<col width="10%"/>
				<col />
			</colgroup>
			<thead>
				<tr>
					<th scope="col">요일</th>
					<th scope="col">접속수</th>
					<th scope="col">그래프</th>
				</tr>
			</thead>
			<tbody>
				<? for($i = 0 ;$i <= 6; $i++) 
				{
					if		($i == 0){$week = '일';}
					else if	($i == 1){$week = '월';}
					else if	($i == 2){$week = '화';}
					else if	($i == 3){$week = '수';}
					else if	($i == 4){$week = '목';}
					else if	($i == 5){$week = '금';}
					else if	($i == 6){$week = '토';}
					?>
				<tr>	
					<th><?=$week?></th>
					<td><?=number_format($week_cnt[$i])?></td>
					<td class="tal"><img src="/pages/admin/images/common/ico_satisfaction_bar.gif" width="<?=($week_per[$i] > 92)?"92":$week_per[$i]-2;?>%" height="30" >&nbsp;<?=number_format($week_per[$i])?>%</td>
				</tr>
				<? } ?>
			</tbody>
		</table>