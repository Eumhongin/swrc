<?

	include("../../config/comm.inc.php"); 
	include("../../config/mysql.inc.php");  

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	if ($mode == "") { //��� ��
		  menuform();
	} else if ( $mode == "ok") { 
	    menuAdd();
	}
	
	
	function menuform() {

		global $p_level, $mysql;
	
		//��ϵ� �޴�
		$qry = "select * from m_level where l_level=$p_level";
		$mysql->ParseExec($qry); 
		$mysql->FetchInto(&$col);
		
		$l_levelname = $col[l_levelname];

		//������ �Խ��� ����Ʈ
		$qry = "select a_bbsname, a_tablename, a_reply from bbs_admin";
		$mysql->ParseExec($qry); 
		$bbs_total = $mysql->RowCount();
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
			alert("������ �޴��� �����Ͽ� �ֽʽÿ�");
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
			<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> [�Խ��� ���Ѽ���] * ������ �׸� ���ؼ��� ������ ������ �־����ϴ�.</td>
		</tr>
	</table>

	<table width="100%" class="bbsCont" cellspacing="1" >
	<form name="reg" method="post" action="<? echo $PHP_SELF ?>">
	<input type="hidden" name="p_level" value="<? echo $p_level ?>">
	<input type="hidden" name="mode" value="ok">

		<caption class="none">���� ����</caption>
			<colgroup>
				<col width="12%" />
				<col />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
			</colgroup>
			<thead>
				<tr>
					<th scope="col">�׷��</th>
					<th scope="col">�Խ���</th>
					<th scope="col"><input type="checkbox" onClick="javascript:allcheck(this.checked,'list')">���</th>
					<th scope="col"><input type="checkbox" onClick="javascript:allcheck(this.checked,'read')">�б�</th>
					<th scope="col"><input type="checkbox" onClick="javascript:allcheck(this.checked,'write')">����</th>
					<th scope="col"><input type="checkbox" onClick="javascript:allcheck(this.checked,'reply')">�亯</th>
					<th scope="col"><input type="checkbox" onClick="javascript:allcheck(this.checked,'modify')">����</th>
					<th scope="col"><input type="checkbox" onClick="javascript:allcheck(this.checked,'del')">����</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td rowspan="<? echo $bbs_total + 2 ?>" class="acenter"><? echo $l_levelname ?></td>
				<?
					if ($bbs_total > 0 ) { 
						$num = 1;
						while($mysql->FetchInto(&$col)) { 	
						
							if($col[a_reply] == "N") $disabled = "disabled";
							else $disabled = "";

							//��ϵ� �޴�
							$mysql2 = new Mysql_DB;
							$mysql2->Connect();

							$qry = "select * from m_menu where m_level=$p_level and m_menutable='$col[a_tablename]'";
							$mysql2->ParseExec($qry); 
							$mysql2->FetchInto(&$menu);
						
				?> 
					<td class="acenter"><? echo $col[a_bbsname] ?></td>
					<td class="acenter">
						<input type="checkbox" name="p_list[<? echo $num-1 ?>]" <? if($menu[m_list] == "Y") { ?>checked<? } ?>>���
					</td>
					<td class="acenter">
						<input type="checkbox" name="p_read[<? echo $num-1 ?>]" <? if($menu[m_read] == "Y") { ?>checked<? } ?>>�б� 
					</td>
					<td class="acenter">
						<input type="checkbox" name="p_write[<? echo $num-1 ?>]" <? if($menu[m_write] == "Y") { ?>checked<? } ?>>���� 
					</td>
					<td class="acenter">
						<input type="checkbox" name="p_reply[<? echo $num-1 ?>]" <? if($menu[m_reply] == "Y") { ?>checked<? } ?> <? echo $disabled ?>>�亯 
					</td>
					<td class="acenter">
						<input type="checkbox" name="p_modify[<? echo $num-1 ?>]" <? if($menu[m_modify] == "Y") { ?>checked<? } ?>>���� 
					</td>
					<td class="acenter">
						<input type="checkbox" name="p_del[<? echo $num-1 ?>]" <? if($menu[m_del] == "Y") { ?>checked<? } ?>>����
					</td>
					<input type="hidden" name="p_menutable[<? echo $num-1 ?>]" value="<? echo $col[a_tablename] ?>">
				</tr>
				<?		if($bbs_total <> $num)  {  ?>
				<tr>
				<?		 } 
						$num ++;
						}
					} ?>
				</tr>
				<?
					$qry = "select * from m_menu where m_level=$p_level and m_menutable='all'";
					$mysql->ParseExec($qry); 
					$mysql->FetchInto(&$menu);
				?>
				<tr>
					<td class="acenter"></td>
					<td class="acenter" colspan="7"><input type="checkbox" name="p_admin" <? if($menu[m_menutable] == "all") { ?>checked<? } ?>>ALL</b></td>
				</tr>
				</tbody>
				<tfoot>
					<tr>
						<td height="40" colspan="8" align="center">
							<input type="image" src="/pages/admin/images/bbs/btn_save_big.gif" border="0" align="absmiddle">
							<a href="javascript:history.back()"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" border="0" align="absmiddle"></a>
						</td>
					</tr>
				</tfoot>
			</form>	
			</table>

<?
	
  }  // �޴��� ���� ��

	function menuAdd() {

		global $p_menutable, $p_level,$p_list, $p_write, $p_read, $p_reply, $p_modify, $p_del,$p_admin;
		global $mysql;
		global $pageUrl;

		$p_id = $HTTP_SESSION_VARS[m_id];
		$p_ip = $REMOTE_ADDR;
	

		$qry = "Delete From m_menu Where m_level = $p_level";
		$mysql->ParseExec($qry);

		for ($i = 0; $i < count($p_menutable) ; $i++) {

				// ����Ʈ ����
				if($p_list[$i] == "on") {
					 $list = "Y";
				} else {
					 $list = "N";	
				}
				// ���� ����
				if($p_write[$i] == "on") {
					 $write = "Y";
				} else {
					 $write = "N";	
				}
				// �б� ����
				if($p_read[$i] == "on") {
					 $read = "Y";
				} else {
					 $read = "N";	
				}
				// �亯 ����
				if($p_reply[$i] == "on") {
					 $reply = "Y";
				} else {
					 $reply = "N";	
				}
				// ���� ����
				if($p_modify[$i] == "on") {
					 $modify = "Y";
				} else {
					 $modify = "N";	
				}
				//���� ����
				if($p_del[$i] == "on") {
					 $del = "Y";
				} else {
					 $del = "N";	
				}
				
				$qry  = "Insert into m_menu(m_level, m_menutable, m_list, m_read, m_write,m_reply, m_modify, m_del, ";
				$qry .= " 									m_insertid, m_insertdate, m_insertip)";
				$qry .= " Values ('$p_level','$p_menutable[$i]','$list','$read','$write','$reply','$modify','$del','$p_id',now(),'$p_ip')";
				$mysql->ParseExec($qry);
				
    }

		if($p_admin == "on") {
				
				$qry  = "Insert into m_menu(m_level, m_menutable, m_list, m_read, m_write, m_reply, m_modify, m_del,";
				$qry .= "                   m_insertid, m_insertdate, m_insertip)";
				$qry .= " Values ('$p_level','all','Y','Y','Y','Y','Y','Y','$p_id', now(), '$p_ip')";
				$mysql->ParseExec($qry);
		
		}

		movepage("$pageUrl&page=/pages/admin/group/group.php");
	}

	$mysql->DisConnect();
?>