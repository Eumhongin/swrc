<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	if($mode == "edit"){
	
			if($idx == "") message_url("오류가 발생하였습니다.\\n\\n 관리자에게 문의하여 주시기 바랍니다.", $pageUrl."&page=/pages/admin/member/organ.php");

		$query = " SELECT * FROM t_organ WHERE idx = '$idx' ";
		$mysql->ParseExec($query);
		$mysql->FetchInto(&$col);

		$name = $col[name];
		$grade = $col[grade];
		$tel = $col[tel];
		$email = $col[email];
		$image_name = $col[image_name];
		$organ_order = $col[organ_order];
		$organ_code = $col[organ_code];

	}else{
		$mode = "write";
		$organ_code = $sel_organ_code;
	}

	$mysql->Disconnect();

?>
<script type="text/javascript">document.domain = "dip.or.kr";</script>
<script type="text/javascript">
	function fncCheckSubmit(){
		
		var frm = document.formWriteOrgan;

		if(frm.name.value == ""){
			alert("이름을 입력하여 주세요.");
			frm.name.focus();
			return false;
		}

		if(frm.grade.value == ""){
			alert("직위를 입력하여 주세요.");
			frm.grade.focus();
			return false;
		}

		if(frm.email.value == ""){
			alert("이메일을 입력하여 주세요.");
			frm.email.focus();
			return false;
		}

		return true;
	}
</script>

		<p class="contTitle">조직 관리 폼</p>

		<form name="formWriteOrgan" method="post" enctype="multipart/form-data" action="<?=$pageUrl?>&page=/pages/admin/member/organWrite.php" onsubmit="return fncCheckSubmit();" >
		<input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
		<input type="hidden" name="idx" id="idx" value="<?=$idx?>" />

		<table class="bbsCont" cellspacing="0" summary="조직 등록을 하는 표">
			<caption class="none">조직 등록</caption>
			<colgroup>
				<col width="20%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="2">조직 등록</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">이름</th>
					<td class="tal"><input type="text" id="name" name="name" size="60" class="basic" value="<?=$name?>">
					</td>
				</tr>
				<tr>
					<th scope="row">직위</th>
					<td class="tal"><input type="text" id="grade" name="grade" size="60" class="basic" value="<?=$grade?>">
					</td>
				</tr>
				<tr>
					<th scope="row">전화번호</th>
					<td class="tal"><input type="text" id="tel" name="tel" size="60" class="basic" value="<?=$tel?>">
					 전화번호는 '053-123-4567' 과 같이 입력해주세요.
					</td>
				</tr>
				<tr>
					<th scope="row">이메일</th>
					<td class="tal"><input type="text" id="email" name="email" size="60" class="basic" value="<?=$email?>">
					</td>
				</tr>
				<tr>
					<th scope="row">사진</th>
					<td class="tal">
						<input type="file" id="image_name" name="image_name" size="40" class="basic" />
						<?=$image_name?>
					</td>
				</tr>
				<tr>
					<th scope="row">부서</th>
					<td class="tal">
						<select name="organ_code">
							<option value="1" <?if($sel_organ_code == "1" || $organ_code == "1"){?>selected<?}?> >경영지원실</option>
							<option value="2" <?if($sel_organ_code == "2" || $organ_code == "2"){?>selected<?}?> >IT(융합SW)사업부</option>
							<option value="3" <?if($sel_organ_code == "3" || $organ_code == "3"){?>selected<?}?> >CT(문화콘텐츠)사업부</option>
							<option value="4" <?if($sel_organ_code == "4" || $organ_code == "4"){?>selected<?}?> >영상미디어센터장</option>
							<option value="5" <?if($sel_organ_code == "5" || $organ_code == "5"){?>selected<?}?> >미래전략TF팀</option>
						</select>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">
						<input type="image" src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록" />
						<a href="<?=$pageUrl?>&page=/pages/admin/member/organ.php&sel_organ_code=<?=$organ_code?>"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="취소" /></a>
					</td>
				</tr>
			</tfoot>
		</table>
</form>