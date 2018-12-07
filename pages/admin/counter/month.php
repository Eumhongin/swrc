<?
session_start();
include ("../../config/mysql.inc.php");

$mysql = new Mysql_DB;
$mysql->Connect();

if(!$year)	$year=date("Y");
if(!$month) $month=date("m");
if(!$day)	$day=date("d");

$end_day = date("t", mktime(0,0,0,$month,1,$year)); //달의 마지막 이 몇일인지 리턴

$qry = "SELECT SUM(total) AS total FROM counter2 WHERE year = '$year'";
$mysql->ParseExec($qry); 
$mysql->FetchInto(&$col);
$total_cnt = $col[total];

?>
<script type="text/javascript">
<!--
	function setting()
	{
		form = document.Form1;
		form.YY.value = '<? echo $YY ?>';
	}
	function rbar (st,col) { st.style.backgroundColor = '#F0F3F4';return;}
	function cbar (st) { st.style.backgroundColor = '';return;}
-->
</script>


<?
for($m = 1; $m < 13 ; $m++)
{
	if(strlen($m) == 1) { $m = '0'.$m; }
	$query = "SELECT SUM(total) FROM counter2 WHERE year = '$year' AND month = '$m'";
	$rs = mysql_query($query);
	$month_cnt[$m] = mysql_result($rs,0,0);
	$month_per[$m] = ($month_cnt[$m] == 0) ? "0" : $month_cnt[$m]/$total_cnt*100;
}
?>

	<form name="count" method="post" action="<?=$pageUrl.$pageName?>&page=/pages/admin/counter/month.php">
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
				<option value="<?=$y?>" <?=($y==$year)?"selected":""; ?>><?=$y?></option>
				<? } ?>
			</select> 년
			<input type="submit" value="검색" class="vmiddle">
		</td>
	  </tr>
	</table>
	</form>
	<table class="bbsCont" cellspacing="0" summary="월별 통계 목록 보기">
		<colgroup>
			<col width="10%"/>
			<col width="10%"/>
			<col />
		</colgroup>
		<thead>
			<tr>
				<th scope="col">월</th>
				<th scope="col">접속수</th>
				<th scope="col">그래프</th>
			</tr>
		</thead>
		<tbody>
			<? for($m = 1; $m <= 12; $m++) { if(strlen($m) == 1) { $m = '0'.$m; }?>
			<tr>	
				<th><? echo $m ?>月&nbsp;</th>
				<td><?=number_format($month_cnt[$m])?></td>
				<td class="tal"><img src="/pages/admin/images/common/ico_satisfaction_bar.gif" width="<?=($month_per[$m] > 92)?"92":$month_per[$m]-2;?>%" height="30" >&nbsp;<?=number_format($month_per[$m])?>%</td>
			</tr>
			<? } ?>
		</tbody>
	</table>