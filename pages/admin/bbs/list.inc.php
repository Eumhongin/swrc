<? 
// *** 페이징 class *****
include("../../config/page_manager_admin.php"); 

	$pageUrl .= $pageName;

// *** 검색 쿼리 ****
//관리자 승인 기능 사용시
if($a_admin_check == "Y" ){
	if($m_power == "2" or $adminstrator == true) {
		if($look <> "")	$q_search = " b_look = '$look' ";
		else $q_search = " b_look <> '' ";
	} else {
		$q_search = " b_look = 0 ";
		
	}
}else{ //관리자 승인기능 사용치 않을 경우
	$q_search = " b_look <> '' ";
}

if($a_reply == "Y" and $a_reply_type == "1"){ $q_search .= " And b_step = 0 "; }
if($a_category == "Y" and $category <>"")	{ $q_search .= " And b_category = $category "; }
if($keyword <> "")							{ $q_search .= " And b_$search Like '%$keyword%' "; }


//관리자 승인 기능 사용시
if($a_admin_check == "Y" ){
	if($m_power != "2" and $adminstrator == false) {
		//로그인 되어 있으면
		if($HTTP_SESSION_VARS[duid] != ""){
			$q_search .= " Or b_id = '".$HTTP_SESSION_VARS[duid]."' ";
		}
	}
}


// *** 정렬 ***
$q_order = Bbs_Orderby();	

// *** 총 게시물 수 ***
	$total_qry  = "Select * From $a_tablename";
	$total_qry .= " Where ";
	$total_qry .= $q_search;
	$mysql->ParseExec($total_qry); 
	$total = $mysql->RowCount();
	

// *** 게시물 수, 페이지수 ***
if (empty($pageIdx)) $pageIdx = 1;

if ($a_photo == "N") {  // 이미지 게시판 일 경우
	$PostNum = $a_displaysu;
} else {               // 일반 게시판 일 경우 
	$PostNum  = $a_photo_cols * $a_photo_rows;
}		

$WidthNum = $a_pagesu;
$StartNum = ( $pageIdx - 1 ) * $PostNum;

// *** top 공지 ***
$top_qry  = "Select * From $a_tablename Where b_top = 'Y' ";

//관리자 승인 기능이 설정되어 있을 경우
if($a_admin_check == "Y" ){
	//권한이 없으면
	if(!($m_power == "2" or $adminstrator == true)) { 
		$top_qry  .= "And b_look = '0' ";
		//로그인 되어 있으면
		if($HTTP_SESSION_VARS[duid] != ""){
			$top_qry .= " Or b_id = '".$HTTP_SESSION_VARS[duid]."' ";
		}
	}
}

if($a_category == "Y" and $category <>"")		{ $top_qry  .= "And b_category=$category "; }
$top_qry  .= "Order by b_top desc, b_num desc";

$mysql->ParseExec($top_qry); 
$top_total = $mysql->RowCount();


// *** 페이징 *****
$pg = new initPage($pageIdx,$PostNum);
$pageList = $pg->getPageList( $pageUrl, "&page=/pages/admin/bbs/list.php&category=$category&keyword=$keyword&search=$search&a_idx=$a_idx&b_num=$real_num&look=$look&mnu_name=$mnu_name", $total - $top_total, $a_pagesu);

?>

<script type="text/javascript" src="/pages/bbs/js/comm.js"></script>
<script type="text/javascript">
function roundTable(objID) {
	var obj = document.getElementById(objID);
	var Parent, objTmp, Table, TBody, TR, TD;
	var bdcolor, bgcolor, Space;
	var trIDX, tdIDX, MAX;
	var styleWidth, styleHeight;

	// get parent node
	Parent = obj.parentNode;
	objTmp = document.createElement('SPAN');
	Parent.insertBefore(objTmp, obj);
	Parent.removeChild(obj);

	// get attribute
	bdcolor = obj.getAttribute('rborder');
	bgcolor = obj.getAttribute('rbgcolor');
	radius = parseInt(obj.getAttribute('radius'));
	if (radius == null || radius < 1) radius = 1;
	else if (radius > 6) radius = 6;

	MAX = radius * 2 + 1;

	/*
	create table {{
	*/
	Table = document.createElement('TABLE');
	TBody = document.createElement('TBODY');

	Table.cellSpacing = 0;
	Table.cellPadding = 0;

	for (trIDX=0; trIDX < MAX; trIDX++) {
		TR = document.createElement('TR');
		Space = Math.abs(trIDX - parseInt(radius));
		for (tdIDX=0; tdIDX < MAX; tdIDX++) {
			TD = document.createElement('TD');

			styleWidth = '1px'; styleHeight = '1px';
			if (tdIDX == 0 || tdIDX == MAX - 1) styleHeight = null;
			else if (trIDX == 0 || trIDX == MAX - 1) styleWidth = null;
			else if (radius > 2) {
				if (Math.abs(tdIDX - radius) == 1) styleWidth = '2px';
				if (Math.abs(trIDX - radius) == 1) styleHeight = '2px';
			}

			if (styleWidth != null) TD.style.width = styleWidth;
			if (styleHeight != null) TD.style.height = styleHeight;

			if (Space == tdIDX || Space == MAX - tdIDX - 1) TD.style.backgroundColor = bdcolor;
			else if (tdIDX > Space && Space < MAX - tdIDX - 1)  TD.style.backgroundColor = bgcolor;

			if (Space == 0 && tdIDX == radius) TD.appendChild(obj);
			TR.appendChild(TD);
		}
		TBody.appendChild(TR);
	}

	/*
	}}
	*/

	Table.appendChild(TBody);

	// insert table and remove original table
	Parent.insertBefore(Table, objTmp);
}
</script>

<?
// ***************** 일 반 게 시 판  시 작************************************************************************
if ($a_photo == "N") { ?>
	
	<form name="frm" method="post" action="<?=$pageUrl?>&amp;page=/pages/admin/bbs/list.php&amp;a_idx=<?=$a_idx?>">
	<input type="hidden" name="pageIdx" value="1">
	<table width="100%" height="26" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<img src="/pages/admin/images/common/bullet_box_gray.gif"> 전체 <?=$totalPage?> / 페이지 <?=$pageIdx?>
			</td>
			<td >
				<? if($a_category == "Y" ){ //카테고리 사용 시?>
				<p class="floatright mar_b5">
					<select name="category" id="category" title="카테고리">
						<option value="">전체</option>
						<? // *** 게시판 카테고리
							$mysql2 = new Mysql_DB;
							$mysql2->Connect();

							$sql =  " Select c_cate,c_catename From bbs_admin_cate Where c_use ='1' and c_tablename = '$a_tablename' Order by c_cate";
							$mysql2->ParseExec($sql);

							while($mysql2->FetchInto(&$cate)){ ?>
								<option value="<?=$cate[c_cate] ?>" <? if($cate[c_cate] == $category) {?>selected<?}?>><?=$cate[c_catename] ?></option>
							<?}?>
					</select>
					<button type="button" onclick="frm.submit();"><img src="/images/bbs/btn_go.gif" alt="GO" class="vmiddle" /></button>
				</p>
				<?} //End if($a_category == "Y")?>
				<? if((($m_power == "2" and $m_modify == "Y" and $m_del == "Y") or $adminstrator == true) and $a_admin_check == "Y") {  // 관리자만 사용
				?>
				<p class="floatright mar_t5">
					<a href="javascript:AllCheck('add')">[전체선택]</a>
					<a href="javascript:AllCheck('del')">[선택해제]</a>
					<a href="javascript:look_checkfrm('삭제','<?=$a_idx ?>','3', '', '<?=$pageUrl?>')">[삭제]</a>
					<a href="javascript:look_checkfrm('공개','<?=$a_idx ?>','0', '','<?=$pageUrl?>')">[승인]</a>
					<a href="javascript:look_checkfrm('비공개','<?=$a_idx ?>','1', '','<?=$pageUrl?>')">[미승인]</a>
				</p>
				<? } ?>
			</td>
		</tr>
	</table>
<?
	//컬럼의 개수. 기본적으로 4개
	$colCount = 4;					
?>
	<table class="bbsCont" cellspacing="0" summary="<?=$a_bbsname?> 목록을 나타내는 표">
		<caption class="none"><?=$a_bbsname?></caption>
			<colgroup>
				<col width="5%" />
				<col  />
				<?if($a_upload == "Y"){ //파일 첨부 게시판일 경우
					$colCount++;?>
					<col width="8%" />						
				<?}?>
				<col width="10%" />
				<col width="10%" />
				<?
					$colCount++;
				?>
					<col width="7%" />
				<? if($a_reply == "Y" and $a_reply_type =="1") { 
					$colCount++;
				?>
					<col width="10%" />
				<?}?>
				<? if($a_category == "Y") { //카테고리일 경우
					$colCount++;
				?>
					<col width="10%" />
				<?}?>
				<?if(($m_power == "2" or $adminstrator == true) and $a_admin_check == "Y"){ //관리자만 사용
					$colCount += 2;
				?>
					<col width="7%" />
					<col width="10%" />
				<?}?>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">
						<?if($a_idx == "I_040320094455" and $category == 50){?>
						업체
						<?}else{?>
						제목
						<?}?>
					</th>
					<?if($a_upload == "Y"){ //파일 첨부 게시판일 경우?>
					<th scope="col">첨부</th>
					<?}?>
					<th scope="col">작성자</th>
					<th scope="col">등록일</th>
					<th scope="col">조회</th>
					<? if($a_reply == "Y" and $a_reply_type =="1") { ?>
					<th scope="col">답변</th>
					<?}?>
					<? if($a_category == "Y") { //카테고리일 경우?>
					<th scope="col">분류</th>
					<?}?>
					<?if(($m_power == "2" or $adminstrator == true) and $a_admin_check == "Y"){ //관리자만 사용?>
					<th scope="col">선택</th>
					<th scope="col">
						<select name="look" onchange="frm.submit()">
							<option value=""  <? if($look == ""){ ?>selected<? } ?>>전체</option>
							<option value="0" <? if($look == "0") { ?>selected<? } ?>>승인</option>
							<option value="1" <? if($look == "1") { ?>selected<? } ?>>미승인</option>
						</select>
					</th>
					<?}?>
				</tr>
			</thead>
			<tbody >
	<?
	// *** top 공지 ***
	while($mysql->FetchInto(&$top)) {   
		Bbs_Admin_List(&$top, $pageUrl);
	}

	// *** 페이지당 게시물 리스트 ***
	$qry  = " SELECT b_id, b_top,b_num, b_date,b_category, b_subject,b_writer,b_regdate, b_count, b_ref, b_step, b_level, b_file,b_open, b_look, b_admin_check";
	$qry .= " , b_movetablename FROM $a_tablename ";
	$qry .= " Where b_top = 'N' And ";
	$qry .= $q_search;
	$qry .= " Order By $q_order Limit $StartNum, $PostNum";

	$mysql->ParseExec($qry);

	if ($total > 0 or $top_total > 0) {
		if ($total < $top_total) { $top_total = 0; }

		if($pageIdx == 1)   $num = $total - $top_total;
		else $num = ($total - $top_total) - ( $pageIdx - 1 ) * $PostNum;	

		while($mysql->FetchInto(&$col)) {   
			Bbs_Admin_List(&$col, $pageUrl);
		}

	} else { ?>
		<tr>
			<td colspan="<?=$colCount?>">등록된 내용이 없습니다.</td>
		</tr>
	<? } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="<?=$colCount?>">
					<!-- 기본 paging -->
					<ul>
						<?=$pageList?>
					</ul>
				</td>
			</tr>
			<tr>
				<td colspan="<?=$colCount?>">
						<? if($m_write == "Y" or $adminstrator == true) { //쓰기 권한?>
							<a href="<?=$pageUrl?>&amp;page=/pages/admin/bbs/writeform.php&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category?>&amp;search=<?=$search?>&amp;keywrod=<?=curlencode($keyword)?>&amp;pageIdx=<?=$pageIdx?>&amp;mnu_name=<?=$mnu_name?>" >
								<img src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록"/>
							</a>
						<?}?>
							<a href="<?=$pageUrl?>&page=/pages/admin/bbs/bbs_admin.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="취소" /></a>
						<? if($a_excel == "Y"  and $adminstrator == true) { //엑셀파일출력?>
							<a href="javascript:list_excel('<?=$a_idx ?>');">[엑셀]</a>
						<?}?>
				</td>
			</tr>
			<tr>
				<td colspan="<?=$colCount?>">
					<select name="search" id="search" title="검색분류">
						<option value="subject" <? if($search == "subject") {?>selected<?}?>>제목</option>
						<option value="writer"  <? if($search == "writer") {?>selected<?}?>>이름</option>
						<option value="content" <? if($search == "content") {?>selected<?}?>>내용</option>
					</select>

					<input type="text" name="keyword" value="<?=$keyword?>" id="keyword" class="basic" title="검색어" />
					<input type="image" src="/pages/admin/images/bbs/btn_search.gif" alt="검색" class="vmiddle" />
				</td>
			</tr>
	</table>
	</form>
<? }
// ***************** 일 반 게 시 판  끝 ************************************************************************





// ***************** 이 미 지 게 시 판 시 작**********************************************************************
if ($a_photo == "Y") {
	$record_num = $total - $a_pagesu * ($pageIdx - 1);
	?>
	<form name="frm" method="post">

	<? if($a_category == "Y")  {   //카테고리 사용 ?>
		<table>
			<tr> 
				<td>
					<table>
						<tr> 
							<td width="10">&nbsp;</td>
							<td width="88"><font color="<?=$a_font_color ?>"><b>분류별 선택 / </b></font></td>
							<td align="center">
								<?
								// *** 총 게시물 수 ***
								$mysql2 = new Mysql_DB;
								$mysql2->Connect();

								$sql  = "Select * From $a_tablename";
								$mysql2->ParseExec($sql); 
								$cate_all_total = $mysql2->RowCount();
								$mysql2->ParseFree();
								?>
								<a href="list.php?a_idx=<?=$a_idx ?>&mnu_name=<?=$mnu_name?>"><font color="<?=$a_font_color ?>">전체(<?=$cate_all_total ?>)</font></a>
							</td>
							<?
							// *** 게시판 카테고리 ****
							$sql =  " Select c_cate, c_catename From bbs_admin_cate Where c_use ='1' and c_tablename = '$a_tablename' Order by c_cate";
							$mysql2->ParseExec($sql);

							while($mysql2->FetchInto(&$cate)) {   
								$mysql3 = new Mysql_DB;
								$mysql3->Connect();

								$qry  = "Select * From $a_tablename Where b_category = '$cate[c_cate]'";
								$mysql3->ParseExec($qry);
								$cate_total = $mysql3->RowCount();

								?>
								<td width="13"><img src="image/part_black.gif" width="13" height="9"></td>
								<td align="center"> 
									<a href="list.php?a_idx=<?=$a_idx ?>&category=<?=$cate[c_cate] ?>&mnu_name=<?=$mnu_name?>"><font color="<?=$a_font_color ?>"><?=$cate[c_catename] ?>(<?=$cate_total ?>)</a>
								</td>
							<? } 

							$mysql2->ParseFree();
							?>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	<? } //카테고리 사용 if 문 닫음 ?>

	<table width="100%" height="26" cellpadding="0" cellspacing="0">
	  <tr>
		<td>
			<img src="/pages/admin/images/common/bullet_box_gray.gif"> 전체 <?=$totalPage?> / 페이지 <?=$pageIdx?>
		</td>
	  </tr>
	 </table>

	<table width="100%" class="bbsCont" cellspacing="1" summary="<?=$a_bbsname?> 목록을 나타내는 표">
		<tbody>
	<?
		$i = 1;	

		// *** 페이지당 게시물 리스트 ***
		$qry  = " Select b_num, b_category, b_subject,b_writer,b_regdate, b_content, period_diff(date_format(b_regdate,'%Y%m%d'),date_format(now(),'%Y%m%d')) as new_icon, b_count, b_level, b_file,b_open";
		$qry .= " From $a_tablename ";
		$qry .= " Where ";
		$qry .= $q_search;
		$qry .= " Order by  b_ref desc, b_step asc Limit $StartNum, $PostNum";

		$mysql->ParseExec($qry);

		$path = "../../pages/bbs/data/" . $a_idx . "/";

		while($mysql->FetchInto(&$col)) { # or $PostNum >= $i) {  
			$b_num      = $col["b_num"];
			$b_regdate  = explode(" ", $col["b_regdate"]);
			$b_subject  = shorten_string($col["b_subject"],$a_title_len*2,"...");
			$b_open     = $col["b_open"];
			$b_content	= $col["b_content"];
			$b_count    = $col["b_count"];

			//비공개용글
			if($b_open == 1) {
				$key = "<img src=\"images/bbs/icon_key.gif\">";
			} else {
				$key = "";
			}

			$mysql2 = new Mysql_DB;
			$mysql2->Connect();
			// *** 첨부파일 **** 
			$fqry = "Select * From bbs_file Where f_tablename='$a_tablename' and f_num = '$b_num' Order by f_sort Limit 1";
			$mysql2->ParseExec($fqry);
			$mysql2->FetchInto(&$file);

			if(Bbs_FileIcon($file[f_filename]) == "gif.gif" or Bbs_FileIcon($file[f_filename]) == "jpg.gif") {

				$photo = $path . $file[f_filename];

				if(file_exists($photo)) {
					$size = getimagesize("$photo");

					// 이미지 넓이 
					if($size[0] > $a_photo_width) $photo_w = $a_photo_width;

					// 이미지 높이
					if($size[1] > $a_photo_height) $photo_h = $a_photo_height;

					if($i == 1){
						$photo   = "<img src=\"$photo\" width=\"230\" height=\"160\" alt=\"$b_subject\" />";
						$b_content  = shorten_string(strip_tags($b_content),670,"...");
					}else{
						$photo   = "<img src=\"$photo\" width=\"130\" height=\"90\" alt=\"$b_subject\" />";
						$b_content  = shorten_string(strip_tags($b_content),330,"...");
					}

				} else {

					$photo   = "<img src=\"image/no_image.gif\" />";
				}	
			} else {
				
				$photo   = "<img src=\"image/no_image.gif\" />";
			}

			$ii = $i % $a_photo_cols;

	?>

		<!-- 뉴스 리스트 -->
		<?if($i == 1){ //최상위 글일 경우?>
			<div class="nMain">
				<h4 class="tbb mar_b10">
					<a href="<?=$pageUrl?>&page=/pages/admin/bbs/view.php&a_idx=<?=$a_idx ?>&category=<?=$category ?>&search=<?=$search ?>&keyword=<?=curlencode($keyword) ?>&pageIdx=<?=$pageIdx ?>&b_num=<?=$b_num ?>&look=<?=$look ?>">
						<?=$b_subject?>
					</a>
				</h4>
				<div class="nMainCont">
					<p class="img">
						<?=$photo?>
					</p>
					<p>
						<?=$b_content?>
					</p>
					<p class="date">등록일 : <?=$b_regdate[0] ?>&nbsp;&nbsp;조회수 : <?=$b_count?></p>
				</div>
			</div> <!--End <div class="nMain"-->
		<?}else{ //최상위 글이 아닐 경우?>
			<div class="nList">
				<p class="img">
					<?=$photo?>
				</p> 
				<h4 class="tmb mar_b5">
					<a href="<?=$pageUrl?>&page=/pages/admin/bbs/view.php&a_idx=<?=$a_idx ?>&category=<?=$category ?>&search=<?=$search ?>&keyword=<?=curlencode($keyword) ?>&pageIdx=<?=$pageIdx ?>&b_num=<?=$b_num ?>&look=<?=$look ?>">
						<?=$b_subject?>
					</a>
				</h4>
				<p>
					<?=$b_content?>
				</p>
				<p class="date">등록일 : <?=$b_regdate[0] ?>&nbsp;&nbsp;조회수 : <?=$b_count?></p>
			</div>
		<?} //End if($i == 1)?>

	<? 
		$i++;		
	}  // while 닫음 
	?>
		</tbody>
		<tfoot>
			<tr>
				<td height="40" align="center">
					<!-- 기본 paging -->
					<ul>
						<?=$pageList?>
					</ul>
				</td>
			</tr>
			<tr>
				<td height="40" align="center">
			<? if($m_write == "Y" or $adminstrator == true) { //쓰기 권한?>
				
					<a href="<?=$pageUrl?>&amp;page=/pages/admin/bbs/writeform.php&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category?>&amp;search=<?=$search?>&amp;keywrod=<?=curlencode($keyword)?>&amp;pageIdx=<?=$pageIdx?>&amp;mnu_name=<?=$mnu_name?>" >
						<img src="/pages/admin/images/bbs/btn_write_big.gif" alt="글등록" />
					</a>
			<?}?>
				</td>
			</tr>
			<tr>
				<td height="34" colspan="6" align="center">
					<select name="search" id="search" title="검색분류">
						<option value="subject" <? if($search == "subject") {?>selected<?}?>>제목</option>
						<option value="writer"  <? if($search == "writer") {?>selected<?}?>>이름</option>
						<option value="content" <? if($search == "content") {?>selected<?}?>>내용</option>
					</select>

					<input type="text" name="keyword" value="" id="keyword" class="basic" title="검색어" />

					<input type="image" src="/pages/admin/images/bbs/btn_search.gif" alt="검색"  class="vmiddle" />
				</td>
			</tr>
		</tfoot>
	</table>
	</form>
<? } 
?>
<form name="open_frm" method="post">
<input type="hidden" name="open_pass" value="">
</form>