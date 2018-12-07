<?
	// *** 페이징 class ***
	include ("../../config/page_manager_admin.php");
	include ("../../config/mysql.inc.php");

	$pageParameter = $pageUrl.$pageName."&page=".$page;
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	//조직 코드 기본으로 1
	if($sel_organ_code == "") $sel_organ_code = "1";

	// *** 총 게시물 수 ***
	$total_qry  = " SELECT idx ";
	$total_qry .= " FROM t_organ WHERE organ_code = '".$sel_organ_code."' ";
	$mysql->ParseExec($total_qry);
	$total = $mysql->RowCount();

	$PostNum = 15;
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
			document.location.href="<?= $pageUrl ?>&page=/pages/admin/member/organWrite.php&idx=" + idx +"&mode=delete";
		}
	}

	function fncChengeSelect(){
		document.search_frm.submit(); 
	}
</script>
	<!-- 내용 -->

		<form name="search_frm" method="post">
		<table width="100%" height="26" cellpadding="0" cellspacing="0">
		  <tr>
			<td>
				<img src="/pages/admin/images/common/bullet_box_gray.gif"> 검색된 게시물 : <?=$total?>개
			</td>
			<td class="aright">
				<select name="sel_organ_code" onchange="fncChengeSelect();">
					<option value="1" <?if($sel_organ_code == "1"){?>selected<?}?> >경영지원실</option>
					<option value="2" <?if($sel_organ_code == "2"){?>selected<?}?> >IT(융합SW)사업부</option>
					<option value="3" <?if($sel_organ_code == "3"){?>selected<?}?> >CT(문화콘텐츠)사업부</option>
					<option value="4" <?if($sel_organ_code == "4"){?>selected<?}?> >영상미디어센터</option>
					<option value="5" <?if($sel_organ_code == "5"){?>selected<?}?> >미래전략TF</option>
				</select>
			</td>
		  </tr>
		</table>
		</form>

		<table class="bbsCont" cellspacing="0" summary="조직도 목록 보기">
			<colgroup>
				<col width="8%"/>
				<col />
				<col width="10%"/>
				<col width="10%"/>
				<col width="10%"/>
				<col width="15%"/>
				<col width="8%"/>
				<col width="10%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">이름</th>
					<th scope="col">전화번호</th>
					<th scope="col">직위</th>
					<th scope="col">메일</th>
					<th scope="col">부서</th>
					<th scope="col">순서</th>
					<th scope="col">수정/삭제</th>
				</tr>
			</thead>
			<tbody>
<?
	// *** 게시물 리스트 ***
	$qry  = " SELECT idx, name, grade, tel, email, image_name, "; 
	$qry .= " organ_order, organ_code";
	$qry .= " FROM t_organ ";
	$qry .= " Where organ_code = '".$sel_organ_code."' ";
	$qry .= " ORDER BY organ_order DESC ";
	$qry .= " Limit $StartNum, $PostNum ";
	$mysql->ParseExec($qry);
	
	if($total > 0){

		if($pageIdx == 1) $num = $total;
		else $num = $total - ( $pageIdx -1 ) * $PostNum;

		while($mysql->FetchInto(&$col)){
?>
				<tr>
					<td><?=$num?></td>
					<td class="tal">
						<?=$col[name]?>
					</td>
					<td>
						<?=$col[tel]?>
					</td>
					<td><?=$col[grade]?></td>
					<td>
						<?=$col[email]?>
					</td>
					<td>

						<?
							if($col[organ_code] == "1"){
								echo "경영지원실";
							}else if($col[organ_code] == "2"){
								echo "IT(융합SW)사업부";
							}else if($col[organ_code] == "3"){
								echo "CT(문화콘텐츠)사업부";
							}else if($col[organ_code] == "4"){
								echo "영상미디어센터";
							}else if($col[organ_code] == "5"){
								echo "미래전략TF팀";
							}
						?>
					</td>
					<td>
						<a href="<?=$pageUrl?>&page=/pages/admin/member/organOrderEdit.php&idx=<?=$col[idx]?>&order=<?=$col[organ_order]?>&mode=up&organ_code=<?=$col[organ_code]?>">▲</a>
						<a href="<?=$pageUrl?>&page=/pages/admin/member/organOrderEdit.php&idx=<?=$col[idx]?>&order=<?=$col[organ_order]?>&mode=down&organ_code=<?=$col[organ_code]?>">▼</a>
					</td>
					<td>
						<a href="<?= $pageUrl ?>&amp;page=/pages/admin/member/organWriteForm.php&amp;idx=<?= $col[idx] ?>&mode=edit" title="조직을 수정합니다.">
							<img src="/pages/admin/images/bbs/btn_modify.gif" alt="수정"/>
						</a>

						<a href="javascript:imageWindowDelete('<?= $col[idx] ?>');" title="조직을 삭제합니다.">
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
					<td colspan="8">
						등록된 조직 정보가 없습니다.
					</td>
				</tr>
<?
	}	
?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="8">
						<!-- 기본 paging -->
						<ul>
							<?=$pageList?>
						</ul>
					</td>
				</tr>
				<tr>
					<td colspan="8">
						<a href="<?=$pageUrl?>&page=/pages/admin/member/organWriteForm.php&sel_organ_code=<?=$sel_organ_code?>"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록"/></a>
					</td>
				</tr>
			</a>
			</tfoot>
		</table>
<?
	$mysql->Disconnect();
?>