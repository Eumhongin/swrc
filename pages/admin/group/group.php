<?

	include("../../config/mysql.inc.php");  
	include("../../config/comm.inc.php");  

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();
	
	//�ڵ����� ��� �ڵ带 �����Ѵ�
	$max_qry = "Select Max(l_level) From m_level Where l_level <> 99 ";
	$mysql->ParseExec($max_qry); 
	$max = $mysql->FetchInto(&$col,MYSQL_NUM);
	$max_level = $max[0] + 1 ;

	if ($max_level == 99) $max_level = 100; 
	$mysql->ParseFree();

	// ����Ʈ �������� ������ �����ش�
	$qry = "Select * From m_level Order by l_power, l_level ";
	$mysql->ParseExec($qry); 
?>

<script type="text/javascript" src="/pages/bbs/js/comm.js"></script>

	<p class="contTitle">ȸ����ް���</p>

	<table class="bbsCont" cellspacing="0" summary="ȸ����� ��� ����">
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
					<th scope="col">����ڵ�</th>
					<th scope="col">��޸�</th>
					<th scope="col">�� ��</th>
					<th scope="col">�Խ���</th>
					<th scope="col">�����ڸ޴�</th>
					<th scope="col">�� ��</th>
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
							<option value="0">�մ�</option>
							<option value="1">ȸ��</option>
							<option value="2">�ΰ�����</option>
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

						 //ȸ�� ���
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
							<option value="0" <? if($v_power == 0) {?>selected<? } ?>>�մ�</option>
							<option value="1" <? if($v_power == 1) {?>selected<? } ?>>ȸ��</option>
							<option value="2" <? if($v_power == 2) {?>selected<? } ?>>�ΰ�����</option>
						</select>
					</td>
					<td>
						<a href="<?=$pageUrl?>&page=/pages/admin/group/menu.php&p_level=<?= $v_level?>">[���Ѽ���]</a>
					</td>
					<td><? if($v_power == 2) { ?><a href="<?=$pageUrl?>&page=/pages/admin/group/admin_menu.php&p_level=<?= $v_level?>">[���Ѽ���]</a><? }else{ ?>-<?}?></td>
					<td>
						<a href="javascript:level_modifycheckform('<?= $i?>')"><img src="/pages/admin/images/bbs/btn_modify.gif" border="0" align="absmiddle"></a> <? if($mysql2->RowCount() > 0) { ?><a href="javascript:alert('�� ������� ��ϵ� ȸ���� �����մϴ�')"><? } else { ?><a href="javascript:checkdelete(<?= $v_level?>)"><? } ?><img src="/pages/admin/images/bbs/btn_delete.gif" border="0" align="absmiddle"></a>
					</td>
				<? } else { ?>
					<td>������</td>
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

		<p class="contTitle">ȸ�����Խõ��</p>

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
			<th>��� ����</th>
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