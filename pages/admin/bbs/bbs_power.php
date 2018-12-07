<?
	
	session_start();

	include("../../config/comm.inc.php"); 
	include("../../config/mysql.inc.php");  

	$mysql = new Mysql_DB;
	$mysql->Connect();

	if ($mode == "") { //등록 폼
		  menuform();
	} else if ( $mode == "ok") { 
	    menuAdd();
	}
	
	
	function menuform() {

		global $a_idx, $mysql;
	
		//등록된 게시판
		$qry = "select a_bbsname,a_tablename,a_reply from bbs_admin where a_idx='$a_idx'";
		$mysql->ParseExec($qry); 
		$mysql->FetchInto(&$col);
		$a_bbsname   = $col[a_bbsname];
		$a_tablename = $col[a_tablename];

    if($a_tablename == "") {
      message("생성된 게시판이 없습니다");
    }
		
    if($col[a_reply] == "N") $disabled = "disabled";
		else $disabled = "";

		//생성된 회원그룹 리스트
		$qry = "select * from m_level where l_level <> 99";
		$mysql->ParseExec($qry); 
		$total = $mysql->RowCount();
?>

<script type="text/javascript">
<!--
function frmcheck()
 {
		var count, menu;
		count = 0;
		menu = "";
		for(i = 0; i < document.reg.elements.length; i++){

		 if(document.reg.elements[i].checked == true
				&& document.reg.elements[i].name == "p_menu") {
		   count++;
			 
			 if(document.reg.elements[i].value == "admin") {
				  menu = ",admin";
					break;
			 } else {
				 menu = menu + "," + document.reg.elements[i].value;
			 }	
			 
		  }
		}

		if(count == 0) {
			alert("관리할 메뉴를 선택하여 주십시오");
			return false;
		}
		document.reg.p_menutable.value = menu;
		return true;
 }

 function allcheck(chked, gubun){

	var num;
	num  = 0 ;

	for(var i=0; i < reg.elements.length ; i++) { 

		if(reg.elements[i].type=='checkbox' && reg.elements[i].name == "p_"+gubun+"["+num+"]")  {
			 reg.elements[i].checked = chked;
			 num++;
		}
		
	}	
}
-->
</script>

		<table width="100%" height="26" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> 게시판 권한설정 </td>
			</tr>
		</table>

		<table width="100%" class="bbsCont" cellspacing="1" summary="게시판 권한설정 하는 표">
		<form name="reg" method="post" action="<?=$PHP_SELF ?>">
		<input type="hidden" name="mode" value="ok">
		<input type="hidden" name="p_menutable" value="<?=$a_tablename ?>">
			<caption class="none">게시판 권한설정</caption>
			<colgroup>
				<col />
				<col width="20%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col">게시판</th>
					<th scope="col">그룹명</th>
					<th scope="col">
						<input type="checkbox" onClick="javascript:allcheck(this.checked,'list')">목록
					</th>
					<th scope="col">
						<input type="checkbox" onClick="javascript:allcheck(this.checked,'read')">읽기
					</th>
					<th scope="col">
						<input type="checkbox" onClick="javascript:allcheck(this.checked,'write')">쓰기
					</th>
					<th scope="col">
						<input type="checkbox" onClick="javascript:allcheck(this.checked,'reply')">답변
					</th>
					<th scope="col">
						<input type="checkbox" onClick="javascript:allcheck(this.checked,'modify')">수정
					</th>
					<th scope="col">
						<input type="checkbox" onClick="javascript:allcheck(this.checked,'del')">삭제
					</th>
				</tr>
			</thead>
			<tbody>
				<?
					if ($total > 0 ) { 
						$num = 0;
						while($mysql->FetchInto(&$col)) { 	
						
							//등록된 메뉴
							$mysql2 = new Mysql_DB;
							$mysql2->Connect();

							$qry = "select * from m_menu where m_level=$col[l_level] and m_menutable='$a_tablename'";
							$mysql2->ParseExec($qry); 
							$mysql2->FetchInto(&$menu);
						
				?> 
				<tr>
					<?if($num == 0){?><td rowspan="<?=$total + 1?>" class="acenter"><?=$a_bbsname?></td><?}?>
					<input type="hidden" name="p_level[<?=$num ?>]" value="<?=$col[l_level] ?>">
					<td class="acenter"><?=$col[l_levelname] ?></td>
					<td class="acenter"><input type="checkbox" name="p_list[<?=$num?>]" <? if($menu[m_list] == "Y") { ?>checked<? } ?>>목록</td>
					<td class="acenter"><input type="checkbox" name="p_read[<?=$num ?>]" <? if($menu[m_read] == "Y") { ?>checked<? } ?>>읽기</td>
					<td class="acenter"><input type="checkbox" name="p_write[<?=$num ?>]" <? if($menu[m_write] == "Y") { ?>checked<? } ?>>쓰기</td>
					<td class="acenter"><input type="checkbox" name="p_reply[<?=$num ?>]" <? if($menu[m_reply] == "Y") { ?>checked<? } ?> <?=$disabled ?>>답변</td>
					<td class="acenter"><input type="checkbox" name="p_modify[<?=$num ?>]" <? if($menu[m_modify] == "Y") { ?>checked<? } ?>>수정</td>
					<td class="acenter"><input type="checkbox" name="p_del[<?=$num ?>]" <? if($menu[m_del] == "Y") { ?>checked<? } ?>>삭제</td>
				</tr>
				<?			$num++;
						}
					}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td height="40" colspan="8" align="center">
						<a href="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/bbs_admin_form.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="취소" /></a>
						<input type="image" src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록" />
					</td>
				</tr>
			</tfoot>
		</form>
		</table>
<?
	
  }  // 메뉴별 관리 폼

	function menuAdd() {

		global $p_menutable, $p_level,$p_list, $p_write, $p_read, $p_reply, $p_modify, $p_del,$p_admin;
		global $HTTP_SESSION_VARS, $mysql;

		$p_id = $HTTP_SESSION_VARS[duid];
		$p_ip = $REMOTE_ADDR;

		for ($i = 0; $i < count($p_level) ; $i++) {

				//이전권한 삭제
				$qry = "Delete From m_menu Where m_level = $p_level[$i] and m_menutable = '$p_menutable'";
				$mysql->ParseExec($qry);
				
				// 리스트 권한
				if($p_list[$i] == "on") {
					 $list = "Y";
				} else {
					 $list = "N";	
				}
				// 쓰기 권한
				if($p_write[$i] == "on") {
					 $write = "Y";
				} else {
					 $write = "N";	
				}
				// 읽기 권한
				if($p_read[$i] == "on") {
					 $read = "Y";
				} else {
					 $read = "N";	
				}
				// 답변 권한
				if($p_reply[$i] == "on") {
					 $reply = "Y";
				} else {
					 $reply = "N";	
				}
				// 수정 권한
				if($p_modify[$i] == "on") {
					 $modify = "Y";
				} else {
					 $modify = "N";	
				}
				//삭제 권한
				if($p_del[$i] == "on") {
					 $del = "Y";
				} else {
					 $del = "N";	
				}
				
				$qry  = "Insert into m_menu(m_level, m_menutable, m_list, m_read, m_write,m_reply, m_modify, m_del, ";
				$qry .= " 									m_insertid, m_insertdate, m_insertip)";
				$qry .= " Values ('$p_level[$i]','$p_menutable','$list','$read','$write','$reply','$modify','$del',";
				$qry .= "         '$p_id',now(),'$p_ip')";
				$mysql->ParseExec($qry);

		 }
		
		movepage("/pages/admin/main.php?pageName=게시판관리&page=/pages/admin/bbs/bbs_admin.php&search=$search&keyword=$keyword&pageIdx=$pageIdx");
	}

	$mysql->DisConnect();
?>