<?
	// *** ����¡ class ***
	include ("../../config/page_manager_admin.php");
	include ("../../config/mysql.inc.php");

	$pageIdx = $_REQUEST["pageIdx"];
	$idx = $_REQUEST["idx"];

	$pageParameter = $pageUrl.$pageName."&page=".$page;
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();


	// *** �� �Խù� �� ***
	$total_qry  = " SELECT idx ";
	$total_qry .= " FROM t_image_window WHERE 1 = 1 ";
	$mysql->ParseExec($total_qry);
	$total = $mysql->RowCount();

	$PostNum = 10;
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
			document.location.href="<?= $pageUrl ?>&page=/pages/admin/imageWindow/imageWindowWrite.php&idx=" + idx +"&mode=delete";
		}
	}
</script>
	<!-- ���� -->
		<p class="contTitle">�˻��� �Խù� : <?=$total?>��</p>
		<table class="bbsCont" cellspacing="0" summary="�˸�â ��� ����">
			<colgroup>
				<col width="8%"/>
				<col width="20%"/>
				<col />
				<col width="10%"/>
				<col width="8%"/>
				<col width="8%"/>
				<col width="10%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">��ȣ</th>
					<th scope="col">�̹���</th>
					<th scope="col">����</th>
					<th scope="col">�����</th>
					<th scope="col">��뿩��</th>
					<th scope="col">����</th>
					<th scope="col">����/����</th>
				</tr>
			</thead>
			<tbody>
<?
	// *** �Խù� ����Ʈ ***
	$qry  = " SELECT idx, image_name, image_alt, image_link, image_target, window_name, "; 
	$qry .= " date_format(image_regist_date, '%Y/%m/%d') AS image_regist_date, image_use_flag, image_order  ";
	$qry .= " FROM t_image_window ";
	$qry .= " ORDER BY image_order DESC ";
	$qry .= " Limit $StartNum, $PostNum ";
	$mysql->ParseExec($qry);
	
	if($total > 0){

		if($pageIdx == 1) $num = $total;
		else $num = $total - ( $pageIdx -1 ) * $PostNum;

		while($mysql->FetchInto(&$col)){
?>
				<tr>
					<td><?=$num?></td>
					<td>
						<img src="/up_file/imageWindow/<?=utf8ToEuckr($col[image_name])?>" width="150" height="90" />
					</td>
					<td class="tal">
						<?=utf8ToEuckr($col[window_name])?>
					</td>
					<td><?=$col[image_regist_date]?></td>
					<td>
						<?if($col[image_use_flag] == "Y"){?>
							�����
						<?}else{?>
							����
						<?}?>
					</td>
					<td>
						<a href="<?=$pageUrl?>&page=/pages/admin/imageWindow/imageWindowOrderEdit.php&idx=<?=$col[idx]?>&order=<?=$col[image_order]?>&mode=up">��</a>
						<a href="<?=$pageUrl?>&page=/pages/admin/imageWindow/imageWindowOrderEdit.php&idx=<?=$col[idx]?>&order=<?=$col[image_order]?>&mode=down">��</a>
					</td>
					<td>
						<a href="<?= $pageUrl ?>&amp;page=/pages/admin/imageWindow/imageWindowWriteForm.php&amp;idx=<?= $col[idx] ?>&mode=edit" title="�˸�â�� �����մϴ�.">
							<img src="/pages/admin/images/bbs/btn_modify.gif" alt="����"/>
						</a>

						<a href="javascript:imageWindowDelete('<?= $col[idx] ?>');" title="�˸�â�� �����մϴ�.">
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
					<td colspan="7">
						��ϵ� �˸�â�� �����ϴ�.
					</td>
				</tr>
<?
	}	
?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="7">
						<!-- �⺻ paging -->
						<ul>
							<?=$pageList?>
						</ul>
					</td>
				</tr>
				<tr>
					<td colspan="7">
						<a href="<?=$pageUrl?>&page=/pages/admin/imageWindow/imageWindowWriteForm.php"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="���"/></a>
					</td>
				</tr>
			</a>
			</tfoot>
		</table>
<?
	$mysql->Disconnect();
?>