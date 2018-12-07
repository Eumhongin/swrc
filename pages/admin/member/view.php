<?
	include("../../config/mysql.inc.php");  
	include("../../config/comm.inc.php");  

	$user_id = $_REQUEST["user_id"];

	//pageUrl 셋팅
	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();
	
	$sql = "Select * From members,m_level Where ch_member = l_level and user_id='$user_id'";
	$mysql->ParseExec($sql); 
	$mysql->FetchInto(&$col);

	if ($mysql->RowCount() <> 1) {
	  	message("회원으로 등록되어 있지 않습니다");
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
  if(confirm("정말 삭제 하시겠습니까?") == true) {
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
				<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> 회원정보 보기 *표시가 
                  된 곳은 필수 항목입니다.</td>
			</tr>
		</table>

		<table class="bbsCont" cellspacing="0" summary="회원정보">
			<caption class="none">회원정보 보기</caption>
			<colgroup>
				<col width="20%" />
				<col width="30%" />
				<col width="20%" />
				<col width="30%" />
			</colgroup>
			<thead>
				<tr>
					<th colspan="4">회원정보 보기</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<th>아이디*</th>
				<td class="tal" colspan="3"><?=$user_id ?></td>
			</tr>
			<tr>
				<th>이름*</th>
				<td class="tal" colspan="3"><?=$user_name ?></td>
			</tr>
			<tr>
				<th>등급</th>
				<td class="tal" colspan="3"><?if($ch_member == 1){?>회원<?}else if($ch_member == 2){?>관리자<?}?></td>
			</tr>
			<tr>
				<th>회원번호(학번,교번 등)</th>
				<td class="tal" colspan="3"><?=$user_num ?></td>
			</tr>
			<tr>
				<th>E-mail</th>
				<td class="tal" colspan="3"><?=$email ?></td>
			</tr>
			<tr>
				<th>전화</th>
				<td class="tal" colspan="3"><?=$tel1 ?>-<?=$tel2 ?>-<?=$tel3 ?></td>
			</tr>
			<tr>
				<th>이동전화</th>
				<td class="tal" colspan="3"><?=$hp1 ?>-<?=$hp2 ?>-<?=$hp3 ?></td>
			</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4">

					<a href="<?=$pageUrl?>&amp;page=/pages/admin/member/modify.php&amp;user_id=<?=$user_id ?>&pageIdx=<?=$pageIdx ?>&search=<?=$search ?>&keyword=<?=$keyword?>&keyword2=<?=$keyword2?>"><img src="/pages/admin/images/bbs/btn_modify_big.gif" alt="수정" /></a>
					<a href="#" onclick="Delete('<?=$user_id ?>')">
						<img src="/pages/admin/images/bbs/btn_delete_big.gif" alt="삭제" />
					</a>
					<!--
					<a href="#" onclick="List()">
					-->
					<a href="<?=$pageUrl?>&amp;page=/pages/admin/member/list.php">
						<img src="/pages/admin/images/bbs/btn_list_big.gif" alt="목록" />
					</a>
					</td>
				</tr>
			</tfoot>
		</table>			