<?

include("../../config/mysql.inc.php");     //** �������
include "../../tagfree/decode.php";
include("../../config/comm.inc.php"); 
$mysql = new Mysql_DB;
$mysql->Connect();

$pageUrl .= $pageName;

$SQL = "SELECT * FROM edu WHERE uid = ".$uid;
$QUE = mysql_query($SQL);
$RES = mysql_fetch_array($QUE);

$uid		= $RES[uid];
$subject	= $RES[subject];
$sdate		= $RES[sdate];
$edate		= $RES[edate];
$stime		= $RES[stime];
$etime		= $RES[etime];
$t_time		= $RES[t_time];
$price		= $RES[price];
$room		= $RES[room];
$t_person	= $RES[t_person];
$teach		= $RES[teach];
$damdang	= $RES[damdang];
$content1	= nl2br(stripslashes($RES[content1]));
$content2	= nl2br(stripslashes($RES[content2]));
$up_file	= $RES[up_file];



?>

<script type="text/javascript" src="../js/ms_patch.js"></script>
<script type="text/javascript">
<!--
function open_window(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable)
{
	toolbar_str = toolbar ? 'yes' : 'no';
	menubar_str = menubar ? 'yes' : 'no';
	statusbar_str = statusbar ? 'yes' : 'no';
	scrollbar_str = scrollbar ? 'yes' : 'no';
	resizable_str = resizable ? 'yes' : 'no';
	window.open(url, name, 'left='+left+',top='+top+',width='+width+',height='+height+',toolbar='+toolbar_str+',menubar='+menubar_str+',status='+statusbar_str+',scrollbars='+scrollbar_str+',resizable='+resizable_str);
}



//-->
</script>

		<!-- main contents S-->
		<table class="bbsCont" cellspacing="0" summary="���� ���� ǥ">
			<colgroup>
				<col width="10%" />
				<col width="50%" />
				<col width="20%" />
				<col width="20%" />
			</colgroup>
			<thead>
				<tr>
					<th colspan="4"><?=$subject?></th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<th>���¸�</th>
				<td class="tal"><?=$subject?></td>
				<th>�� ���ǽð�</th>
				<td class="tal"><?=$t_time?></td>
			</tr>
				<?
				$pYear = date("Y", time());
				$pMonth = date("m", time());
				$pDay = date("d", time());
				?>
				<tr>
					<th>������</th>
					<td class="tal"><?=date("Y.m.d",$sdate)?></td>
					<th>������</th>
					<td class="tal"><?=date("Y.m.d", $edate)?></td>
				</tr>
				<tr>
					<th>���ǽð�</th>
					<td class="tal"><?=$stime?>:00 ~ <?=$etime?>:00</td>
					<th>������</th>
					<td class="tal"><?=number_format($price)?></td>
				</tr>
				<tr>
					<th>���ǽ�</th>
					<td class="tal"><?=$room?></td>
					<th>�����</th>
					<td class="tal"><?=$teach?></td>
				</tr>
				<tr>
					<th>�����ο�</th>
					<td class="tal"><?=$t_person?></td>
					<th>�����</th>
					<td class="tal"><?=$damdang?></td>
				</tr>
				<tr>
					<th>��������</th>
					<td class="tal" colspan=3><?=nl2br(stripslashes($content1))?></td>
				</tr>
				<tr>
					<th>��������</th>
					<td class="tal" colspan=3><?=nl2br(stripslashes($content2))?></td>
				</tr>
				<tr>
					<th>���α�������</th>
					<td class="tal" colspan=3><a href="../../up_file/edu/<?=$up_file?>"><?=$up_file?></a></td>
				</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">
						<?
						if($code == 'view')
						{
							?>
							<input type=button value="Ȯ��" onClick="self.close()">
							<?
						}
						else
						{
						?>
							<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu_edit.php&uid=<?=$uid?>&kind=<?=$kind?>&pageIdx=<?=$pageIdx?>"><img src="/pages/admin/images/bbs/btn_modify_big.gif" alt="����" /></a>
							<a href="<?=$pageUrl?>&page=/pages/admin/edu/edu.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="���" /></a>
						<?
						}
						?>
						</td>
					</tr>
				</tfoot>
			</table>
			<br />

				<?
				$pagesize		= 15;

				$pageIdx			= (!$pageIdx) ? 1 : $pageIdx;
				$startnum		= ($pageIdx - 1) * $pagesize;



				$addquery		= ($keyword AND $searchby) ? " and $searchby LIKE '%$keyword%'" : "";
				$addparameter	= ($keyword AND $searchby) ? "&searchby=$searchby&keyword=$keyword" : "";

				#�����ִ� ���� : code2�ʿ�...
				#$addquery		= ($code)  ? " AND code = '$code'".$addquery : $addquery;
				#$addquery		= ($code2) ? " AND code2 = '$code2'".$addquery : $addquery;
				#$addparameter	= ($code)  ? "&code=$code".$addparameter : $addparameter;
				#$addparameter	= ($code2) ? "&code2=$code2".$addparameter : $addparameter;


				if		($sort == "b.subject")	{	$orderby = "b.subject";	}
				else if	($sort == "b.sdate")	{	$orderby = "b.sdate";	}
				else if	($sort == "b.state")	{	$orderby = "b.sdate";	}
				else							{	$orderby = "a.ouid";	}


				$query = "SELECT COUNT(a.ouid) AS ouid FROM edu_order AS a, edu AS b, members AS c WHERE a.uid = ".$uid." AND a.uid = b.uid AND a.id = c.user_id ".$addquery;
				#$query .= " ORDER BY $orderby DESC";

				$rs = mysql_query($query);
				$row = mysql_fetch_array($rs);
				$total = $row[ouid];
				$totalpages = ceil($total/$pagesize);
				$record_num = $total - $pagesize * ($pageIdx - 1);
				
				if($total > 0)
				{
					?>
					
<form name="frm2" method="post" action="<?=$PHP_SELF?>">
<input type=hidden name=ouid value="">
			<table class="bbsCont" cellspacing="0" summary="������ ��� ����">
				<colgroup>
					<col width="8%"/>
					<col width="10%"/>
					<col />
					<col width="10%"/>
					<col width="10%"/>
					<col width="15%"/>
					<col width="15%"/>
					<col width="10%"/>
				</colgroup>
				<thead>
					<tr>
						<th scope="col"><input type="checkbox" onClick="javascript:allcheck(this.checked,'list')">���</th>
						<th scope="col">��ȣ</th>
						<th scope="col">�Ҽ�</th>
						<th scope="col">�̸�</th>
						<th scope="col">E-mail</th>
						<th scope="col">��ȭ��ȣ</th>
						<th scope="col">�޴���</th>
						<th scope="col">�����</th>
					</tr>
				</thead>
				<tbody>
					<?
					$c1_que = "SELECT c1_num, c1_name FROM edu_c1";
					$c1_rs	= mysql_query($c1_que);
					while($c1_row = mysql_fetch_array($c1_rs))
					{
						$view_c1_name[$c1_row[c1_num]] = $c1_row[c1_name];
					}

					if($kind) { $c1_addquery = " AND a.kind = ".$kind." "; }

					$query	= "SELECT * FROM edu_order AS a, edu AS b, members AS c WHERE a.uid = ".$uid." AND a.uid = b.uid  AND a.id = c.user_id ".$c1_addquery.$addquery." ORDER BY ouid DESC ";
					#$query .= "LIMIT $startnum, $pagesize";
					$rs		= mysql_query($query);
					$loop_num=0;
					$cnt_mail=0;
					while ($row = mysql_fetch_array($rs))
					{
						$ouid		= $row[ouid];
						$uid		= $row[uid];
						$c1_num		= $row[c1_num];
						$id			= $row[id];
						$kind_name	= $view_c1_name[$row[kind]];
						$subject	= $row[subject];
						$sdate		= date("Y.m.d",$row[sdate]);
						$edate		= date("Y.m.d",$row[edate]);
						$t_time		= $row[t_time];
						$price		= $row[price];
						$room		= $row[room];
						$t_person	= $row[t_person];
						$teach		= $row[teach];
						$user_name	= $row[user_name];
						$damdang	= $row[damdang];
						$content1	= $row[content1];
						$content2	= $row[content2];
						$up_file	= $row[up_file]; 
						$state		= $row[state];
						$bank		= $row[bank];
						$tel		= $row[tel];
						$mobile		= $row[mobile];
						$in_ent		= $row[in_ent];
						$signdate	= date("Y.m.d", $row[signdate]);

						if($send == 'send')
						{
							$md = new MimeDecoder;					// MIME ���ڴ� ����
							$md->SetBaseDir("/home/dip/public_html/korean/up_file/mail");		// MIME �������� �и��س� ���� ������ ������ ���� ���(���� ���)
							$md->SetBaseUrl("http://www.dip.or.kr/up_file/mail");		// ���� ���� ���� ���͸��� �� ���� ���
							$md->SetRename(true);					// ���� ���� �� ������ �̸��� ������ ������ ��� ���ο� �̸����� ����
							$md->SetDirSeperator("/");					// Linux/Unix�� ��� ���͸� �����ڸ� '/'�� ����

							
							$mime_contents = $HTTP_POST_VARS["mime_contents"];
							$mime_contents = stripslashes($mime_contents);
							
							$md->DecodeFromString($mime_contents);			// $mime_contents�� �� �Է� ������ �Ѱ��� MIME ���ڿ� ��. ���ڵ� ����.
							$html = $md->GetDecodedHtml();				// MIME ���ڿ� ������ ���ڵ��� �� �и��� HTML ���ڿ��� ������.
							$files = $md->GetDecodedFiles();				// �и��س� ���� ���ϸ� ����Ʈ('|'�� ����)

							$content = $html;

							
							$b_to = $row[email];
							#$b_to = "tomoth@nate.com";
							$b_writer = '�뱸�����л�������';
							$b_email = 'png@dip.or.kr';
							$b_content = $content;
							
							if($ouid == $go_mail[$loop_num])
							{
								tomoth_sendmail($b_num, $b_to, $b_writer, $b_email, $m_subject, $b_content);
								#echo $cnt_amil;
								$cnt_mail++;
							}
						}
						
						?>


						<tr>
							<td><input type=checkbox name="go_mail[<?=$loop_num?>]" value="<?=$ouid?>"></td>
							<td><!--<a href="javascript:open_window('open_window', 'reserve_edu_view.php?ouid=<?=$ouid?>', 100, 100, 700, 600, 0, 0, 0, 1, 0);"><font color=blue>--><?=$record_num?></font></a></td>
							<td>
								<?if($in_ent == ""){?>
								-
								<?}else{?>
									<?=$in_ent?>
								<?}?>
							</td>
							<td><?=$user_name?></td>
							<td><?=$row[email]?></td>
							<td><?=$tel?></td>
							<td><?=$mobile?></td>
							<td><?=$signdate?></td>
						</tr>
						<?
						$record_num--;
						$loop_num++;
					}

							
					if($send == "send")
					{
						?>
						<script type="text/javascript">
							<!--
							alert("�� <?=$cnt_mail?> ���� ������ ���۵Ǿ����ϴ�.");
							//-->
						</script>
						<?
					}
					?>

				<?
				}
				?>
				<script language='javascript'>
				<!--
				function allcheck(chked)
				{
					var num;
					num  = 0 ;

					for(var i=0; i < frm2.elements.length ; i++) 
					{ 
						//if(reg.elements[i].type=='checkbox' && reg.elements[i].name == "p_"+gubun+"["+num+"]")  
						if(frm2.elements[i].type=='checkbox' && frm2.elements[i].name == "go_mail["+num+"]")  
						{
							frm2.elements[i].checked = chked;
							num++;
						}
					}	
				}
				//-->
				</script>
			</tbody>
</table>


<script type="text/javascript">
function doSubmit(){


		ps = confirm('������!\n\n�����Ͻ� ȸ������ ������ ���۵ǹǷ� �����Ͻñ� �ٶ��ϴ�!\n\n�����Ͻðڽ��ϱ�?');
		if(ps){


			if(!document.frm2.m_subject.value)
			{
				alert("���������� �Է��ϼ���");
				document.frm2.m_subject.focus();
				return;
			}

			var form = document.frm2;
			var str = document.twe.MimeValue();
			form.mime_contents.value = str;		

			form.submit();
		}else{
			return;
		}

}
</script>


<br />


		<input type="hidden" name="mime_contents">
		<input type="hidden" name="uid" value="<?=$uid?>">
		<input type="hidden" name="code" value="<?=$code?>">
		<input type="hidden" name="send" value="send">

		<table class="bbsCont" cellspacing="0" summary="���� ����">
			<caption class="none">���� ����</caption>
			<colgroup>
				<col width="25%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="2">���ϸ�����Ʈ - <span class="f_orange">���µ��ȸ������ ���Ϲ߼�!</span></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th>����</th>
					<td class="tal"><input type="text" name="m_subject" style="width:100%" class="basic" /></td>
				</tr>
				<tr>
					<td height="400" colspan="2">
						<script language="jscript" src="/tagfree/tweditor.js"></script>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4">
						<input type="image" src="/pages/admin/images/bbs/btn_mail_send.gif" value='��������' onClick='doSubmit()' alt="��������" />
					</td>
				</tr>
			</tfoot>
		</table>
</form>