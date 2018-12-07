<?

  session_start();
  include("../../config/bbs_lib.inc.php");
  include("../../config/mysql.inc.php");
  include("../../config/page_manager_admin.php"); 

  $mysql = new Mysql_DB;
  $mysql->Connect();

$pageUrl .= $pageName;

$a_idx2 = $a_idx;

// *** 게시판 존재 여부 ******************************************************************************************
  Bbs_Config($a_idx);

  // *** 삭제 권한(관리자만) ***
  if(!(($m_list == "Y" and $m_power == "2")  or $adminstrator == true)) {
      message("권한이 없습니다");
  } 

  $qry  = "Select b_subject From $a_tablename Where b_num = $b_num";
	$mysql->ParseExec($qry);
	if ($mysql->RowCount() < 1) {

		 message("등록된 글이 존재하지 않습니다");
	
	} else {

			$mysql->FetchInto(&$row);
      $b_subject = $row[b_subject];
  }
  
// *** 신청된 세미나 ************************************************************************************************
   $q_search = " Where s_tablename='$a_tablename' and b_num='$b_num'";
  // *** 총 게시물 수 ***
	$total_qry  = "Select * From seminar";
	$total_qry .= $q_search;
	$mysql->ParseExec($total_qry); 
	$total = $mysql->RowCount();
	  
	$PostNum  = $a_displaysu;
  $WidthNum = $a_pagesu;
	
  if (empty($pageIdx)) $pageIdx = 1;
  $StartNum = ( $pageIdx - 1 ) * $PostNum;

  // *** 페이징 *****
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

			<table class="bbsCont" cellspacing="0" summary="세미나 신청자 목록을 나타내는 표">
				<caption class="none">세미나</caption>
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
						<th scope="col" class="first-child">번호</th>
						<th scope="col">이름</th>
						<th scope="col">소속</th>
						<th scope="col">직위</th>
						<th scope="col">E-mail</th>
						<th scope="col">전화번호</th>
						<th scope="col">등록날짜</th>
						<th scope="col">비고</th>
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
						<a href="/pages/bbs/seminar.php?a_idx=<?=$a_idx?>&b_num=<?=$b_num?>&s_num=<?=$s_num?>" target="displayWindow" onclick="childwin=window.open('','displayWindow', 'toolbar=no,scrollbars=no,width=500,height=280,top=30,left=30');" title="새창열림">수정</a>
						/
						<a href="/pages/bbs/seminar_ok.php?mode=delete&a_idx=<?=$a_idx?>&b_num=<?=$b_num?>&s_num=<?=$s_num?>" onclick="del_seminar('<?=$a_idx ?>','<?=$b_num ?>','<? echo $s_num ?>'); return false;">
						삭제</a>
					</td>
				</tr>
				<?
					}
				}else{
				?>
				<tr>
					<td colspan="8">등록된 세미나 신청자가 없습니다.</td>
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
								<img src="/pages/admin/images/bbs/btn_excel_big.gif" alt="엑셀출력" />
							</a>
							<a href="<?=$pageUrl?>&page=/pages/admin/bbs/list.php&a_idx=<?=$a_idx?>"><img src="/images/bbs/btn_list.gif" alt="목록"></a>
						</td>
					</tr>
				</tfoot>
			</table>