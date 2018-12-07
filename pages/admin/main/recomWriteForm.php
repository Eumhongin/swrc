<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$recom_chk = $_REQUEST["recom_chk"];
	$mode = $_REQUEST["mode"];
	

	if($mode == "edit"){
				
		$qry  = " SELECT recom_url, recom_img_name, recom_chk, "; 
		$qry .= " recom_img_explain, recom_img_title, date_format(regdate, '%Y/%m/%d') AS regdate ";
		$qry .= " FROM recom_img ";

		$query = " SELECT * FROM recom_img WHERE recom_chk = '$recom_chk' ";
		$mysql->ParseExec($query);
		$mysql->FetchInto(&$col);

		$recom_url = $col[recom_url];
		$recom_img_title = $col[recom_img_title];
		$recom_img_name = $col[recom_img_name];
		$recom_chk = $col[recom_chk];
		$recom_img_explain = $col[recom_img_explain];
		$regdate = $col[regdate];

	}else{
		$mode = "write";
	}

	
	$mysql->Disconnect();

?>

<script type="text/javascript">
	function fncCheckSubmit(){
		
		var frm = document.formWritePool;

		if(frm.recom_img_title.value == ""){
			alert("이미지제목을 입력하여 주세요.");
			frm.recom_img_title.focus();
			return false;
		}

		if(frm.recom_img_explain.value == ""){
			alert("이미지설명을 입력하여 주세요.");
			frm.recom_img_explain.focus();
			return false;
		}

		if(frm.recom_url.value == ""){
			alert("URL을 입력하여 주세요.");
			frm.recom_url.focus();
			return false;
		}

/*
		if(frm.recom_img_name.value == ""){
			alert("이미지를 등록하여 주세요.");
			frm.recom_img_name.focus();
			return false;
		}
*/

		return true;
	}
</script>

		<table width="100%" height="26" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> 추천학교 등록 폼</td>
			</tr>
		</table>
		<form name="formWritePool" method="post" enctype="multipart/form-data" action="<?=$pageUrl?>&page=/pages/admin/main/recomWrite.php" onsubmit="return fncCheckSubmit();" >
		<input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
		<input type="hidden" name="recom_chk" id="recom_chk" value="<?=$recom_chk?>" />

		<table class="bbsCont" cellspacing="0">
			<colgroup>
				<col width="20%" />
				<col width="60%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="fir">추천학교 등록</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row" class="fir">
						<label for="recom_img_title">이미지제목</label> <span class="f_orange">*</span>
					</th>
					<td class="tal"><input type="text" name="recom_img_title" id="recom_img_title" value="<?=$recom_img_title?>" size="20"  class="basic"/></td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="recom_img_explain">이미지설명</label> <span class="f_orange">*</span>
					</th>
					<td class="tal"><input type="text" name="recom_img_explain" id="recom_img_explain" value="<?=$recom_img_explain?>" size="80"  class="basic"/></td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="recom_url">URL</label> <span class="f_orange">*</span>
					</th>
					<td class="tal"><input type="text" name="recom_url" id="recom_url" value="<?=$recom_url?>" size="20"  class="basic"/></td>
				</tr>

				<tr>
					<th scope="row" class="fir">
						<label for="recom_img_name">이미지</label> <span class="f_orange">*</span>
					</th>
					<td class="tal"><input type="file" name="recom_img_name" id="recom_img_name" value="" size="20"  class="basic"/><?=$recom_img_name?></td>
				</tr>
				<!--
				<tr>
					<th scope="row" class="fir">
						위치<span class="f_orange">*</span>
					</th>
					<td class="tal">
						왼쪽: <input type="radio" name="recom_chk" value="L" checked>
						오른쪽: <input type="radio" name="recom_chk" value="R" <? if($recom_chk == "R"){?>checked<?}?>>
					</td>
				</tr>
			-->


			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" class="fir">
						<input type="image" src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록" />
						<?if($mode == "edit"){?>
							<a href="<?=$pageUrl?>&page=/pages/admin/main/main.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="취소" /></a>
						<?}else{?>
							<a href="<?=$pageUrl?>&page=/pages/admin/main/main.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="취소" /></a>
						<?}?>
					</td>
				</tr>
			</tfoot>
		</table>
</form>