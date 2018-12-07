<?

  include("../../config/mysql.inc.php");     //** 접속통계
  include("../../config/comm.inc.php");
  
  //pageUrl 셋팅
  $pageUrl .= $pageName;

	$keyword = $_REQUEST["keyword"];
	$keyword2 = $_REQUEST["keyword2"];
	$search = $_REQUEST["search"];
	$pageIdx = $_REQUEST["pageIdx"];

?>
<link rel=stylesheet type='text/css' href='/css/dip.css'>
<script src='/js/eButton.js'></script>
<script src='/js/comm.js'></script>
<script src='/js/user.js'></script>
<script type="text/javascript">
<!--
//비밀번호 변경
function admin_pwd_modify(){
	 window.open("/pages/admin/member/pwd_modify.php?user_id=<?=$user_id ?>","pwd","scrollbars=no,toolbar=no,directories=no,menubar=no,resizable=no,status=no,width=420,height=245'");
}

function modifyform(){
	if(document.getElementById("user_id").value == ""){
		alert("아이디를 입력하세요");
		document.getElementById("user_id").focus();
		return;
	}
	if(document.getElementById("user_pass").value == ""){
		alert("비밀번호를 입력하세요");
		document.getElementById("user_pass").focus();
		return;
	}
	if(document.getElementById("user_name").value == ""){
		alert("이름을 입력하세요");
		document.getElementById("user_name").focus();
		return;
	}

	frm.submit();

}

-->
</script>

		<table width="100%" height="26" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="/pages/admin/images/common/bullet_box_gray.gif"> 회원정보 수정. *표시가 
                  된 곳은 필수 항목입니다.</td>
			</tr>
		</table>

      <form name="frm" method="post" action="<?=$pageUrl?>&page=/pages/admin/member/regist.php">
      <input type="hidden" name="pageIdx" value="<?=$pageIdx ?>">
      <input type="hidden" name="search" value="<?=$search ?>">
      <input type="hidden" name="keyword" value="<?=$keyword ?>">
	  <input type="hidden" name="keyword2" value="<?=$keyword2 ?>">
	  <input type="hidden" name="mode" value="insert">

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
					<th colspan="4" class="acenter">회원정보 등록</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th class="acenter">아이디*</th>
					<td class="pad_l10 tal" colspan="3">
					<input type="text" id="user_id" name="user_id" size="30" class="basic" />&nbsp;
						<a href="javascript:id_check();">[중복확인]</a>
						<span class="txt pad_l10">ID는 영문소문자, 숫자, (-,_)의 조합으로 이루어져야 합니다.</span>
					</td>
				</tr>
				<tr>
					<th class="acenter">비밀번호*</th>
					<td class="pad_l10 tal" colspan="3"><input type="password" id="user_pass" name="user_pass" size="30" class="basic" /></td>
				</tr>
				<tr>
					<th class="acenter">이름*</th>
					<td class="pad_l10 tal" colspan="3"><input type="text" id="user_name" name="user_name" size="30" class="basic" /></td>
				</tr>
				<tr>
					<th class="acenter">등급*</th>
					<td class="pad_l10 tal" colspan="3">
						<select name="ch_member" class="basic">
							<option value="1" selected>회원</option>
							<option value="2" >관리자</option>
						</select>
					</td>
				</tr>
				<tr>
					<th class="acenter">회원번호(학번,교번 등)</th>
					<td class="pad_l10 tal" colspan="3"><input type="text" id="user_num" name="user_num" size="30" class="basic" /></td>
				</tr>
				<tr>
					<th class="acenter">E-mail</th>
					<td class="pad_l10 tal" colspan="3"><input type="text" id="email" name="email" size="30" class="basic" /></td>
				</tr>
				<tr>
					<th class="acenter">전화</th>
					<td class="pad_l10 tal" colspan="3">
					<input type="text" id="tel1" name="tel1" size="10" class="basic" maxlength="4"/>
					-
					<input type="text" id="tel2" name="tel2" size="10" class="basic" maxlength="4"/>
					-
					<input type="text" id="tel3" name="tel3" size="10" class="basic" maxlength="4"/>
					</td>
				</tr>
				<tr>
					<th class="acenter">이동전화</th>
					<td class="pad_l10 tal" colspan="3">
					<input type="text" id="hp1" name="hp1" size="10" class="basic" maxlength="4"/>
					-
					<input type="text" id="hp2" name="hp2" size="10" class="basic" maxlength="4"/>
					-
					<input type="text" id="hp3" name="hp3" size="10" class="basic" maxlength="4"/>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td height="40" colspan="4" align="center">					
					<a href="#" onclick="modifyform()">
						<img src="/pages/admin/images/bbs/btn_save_big.gif" alt="져장" />
					</a>
					<a href="#" onclick="history.back()">
						<img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="목록" />
					</a>
					</td>
				</tr>

			</tfoot>
	</table>      