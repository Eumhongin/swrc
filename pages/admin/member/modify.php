<?

  include("../../config/mysql.inc.php");     //** 접속통계
  include("../../config/comm.inc.php");
  


	$pageIdx = $_REQUEST["pageIdx"];
	$search = $_REQUEST["search"];
	$keyword = $_REQUEST["keyword"];
	$keyword2 = $_REQUEST["keyword2"];
	$user_id = $_REQUEST["user_id"];

  //pageUrl 셋팅
  $pageUrl .= $pageName;

  $mysql = new Mysql_DB;
	$mysql->Connect();
	
	$sql = "Select * From members,m_level Where ch_member = l_level and  user_id='$user_id'";
	$mysql->ParseExec($sql); 
	$mysql->FetchInto(&$col);

	if ($mysql->RowCount() <> 1) {
	  	message("회원으로 등록되어 있지 않습니다");
	} else {
	
   $user_id    = $col[user_id];
	$user_name    = utf8ToEuckr($col[user_name]);
	$user_pass    = $col[user_pass];
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
<script src='/js/user.js?ver=1'></script>

		<table width="100%" height="26" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> 회원정보 수정. *표시가 
                  된 곳은 필수 항목입니다.</td>
			</tr>
		</table>

      <form name="frm" method="post" action="<?=$pageUrl?>&page=/pages/admin/member/regist.php">
      <input type="hidden" name="user_id" value="<?=$user_id ?>">
      <input type="hidden" name="pageIdx" value="<?=$pageIdx ?>">
      <input type="hidden" name="search" value="<?=$search ?>">
      <input type="hidden" name="keyword" value="<?=$keyword ?>">
	  <input type="hidden" name="keyword2" value="<?=$keyword2 ?>">
      <input type="hidden" name="mode" value="update">

		<table width="100%" class="bbsCont" cellspacing="1" summary="회원정보">
			<caption class="none">회원정보 보기</caption>
			<colgroup>
				<col width="15%" />
				<col width="35%" />
				<col width="15%" />
				<col width="35%" />
			</colgroup>
			<thead>
				<tr>
					<th colspan="4" class="acenter">회원정보 보기</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th class="acenter">아이디*</th>
					<td class="pad_l10 tal" colspan="3"><?=$user_id ?></td>
				</tr>
				<tr>
					<th class="acenter">비밀번호*</th>
					<td class="pad_l10 tal" colspan="3"><input type="password" id="user_pass" name="user_pass" size="30" class="basic" value="<?=$user_pass?>"/></td>
				</tr>
				<tr>
					<th class="acenter">이름*</th>
					<td class="pad_l10 tal" colspan="3"><input type="text" id="user_name" name="user_name" size="30" class="basic" value="<?=$user_name ?>"/></td>
				</tr>
				<tr>
					<th class="acenter">등급*</th>
					<td class="pad_l10 tal" colspan="3">
						<select name="ch_member" class="basic">
							<option value="1" <?if($ch_member == 1){?>selected<?}?>>회원</option>
							<option value="2" <?if($ch_member == 2){?>selected<?}?> >관리자</option>
						</select>
					</td>
				</tr>
				<tr>
					<th class="acenter">회원번호(학번,교번 등)</th>
					<td class="pad_l10 tal" colspan="3"><input type="text" id="user_num" name="user_num" size="30" class="basic" value="<?=$user_num ?>"/></td>
				</tr>
				<tr>
					<th class="acenter">E-mail</th>
					<td class="pad_l10 tal" colspan="3"><input name="email" type="text" id="email" value="<?=$email ?>" maxlength="30" class="basic"></td>
				</tr>
				<tr>
					<th class="acenter">전화</th>
					<td class="pad_l10 tal" colspan="3">
					<input type="text" id="tel1" name="tel1" size="10" class="basic" maxlength="4" value="<?=$tel1?>"/>
					-
					<input type="text" id="tel2" name="tel2" size="10" class="basic" maxlength="4" value="<?=$tel2?>"/>
					-
					<input type="text" id="tel3" name="tel3" size="10" class="basic" maxlength="4" value="<?=$tel3?>"/>
					</td>
				</tr>
				<tr>
					<th class="acenter">이동전화</th>
					<td class="pad_l10 tal" colspan="3">
					<input type="text" id="hp1" name="hp1" size="10" class="basic" maxlength="4" value="<?=$hp1?>"/>
					-
					<input type="text" id="hp2" name="hp2" size="10" class="basic" maxlength="4" value="<?=$hp2?>"/>
					-
					<input type="text" id="hp3" name="hp3" size="10" class="basic" maxlength="4" value="<?=$hp3?>"/>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td height="40" colspan="4" align="center">
					
					<a href="#" onclick="modifyform()">
						<img src="/pages/admin/images/bbs/btn_modify_big.gif" alt="수정" />
					</a>
					<a href="#" onclick="history.back()">
						<img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="목록" />
					</a>
					</td>
				</tr>

			</tfoot>
	</table>      