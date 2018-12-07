<?

	include ("../admin_security.php");
	include ("../../../config/mysql.inc.php");

	$pageParameter = $pageUrl.$pageName."&page=".$page;
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$m_query = " Where 1=1 "; 

	if($keyword <> "") {
		$m_query = $m_query ."and $search like '%$keyword%'";   //검색
	}

	if($sel_organ_code <> ""){
		$m_query = $m_query ." and organ_code = '".$sel_organ_code."' ";
	}

	//부서별로 정렬
	$m_query = $m_query. " Order by organ_code ";

	//전체 회원수를 구한다
	$total_qry = "Select * From t_organ ";
	$total_qry .= $m_query; 
	$mysql->ParseExec($total_qry); 
	$total = $mysql->RowCount();
//	$mysql->ParseFree();

	// *** 게시물 수, 페이지수 ***
	if (empty($pageIdx)) $pageIdx = 1;

	$PostNum  = 20;
	$WidthNum = 10;
   
	$StartNum = ( $pageIdx - 1 ) * $PostNum;
	$EndNum = $PostNum;

	// 리스트 형식으로 내용을 보여준다
	$qry = "select * from t_organ ";
	$qry .= $m_query ." limit $StartNum,$EndNum";
	$mysql->ParseExec($qry); 

	#echo $qry;
	// *** 페이징 class *****
	include("../../../config/page_manager_popup.php"); 

	// *** 페이징 *****
	$pg = new initPage($pageIdx,$PostNum);
	$pageList = $pg->getPageList( $PHP_SELF, "ch_member=$ch_member&keyword=$keyword&keyword2=$keyword2&search=$search&sorder=$sorder", $total, $WidthNum);  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>(재)대구디지털산업진흥원 관리자</title>
<link rel="stylesheet" type="text/css" href="/pages/admin/css/admin_common.css"/>
<link rel="stylesheet" type="text/css" href="/css/board.css"/>
<script type="text/javascript" src="/js/common.js"></script>
<script type="text/javascript" src="/js/prototype.js"></script>
<script type="text/javascript" src="/pages/bbs/js/comm.js"></script>
<script type="text/javascript">document.domain = "dip.or.kr";</script>

<script type="text/javascript">

function fncChengeSelect(){
		document.search_frm.submit(); 
	}

function fncChoiceCharge(userId, userName){

	try{
		opener.choiceCharge(userId, userName);
	}catch (e) {
		alert("Opener 객체가 닫혔거나, 페이지 이동으로 처리를 완료할 수 없습니다.");
	}
	window.close();

}
</script> 
</head>

<body>

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

			<table class="bbsCont" cellspacing="0">
			<form name="frm" method="post">
			<input type="hidden" name="pageIdx" value="<? echo $pageIdx ?>">
				<colgroup>
					<col />
					<col width="20%" />
					<col width="15%" />
					<col width="15%" />
				</colgroup>
				<thead>
					<tr>
						<th scope="col">부서</th>
						<th scope="col">이름</th>
						<th scope="col">직급</th>
						<th scope="col">선택</th>
					</tr>
				</thead>

				<?
					if ($total > 0) {
						
						if($pageIdx == 1)   $i = $total;
						else $i = $total - ( $pageIdx - 1 ) * $PostNum;	

						 while($mysql->FetchInto(&$col)) { 
								
				?>
				<tr>
					<td class="aleft pad_l10">
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
					<td><?=$col["name"]?></td>
				    <td>
						<?=$col["grade"]?></td>
					<td>
						<input type="image" src="/pages/admin/images/bbs/btn_select.gif" value="선택" onclick="fncChoiceCharge('<?=$col["user_id"]?>','<?=$col["user_name"]?>')"/>
					</td>

				</tr>
				<?		} 
				
					} else {
				?>
				<tr>
					<td colspan="4" align="center">
						<? if ($p_keyword) { ?>
						"<font size="2" color="red"><?= $p_keyword ?></font>"으로 검색한 결과가 없습니다
						<? }?>
					</td>
				</tr>
				<? } ?>	
			</form>
			</table>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" height="40">
					<? // *** 페이징 *****	
							 echo $pageList;  
					?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
<?
	$mysql->Disconnect();
?>

</body>
</html>