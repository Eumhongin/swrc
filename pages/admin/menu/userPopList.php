<?

	include ("../admin_security.php");
	include ("../../../config/mysql.inc.php");

	$pageParameter = $pageUrl.$pageName."&page=".$page;
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$m_query = " Where 1=1 "; 

	if($keyword <> "") {
		$m_query = $m_query ."and $search like '%$keyword%'";   //�˻�
	}

	if($sel_organ_code <> ""){
		$m_query = $m_query ." and organ_code = '".$sel_organ_code."' ";
	}

	//�μ����� ����
	$m_query = $m_query. " Order by organ_code ";

	//��ü ȸ������ ���Ѵ�
	$total_qry = "Select * From t_organ ";
	$total_qry .= $m_query; 
	$mysql->ParseExec($total_qry); 
	$total = $mysql->RowCount();
//	$mysql->ParseFree();

	// *** �Խù� ��, �������� ***
	if (empty($pageIdx)) $pageIdx = 1;

	$PostNum  = 20;
	$WidthNum = 10;
   
	$StartNum = ( $pageIdx - 1 ) * $PostNum;
	$EndNum = $PostNum;

	// ����Ʈ �������� ������ �����ش�
	$qry = "select * from t_organ ";
	$qry .= $m_query ." limit $StartNum,$EndNum";
	$mysql->ParseExec($qry); 

	#echo $qry;
	// *** ����¡ class *****
	include("../../../config/page_manager_popup.php"); 

	// *** ����¡ *****
	$pg = new initPage($pageIdx,$PostNum);
	$pageList = $pg->getPageList( $PHP_SELF, "ch_member=$ch_member&keyword=$keyword&keyword2=$keyword2&search=$search&sorder=$sorder", $total, $WidthNum);  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>(��)�뱸�����л������� ������</title>
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
		alert("Opener ��ü�� �����ų�, ������ �̵����� ó���� �Ϸ��� �� �����ϴ�.");
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
				<img src="/pages/admin/images/common/bullet_box_gray.gif"> �˻��� �Խù� : <?=$total?>��
			</td>
			<td class="aright">
				<select name="sel_organ_code" onchange="fncChengeSelect();">
					<option value="1" <?if($sel_organ_code == "1"){?>selected<?}?> >�濵������</option>
					<option value="2" <?if($sel_organ_code == "2"){?>selected<?}?> >IT(����SW)�����</option>
					<option value="3" <?if($sel_organ_code == "3"){?>selected<?}?> >CT(��ȭ������)�����</option>
					<option value="4" <?if($sel_organ_code == "4"){?>selected<?}?> >����̵���</option>
					<option value="5" <?if($sel_organ_code == "5"){?>selected<?}?> >�̷�����TF</option>
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
						<th scope="col">�μ�</th>
						<th scope="col">�̸�</th>
						<th scope="col">����</th>
						<th scope="col">����</th>
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
								echo "�濵������";
							}else if($col[organ_code] == "2"){
								echo "IT(����SW)�����";
							}else if($col[organ_code] == "3"){
								echo "CT(��ȭ������)�����";
							}else if($col[organ_code] == "4"){
								echo "����̵���";
							}else if($col[organ_code] == "5"){
								echo "�̷�����TF��";
							}
						?>
					</td>
					<td><?=$col["name"]?></td>
				    <td>
						<?=$col["grade"]?></td>
					<td>
						<input type="image" src="/pages/admin/images/bbs/btn_select.gif" value="����" onclick="fncChoiceCharge('<?=$col["user_id"]?>','<?=$col["user_name"]?>')"/>
					</td>

				</tr>
				<?		} 
				
					} else {
				?>
				<tr>
					<td colspan="4" align="center">
						<? if ($p_keyword) { ?>
						"<font size="2" color="red"><?= $p_keyword ?></font>"���� �˻��� ����� �����ϴ�
						<? }?>
					</td>
				</tr>
				<? } ?>	
			</form>
			</table>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" height="40">
					<? // *** ����¡ *****	
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