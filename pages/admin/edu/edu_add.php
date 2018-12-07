<?
	include("../../config/mysql.inc.php");     //** 접속통계

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();
?>

		<script type="text/javascript" src="../js/ms_patch.js"></script>



		<table width="100%" height="26" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/pages/admin/images/common/bullet_box_gray.gif"><?=$kind_name?> 강좌 등록 </td>
			</tr>
		</table>

				
				<!----// edu lecture 등록 폼 s---->

				<script type="text/javascript">
				<!--
				function chk_form()
				{
						if(!document.thisform.subject.value)
						{
								alert("강좌명을 입력하여주십시오.");
								document.thisform.subject.focus();
								return;
						}

						if(!document.thisform.t_time.value)
						{
								alert("총강의 시간을 입력하여주십시오.\n\n총강의 시간은 강의내용 등록시 수정하실수 있습니다.");
								document.thisform.t_time.focus();
								return;
						}

						if(!document.thisform.price.value)
						{
								alert("수강료를 입력하여 주십시오.");
								document.thisform.price.focus();
								return;
						}

						document.thisform.submit();
				}
				//-->
				</script>



				<form name="thisform" method="post" action="<?=$pageUrl?>&page=/pages/admin/edu/edu_add2_db.php" enctype='multipart/form-data'>
				<input type="hidden" name="kind" value="<?=$kind?>">
				
				<table class="bbsCont" cellspacing="0" summary="강좌 등록을 하는 표">
					<caption class="none">강좌 등록</caption>
					<colgroup>
						<col width="15%" />
						<col width="35%" />
						<col width="15%" />
						<col width="35%" />
					</colgroup>
					<thead>
						<tr>
							<th colspan="4">강좌 등록</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>분류</th>
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
							<th>강좌명</th>
							<td class="tal"><input type="text" name="subject" style="width:90%;" class="basic" /></td>
							<th>총 강의시간</th>
							<td class="tal"><input type="text" name="t_time" class="basic" /></td></tr>

				<?
				$pYear = date("Y", time());
				$pMonth = date("m", time());
				$pDay = date("d", time());
				?>
				<tr>
						<th>시작일</th>
						<td class="tal"><select name="sYear">
								<?
								for($i = 2007 ; $i <= $pYear + 1 ; $i++)
								{
									$sel = ($i == $pYear) ? "selected" : "";

									echo "<option value='{$i}' {$sel}>".$i;
								}
								?>
							</select>년&nbsp;&nbsp;
							
							<select name="sMonth">
								<?
								for($i = 1 ; $i <= 12 ; $i++)
								{
									$sel = ($i == $pMonth) ? "selected" : "";

									echo "<option value='{$i}' {$sel}>".$i;
								}
								?>
							</select>월&nbsp;&nbsp;

							<select name="sDay">
								<?
								for($i = 1; $i <=31 ; $i++)
								{
									$sel = ($i == $pDay) ? "selected" : "";

									echo "<option value='{$i}' {$sel}>".$i;
								}
								?>
							</select>일



						</td>
						<th>종료일</th>
						<td class="tal">
							<select name="eYear">
								<?
								for($i = 2007 ; $i <= $pYear + 1 ; $i++)
								{
									$sel = ($i == $pYear) ? "selected" : "";

									echo "<option value='{$i}' {$sel}>".$i;
								}
								?>
							</select>년&nbsp;&nbsp;
							
							<select name="eMonth">
								<?
								for($i = 1 ; $i <= 12 ; $i++)
								{
									$sel = ($i == $pMonth) ? "selected" : "";

									echo "<option value='{$i}' {$sel}>".$i;
								}
								?>
							</select>월&nbsp;&nbsp;

							<select name="eDay">
								<?
								for($i = 1; $i <=31 ; $i++)
								{
									$sel = ($i == $pDay) ? "selected" : "";

									echo "<option value='{$i}' {$sel}>".$i;
								}
								?>
							</select>일


						</td>

				</tr>
				<tr>
					<th>강의시간</th>
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
					<th>수강료</th>
					<td class="tal"><input type=text name="price" class="basic" /></td>
				</tr>
				<tr>
					<th>강의실</th>
					<td class="tal"><input type=text name=room style="width:90%;" class="basic" /></td>
					<th>강사명</th>
					<td class="tal"><input type=text name=teach style="width:30%;" class="basic" /></td>
				</tr>
				<tr>
					<th>수강인원</th>
					<td class="tal"><input type=text name=t_person style="width:20%;" class="basic" /></td>
					<th>담당자</th>
					<td class="tal"><input type=text name=damdang style="width:30%;" class="basic" /></td>
				</tr>
				<tr>
					<th>과정개요</th>
					<td colspan=3 class="tal"><textarea name=content1 style="width:100%; height:100px;"></textarea></td>
				</tr>
				<tr>
					<th>과정내용</th>
					<td colspan=3 class="tal"><textarea name=content2 style="width:100%; height:100px;"></textarea></td>
				</tr>
				<tr>
					<th>세부교육내용</th>
					<td colspan=3 class="tal"><input type=file name="file" class="basic" /></td>
				</tr>
				</tbody>
			<tfoot>
			<tr>
					<td colspan="4">						
						<button type="button" onclick="chk_form();" class="vmiddle"><img src="/pages/admin/images/bbs/btn_write_big.gif"></button>
						<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="취소" /></a>
					</td>
				</tr>
			</tfoot>
		</table>
		</form>