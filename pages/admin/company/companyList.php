<?
session_start();
			
	// *** ����¡ class ***
	include ("../../config/page_manager_admin.php");
	include ("../../config/mysql.inc.php");

	$pageParameter = $pageUrl.$pageName."&page=".$page;
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect(); 


if($code == 'add')
{
	$floor = $ChannelCats;

	$chk_que = mysql_query("SELECT COUNT(uid) AS uid FROM ho WHERE cname = '".trim($cname)."' AND h_gubun = $h_gubun AND floor = $floor");
	$chk_res = mysql_fetch_array($chk_que);

	if($chk_res[uid] > 0)
	{
		?>
		<script type="text/javascript">
		<!--
			alert('�̹� ��ϵǾ� �ֽ��ϴ�.\n\nȮ���� �ٽ� �Է��Ͽ� �ֽʽÿ�.');
			history.back();
		//-->
		</script>
		<?
	}

	$cnt_que = mysql_query("SELECT MAX(uid) AS uid FROM ho");
	$cnt_res = mysql_fetch_array($cnt_que);
	$new_uid = $cnt_res[uid] + 1;
	$query = "INSERT INTO ho values ($new_uid, '$ho', '$cname', '$onwer', '$phone', '', '$homepage', '$content', '$h_gubun', '$floor', 1 )";
	$res = mysql_query($query);

}
else if($code == "del")
{
	$del_sql = "DELETE FrOM ho WHERE uid = $uid";
	$del_que = mysql_query($del_sql);

	$del_sql2 = "update ho_c1 set chk=0, use_uid =0 where use_uid = $uid";
	$del_que2 = mysql_query($del_sql2);
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
	case 5:
		$add_query = " AND h_gubun = 5";
		break;
	default:
}

if($floor) { $add_query .= " AND floor = ".$floor; }


$cnt_que = "SELECT count(uid) AS uid FROM ho WHERE 1=1 ".$add_query;

$cnt_rs  = mysql_query($cnt_que);
$cnt_row = mysql_fetch_array($cnt_rs);

$total = $cnt_row[uid];

  // *** �Խù� ��, �������� ***
  if(empty($pageIdx)) $pageIdx = 1;
  if(empty($PostNum)) $PostNum  = 10;
  
  $WidthNum = 10;
   
  $StartNum = ( $pageIdx - 1 ) * $PostNum;
  $EndNum = $PostNum;

  $qry  = " SELECT uid, ho, cname, onwer, phone, hphone, homepage, content, h_gubun, floor, state";
  $qry .= " FROM ho";
  $qry .= " WHERE 1 = 1 ".$add_query;
  $qry .= " Order by ho limit $StartNum,$EndNum";
  $mysql->ParseExec($qry); 


  // *** ����¡ *****
  $pg = new initPage($pageIdx,$PostNum);
  $search_url = "h_gubun=$h_gubun&floor=$floor&c_num=$c_num&name=".urlencode($name);
  $pageList = $pg->getPageList( $pageParameter, $search_url, $total, $WidthNum);  

  $record_num = $total - $PostNum * ($pageIdx - 1);



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
		
		<form name="frm" method="post" action="<?=$pageUrl?>&page=/pages/admin/company/companyList.php">
		<input type="hidden" name="h_gubun" value="<?=$h_gubun ?>"/>
		<input type="hidden" name="floor" value="<? #echo $floor ?>"/>
		<div class="tab_type01">  
			<ul>
				<li <?if($h_gubun == 1){?>class="on"<?}?>>
					<a href="<?=$pageUrl?>&page=/pages/admin/company/companyList.php&h_gubun=1&floor=&c_num=">
						[ICT Park 1��]
					</a>
				</li>
				<li <?if($h_gubun == 2){?>class="on"<?}?>>
					<a href="<?=$pageUrl?>&page=/pages/admin/company/companyList.php&h_gubun=2&floor=&c_num=">
						[ICT Park 2��]
					</a>
				</li>
				<li <?if($h_gubun == 4){?>class="on"<?}?>>
					<a href="<?=$pageUrl?>&page=/pages/admin/company/companyList.php&h_gubun=4&floor=&c_num=">
						[ICT Park 3��]
					</a>
				</li>
				<li <?if($h_gubun == 5){?>class="on"<?}?>>
					<a href="<?=$pageUrl?>&page=/pages/admin/company/companyList.php&h_gubun=5&floor=&c_num=">
						[ICT Park 4��]
					</a>
				</li>
				<li <?if($h_gubun == 3){?>class="on"<?}?>>
					<a href="<?=$pageUrl?>&page=/pages/admin/company/companyList.php&h_gubun=3&floor=&c_num=">
						[CT Idea HUB]
					</a>
				</li>
			</ul>
		</div>

		<div class="aright mar_b10">
			<script type="text/javascript">SS_write("<select name='floor' onchange='frm.submit()' style='border:solid 1px #A0A0A0; font-size:9pt;width:105; background:#EFF9FA;'>"
				  +"  <option value=''>::: �����˻� :::</option>"
				   <?

					switch($h_gubun){
						case 1:
							$chk_num = 8;
							break;
						case 2:
							$chk_num = 6;
							break;
						case 3:
							$chk_num = 4;
							break;
						case 4:
							$chk_num = 6;
							break;
						case 5:
							$chk_num = 3;
							break;
						default:
							$chk_num = 0;
					}

					for($i = 1 ; $i <= $chk_num ; $i++)
					{
						
					?> 
					+"  <option value='<?=$i?>' <? if($floor == $i) {?>selected<? } ?>><? echo $i ?>��</option>"
				   <? 
						
					}
				   ?> 
				  +"</select>");
			</script>
		</div>
		</form>

		
								
			
				<script type="text/javascript">
				<!--
			
					function go_del(uid)
					{
						var yesno
						yesno=confirm("���� �����Ͻðڽ��ϱ�?");
						if (yesno == true)
						{
							location.href="<?=$pageUrl?>&page=/pages/admin/company/companyList.php&h_gubun=<?=$h_gubun?>&floor=<?=$floor?>&pageIdx=<?=$pageIdx?>&code=del&uid="+uid;
						}
					}
				-->
				</script>


			
			<table class="bbsCont" cellspacing="0" summary="���ֱ�� ��� ����">
				<colgroup>
					<col width="5%"/>
					<col width="18%"/>
					<col width="10%"/>
					<col width="10%"/>
					<col />
					<col width="10%"/>
					<col width="8%"/>
					<col width="8%"/>
				</colgroup>
				<thead>
					<tr>
						<th scope="col">����</th>
						<th scope="col">��ü��</th>
						<th scope="col">��ǥ��</th>
						<th scope="col">��ȭ��ȣ(FAX)</th>
						<th scope="col">�������</th>
						<th scope="col">ȣ��</th>
						<th scope="col">����</th>
						<th scope="col">����</th>
					</tr>
				</thead>
				<tbody>
              <?
              if ($total > 0) {
                if($pageIdx == 1)   $i = 1;
						    else $i = (($pageIdx - 1) * $PostNum) + 1 ;	

                while($mysql->FetchInto(&$row)) { 
					$uid		= $row[uid];
					$ho			= $row[ho];
					$cname		= $row[cname];
					$onwer		= $row[onwer];
					$phone		= $row[phone];
					$hphone		= $row[hphone];
					$homepage	= $row[homepage];
					$content	= $row[content];
					$h_gubun	= $row[h_gubun];
					#$floor		= $row[floor];
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
							$temp = "CT Idea HUB";
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
									$temp = "CT Idea HUB";
									break;
								case 4:
									$temp = "ICTPark 3��";
									break;
								default:
									$temp = "��";
							}
				  }

            ?>			
			<form name="addform" method="post" action="<?=$pageUrl?>&page=/pages/admin/company/companyList.php" onsubmit="return chk_form()">
			<input type="hidden" name="code" value="add" />
			<!-- <input type=hidden name="h_gubun" value="<?=$h_gubun?>"> -->
			<!--<input type=hidden name="floor"   value="<?=$floor?>">-->
			<tr>
				<td><?=$record_num--?></td>
				<!--<td><a href="/ITDB/view.php?num=<? echo $num ?>&pageIdx=<? echo $pageIdx ?>&<? echo $search_url ?>"><? echo $cname ?></a></td>-->
				<td class="tal"><?=$cname ?>
					<?if($cname == ""){?>
					-
					<?}?>
				</td>
				<td><?=$onwer ?>
					<?if($onwer == ""){?>
					-
					<?}?>
				</td>	
				<td><?=$phone ?>
					<?if($phone == ""){?>
					-
					<?}?>
				</td>	
				<td class="tal"><?=$content ?>
					<?if($content == ""){?>
					-
					<?}?>
				</td>
				<td><?=$ho ?>
					<?if($ho == ""){?>
					-
					<?}?>
				</td>
				<td>
					
					<a href="<?=$pageUrl?>&page=/pages/admin/company/companyModify.php&h_gubun=<?=$h_gubun?>&floor=<?=$floor?>&uid=<?=$uid?>&pageIdx=<?=$pageIdx?>"><img src="/pages/admin/images/bbs/btn_modify.gif" value="����"  /></a>
				</td>
				<td>
					<a href="#" onclick="go_del('<?=$uid?>')"><img src="/pages/admin/images/bbs/btn_delete.gif" /></a>
				</td>
			</tr>

            <? } 
                $mysql->ParseFree();
                
              } else {
            ?>
			  <tr colspan="8">
				��ϵ� ����� �����ϴ�.
              </tr>
            <? } ?>

			<tr>
			<script type="text/javascript">
			<!--
				function chk_form()
				{
					if(!document.addform.cname.value)
					{
						alert("��ü���� �Է��ϼ���");
						document.addform.cname.focus();
						return false;
					}

					if(!document.addform.onwer.value)
					{
						alert("��ǥ�ڸ��� �Է��ϼ���");
						document.addform.onwer.focus();
						return false;
					}

					if(!document.addform.phone.value)
					{
						alert("����ó�� �Է��ϼ���");
						document.addform.phone.focus();
						return false;
					}
				}
			//-->
			</script>
				<td colspan="2"><input type="text" name="cname" size="25" class="basic"/></td>
				<td><input type="text" name="onwer" size="15" class="basic"/></td>
				<td><input type="text" name="phone" size="15" class="basic"/></td>
				<td><input type="text" name="content" size="40" class="basic"/></td>
				<td><input type="text" name="ho" id="ho" class="basic" /></td>
				<td colspan="2"><input type="image" src="/pages/admin/images/bbs/btn_regist.gif" value="���"></td>
			</tr>
			<tr><td colspan="8">

					<script type="text/javascript">
					<!--

					//�� �з��� ���� �迭
					Cats=new Array(5);
					Cats[0]=new Array(8);
					Cats[1]=new Array(6);
					Cats[2]=new Array(6);
					Cats[3]=new Array(3);
					Cats[4]=new Array(4);

					//���� -->1������ ����
					Cats[0][0]="1";
					Cats[0][1]="2";
					Cats[0][2]="3";
					Cats[0][3]="4";
					Cats[0][4]="5";
					Cats[0][5]="6";
					Cats[0][6]="7";
					Cats[0][7]="8";

					//���� --> 2������ ����
					Cats[1][0]="1";
					Cats[1][1]="2";
					Cats[1][2]="3";
					Cats[1][3]="4";
					Cats[1][4]="5";
					Cats[1][5]="6";

					//ICTPark 3��
					Cats[2][0]="1";
					Cats[2][1]="2";
					Cats[2][2]="3";
					Cats[2][3]="4";
					Cats[2][4]="5";
					Cats[2][5]="6";

					//ICTPark 4��
					Cats[3][0]="1";
					Cats[3][1]="2";
					Cats[3][2]="3";

					//CT Idea HUB
					Cats[4][0]="1";
					Cats[4][1]="2";
					Cats[4][2]="3";
					Cats[4][3]="4";



					//Ư�� ä���� �����ϸ� �ش� ī�װ��� ����
					function BuildCats(num)
					{
						  //ù ��° ī�װ� ����
						  document.addform.ChannelCats.selectedIndex=1;
						  
						  //�ش� ä���� ���� ī�װ� �迭 ���̸�ŭ �ݺ�
						  for(ctr=0;ctr<Cats[num].length;ctr++)
						  {
						   //ī�װ��� �ش��ϴ� �޺��ڽ��� ���� ä��
						   document.addform.ChannelCats.options[ctr]=new Option(Cats[num][ctr],Cats[num][ctr]);
						  }
						  //select ����Ʈ ���� ����
						  document.addform.ChannelCats.length=Cats[num].length;
					}
					//-->
					</Script>

					����:
					<Select Name="h_gubun" OnChange="BuildCats(this.selectedIndex);">
						<option Value="1" <?=($h_gubun == 1)?"selected":""?>>ICTPark 1��</option>
						<option Value="2" <?=($h_gubun == 2)?"selected":""?>>ICTPark 2��</option>
						<option Value="4" <?=($h_gubun == 4)?"selected":""?>>ICTPark 3��</option>
						<option Value="5" <?=($h_gubun == 5)?"selected":""?>>ICTPark 4��</option>
						<option Value="3" <?=($h_gubun == 3)?"selected":""?>>CT Idea HUB</option>
					</Select>
					  
					��:
					<SELECT Name="ChannelCats">
					<?
					switch($h_gubun){
						case 1:
							$chk_num = 8;
							break;
						case 2:
							$chk_num = 6;
							break;
						case 3:
							$chk_num = 4;
							break;
						case 4:
							$chk_num = 6;
							break;
						case 5:
							$chk_num = 3;
							break;
						default:
							$chk_num = 0;
					}
					/*
					if		($h_gubun == 1) { $chk_num = 8; }
					else if ($h_gubun == 2) { $chk_num = 6; }
					else if ($h_gubun == 3) { $chk_num = 4; }
					*/
									
						for($i = 1 ; $i <= $chk_num ; $i++)
						{
						?>
							  <option value='<?=$i?>' <?=($floor == $i)?"selected":""?>><? echo $i ?>��</option>
						
						<?
						}
					
					?> 
					</Select>
				</td>
				<!--onclick="location.href='modify.php?h_gubun=<?=$h_gubun?>&floor=<?=$floor?>&uid=<?=$uid?>&pageIdx=<?=$pageIdx?>'">-->
			</tr>
			</form>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="8">
						<!-- �⺻ paging -->
						<ul>
							<?=$pageList?>
						</ul>
					</td>
				</tr>
			</tfoot>
      </table>