<?
	// *** 페이징 class ***
	include ("../../config/page_manager_admin.php");
	include ("../../config/mysql.inc.php");

	$pageIdx = $_REQUEST["pageIdx"];
	$idx = $_REQUEST["idx"];

	$pageParameter = $pageUrl.$pageName."&page=".$page;
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();


	// *** 총 게시물 수 ***
	$total_qry  = " SELECT idx ";
	$total_qry .= " FROM t_image_window WHERE 1 = 1 ";
	$mysql->ParseExec($total_qry);
	$total = $mysql->RowCount();

	$PostNum = 10;
	$a_pagesu = 10;

	// *** 게시물 수, 페이지 수 ***
	if(empty($pageIdx)) $pageIdx = 1;

	$StartNum = ( $pageIdx - 1 ) * $PostNum;

	// *** 페이징 ***
	$pg = new initPage($pageIdx, $PostNum);
	$pageList = $pg->getPageList($pageParameter, "", $total, $a_pagesu);	

?>
<script type="text/javascript">
	function imageWindowDelete(idx){
		if(confirm("삭제 하시겠습니까?")) {
			document.location.href="<?= $pageUrl ?>&page=/pages/admin/imageWindow/imageWindowWrite.php&idx=" + idx +"&mode=delete";
		}
	}
</script>
	<!-- 내용 -->
		<p class="contTitle">검색된 게시물 : <?=$total?>개</p>
		<table class="bbsCont" cellspacing="0" summary="알림창 목록 보기">
			<colgroup>
				<col width="8%"/>
				<col width="20%"/>
				<col />
				<col width="10%"/>
				<col width="8%"/>
				<col width="8%"/>
				<col width="10%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">이미지</th>
					<th scope="col">제목</th>
					<th scope="col">등록일</th>
					<th scope="col">사용여부</th>
					<th scope="col">순서</th>
					<th scope="col">수정/삭제</th>
				</tr>
			</thead>
			<tbody>
<?
	// *** 게시물 리스트 ***
	$qry  = " SELECT idx, image_name, image_alt, image_link, image_target, window_name, "; 
	$qry .= " date_format(image_regist_date, '%Y/%m/%d') AS image_regist_date, image_use_flag, image_order  ";
	$qry .= " FROM t_image_window ";
	$qry .= " ORDER BY image_order DESC ";
	$qry .= " Limit $StartNum, $PostNum ";
	$mysql->ParseExec($qry);
	
	if($total > 0){

		if($pageIdx == 1) $num = $total;
		else $num = $total - ( $pageIdx -1 ) * $PostNum;

		while($mysql->FetchInto(&$col)){
?>
				<tr>
					<td><?=$num?></td>
					<td>
						<img src="/up_file/imageWindow/<?=utf8ToEuckr($col[image_name])?>" width="150" height="90" />
					</td>
					<td class="tal">
						<?=utf8ToEuckr($col[window_name])?>
					</td>
					<td><?=$col[image_regist_date]?></td>
					<td>
						<?if($col[image_use_flag] == "Y"){?>
							사용중
						<?}else{?>
							중지
						<?}?>
					</td>
					<td>
						<a href="<?=$pageUrl?>&page=/pages/admin/imageWindow/imageWindowOrderEdit.php&idx=<?=$col[idx]?>&order=<?=$col[image_order]?>&mode=up">▲</a>
						<a href="<?=$pageUrl?>&page=/pages/admin/imageWindow/imageWindowOrderEdit.php&idx=<?=$col[idx]?>&order=<?=$col[image_order]?>&mode=down">▼</a>
					</td>
					<td>
						<a href="<?= $pageUrl ?>&amp;page=/pages/admin/imageWindow/imageWindowWriteForm.php&amp;idx=<?= $col[idx] ?>&mode=edit" title="알림창을 수정합니다.">
							<img src="/pages/admin/images/bbs/btn_modify.gif" alt="수정"/>
						</a>

						<a href="javascript:imageWindowDelete('<?= $col[idx] ?>');" title="알림창을 삭제합니다.">
							<img src="/pages/admin/images/bbs/btn_delete.gif" alt="삭제"/>
						</a>

					</td>

				</tr>
<?
			$num--;
		}

	}else{
?>
				<tr>
					<td colspan="7">
						등록된 알림창이 없습니다.
					</td>
				</tr>
<?
	}	
?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="7">
						<!-- 기본 paging -->
						<ul>
							<?=$pageList?>
						</ul>
					</td>
				</tr>
				<tr>
					<td colspan="7">
						<a href="<?=$pageUrl?>&page=/pages/admin/imageWindow/imageWindowWriteForm.php"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록"/></a>
					</td>
				</tr>
			</a>
			</tfoot>
		</table>
<?
	$mysql->Disconnect();
?>