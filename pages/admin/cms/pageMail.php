<?
	include ("../../config/mysql.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();


	//입력 모드일경우
	if($mode == "write"){
		//$querySelect = " Select * from t_page_mail Where mail_address = '".$mail_address."' ";
		//$mysql->ParseExec($querySelect);

		//if($mysql->RowCount() < 1){ //동일한 이름의 유관 기관이 없을경우만 Insert

			$query  = " Insert into t_page_mail ( ";
			$query .= " use_page, ";
			$query .= " mail_address ";
			$query .= " ) Values ( ";
			$query .= " '".$use_page."', ";
			$query .= " '".$mail_address."' ";
			$query .= " ) ";

			$mysql->ParseExec($query);
		//}
	}else if($mode == "edit"){

		$query  = " Update t_page_mail Set ";
		$query .= " mail_address = '".$mail_address."' ";
		$query .= " Where idx = '".$mail_idx."' ";

		$mysql->ParseExec($query);

	}

	// *** 총 게시물 수 ***
	$total_qry  = " SELECT idx ";
	$total_qry .= " FROM t_page_mail ";
	$mysql->ParseExec($total_qry);
	$total = $mysql->RowCount();

?>	

	<script type="text/javascript">

		function fncModifyKind(kindIdx){
			
			if(document.getElementById("mail_address"+kindIdx).value == ""){
				alert("메일주소를 입력하여 주세요.");
				document.getElementById("mail_address"+kindIdx).focus();
				return;
			}

			document.formEMailKind.mail_idx.value = kindIdx;
			document.formEMailKind.mode.value = "edit";
			document.formEMailKind.mail_address.value = document.getElementById("mail_address"+kindIdx).value;

			document.formEMailKind.submit();

		}

	</script>

	<!-- 내용 -->
		<table width="100%" class="bbsCont" cellspacing="1" summary="메일주소 목록 보기">
		<form name="formEMailKind" method="post">
		<input type="hidden" name="mode" id="mode" />
		<input type="hidden" name="mail_idx" id="mail_idx" />
		<input type="hidden" name="mail_address" id="mail_address" />
			<colgroup>
				<col width="10%"/>
				<col width="30%"/>
				<col />
				<col width="15%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">사용 페이지</th>
					<th scope="col">메일주소</th>
					<th scope="col">버튼</th>
				</tr>
			</thead>
			<tbody>
				<!--<tr>
					<td class="acenter"> - </td>
					<td> <input type="text" name="use_page" id="use_page" class="basic" size="40"> </td>
					<td> <input type="text" name="mail_address" id="mail_address" class="basic" size="60"> </td>
					<td class="acenter">
						<a href="#" onclick="javascript:fncInsertKind();">
							<img src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록"/> 
						</a>
					</td>
				</tr>-->
<?
	// *** 게시물 리스트 ***
	$qry  = " SELECT idx, mail_address, use_page  "; 
	$qry .= " FROM t_page_mail ";
	$qry .= " ORDER BY idx DESC ";
	$mysql->ParseExec($qry);
	
	if($total > 0){

		$num = $total;

		while($mysql->FetchInto(&$col)){
?>
				<tr>
					<td class="acenter"><?=$col[idx]?></td>
					<td class="pad_l10">
						<?=$col[use_page]?>
					</td>
					<td class="pad_l10">
						<input type="text" name="mail_address<?=$col[idx]?>" id="mail_address<?=$col[idx]?>" value="<?=$col[mail_address]?>" class="basic" size="68" />
					</td>
					<td class="acenter">
						<a href="#" onclick="javascript:fncModifyKind('<?=$col[idx]?>');" >
							<img src="/pages/admin/images/bbs/btn_modify.gif" alt="수정" />
						</a>
					</td>
				</tr>
<?
			$num--;
		}

	}
?>
		
			</tbody>
			<tfoot>
				<tr>
					<td height="40" colspan="4" align="center">
						<a href="<?=$pageUrl?>&page=/pages/admin/cms/pageMail.php"><img src="/pages/admin/images/bbs/btn_list_big.gif" alt="목록"/></a>
					</td>
				</tr>
			</tfoot>
		</form>
		</table>
<?
	$mysql->Disconnect();
?>