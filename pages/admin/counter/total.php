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

if(!$year) $year=date("Y");
if(!$month) $month=date("m");
if(!$day) $day=date("d");
$maketime = mktime(0,0,0,$month,$day,$year);

# 전체
$qry = "SELECT SUM(total) AS total FROM counter2";
$mysql->ParseExec($qry); 
$mysql->FetchInto(&$col);
$cnt_total = number_format($col[total]);


# 오늘
$sql = "SELECT total FROM counter2 WHERE year = '$year' AND month = '$month' AND day = '$day'";
$rs  = mysql_query($sql);
$row = mysql_fetch_array($rs);

$cnt_today = number_format($row[total]);

# 어제
$yesterday	= $maketime - 86400;
$y_year		= date("Y", $yesterday);
$y_month	= date("m", $yesterday);
$y_day		= date("d", $yesterday);

$sql = "SELECT total FROM counter2 WHERE year = '$y_year' AND month = '$y_month' AND day = '$y_day'";
$rs  = mysql_query($sql);
$row = mysql_fetch_array($rs);
$cnt_yesterday = number_format($row["total"]);

# 최고
$sql = "SELECT MAX(total) AS max_total, MIN(total) AS min_total, AVG(total) AS avg_total FROM counter2";
$rs	 = mysql_query($sql);
$row = mysql_fetch_array($rs);
$cnt_max = number_format($row["max_total"]);
$cnt_min = number_format($row["min_total"]);
$cnt_avg = number_format($row["avg_total"]);
?>


	<table width="100%" height="26" cellpadding="0" cellspacing="0">
		<tr>
			<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> 접속통계현황 - 전체</td>
		</tr>
	</table>

	<table class="bbsCont" cellspacing="0">
		<caption class="none">전체 접속통계현황</caption>
		<colgroup>
			<col width="25%" />
			<col />
		</colgroup>
		<thead>
			<tr>
				<th colspan="2" class="fir">전체 접속통계현황</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Total visit (총 방문자수)</th>
				<td><?=$cnt_total?> 명</td>
			</tr>
			<tr>
				<th>Yesterday (어제 방문자수)</th>
				<td><?=$cnt_yesterday?> 명</td>
			</tr>
			<tr>
				<th>Today (오늘 방문자수)</th>
				<td><?=$cnt_today?> 명</td>
			</tr>
			<tr>
				<th>Max hit per day (최고 방문자수)</th>
				<td><?=$cnt_max?> 명</td>
			</tr>
			<tr>
				<th>Min hit per day (최소 방문자수)</th>
				<td><?=$cnt_min?> 명</td>
			</tr>
			<tr>
				<th>verage hit per day (평균 방문자수)</th>
				<td><?=$cnt_avg?> 명</td>
			</tr>
		</tbody>
	</table>