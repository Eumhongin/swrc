<?
	session_start();

	include("../../config/mysql.inc.php");  
	include("../../config/bbs_lib.inc.php");  
	include("../../config/comm.inc.php");  

	$pageParameter = $pageUrl.$pageName."&page=".$page;

	$mysql = new Mysql_DB;
	$mysql->Connect();

 // ** ���̺� ������ ��Ÿ���� ����, �Խ��� ȯ�� ���̺� ���� 
	$path = file_path();

	$path = $path . "/pages/bbs/data/";     
	
	//$path = $path . "\korean\bbs\data\";
	
	if(!(is_dir($path)))	{
	//	chmod($path, 0777);
	//	mkdir($path, 0777);
		
	}
		
	$searchCol = $_REQUEST["searchCol"];
	$searchKeyword = $_REQUEST["searchKeyword"];
	$search = $_REQUEST["search"];
	$keyword = $_REQUEST["keyword"];

	// ** �Խ��� ȯ�� ���̺� ����
	if (!Exist_Table('bbs_admin')) Bbs_Config_Create();
	// ** ÷������ ���̺� ����
	if (!Exist_Table('bbs_file')) Bbs_File_Create();

	if($keyword <> "") {
    if($search == "a_bbsname")   $query = " Where a_bbsname like '%$keyword%'";
    if($search == "a_tablename") $query = " Where a_tablename like '%$keyword%'";
  }
  $total_qry   = " Select * From bbs_admin ";
  $total_qry  .= $query;
  $mysql->ParseExec($total_qry); 
  $total = $mysql->RowCount();
  $mysql->ParseFree();

  // *** �Խù� ��, �������� ***
  if(empty($pageIdx)) $pageIdx = 1;
  
  $PostNum  = 18;
  $WidthNum = 10;
   
  $StartNum = ( $pageIdx - 1 ) * $PostNum;
  $EndNum = $PostNum;

  // ** ���̺� ����Ʈ ����
	$qry  = "Select * From bbs_admin ";
	$qry .= $query ." Order by a_language asc, a_bbsname limit $StartNum,$EndNum ";
	$mysql->ParseExec($qry);

  // *** ����¡ class *****
  include("../../config/page_manager_admin.php"); 

  // *** ����¡ *****
  $pg = new initPage($pageIdx,$PostNum);
  $search_url = "search=$search&keyword=$keyword";
  $pageList = $pg->getPageList( $pageParameter, $search_url, $total, $WidthNum);
?>

<script type="text/javascript" src="/pages/bbs/js/comm.js"></script>


	<p class="contTitle">�˻��� �Խù� : <?=$total?>��</p>

	<form name="frm" method="post">
	<table class="bbsCont" cellspacing="0" summary="�Խ��� ��� ����">
		<colgroup>
			<col width="7%"/>
			<col />
			<col width="7%"/>
			<col width="8%"/>
			<col width="10%"/>
			<col width="6%"/>
			<col width="10%"/>
			<col width="10%"/>
			<col width="8%"/>
				<!--
			<col width="8%"/>
			<col width="8%"/>
				-->
			<col width="8%"/>
		</colgroup>
		<thead>
			<tr>
				<th scope="col">���</th>
				<th scope="col">�Խ��Ǹ�</th>
				<th scope="col">���̺��</th>
				<th scope="col">����</th>
				<th scope="col">����</th>
				<th scope="col">����<br/>÷��</th>
				<th scope="col">��ü/����</th>
				<th scope="col">�Խ��� �ڵ�</th>
				<th scope="col">����</th>
				<!--
				<th scope="col">����</th>
				<th scope="col">�з�</th>
				-->
				<th scope="col">����</th>
			</tr>
		</thead>
		<tbody>
	 <?  
		if($total > 0) {

			while($mysql->FetchInto(&$col)) {  
				
					$a_idx           = $col[a_idx];
          $a_language      = $col[a_language];
          $a_title_bgcolor = $col[a_title_bgcolor];
					$a_bbsname       = utf8ToEuckr($col[a_bbsname]);
					$a_tablename     = $col[a_tablename];
					$a_type          = $col[a_type];
					$a_photo         = $col[a_photo];
					
					if ($a_type == 1)  $bbs_type = "����";
					elseif ($a_type == 2) $bbs_type = "����/�����";
			
					if ($a_photo == "Y") $bbs_state = "����Խ���";
					else $bbs_state = "�ϹݰԽ���";

					$mysql2 = new Mysql_DB;
					$mysql2->Connect();

					//***   ��ü �Խù� �� ****
					$sql = "Select count(*) as total From $a_tablename";
					$mysql2->ParseExec($sql);
					$mysql2->FetchInto(&$row);
					$total = $row[total];

					//***   ���� ��ϵ� �Խù� �� ****
					$sql = "Select count(*) as total From $a_tablename";
					$sql = $sql. " Where period_diff(date_format(b_regdate,'%Y%m%d'),date_format(now(),'%Y%m%d')) = 0";
					$mysql2->ParseExec($sql);
					$mysql2->FetchInto(&$row);
					$today = $row[total];

					$mysql2->ParseFree();

					//***  ÷������ ****
					$a_upload   =  $col[a_upload];
					if ($a_upload == "Y")  $upload_value = "yes";
					else $upload_value = "no";

          $home_url = homepage_url($a_language);

          if($a_language == 1)     $language = "�ѱ�";
          elseif($a_language == 2) $language = "����";
          elseif($a_language == 3) $language = "�Ͼ�";
          elseif($a_language == 4) $language = "�߱���";

	?>
		<tr>
			<td><?=$language?></td>
			<td class="tal">
				<a href="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/list.php&a_idx=<?=$a_idx?>"><font color="blue"><?=$a_bbsname?></font></a>
			</td>
			<td class="tal"><?=$a_tablename?></td>
			<td><?=$bbs_type?></td>
			<td><?=$bbs_state?></td>
			<td><?=$upload_value?></td>
			<td><?=$total?> / <?=$today?></td>
			<td><?=$a_idx?></td>
			<td>
				<a href="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/bbs_admin_form.php&mode=modify&a_idx=<? echo $a_idx  ?>&<? echo $search_url ?>&pageIdx=<? echo $pageIdx ?>"><font color="#F37636"><b>[����]</b></font></a>
			</td>
			<!--
			<td>
				<a href="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/bbs_power.php&a_idx=<? echo $a_idx  ?>"><font color="#F37636"><b>[����]</b></font></a>
			</td>
			<td>
				<?if ($col[a_category] == "Y") {?>
					<a href="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/bbs_cate.php&a_idx=<? echo $a_idx  ?>"><font color="#F37636">
				<?} else {?><font color="#D8D8D8">
				<? } ?>
				<b>[����]</b></font></a>
			</td>
			-->
			<td>
				<a href="javascript:bbs_drop('<? echo $a_idx  ?>')"><font color="#F37636"><b>[����]</b></font></a>
			</td>
		</tr>
	<?}
	}
	?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="12">
					<!-- �⺻ paging -->
					<ul>
						<?=$pageList?>
					</ul>
				</td>
			</tr>
			<tr>
				<td colspan="12">
					<a href="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/bbs_admin_form.php"><img src="/pages/admin/images/bbs/btn_write_big.gif" alt="���"/></a>
				</td>
			</tr>
			<tr>
				<td colspan="12">					
						<select name="searchCol" id="searchCol" title="�˻��з�">
							<option value="a_bbsname">�Խ��Ǹ�</option>
							<option value="a_tablename">���̺��</option>
						</select>
						<input type="text" name="searchKeyWord" value="<?=$searchKeyWord?>" id="searchKeyWord" class="basic" title="�˻���" />
						<input type="image" src="/pages/admin/images/bbs/btn_search.gif" value="�˻�" alt="�˻�" class="vmiddle" />
				</td>
			</tr>
		</tfoot>
	</table>
	</form>
<?
	$mysql->ParseFree();
	$mysql->Disconnect();
?>