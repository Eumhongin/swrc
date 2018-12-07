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

  if($not_user == 1) $m_query = $m_query. " not_user = 1 ";  //불량회원
  else $m_query = $m_query. " not_user = 0 ";                //운영중인 회원

  if($ch_member <> "") $m_query = $m_query. " and ch_member = $ch_member "; //등급

  if($keyword <> "") {
		$m_query = $m_query ."and $search like '%$keyword%'";   //검색
	}

	if($sorder == "") $sorder = " in_day desc";               //등록날짜 순으로
	$m_query = $m_query. " Order by ".$sorder;

	//전체 회원수를 구한다
	$total_qry = "Select * From members ";
	$total_qry .= $m_query; 
	$mysql->ParseExec($total_qry); 
	$total = $mysql->RowCount();
	$mysql->ParseFree();

	// *** 게시물 수, 페이지수 ***
	if (empty($pageIdx)) $pageIdx = 1;

	$PostNum  = 20;
	$WidthNum = 10;
   
	$StartNum = ( $pageIdx - 1 ) * $PostNum;
	$EndNum = $PostNum;

	// 리스트 형식으로 내용을 보여준다
	$qry = "select * from members ";
	$qry .= $m_query ." limit $StartNum,$EndNum";
	$mysql->ParseExec($qry); 

	#echo $qry;
	// *** 페이징 class *****
	include("../../../config/page_manager_popup.php"); 

	// *** 페이징 *****
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

		document.frm.keyword2.value = '대구';
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
		alert("Opener 객체가 닫혔거나, 페이지 이동으로 처리를 완료할 수 없습니다.");
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
										<option value='user_id'		<? if ($search == "" or $search == "user_id" )	{ ?>selected<? } ?>>ID(아이디)	</option>
										<option value='user_name'	<? if ($search == "user_name")					{ ?>selected<? } ?>>이름		</option>
										
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
					<td align="right"><script>T2Button("검 색","javascript:frm.submit()", 45)</script></td>
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
								<td align="center"><b>아이디</b>&nbsp;</td>
								<td><table border="0" cellpadding="0" cellspacing="0" width="8">
										<tr align="right">
											<td width=8 valign="bottom" align="right"><a href="javascript:list_orderby('user_id asc')" onMouseOver="up1.src='../image/ic_up_on.gif'" onMouseOut="up1.src='../image/ic_up_off.gif'" onMouseOver="window.status=('올림');return true;" onMouseOut="window.status=(''); return true;"><img name="up1" src="../image/ic_up_<? if($sorder == "user_id asc") { ?>on<? } else { ?>off<? } ?>.gif" width="8" height="5" border="0"></a></td>
										</tr>
										<tr align="right">
											<td width="8" valign="top" align="right"><a href="javascript:list_orderby('user_id desc')" onMouseOver="up1.src='../image/ic_up_on.gif'" onMouseOut="up1.src='../image/ic_up_off.gif'" onMouseOver="window.status=('내림');return true;" onMouseOut="window.status=(''); return true;"><img name="down1" src="../image/ic_down_<? if($sorder == "user_id desc") { ?>on<? } else { ?>off<? } ?>.gif" width="8" height="5" border="0"></a></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>

					</td>
					<td width="20%" bgcolor="#EEF8FF">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td align="center"><b>이름</b></td>
								<td><table border="0" cellpadding="0" cellspacing="0" width="8">
										<tr align="right">
											<td width=8 valign="bottom" align="right"><a href="javascript:list_orderby('user_name asc')" onMouseOver="up1.src='../image/ic_up_on.gif'" onMouseOut="up1.src='../image/ic_up_off.gif'" onMouseOver="window.status=('올림');return true;" onMouseOut="window.status=(''); return true;"><img name="up1" src="../image/ic_up_<? if($sorder == "user_name asc") { ?>on<? } else { ?>off<? } ?>.gif" width="8" height="5" border="0"></a></td>
										</tr>
										<tr align="right">
											<td width="8" valign="top" align="right"><a href="javascript:list_orderby('user_name desc')" onMouseOver="up1.src='../image/ic_up_on.gif'" onMouseOut="up1.src='../image/ic_up_off.gif'" onMouseOver="window.status=('내림');return true;" onMouseOut="window.status=(''); return true;"><img name="down1" src="../image/ic_down_<? if($sorder == "user_name desc") { ?>on<? } else { ?>off<? } ?>.gif" width="8" height="5" border="0"></a></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				    <td width="45%" bgcolor="#EEF8FF">
						<b>소속</b> / <b>이메일</b>
					</td>
					<td width="15%" bgcolor="#EEF8FF"><b>선택</b></td>
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
						<input type="image" src="/pages/admin/images/bbs/btn_select.gif" value="선택" onclick="fncChoiceCharge('<?=$col["user_id"]?>','<?=$col["user_name"]?>')"/>
					</td>

				</tr>
				<?		} 
				
					} else {
				?>
				<tr bgcolor="#FFFFFF" align="center">
					<td colspan="4" align="center">
						<? if ($p_keyword) { ?>
						"<font size="2" color="red"><?= $p_keyword ?></font>"으로 검색한 결과가 없습니다
						<? } else { ?>
						등록된 회원이 없습니다
						<? } ?>
					</td>
				</tr>
				<? } ?>	
			</form>
			</table>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" height="40">
					<? // *** 페이징 *****	
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
