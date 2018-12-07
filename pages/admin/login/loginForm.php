<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
	<meta http-equiv="Cache-Control" content="No-Cache">
	<meta http-equiv="Pragma" content="No-Cache">
	<meta http-equiv="imagetoolbar" content="no">
	<title>STRC 관리자</title>
	<link rel="stylesheet" type="text/css" href="/pages/admin/css/admin_common.css"/>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/prototype.js"></script>

	<script type="text/javascript">

		function	on_show() {
			document.loginForm.p_id.focus();
			return;
		}

		// 로그인 함수
		function login() {
			var loginForm = $("loginForm");
			
			if($F("p_id").blank()) {
				alert("아이디를 입력해 주세요.");
				$("p_id").focus();
				return false;
			}
			
			if($F("p_pass").blank()) {
				alert("패스워드를 입력해 주세요.");
				$("p_pass").focus();
				return false;
			}

			return true;
		}

	</script>
</head>

<body onload="on_show();" style="margin:6;padding:80">
<table width="724" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td style="background:url('/pages/admin/images/index/top_back.gif')">
		  <table width="100%" height="93" cellpadding="0" cellspacing="0">
			<tr valign="top">
			  <td style="padding:26 0 0 28"> </td>
			  <td style="padding:44 28 0 0" align="right">
				<a href="/" target="_blank"><img src="/pages/admin/images/index/top_home.gif"></a>
			  </td>
			</tr>
		  </table>
		</td>
	</tr>
	<tr>
    <td height="306" style="background:url('/pages/admin/images/index/middle_back.gif');padding:10 0 0 300;" valign="top">
      <table width="389" cellpadding="0" cellspacing="0">
        <tr>
          <td height="52" style="padding-left:22px"><img src="/pages/admin/images/index/index_text.gif"></td>
        </tr>
        <tr>
          <td height="192" style="background:url('/pages/admin/images/index/login_back.gif');padding-top:38px" align="center">
			<form name="loginForm" method="post" action="admin_login.php" onsubmit="return login();">
				<table width="280" cellpadding="0" cellspacing="0">
				  <tr height="22">
					<td width="74" class="f_11 f_gray"><img src="/pages/admin/images/common/bullet_arrow_gray.gif"> 아이디</td>
					<td><input type="text" name="p_id" size="22" class="basic" tabindex="1"></td>
					<td rowspan="2"><input type="image" src="/pages/admin/images/index/btn_login.gif" tabindex="3"></td>
				  </tr>
				  <tr height="22">
					<td class="f_11 f_gray"><img src="/pages/admin/images/common/bullet_arrow_gray.gif"> 비밀번호</td>
					<td><input type="password" name="p_pass" size="22" class="basic" tabindex="2"></td>
				  </tr>
				</table>
			</form>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td height="31" style="background:url('/pages/admin/images/index/bottom_back.gif');padding-bottom:7px;" align="center">
      <span class="acenter f_white f_11 vtop">Copyright by 2013 STRC. All Rights Reserved.</span>
    </td>
  </tr>

</table>		 

</body>
</html>

