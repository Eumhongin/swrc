<?
	// *** 페이징 class ***
	include ("../../config/page_manager_admin.php");
	include ("../../config/mysql.inc.php");

	$pageParameter = $pageUrl.$pageName."&page=".$page;
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	// ** 검색어
	if(!empty($searchKeyWord)){
		$searchQry = " AND ".$searchCol." like '%$searchKeyWord%' ";
	}

	switch ($organ){
		case "1" :
			$organQuery = " AND pool_select_organ = '대학교' ";
		break;
		case "2" :
			$organQuery = " AND pool_select_organ = '연구소' ";
		break;
		case "3" :
			$organQuery = " AND pool_select_organ = '기관' ";
		break;
		case "4" :
			$organQuery = " AND pool_select_organ = '기업' ";
		break;
		case "5" :
			$organQuery = " AND pool_select_organ = '기타' ";
		break;
		default :
			$organQuery  = "  ";
		break;

	}

	switch ($selectApprove){
		case "yes" :
			$ApproveQuery = " AND pool_approve_flag = 'Y' ";
		break;
		case "no" :
			$ApproveQuery = " AND pool_approve_flag = 'N' ";
		break;
		default :
			$ApproveQuery  = "  ";
		break;

	}

	// *** 총 게시물 수 ***
	$total_qry  = " SELECT pool_idx ";
	$total_qry .= " FROM t_pool WHERE 1 = 1 ";
	$total_qry .= $searchQry;
	$total_qry .= $organQuery;
	$total_qry .= $ApproveQuery;
	$mysql->ParseExec($total_qry);
	$total = $mysql->RowCount();

	$PostNum = 10;
	$a_pagesu = 10;

	// *** 게시물 수, 페이지 수 ***
	if(empty($pageIdx)) $pageIdx = 1;

	$StartNum = ( $pageIdx - 1 ) * $PostNum;

	// *** 페이징 ***
	$pg = new initPage($pageIdx, $PostNum);
	$pageList = $pg->getPageList($pageParameter, "searchKeyWord=$searchKeyWord&amp;searchCol=$searchCol&amp;organ=$organ", $total, $a_pagesu);	

?>	
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
		<title>POOL</title>
	<script type="text/javascript">
		function fncChengeSelect(){
			document.search_frm.submit(); 
		}
	</script>
	</head>
	<body>

	<!-- 내용 -->
		<form name="search_frm" method="post">
		<table width="100%" height="26" cellpadding="0" cellspacing="0">
		  <tr>
			<td>
				<img src="/pages/admin/images/common/bullet_box_gray.gif"> 검색된 게시물 : <?=$total?>개
			</td>
			<td class="aright">
				<select name="organ" onchange="fncChengeSelect();">
					<option value="">소속분류선택</option>
					<option value="1" <?if($organ == "1"){?>selected<?}?> >대학교</option>
					<option value="2" <?if($organ == "2"){?>selected<?}?> >연구소</option>
					<option value="3" <?if($organ == "3"){?>selected<?}?> >기관</option>
					<option value="4" <?if($organ == "4"){?>selected<?}?> >기업</option>
					<option value="5" <?if($organ == "5"){?>selected<?}?> >기타</option>					
				</select>
				&nbsp;&nbsp;&nbsp;
				<select name="selectApprove" onchange="fncChengeSelect();">
					<option value="">등록현황</option>
					<option value="yes" <?if($selectApprove == "yes"){?>selected<?}?> >승인완료</option>
					<option value="no" <?if($selectApprove == "no"){?>selected<?}?> >승인대기</option>
				</select>
			</td>
		  </tr>
		</table>
		<table class="bbsCont" cellspacing="0" summary="전문가 목록 보기">
			<colgroup>
				<col width="8%"/>
				<col width="10%"/>
				<col />
				<col width="10%"/>
				<col width="10%"/>
				<col width="10%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">이름</th>
					<th scope="col">전공분야 및 주요컨설팅 분야</th>
					<th scope="col">소속분류</th>
					<th scope="col">신청일</th>
					<th scope="col">등록현황</th>
				</tr>
			</thead>
			<tbody>
<?
	// *** 게시물 리스트 ***
	$qry  = " SELECT pool_idx, pool_name, pool_major, pool_select_organ, "; 
	$qry .= " date_format(pool_approve_date, '%Y/%m/%d') AS pool_approve_date, pool_approve_flag  ";
	$qry .= " FROM t_pool ";
	$qry .= " WHERE 1 = 1 ";
	$qry .= $searchQry;
	$qry .= $organQuery;
	$qry .= $ApproveQuery;
	$qry .= " ORDER BY pool_idx DESC ";
	$qry .= " Limit $StartNum, $PostNum ";
	$mysql->ParseExec($qry);
	
	if($total > 0){

		if($pageIdx == 1) $num = $total;
		else $num = $total - ( $pageIdx -1 ) * $PostNum;

		while($mysql->FetchInto(&$col)){
?>
				<tr>
					<td><?=$num?></td>
					<td><?=$col[pool_name]?> </td>
					<td class="tal">
						<a href="<?=$pageUrl?>&page=/pages/admin/pool/poolView.php&pool_idx=<?=$col[pool_idx]?>"><?=$col[pool_major]?></a>
					</td>
					<td><?=$col[pool_select_organ]?></td>
					<td><?=$col[pool_approve_date]?></td>
					<td>
						<?if($col[pool_approve_flag] == "Y"){?>
						승인완료
						<?}else{?>
						승인대기
						<?}?>
					</td>
				</tr>
<?
			$num--;
		}

	}else{
?>
				<tr>
					<td colspan="6">
						등록된 전문가가 없습니다.
					</td>
				</tr>
<?
	}	
?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6">
						<!-- 기본 paging -->
						<ul>
							<?=$pageList?>
						</ul>
					</td>
				</tr>
				<tr>
					<td colspan="6">
						<a href="<?=$pageUrl?>&page=/pages/admin/pool/poolWriteForm.php"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록"/></a>
					</td>
				</tr>
				<tr>
					<td colspan="6">
						
							<select name="searchCol" id="searchCol" title="검색분류">
								<option value="pool_name" <?if($searchCol == "pool_name"){?>selected<?}?>>이름</option>
								<option value="pool_organ" <?if($searchCol == "pool_organ"){?>selected<?}?>>기관</option>
								<option value="pool_major" <?if($searchCol == "pool_major"){?>selected<?}?>>전공</option>
							</select>
							<input type="text" name="searchKeyWord" value="<?=$searchKeyWord?>" id="searchKeyWord" class="basic" title="검색어" />
							<input type="image" src="/pages/admin/images/bbs/btn_search.gif" value="검색" alt="검색" class="vmiddle" />
					</td>
				</tr>
			</tfoot>
		</table>
		</form>
	</body>
</html>
<?
	$mysql->Disconnect();
?>