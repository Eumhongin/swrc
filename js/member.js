<!--
// 통합로그인창 사용시 보안오류 해재

function fn_getIpinWin(nURL) {
    wWidth = 360;
    wHight = 120;    
    wX = (window.screen.width - wWidth) / 2;
    wY = (window.screen.height - wHight) / 2;
	var w = window.open("/G-PIN/AuthRequest.jsp?path="+nURL, "gPinLoginWin", "directories=no,toolbar=no,left="+wX+",top="+wY+",width="+wWidth+",height="+wHight);
}

//실명인증 Open 창
function fnPopup(nURL){
	window.open('/include/vname_Input.jsp?retUrl1='+nURL, 'popup','width=410, height=590');
}

function mail_select(aaa){
	var f = document.memJoinForm;
	if(document.getElementById('eaddr').value != 'etc') {		
		document.getElementById('usr_mailaddr').value = aaa;
		document.getElementById('usr_mailaddr').focus();
	}else {				
		document.getElementById('usr_mailaddr').value = "";
		document.getElementById('usr_mailaddr').focus();
	}	
}
function mail_select2(aaa){
	var f = document.memJoinForm;
	if(document.getElementById('eaddr2').value != 'etc') {		
		document.getElementById('usr_mailaddr2').value = aaa;
		document.getElementById('usr_mailaddr2').focus();
	}else {				
		document.getElementById('usr_mailaddr2').value = "";
		document.getElementById('usr_mailaddr2').focus();
	}	
}
//알파벳, 숫자 검사
function isAlphaNumeric(s) {
	if (s.length > 0) { 
		sNum = s;
		for (i=0; i<sNum.length; i++) {
			if (!(((sNum.charAt(i) >= 'A' && sNum.charAt(i) <= 'Z') || 
					sNum.charAt(i) >= 'a' && sNum.charAt(i) <= 'z') || 
					(sNum.charAt(i) >= '0' && sNum.charAt(i) <= '9')) ) {
				return false;
			}
		}
		return true;
	} else { 
		return false; 
	}
}

var Alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
Num = '0123456789';

function checkValue()
{
	if ( $('usr_id') ){
		if( $('usr_id').value.length == 0 ){
			alert( '입력된 아이디가 없습니다.' );
			$('usr_id').select();
			return false;
		}

		if( $('usr_id').value.length < 4 ){
			alert( '입력된 아이디는 4자이 이상이어여 합니다.' );
			$('usr_id').select();
			return false;
		}

		if( !isAlphaNumeric($('usr_id').value) ){
			alert("아이디에 특수문자는 사용할수 없습니다. 영,숫자 조합만 가능합니다");
			$('usr_id').select();
			return false;
		}
	}

	if ( $('usr_pw') ){	// 비밀번호정보
		if( $('usr_pw').value.length < 4 ){
			alert( ' 비밀번호는 4자리 이상입니다.' );
			$('usr_pw').select();
			return false;
		}
	}

	if ( $('usr_pw1') ){	// 비밀번호정보
		if( $('usr_pw1').value.length < 4 ){
				alert( ' 비밀번호 확인은 4자리 이상입니다.' );
				$('usr_pw1').select();
				return false;
		}
		if ( $('usr_pw1').value != $('usr_pw').value ){
				alert( ' 입력 비밀번호와 확인 비밀번호가 일치하지 않습니다' );
				$('usr_pw').select();
				return false;
		}
	}

	if ( $('usr_name') ){	// 실명정보
		if( $('usr_name').value=="" ){
				alert( ' 실명인 입력되지 않았습니다 ' );
				$('usr_name').select();
				return false;
		}
	}

	if ( $('usr_birth1') ){	// 생년월일
		if( $('usr_birth1').value.length!=4 ){
				alert( ' 생년월일 년도는 4자리 숫자입니다. ' );
				$('usr_birth1').select();
				return false;
		}
		if( $('usr_birth2').value == '' ){
				alert( ' 생년월 정보가 입력되지 않았습니다. ' );
				return false;
		}
		if( $('usr_birth3').value == '' ){
				alert( ' 생년월 일자 정보가 입력되지 않았습니다. ' );
				return false;
		}
	}
	if ( $('usr_zipcode1') ){	 // 거주지 주소
		if( $('usr_zipcode1').value=='' ){
				alert( ' 우편번호 정보를 입력해주세요 ' );
				$('usr_zipcode1').select();
				return false;
		}
		if( $('usr_zipcode2').value == '' ){
				alert( ' 우편번호 정보를 입력해주세요' );
				$('usr_zipcode2').select();
				return false;
		}
		if( $('usr_addr').value == '' ){
				alert( ' 주소정보가 없습니다. ' );
				$('usr_addr').select();
				return false;
		}		
	}

	if ( $('usr_phone1') ){	// 연락처
		if( $('usr_phone1').value=='' ){
				alert( ' 연락처 정보를 입력해주세요 ' );
				$('usr_phone1').select();
				return false;
		}
		if( $('usr_phone2').value == '' ){
				alert( ' 연락처 정보를 입력해주세요' );
				$('usr_phone2').select();
				return false;
		}
		if( $('usr_phone3').value == '' ){
				alert( ' 연락처 정보를 입력해주세요. ' );
				$('usr_phone3').select();
				return false;
		}
	}
	if ( $('usr_mail') ){	// 이메일
		if( $('usr_mail').value=='' ){
				alert( ' 이메일 아이디 입력해주세요 ' );
				$('usr_mail').select();
				return false;
		}
		if( $('usr_mailaddr').value == '' ){
				alert( ' 이메일 도메인 정보를 입력해주세요' );
				$('usr_mailaddr').select();
				return false;
		}
	}

	if ($('p').value=='insert' && $('idChk').value !='ok' ){
		 alert('아이디 중복확인이 필요합니다');
		 return false;
	}
	return true;
}

function idCheck(){
   var chkid = document.getElementById('usr_id').value;
   if(chkid=="") {
      alert('아이디를 입력하세요');
      document.getElementById('usr_id').focus();
      return;
   }else if(Alpha.indexOf(chkid.substring(0,1))<=0 || chkid.length < 5 || chkid.length > 15) {	   
		alert("아이디의 첫문자는 영문자이고\n영문자와 숫자의 조합으로 길이는 5~15자리 입니다.");	
		document.getElementById('usr_id').focus();
		return;	
	}
   Ext.Ajax.request({ 
      url : '/idCheck.jsp' , 
      params : { idval : chkid }, 
      method: 'GET', 
      waitMsg:'중복확인중',
      success: function (result,request ) {
                  if(result.responseText==0){
                     Ext.MessageBox.alert('확인', '사용가능합니다');
                     document.getElementById('idChk').value = 'ok';
                     //document.getElementById('usr_id').readOnly = true;
                  }else{
                     Ext.MessageBox.alert('확인', '이미 사용중인 아이디입니다');
                     document.getElementById('idChk').value = '';
                  }
               }, 
      failure: function ( result, request) {  
         Ext.MessageBox.alert('확인실패', '서버오류입니다.관리자문의바랍니다.'); 
         document.getElementById('usr_id').value = '';
      }
   });
   
}

function zipsearch(){   
   window.open('/zip.jsp?fn=memJoinForm&pn=usr_zipcode1&qn=usr_zipcode2&an=usr_addr','우편번호검색', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes, resizable=no,copyhistory=no ,width=500, height=200, left=220,top=250');
}

function deptsearch(usr_id){
   window.open('user_search.jsp?usr_id='+usr_id,'직원검색', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes, resizable=no,copyhistory=no ,width=550, height=200, left=220,top=250');
}
function deptsearchDel(usr_id){
   window.open('user_search_del.jsp?usr_id='+usr_id,'직원검색', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes, resizable=no,copyhistory=no ,width=550, height=200, left=220,top=250');
}

function checkDeptUser(usr_id,usr_code){
	if( confirm('회원정보와 직원 정보를 연결합니다"') ){
		location.href='user_search_select.jsp?usr_id='+usr_id+'&amp;usr_code='+usr_code;
	}
}

function CheckLogin() {
	var f = document.frmLogin;
	if (f.userid.value=="") {
	   alert('ID를 기록해 주세요');
	   f.userid.focus();
	   return false;
	}else if(f.userpw.value=="") {
	   alert('비밀번호를 기록해 주세요');
	   f.userpw.focus();
	   return false;
	}
	if (f.chkSaveID.checked) {
	   setCookie('ADMIN_USER_ID',f.userid.value,100);
	}
	return true;
}

function setCookie(name, value, expiredays ) {
   var todayDate = new Date();
   todayDate.setDate( todayDate.getDate() + expiredays );
   document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
 }
function CheckEnter() {
   if (event.keyCode==13) CheckLogin();
}

function CheckMove() {
   if (event.keyCode==13) document.frmLogin.userpw.focus();
}

function checkSearch(user_id,tp){
	var typeValue
	if ( user_id == "" ){
		try{
			typeValue = Form.getInputs('frmCheckPwd','radio','user_id').find(function(radio) { return radio.checked; }).value;
		}catch(err){}
		if( typeValue == undefined ||  typeValue == 'undefined' ){
			alert('typeValue');
		}else{
			location.href='idpw_result_send.jsp?user_id='+typeValue+'&snd='+tp
		}

	}else{
		location.href='idpw_result_send.jsp?user_id='+user_id+'&snd='+tp
	}
}

//-->