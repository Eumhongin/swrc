<?

	include("../../config/comm.inc.php"); 
	include("../../config/mysql.inc.php");  

	$mysql = new Mysql_DB;
	$mysql->Connect();

	if ($mode == "") { //��� ��
		  menuform();
	} else if ( $mode == "ok") { 
	    menuAdd();
	}
	
	
	function menuform() {

	global $p_level, $mysql, $pageUrl;
		
	//��ϵ� ���
	$qry = "select * from m_level where l_level=$p_level";
	$mysql->ParseExec($qry); 
	$mysql->FetchInto(&$col);		
	$l_levelname = $col[l_levelname];

	//��޿� ���� ���� ���� ����
	$qry = "select * from t_admin_menu_authority where p_level ='$p_level' order by menu_idx ";
    $mysql->ParseExec($qry); 	
	$i = 0;
    while($mysql->FetchInto(&$row)) {
		$select[$i] = $row[menu_idx];
		$i++;
    }

	//����Ǿ� �ִ� ������ �޴� ����
	$query = " select * from t_admin_menu order by idx ";
	$mysql->ParseExec($query);
	$total = $mysql->RowCount();

?>
<script type="text/javascript">
<!--
function frmcheck()
 {
		var count, menu, fnum;
		count = 0;
		menu = "";
		fnum = "";

		for(i = 0; i < reg.elements.length; i++){
			 if(reg.elements[i].checked == true && reg.elements[i].name == "p_list") {
				 count++;
				 menu = menu + reg.elements[i].value + ",";
			 }
		}
  
	    if(count == 0) {
			alert("������ �޴��� �����Ͽ� �ֽʽÿ�");
			return;
		}

    document.reg.p_num.value = menu;

		reg.submit();
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
			<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> [�ΰ����� ���Ѽ���] * ������ �׸� ���ؼ��� ������ ������ �־����ϴ�. </td>
		</tr>
	</table>


	<table width="100%" class="bbsCont" cellspacing="1" >
		<form name="reg" method="post" action="<?=$pageUrl?>&page=/pages/admin/group/admin_menu.php">
		<input type="hidden" name="p_level" value="<?=$p_level ?>">
		<input type="hidden" name="p_num" value="">
		<input type="hidden" name="mode" value="ok">
		<caption class="none">���� ����</caption>
			<colgroup>
				<col width="25%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th scope="col">�׷��</th>
					<th scope="col">�޴���</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td rowspan="<? echo $total + 2 ?>" class="acenter"><? echo $l_levelname ?></td>
				</tr>
				<?
					if ($total > 0 ) {
					$i = 0;
					while($mysql->FetchInto(&$result)) { 
						?> 
					<tr>
					<td class="acenter">
							<input type="checkbox" name="p_list" value="<?=$result[idx]?>" 
								<?if($result[idx] == $select[$i]){
									$i++;
								?>
									checked
								<?}?>
							>
							<?=$result[menu_name]?>
					</td>
					</tr>
					<?
						}
					} 
		?>

			</tbody>
			<tfoot>
				<tr>
					<td height="40" colspan="2" align="center">
						<a href="javascript:frmcheck()"><img src="/pages/admin/images/bbs/btn_ok_big.gif"></a>
						<a href="<?=$pageUrl?>&page=/pages/admin/group/group.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif"></a>
					</td>
				</tr>
			</tfoot>
		</form>	
	</table>

	<?

	}  // �޴��� ���� ��

	function menuAdd() {

		global $p_list, $p_level,$p_num;
		global $mysql;
		global $pageUrl;

		$qry = "delete from t_admin_menu_authority where p_level = $p_level";
		$mysql->ParseExec($qry);

		$ad_num    = split(",",$p_num);

		for ($i = 0; $i < count($ad_num) - 1 ; $i++) {
						
			$qry  = "insert into t_admin_menu_authority(p_level, menu_idx) ";
			$qry .= " values ('$p_level','$ad_num[$i]')";
			$mysql->ParseExec($qry);
				
		}

		movepage("$pageUrl&page=/pages/admin/group/admin_menu.php&p_level=$p_level");
	}

	$mysql->DisConnect();
	?>