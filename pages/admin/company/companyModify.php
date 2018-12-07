<?

	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");
 
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect(); 



if($code == "modify")
{
	//호실 입력 받도록 수정하면서 주석
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

  // *** 게시물 수, 페이지수 ***
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
  // *** 페이징 class *****
  include("../../config/page_manager.php"); 

  // *** 페이징 *****
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

									<!-- // 게시판 머리말 -->
									<?

									switch($h_gubun){
										case 1:
											$temp = "ICTPark 1관";
											break;
										case 2:
											$temp = "ICTPark 2관";
											break;
										case 3:
											$temp = "CT Idea HUB";
											break;
										case 4:
											$temp = "ICTPark 3관";
											break;
										case 5:
											$temp = "ICTPark 4관";
											break;
										default:
											$temp = "알수 없음";
									}
									/*
									if($h_gubun == 1) { $temp = "본관"; }
									else if($h_gubun == 2) { $temp = "별관"; }
									else if($h_gubun == 3) { $temp = "CT Idea HUB"; }
									*/
									?>

									
			<table width="100%" height="26" cellpadding="0" cellspacing="0">
				<tr>
					<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> <?=$temp?> </td>
				</tr>
			</table>
           
			<table class="bbsCont" cellspacing="0" summary="기업 정보 등록을 하는 표">
				<caption class="none">기업 등록</caption>
				<colgroup>
					<col width="20%" />
					<col width="10%" />
					<col width="10%" />
					<col />
					<col width="10%" />
				</colgroup>
				<thead>
					<tr>
						<th colspan="5">기업 등록</th>
					</tr>
					<tr>
						<th>업체명</th>
						<th>대표자</th>	
						<th>전화번호(FAX)</th>
						<th class="pad_l10">사업내용</th> 
						<th>호실</th>
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
							$temp = "ICTPark 1관";
							$h_ho = $h_re_ho;
							break;
						case 2:
							$temp = "ICTPark 2관";
							$h_ho = $h_re_ho;
							break;
						case 3:
							$temp = "ICTPark 교육센터";
							$h_ho = $h_re_ho;
							break;
						case 4:
							$temp = "ICTPark 3관";
							$h_ho = $h_re_ho;
							break;
						default:

						if(!$h_gubun) { $h_gubun = 1; }
							switch($h_gubun){
								case 1:
									$temp = "ICTPark 1관";
									break;
								case 2:
									$temp = "ICTPark 2관";
									break;
								case 3:
									$temp = "ICTPark 교육센터";
									break;
								case 4:
									$temp = "ICTPark 3관";
									break;
								default:
									$temp = "모름";
							}
				  }
/*
                  if($h_re_gubun == 1) {
                    $temp = "본관";
                    $h_ho = $h_re_ho;
                  } elseif($h_re_gubun == 2) {
                    $temp = "별관";
                    $h_ho = $h_re_ho;
				  }else if($h_re_gubun == 3) {
					$temp = "CT Idea HUB";
				} else {
					if($h_gubun == 1 OR !$h_gubun) {$temp = "본관"; }
					else if($h_gubun == 2) $temp = "별관";
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
			
				<table class="bbsCont" cellspacing="0" summary="기업 정보 등록을 하는 표">
					<caption class="none">기업 등록</caption>
						<colgroup>
							<col width="15%" />
							<col width="35%" />
							<col width="15%" />
							<col width="35%" />
						</colgroup>
						<tbody>
							<tr>
								<th>호실</th>
								<td>
								<?
									//호실 입력받도록 하면서 주석
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
								<th>업체명</th>
								<td><input type=text name="cname" style="width:95%" value="<?=$cname?>"class="basic"/></td>
								<th>대표자명</th>
								<td><input type=text name="onwer" style="width:95%" value="<?=$onwer?>"class="basic"/></td>
							</tr>
							<tr>
								<th>전화번호</th>
								<td><input type=text name="phone" style="width:95%" value="<?=$phone?>"class="basic"/></td>
								<th>홈페이지</th>
								<td><input type=text name="homepage" style="width:95%" value="<?=$homepage?>"class="basic"/></td>
							</tr>
							<tr>
								<th>사업내용</th>
								<td colspan="3"><input type=text name=content style="width:98%" value="<?=$content?>" class="basic"/></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4">
									<input type="submit" value="수정">
									<input type="button" value="취소" onClick="location.href='<?=$pageUrl?>&page=/pages/admin/company/companyList.php&h_gubun=<?=$h_gubun?>&floor=<?=$floor?>'">
								</td>
							</tr>
						</tfoot>
						<input type="hidden" name="loop_num" value="<?=$loop_num?>" />

            <?  
                $mysql->ParseFree();
                
        ?>
					</table>
				</form>