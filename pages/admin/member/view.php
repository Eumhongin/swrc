<?
	include("../../config/mysql.inc.php");  
	include("../../config/comm.inc.php");  

	$user_id = $_REQUEST["user_id"];

	//pageUrl ����
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();
	
	$sql = "Select * From members,m_level Where ch_member = l_level and user_id='$user_id'";
	$mysql->ParseExec($sql); 
	$mysql->FetchInto(&$col);

	if ($mysql->RowCount() <> 1) {
	  	message("ȸ������ ��ϵǾ� ���� �ʽ��ϴ�");
	} else {
	


	$user_id    = $col[user_id];
	$user_name    = utf8ToEuckr($col[user_name]);
	$ch_member    = $col[ch_member];
	$user_num    = $col[user_num];
	$email    = $col[email];
	$tel1    = $col[tel1];
	$tel2    = $col[tel2];
	$tel3    = $col[tel3];
	$hp1    = $col[hp1];
	$hp2    = $col[hp2];
	$hp3    = $col[hp3];

 }	
?>
<link rel=stylesheet type='text/css' href='/css/dip.css'>
<script src='/js/eButton.js'></script>
<script src='/js/comm.js'></script>
<script src='/js/user.js'></script>
<script type="text/javascript">
<!--

function Delete(user_id){
  if(confirm("���� ���� �Ͻðڽ��ϱ�?") == true) {
     location.href = "<?=$pageUrl?>&amp;page=/pages/admin/member/delete.php&amp;&user_id="+user_id;
     return;
 }     
}

function List(){
  location.href = "<?=$pageUrl?>&amp;page=/pages/admin/member/list.php";
}
-->
</script>



		<table width="100%" height="26" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> ȸ������ ���� *ǥ�ð� 
                  �� ���� �ʼ� �׸��Դϴ�.</td>
			</tr>
		</table>

		<table class="bbsCont" cellspacing="0" summary="ȸ������">
			<caption class="none">ȸ������ ����</caption>
			<colgroup>
				<col width="20%" />
				<col width="30%" />
				<col width="20%" />
				<col width="30%" />
			</colgroup>
			<thead>
				<tr>
					<th colspan="4">ȸ������ ����</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<th>���̵�*</th>
				<td class="tal" colspan="3"><?=$user_id ?></td>
			</tr>
			<tr>
				<th>�̸�*</th>
				<td class="tal" colspan="3"><?=$user_name ?></td>
			</tr>
			<tr>
				<th>���</th>
				<td class="tal" colspan="3"><?if($ch_member == 1){?>ȸ��<?}else if($ch_member == 2){?>������<?}?></td>
			</tr>
			<tr>
				<th>ȸ����ȣ(�й�,���� ��)</th>
				<td class="tal" colspan="3"><?=$user_num ?></td>
			</tr>
			<tr>
				<th>E-mail</th>
				<td class="tal" colspan="3"><?=$email ?></td>
			</tr>
			<tr>
				<th>��ȭ</th>
				<td class="tal" colspan="3"><?=$tel1 ?>-<?=$tel2 ?>-<?=$tel3 ?></td>
			</tr>
			<tr>
				<th>�̵���ȭ</th>
				<td class="tal" colspan="3"><?=$hp1 ?>-<?=$hp2 ?>-<?=$hp3 ?></td>
			</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4">

					<a href="<?=$pageUrl?>&amp;page=/pages/admin/member/modify.php&amp;user_id=<?=$user_id ?>&pageIdx=<?=$pageIdx ?>&search=<?=$search ?>&keyword=<?=$keyword?>&keyword2=<?=$keyword2?>"><img src="/pages/admin/images/bbs/btn_modify_big.gif" alt="����" /></a>
					<a href="#" onclick="Delete('<?=$user_id ?>')">
						<img src="/pages/admin/images/bbs/btn_delete_big.gif" alt="����" />
					</a>
					<!--
					<a href="#" onclick="List()">
					-->
					<a href="<?=$pageUrl?>&amp;page=/pages/admin/member/list.php">
						<img src="/pages/admin/images/bbs/btn_list_big.gif" alt="���" />
					</a>
					</td>
				</tr>
			</tfoot>
		</table>			