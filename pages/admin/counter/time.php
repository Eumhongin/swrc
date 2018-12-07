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

$qry = "SELECT total FROM counter2 WHERE year = '$year' AND month = '$month' AND day = '$day'";
$mysql->ParseExec($qry); 
$mysql->FetchInto(&$col);
$cnt_total = $col[total];


$end_day = date("t", mktime(0,0,0,$month,1,$year)); //달의 마지막 이 몇일인지 리턴
?>
<script type="text/javascript">
<!--
	function setting()
	{
		form = document.Form1;
		form.YY.value = '<? echo $YY ?>';
		form.MM.value = '<? echo $MM ?>';
		form.DD.value = '<? echo $DD ?>';
	}
	function rbar (st,col) { st.style.backgroundColor = '#F0F3F4';return;}
	function cbar (st) { st.style.backgroundColor = '';return;}
-->
</script>

<?
$query = "SELECT time0,time1,time2,time3,time4,time5,time6,time7,time8,time9,time10,time11,time12,time13,time14,time15,time16,time17,time18,time19,time20,time21,time22,time23,total FROM counter2 WHERE year = '$year' AND month = '$month' AND day = '$day'";

$rs = mysql_query($query);
while($row = mysql_fetch_array($rs))
{
	for($i = 0; $i < 24 ; $i++)
	{
		$hour_cnt[$i] = $row['time'.$i];
		$hour_per[$i] = ($hour_cnt[$i] == 0) ? "0" : $hour_cnt[$i]/mysql_result($rs,0,24)*100;
	}
}
?>
		<form name="count" method="post" action="<?=$pageUrl.$pageName?>&page=/pages/admin/counter/time.php">
		<input type="hidden" name="code" value="<?=$code?>">
		<input type="hidden" name="mode" value="<?=$mode?>">
		<table width="100%" height="26" cellpadding="0" cellspacing="0">
		  <tr>
			<td>
				<img src="/pages/admin/images/common/bullet_box_gray.gif"> 총 : <strong><?=number_format($cnt_total)?></strong> 명
			</td>
			<td class="aright">
				<select name="year">
						<? for($y=2013;$y<=date('Y');$y++){ ?>
						<option value="<?=$y?>" <?=($y==$year)?"selected":"";?>><?=$y?></option>
						<? } ?>
					</select> 년
					<select name="month">
						<?
						for($m=1;$m<13;$m++){ 
						?>
						<option value="<?=$m?>" <?=($m==$month)?"selected":"";?>><?=$m?></option>
						<? } ?>
					</select> 월
					<select name="day">
						<?
						for($d=1;$d<=$end_day;$d++){ 
						?>
						<option value="<?=$d?>" <?=($d==$day)?"selected":"";?>><?=$d?></option>
						<? } ?>
					</select> 일
				<input type="submit" value="검색" class="vmiddle">
			</td>
		  </tr>
		</table>
		</form>

		<table class="bbsCont" cellspacing="0" summary="시간별 통계 목록 보기">
			<colgroup>
				<col width="10%"/>
				<col width="10%"/>
				<col />
			</colgroup>
			<thead>
				<tr>
					<th scope="col">시간</th>
					<th scope="col">접속수</th>
					<th scope="col">그래프</th>
				</tr>
			</thead>
			<tbody>
				<? for($i = 0 ;$i <= 23; $i++) { ?>
				<tr>	
					<th><? echo $i ?>시&nbsp;&nbsp;&nbsp;</th>
					<td><?=number_format($hour_cnt[$i])?></td>
					<td class="tal"><img src="/pages/admin/images/common/ico_satisfaction_bar.gif" width="<?=($hour_per[$i]>92)?"92":$hour_per[$i]-2;?>%" height="30">&nbsp<?=number_format($hour_per[$i])?>%</td>
				</tr>
				<? } ?>
			</tbody>
		</table>