<?

	include("../../config/mysql.inc.php");     //** �������

	$pageUrl .= $pageName;
	
	$mysql = new Mysql_DB;
	$mysql->Connect();


#kind ���� = 1:���԰���, 2:��ȹ����
if(!$kind) { $kind = 1; }
if			($kind == 1) { $kind_name = "����"; }
else if	($kind == 2) { $kind_name = "��ȹ"; }

$SQL = "SELECT * FROM edu WHERE uid = ".$uid;
$QUE = mysql_query($SQL);
$RES = mysql_fetch_array($QUE);

$trtr			= $RES[trtr];
$level		= $RES[level];
$subject	= $RES[subject];
$content	= $RES[content];
$t_time		= $RES[t_time];
$price		= $RES[price];


$SQL2 = "SELECT * FROM edu_list WHERE uid = ".$uid." ORDER BY luid ASC";
$QUE2 = mysql_query($SQL2);

?>

<script type="text/javascript" src="../js/ms_patch.js"></script>

<?
$que = "select * from edu WHERE uid = ".$uid."";
$rs  = mysql_query($que);
$row = mysql_fetch_array($rs);

$uid		= $row[uid];
$kind		= $row[kind]; 
$subject	= $row[subject]; 
$sdate		= $row[sdate];
$edate		= $row[edate];
$stime		= $row[stime];
$etime		= $row[etime];
$t_time		= $row[t_time];
$price		= $row[price];
$room		= $row[room];
$t_person	= $row[t_person];
$teach		= $row[teach];
$damdang	= $row[damdang];
$content1	= $row[content1];
$content2	= $row[content2];
$up_file	= $row[up_file];

?>
		<p class="contTitle"><?=$kind_name?> ���� ����</p>

						
		<!----// edu lecture ��� �� s---->

		<script type="text/javascript">
		<!--
		function chk_form()
		{
				if(!document.thisform.subject.value)
				{
						alert("���¸��� �Է��Ͽ��ֽʽÿ�.");
						document.thisform.subject.focus();
						return;
				}

				if(!document.thisform.t_time.value)
				{
						alert("�Ѱ��� �ð��� �Է��Ͽ��ֽʽÿ�.\n\n�Ѱ��� �ð��� ���ǳ��� ��Ͻ� �����ϽǼ� �ֽ��ϴ�.");
						document.thisform.t_time.focus();
						return;
				}

				if(!document.thisform.price.value)
				{
						alert("�����Ḧ �Է��Ͽ� �ֽʽÿ�.");
						document.thisform.price.focus();
						return;
				}

				document.thisform.submit();
		}
		//-->
		</script>



			<form name="thisform" method=post action="<?=$pageUrl?>&page=/pages/admin/edu/edu_edit_db.php" enctype='multipart/form-data'>
			<input type=hidden name=kind value="<?=$kind?>">
			<input type=hidden name=uid value="<?=$uid?>">

			<table class="bbsCont" cellspacing="0" summary="���� ����� �ϴ� ǥ">
					<caption class="none">���� ���</caption>
					<colgroup>
						<col width="15%" />
						<col width="35%" />
						<col width="15%" />
						<col width="35%" />
					</colgroup>
					<thead>
						<tr>
							<th colspan="4">���� ���</th>
						</tr>
					</thead>
					<tbody>
			<tr>
				<th>�з�</th>
				<td colspan="3" class="tal">
					<select name=kind>
						<?
						$c1_rs = mysql_query("SELECT * FROM edu_c1 ORDER BY c1_num ASC");
						while($c1_row = mysql_fetch_array($c1_rs))
						{
						?>
							<option value="<?=$c1_row[c1_num]?>" <?=($c1_row[c1_num] == $kind)?"selected":""?>><?=$c1_row[c1_name]?>
						<?
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th>���¸�</th>
				<td class="tal"><input type=text name="subject" value="<?=$subject?>" style="width:90%;" class="basic" /></td>
				<th>�� ���ǽð�</th>
				<td class="tal"><input type=text name="t_time" value="<?=$t_time?>" class="basic" /></td></tr>

			<?
			$pYear = date("Y", time());
			$pMonth = date("m", time());
			$pDay = date("d", time());
			?>
			<tr>
				<th>������</th>
				<td class="tal"><select name="sYear">
							<?
							$db_sYear	= date("Y", $sdate);
							$db_sMonth	= date("m", $sdate);
							$db_sDay	= date("d", $sdate);
							for($i = 2007 ; $i <= $pYear + 1 ; $i++)
							{
								$sel = ($i == $db_sYear) ? "selected" : "";

								echo "<option value='{$i}' {$sel}>".$i;
							}
							?>
						</select>��&nbsp;&nbsp;
						
						<select name="sMonth">
							<?
							for($i = 1 ; $i <= 12 ; $i++)
							{
								$sel = ($i == $db_sMonth) ? "selected" : "";

								echo "<option value='{$i}' {$sel}>".$i;
							}
							?>
						</select>��&nbsp;&nbsp;

						<select name="sDay">
							<?
							for($i = 1; $i <=31 ; $i++)
							{
								$sel = ($i == $db_sDay) ? "selected" : "";

								echo "<option value='{$i}' {$sel}>".$i;
							}
							?>
						</select>��



					</td>
					<th>������</th>
					<td class="tal">
						<select name="eYear">
							<?
							$db_eYear	= date("Y", $edate);
							$db_eMonth	= date("m", $edate);
							$db_eDay	= date("d", $edate);

							for($i = 2007 ; $i <= $pYear + 1 ; $i++)
							{
								$sel = ($i == $db_eYear) ? "selected" : "";

								echo "<option value='{$i}' {$sel}>".$i;
							}
							?>
						</select>��&nbsp;&nbsp;
						
						<select name="eMonth">
							<?
							for($i = 1 ; $i <= 12 ; $i++)
							{
								$sel = ($i == $db_eMonth) ? "selected" : "";

								echo "<option value='{$i}' {$sel}>".$i;
							}
							?>
						</select>��&nbsp;&nbsp;

						<select name="eDay">
							<?
							for($i = 1; $i <=31 ; $i++)
							{
								$sel = ($i == $db_eDay) ? "selected" : "";

								echo "<option value='{$i}' {$sel}>".$i;
							}
							?>
						</select>��


					</td>

			</tr>
			<tr>
				<th>���ǽð�</th>
				<td class="tal">
					<select name=sTime>
						<?
						for($i = 9 ; $i <= 24 ; $i++)
						{
							if($stime == $i) { $sel = "selected"; }
							else			 { $sel = ""; }

							echo "<option value='$i' $sel>$i";
						}
						?>
					</select> 
					~ 
					<select name=eTime>
						<?
						for($i = 9 ; $i <= 24 ; $i++)
						{
							if($etime == $i) { $sel = "selected"; }
							else			 { $sel = ""; }
							echo "<option value='$i' $sel>$i";
						}
						?>
					</select>
				</td>
				<th>������</th>
				<td class="tal"><input type=text name=price value="<?=$price?>" class="basic" /></td>
			</tr>
			<tr>
				<th>���ǽ�</th>
				<td class="tal"><input type=text name=room value="<?=$room?>" style="width:90%;" class="basic" /></td>
				<th>�����</th>
				<td class="tal"><input type=text name=teach value="<?=$teach?>" style="width:30%;" class="basic" /></td>
			</tr>
			<tr>
				<th>�����ο�</th>
				<td class="tal"><input type=text name=t_person value="<?=$t_person?>" style="width:20%;" class="basic" /></td>
				<th>�����</th>
				<td class="tal"><input type=text name=damdang value="<?=$damdang?>" style="width:30%;" class="basic" /></td>
			</tr>
			<tr>
				<th>��������</th>
				<td class="tal" colspan="3"><textarea name=content1 style="width:100%; height:100px;"><?=$content1?></textarea></td>
			</tr>
			<tr>
				<th>��������</th>
				<td class="tal" colspan="3"><textarea name=content2 style="width:100%; height:100px;"><?=$content2?></textarea></td>
			</tr>
			<tr>
				<th>���α�������</th>
				<td class="tal" colspan="3"><input type=file name="file" class="basic" /></td>
			</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4">						
						<input type="image" src="/pages/admin/images/bbs/btn_edu_edit.gif" value="���� ���� ����" onClick="chk_form()" />
					</td>
				</tr>
			</tfoot>
		</table>
		</form>