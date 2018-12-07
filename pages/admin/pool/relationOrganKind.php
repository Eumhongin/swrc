<?
	// *** 페이징 class ***
	include ("../../config/page_manager_admin.php");
	include ("../../config/mysql.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();


	//입력 모드일경우
	if($mode == "write"){
		$querySelect = " Select * from t_relation_organ_kind Where kind_name = '".$kind_name."' ";
		$mysql->ParseExec($querySelect);

		if($mysql->RowCount() < 1){ //동일한 이름의 유관 기관이 없을경우만 Insert

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

	// *** 총 게시물 수 ***
	$total_qry  = " SELECT idx ";
	$total_qry .= " FROM t_relation_organ_kind ";
	$mysql->ParseExec($total_qry);
	$total = $mysql->RowCount();

?>	
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
		<title>유관기관 종류</title>

	<script type="text/javascript">
		function fncInsertKind(){
			
			if(document.formOrganKind.kind_name.value == ""){
				alert("기관명을 입력하여 주세요.");
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
			if(!confirm("정말 삭제 하시겠습니까?")){
				return
			}
			document.formOrganKind.organ_idx.value = kindIdx;
			document.formOrganKind.mode.value = "delete";

			document.formOrganKind.submit();

		}
	</script>

	</head>
	<body>
	<!-- 내용 -->
		<form name="formOrganKind" method="post">
		<input type="hidden" name="mode" id="mode" />
		<input type="hidden" name="organ_idx" id="organ_idx" />
		<table width="100%" height="26" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<img src="/pages/admin/images/common/bullet_box_gray.gif"> 검색된 게시물 : <?=$total?>개
				</td>
			</tr>
		</table>
		<table width="100%" class="bbsCont" cellspacing="1" summary="유관기관 목록 보기">
			<colgroup>
				<col width="10%"/>
				<col />
				<col width="10%"/>
				<col width="14%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">기관명</th>
					<th scope="col">등록일</th>
					<th scope="col">버튼</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="acenter"> - </td>
					<td colspan="2"> <input type="text" name="kind_name" id="kind_name" class="basic" size="100"> </td>
					<td class="acenter">
						<a href="#" onclick="javascript:fncInsertKind();">
							<img src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록"/> </td>
						</a>
				</tr>
<?
	// *** 게시물 리스트 ***
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
							<img src="/pages/admin/images/bbs/btn_modify.gif" alt="수정" />
						</a>
						<a href="#" onclick="javascript:fncDeleteKind('<?=$col[idx]?>');" >
							<img src="/pages/admin/images/bbs/btn_delete.gif" alt="삭제" />
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
						등록된 유관기관이 없습니다.
					</td>
				</tr>
<?
	}	
?>
			</tbody>
			<tfoot>
				<tr>
					<td height="40" colspan="6" align="center">
						<a href="<?=$pageUrl?>&page=/pages/admin/pool/relationOrgan.php"><img src="/pages/admin/images/bbs/btn_list_big.gif" alt="목록"/></a>
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