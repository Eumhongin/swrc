<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	if($mode == "edit"){
	
			if($idx == "") message_url("������ �߻��Ͽ����ϴ�.\\n\\n �����ڿ��� �����Ͽ� �ֽñ� �ٶ��ϴ�.", $pageUrl."&page=/pages/admin/member/organ.php");

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
			alert("�̸��� �Է��Ͽ� �ּ���.");
			frm.name.focus();
			return false;
		}

		if(frm.grade.value == ""){
			alert("������ �Է��Ͽ� �ּ���.");
			frm.grade.focus();
			return false;
		}

		if(frm.email.value == ""){
			alert("�̸����� �Է��Ͽ� �ּ���.");
			frm.email.focus();
			return false;
		}

		return true;
	}
</script>

		<p class="contTitle">���� ���� ��</p>

		<form name="formWriteOrgan" method="post" enctype="multipart/form-data" action="<?=$pageUrl?>&page=/pages/admin/member/organWrite.php" onsubmit="return fncCheckSubmit();" >
		<input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
		<input type="hidden" name="idx" id="idx" value="<?=$idx?>" />

		<table class="bbsCont" cellspacing="0" summary="���� ����� �ϴ� ǥ">
			<caption class="none">���� ���</caption>
			<colgroup>
				<col width="20%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="2">���� ���</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">�̸�</th>
					<td class="tal"><input type="text" id="name" name="name" size="60" class="basic" value="<?=$name?>">
					</td>
				</tr>
				<tr>
					<th scope="row">����</th>
					<td class="tal"><input type="text" id="grade" name="grade" size="60" class="basic" value="<?=$grade?>">
					</td>
				</tr>
				<tr>
					<th scope="row">��ȭ��ȣ</th>
					<td class="tal"><input type="text" id="tel" name="tel" size="60" class="basic" value="<?=$tel?>">
					 ��ȭ��ȣ�� '053-123-4567' �� ���� �Է����ּ���.
					</td>
				</tr>
				<tr>
					<th scope="row">�̸���</th>
					<td class="tal"><input type="text" id="email" name="email" size="60" class="basic" value="<?=$email?>">
					</td>
				</tr>
				<tr>
					<th scope="row">����</th>
					<td class="tal">
						<input type="file" id="image_name" name="image_name" size="40" class="basic" />
						<?=$image_name?>
					</td>
				</tr>
				<tr>
					<th scope="row">�μ�</th>
					<td class="tal">
						<select name="organ_code">
							<option value="1" <?if($sel_organ_code == "1" || $organ_code == "1"){?>selected<?}?> >�濵������</option>
							<option value="2" <?if($sel_organ_code == "2" || $organ_code == "2"){?>selected<?}?> >IT(����SW)�����</option>
							<option value="3" <?if($sel_organ_code == "3" || $organ_code == "3"){?>selected<?}?> >CT(��ȭ������)�����</option>
							<option value="4" <?if($sel_organ_code == "4" || $organ_code == "4"){?>selected<?}?> >����̵�����</option>
							<option value="5" <?if($sel_organ_code == "5" || $organ_code == "5"){?>selected<?}?> >�̷�����TF��</option>
						</select>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">
						<input type="image" src="/pages/admin/images/bbs/btn_write_big.gif" alt="���" />
						<a href="<?=$pageUrl?>&page=/pages/admin/member/organ.php&sel_organ_code=<?=$organ_code?>"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="���" /></a>
					</td>
				</tr>
			</tfoot>
		</table>
</form>