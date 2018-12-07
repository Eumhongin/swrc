<?
	session_start();

	include("../../config/mysql.inc.php");  
	include("../../config/bbs_lib.inc.php");  
	include("../../config/comm.inc.php");  

	$pageParameter = $pageUrl.$pageName."&page=".$page;

	$mysql = new Mysql_DB;
	$mysql->Connect();

 // ** 테이블 생성시 나타나는 폴더, 게시판 환경 테이블 생성 
	$path = file_path();

	$path = $path . "/pages/bbs/data/";     
	
	//$path = $path . "\korean\bbs\data\";
	
	if(!(is_dir($path)))	{
	//	chmod($path, 0777);
	//	mkdir($path, 0777);
		
	}
		
	$searchCol = $_REQUEST["searchCol"];
	$searchKeyword = $_REQUEST["searchKeyword"];
	$search = $_REQUEST["search"];
	$keyword = $_REQUEST["keyword"];

	// ** 게시판 환경 테이블 생성
	if (!Exist_Table('bbs_admin')) Bbs_Config_Create();
	// ** 첨부파일 테이블 생성
	if (!Exist_Table('bbs_file')) Bbs_File_Create();

	if($keyword <> "") {
    if($search == "a_bbsname")   $query = " Where a_bbsname like '%$keyword%'";
    if($search == "a_tablename") $query = " Where a_tablename like '%$keyword%'";
  }
  $total_qry   = " Select * From bbs_admin ";
  $total_qry  .= $query;
  $mysql->ParseExec($total_qry); 
  $total = $mysql->RowCount();
  $mysql->ParseFree();

  // *** 게시물 수, 페이지수 ***
  if(empty($pageIdx)) $pageIdx = 1;
  
  $PostNum  = 18;
  $WidthNum = 10;
   
  $StartNum = ( $pageIdx - 1 ) * $PostNum;
  $EndNum = $PostNum;

  // ** 테이블 리스트 보기
	$qry  = "Select * From bbs_admin ";
	$qry .= $query ." Order by a_language asc, a_bbsname limit $StartNum,$EndNum ";
	$mysql->ParseExec($qry);

  // *** 페이징 class *****
  include("../../config/page_manager_admin.php"); 

  // *** 페이징 *****
  $pg = new initPage($pageIdx,$PostNum);
  $search_url = "search=$search&keyword=$keyword";
  $pageList = $pg->getPageList( $pageParameter, $search_url, $total, $WidthNum);
?>

<script type="text/javascript" src="/pages/bbs/js/comm.js"></script>


	<p class="contTitle">검색된 게시물 : <?=$total?>개</p>

	<form name="frm" method="post">
	<table class="bbsCont" cellspacing="0" summary="게시판 목록 보기">
		<colgroup>
			<col width="7%"/>
			<col />
			<col width="7%"/>
			<col width="8%"/>
			<col width="10%"/>
			<col width="6%"/>
			<col width="10%"/>
			<col width="10%"/>
			<col width="8%"/>
				<!--
			<col width="8%"/>
			<col width="8%"/>
				-->
			<col width="8%"/>
		</colgroup>
		<thead>
			<tr>
				<th scope="col">언어</th>
				<th scope="col">게시판명</th>
				<th scope="col">테이블명</th>
				<th scope="col">종류</th>
				<th scope="col">형태</th>
				<th scope="col">파일<br/>첨부</th>
				<th scope="col">전체/오늘</th>
				<th scope="col">게시판 코드</th>
				<th scope="col">수정</th>
				<!--
				<th scope="col">권한</th>
				<th scope="col">분류</th>
				-->
				<th scope="col">삭제</th>
			</tr>
		</thead>
		<tbody>
	 <?  
		if($total > 0) {

			while($mysql->FetchInto(&$col)) {  
				
					$a_idx           = $col[a_idx];
          $a_language      = $col[a_language];
          $a_title_bgcolor = $col[a_title_bgcolor];
					$a_bbsname       = utf8ToEuckr($col[a_bbsname]);
					$a_tablename     = $col[a_tablename];
					$a_type          = $col[a_type];
					$a_photo         = $col[a_photo];
					
					if ($a_type == 1)  $bbs_type = "공개";
					elseif ($a_type == 2) $bbs_type = "공개/비공개";
			
					if ($a_photo == "Y") $bbs_state = "포토게시판";
					else $bbs_state = "일반게시판";

					$mysql2 = new Mysql_DB;
					$mysql2->Connect();

					//***   전체 게시물 수 ****
					$sql = "Select count(*) as total From $a_tablename";
					$mysql2->ParseExec($sql);
					$mysql2->FetchInto(&$row);
					$total = $row[total];

					//***   오늘 등록된 게시물 수 ****
					$sql = "Select count(*) as total From $a_tablename";
					$sql = $sql. " Where period_diff(date_format(b_regdate,'%Y%m%d'),date_format(now(),'%Y%m%d')) = 0";
					$mysql2->ParseExec($sql);
					$mysql2->FetchInto(&$row);
					$today = $row[total];

					$mysql2->ParseFree();

					//***  첨부파일 ****
					$a_upload   =  $col[a_upload];
					if ($a_upload == "Y")  $upload_value = "yes";
					else $upload_value = "no";

          $home_url = homepage_url($a_language);

          if($a_language == 1)     $language = "한글";
          elseif($a_language == 2) $language = "영어";
          elseif($a_language == 3) $language = "일어";
          elseif($a_language == 4) $language = "중국어";

	?>
		<tr>
			<td><?=$language?></td>
			<td class="tal">
				<a href="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/list.php&a_idx=<?=$a_idx?>"><font color="blue"><?=$a_bbsname?></font></a>
			</td>
			<td class="tal"><?=$a_tablename?></td>
			<td><?=$bbs_type?></td>
			<td><?=$bbs_state?></td>
			<td><?=$upload_value?></td>
			<td><?=$total?> / <?=$today?></td>
			<td><?=$a_idx?></td>
			<td>
				<a href="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/bbs_admin_form.php&mode=modify&a_idx=<? echo $a_idx  ?>&<? echo $search_url ?>&pageIdx=<? echo $pageIdx ?>"><font color="#F37636"><b>[수정]</b></font></a>
			</td>
			<!--
			<td>
				<a href="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/bbs_power.php&a_idx=<? echo $a_idx  ?>"><font color="#F37636"><b>[권한]</b></font></a>
			</td>
			<td>
				<?if ($col[a_category] == "Y") {?>
					<a href="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/bbs_cate.php&a_idx=<? echo $a_idx  ?>"><font color="#F37636">
				<?} else {?><font color="#D8D8D8">
				<? } ?>
				<b>[설정]</b></font></a>
			</td>
			-->
			<td>
				<a href="javascript:bbs_drop('<? echo $a_idx  ?>')"><font color="#F37636"><b>[삭제]</b></font></a>
			</td>
		</tr>
	<?}
	}
	?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="12">
					<!-- 기본 paging -->
					<ul>
						<?=$pageList?>
					</ul>
				</td>
			</tr>
			<tr>
				<td colspan="12">
					<a href="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/bbs_admin_form.php"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록"/></a>
				</td>
			</tr>
			<tr>
				<td colspan="12">					
						<select name="searchCol" id="searchCol" title="검색분류">
							<option value="a_bbsname">게시판명</option>
							<option value="a_tablename">테이블명</option>
						</select>
						<input type="text" name="searchKeyWord" value="<?=$searchKeyWord?>" id="searchKeyWord" class="basic" title="검색어" />
						<input type="image" src="/pages/admin/images/bbs/btn_search.gif" value="검색" alt="검색" class="vmiddle" />
				</td>
			</tr>
		</tfoot>
	</table>
	</form>
<?
	$mysql->ParseFree();
	$mysql->Disconnect();
?>