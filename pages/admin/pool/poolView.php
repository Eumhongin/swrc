<?
	include ("../../config/mysql.inc.php");
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$query = "Select * From t_pool Where pool_idx = '".$pool_idx."' ";

	$mysql->ParseExec($query);
	if ($mysql->RowCount() < 1) {

		 message("��ϵ� ������ �������� �ʽ��ϴ�");
	
	} else {
			$mysql->FetchInto(&$row);
			$pool_name            = $row[pool_name];
			$pool_organ           = $row[pool_organ];
			$pool_select_organ      = $row[pool_select_organ];
			$pool_grade        = $row[pool_grade];
			$pool_image         = $row[pool_image];
			$pool_email         = $row[pool_email];
			$pool_major         = $row[pool_major];
			$pool_career         = $row[pool_career];
			$pool_approve_flag	= $row[pool_approve_flag];
			$pool_tel			= $row[pool_tel];
			$pool_fax			= $row[pool_fax];
			$pool_hp			= $row[pool_hp];
			$pool_zip_code		= $row[pool_zip_code];
			$pool_address		= $row[pool_address];
			$pool_address_detail = $row[pool_address_detail];
			$pool_resume		= $row[pool_resume];
			$pool_idcard_forward = $row[pool_idcard_forward];
			$pool_idcard_backward = $row[pool_idcard_backward];
			$pool_bankbook		= $row[pool_bankbook];
	}

	$mysql->Disconnect();
?>
<script type="text/javascript">
	function fncDeletePool(){
		if(!confirm("���� ���� �Ͻðڽ��ϱ�?")){
			return;
		}
		location.href="<?=$pageUrl?>&page=/pages/admin/pool/poolWrite.php&mode=delete&pool_idx=<?=$pool_idx?>";
	}
</script>

	<table width="100%" height="26" cellpadding="0" cellspacing="0">
	  <tr>
		<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> <?=$pool_name?>���� ������</td>
	  </tr>
	</table>
	<!--pool ���� View ����-->
	<table class="bbsCont" cellspacing="0" summary="ȸ�� ���� ���� ��">
		<colgroup>
        	<col width="15%" />
       	 	<col />
       		<col width="15%" />
       		<col width="30%" />
        </colgroup>
		<thead>
		</thead>
		<tbody>
			<tr>
				<th>�̸�</th>
				<td class="tal"><?=$pool_name?></td>
				<th rowspan="7">����</th>
				<td rowspan="7">
					<?if($pool_image){?>
						<img src="/pages/pool/data/<?=$pool_image?>" width="106" height="125" alt="<?=$pool_name?> ����" />
						<br/>
						<a href="/pages/admin/pool/download.php?file=<?=$pool_image?>"><?=$pool_image?></a>
					<?}else{?>
						<img src="/images/pool/pool_face_noimg.jpg" alt="No Image" />
					<?}?>
				</td>
			</tr>
			<tr>
				<td colspan="2"></td>
			</tr>
			<tr>
				<th>�Ҽӱ��</th>
				<td class="tal"><?=$pool_organ?> (<?=$pool_select_organ?>)</td>
			</tr>
			<tr>
				<td colspan="2"></td>
			</tr>
			<tr>
				<th>����</th>
				<td class="tal"><?=$pool_grade?></td>
			</tr>
			<tr>
				<td colspan="2"></td>
			</tr>
			<tr>
				<th>�̸���</th>
				<td class="tal"><?=$pool_email?></td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>
			<tr>
				<th>�ּ�</th>
				<td colspan="3"><?=$pool_zip_code?> <?=$pool_address?> <?=$pool_address_detail?>
				<?if($pool_zip_code == "" || $pool_address == "" || $pool_address_detail){?>
				-
				<?}?>
				</td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>
			<tr>
				<th>��ȭ��ȣ</th>
				<td class="tal"><?=$pool_tel?>
				<?if($pool_tel == ""){?>
				-
				<?}?>
				</td>
				<th>�޴���ȭ��ȣ</th>
				<td class="tal"><?=$pool_hp?>
				<?if($pool_hp == ""){?>
				-
				<?}?>
				</td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>
			<tr>
				<th>�ѽ���ȣ</th>
				<td colspan="3" class="tal">
				<?=$pool_fax?>
				<?if($pool_fax == ""){?>
				-
				<?}?>
				</td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>
			<tr>
				<th>�̷¼�</th>
				<td class="tal"><a href="/pages/admin/pool/download.php?file=<?=$pool_resume?>"><?=$pool_resume?></a><?if($pool_resume == ""){?>-<?}?></td>
				<th>����纻</th>
				<td class="tal"><a href="/pages/admin/pool/download.php?file=<?=$pool_bankbook?>"><?=$pool_bankbook?></a><?if($pool_bankbook == ""){?>-<?}?></td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>
			<tr>
				<th>�ֹε���� �ո�</th>
				<td class="tal"><a href="/pages/admin/pool/download.php?file=<?=$pool_idcard_forward?>"><?=$pool_idcard_forward?></a><?if($pool_idcard_forward == ""){?>-<?}?></td>
				<th>�ֹ������� �޸�</th>
				<td class="tal"><a href="/pages/admin/pool/download.php?file=<?=$pool_idcard_backword?>"><?=$pool_idcard_backword?></a><?if($pool_idcard_backword == ""){?>-<?}?></td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>
			<tr>
				<th>�����о� ��<br/>�ֿ������úо�</th>
				<td colspan="3" class="tal"><?=$pool_major?></td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>
			<tr>
				<th>�ֿ���</th>
				<td colspan="3" class="tal">
					<?=nl2br(stripslashes($pool_career))?>
				</td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>
			<tr>
				<th>���ο���</th>
				<td colspan="3" class="tal">
					<?if($pool_approve_flag == "Y"){?>
						<?=$pool_name?>���� ���οϷ� �Ǿ����ϴ�.  
							<a href="<?=$pageUrl?>&page=/pages/admin/pool/poolUpdateApproveFlag.php&approveUpdate=N&pool_idx=<?=$pool_idx?>">
								<font color="blue">[��������]</font>
							</a>
					<?}else{?>
						<?=$pool_name?>���� ���� ����� �Դϴ�.  <a href="<?=$pageUrl?>&page=/pages/admin/pool/poolUpdateApproveFlag.php&approveUpdate=Y&pool_idx=<?=$pool_idx?>"><font color="blue">[�����ϱ�]</font></a>
					<?}?>
				</td>
			</tr>
			<tr>
				<td colspan="4"></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="8">
					<a href="<?=$pageUrl?>&page=/pages/admin/pool/poolWriteForm.php&mode=edit&pool_idx=<?=$pool_idx?>">
						<img src="/pages/admin/images/bbs/btn_modify_big.gif" />
					</a>
					<a href="#" onclick="javascript:fncDeletePool();">
						<img src="/pages/admin/images/bbs/btn_delete_big.gif" />
					</a>
					<a href="<?=$pageUrl?>&page=/pages/admin/pool/pool.php">
						<img src="/pages/admin/images/bbs/btn_list_big.gif" />
					</a>
				</td>
			</tr>
		</tfoot>
	</table>
	<!-- pool ���� View �� -->
