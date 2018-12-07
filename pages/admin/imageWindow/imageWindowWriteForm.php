<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$mode = $_REQUEST["mode"];
	$idx = $_REQUEST["idx"];


	if($mode == "edit"){
	
			if($idx == "") message_url("오류가 발생하였습니다.\\n\\n 관리자에게 문의하여 주시기 바랍니다.", $pageUrl."&page=/pages/admin/imageWindow/imageWindowList.php");

		$query = " SELECT * FROM t_image_window WHERE idx = '$idx' ";
		$mysql->ParseExec($query);
		$mysql->FetchInto(&$col);

		$image_name = $col[image_name];
		$image_alt = $col[image_alt];
		$image_link = $col[image_link];
		$image_regist_date = $col[image_regist_date];
		$image_use_flag = $col[image_use_flag];
		$image_order = $col[image_order];
		$window_name = $col[window_name];

	}else{
		$mode = "write";
	}

	$mysql->Disconnect();

?>
<script type="text/javascript">document.domain = "dip.or.kr";</script>
<script type="text/javascript">
	function fncCheckSubmit(){
		
		var frm = document.formWriteImageWindow;

		if(frm.window_name.value == ""){
			alert("제목을 입력하여 주세요.");
			frm.window_name.focus();
			return false;
		}

		if(frm.image_alt.value == ""){
			alert("설명을 입력하여 주세요.");
			frm.image_alt.focus();
			return false;
		}

		if(frm.image_link.value == ""){
			alert("링크주소를 입력하여 주세요.");
			frm.image_link.focus();
			return false;
		}

		return true;
	}
</script>

		<p class="contTitle">알리창 관리 폼</p>

		<form name="formWriteImageWindow" method="post" enctype="multipart/form-data" action="<?=$pageUrl?>&page=/pages/admin/imageWindow/imageWindowWrite.php" onsubmit="return fncCheckSubmit();" >
		<input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
		<input type="hidden" name="idx" id="idx" value="<?=$idx?>" />

		<table class="bbsCont" cellspacing="0" summary="알리창 등록을 하는 표">
			<caption class="none">알리창 등록</caption>
			<colgroup>
				<col width="20%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="2">알리창 등록</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">제목</th>
					<td class="tal"><input type="text" id="window_name" name="window_name" size="80" class="basic" value="<?=utf8ToEuckr($window_name)?>">
					</td>
				</tr>
				<tr>
					<th scope="row">이미지</th>
					<td class="tal">
						<input type="file" id="window_image" name="window_image" size="40" class="basic" />
						<?=utf8ToEuckr($image_name)?>
					</td>
				</tr>
				<tr>
					<th scope="row">이미지 설명</th>
					<td class="tal"><input type="text" id="image_alt" name="image_alt" size="80" class="basic" value="<?=utf8ToEuckr($image_alt)?>">
					</td>
				</tr>
				<tr>
					<th scope="row">링크주소</th>
					<td class="tal"><input type="text" id="image_link" name="image_link" size="80" class="basic" value="<?=$image_link?>">
					</td>
				</tr>
				<tr>
					<th scope="row">target</th>
					<td class="tal">
						<select name="image_target">
							<option value="_self" <?if($image_target == "_self"){?>selected<?}?>>_self</option>
							<option value="_parent" <?if($image_target == "_parent"){?>selected<?}?>>_parent</option>
							<option value="_top" <?if($image_target == "_top"){?>selected<?}?>>_top</option>
							<option value="_blank" <?if($image_target == "_blank"){?>selected<?}?>>_blank</option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row">사용여부</th>
					<td class="tal">
						<input type="radio" name="image_use_flag" value="Y" <?if($image_use_flag == "Y"){?>checked<?}?>> 사용
						<input type="radio" name="image_use_flag" value="N" <?if($image_use_flag != "Y"){?>checked<?}?>> 사용안함
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">
						<input type="image" src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록" />
						<a href="<?=$pageUrl?>&page=/pages/admin/imageWindow/imageWindowList.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="취소" /></a>
					</td>
				</tr>
			</tfoot>
		</table>
</form>