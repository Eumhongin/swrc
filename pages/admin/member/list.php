<?
	//*******************  Information  ***********************
	//	Program Title :	ȸ������Ʈ
	//	File Name		  :	list.php
	//	Company			  :	(��)��������� (053)955-9055
	//	Creator			  :	�� �� ��   2003. 10
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


 // if($not_user == 1) $m_query = $m_query. " not_user = 1 ";  //�ҷ�ȸ��
 // else $m_query = $m_query. " not_user = 0 ";                //����� ȸ��

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

	//echo $qry;
	// *** ����¡ class *****
	include("../../config/page_manager_admin.php"); 

	// *** ����¡ *****
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

		document.frm.keyword2.value = '�뱸';
	}
	else
	{
		document.all.addr1_view.style.display = 'none';
		document.all.other_view.style.display = 'block' ;
	}
}
</script>


		<p class="contTitle">
			��üȸ���� : <?=$total?>�� &nbsp;&nbsp;���� : <?=$pageIdx?> / ��ü : <?=$totalPage?>
			<?
			//if($not_user <> 1)   {
			if(false)   {
			?>
				&nbsp;&nbsp;&nbsp;
				[
				<img src="/pages/admin/images/common/icon_excel.gif" class="vmiddle" />
				<a href="/pages/admin/member/list_excel.php"><span class="f_orange">������ �ٿ�ε�</span></a>
				]
			<?}?>
		</p>

		<form name="frm" method="post">
		<input type="hidden" name="sorder" value="<? echo $sorder ?>">
		<input type="hidden" name="pageIdx" value="<? echo $pageIdx ?>">
		<input type="hidden" name="not_user" value="<? echo $not_user ?>">
		<table width="100%" class="bbsCont" cellspacing="1" summary="������ ��� ����">
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
					<th scope="col">��ȣ</th>
					<th scope="col">���̵�</th>
					<th scope="col">�̸�</th>
					<th scope="col">�̸���</th>
					<th scope="col">��ȭ</th>
					<th scope="col">�̵���ȭ</th>
					<th scope="col">���Գ�¥</th>
					<th scope="col">���</th>
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
					<td class="tal"><?if($col["ch_member"]=="1"){?>ȸ��<?}else if($col["ch_member"]=="2"){?>������<?}?></td>

					</tr>
					<?		} 
					
						} else {
					?>
					<tr>
						<td colspan="8">
							<? if ($p_keyword) { ?>
							"<font size="2" color="red"><? echo $p_keyword ?></font>"���� �˻��� ����� �����ϴ�
							<? } else { ?>
							��ϵ� ȸ���� �����ϴ�
							<? } ?>
						</td>
					</tr>
					<? } ?>	
				</tbody>
				<tfoot>
				<tr>
					<td height="40" colspan="8" align="center">
						<!-- �⺻ paging -->
						<ul>
							<?=$pageList?>
						</ul>
					</td>
				</tr>
				<tr>
				<td colspan="8">
					<a href="<?=$pageUrl?>&page=/pages/admin/member/join.php"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="���"/></a>
				</td>
			</tr>
				<tr>
					<td height="34" colspan="8" align="center">
						<select name="search" id="searchCol" title="�˻��з�">
							<option value='user_id'		<? if ($search == "" or $search == "user_id" )	{ ?>selected<? } ?>>ID(���̵�)	</option>
						</select>
						<input type='text' name="keyword" size=20 maxlength=20 value="<?=$keyword?>" class="vmiddle" />
						<input type="image" src="/pages/admin/images/bbs/btn_search.gif" value="�˻�" alt="�˻�" class="vmiddle" />
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
