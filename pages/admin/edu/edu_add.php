<?
	include("../../config/mysql.inc.php");     //** �������

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();
?>

		<script type="text/javascript" src="../js/ms_patch.js"></script>



		<table width="100%" height="26" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/pages/admin/images/common/bullet_box_gray.gif"><?=$kind_name?> ���� ��� </td>
			</tr>
		</table>

				
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



				<form name="thisform" method="post" action="<?=$pageUrl?>&page=/pages/admin/edu/edu_add2_db.php" enctype='multipart/form-data'>
				<input type="hidden" name="kind" value="<?=$kind?>">
				
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
								<select name="kind">
									<?
									$c1_rs = mysql_query("SELECT * FROM edu_c1 ORDER BY c1_num ASC");
									while($c1_row = mysql_fetch_array($c1_rs))
									{
									?>
										<option value="<?=$c1_row[c1_num]?>"><?=$c1_row[c1_name]?>
									<?
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<th>���¸�</th>
							<td class="tal"><input type="text" name="subject" style="width:90%;" class="basic" /></td>
							<th>�� ���ǽð�</th>
							<td class="tal"><input type="text" name="t_time" class="basic" /></td></tr>

				<?
				$pYear = date("Y", time());
				$pMonth = date("m", time());
				$pDay = date("d", time());
				?>
				<tr>
						<th>������</th>
						<td class="tal"><select name="sYear">
								<?
								for($i = 2007 ; $i <= $pYear + 1 ; $i++)
								{
									$sel = ($i == $pYear) ? "selected" : "";

									echo "<option value='{$i}' {$sel}>".$i;
								}
								?>
							</select>��&nbsp;&nbsp;
							
							<select name="sMonth">
								<?
								for($i = 1 ; $i <= 12 ; $i++)
								{
									$sel = ($i == $pMonth) ? "selected" : "";

									echo "<option value='{$i}' {$sel}>".$i;
								}
								?>
							</select>��&nbsp;&nbsp;

							<select name="sDay">
								<?
								for($i = 1; $i <=31 ; $i++)
								{
									$sel = ($i == $pDay) ? "selected" : "";

									echo "<option value='{$i}' {$sel}>".$i;
								}
								?>
							</select>��



						</td>
						<th>������</th>
						<td class="tal">
							<select name="eYear">
								<?
								for($i = 2007 ; $i <= $pYear + 1 ; $i++)
								{
									$sel = ($i == $pYear) ? "selected" : "";

									echo "<option value='{$i}' {$sel}>".$i;
								}
								?>
							</select>��&nbsp;&nbsp;
							
							<select name="eMonth">
								<?
								for($i = 1 ; $i <= 12 ; $i++)
								{
									$sel = ($i == $pMonth) ? "selected" : "";

									echo "<option value='{$i}' {$sel}>".$i;
								}
								?>
							</select>��&nbsp;&nbsp;

							<select name="eDay">
								<?
								for($i = 1; $i <=31 ; $i++)
								{
									$sel = ($i == $pDay) ? "selected" : "";

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
							for($i = 1 ; $i <= 24 ; $i++)
							{
								echo "<option value='$i'>$i";
							}
							?>
						</select> 
						~ 
						<select name=eTime>
							<?
							for($i = 1 ; $i <= 24 ; $i++)
							{
								echo "<option value='$i'>$i";
							}
							?>
						</select>
					</td>
					<th>������</th>
					<td class="tal"><input type=text name="price" class="basic" /></td>
				</tr>
				<tr>
					<th>���ǽ�</th>
					<td class="tal"><input type=text name=room style="width:90%;" class="basic" /></td>
					<th>�����</th>
					<td class="tal"><input type=text name=teach style="width:30%;" class="basic" /></td>
				</tr>
				<tr>
					<th>�����ο�</th>
					<td class="tal"><input type=text name=t_person style="width:20%;" class="basic" /></td>
					<th>�����</th>
					<td class="tal"><input type=text name=damdang style="width:30%;" class="basic" /></td>
				</tr>
				<tr>
					<th>��������</th>
					<td colspan=3 class="tal"><textarea name=content1 style="width:100%; height:100px;"></textarea></td>
				</tr>
				<tr>
					<th>��������</th>
					<td colspan=3 class="tal"><textarea name=content2 style="width:100%; height:100px;"></textarea></td>
				</tr>
				<tr>
					<th>���α�������</th>
					<td colspan=3 class="tal"><input type=file name="file" class="basic" /></td>
				</tr>
				</tbody>
			<tfoot>
			<tr>
					<td colspan="4">						
						<button type="button" onclick="chk_form();" class="vmiddle"><img src="/pages/admin/images/bbs/btn_write_big.gif"></button>
						<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="���" /></a>
					</td>
				</tr>
			</tfoot>
		</table>
		</form>