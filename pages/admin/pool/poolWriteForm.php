<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();


	if($mode == "edit"){
	
			if($pool_idx == "") message_url("������ �߻��Ͽ����ϴ�.\\n\\n �����ڿ��� �����Ͽ� �ֽñ� �ٶ��ϴ�.", $pageUrl."&page=/pages/pool/pool.php");

		$query = " SELECT * FROM t_pool WHERE pool_idx = '$pool_idx' ";
		$mysql->ParseExec($query);
		$mysql->FetchInto(&$col);

		$pool_name = $col[pool_name];
		$pool_organ = $col[pool_organ];
		$pool_select_organ = $col[pool_select_organ];
		$pool_grade = $col[pool_grade];
		$pool_pass = $col[pool_pass];
		$pool_image = $col[pool_image];
		$pool_tel = $col[pool_tel];
		$pool_fax = $col[pool_fax];
		$pool_hp = $col[pool_hp];
		$pool_zip_code = $cop[pool_zip_code];
		$pool_address = $col[pool_address];
		$pool_address_detail = $col[pool_address_detail];
		$pool_email = $col[pool_email];
		$pool_major = $col[pool_major];
		$pool_career = $col[pool_career];
		$pool_resume = $col[pool_resume];
		$pool_idcard_forward = $col[pool_idcard_forward];
		$pool_idcard_backward = $col[pool_idcard_backward];
		$pool_bankbook = $col[pool_bankbook];
		$pool_request_date = $col[pool_request_date];
		$pool_approve_date = $col[pool_approve_date];
		$pool_approve_flag = $col[pool_approve_flag];
		$pool_user_id = $col[pool_user_id];

	}else{
		$mode = "write";
	}

	if($pool_approve_flag != ""){
		$approve_flag = $pool_approve_flag;
	}else{
		//������ ���� �ϰ�� �ٷ� ����.
		if($duchmember == 99){
			$approve_flag = "Y";
		}else{
			$approve_flag = "N";
		}
	}
	$mysql->Disconnect();

?>
<script type="text/javascript">document.domain = "dip.or.kr";</script>
<script type="text/javascript">
	function fncCheckSubmit(){
		
		var frm = document.formWritePool;

		if(frm.pool_name.value == ""){
			alert("�̸��� �Է��Ͽ� �ּ���.");
			frm.pool_name.focus();
			return false;
		}

		if(frm.pool_organ.value == ""){
			alert("�Ҽӱ���� �Է��Ͽ� �ּ���.");
			frm.pool_organ.focus();
			return false;
		}

		if(frm.pool_select_organ.options[frm.pool_select_organ.selectedIndex].value == ""){
			alert("�Ҽӱ���� �����Ͽ� �ּ���.");
			frm.pool_select_organ.focus();
			return false;
		}

		if(frm.pool_grade.value == ""){
			alert("������ �Է��Ͽ� �ּ���.");
			frm.pool_grade.focus();
			return false;
		}

		if(frm.pool_pass.value == ""){
			alert("��й�ȣ�� �Է��Ͽ� �ּ���.");
			frm.pool_pass.focus();
			return false;
		}
		if(frm.pool_pass_check.value == ""){
			alert("��й�ȣ Ȯ���� �Է��Ͽ� �ּ���.");
			frm.pool_pass_check.focus();
			return false;
		}

		if( frm.pool_pass.value != frm.pool_pass_check.value ){
			alert("��й�ȣ�� Ȯ���Ͽ� �ּ���.");
			frm.pool_pass.focus();
			return false;
		}

		if(frm.pool_tel.value == ""){
			alert("��ȭ��ȣ�� �Է��Ͽ� �ּ���.");
			frm.pool_tel.focus();
			return false;
		}

		if(frm.pool_email.value == ""){
			alert("E-mail�� �Է��Ͽ� �ּ���.");
			frm.pool_email.focus();
			return false;
		}

		if(frm.pool_major.value == ""){
			alert("�����о� �� �ֿ� ������ �о߸� �Է��Ͽ� �ּ���.");
			frm.pool_major.focus();
			return false;
		}

		if(frm.pool_career.value == ""){
			alert("�ֿ����� �Է��Ͽ� �ּ���.");
			frm.pool_career.focus();
			return false;
		}

		return true;
	}
</script>
		<table width="100%" height="26" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> ������ ���� ��</td>
			</tr>
		</table>
		<form name="formWritePool" method="post" enctype="multipart/form-data" action="<?=$pageUrl?>&page=/pages/admin/pool/poolWrite.php" onsubmit="return fncCheckSubmit();" >
		<input type="hidden" name="pool_approve_flag" id="pool_approve_flag" value="<?=$approve_flag?>" />
		<input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
		<input type="hidden" name="pool_idx" id="pool_idx" value="<?=$pool_idx?>" />

		<table class="bbsCont" cellspacing="0" summary="������ ����� �ϴ� ǥ">
			<caption class="none">������ ���</caption>
			<colgroup>
				<col width="20%" />
				<col width="60%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="fir">������ ���</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row" class="fir">
						<label for="pool_name">�̸�</label> <span class="f_orange">*</span></th>
					<td class="tal">
						<input type="text" name="pool_name" id="pool_name" <?if($pool_name != ""){?> value="<?=$pool_name?>" <?}else{?> <?if($HTTP_SESSION_VARS[duid] != ""){?>  value="<?=$HTTP_SESSION_VARS[duname]?>" <?}}?> class="basic" />
					</td>
					<td rowspan="4">
						<p class="face">
							<?if($pool_image != ""){?>
								<img src="/pages/pool/data/<?=$pool_image?>" width="106" height="125" alt="<?=$pool_name?> ����" />
							<?}else{?>
							<img src="/images/pool/pool_face_noimg.jpg" alt="������ ����" />
							<?}?>
						</p>
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="pool_organ">�Ҽӱ��</label> <span class="f_orange">*</span>
					</th>
					<td class="tal">
						<input type="text" id="pool_organ" name="pool_organ" size="30" class="basic"  value="<?=$pool_organ?>"/>
						<select name="pool_select_organ" title="�Ҽӱ�� ����" >
							<option value="">����</option>
							<option <?if($pool_select_organ == "���б�"){?>selected<?}?> value="���б�">���б�</option>
							<option <?if($pool_select_organ == "������"){?>selected<?}?> value="������">������</option>
							<option <?if($pool_select_organ == "���"){?>selected<?}?> value="���">���</option>
							<option <?if($pool_select_organ == "���"){?>selected<?}?> value="���">���</option>
							<option <?if($pool_select_organ == "��Ÿ"){?>selected<?}?> value="��Ÿ">��Ÿ</option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="pool_grade">����</label> <span class="f_orange">*</span>
					</th>
					<td class="tal"><input type="text" name="pool_grade" id="pool_grade" value="<?=$pool_organ?>" size="20"  class="basic"/></td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="pool_pass">��й�ȣ</label> <span class="f_orange">*</span>
					</th>
					<td class="tal"><input type="password" name="pool_pass" id="pool_pass" value="<?=$pool_pass?>" size="20" class="basic"/></td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="pool_pass_check">��й�ȣ Ȯ��</label> <span class="f_orange">*</span>
					</th>
					<td colspan="2" class="tal"><input type="password" name="pool_pass_check" id="pool_pass_check"  value="<?=$pool_pass?>" size="20" class="basic"/></td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="pool_image">�������</label>
					</th>
					<td colspan="2" class="tal">
						<input type="file" name="pool_file[]" id="pool_image" size="20" class="basic" />
						<?=$pool_image?>
						<br/>
						<span class="f_11 pad_l10">���� ���� �������� �������� �̷������ �մϴ�.</span>
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="pool_tel">��ȭ��ȣ</label> <span class="f_orange">*</span>
					</th>
					<td colspan="2" class="tal">
						<input type="text" id="pool_tel" name="pool_tel" size="20" maxlength="15" class="basic" value="<?=$pool_tel?>"/>
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="pool_fax">�ѽ���ȣ</label>
					</th>
					<td colspan="2" class="tal">
						<input type="text" id="pool_fax" name="pool_fax" size="20" class="basic" value="<?=$pool_fax?>"/>
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="pool_hp">�޴���ȭ</label>
					</th>
					<td colspan="2" class="tal">
						<input type="text" id="pool_hp" name="pool_hp" size="20" maxlength="15" class="basic" value="<?=$pool_hp?>"/>
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						�ٹ��� �ּ�
					</th>
					<td colspan="2" class="tal">
						<input type="text" id="pool_zip_code" name="pool_zip_code" class="basic" readonly title="�����ȣ" value="<?=$pool_zip_code?>" />
						
						<a href="/pages/pool/zipcode.php" target="displayWindow" onclick="childwin=window.open('','displayWindow','toolbar=no,scrollbars=no,width=460,height=455,top=30,left=30'); childwin.focus();">
							<img src="/images/member/btn_check_post.gif" alt="�����ȣ ã��" />
						</a>
						<br/>
						<input type="text" id="pool_address" name="pool_address" size="60" class="basic" title="�⺻ �ּ�" readonly value="<?=$pool_address?>"/>
						<br/>
						<input type="text" id="pool_address_detail" name="pool_address_detail" size="30" class="basic" title="������ �ּ�" value="<?=$pool_address_detail?>"/>
						<span class="f_11 pad_l10">������ �ּҸ� �Է��ϼ���.</span>
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="pool_email">E-mail</label> <span class="f_orange">*</span>
					</th>
					<td colspan="2" class="tal"><input type="text" id="pool_email" name="pool_email" size="30" class="basic" value="<?=$pool_email?>" /></td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="pool_major">�����о� ��<br/> �ֿ������úо�</label> <span class="f_orange">*</span>
					</th>
					<td colspan="2" class="tal"><input type="text" id="pool_major" name="pool_major" size="60" class="basic" value="<?=$pool_major?>" /></td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="pool_career">�ֿ���</label> <span class="f_orange">*</span>
					</th>
					<td colspan="2" class="tal">
						<textarea id="pool_career" name="pool_career" cols="70" rows="10"><?=$pool_career?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row" rowspan="4" class="fir">
						���� �纻
					</th>
					<td colspan="2" class="tal">
						<label for="pool_resume">�̷¼�</label>
						<input type="file" id="pool_resume" name="pool_file[]" size="20" class="basic" /><?=$pool_resume?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="tal">
						<label for="pool_idcard_forward">�ֹε���� �纻(��)</label>
						<input type="file" id="pool_idcard_forward" name="pool_file[]" size="20" class="basic" /><?=$pool_idcard_forward?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="tal">
						<label for="pool_idcard_backward">�ֹε���� �纻(��)</label>
						<input type="file" id="pool_idcard_backward" name="pool_file[]" size="20" class="basic" /><?=$pool_idcard_backward?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="tal">
						<label for="pool_bankbook">����纻</label>
						<input type="file" id="pool_bankbook" name="pool_file[]" size="20" class="basic" /><?=$pool_bankbook?>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" class="fir">
						<input type="image" src="/pages/admin/images/bbs/btn_write_big.gif" alt="���" />
						<?if($mode == "edit"){?>
							<a href="<?=$pageUrl?>&page=/pages/admin/pool/poolView.php&pool_idx=<?=$pool_idx?>"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="���" /></a>
						<?}else{?>
							<a href="<?=$pageUrl?>&page=/pages/admin/pool/pool.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="���" /></a>
						<?}?>
					</td>
				</tr>
			</tfoot>
		</table>
</form>