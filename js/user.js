function mb_checkform() {

	var ch_member, phone, mobile;

	for(var i=0; i < frm.elements.length ; i++) { 
	
		if(frm.elements[i].name == 'ch_member' && frm.elements[i].checked == true) {
			ch_member = frm.elements[i].value;
			break;
		}
	}	

	phone = frm.tel1.value;
	phone = phone + frm.tel2.value;
	phone = phone + frm.tel3.value;

	mobile = frm.mobile1.value;
	mobile = mobile + frm.mobile2.value;
	mobile = mobile + frm.mobile3.value;
	
	if (CheckSpaces(frm.user_id, '아이디를 입력하여 주십시오',0)) { return false; }
	else if (IDCheck(frm.user_id, '아이디')) { return false; }
	else if (CheckLen(frm.user_id, '4', '20')) { return false; }
	else if (CheckSpaces(frm.user_pass, '비밀번호를 입력하여 주십시오',0)) { return false; }
	else if (alphaDigit(frm.user_pass, '비밀번호')) { return false; }
	else if (CheckLen(frm.user_pass, '4', '10')) { return false; }
	else if (CheckEqual(frm.user_pass, frm.user_pass_re,'비밀번호')) { return false; }
	else if (frm.question.value == "0") { alert("비밀번호 확인 질문을 선택하여 주십시오");  return false;  }
	else if (CheckSpaces(frm.answer, '비밀번호 확인 답변을 입력하여 주십시오',0)) { return false; }
	else if (CheckSpaces(frm.nickname, '커뮤니티 사용시 사용될 한글아이디를 입력 해주십시요',0)) { return false; }
	else if (CheckSpaces(frm.user_name, '이름을 입력 해주십시요',0)) { return false; }
	else if (CheckSpaces(frm.jumin1, '주민등록번호 앞자리를 입력하여 주십시오',0)) { return false; }
	else if (CheckSpaces(frm.jumin2, '주민등록번호 뒷자리를 입력하여 주십시오',0)) { return false; }
	else if (jumin_chk(frm.jumin1,frm.jumin2) ) { return false; }
	else if (CheckSpaces(frm.addr_num1, '우편번호를 입력하여 주십시오',0)) { return false; }
	else if (CheckSpaces(frm.addr1, '주소를 입력하여 주십시오',0)) { return false; }
	else if (CheckSpaces(frm.addr2, '세부주소를 입력하여 주십시오',0)) { return false; }
	else if (CheckSpaces(frm.email, '메일주소를 입력하여 주십시오',0)) { return false; }
	else if ( phone == "" && mobile == "")
	{
		alert("연락처를 입력하여 주십시오")	;
		return false;
	}
	else if ( phone != "" && Digit(frm.tel1, '전화번호를 입력하여 주십시오',0))	{	return false;  }
	else if ( phone != "" && Digit(frm.tel2, '전화번호를 입력하여 주십시오',0))	{	return false;  }
	else if ( phone != "" && Digit(frm.tel3, '전화번호를 입력하여 주십시오',0))	{	return false;  }
	else if ( mobile != "" && Digit(frm.mobile1, '휴대폰을 입력하여 주십시오',0)) { return false; }
	else if ( mobile != "" && Digit(frm.mobile2, '휴대폰을 입력하여 주십시오',0)) { return false; }
	else if ( mobile != "" && Digit(frm.mobile3, '휴대폰을 입력하여 주십시오',0)) { return false; }
	else if ( ch_member == "1" && CheckSpaces(frm.in_ent,'유관기관 회원일 경우 유관기관명을 입력 해주십시요',0)) {  return false; }  
	else if ( ch_member == "2" ) {
		
		if(CheckSpaces(frm.in_ent,'입주업체회원일 경우 입주업체명을 입력 해주십시요',0)) {  return false; } 
		else if(CheckSpaces(frm.in_ent_num1,'입주업체회원일 경우 사업자등록번호를 입력 해주십시요',0)) {  return false; }  
		else if (alphaDigit(frm.in_ent_num1, '사업자등록번호')) { return false; }
		else if(CheckSpaces(frm.in_ent_num2,'입주업체회원일 경우 사업자등록번호를 입력 해주십시요',0)) {  return false; }
		else if (alphaDigit(frm.in_ent_num2, '사업자등록번호')) { return false; }
		else if(CheckSpaces(frm.in_ent_num3,'입주업체회원일 경우 사업자등록번호를 입력 해주십시요',0)) {  return false; }
		else if (alphaDigit(frm.in_ent_num3, '사업자등록번호')) { return false; }
		else { frm.submit();  };	
   }
	else { return true; }

	   
}

//중복아이디체크..
function id_check(){
	
	id = frm.user_id;

	if (CheckSpaces(id, '아이디를 입력하여 주십시오',0)) { return; }
	else if (IDCheck(id, '아이디')) { return; }
	else if (CheckLen(id, '4', '20')) { return; }
	else { window.open("/pages/member/id_check.php?user_id="+id.value,"id","scrollbars=no,toolbar=no,directories=no,menubar=no,resizable=no,status=no,width=460,height=315,top=30,left=30'");
	}
}


//중복아이디체크..
function id_checkform(){
	id = frm.user_id;

	if (CheckSpaces(id, '아이디를 입력하여 주십시오',0)) { return; }
	else if (IDCheck(id, '아이디')) { return; }
	else if (CheckLen(id, '4', '20')) { return; }
	else { frm.submit(); }	
}


function getID(id) {
	opener.document.frm.user_id.value = id;
	self.close();
}


function modifyform() {

	if(frm.user_pass.value =="") { alert("비밀번호를 입력하여 주세요.");  return;  }
	if(frm.user_name.value =="") { alert("이름을 입력하여 주세요.");  return;  }
	
	
	frm.submit(); 
	   
}

//비밀번호 변경
function pwd_modify(){
	 window.open("/member/pwd_modify.php","pwd","scrollbars=no,toolbar=no,directories=no,menubar=no,resizable=no,status=no,width=420,height=245'");
}

function pwd_checkform() {

	if (CheckSpaces(frm.p_oldpwd, '기존비밀번호를 입력하여 주십시오',0)) { return; }
	else if (CheckSpaces(frm.p_newpwd, '새 비밀번호를 입력하여 주십시오',0)) { return; }
	else if (alphaDigit(frm.p_newpwd, '새 비밀번호',0)) { return; }
	else if (CheckLen(frm.p_newpwd, '4', '10')) { return; }
	else if (CheckEqual(frm.p_newpwd, frm.p_pwd_ok,'비밀번호',0)) { return; }
	else { frm.submit(); }

	   
}


// 폼이동(자리수 체크)
function moveForm(move,sname,s)
{       
  
   if(move.length == 6 && s == 6){
     document.frm.elements[sname].focus();
  }
    
  
}

// 마지막 필드에서 엔터 클릭시 서밋 작동 /*완료
function checkEnter()
{
	if (event.keyCode==13)
	{
		findname_checkform();
	}
}


function findname_checkform() {

	if (CheckSpaces(frm.user_name, '이름을 입력 해주십시요',0)) { return; }
    else if (jumin_chk(frm.jumin1,frm.jumin2) ) { return; }
	else { frm.submit(); }
	   
}


function pass_checkform() 
{
	if(!frm.answer.value && !frm.answer2.value)
	{
		if (CheckSpaces(frm.answer, '비밀번호 확인 답을 입력 해주십시요',0))
		{
			return;
		}
	}
	else if(frm.answer2.value && frm.answer2.value != frm.certification_number.value)
	{
		alert('인증번호가 일치하지 않습니다.\n\n다시 확인하여 주십시오.');
		return;
	}
	else { frm.submit(); }
}