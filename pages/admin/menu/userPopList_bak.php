<?

	include("../admin_security.php");
	include("../../../config/comm.inc.php"); 
	// *** mysql connect class *****
	include("../../../config/mysql.inc.php");  

	$pageParameter = $pageUrl.$pageName."&page=".$page;
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$m_query = " Where"; 

	if($search == 'addr1')
	{
		$keyword = $keyword2;
	}

  if($user_flag != "") $not_user = $user_flag;

  if($not_user == 1) $m_query = $m_query. " not_user = 1 ";  //�ҷ�ȸ��
  else $m_query = $m_query. " not_user = 0 ";                //����� ȸ��

  if($ch_member <> "") $m_query = $m_query. " and ch_member = $ch_member "; //���

  if($keyword <> "") {
		$m_query = $m_query ."and $search like '%$keyword%'";   //�˻�
	}

	if($sorder == "") $sorder = " in_day desc";               //��ϳ�¥ ������
	$m_query = $m_query. " Order by ".$sorder;

	//��ü ȸ������ ���Ѵ�
	$total_qry = "Select * From members ";
	$total_qry .= $m_query; 
	$mysql->ParseExec($total_qry); 
	$total = $mysql->RowCount();
	$mysql->ParseFree();

	// *** �Խù� ��, �������� ***
	if (empty($pageIdx)) $pageIdx = 1;

	$PostNum  = 20;
	$WidthNum = 10;
   
	$StartNum = ( $pageIdx - 1 ) * $PostNum;
	$EndNum = $PostNum;

	// ����Ʈ �������� ������ �����ش�
	$qry = "select * from members ";
	$qry .= $m_query ." limit $StartNum,$EndNum";
	$mysql->ParseExec($qry); 

	#echo $qry;
	// *** ����¡ class *****
	include("../../../config/page_manager_popup.php"); 

	// *** ����¡ *****
	$pg = new initPage($pageIdx,$PostNum);
	$pageList = $pg->getPageList( $PHP_SELF, "ch_member=$ch_member&keyword=$keyword&keyword2=$keyword2&search=$search&sorder=$sorder", $total, $WidthNum);  
?>
<link rel="stylesheet" type="text/css" href="/pages/admin/css/admin_common.css"/>
<script type="text/javascript" src="/pages/bbs/js/comm.js"></script>
<script type="text/javascript" src='/js/eButton.js'></script>
<script type="text/javascript">document.domain = "dip.or.kr";</script>
<script type="text/javascript">
<!--
	function search_change(smode) {
		if (smode == "sex" || smode == "area" || smode == "level") {
			 document.search.submit();
		}
		else {
			document.all["sex_check"].style.display = "none";
			document.all["area_check"].style.display = "none";
			document.all["level_check"].style.display = "none";
		}
	}

	function sub_search_change() {
			 document.search.submit();
	}
	function list_orderby(orderby) {

		document.frm.sorder.value = orderby;
		document.frm.submit();
  }
-->
</script>


<script type="text/javascript">
function search_menu()
{
	menu = document.frm.search.value;
	document.frm.keyword.value = '';
	document.frm.keyword2.value = '';

	if(menu == 'addr1')
	{
		document.all.addr1_view.style.display = 'block';
		document.all.other_view.style.display = 'none' ;

		document.frm.keyword2.value = '�뱸';
	}
	else
	{
		document.all.addr1_view.style.display = 'none';
		document.all.other_view.style.display = 'block' ;
	}
}

function fncChoiceCharge(userId, userName){

	try{
		opener.choiceCharge(userId, userName);
	}catch (e) {
		alert("Opener ��ü�� �����ų�, ������ �̵����� ó���� �Ϸ��� �� �����ϴ�.");
	}
	window.close();

}
</script>

<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td align="left">
			<table border="0" cellpadding="0" cellspacing="3">
				<tr>
				<form name="frm" method="post" action="<? echo $PHP_SELP ?>">
					
					<td align="right">

						<table height="30" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<select name="search" onChange="search_menu()">
										<option value='user_id'		<? if ($search == "" or $search == "user_id" )	{ ?>selected<? } ?>>ID(���̵�)	</option>
										<option value='user_name'	<? if ($search == "user_name")					{ ?>selected<? } ?>>�̸�		</option>
										
									</select>
								</td>
								<td>
									<div id="other_view" style='display:none'>
										<table cellpadding=0 cellspacing=0 border=0>
											<tr>
												<td>
													&nbsp;
													<input type='text' name="keyword" size="20" maxlength="20" value="<?=$keyword?>" class="basic" />
												</td>
											</tr>
										</table>
									</div>

									<div id="addr1_view" style='display:none'>
										<table cellpadding=0 cellspacing=0 border=0>
											<tr>
												<td>
													<select name="keyword2" style="width : 131">
													<?
													$sql = "select distinct(sido) FROM zipcode";
													$que = mysql_query($sql);
													while($res = mysql_fetch_array($que))
													{
														?>
														<option value="<?=trim($res[sido])?>" <?=($keyword == trim($res[sido])) ? "selected" : ""?>><?=trim($res[sido])?>
														<?
													}
													?>
													</select>
												</td>
											</tr>
										</table>
									</div>

									<script type="text/javascript">
									<!--
									menu = '<?=$search?>';

									if(menu == 'addr1')
									{
										document.all.addr1_view.style.display = 'block';
										document.all.other_view.style.display = 'none' ;
									}
									else
									{
										document.all.addr1_view.style.display = 'none';
										document.all.other_view.style.display = 'block' ;
									}

									//-->
									</script>
								</td>
							</tr>
						</table>

					</td>
					<td align="right"><script>T2Button("�� ��","javascript:frm.submit()", 45)</script></td>
				</tr>
			</table>

			<table width="100%" cellpadding="3" cellspacing="1" bgcolor="#D5D5D5">
				<form name="frm" method="post">
				<input type="hidden" name="sorder" value="<? echo $sorder ?>">
				<input type="hidden" name="pageIdx" value="<? echo $pageIdx ?>">
				<input type="hidden" name="not_user" value="<? echo $not_user ?>">
				<tr bgcolor="#F7F7F7" class="td" align="center" height="25"> 
					<td width="20%" bgcolor="#EEF8FF">
						
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td align="center"><b>���̵�</b>&nbsp;</td>
								<td><table border="0" cellpadding="0" cellspacing="0" width="8">
										<tr align="right">
											<td width=8 valign="bottom" align="right"><a href="javascript:list_orderby('user_id asc')" onMouseOver="up1.src='../image/ic_up_on.gif'" onMouseOut="up1.src='../image/ic_up_off.gif'" onMouseOver="window.status=('�ø�');return true;" onMouseOut="window.status=(''); return true;"><img name="up1" src="../image/ic_up_<? if($sorder == "user_id asc") { ?>on<? } else { ?>off<? } ?>.gif" width="8" height="5" border="0"></a></td>
										</tr>
										<tr align="right">
											<td width="8" valign="top" align="right"><a href="javascript:list_orderby('user_id desc')" onMouseOver="up1.src='../image/ic_up_on.gif'" onMouseOut="up1.src='../image/ic_up_off.gif'" onMouseOver="window.status=('����');return true;" onMouseOut="window.status=(''); return true;"><img name="down1" src="../image/ic_down_<? if($sorder == "user_id desc") { ?>on<? } else { ?>off<? } ?>.gif" width="8" height="5" border="0"></a></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>

					</td>
					<td width="20%" bgcolor="#EEF8FF">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td align="center"><b>�̸�</b></td>
								<td><table border="0" cellpadding="0" cellspacing="0" width="8">
										<tr align="right">
											<td width=8 valign="bottom" align="right"><a href="javascript:list_orderby('user_name asc')" onMouseOver="up1.src='../image/ic_up_on.gif'" onMouseOut="up1.src='../image/ic_up_off.gif'" onMouseOver="window.status=('�ø�');return true;" onMouseOut="window.status=(''); return true;"><img name="up1" src="../image/ic_up_<? if($sorder == "user_name asc") { ?>on<? } else { ?>off<? } ?>.gif" width="8" height="5" border="0"></a></td>
										</tr>
										<tr align="right">
											<td width="8" valign="top" align="right"><a href="javascript:list_orderby('user_name desc')" onMouseOver="up1.src='../image/ic_up_on.gif'" onMouseOut="up1.src='../image/ic_up_off.gif'" onMouseOver="window.status=('����');return true;" onMouseOut="window.status=(''); return true;"><img name="down1" src="../image/ic_down_<? if($sorder == "user_name desc") { ?>on<? } else { ?>off<? } ?>.gif" width="8" height="5" border="0"></a></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				    <td width="45%" bgcolor="#EEF8FF">
						<b>�Ҽ�</b> / <b>�̸���</b>
					</td>
					<td width="15%" bgcolor="#EEF8FF"><b>����</b></td>
				</tr>
				<?
					if ($total > 0) {
						
						if($pageIdx == 1)   $i = $total;
						else $i = $total - ( $pageIdx - 1 ) * $PostNum;	

						 while($mysql->FetchInto(&$col)) { 
								
				?>
				<tr bgcolor="#FFFFFF" align="center">


					<td><?=$col["user_id"]?></td>
					<td><?=$col["user_name"]?></td>
				    <td class="aleft pad_l10">
						<?=$col["in_ent"]?> <br>
						<?=$col["email"]?></td>
					<td>
						<input type="image" src="/pages/admin/images/bbs/btn_select.gif" value="����" onclick="fncChoiceCharge('<?=$col["user_id"]?>','<?=$col["user_name"]?>')"/>
					</td>

				</tr>
				<?		} 
				
					} else {
				?>
				<tr bgcolor="#FFFFFF" align="center">
					<td colspan="4" align="center">
						<? if ($p_keyword) { ?>
						"<font size="2" color="red"><?= $p_keyword ?></font>"���� �˻��� ����� �����ϴ�
						<? } else { ?>
						��ϵ� ȸ���� �����ϴ�
						<? } ?>
					</td>
				</tr>
				<? } ?>	
			</form>
			</table>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" height="40">
					<? // *** ����¡ *****	
							 echo $pageList;  
					?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<form name="levefrm" method="post">
<input type="hidden" name="p_level">
<input type="hidden" name="pageIdx" value="<? echo $pageIdx ?>">
<input type="hidden" name="search" value="<? echo $search ?>">
<input type="hidden" name="keyword" value="<? echo $keyword ?>">
<input type="hidden" name="keyword2" value="<? echo $keyword2 ?>">
<input type="hidden" name="not_user" value="<? echo $not_user ?>">
</form>
<?
	$mysql->Disconnect();
?>
