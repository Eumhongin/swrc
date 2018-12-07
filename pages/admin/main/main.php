<?
	// *** 페이징 class ***
	include ("../../config/mysql.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

?>	
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
		<title>추천학교</title>
	</head>
	<body>

	<!-- 내용 -->
		<table class="bbsCont" cellspacing="0" summary="전문가 목록 보기">
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
					<th scope="col">이미지</th>
					<th scope="col">URL</th>
					<th scope="col">이미지제목</th>
					<th scope="col">이미지설명</th>
					<th scope="col">위치</th>
					<th scope="col">버튼</th>
				</tr>
			</thead>
			<tbody>
<?
	// *** 게시물 리스트 ***
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
						왼쪽
						<?}else{?>
						오른쪽
						<?}?>
					</td>
					<td><?//=$col[regdate]?>
					<a href="<?=$pageUrl?>&page=/pages/admin/main/recomWriteForm.php&mode=edit&recom_chk=<?=$col[recom_chk]?>">[수정]
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
						<a href="<?=$pageUrl?>&page=/pages/admin/main/recomWriteForm.php"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록"/></a>
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