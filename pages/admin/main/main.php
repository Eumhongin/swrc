<?
	// *** ����¡ class ***
	include ("../../config/mysql.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

?>	
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
		<title>��õ�б�</title>
	</head>
	<body>

	<!-- ���� -->
		<table class="bbsCont" cellspacing="0" summary="������ ��� ����">
			<colgroup>
				<col />
				<col width="18%"/>
				<col width="18%"/>
				<col width="18%"/>
				<col width="8%"/>
				<col width="8%"/>
			</colgroup>
			<thead>
				<tr>
					<th scope="col">�̹���</th>
					<th scope="col">URL</th>
					<th scope="col">�̹�������</th>
					<th scope="col">�̹�������</th>
					<th scope="col">��ġ</th>
					<th scope="col">��ư</th>
				</tr>
			</thead>
			<tbody>
<?
	// *** �Խù� ����Ʈ ***
	$qry  = " SELECT recom_url, recom_img_name, recom_chk, "; 
	$qry .= " recom_img_explain, recom_img_title, date_format(regdate, '%Y/%m/%d') AS regdate ";
	$qry .= " FROM recom_img ";
	$mysql->ParseExec($qry);

		while($mysql->FetchInto(&$col)){
?>
				<tr>
					<td class="tal">
						<img src="/pages/main/data/<?=$col[recom_img_name]?>" width="200" height="150">
					</td>
					<td class="tal"><?=$col[recom_url]?> </td>
					<td><?=$col[recom_img_title]?></td>
					<td><?=$col[recom_img_explain]?></td>
					<td>
						<?if($col[recom_chk] == "L"){?>
						����
						<?}else{?>
						������
						<?}?>
					</td>
					<td><?//=$col[regdate]?>
					<a href="<?=$pageUrl?>&page=/pages/admin/main/recomWriteForm.php&mode=edit&recom_chk=<?=$col[recom_chk]?>">[����]
					</td>
				</tr>
<?
		}
?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6">
					<!--
						<a href="<?=$pageUrl?>&page=/pages/admin/main/recomWriteForm.php"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="���"/></a>
						-->
					</td>
				</tr>
			</tfoot>
		</table>
	</body>
</html>
<?
	$mysql->Disconnect();
?>