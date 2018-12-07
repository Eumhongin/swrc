<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();


	if($mode == "edit"){
	
			if($organ_idx == "") message_url("오류가 발생하였습니다.\\n\\n 관리자에게 문의하여 주시기 바랍니다.", $organ_idx."&page=/pages/pool/relationOrgan.php");

		$query = " SELECT * FROM t_relation_organ WHERE organ_idx = '$organ_idx' ";
		$mysql->ParseExec($query);
		$mysql->FetchInto(&$col);

		$organ_name = $col[organ_name];
		$organ_address = $col[organ_address];
		$organ_address_detail = $col[organ_address_detail];
		$organ_zip_code = $col[organ_zip_code];
		$organ_tel = $col[organ_tel];
		$organ_homepage = $col[organ_homepage];
		$organ_kind_idx = $col[organ_kind_idx];

	}else{
		$mode = "write";
	}

?>
<script type="text/javascript">document.domain = "dip.or.kr";</script>
<script type="text/javascript">
	function fncCheckSubmit(){
		
		var frm = document.formWritePool;

		if(frm.organ_name.value == ""){
			alert("기관명을 입력하여 주세요.");
			frm.organ_name.focus();
			return false;
		}

		if(frm.organ_tel.value == ""){
			alert("전화번호를 입력하여 주세요.");
			frm.organ_tel.focus();
			return false;
		}

		if(frm.organ_homepage.value == ""){
			alert("홈페이지를 입력하여 주세요.");
			frm.organ_homepage.focus();
			return false;
		}

		return true;
	}

	function fncDeletePool(){
		if(!confirm("정말 삭제 하시겠습니까?")){
			return;
		}
		location.href="<?=$pageUrl?>&page=/pages/admin/pool/relationOrganWrite.php&mode=delete&organ_idx=<?=$organ_idx?>";
	}

</script>
		<table width="100%" height="26" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> 유관기관 관리 폼</td>
			</tr>
		</table>
		<form name="formWritePool" method="post" action="<?=$pageUrl?>&page=/pages/admin/pool/relationOrganWrite.php" onsubmit="return fncCheckSubmit();" >
		<input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
		<input type="hidden" name="organ_idx" id="organ_idx" value="<?=$organ_idx?>" />

		<table class="bbsCont" cellspacing="0" summary="유관기관 등록을 하는 표">
			<caption class="none">유관기관 등록</caption>
			<colgroup>
				<col width="20%" />
				<col width="60%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="fir">유관기관 등록</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row" class="fir">
						<label for="organ_name">기관명</label> <span class="f_orange">*</span>
					</th>
					<td class="tal"><input type="text" name="organ_name" id="organ_name" value="<?=$organ_name?>" size="20"  class="basic"/></td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="organ_tel">전화번호</label> <span class="f_orange">*</span>
					</th>
					<td class="tal"><input type="text" name="organ_tel" id="organ_tel" value="<?=$organ_tel?>" size="20"  class="basic"/></td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="organ_homepage">홈페이지</label> <span class="f_orange">*</span>
					</th>
					<td colspan="2" class="tal">
						<input type="text" id="organ_homepage" name="organ_homepage" size="40" class="basic" value="<?=$organ_homepage?>"/>
						<span class="f_11 pad_l10">http:// 를 꼭 붙여주시기 바랍니다. (ex : http://www.dip.or.kr)</span>
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="pool_tel">기관 분류</label> <span class="f_orange">*</span>
					</th>
					<td colspan="2" class="tal">
<?
	$kindQuery  = " Select * from t_relation_organ_kind ";
	$kindQuery .= " Order by idx ";

	$mysql->ParseExec($kindQuery);
?>						
					<select name="selectOrganKind">
							<option value="0" <?if($organ_kind_idx == "0"){?>selected<?}?>>분류없음</option>
						<?while($mysql->FetchInto(&$kindCol)){?>
							<option value="<?=$kindCol[idx]?>" <?if($organ_kind_idx == $kindCol[idx]){?>selected<?}?> ><?=$kindCol[kind_name]?></option>
						<?}?>
					</select>
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						근무지 주소
					</th>
					<td colspan="2" class="tal">
						<input type="text" id="pool_zip_code" name="pool_zip_code" class="basic" readonly title="우편번호" value="<?=$organ_zip_code?>" />
						
						<a href="/pages/pool/zipcode.php" target="displayWindow" onclick="childwin=window.open('','displayWindow','toolbar=no,scrollbars=no,width=460,height=455,top=30,left=30'); childwin.focus();">
							<img src="/images/member/btn_check_post.gif" alt="우편번호 찾기" />
						</a>
						<br/>
						<input type="text" id="pool_address" name="pool_address" size="60" class="basic" title="기본 주소" readonly value="<?=$organ_address?>"/>
						<br/>
						<input type="text" id="pool_address_detail" name="pool_address_detail" size="30" class="basic" title="나머지 주소" value="<?=$organ_address_detail?>"/>
						<span class="f_11 pad_l10">나머지 주소를 입력하세요.</span>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" class="fir">
						<input type="image" src="/pages/admin/images/bbs/btn_write_big.gif" alt="유관기관 등록" />
						<a href="#" onclick="javascript:fncDeletePool();">
							<img src="/pages/admin/images/bbs/btn_delete_big.gif" />
						</a>
						<a href="<?=$pageUrl?>&page=/pages/admin/pool/relationOrgan.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="취소" /></a>
					</td>
				</tr>
			</tfoot>
		</table>
</form>
<?	
	$mysql->Disconnect();
?>