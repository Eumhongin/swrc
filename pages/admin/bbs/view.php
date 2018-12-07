<?

	include("../../config/bbs_lib.inc.php");
	include("../../config/mysql.inc.php");
	include("../../config/comm.inc.php");


	$pageUrl .= $pageName;

	$a_idx = $_REQUEST["a_idx"];
	$category = $_REQUEST["category"];
	$keyword = $_REQUEST["keyword"];
	$search = $_REQUEST["search"];
	$b_num = $_REQUEST["b_num"];
	$real_num = $_REQUEST["b_num"];
	$look = $_REQUEST["look"];
	$mnu_name = $_REQUEST["mnu_name"];
	$pageIdx = $_REQUEST["pageIdx"];

	$mysql = new Mysql_DB;
	$mysql->Connect();

	// *** �Խ��� ȯ�� ****
	Bbs_Config($a_idx);


	$real_num = $b_num;

	$qry  = "Select * From $a_tablename Where b_num = $real_num";

	//if(!(($m_read == "Y" and $m_power == "2") or $adminstrator == true)) {
	//	$qry  .= " and b_look = 0 ";
	//}

	$mysql->ParseExec($qry);
	if ($mysql->RowCount() < 1) {

		 message("���ϵ� ���� �������� �ʽ��ϴ�");

	} else {

			$mysql->FetchInto(&$row);
			$b_id            = $row[b_id];
			$b_top           = $row[b_top];
			$b_category      = $row[b_category];
			$b_writer        = $row[b_writer];
			$b_pass          = $row[b_pass];
			$b_email         = $row[b_email];
			$b_jumin         = $row[b_jumin];
			$b_phone         = $row[b_phone];
			$b_home          = $row[b_home];
			$b_subject       = $row[b_subject];
			$b_html          = $row[b_html];
			$b_content       = $row[b_content];
			$b_regdate       = $row[b_regdate];
			$b_regdate       = explode(" ", $b_regdate);
			$b_count         = $row[b_count];
			$b_ref           = $row[b_ref];
			$b_step          = $row[b_step];
			$b_level         = $row[b_look];
			$b_look          = $row[b_look];
			$b_open          = $row[b_open];
			$b_ip            = $row[b_ip];
			$b_movetablename = $row[b_movetablename];
			$b_seminar       = $row[b_seminar];
			$b_admin_check	 = $row[b_admin_check];

			// *** �б� ���� ***
			if ($m_read == "N" and !($m_power == "2" or $adminstrator == true)) {
					message_url("�б� ������ �����ϴ�",$pageUrl."&page=/pages/admin/bbs/list.php&a_idx=$a_idx&category=$category&mnu_name=$mnu_name");

			}

      // *** ������ ***
      if ($b_open == 1) {

         $qry  = "Select b_pass From $a_tablename Where b_pass <> '' and b_ref = $b_ref";
				 $mysql->ParseExec($qry);
				 $mysql->FetchInto(&$open);

         if($open[b_pass] <> $open_pass and !($m_power == "2" or $adminstrator == true)) {    // �մ��϶� ���й�ȣ�� �����
            message("���й�ȣ�� ��ġ���� �ʽ��ϴ�");
         } elseif($HTTP_SESSION_VARS[duid] <> $b_id and !($m_power == "2" or $adminstrator == true)) { // ȸ���ϰ��� �ڽ��� �۸� ���� �ִ�
            message("�б� ������ �����ϴ�");
         }

			}

      // *** �� �̵� ***
			if ($b_movetablename <> "" and !($m_power == "2" or $adminstrator == true)) {

				 $qry  = "Select a_bbsname From bbs_admin Where a_tablename = '$b_movetablename'";
				 $mysql->ParseExec($qry);
				 $mysql->FetchInto(&$move);

				 if($move[a_bbsname] <> "") {
						message("�� �Խù��� [$move[a_bbsname]]���� �̵� �Ǿ����ϴ�");
			   } else {

				 }
			}

			// *** ���뿡 �ױ� ���� ����  ***
			if($b_html == "0")     $b_content  = cnl2br($b_content);
			elseif($b_html == "1") $b_content  = output_value($b_content);
			elseif($b_html == "2") $b_content  = cnl2br(output_value($b_content));
			$b_content = output_value($b_content);

			$pattern = '/[\&]/';
			$replacement = 'kimnazzzzz';
			$b_content = preg_replace($pattern, $replacement, $b_content);

			// ���� &nbsp;�� �� �� �������� ���� &nbsp;&nbsp;�� ������ �Ѵ�
			//�켱 kimnakkkkk�� �ٲ� �ڿ� &nbsp �ϳ��� �������� ���� �ѵ� �ٽ� &nbsp;&nbsp;�� �ٲٵ��� ����
			$b_content = str_replace("kimnazzzzznbsp;kimnazzzzznbsp;", "kimnakkkkk", $b_content);

			$b_content = str_replace("kimnazzzzznbsp;", " ", $b_content);
			$b_content = str_replace("kimnazzzzz", "&", $b_content);

			$b_content = str_replace("kimnakkkkk", "&nbsp;&nbsp;", $b_content);

			$b_content = str_replace("<br><br />", "<br>", $b_content);
			$b_content = str_replace("<br />", "", $b_content);

			// *** ���̳���û�� �ޱ� ***
			//�����ڴ� ���̳� ��û�� �� �ʿ䰡 �����Ƿ� �ּ�.
			if($b_seminar == "Y")  $b_content  = $b_content."<br><p align=center><a href=\"/pages/bbs/seminar.php?a_idx=$a_idx&b_num=$real_num\" target=\"displayWindow\" onclick=\"childwin=window.open('','displayWindow', 'toolbar=no,scrollbars=no,width=500,height=280,top=30,left=30');\" title=\"��â����\"><img src=/pages/bbs/image/seminar02.gif border=0></a>";

      // *** ��ȸ�� 1 ���� ***
			$cqry = "Update $a_tablename Set b_count = ($b_count+1) Where b_num = $b_num";
			$mysql->ParseExec($cqry);

	}

	// *** �Խ��� �з� ****
  if($a_category == "Y") {
    $sql =  " Select c_catename From bbs_admin_cate Where c_tablename='$a_tablename' and c_cate = $b_category ";
    $mysql->ParseExec($sql);
    $mysql->FetchInto(&$cate);

    $c_catename = $cate[c_catename];
  }
?>
<script type="text/javascript" src="/pages/bbs/js/comm.js"></script>

<?
if($a_photo == "N" and $a_reply == "Y" and $a_reply_type == "1") //�亯 �Խ����϶�, �亯 ���ϰ���
{
	?>

	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr height="33">
		<td width="8%" align="center" style="font-size:12pt;color=#ffffff" bgcolor="<?=$a_title_border ?>"><img src="/bbs/image/q.gif" border="0"  height="20"></td>
		<td bgcolor="<?=$a_mouseover_color ?>">&nbsp;<b><? if ($a_category == "Y") { ?> [<?=$c_catename ?>] <?} ?><font color="<?=$a_font_color ?>"><strong><?=$b_subject ?></strong></font></b></td>
		<td width="20%" bgcolor="<?=$a_mouseover_color ?>"><font color="<?=$a_font_color ?>">�̸� : <a href="mailto:<?=$b_email ?>"><?=$b_writer ?></font></a></td>
		<td width="20%" bgcolor="<?=$a_mouseover_color ?>"><font color="<?=$a_font_color ?>">��¥ : <?=$b_regdate[0] ?></font></td>
	</tr>
	<tr height="1"><td bgcolor="#cccccc" colspan="6"></td></tr>
	<tr>
		<td colspan="4" bgcolor="#FFFFFF" style="padding:5pt">


			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<?
			if ($a_photo == "Y")
			{
				?>
				<tr>
					<td>
						<?
						// *** ÷������ ****
						$fqry = "Select * From bbs_file Where f_tablename='$a_tablename' and f_num = $real_num Order by f_sort ";
						$mysql->ParseExec($fqry);

						while($mysql->FetchInto(&$file))
						{
							if(Bbs_FileIcon($file[f_filename]) == "gif.gif" or Bbs_FileIcon($file[f_filename]) == "jpg.gif")
							{
								$photo = "data/" . $a_idx . "/". $file[f_filename];
								$size = getimagesize("$photo");

								// �̹��� ����
								if($size[0] > $a_width) $photo_w = $a_width - 10;
								else $photo_w = $size[0];
								?>
								<table border="0" cellpadding="0" cellspacing="3" align="center">
								<tr><td><a href="javascript:ImgPopup('<?=$a_idx ?>','<?=$b_num ?>','<?=$file[f_sort] ?>','<?=$size[0] ?>','<?=$size[1] ?>')" <?=Brower_Status("�̹��� Ȯ��")?>><img src="<?=$photo ?>" width="<?=$photo_w ?>" border="0"></a></td></tr>
								</table>
								<?
							}
						}
						?>
					</td>
				</tr>
				<?
			}
			?>
			<tr>
				<td height="120"><?=$b_content ?></td>
			</tr>
			<?
			if($a_ip == "Y" or $m_power == "2" or $adminstrator == true)
			{	//������ ����
				?>
				<tr>
					<td align="right" style="padding-right:10;font-size:8pt;font-family:tahoma;color:gray"><b>From <?=$b_ip ?></b></td>
				</tr>
				<?
			}
			?>
			<tr>
				<td align="center"><? View_Icon($b_num) //�۾���, ����, �亯, ����, ���� ������ ?></td>
			</tr>
			</table>

		</td>
	</tr>
	</table>
	<?
	//ȭ�鿡 �亯���� �����ش�
	$qry = "Select * From $a_tablename Where b_ref = $b_ref and b_step > 0";
	$mysql->ParseExec($qry);

	while($mysql->FetchInto(&$ref))
	{
		// *** �Խ��� �з� ****
		$mysql2 = new Mysql_DB;
		$mysql2->Connect();

		$sql =  " Select c_catename From bbs_admin_cate Where c_tablename='$a_tablename' and c_cate = $ref[b_category]";
		$mysql2->ParseExec($sql);
		$mysql2->FetchInto(&$ref_cate);

		if($ref[b_id] <> "")
		{
			$sql  = "Select user_name From members Where user_id = '$ref[b_id]'";
			$mysql2->ParseExec($sql);
			$mysql2->FetchInto(&$member);
			$user_name = $member[user_name];
		}
		else
		{
			$user_name = $ref[b_writer];
		}

		$ref_step = $ref[b_step];

		// *** ���뿡 �ױ� ���� ����  ***
		if($ref[b_html] == "0")     $ref_content  = cnl2br($ref[b_content]);
		elseif($ref[b_html] == "1") $ref_content  = output_value($ref[b_content]);
		elseif($ref[b_html] == "2") $ref_content  = cnl2br(output_value($ref[b_content]));
		?>
		<br>

		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr height="1"><td bgcolor="#555555"></td></tr>
		<tr height="1"><td bgcolor="#FFFFFF"></td></tr>
		</table>


		<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr height="33">
			<td width="8%" align="center" bgcolor="<?=$a_title_border ?>"><img src="/bbs/image/a.gif" border="0" height="20"></td>
			<td bgcolor="<?=$a_mouseover_color ?>"><b><? if ($a_category == "Y") { ?> [<?=$ref_cate[c_catename] ?>] <?} ?><font color="<?=$a_font_color ?>"><strong><?=$ref[b_subject] ?></strong></font></b></td>
			<td width="20%" bgcolor="<?=$a_mouseover_color ?>"><font color="<?=$a_font_color ?>">�̸� : <a href="mailto:<?=$b_email ?>"><?=$user_name ?></a></font></td>
			<td width="20%" bgcolor="<?=$a_mouseover_color ?>"><font color="<?=$a_font_color ?>">��¥ : <?=substr($ref[b_regdate],0,10) ?></font></td>
		</tr>
		<tr height="1"><td bgcolor="#cccccc" colspan="6"></td></tr>
		<tr>
			<td colspan="4" bgcolor="#FFFFFF" style="padding:5pt;">


				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<?
				if ($a_photo == "Y")
				{
					?>
					<tr>
						<td>
							<?
							// *** ÷������ ****
							$fqry = "Select * From bbs_file Where f_tablename='$a_tablename' and f_num = $ref[b_num] Order by f_sort ";
							$mysql->ParseExec($fqry);

							while($mysql->FetchInto(&$file))
							{
								if(Bbs_FileExt($file[f_filename]) == "gif" or Bbs_FileExt($file[f_filename]) == "jpg")
								{
									$photo = "data/" . $a_idx . "/". $file[f_filename];
									$size = getimagesize("$photo");

									// �̹��� ����
									if($size[0] > $a_width) $photo_w = $a_width - 10;
									else $photo_w = $size[0];
									?>
									<table border="0" cellpadding="0" cellspacing="3" align="center">
									<tr><td><a href="javascript:ImgPopup('<?=$a_idx ?>','<?=$b_num ?>','<?=$file[f_sort] ?>','<?=$size[0] ?>','<?=$size[1] ?>')" <?=Brower_Status("�̹��� Ȯ��")?>><img src="<?=$photo ?>" width="<?=$photo_w ?>" border="0"></a></td></tr>
									</table>
									<?
								}else if(Bbs_FileExt($file[f_filename]) == "wmv"){
										$photo = "data/" . $a_idx . "/". $file[f_filename];
								?>
										<object classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701" id="winplayer" name="winplay" style="filter:xray()">
										<param name="filename" value="<?=$photo ?>"> <!-- /images/inews/bbs/play_k.wmv -->
										</object>
								<?
								}
							}
							?>
						</td>
					</tr>
					<?
				}
				?>
				<tr>
					<td height="50"><?=$ref_content ?></td>
				</tr>
				<?
				if($ref[b_id] == "" or ($ref[b_id] <> "" and $ref[b_id] == $HTTP_SESSION_VARS["duid"]) or ($m_power == "2" or $adminstrator == true))
				{	//������ ����
					?>
					<tr><td align="right" style="padding-right:10;font-size:8pt;font-family:tahoma;color:gray"><b>From <?=$b_ip ?></b></td></tr>
					<tr><td align="center"><? View_Icon($ref[b_num]) //�۾���, ����, �亯, ����, ���� ������ ?></td></tr>
					<?
				}
				?>
				</table>


			</td>
		</tr>
		</table>
		<?
	}
}
else
{
?>
		<p class="contTitle"><?=$a_bbsname?> �󼼳���</p>

		<table class="bbsCont" cellspacing="0" summary="<?=$a_bbsname?> �󼼳���">
			<caption class="none"><?=$a_bbsname?></caption>
			<colgroup>
				<col width="15%" />
				<col width="35%" />
				<col width="15%" />
				<col width="35%" />
			</colgroup>
			<tbody>
				<tr>
					<th scope="row">����</th>
					<td colspan="3" class="tal">
					<? if ($a_category == "Y") { ?> [<?=$c_catename ?>] <?} ?>
					<strong><?=utf8ToEuckr($b_subject)?></strong></td>
				</tr>
				<?if($a_phone == "Y"){	//����ó ����?>
				<tr>
					<th scope="row">����ó</th>
					<td colspan="3" class="tal"><?=$b_phone?></td>
				</tr>
				<?}?>
				<?if($a_email == "Y"){//�̸��� ����?>
				<tr>
					<th scope="row">�̸���</th>
					<td colspan="3" class="tal"><?=utf8ToEuckr($b_email)?></td>
				</tr>
				<?}?>
				<?if($a_homepage == "Y"){//Ȩ������ ����?>
				<tr>
					<th scope="row">Ȩ������</th>
					<td colspan="3" class="tal"><?=utf8ToEuckr($b_home)?></td>
				</tr>
				<?}?>
				<tr>
					<th scope="row">������</th>
					<td class="tal"><?=$b_regdate[0]?></td>
					<th scope="row">��ȸ��</th>
					<td class="tal"><?=$b_count?></td>
				</tr>
				<tr>
					<th scope="row">�ۼ���</th>
					<td class="tal"><?=utf8ToEuckr($b_writer)?></td>
					<th scope="row">÷��</th>
					<td class="tal">
						<?
							if ($a_photo == "N")
							{
						?>
									<form name="file" method="post" target="_self">
									<input type="hidden" name="path" value="<?=$path ?>">
									<input type="hidden" name="a_idx" value="<?=$a_idx ?>">
									<input type="hidden" name="num" value="">
									<input type="hidden" name="filename" value="">
										<?
										// *** ÷������ ****
										$fqry = "Select * From bbs_file Where f_tablename='$a_tablename' and f_num = $real_num Order by f_sort ";
										$mysql->ParseExec($fqry);
										$i = 1;
										while($mysql->FetchInto(&$file))
										{
											?>
											<img src="/images/bbs/icon_file.gif" alt="����" class="vmiddle" />
											<input type="hidden" name="file<?=$i ?>" value="<?=utf8ToEuckr($file[f_filename]) ?>">
												<a href="javascript:FileDownload('<?=$i ?>', '<?=utf8ToEuckr($file[f_filename])?>')"><?=utf8ToEuckr($file[f_filename]) ?></a>
											<?
											$i++;
										}
									?>
									</form>
								<?
							}
						?>
					</td>
				</tr>
				<?if($a_admin_check == "Y" && $adminstrator == true && false){//������ ���� ���� ����. ��������?>
				<tr>
					<th scope="row">���ο���</th>
					<td colspan="3" class="tal f_orange">
						<? if($b_admin_check == "Y"){ ?>
							���ε� �Խù� �Դϴ�.
							<a href="<?=$pageUrl?>&amp;page=/pages/admin/bbs/update_admin_check.php&amp;b_num=<?=$b_num ?>&amp;a_idx=<?=$a_idx?>&amp;category=<?=$category?>&amp;look=<?=$look?>&amp;search=<?=$search?>&amp;keyword=<?=curlencode($keyword)?>&amp;pageIdx=<?=$pageIdx ?>&amp;check_flag=N">[��������]</a>
						<?}else{?>
							�������� �Խù� �Դϴ�.
							<a href="<?=$pageUrl?>&amp;page=/pages/admin/bbs/update_admin_check.php&amp;b_num=<?=$b_num ?>&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category?>&amp;look=<?=$look?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword)?>&amp;pageIdx=<?=$pageIdx ?>&amp;check_flag=Y">[����]</a>
						<?}?>
					</td>
				</tr>
				<?}?>

			<tr>
			<!--������ ���������� ���� �Ͱ� ũ�� ���� ����-->
				<td colspan="4" class="tal" width="695" >
				<?=utf8ToEuckr($b_content)?>
				<?//if ($a_photo == "Y"){
					if (true){
						?>
				<p class="photo">
					<?
						// *** ÷������ ****
						$fqry = "Select * From bbs_file Where f_tablename='$a_tablename' and f_num = $real_num Order by f_sort ";
						$mysql->ParseExec($fqry);

						while($mysql->FetchInto(&$file))
						{
							echo "<br />";
							if(Bbs_FileExt($file[f_filename]) == "gif" or Bbs_FileExt($file[f_filename]) == "jpg" or Bbs_FileExt($file[f_filename]) == "JPG" or Bbs_FileExt($file[f_filename]) == "GIF"  or Bbs_FileExt($file[f_filename]) == "bmp" or Bbs_FileExt($file[f_filename]) == "BMP")
							{
								$photo = "../../pages/bbs/data/" . $a_idx . "/". $file[f_filename];
								$size = getimagesize("$photo");

								// size[0]: ���� ũ��, size[1]: ���� ũ��
								if($size[0] < 650) $photo_w = $size[0];
								else $photo_w = 650;

								if($size[1] < 650) $photo_h = $size[1];
								else $photo_h = 650;

								$photo = utf8ToEuckr($photo);

								?>
								<img src="<?=$photo ?>" alt="<?=utf8ToEuckr($file[f_filename])?>" width="<?=$photo_w?>" height="<?=$photo_h?>">
								<?
							}
						}
					?>
				</p>
				<?}?>
<?
$cnt = preg_match_all('~/bbs/.*?\.jpg~', $b_content, $matches);
$test = $matches[0];
$test2 = str_replace("/bbs/","",$test[0]);
$test3 = urlEncode($test2);
$b_content = str_replace ($test2,$test3,$b_content);
?>
				</td>
			</tr>
<?
	if($a_command == "Y")
	{	//������ ����
		?>
		<tr>
			<td colspan="4" class="tal">
			<form name="cm_frm" method="post" action="<?=$pageUrl?>&amp;page=/pages/admin/bbs/write.php" onsubmit="return <?if($HTTP_SESSION_VARS[duid] == "") {?>Comment<? }else {?>MComment<? } ?>(this)">

			<ul class="bbsReplyList">
			<?
			// *** ������ ****
			$cmqry  =  " Select c_id, c_num, c_feel, c_name,c_content, c_regdate, period_diff(date_format(now(),'%Y%m%d'),date_format(c_regdate,'%Y%m%d')) as new_icon ";
			$cmqry .=  " From comment Where c_tablename='$a_tablename' and c_bnum = $real_num ";
			$cmqry .=  " Order by c_num";
			$mysql->ParseExec($cmqry);

			$j = 0 ;
			while($mysql->FetchInto(&$com))
			{
				$c_regdate = explode(" ",$com[c_regdate]);
				$c_name    = utf8ToEuckr($com[c_name]) ;

				if($com[c_name] == "")
				{
					$c_name = $com[c_id];
				}
				?>
				<li>
					<p class="title"><?=$c_name?><span class="date"><?=$c_regdate[0]?></span></p>
					<?//�� ���� �����Ұ��쿡 ����
						if($com[new_icon] == 0){
							//������
						}
					?>
					<p class="btn">
					<!--
						<a href=""><img src="/images/bbs/btn_comm_modify.gif" alt="����" /></a>
					-->
						<?
						// ��ȸ������ ���й�ȣ�� �Է��� �� �ִ� ���̾ �����ش�
						if($HTTP_SESSION_VARS[duid] == "")
						{
						?>
						<a href="javascript:showCommand(<?=$j ?>);"><img src="/images/bbs/btn_comm_del.gif" alt="����" /></a>
						<input type="hidden" name="open_pass" value="<?=$open_pass?>" />
						<div style="position:relative;">
							<div id="divCommand<?=$j ?>" style="display:none;position:absolute;left:0;top:-5;z-index:1;">
								<table cellpadding="0" cellspacing="1" bgcolor="#c3c3c3">
									<tr height="15">
										<td align="right" style="padding-right:5;"><img src="image/close.gif" style="cursor:hand" onClick="javascript:document.all.divCommand<?=$j ?>.style.display='none';" WIDTH="12" HEIGHT="11"></td>
									</tr>
									<tr>
										<td bgcolor="white" style="padding-left:20;padding-right:15;padding-bottom:10;padding-top:5">���й�ȣ�� �Է��ϼ���<br>
											<input type="password" name="cm_pass<?=$j ?>" style="width:80; height:18;" class='tbox'>&nbsp;<a href="javascript:cm_checkfrm('<?=$j ?>','<?=$com[c_num] ?>');"><img src="/bbs/image/btn_delete.gif" border="0" align="absbottom"></a>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<?} //�ΰ����ڳ� �ۼ��ڴ� ������ ������ �־�����.
						else if($com[c_id] == $HTTP_SESSION_VARS[duid] or $m_power == "2" or $adminstrator == true){?>
							<a href="javascript:cm_delete_admin('<?=$com[c_num] ?>', '<?=$pageUrl?>');"><img src="/images/bbs/btn_comm_del.gif" alt="����" /></a>
						<?}?>

					</p>
					<p class="cont">
						<?=utf8ToEuckr(cnl2br($com[c_content]))?>
					</p>
				</li>
				<?
				$j++;
			}
			?>
			</ul>

			</td>
			</tr>
			<tr>
			<td colspan="4">
				<input type="hidden" name="a_idx" value="<?=$a_idx?>">
				<input type="hidden" name="b_num" value="<?=$b_num?>">
				<input type="hidden" name="category" value="<?=$category ?>">
				<input type="hidden" name="search" value="<?=$search ?>">
				<input type="hidden" name="keyword" value="<?=$keyword ?>">
				<input type="hidden" name="pageIdx" value="<?=$pageIdx ?>">
				<input type="hidden" name="mode" value="comment">
				<input type="hidden" name="cm_feel" value="0">
				<input type="hidden" name="mnu_name" value="<?=$mnu_name?>">
				<input type="hidden" name="cm_num" value="">

				<h4 class="bullet_t">���� �ۼ�</h4>
				<textarea id="cm_content" name="cm_content" rows="4" cols="100" title="���۳����ۼ�"></textarea>

					<?
					//�α��� ���� �ʾ��� ����
					if($HTTP_SESSION_VARS[duid] == ""){
					?>
						<script type="text/javascript">
							<!--
								function loginCheck()
								{
									alert("������ �α��� �� �̿��Ͻ� �� �ֽ��ϴ�.");
								}
							//-->
						</script>
					<button type="button" onclick="loginCHeck();"><img src="/pages/admin/images/bbs/btn_comm_write.gif" alt="����" /></button>
					<?}else{?>
					<input type="image" src="/pages/admin/images/bbs/btn_comm_write.gif" value="����" alt="����" class="vmiddle" />
					<?}?>
			</form>
			</td>
		</tr>
	<?
	}   //������ ���� if�� ����
	?>
		</tbody>
		<tfoot>
		<tr>
			<td colspan="4">
				<?
				if(!($a_photo == "N" and $a_reply == "Y" and $a_reply_type == "1")){
				//�۾���, ����, �亯, ����, ���� ������
					View_Admin_Icon($b_num);
				}
				?>
			</td>
		</tr>
		</tfoot>
	</table>

<?}?>
