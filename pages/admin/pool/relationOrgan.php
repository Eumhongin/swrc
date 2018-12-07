<?
	// *** ����¡ class ***
	include ("../../config/page_manager_admin.php");
	include ("../../config/mysql.inc.php");

	$pageParameter = $pageUrl.$pageName."&page=".$page;
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	// ** �˻���
	if(!empty($searchKeyWord)){
		$searchQry = " AND ".$searchCol." like '%$searchKeyWord%' ";
	}

	if($selectOrganKind != ""){
		$selectOrganQuery = " AND organ_kind_idx = '$selectOrganKind' ";
	}else{
		$selectOrganQuery = "  ";
	}

	// *** �� �Խù� �� ***
	$total_qry  = " SELECT organ_idx ";
	$total_qry .= " FROM t_relation_organ AS A ";
	$total_qry .= " WHERE 1 = 1 ";
	$total_qry .= $searchQry;
	$total_qry .= $selectOrganQuery;
	$mysql->ParseExec($total_qry);
	$total = $mysql->RowCount();

	$PostNum = 10;
	$a_pagesu = 10;

	// *** �Խù� ��, ������ �� ***
	if(empty($pageIdx)) $pageIdx = 1;

	$StartNum = ( $pageIdx - 1 ) * $PostNum;

	// *** ����¡ ***
	$pg = new initPage($pageIdx, $PostNum);
	$pageList = $pg->getPageList($pageParameter, "searchKeyWord=$searchKeyWord&amp;searchCol=$searchCol", $total, $a_pagesu);	

?>	
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
		<title>�������</title>
	<script type="text/javascript">
		function fncChengeSelect(){
			document.search_frm.submit(); 
		}
	</script>
	</head>
	<body>
	
	<!-- ���� -->
		<form name="search_frm" method="post">
		<table width="100%" height="26" cellpadding="0" cellspacing="0">
		  <tr>
			<td>
<?
	$kindQuery  = " Select * from t_relation_organ_kind ";
	$kindQuery .= " Order by idx ";

	$mysql->ParseExec($kindQuery);
?>
			    ���� ��ϵ� ��� �з� : 
				<select name="selectOrganKind" onchange="fncChengeSelect();">
					<option value="">��ü����</option>
					<option value="0" <?if($selectOrganKind == "0"){?>selected<?}?>>�з�����</option>
					<?while($mysql->FetchInto(&$kindCol)){?>
						<option value="<?=$kindCol[idx]?>" <?if($selectOrganKind == $kindCol[idx]){?>selected<?}?> ><?=$kindCol[kind_name]?></option>
					<?}?>
				</select>
				&nbsp;&nbsp;&nbsp;
				<a href="<?=$pageUrl?>&page=/pages/admin/pool/relationOrganKind.php">
					<span class="f_orange bold">[�з� ���]</span>
				</a>
			</td>
			<td class="aright">
				<img src="/pages/admin/images/common/bullet_box_gray.gif"> �˻��� �Խù� : <?=$total?>��
			</td>
		  </tr>
		</table>
		<table class="bbsCont" cellspacing="0" summary="������� ��� ����">
			<colgroup>
				<col width="7%"/>
				<col />
				<col width="40%"/>
				<col width="13%"/>
				<col width="10%"/>
				<col width="10%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">��ȣ</th>
					<th scope="col">�����</th>
					<th scope="col">�ּ�</th>
					<th scope="col">��ȭ��ȣ</th>
					<th scope="col">Ȩ������</th>
					<th scope="col">�����</th>
				</tr>
			</thead>
			<tbody>
<?
	// *** �Խù� ����Ʈ ***
	$qry  = " SELECT organ_idx, organ_name, organ_zip_code, organ_address, organ_address_detail, "; 
	$qry .= " organ_tel, organ_homepage, organ_kind_idx, ";
	$qry .= " date_format(organ_date, '%Y/%m/%d') AS organ_date  ";
	$qry .= " FROM t_relation_organ ";
	$qry .= " WHERE 1 = 1 ";
	$qry .= $searchQry;
	$qry .= $selectOrganQuery;
	$qry .= " ORDER BY organ_idx DESC ";
	$qry .= " Limit $StartNum, $PostNum ";
	$mysql->ParseExec($qry);
	
	if($total > 0){

		if($pageIdx == 1) $num = $total;
		else $num = $total - ( $pageIdx -1 ) * $PostNum;

		while($mysql->FetchInto(&$col)){
?>
				<tr>
					<td class="fir"><?=$num?></td>
					<td class="tal">
						<a href="<?=$pageUrl?>&page=/pages/admin/pool/relationOrganWriteForm.php&mode=edit&organ_idx=<?=$col[organ_idx]?>">
							<font color="blue"><?=$col[organ_name]?></font>
						</a>
					</td>
					<td class="tal">
						<?=$col[organ_address]?> <?=$col[organ_address_detail]?> (<?=$col[organ_zip_code]?>)
					</td>
					<td><?=$col[organ_tel]?></td>
					<td><?=$col[organ_homepage]?></td>
					<td>
						<?=$col[organ_date]?>
					</td>
				</tr>
<?
			$num--;
		}

	}else{
?>
				<tr>
					<td colspan="6">
						��ϵ� ��������� �����ϴ�.
					</td>
				</tr>
<?
	}	
?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6">
						<!-- �⺻ paging -->
						<ul>
							<?=$pageList?>
						</ul>
					</td>
				</tr>
				<tr>
					<td colspan="6">
						<a href="<?=$pageUrl?>&page=/pages/admin/pool/relationOrganWriteForm.php"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="���"/></a>
					</td>
				</tr>
				<tr>
					<td colspan="6">
						
							<select name="searchCol" id="searchCol" title="�˻��з�">
								<option value="organ_name" <?if($searchCol == "organ_name"){?>selected<?}?>>�����</option>
								<option value="organ_address" <?if($searchCol == "organ_address"){?>selected<?}?>>�ּ�</option></option>
							</select>
							<input type="text" name="searchKeyWord" value="<?=$searchKeyWord?>" id="searchKeyWord" class="basic" title="�˻���" />
							<input type="image" src="/pages/admin/images/bbs/btn_search.gif" value="�˻�" alt="�˻�" class="vmiddle" />
					</td>
				</tr>
			</tfoot>
		</table>
		</form>
	</body>
</html>
<?
	$mysql->Disconnect();
?>