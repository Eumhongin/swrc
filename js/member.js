<!--
// ���շα���â ���� ���ȿ��� ����

function fn_getIpinWin(nURL) {
    wWidth = 360;
    wHight = 120;    
    wX = (window.screen.width - wWidth) / 2;
    wY = (window.screen.height - wHight) / 2;
	var w = window.open("/G-PIN/AuthRequest.jsp?path="+nURL, "gPinLoginWin", "directories=no,toolbar=no,left="+wX+",top="+wY+",width="+wWidth+",height="+wHight);
}

//�Ǹ����� Open â
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
//���ĺ�, ���� �˻�
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
			alert( '�Էµ� ���̵� �����ϴ�.' );
			$('usr_id').select();
			return false;
		}

		if( $('usr_id').value.length < 4 ){
			alert( '�Էµ� ���̵�� 4���� �̻��̾ �մϴ�.' );
			$('usr_id').select();
			return false;
		}

		if( !isAlphaNumeric($('usr_id').value) ){
			alert("���̵� Ư�����ڴ� ����Ҽ� �����ϴ�. ��,���� ���ո� �����մϴ�");
			$('usr_id').select();
			return false;
		}
	}

	if ( $('usr_pw') ){	// ��й�ȣ����
		if( $('usr_pw').value.length < 4 ){
			alert( ' ��й�ȣ�� 4�ڸ� �̻��Դϴ�.' );
			$('usr_pw').select();
			return false;
		}
	}

	if ( $('usr_pw1') ){	// ��й�ȣ����
		if( $('usr_pw1').value.length < 4 ){
				alert( ' ��й�ȣ Ȯ���� 4�ڸ� �̻��Դϴ�.' );
				$('usr_pw1').select();
				return false;
		}
		if ( $('usr_pw1').value != $('usr_pw').value ){
				alert( ' �Է� ��й�ȣ�� Ȯ�� ��й�ȣ�� ��ġ���� �ʽ��ϴ�' );
				$('usr_pw').select();
				return false;
		}
	}

	if ( $('usr_name') ){	// �Ǹ�����
		if( $('usr_name').value=="" ){
				alert( ' �Ǹ��� �Էµ��� �ʾҽ��ϴ� ' );
				$('usr_name').select();
				return false;
		}
	}

	if ( $('usr_birth1') ){	// �������
		if( $('usr_birth1').value.length!=4 ){
				alert( ' ������� �⵵�� 4�ڸ� �����Դϴ�. ' );
				$('usr_birth1').select();
				return false;
		}
		if( $('usr_birth2').value == '' ){
				alert( ' ����� ������ �Էµ��� �ʾҽ��ϴ�. ' );
				return false;
		}
		if( $('usr_birth3').value == '' ){
				alert( ' ����� ���� ������ �Էµ��� �ʾҽ��ϴ�. ' );
				return false;
		}
	}
	if ( $('usr_zipcode1') ){	 // ������ �ּ�
		if( $('usr_zipcode1').value=='' ){
				alert( ' �����ȣ ������ �Է����ּ��� ' );
				$('usr_zipcode1').select();
				return false;
		}
		if( $('usr_zipcode2').value == '' ){
				alert( ' �����ȣ ������ �Է����ּ���' );
				$('usr_zipcode2').select();
				return false;
		}
		if( $('usr_addr').value == '' ){
				alert( ' �ּ������� �����ϴ�. ' );
				$('usr_addr').select();
				return false;
		}		
	}

	if ( $('usr_phone1') ){	// ����ó
		if( $('usr_phone1').value=='' ){
				alert( ' ����ó ������ �Է����ּ��� ' );
				$('usr_phone1').select();
				return false;
		}
		if( $('usr_phone2').value == '' ){
				alert( ' ����ó ������ �Է����ּ���' );
				$('usr_phone2').select();
				return false;
		}
		if( $('usr_phone3').value == '' ){
				alert( ' ����ó ������ �Է����ּ���. ' );
				$('usr_phone3').select();
				return false;
		}
	}
	if ( $('usr_mail') ){	// �̸���
		if( $('usr_mail').value=='' ){
				alert( ' �̸��� ���̵� �Է����ּ��� ' );
				$('usr_mail').select();
				return false;
		}
		if( $('usr_mailaddr').value == '' ){
				alert( ' �̸��� ������ ������ �Է����ּ���' );
				$('usr_mailaddr').select();
				return false;
		}
	}

	if ($('p').value=='insert' && $('idChk').value !='ok' ){
		 alert('���̵� �ߺ�Ȯ���� �ʿ��մϴ�');
		 return false;
	}
	return true;
}

function idCheck(){
   var chkid = document.getElementById('usr_id').value;
   if(chkid=="") {
      alert('���̵� �Է��ϼ���');
      document.getElementById('usr_id').focus();
      return;
   }else if(Alpha.indexOf(chkid.substring(0,1))<=0 || chkid.length < 5 || chkid.length > 15) {	   
		alert("���̵��� ù���ڴ� �������̰�\n�����ڿ� ������ �������� ���̴� 5~15�ڸ� �Դϴ�.");	
		document.getElementById('usr_id').focus();
		return;	
	}
   Ext.Ajax.request({ 
      url : '/idCheck.jsp' , 
      params : { idval : chkid }, 
      method: 'GET', 
      waitMsg:'�ߺ�Ȯ����',
      success: function (result,request ) {
                  if(result.responseText==0){
                     Ext.MessageBox.alert('Ȯ��', '��밡���մϴ�');
                     document.getElementById('idChk').value = 'ok';
                     //document.getElementById('usr_id').readOnly = true;
                  }else{
                     Ext.MessageBox.alert('Ȯ��', '�̹� ������� ���̵��Դϴ�');
                     document.getElementById('idChk').value = '';
                  }
               }, 
      failure: function ( result, request) {  
         Ext.MessageBox.alert('Ȯ�ν���', '���������Դϴ�.�����ڹ��ǹٶ��ϴ�.'); 
         document.getElementById('usr_id').value = '';
      }
   });
   
}

function zipsearch(){   
   window.open('/zip.jsp?fn=memJoinForm&pn=usr_zipcode1&qn=usr_zipcode2&an=usr_addr','�����ȣ�˻�', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes, resizable=no,copyhistory=no ,width=500, height=200, left=220,top=250');
}

function deptsearch(usr_id){
   window.open('user_search.jsp?usr_id='+usr_id,'�����˻�', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes, resizable=no,copyhistory=no ,width=550, height=200, left=220,top=250');
}
function deptsearchDel(usr_id){
   window.open('user_search_del.jsp?usr_id='+usr_id,'�����˻�', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes, resizable=no,copyhistory=no ,width=550, height=200, left=220,top=250');
}

function checkDeptUser(usr_id,usr_code){
	if( confirm('ȸ�������� ���� ������ �����մϴ�"') ){
		location.href='user_search_select.jsp?usr_id='+usr_id+'&amp;usr_code='+usr_code;
	}
}

function CheckLogin() {
	var f = document.frmLogin;
	if (f.userid.value=="") {
	   alert('ID�� ����� �ּ���');
	   f.userid.focus();
	   return false;
	}else if(f.userpw.value=="") {
	   alert('��й�ȣ�� ����� �ּ���');
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