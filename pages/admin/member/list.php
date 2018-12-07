<?
	//*******************  Information  ***********************
	//	Program Title :	회원리스트
	//	File Name		  :	list.php
	//	Company			  :	(주)나우아이텍 (053)955-9055
	//	Creator			  :	이 혜 진   2003. 10
	//*********************************************************
	//session_start();

	include("../../config/comm.inc.php"); 
	// *** mysql connect class *****
	include("../../config/mysql.inc.php");  

	$pageParameter = $pageUrl.$pageName."&page=".$page;
	$pageUrl .= $pageName;

	$pageIdx = $_REQUEST["pageIdx"];
	$search = $_REQUEST["search"];
	$keyword = $_REQUEST["keyword"];
	$keyword2 = $_REQUEST["keyword2"];

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$m_query = " Where 1 = 1 "; 

	if($search == 'addr1')
	{
		$keyword = $keyword2;
	}

  if($user_flag != "") $not_user = $user_flag;


 // if($not_user == 1) $m_query = $m_query. " not_user = 1 ";  //불량회원
 // else $m_query = $m_query. " not_user = 0 ";                //운영중인 회원

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

	//echo $qry;
	// *** 페이징 class *****
	include("../../config/page_manager_admin.php"); 

	// *** 페이징 *****
	$pg = new initPage($pageIdx,$PostNum);
	$pageList = $pg->getPageList( $pageParameter, "ch_member=$ch_member&keyword=$keyword&keyword2=$keyword2&search=$search&sorder=$sorder&user_flag=$user_flag", $total, $WidthNum);  
?>
<script type="text/javascript" src="/pages/bbs/js/comm.js"></script>
<script type="text/javascript" src='/js/eButton.js'></script>
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
</script>


		<p class="contTitle">
			전체회원수 : <?=$total?>명 &nbsp;&nbsp;현재 : <?=$pageIdx?> / 전체 : <?=$totalPage?>
			<?
			//if($not_user <> 1)   {
			if(false)   {
			?>
				&nbsp;&nbsp;&nbsp;
				[
				<img src="/pages/admin/images/common/icon_excel.gif" class="vmiddle" />
				<a href="/pages/admin/member/list_excel.php"><span class="f_orange">엑셀로 다운로드</span></a>
				]
			<?}?>
		</p>

		<form name="frm" method="post">
		<input type="hidden" name="sorder" value="<? echo $sorder ?>">
		<input type="hidden" name="pageIdx" value="<? echo $pageIdx ?>">
		<input type="hidden" name="not_user" value="<? echo $not_user ?>">
		<table width="100%" class="bbsCont" cellspacing="1" summary="전문가 목록 보기">
			<colgroup>
				<col width="8%"/>
				<col width="10%"/>
				<col width="12%"/>
				<col />
				<col width="13%"/>
				<col width="12%"/>
				<col width="12%"/>
				<col width="10%"/>
				<col width="5%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">아이디</th>
					<th scope="col">이름</th>
					<th scope="col">이메일</th>
					<th scope="col">전화</th>
					<th scope="col">이동전화</th>
					<th scope="col">가입날짜</th>
					<th scope="col">등급</th>
				</tr>
			</thead>
			<tbody>

			<?
				if ($total > 0) {
					
					if($pageIdx == 1)   $i = $total;
					else $i = $total - ( $pageIdx - 1 ) * $PostNum;	

					 while($mysql->FetchInto(&$col)) { 								
				?>
				<tr>
					<td><?=$i-- ?></td>
					<td><a href="<?=$pageUrl?>&page=/pages/admin/member/view.php&amp;not_user=<? echo $not_user ?>&user_id=<? echo $col["user_id"] ?>&pageIdx=<? echo $pageIdx ?>&search=<? echo $search ?>&keyword=<?echo $keyword ?>&keyword2=<?=$keyword2?>"><? echo $col["user_id"] ?></a></td>
					<td><? echo utf8ToEuckr($col["user_name"])?></td>
				    <td class="tal"><? echo $col["email"] ?></td>
					<td class="tal">(<?=$col["tel1"]?>)-<?=$col["tel2"]?>-<?=$col["tel3"]?></td>
					<td class="tal">(<?=$col["hp1"]?>)-<?=$col["hp2"]?>-<?=$col["hp3"]?></td>
					<td class="tal"><?=$col["in_day"]?></td>
					<td class="tal"><?if($col["ch_member"]=="1"){?>회원<?}else if($col["ch_member"]=="2"){?>관리자<?}?></td>

					</tr>
					<?		} 
					
						} else {
					?>
					<tr>
						<td colspan="8">
							<? if ($p_keyword) { ?>
							"<font size="2" color="red"><? echo $p_keyword ?></font>"으로 검색한 결과가 없습니다
							<? } else { ?>
							등록된 회원이 없습니다
							<? } ?>
						</td>
					</tr>
					<? } ?>	
				</tbody>
				<tfoot>
				<tr>
					<td height="40" colspan="8" align="center">
						<!-- 기본 paging -->
						<ul>
							<?=$pageList?>
						</ul>
					</td>
				</tr>
				<tr>
				<td colspan="8">
					<a href="<?=$pageUrl?>&page=/pages/admin/member/join.php"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록"/></a>
				</td>
			</tr>
				<tr>
					<td height="34" colspan="8" align="center">
						<select name="search" id="searchCol" title="검색분류">
							<option value='user_id'		<? if ($search == "" or $search == "user_id" )	{ ?>selected<? } ?>>ID(아이디)	</option>
						</select>
						<input type='text' name="keyword" size=20 maxlength=20 value="<?=$keyword?>" class="vmiddle" />
						<input type="image" src="/pages/admin/images/bbs/btn_search.gif" value="검색" alt="검색" class="vmiddle" />
					</td>
				</tr>
			</tfoot>
	</table>
	</form>


	<form name="levefrm" method="post">
	<input type="hidden" name="p_level">
	<input type="hidden" name="pageIdx" value="<? echo $pageIdx ?>">
	<input type="hidden" name="search" value="<? echo $search ?>">
	<input type="hidden" name="keyword" value="<? echo $keyword ?>">
	<input type="hidden" name="keyword2" value="<? echo $keyword2 ?>">
	</form>
	<?
		$mysql->Disconnect();
	?>
