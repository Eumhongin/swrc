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

		 message("�Խ����� �������� �ʰų� ī�װ� ��� �������� �����Ǿ� �ֽ��ϴ�");
	
	} else {

			$mysql->FetchInto(&$row);
			$a_bbsname   =  $row[a_bbsname];
			$a_tablename =  $row[a_tablename];

	}

	//$mysql->ParseFree();
	//$mysql->Disconnect();

	
	// *** �Լ� ����  ****
	if ($mode == "" or $mode == "m_form") {   //�з� �Է���
		  CateForm();
	} elseif ( $mode == "m_formMod") {       //�з� ����   
		  CateMod();
	} elseif ( $mode == "m_formAdd") {       //�з� �߰�         
	    CateAdd();
	} elseif ( $mode == "m_formDel") {       //�з� ����
	    CateDel();
	}

	function CateForm(){	 
			
			global $a_idx, $a_tablename, $a_bbsname;
			global $mysql, $pageIdx, $pageUrl;

			///��ü���� ���Ѵ�
      $total_qry  = "Select * From bbs_admin_cate Where c_tablename='$a_tablename' ";
      $mysql->ParseExec($total_qry); 
      $total = $mysql->RowCount();
      $mysql->ParseFree();

      // *** �Խù� ��, �������� ***
      if(empty($pageIdx)) $pageIdx = 1;
      
      $PostNum  = 15;
      $WidthNum = 10;
       
      $StartNum = ( $pageIdx - 1 ) * $PostNum;
      $EndNum = $PostNum;

      $qry  = " Select * From bbs_admin_cate Where c_tablename='$a_tablename' Order by c_cate limit $StartNum,$EndNum";
			$mysql->ParseExec($qry); 

      // *** ����¡ class *****
      include("../../config/page_manager.php"); 

      // *** ����¡ *****
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
			alert("�з��ڵ带 �Է��Ͽ� �ֽʽÿ�");
			frmAdd.c_cate.focus();
			return;
		}
		else if (Digit(frmAdd.c_cate.value)) {
			alert("�з��ڵ�� ���ڷ� �Է��Ͽ� �ֽʽÿ�");
			frmAdd.c_cate.focus();
			return;
		}
		else if (frmAdd.c_catename.value == "") {
			alert("�з����� �Է��Ͽ� �ֽʽÿ�");
			frmAdd.c_catename.focus();
			return;
		}
		else {	
			frmAdd.submit();
    }
	}


	function CheckFormMod(frmMod) {

		if (frmMod.c_catename.value == "") {
			alert("�з����� �Է��Ͽ� �ֽʽÿ�");
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
				<td><img src="/pages/admin/images/common/bullet_box_gray.gif"><?=$a_bbsname?> �з� ����</td>
			</tr>
		</table>

		<table width="100%" class="bbsCont" cellspacing="1" summary="������ ��� ����">
			<colgroup>
				<col width="10%"/>
				<col />
				<col width="10%"/>
				<col width="15%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">�ڵ�</th>
					<th scope="col">�з���</th>
					<th scope="col">��뿩��</th>
					<th scope="col">���</th>
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
						<option value="1">�� ��</option>
						<option value="0">������</option>
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
<!-- ��� �� ����	-->
	<? 
			$num = 1;	
			while($mysql->FetchInto(&$col)) { 	

				$mysql2 = new Mysql_DB;
				$mysql2->Connect();

				//*** ī�װ��� �Խù� �� ****
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
						<option value="1" <? if($col[c_use] == "1") { ?>selected<? } ?>>�� ��</option>
						<option value="0" <? if($col[c_use] == "0") { ?>selected<? } ?>>������</option>
					</select>
				</td>
				<td class="acenter">
					<a href="javascript:frmMod<?=$num ?>.submit();">
						<img src="/pages/admin/images/bbs/btn_modify.gif" align="absmiddle" border="0">
					</a>
					<a href="javascript:<? if($ctotal > 0) { ?>alert('<?=$col[c_catename] ?> ī�װ��� ����� �Խñ��� �����մϴ�');<? } else { ?>Delete(<?=$col[c_cate] ?>)" onclick="return confirm('���� �����Ͻðڽ��ϱ�? ������ �ϼ���.');<? } ?>">
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
						<!-- �⺻ paging -->
						<ul>
							<?=$pageList?>
						</ul>
					</td>
				</tr>
				<td height="40" colspan="4" align="center">
					<a href="<?=$pageUrl?>&page=/pages/admin/bbs/bbs_admin.php">
					<img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="���" /></a>					
				</td>
			</tfoot>
		</table>
<?  } //  �з� ����Ʈ 

		// --- �з� �ڵ� ����-------------------------------------------------------------------
		function CateAdd(){	 
			global $a_idx, $a_tablename, $c_cate, $c_catename,  $c_use;
			global $mysql, $pageUrl;
		
			$qry  = " Select * From bbs_admin_cate Where c_tablename='$a_tablename' and c_cate = $c_cate ";
			$mysql->ParseExec($qry); 
			if ($mysql->RowCount() > 0) {
				
				message("�ڵ尪�� �ߺ� �Դϴ�");
				
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