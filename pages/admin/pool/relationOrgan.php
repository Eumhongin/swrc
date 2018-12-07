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

	if($selectOrganKind != ""){
		$selectOrganQuery = " AND organ_kind_idx = '$selectOrganKind' ";
	}else{
		$selectOrganQuery = "  ";
	}

	// *** 총 게시물 수 ***
	$total_qry  = " SELECT organ_idx ";
	$total_qry .= " FROM t_relation_organ AS A ";
	$total_qry .= " WHERE 1 = 1 ";
	$total_qry .= $searchQry;
	$total_qry .= $selectOrganQuery;
	$mysql->ParseExec($total_qry);
	$total = $mysql->RowCount();

	$PostNum = 10;
	$a_pagesu = 10;

	// *** 게시물 수, 페이지 수 ***
	if(empty($pageIdx)) $pageIdx = 1;

	$StartNum = ( $pageIdx - 1 ) * $PostNum;

	// *** 페이징 ***
	$pg = new initPage($pageIdx, $PostNum);
	$pageList = $pg->getPageList($pageParameter, "searchKeyWord=$searchKeyWord&amp;searchCol=$searchCol", $total, $a_pagesu);	

?>	
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
		<title>유관기관</title>
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
<?
	$kindQuery  = " Select * from t_relation_organ_kind ";
	$kindQuery .= " Order by idx ";

	$mysql->ParseExec($kindQuery);
?>
			    현재 등록된 기관 분류 : 
				<select name="selectOrganKind" onchange="fncChengeSelect();">
					<option value="">전체보기</option>
					<option value="0" <?if($selectOrganKind == "0"){?>selected<?}?>>분류없음</option>
					<?while($mysql->FetchInto(&$kindCol)){?>
						<option value="<?=$kindCol[idx]?>" <?if($selectOrganKind == $kindCol[idx]){?>selected<?}?> ><?=$kindCol[kind_name]?></option>
					<?}?>
				</select>
				&nbsp;&nbsp;&nbsp;
				<a href="<?=$pageUrl?>&page=/pages/admin/pool/relationOrganKind.php">
					<span class="f_orange bold">[분류 등록]</span>
				</a>
			</td>
			<td class="aright">
				<img src="/pages/admin/images/common/bullet_box_gray.gif"> 검색된 게시물 : <?=$total?>개
			</td>
		  </tr>
		</table>
		<table class="bbsCont" cellspacing="0" summary="유관기관 목록 보기">
			<colgroup>
				<col width="7%"/>
				<col />
				<col width="40%"/>
				<col width="13%"/>
				<col width="10%"/>
				<col width="10%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">기관명</th>
					<th scope="col">주소</th>
					<th scope="col">전화번호</th>
					<th scope="col">홈페이지</th>
					<th scope="col">등록일</th>
				</tr>
			</thead>
			<tbody>
<?
	// *** 게시물 리스트 ***
	$qry  = " SELECT organ_idx, organ_name, organ_zip_code, organ_address, organ_address_detail, "; 
	$qry .= " organ_tel, organ_homepage, organ_kind_idx, ";
	$qry .= " date_format(organ_date, '%Y/%m/%d') AS organ_date  ";
	$qry .= " FROM t_relation_organ ";
	$qry .= " WHERE 1 = 1 ";
	$qry .= $searchQry;
	$qry .= $selectOrganQuery;
	$qry .= " ORDER BY organ_idx DESC ";
	$qry .= " Limit $StartNum, $PostNum ";
	$mysql->ParseExec($qry);
	
	if($total > 0){

		if($pageIdx == 1) $num = $total;
		else $num = $total - ( $pageIdx -1 ) * $PostNum;

		while($mysql->FetchInto(&$col)){
?>
				<tr>
					<td class="fir"><?=$num?></td>
					<td class="tal">
						<a href="<?=$pageUrl?>&page=/pages/admin/pool/relationOrganWriteForm.php&mode=edit&organ_idx=<?=$col[organ_idx]?>">
							<font color="blue"><?=$col[organ_name]?></font>
						</a>
					</td>
					<td class="tal">
						<?=$col[organ_address]?> <?=$col[organ_address_detail]?> (<?=$col[organ_zip_code]?>)
					</td>
					<td><?=$col[organ_tel]?></td>
					<td><?=$col[organ_homepage]?></td>
					<td>
						<?=$col[organ_date]?>
					</td>
				</tr>
<?
			$num--;
		}

	}else{
?>
				<tr>
					<td colspan="6">
						등록된 유관기관이 없습니다.
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
						<a href="<?=$pageUrl?>&page=/pages/admin/pool/relationOrganWriteForm.php"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록"/></a>
					</td>
				</tr>
				<tr>
					<td colspan="6">
						
							<select name="searchCol" id="searchCol" title="검색분류">
								<option value="organ_name" <?if($searchCol == "organ_name"){?>selected<?}?>>기관명</option>
								<option value="organ_address" <?if($searchCol == "organ_address"){?>selected<?}?>>주소</option></option>
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