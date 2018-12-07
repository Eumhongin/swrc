<?
session_start();
include ("../../config/mysql.inc.php");

$pageUrl .= $pageName;

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

if(strlen($month) == 1) $month = "0".$month;


$qry = "SELECT SUM(total) AS total FROM counter2 WHERE year = '$year' and month = '$month'";
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
		form.MM.value = '<? echo $MM ?>';
	}
	function rbar (st,col) { st.style.backgroundColor = '#F0F3F4';return;}
	function cbar (st) { st.style.backgroundColor = '';return;}
-->
</script>

	<form name="count" method="post" action="<?=$pageUrl?>&page=/pages/admin/counter/day.php">
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
				<th scope="col">일</th>
				<th scope="col">접속수</th>
				<th scope="col">그래프</th>
			</tr>
		</thead>
		<tbody>
<?

$query = "SELECT total, day FROM counter2 WHERE year = '$year' AND month = '$month'";
$rs = mysql_query($query);
while($row = mysql_fetch_array($rs))
{
	$day = $row[day];
	$day_cnt[$day] = $row[total];

	$day_per[$day] = ($row[total] == 0) ? "0":$row[total]/$total_cnt*100;
}

$end_day = date("t", mktime(0,0,0,$month,1,$year)); //달의 마지막 이 몇일인지 리턴


			for($j=1; $j<= $end_day; $j++)  { 
				 
				 if ($arrData[$j][0] == $maxCount and $maxCount <> 0) {
							$arrData[$j][0] = "<b>" . $arrData[$j][0] . "</b>";
					}
					
					if ($year <> "" and $month <> "") {
						 $weeknum = date("w",mktime(0,0,0,$month,$j,$year)); 
						 if ($weeknum == 0) $curColor = "#FF3366";
						 elseif ($weeknum == 6) $curColor = "#5465B4";
						 else $curColor = "";
					}

					$d = (strlen($j) == 1)?"0".$j:$j;
					
			?>
			<tr>	
				<th><? echo $j ?>日&nbsp;&nbsp;&nbsp;</th>
				<td><?=number_format($day_cnt[$d])?></td>
				<td class="tal"><img src="/pages/admin/images/common/ico_satisfaction_bar.gif" width="<?=($day_per[$d] > 92)?"92":$day_per[$d]-2;?>%" height="30">&nbsp;<?=number_format($day_per[$d])?>%</td>
			</tr>
			<? } ?>
		</tbody>
	</table>