<?

  session_start();
  include("../../config/bbs_lib.inc.php");
  include("../../config/mysql.inc.php");
  include("../../config/page_manager_admin.php"); 

  $mysql = new Mysql_DB;
  $mysql->Connect();

$pageUrl .= $pageName;

$a_idx2 = $a_idx;

// *** �Խ��� ���� ���� ******************************************************************************************
  Bbs_Config($a_idx);

  // *** ���� ����(�����ڸ�) ***
  if(!(($m_list == "Y" and $m_power == "2")  or $adminstrator == true)) {
      message("������ �����ϴ�");
  } 

  $qry  = "Select b_subject From $a_tablename Where b_num = $b_num";
	$mysql->ParseExec($qry);
	if ($mysql->RowCount() < 1) {

		 message("��ϵ� ���� �������� �ʽ��ϴ�");
	
	} else {

			$mysql->FetchInto(&$row);
      $b_subject = $row[b_subject];
  }
  
// *** ��û�� ���̳� ************************************************************************************************
   $q_search = " Where s_tablename='$a_tablename' and b_num='$b_num'";
  // *** �� �Խù� �� ***
	$total_qry  = "Select * From seminar";
	$total_qry .= $q_search;
	$mysql->ParseExec($total_qry); 
	$total = $mysql->RowCount();
	  
	$PostNum  = $a_displaysu;
  $WidthNum = $a_pagesu;
	
  if (empty($pageIdx)) $pageIdx = 1;
  $StartNum = ( $pageIdx - 1 ) * $PostNum;

  // *** ����¡ *****
	$pg = new initPage($pageIdx,$PostNum);
	$pageList = $pg->getPageList( $pageUrl."&page=/pages/bbs/admin/seminar_list.php", "category=$category&keyword=$keyword&search=$search&a_idx=$a_idx&b_num=$b_num&look=$look", $total, $a_pagesu);

  $qry  = " Select * From seminar ";
  $qry .= " $q_search Order by s_num Desc";
  $qry .= " Limit $StartNum, $PostNum";
  $mysql->ParseExec($qry); 
?>
<script type="text/javascript" src="/pages/bbs/js/comm.js"></script>
<script type="text/javascript" src="/config/common.js"></script>
<script type="text/javascript" src="/pages/bbs/js/comm.js"></script>

			<table class="bbsCont" cellspacing="0" summary="���̳� ��û�� ����� ��Ÿ���� ǥ">
				<caption class="none">���̳�</caption>
				<colgroup>
					<col width="6%" />
					<col width="10%" />
					<col width="15%" />
					<col width="12%" />
					<col  />
					<col width="15%" />
					<col width="12%" />
					<col width="10%" />
				</colgroup>
				<thead>
					<tr>
						<th scope="col" class="first-child">��ȣ</th>
						<th scope="col">�̸�</th>
						<th scope="col">�Ҽ�</th>
						<th scope="col">����</th>
						<th scope="col">E-mail</th>
						<th scope="col">��ȭ��ȣ</th>
						<th scope="col">��ϳ�¥</th>
						<th scope="col">���</th>
					</tr>
				</thead>
				<tbody>
				<?if($total > 0){
					if($pageIdx == 1)   $num = $total;
					else $num = $total - ( $pageIdx - 1 ) * $PostNum;	

					while($mysql->FetchInto(&$col)) {  
						$s_num      = $col["s_num"];
						$s_name     = $col["s_name"];
						$s_email    = $col["s_email"];
						$s_company  = $col["s_company"];
						$s_level    = $col["s_level"];
						$s_tel      = $col["s_tel"];
						$s_regdate  = explode(" ", $col["s_regdate"]);						
				?>
				<tr>
					<td><?=$num--?></td>
					<td><?=$s_name?></td>
					<td><?=$s_company?></td>
					<td><?=$s_level?></td>
					<td><a href="mailto:<?=$s_email?>"><?=$s_email?></a></td>
					<td><?=$s_tel?></td>
					<td><?=$s_regdate[0]?></td>
					<td>
						<a href="/pages/bbs/seminar.php?a_idx=<?=$a_idx?>&b_num=<?=$b_num?>&s_num=<?=$s_num?>" target="displayWindow" onclick="childwin=window.open('','displayWindow', 'toolbar=no,scrollbars=no,width=500,height=280,top=30,left=30');" title="��â����">����</a>
						/
						<a href="/pages/bbs/seminar_ok.php?mode=delete&a_idx=<?=$a_idx?>&b_num=<?=$b_num?>&s_num=<?=$s_num?>" onclick="del_seminar('<?=$a_idx ?>','<?=$b_num ?>','<? echo $s_num ?>'); return false;">
						����</a>
					</td>
				</tr>
				<?
					}
				}else{
				?>
				<tr>
					<td colspan="8">��ϵ� ���̳� ��û�ڰ� �����ϴ�.</td>
				</tr>
				<?}?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="8">
							<ul>
								<?=$pageList?>
							</ul>
						</td>
					</tr>
					<tr>
						<td colspan="8">
							<a href="/pages/bbs/seminar_excel.php?a_idx=<?=$a_idx?>&b_num=<?=$b_num?>">
								<img src="/pages/admin/images/bbs/btn_excel_big.gif" alt="�������" />
							</a>
							<a href="<?=$pageUrl?>&page=/pages/admin/bbs/list.php&a_idx=<?=$a_idx?>"><img src="/images/bbs/btn_list.gif" alt="���"></a>
						</td>
					</tr>
				</tfoot>
			</table>