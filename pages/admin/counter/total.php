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

# ��ü
$qry = "SELECT SUM(total) AS total FROM counter2";
$mysql->ParseExec($qry); 
$mysql->FetchInto(&$col);
$cnt_total = number_format($col[total]);


# ����
$sql = "SELECT total FROM counter2 WHERE year = '$year' AND month = '$month' AND day = '$day'";
$rs  = mysql_query($sql);
$row = mysql_fetch_array($rs);

$cnt_today = number_format($row[total]);

# ����
$yesterday	= $maketime - 86400;
$y_year		= date("Y", $yesterday);
$y_month	= date("m", $yesterday);
$y_day		= date("d", $yesterday);

$sql = "SELECT total FROM counter2 WHERE year = '$y_year' AND month = '$y_month' AND day = '$y_day'";
$rs  = mysql_query($sql);
$row = mysql_fetch_array($rs);
$cnt_yesterday = number_format($row["total"]);

# �ְ�
$sql = "SELECT MAX(total) AS max_total, MIN(total) AS min_total, AVG(total) AS avg_total FROM counter2";
$rs	 = mysql_query($sql);
$row = mysql_fetch_array($rs);
$cnt_max = number_format($row["max_total"]);
$cnt_min = number_format($row["min_total"]);
$cnt_avg = number_format($row["avg_total"]);
?>


	<table width="100%" height="26" cellpadding="0" cellspacing="0">
		<tr>
			<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> ���������Ȳ - ��ü</td>
		</tr>
	</table>

	<table class="bbsCont" cellspacing="0">
		<caption class="none">��ü ���������Ȳ</caption>
		<colgroup>
			<col width="25%" />
			<col />
		</colgroup>
		<thead>
			<tr>
				<th colspan="2" class="fir">��ü ���������Ȳ</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Total visit (�� �湮�ڼ�)</th>
				<td><?=$cnt_total?> ��</td>
			</tr>
			<tr>
				<th>Yesterday (���� �湮�ڼ�)</th>
				<td><?=$cnt_yesterday?> ��</td>
			</tr>
			<tr>
				<th>Today (���� �湮�ڼ�)</th>
				<td><?=$cnt_today?> ��</td>
			</tr>
			<tr>
				<th>Max hit per day (�ְ� �湮�ڼ�)</th>
				<td><?=$cnt_max?> ��</td>
			</tr>
			<tr>
				<th>Min hit per day (�ּ� �湮�ڼ�)</th>
				<td><?=$cnt_min?> ��</td>
			</tr>
			<tr>
				<th>verage hit per day (��� �湮�ڼ�)</th>
				<td><?=$cnt_avg?> ��</td>
			</tr>
		</tbody>
	</table>