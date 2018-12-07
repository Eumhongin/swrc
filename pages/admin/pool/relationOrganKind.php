<?
	// *** ����¡ class ***
	include ("../../config/page_manager_admin.php");
	include ("../../config/mysql.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();


	//�Է� ����ϰ��
	if($mode == "write"){
		$querySelect = " Select * from t_relation_organ_kind Where kind_name = '".$kind_name."' ";
		$mysql->ParseExec($querySelect);

		if($mysql->RowCount() < 1){ //������ �̸��� ���� ����� ������츸 Insert

			$query  = " Insert into t_relation_organ_kind ( ";
			$query .= " kind_name, ";
			$query .= " regist_date ";
			$query .= " ) Values ( ";
			$query .= " '".$kind_name."', ";
			$query .= " now() ";
			$query .= " ) ";

			$mysql->ParseExec($query);
		}
	}else if($mode == "edit"){

		$query  = " Update t_relation_organ_kind Set ";
		$query .= " kind_name = '".$kind_name."' ";
		$query .= " Where idx = '".$organ_idx."' ";

		$mysql->ParseExec($query);

	}else if($mode == "delete"){
		
		$query  = " Delete From t_relation_organ_kind ";
		$query .= " Where idx = '".$organ_idx."' ";

		$mysql->ParseExec($query);

	}

	// *** �� �Խù� �� ***
	$total_qry  = " SELECT idx ";
	$total_qry .= " FROM t_relation_organ_kind ";
	$mysql->ParseExec($total_qry);
	$total = $mysql->RowCount();

?>	
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
		<title>������� ����</title>

	<script type="text/javascript">
		function fncInsertKind(){
			
			if(document.formOrganKind.kind_name.value == ""){
				alert("������� �Է��Ͽ� �ּ���.");
				document.formOrganKind.kind_name.focus();
				return;
			}
			
			if(document.formOrganKind.mode.value == ""){
				document.formOrganKind.mode.value = "write";
			}

			document.formOrganKind.submit();
		}

		function fncModifyKind(kindIdx, kindName){

			document.formOrganKind.organ_idx.value = kindIdx;
			document.formOrganKind.kind_name.value = kindName;
			document.formOrganKind.mode.value = "edit";

		}

		function fncDeleteKind(kindIdx){
			if(!confirm("���� ���� �Ͻðڽ��ϱ�?")){
				return
			}
			document.formOrganKind.organ_idx.value = kindIdx;
			document.formOrganKind.mode.value = "delete";

			document.formOrganKind.submit();

		}
	</script>

	</head>
	<body>
	<!-- ���� -->
		<form name="formOrganKind" method="post">
		<input type="hidden" name="mode" id="mode" />
		<input type="hidden" name="organ_idx" id="organ_idx" />
		<table width="100%" height="26" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<img src="/pages/admin/images/common/bullet_box_gray.gif"> �˻��� �Խù� : <?=$total?>��
				</td>
			</tr>
		</table>
		<table width="100%" class="bbsCont" cellspacing="1" summary="������� ��� ����">
			<colgroup>
				<col width="10%"/>
				<col />
				<col width="10%"/>
				<col width="14%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">��ȣ</th>
					<th scope="col">�����</th>
					<th scope="col">�����</th>
					<th scope="col">��ư</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="acenter"> - </td>
					<td colspan="2"> <input type="text" name="kind_name" id="kind_name" class="basic" size="100"> </td>
					<td class="acenter">
						<a href="#" onclick="javascript:fncInsertKind();">
							<img src="/pages/admin/images/bbs/btn_write_big.gif" alt="���"/> </td>
						</a>
				</tr>
<?
	// *** �Խù� ����Ʈ ***
	$qry  = " SELECT idx, kind_name,  "; 
	$qry .= " date_format(regist_date, '%Y/%m/%d') AS regist_date  ";
	$qry .= " FROM t_relation_organ_kind ";
	$qry .= " ORDER BY idx DESC ";
	$mysql->ParseExec($qry);
	
	if($total > 0){

		$num = $total;

		while($mysql->FetchInto(&$col)){
?>
				<tr>
					<td class="acenter"><?=$num?></td>
					<td class="pad_l10"><?=$col[kind_name]?> </td>
					<td class="acenter">
						<?=$col[regist_date]?>
					</td>
					<td class="acenter">
						<a href="#" onclick="javascript:fncModifyKind('<?=$col[idx]?>','<?=$col[kind_name]?>');" >
							<img src="/pages/admin/images/bbs/btn_modify.gif" alt="����" />
						</a>
						<a href="#" onclick="javascript:fncDeleteKind('<?=$col[idx]?>');" >
							<img src="/pages/admin/images/bbs/btn_delete.gif" alt="����" />
						</a>
					</td>
				</tr>
<?
			$num--;
		}

	}else{
?>
				<tr>
					<td colspan="4" class="acenter">
						��ϵ� ��������� �����ϴ�.
					</td>
				</tr>
<?
	}	
?>
			</tbody>
			<tfoot>
				<tr>
					<td height="40" colspan="6" align="center">
						<a href="<?=$pageUrl?>&page=/pages/admin/pool/relationOrgan.php"><img src="/pages/admin/images/bbs/btn_list_big.gif" alt="���"/></a>
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