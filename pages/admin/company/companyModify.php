<?

	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");
 
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect(); 



if($code == "modify")
{
	//ȣ�� �Է� �޵��� �����ϸ鼭 �ּ�
	/*
	$update_que = "UPDATE ho_c1 SET chk = 0, use_uid = '' WHERE use_uid = $uid AND h_gubun = $h_gubun AND floor = $floor";
	$update_rs  = mysql_query($update_que);
	
	for($i = 0 ; $i < $loop_num ; $i++)
	{
		#echo $ho_chk[$i]."<br>";
		if($ho_chk[$i])
		{
			$update_que = "UPDATE ho_c1 SET chk = 1, use_uid = '$uid' WHERE uid = $ho_chk[$i] AND h_gubun = $h_gubun AND floor = $floor";
			$update_rs  = mysql_query($update_que);

			$ho_que = mysql_query("SELECT ho FROM ho_c1 WHERE uid = $ho_chk[$i]");
			$ho_res = mysql_fetch_array($ho_que);

			$up_ho .= $ho_res[ho]." ";

		}
	}
	*/

	$up2_que = "UPDATE ho SET ho = '$ho', cname='$cname', onwer = '$onwer', phone = '$phone', homepage = '$homepage', content = '$content' WHERE uid = $uid";
	@mysql_query($up2_que);
	
	echo "<script>location.href='".$pageUrl."&page=/pages/admin/company/companyList.php&h_gubun=$h_gubun&floor=$floor'</script>";
}


if(!$h_gubun) { $h_gubun = 1; }
switch ($h_gubun){
	case 1:
		$add_query = " AND h_gubun = 1";
		break;
	case 2:
		$add_query = " AND h_gubun = 2";
		break;
	case 3:
		$add_query = " AND h_gubun = 3";
		break;
	case 4:
		$add_query = " AND h_gubun = 4";
		break;
	default:
}

/*
if(!$h_gubun) { $h_gubun = 1; }
if		($h_gubun == 1) { $add_query = " AND h_gubun = 1"; }
else if	($h_gubun == 2) { $add_query = " AND h_gubun = 2"; }
else if	($h_gubun == 3) { $add_query = " AND h_gubun = 3"; }
*/
if($floor) { $add_query .= " AND floor = ".$floor; }


$cnt_que = "SELECT count(uid) AS uid FROM ho WHERE 1=1 AND uid = $uid ".$add_query;
$cnt_rs  = mysql_query($cnt_que);
$cnt_row = mysql_fetch_array($cnt_rs);

$total = $cnt_row[uid];

  // *** �Խù� ��, �������� ***
  if(empty($pageIdx)) $pageIdx = 1;
  if(empty($PostNum)) $PostNum  = 10;
  
  $WidthNum = 10;
   
  $StartNum = ( $pageIdx - 1 ) * $PostNum;
  $EndNum = $PostNum;

  $qry  = " SELECT uid, ho, cname, onwer, phone, hphone, homepage, content, h_gubun, floor, state ";
  $qry .= " FROM ho";
  $qry .= " WHERE 1 = 1 AND uid = $uid ".$add_query;
#  $qry .= " Order by ho limit $StartNum,$EndNum";
  $mysql->ParseExec($qry); 

/*
  // *** ����¡ class *****
  include("../../config/page_manager.php"); 

  // *** ����¡ *****
  $pg = new initPage($pageIdx,$PostNum);
  $search_url = "h_gubun=$h_gubun&floor=$floor&c_num=$c_num&name=".urlencode($name);
  $pageList = $pg->getPageList( $PHP_SELF, $search_url, $total, $WidthNum);  

  $record_num = $total - $PostNum * ($pageIdx - 1);
*/


?>

<script type="text/javascript" src="/config/common.js"></script>
<script type="text/javascript" src="/js/Select.js"></script>
<script type="text/javascript" src="/js/embed.js"></script>
<script type="text/javascript">
<!--
function dip_search(gubun,floor) {
  location.href="<? echo $PHP_SELF ?>?h_gubun="+gubun+"&floor="+floor+"&c_num=<? echo $c_num ?>";
}
-->
</script>

									<!-- // �Խ��� �Ӹ��� -->
									<?

									switch($h_gubun){
										case 1:
											$temp = "ICTPark 1��";
											break;
										case 2:
											$temp = "ICTPark 2��";
											break;
										case 3:
											$temp = "CT Idea HUB";
											break;
										case 4:
											$temp = "ICTPark 3��";
											break;
										case 5:
											$temp = "ICTPark 4��";
											break;
										default:
											$temp = "�˼� ����";
									}
									/*
									if($h_gubun == 1) { $temp = "����"; }
									else if($h_gubun == 2) { $temp = "����"; }
									else if($h_gubun == 3) { $temp = "CT Idea HUB"; }
									*/
									?>

									
			<table width="100%" height="26" cellpadding="0" cellspacing="0">
				<tr>
					<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> <?=$temp?> </td>
				</tr>
			</table>
           
			<table class="bbsCont" cellspacing="0" summary="��� ���� ����� �ϴ� ǥ">
				<caption class="none">��� ���</caption>
				<colgroup>
					<col width="20%" />
					<col width="10%" />
					<col width="10%" />
					<col />
					<col width="10%" />
				</colgroup>
				<thead>
					<tr>
						<th colspan="5">��� ���</th>
					</tr>
					<tr>
						<th>��ü��</th>
						<th>��ǥ��</th>	
						<th>��ȭ��ȣ(FAX)</th>
						<th class="pad_l10">�������</th> 
						<th>ȣ��</th>
					</tr>
				</thead>
				<tbody>					
              <?
                if($pageIdx == 1)   $i = 1;
						    else $i = (($pageIdx - 1) * $PostNum) + 1 ;	

                $mysql->FetchInto(&$row);
					$uid		= $row[uid];
					$ho			= $row[ho];
					$cname		= $row[cname];
					$onwer		= $row[onwer];
					$phone		= $row[phone];
					$hphone		= $row[hphone];
					$homepage	= $row[homepage];
					$content	= $row[content];
					$h_gubun	= $row[h_gubun];
					$floor		= $row[floor];
					$state		= $row[state];

				  switch($h_re_gubun){
						case 1:
							$temp = "ICTPark 1��";
							$h_ho = $h_re_ho;
							break;
						case 2:
							$temp = "ICTPark 2��";
							$h_ho = $h_re_ho;
							break;
						case 3:
							$temp = "ICTPark ��������";
							$h_ho = $h_re_ho;
							break;
						case 4:
							$temp = "ICTPark 3��";
							$h_ho = $h_re_ho;
							break;
						default:

						if(!$h_gubun) { $h_gubun = 1; }
							switch($h_gubun){
								case 1:
									$temp = "ICTPark 1��";
									break;
								case 2:
									$temp = "ICTPark 2��";
									break;
								case 3:
									$temp = "ICTPark ��������";
									break;
								case 4:
									$temp = "ICTPark 3��";
									break;
								default:
									$temp = "��";
							}
				  }
/*
                  if($h_re_gubun == 1) {
                    $temp = "����";
                    $h_ho = $h_re_ho;
                  } elseif($h_re_gubun == 2) {
                    $temp = "����";
                    $h_ho = $h_re_ho;
				  }else if($h_re_gubun == 3) {
					$temp = "CT Idea HUB";
				} else {
					if($h_gubun == 1 OR !$h_gubun) {$temp = "����"; }
					else if($h_gubun == 2) $temp = "����";
					else $temp = "CT Idea HUB";

				} 
*/
            ?>
				<tr>
					<td><?=$cname ?></td>
					<td><?=$onwer ?></td>	
					<td><?=$phone ?></td>	
					<td class="tal"><?=$content ?></td>
					<td><?=$ho ?></td>
				</tr>
				</tbody>
				</table>

				<form name="thisform" method="post" action="<?=$pageUrl?>&page=/pages/admin/company/companyModify.php">
				<input type="hidden" name="h_gubun" value="<?=$h_gubun?>">
				<input type="hidden" name="floor" value="<?=$floor?>">
				<input type="hidden" name="uid"	value="<?=$uid?>">
				<input type="hidden" name="code" value="modify">
			
				<table class="bbsCont" cellspacing="0" summary="��� ���� ����� �ϴ� ǥ">
					<caption class="none">��� ���</caption>
						<colgroup>
							<col width="15%" />
							<col width="35%" />
							<col width="15%" />
							<col width="35%" />
						</colgroup>
						<tbody>
							<tr>
								<th>ȣ��</th>
								<td>
								<?
									//ȣ�� �Է¹޵��� �ϸ鼭 �ּ�
									/*$chk_que = "SELECT * FROM ho_c1 WHERE h_gubun = $h_gubun AND floor = $floor AND (use_uid = $uid OR chk = 0)";
									$chk_rs  = mysql_query($chk_que);
									$loop_num=0;
									WHILE($chk_res = mysql_fetch_array($chk_rs))
									{
										if($chk_res[use_uid] == $uid)	{  $chk = "checked";  }
										else							{  $chk = "";  }
										echo "<input type=checkbox name=ho_chk[{$loop_num}] value='{$chk_res[uid]}' {$chk}>{$chk_res[ho]}&nbsp;&nbsp;&nbsp;";
										$loop_num++;
									}*/
									?>
									<input type="text" name="ho" id="ho" style="width:95%" value="<?=$ho?>" class="basic"/>
								</td>
								<th>-</th><td>-</td>
							</tr>
							<tr>
								<th>��ü��</th>
								<td><input type=text name="cname" style="width:95%" value="<?=$cname?>"class="basic"/></td>
								<th>��ǥ�ڸ�</th>
								<td><input type=text name="onwer" style="width:95%" value="<?=$onwer?>"class="basic"/></td>
							</tr>
							<tr>
								<th>��ȭ��ȣ</th>
								<td><input type=text name="phone" style="width:95%" value="<?=$phone?>"class="basic"/></td>
								<th>Ȩ������</th>
								<td><input type=text name="homepage" style="width:95%" value="<?=$homepage?>"class="basic"/></td>
							</tr>
							<tr>
								<th>�������</th>
								<td colspan="3"><input type=text name=content style="width:98%" value="<?=$content?>" class="basic"/></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4">
									<input type="submit" value="����">
									<input type="button" value="���" onClick="location.href='<?=$pageUrl?>&page=/pages/admin/company/companyList.php&h_gubun=<?=$h_gubun?>&floor=<?=$floor?>'">
								</td>
							</tr>
						</tfoot>
						<input type="hidden" name="loop_num" value="<?=$loop_num?>" />

            <?  
                $mysql->ParseFree();
                
        ?>
					</table>
				</form>