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

// �̹����� ������ ��¥ ����
$lastdate=01;
while (checkdate($month,$lastdate,$year)): 
$lastdate++;  
endwhile;

//ī������ ��
$qry = "SELECT SUM(total) AS total FROM counter2 WHERE year = '$year'";
$mysql->ParseExec($qry); 
$mysql->FetchInto(&$col);
$total_cnt = $col["total"];

$query = "SELECT SUM(total) FROM counter2 WHERE year = '$year' AND (month >=1 AND month <= 3)";
$rs = mysql_query($query);
$quarter_1 = mysql_result($rs,0,0);
$q1_per = ($quarter_1 == 0)?"0":$quarter_1 / $total_cnt * 100;

$query = "SELECT SUM(total) FROM counter2 WHERE year = '$year' AND (month >=4 AND month <= 6)";
$rs = mysql_query($query);
$quarter_2 = mysql_result($rs,0,0);
$q2_per = ($quarter_2 == 0)?"0":$quarter_2 / $total_cnt * 100;

$query = "SELECT SUM(total) FROM counter2 WHERE year = '$year' AND (month >=7 AND month <=9)";
$rs = mysql_query($query);
$quarter_3 = mysql_result($rs,0,0);
$q3_per = ($quarter_3 == 0)?"0":$quarter_3 / $total_cnt * 100;

$query = "SELECT SUM(total) FROM counter2 WHERE year = '$year' AND (month >=10 AND month <=12)";
$rs = mysql_query($query);
$quarter_4 = mysql_result($rs,0,0);
$q4_per = ($quarter_4 == 0)?"0":$quarter_4 / $total_cnt * 100;

?>



<script language="javascript">
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

	<form name="count" method="post" action="<?=$pageUrl?>&page=/pages/admin/counter/quater.php">
	<input type="hidden" name="code" value="<?=$code?>">
	<input type="hidden" name="mode" value="<?=$mode?>">
	<table width="100%" height="26" cellpadding="0" cellspacing="0">
	  <tr>
		<td>
			<img src="/pages/admin/images/common/bullet_box_gray.gif"> �� : <strong><?=number_format($total_cnt)?></strong> ��
		</td>
		<td class="aright">
			<select name="year">
					<? for($i=2013;$i<=date('Y');$i++){ ?>
					<option value="<?=$i?>" <?=($i==$year)?"selected":"";?>><?=$i?></option>
					<? } ?>
			</select> ��
			<input type="submit" value="�˻�" class="vmiddle">
		</td>
	  </tr>
	</table>
	</form>
	<table class="bbsCont" cellspacing="0" summary="�б⺰ ��� ��� ����">
		<colgroup>
			<col width="10%"/>
			<col width="10%"/>
			<col />
		</colgroup>
		<thead>
			<tr>
				<th scope="col">�б�</th>
				<th scope="col">���Ӽ�</th>
				<th scope="col">�׷���</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>1��б�</th>
				<td><?=number_format($quarter_1)?> ��</td>
				<td class="tal">
				<img src="/pages/admin/images/common/ico_satisfaction_bar.gif" width="<?=($q1_per > 92)?"92":$q1_per-8;?>%" height="30" />
				&nbsp;<?=number_format($q1_per)?>%</td>
			</tr>
			<tr>
				<th>2��б�</th>
				<td><?=number_format($quarter_2)?> ��</td>
				<td class="tal"><img src="/pages/admin/images/common/ico_satisfaction_bar.gif" width="<?=($q2_per > 92)?"92":$q2_per-8;?>%" height="30" align="absmiddle">&nbsp;<?=number_format($q2_per)?>%</td>
			</tr>
			<tr>
				<th>3��б�</th>
				<td><?=number_format($quarter_3)?> ��</td>
				<td class="tal"><img src="/pages/admin/images/common/ico_satisfaction_bar.gif" width="<?=($q3_per > 92)?"92":$q3_per-8;?>%" height="30" align="absmiddle">&nbsp;<?=number_format($q3_per)?>%</td>
			</tr>
			<tr>
				<th>4��б�</th>
				<td><?=number_format($quarter_4)?> ��</td>
				<td class="tal"><img src="/pages/admin/images/common/ico_satisfaction_bar.gif" width="<?=($q4_per > 92)?"92":$q4_per-8;?>%" height="30" align="absmiddle">&nbsp;<?=number_format($q4_per)?>%</td>
			</tr>
		</tbody>
	</table>
