<?
	session_start();

	include("../../config/comm.inc.php"); 
	include("../../config/mysql.inc.php"); 

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$a_idx = $_REQUEST["a_idx"];

	$qry = "Select a_bbsname,a_tablename From bbs_admin Where a_category='Y' and a_idx = '$a_idx'";
	$mysql->ParseExec($qry);
	if ($mysql->RowCount() < 1) {

		 message("게시판이 존재하지 않거나 카테고리 사용 안함으로 설정되어 있습니다");
	
	} else {

			$mysql->FetchInto(&$row);
			$a_bbsname   =  $row[a_bbsname];
			$a_tablename =  $row[a_tablename];

	}

	//$mysql->ParseFree();
	//$mysql->Disconnect();

	
	// *** 함수 설정  ****
	if ($mode == "" or $mode == "m_form") {   //분류 입력폼
		  CateForm();
	} elseif ( $mode == "m_formMod") {       //분류 수정   
		  CateMod();
	} elseif ( $mode == "m_formAdd") {       //분류 추가         
	    CateAdd();
	} elseif ( $mode == "m_formDel") {       //분류 삭제
	    CateDel();
	}

	function CateForm(){	 
			
			global $a_idx, $a_tablename, $a_bbsname;
			global $mysql, $pageIdx, $pageUrl;

			///전체수를 구한다
      $total_qry  = "Select * From bbs_admin_cate Where c_tablename='$a_tablename' ";
      $mysql->ParseExec($total_qry); 
      $total = $mysql->RowCount();
      $mysql->ParseFree();

      // *** 게시물 수, 페이지수 ***
      if(empty($pageIdx)) $pageIdx = 1;
      
      $PostNum  = 15;
      $WidthNum = 10;
       
      $StartNum = ( $pageIdx - 1 ) * $PostNum;
      $EndNum = $PostNum;

      $qry  = " Select * From bbs_admin_cate Where c_tablename='$a_tablename' Order by c_cate limit $StartNum,$EndNum";
			$mysql->ParseExec($qry); 

      // *** 페이징 class *****
      include("../../config/page_manager.php"); 

      // *** 페이징 *****
      $pg = new initPage($pageIdx,$PostNum);
      $search_url = "a_idx=$a_idx";
      $pageList = $pg->getPageList( $PHP_SELF, $search_url, $total, $WidthNum)

?>
<script type="text/javascript">
<!--
	
  function on_show() {
		document.frm.p_formCode.focus();
		return;
	}

	function Delete(i) {
		document.location.href="<?=$pageUrl?>&page=/pages/admin/bbs/bbs_cate.php&mode=m_formDel&c_cate="+i+"&a_idx=<?=$a_idx ?>";
	}
	
	function Digit(str) {
		 var flag = false;
		 var Digit= "1234567890";
				
		 for(i=0; i<str.length;i++) {

			 if(Digit.indexOf(str.substring(i, i+1)) == -1){	
					flag = true;
					break;
				}
			
		}
	
		return flag;
		
	}   

	function CheckFormAdd() {

		if (frmAdd.c_cate.value == "") {
			alert("분류코드를 입력하여 주십시오");
			frmAdd.c_cate.focus();
			return;
		}
		else if (Digit(frmAdd.c_cate.value)) {
			alert("분류코드는 숫자로 입력하여 주십시오");
			frmAdd.c_cate.focus();
			return;
		}
		else if (frmAdd.c_catename.value == "") {
			alert("분류명을 입력하여 주십시오");
			frmAdd.c_catename.focus();
			return;
		}
		else {	
			frmAdd.submit();
    }
	}


	function CheckFormMod(frmMod) {

		if (frmMod.c_catename.value == "") {
			alert("분류명을 입력하여 주십시오");
			frmMod.c_catename.focus();
			return;
		}
		else {	
			frmMod.submit();
    }
	}
-->
</script>


		<table width="100%" height="26" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/pages/admin/images/common/bullet_box_gray.gif"><?=$a_bbsname?> 분류 관리</td>
			</tr>
		</table>

		<table width="100%" class="bbsCont" cellspacing="1" summary="전문가 목록 보기">
			<colgroup>
				<col width="10%"/>
				<col />
				<col width="10%"/>
				<col width="15%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">코드</th>
					<th scope="col">분류명</th>
					<th scope="col">사용여부</th>
					<th scope="col">비고</th>
				</tr>
			</thead>
			<tbody>
			<form name="frmAdd" method="post" action="<?=$pageUrl?>&page=/pages/admin/bbs/bbs_cate.php&mode=m_formAdd">
			<input type="hidden" name="a_idx" value="<?=$a_idx ?>">
			<tr>
				<td class="acenter"><input type="text" name="c_cate" size="7"></td>
				<td class="pad_l10"><input type="text" name="c_catename" size="80"></td>
				<td class="acenter">
					<select name="c_use">
						<option value="1">사 용</option>
						<option value="0">사용안함</option>
					</select>
				</td>
				<td class="acenter">
					<a href="javascript:CheckFormAdd()">
						<input type="image" src="/pages/admin/images/bbs/btn_write.gif" align="absmiddle">
					</a>
					&nbsp;
					<img src="/pages/admin/images/bbs/btn_cancel.gif">
				</td>
			</tr>			
			</form>
<!-- 출력 및 수정	-->
	<? 
			$num = 1;	
			while($mysql->FetchInto(&$col)) { 	

				$mysql2 = new Mysql_DB;
				$mysql2->Connect();

				//*** 카테고리별 게시물 수 ****
				$sql = "Select count(*) as total From $a_tablename where b_category='$col[c_cate]'";
				$mysql2->ParseExec($sql);
				$mysql2->FetchInto(&$row);
				$ctotal = $row[total];
	?>

			<form name="frmMod<?=$num ?>" method="post" action="bbs_cate.php&mode=m_formMod">	
			<input type="hidden" name="a_idx" value="<?=$a_idx ?>">
			<tr>
				<td class="acenter"><input type="text" name="c_cate" size=7 value="<?=$col[c_cate] ?>" readonly></td>
				<td class="acenter"><input type="text" name="c_catename" value="<?=$col[c_catename] ?>" size=35></td>
				<td class="acenter">
					<select name="c_use">
						<option value="1" <? if($col[c_use] == "1") { ?>selected<? } ?>>사 용</option>
						<option value="0" <? if($col[c_use] == "0") { ?>selected<? } ?>>사용안함</option>
					</select>
				</td>
				<td class="acenter">
					<a href="javascript:frmMod<?=$num ?>.submit();">
						<img src="/pages/admin/images/bbs/btn_modify.gif" align="absmiddle" border="0">
					</a>
					<a href="javascript:<? if($ctotal > 0) { ?>alert('<?=$col[c_catename] ?> 카테고리로 등록한 게시글이 존재합니다');<? } else { ?>Delete(<?=$col[c_cate] ?>)" onclick="return confirm('정말 삭제하시겠습니까? 신중히 하세요.');<? } ?>">
					<img src="/pages/admin/images/bbs/btn_delete.gif" border="0" align="absmiddle"></a>
				</td>
			</tr>
			</form>
	<?
			 $num++;  
			 } 
	?>
			</tbody>
			<tfoot>
				<tr>
					<td height="40" colspan="4" align="center">
						<!-- 기본 paging -->
						<ul>
							<?=$pageList?>
						</ul>
					</td>
				</tr>
				<td height="40" colspan="4" align="center">
					<a href="<?=$pageUrl?>&page=/pages/admin/bbs/bbs_admin.php">
					<img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="취소" /></a>					
				</td>
			</tfoot>
		</table>
<?  } //  분류 리스트 

		// --- 분류 코드 저장-------------------------------------------------------------------
		function CateAdd(){	 
			global $a_idx, $a_tablename, $c_cate, $c_catename,  $c_use;
			global $mysql, $pageUrl;
		
			$qry  = " Select * From bbs_admin_cate Where c_tablename='$a_tablename' and c_cate = $c_cate ";
			$mysql->ParseExec($qry); 
			if ($mysql->RowCount() > 0) {
				
				message("코드값이 중복 입니다");
				
			} else {
				$qry  = " Insert into bbs_admin_cate (c_tablename, c_cate, c_catename, c_use)";
				$qry .= " Values ('$a_tablename', $c_cate,'$c_catename', '$c_use')";
				$mysql->ParseExec($qry); 
        movepage($pageUrl."&page=/pages/admin/bbs/bbs_cate.php&a_idx=$a_idx");
			}
		}

		function CateMod(){	 

			global $a_idx, $a_tablename, $c_cate, $c_catename,  $c_use;
			global $mysql, $pageUrl;
		
			$qry  = " Update bbs_admin_cate Set c_tablename='$a_tablename',c_catename='$c_catename', c_use='$c_use'";
			$qry .= " Where c_tablename='$a_tablename' and c_cate = $c_cate";
			$mysql->ParseExec($qry); 
			movepage($pageUrl."$page=/pages/admin/bbs/bbs_cate.php&a_idx=$a_idx");

		}

		function CateDel(){	 

			global $a_idx, $a_tablename, $c_cate;
			global $mysql, $pageUrl;

			$qry  = " Delete From bbs_admin_cate Where c_tablename='$a_tablename' and c_cate = $c_cate";
			$mysql->ParseExec($qry); 
			movepage($pageUrl."&page=/pages/admin/bbs/bbs_cate.php&a_idx=$a_idx");


		}

		$mysql->Disconnect();
?>