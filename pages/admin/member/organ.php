<?
	// *** ����¡ class ***
	include ("../../config/page_manager_admin.php");
	include ("../../config/mysql.inc.php");

	$pageParameter = $pageUrl.$pageName."&page=".$page;
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	//���� �ڵ� �⺻���� 1
	if($sel_organ_code == "") $sel_organ_code = "1";

	// *** �� �Խù� �� ***
	$total_qry  = " SELECT idx ";
	$total_qry .= " FROM t_organ WHERE organ_code = '".$sel_organ_code."' ";
	$mysql->ParseExec($total_qry);
	$total = $mysql->RowCount();

	$PostNum = 15;
	$a_pagesu = 10;

	// *** �Խù� ��, ������ �� ***
	if(empty($pageIdx)) $pageIdx = 1;

	$StartNum = ( $pageIdx - 1 ) * $PostNum;

	// *** ����¡ ***
	$pg = new initPage($pageIdx, $PostNum);
	$pageList = $pg->getPageList($pageParameter, "", $total, $a_pagesu);	


?>
<script type="text/javascript">
	function imageWindowDelete(idx){
		if(confirm("���� �Ͻðڽ��ϱ�?")) {
			document.location.href="<?= $pageUrl ?>&page=/pages/admin/member/organWrite.php&idx=" + idx +"&mode=delete";
		}
	}

	function fncChengeSelect(){
		document.search_frm.submit(); 
	}
</script>
	<!-- ���� -->

		<form name="search_frm" method="post">
		<table width="100%" height="26" cellpadding="0" cellspacing="0">
		  <tr>
			<td>
				<img src="/pages/admin/images/common/bullet_box_gray.gif"> �˻��� �Խù� : <?=$total?>��
			</td>
			<td class="aright">
				<select name="sel_organ_code" onchange="fncChengeSelect();">
					<option value="1" <?if($sel_organ_code == "1"){?>selected<?}?> >�濵������</option>
					<option value="2" <?if($sel_organ_code == "2"){?>selected<?}?> >IT(����SW)�����</option>
					<option value="3" <?if($sel_organ_code == "3"){?>selected<?}?> >CT(��ȭ������)�����</option>
					<option value="4" <?if($sel_organ_code == "4"){?>selected<?}?> >����̵���</option>
					<option value="5" <?if($sel_organ_code == "5"){?>selected<?}?> >�̷�����TF</option>
				</select>
			</td>
		  </tr>
		</table>
		</form>

		<table class="bbsCont" cellspacing="0" summary="������ ��� ����">
			<colgroup>
				<col width="8%"/>
				<col />
				<col width="10%"/>
				<col width="10%"/>
				<col width="10%"/>
				<col width="15%"/>
				<col width="8%"/>
				<col width="10%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">��ȣ</th>
					<th scope="col">�̸�</th>
					<th scope="col">��ȭ��ȣ</th>
					<th scope="col">����</th>
					<th scope="col">����</th>
					<th scope="col">�μ�</th>
					<th scope="col">����</th>
					<th scope="col">����/����</th>
				</tr>
			</thead>
			<tbody>
<?
	// *** �Խù� ����Ʈ ***
	$qry  = " SELECT idx, name, grade, tel, email, image_name, "; 
	$qry .= " organ_order, organ_code";
	$qry .= " FROM t_organ ";
	$qry .= " Where organ_code = '".$sel_organ_code."' ";
	$qry .= " ORDER BY organ_order DESC ";
	$qry .= " Limit $StartNum, $PostNum ";
	$mysql->ParseExec($qry);
	
	if($total > 0){

		if($pageIdx == 1) $num = $total;
		else $num = $total - ( $pageIdx -1 ) * $PostNum;

		while($mysql->FetchInto(&$col)){
?>
				<tr>
					<td><?=$num?></td>
					<td class="tal">
						<?=$col[name]?>
					</td>
					<td>
						<?=$col[tel]?>
					</td>
					<td><?=$col[grade]?></td>
					<td>
						<?=$col[email]?>
					</td>
					<td>

						<?
							if($col[organ_code] == "1"){
								echo "�濵������";
							}else if($col[organ_code] == "2"){
								echo "IT(����SW)�����";
							}else if($col[organ_code] == "3"){
								echo "CT(��ȭ������)�����";
							}else if($col[organ_code] == "4"){
								echo "����̵���";
							}else if($col[organ_code] == "5"){
								echo "�̷�����TF��";
							}
						?>
					</td>
					<td>
						<a href="<?=$pageUrl?>&page=/pages/admin/member/organOrderEdit.php&idx=<?=$col[idx]?>&order=<?=$col[organ_order]?>&mode=up&organ_code=<?=$col[organ_code]?>">��</a>
						<a href="<?=$pageUrl?>&page=/pages/admin/member/organOrderEdit.php&idx=<?=$col[idx]?>&order=<?=$col[organ_order]?>&mode=down&organ_code=<?=$col[organ_code]?>">��</a>
					</td>
					<td>
						<a href="<?= $pageUrl ?>&amp;page=/pages/admin/member/organWriteForm.php&amp;idx=<?= $col[idx] ?>&mode=edit" title="������ �����մϴ�.">
							<img src="/pages/admin/images/bbs/btn_modify.gif" alt="����"/>
						</a>

						<a href="javascript:imageWindowDelete('<?= $col[idx] ?>');" title="������ �����մϴ�.">
							<img src="/pages/admin/images/bbs/btn_delete.gif" alt="����"/>
						</a>

					</td>

				</tr>
<?
			$num--;
		}

	}else{
?>
				<tr>
					<td colspan="8">
						��ϵ� ���� ������ �����ϴ�.
					</td>
				</tr>
<?
	}	
?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="8">
						<!-- �⺻ paging -->
						<ul>
							<?=$pageList?>
						</ul>
					</td>
				</tr>
				<tr>
					<td colspan="8">
						<a href="<?=$pageUrl?>&page=/pages/admin/member/organWriteForm.php&sel_organ_code=<?=$sel_organ_code?>"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="���"/></a>
					</td>
				</tr>
			</a>
			</tfoot>
		</table>
<?
	$mysql->Disconnect();
?>