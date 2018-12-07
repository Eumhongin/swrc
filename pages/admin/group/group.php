<?

	include("../../config/mysql.inc.php");  
	include("../../config/comm.inc.php");  

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();
	
	//자동으로 등급 코드를 지정한다
	$max_qry = "Select Max(l_level) From m_level Where l_level <> 99 ";
	$mysql->ParseExec($max_qry); 
	$max = $mysql->FetchInto(&$col,MYSQL_NUM);
	$max_level = $max[0] + 1 ;

	if ($max_level == 99) $max_level = 100; 
	$mysql->ParseFree();

	// 리스트 형식으로 내용을 보여준다
	$qry = "Select * From m_level Order by l_power, l_level ";
	$mysql->ParseExec($qry); 
?>

<script type="text/javascript" src="/pages/bbs/js/comm.js"></script>

	<p class="contTitle">회원등급관리</p>

	<table class="bbsCont" cellspacing="0" summary="회원등급 목록 보기">
			<colgroup>
				<col width="10%"/>
				<col width="25%"/>
				<col />
				<col width="15%"/>
				<col width="15%"/>
				<col width="15%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">등급코드</th>
					<th scope="col">등급명</th>
					<th scope="col">권 한</th>
					<th scope="col">게시판</th>
					<th scope="col">관리자메뉴</th>
					<th scope="col">비 고</th>
				</tr>
			</thead>
			<tbody>

			<form name="frm" method="post" action="<?=$pageUrl?>&page=/pages/admin/group/regist.php">
			<input type="hidden" name="mode" value="write">
				<tr>
					<td>
						<input type="text" name="p_level" size="3" maxlength="3" class="basic" value="<?= $max_level ?>" readonly>
					</td>
					<td><input type="text" name="p_levelname" size="30" maxlength="25" class="basic" /></td>
					<td><select name="p_power">
							<option value="0">손님</option>
							<option value="1">회원</option>
							<option value="2">부관리자</option>
							</select>
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>
						<a href="javascript:level_checkform()"><img src="/pages/admin/images/bbs/btn_ok.gif" align="absmiddle" border="0"></a>
					</td>
				</tr>
				</form>
				<form name="upd" method="post">
				<? $i = 0;
					 while($mysql->FetchInto(&$row)) { 

						 $v_level  = $row["l_level"];
						 $v_power  = $row["l_power"];

						 //회원 등급
						 $mysql2 = New MySql_DB();
						 $mysql2->Connect();
						 
						 $qry1 = "Select * From members Where ch_member=$v_level";
						 $mysql2->ParseExec($qry1);
				?>
				<tr>
					<td>
						<input type="text" name="p_level" size="3" maxlength="3" class="basic" value="<?= $v_level ?>" readonly>
					</td>
					<td>
						<input type="text" name="p_levelname" size="30" maxlength="25" class="basic" value="<?= $row["l_levelname"]?>">
					</td>
				<? if ($v_level != 99 ) { ?>
					<td>
						<select name="p_power">
							<option value="0" <? if($v_power == 0) {?>selected<? } ?>>손님</option>
							<option value="1" <? if($v_power == 1) {?>selected<? } ?>>회원</option>
							<option value="2" <? if($v_power == 2) {?>selected<? } ?>>부관리자</option>
						</select>
					</td>
					<td>
						<a href="<?=$pageUrl?>&page=/pages/admin/group/menu.php&p_level=<?= $v_level?>">[권한설정]</a>
					</td>
					<td><? if($v_power == 2) { ?><a href="<?=$pageUrl?>&page=/pages/admin/group/admin_menu.php&p_level=<?= $v_level?>">[권한설정]</a><? }else{ ?>-<?}?></td>
					<td>
						<a href="javascript:level_modifycheckform('<?= $i?>')"><img src="/pages/admin/images/bbs/btn_modify.gif" border="0" align="absmiddle"></a> <? if($mysql2->RowCount() > 0) { ?><a href="javascript:alert('이 등급으로 등록된 회원이 존재합니다')"><? } else { ?><a href="javascript:checkdelete(<?= $v_level?>)"><? } ?><img src="/pages/admin/images/bbs/btn_delete.gif" border="0" align="absmiddle"></a>
					</td>
				<? } else { ?>
					<td>관리자</td>
					<td></td>
					<td></td>
					<td></td>
				<? } ?>
				</tr>
			<? $i++;

						} 
			?>
				<input type="hidden" name="p_arrnum" value="<?= $i ?>">
				</form>
				</tbody>
		</table>
		<br />

		<p class="contTitle">회원가입시등급</p>

<form name="updfrm" method="post" action="<?=$pageUrl?>&page=/pages/admin/group/regist.php">
<input type="hidden" name="mode" value="modify">
<input type="hidden" name="p_level">
<input type="hidden" name="p_levelname">
<input type="hidden" name="p_power">
</form>
<table width="100%" class="bbsCont" cellspacing="1">
		<form name="insfrm" method="post" action="regist.php">
		<input type="hidden" name="mode" value="base">
		<tr> 
			<th>등급 선택</th>
			<td class="tal">
					<select name="p_level">
					<? 
						$mysql->DataSeek(0);
						
						while($mysql->FetchInto(&$col,MYSQL_ASSOC)) { 
					?>
					<option value="<?= $col["l_level"]?>" <? if ($col["l_check"] == "y") { ?>selected<? } ?>><?= $col["l_levelname"]?></option>
					<? } ?>
					</select>
				<a href="javascript:insfrm.submit()"><img src="/pages/admin/images/bbs/btn_ok.gif" align="absmiddle" border="0"></a>
			</td>
		</tr>
</table>