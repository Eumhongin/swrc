<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$mode = $_REQUEST["mode"];
	$idx = $_REQUEST["idx"];


	if($mode == "edit"){
	
			if($idx == "") message_url("������ �߻��Ͽ����ϴ�.\\n\\n �����ڿ��� �����Ͽ� �ֽñ� �ٶ��ϴ�.", $pageUrl."&page=/pages/admin/imageWindow/imageWindowList.php");

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
			alert("������ �Է��Ͽ� �ּ���.");
			frm.window_name.focus();
			return false;
		}

		if(frm.image_alt.value == ""){
			alert("������ �Է��Ͽ� �ּ���.");
			frm.image_alt.focus();
			return false;
		}

		if(frm.image_link.value == ""){
			alert("��ũ�ּҸ� �Է��Ͽ� �ּ���.");
			frm.image_link.focus();
			return false;
		}

		return true;
	}
</script>

		<p class="contTitle">�˸�â ���� ��</p>

		<form name="formWriteImageWindow" method="post" enctype="multipart/form-data" action="<?=$pageUrl?>&page=/pages/admin/imageWindow/imageWindowWrite.php" onsubmit="return fncCheckSubmit();" >
		<input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
		<input type="hidden" name="idx" id="idx" value="<?=$idx?>" />

		<table class="bbsCont" cellspacing="0" summary="�˸�â ����� �ϴ� ǥ">
			<caption class="none">�˸�â ���</caption>
			<colgroup>
				<col width="20%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="2">�˸�â ���</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">����</th>
					<td class="tal"><input type="text" id="window_name" name="window_name" size="80" class="basic" value="<?=utf8ToEuckr($window_name)?>">
					</td>
				</tr>
				<tr>
					<th scope="row">�̹���</th>
					<td class="tal">
						<input type="file" id="window_image" name="window_image" size="40" class="basic" />
						<?=utf8ToEuckr($image_name)?>
					</td>
				</tr>
				<tr>
					<th scope="row">�̹��� ����</th>
					<td class="tal"><input type="text" id="image_alt" name="image_alt" size="80" class="basic" value="<?=utf8ToEuckr($image_alt)?>">
					</td>
				</tr>
				<tr>
					<th scope="row">��ũ�ּ�</th>
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
					<th scope="row">��뿩��</th>
					<td class="tal">
						<input type="radio" name="image_use_flag" value="Y" <?if($image_use_flag == "Y"){?>checked<?}?>> ���
						<input type="radio" name="image_use_flag" value="N" <?if($image_use_flag != "Y"){?>checked<?}?>> ������
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">
						<input type="image" src="/pages/admin/images/bbs/btn_write_big.gif" alt="���" />
						<a href="<?=$pageUrl?>&page=/pages/admin/imageWindow/imageWindowList.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="���" /></a>
					</td>
				</tr>
			</tfoot>
		</table>
</form>