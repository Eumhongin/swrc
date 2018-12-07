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
	
	if (CheckSpaces(frm.user_id, '���̵� �Է��Ͽ� �ֽʽÿ�',0)) { return false; }
	else if (IDCheck(frm.user_id, '���̵�')) { return false; }
	else if (CheckLen(frm.user_id, '4', '20')) { return false; }
	else if (CheckSpaces(frm.user_pass, '��й�ȣ�� �Է��Ͽ� �ֽʽÿ�',0)) { return false; }
	else if (alphaDigit(frm.user_pass, '��й�ȣ')) { return false; }
	else if (CheckLen(frm.user_pass, '4', '10')) { return false; }
	else if (CheckEqual(frm.user_pass, frm.user_pass_re,'��й�ȣ')) { return false; }
	else if (frm.question.value == "0") { alert("��й�ȣ Ȯ�� ������ �����Ͽ� �ֽʽÿ�");  return false;  }
	else if (CheckSpaces(frm.answer, '��й�ȣ Ȯ�� �亯�� �Է��Ͽ� �ֽʽÿ�',0)) { return false; }
	else if (CheckSpaces(frm.nickname, 'Ŀ�´�Ƽ ���� ���� �ѱ۾��̵� �Է� ���ֽʽÿ�',0)) { return false; }
	else if (CheckSpaces(frm.user_name, '�̸��� �Է� ���ֽʽÿ�',0)) { return false; }
	else if (CheckSpaces(frm.jumin1, '�ֹε�Ϲ�ȣ ���ڸ��� �Է��Ͽ� �ֽʽÿ�',0)) { return false; }
	else if (CheckSpaces(frm.jumin2, '�ֹε�Ϲ�ȣ ���ڸ��� �Է��Ͽ� �ֽʽÿ�',0)) { return false; }
	else if (jumin_chk(frm.jumin1,frm.jumin2) ) { return false; }
	else if (CheckSpaces(frm.addr_num1, '�����ȣ�� �Է��Ͽ� �ֽʽÿ�',0)) { return false; }
	else if (CheckSpaces(frm.addr1, '�ּҸ� �Է��Ͽ� �ֽʽÿ�',0)) { return false; }
	else if (CheckSpaces(frm.addr2, '�����ּҸ� �Է��Ͽ� �ֽʽÿ�',0)) { return false; }
	else if (CheckSpaces(frm.email, '�����ּҸ� �Է��Ͽ� �ֽʽÿ�',0)) { return false; }
	else if ( phone == "" && mobile == "")
	{
		alert("����ó�� �Է��Ͽ� �ֽʽÿ�")	;
		return false;
	}
	else if ( phone != "" && Digit(frm.tel1, '��ȭ��ȣ�� �Է��Ͽ� �ֽʽÿ�',0))	{	return false;  }
	else if ( phone != "" && Digit(frm.tel2, '��ȭ��ȣ�� �Է��Ͽ� �ֽʽÿ�',0))	{	return false;  }
	else if ( phone != "" && Digit(frm.tel3, '��ȭ��ȣ�� �Է��Ͽ� �ֽʽÿ�',0))	{	return false;  }
	else if ( mobile != "" && Digit(frm.mobile1, '�޴����� �Է��Ͽ� �ֽʽÿ�',0)) { return false; }
	else if ( mobile != "" && Digit(frm.mobile2, '�޴����� �Է��Ͽ� �ֽʽÿ�',0)) { return false; }
	else if ( mobile != "" && Digit(frm.mobile3, '�޴����� �Է��Ͽ� �ֽʽÿ�',0)) { return false; }
	else if ( ch_member == "1" && CheckSpaces(frm.in_ent,'������� ȸ���� ��� ����������� �Է� ���ֽʽÿ�',0)) {  return false; }  
	else if ( ch_member == "2" ) {
		
		if(CheckSpaces(frm.in_ent,'���־�üȸ���� ��� ���־�ü���� �Է� ���ֽʽÿ�',0)) {  return false; } 
		else if(CheckSpaces(frm.in_ent_num1,'���־�üȸ���� ��� ����ڵ�Ϲ�ȣ�� �Է� ���ֽʽÿ�',0)) {  return false; }  
		else if (alphaDigit(frm.in_ent_num1, '����ڵ�Ϲ�ȣ')) { return false; }
		else if(CheckSpaces(frm.in_ent_num2,'���־�üȸ���� ��� ����ڵ�Ϲ�ȣ�� �Է� ���ֽʽÿ�',0)) {  return false; }
		else if (alphaDigit(frm.in_ent_num2, '����ڵ�Ϲ�ȣ')) { return false; }
		else if(CheckSpaces(frm.in_ent_num3,'���־�üȸ���� ��� ����ڵ�Ϲ�ȣ�� �Է� ���ֽʽÿ�',0)) {  return false; }
		else if (alphaDigit(frm.in_ent_num3, '����ڵ�Ϲ�ȣ')) { return false; }
		else { frm.submit();  };	
   }
	else { return true; }

	   
}

//�ߺ����̵�üũ..
function id_check(){
	
	id = frm.user_id;

	if (CheckSpaces(id, '���̵� �Է��Ͽ� �ֽʽÿ�',0)) { return; }
	else if (IDCheck(id, '���̵�')) { return; }
	else if (CheckLen(id, '4', '20')) { return; }
	else { window.open("/pages/member/id_check.php?user_id="+id.value,"id","scrollbars=no,toolbar=no,directories=no,menubar=no,resizable=no,status=no,width=460,height=315,top=30,left=30'");
	}
}


//�ߺ����̵�üũ..
function id_checkform(){
	id = frm.user_id;

	if (CheckSpaces(id, '���̵� �Է��Ͽ� �ֽʽÿ�',0)) { return; }
	else if (IDCheck(id, '���̵�')) { return; }
	else if (CheckLen(id, '4', '20')) { return; }
	else { frm.submit(); }	
}


function getID(id) {
	opener.document.frm.user_id.value = id;
	self.close();
}


function modifyform() {

	if(frm.user_pass.value =="") { alert("��й�ȣ�� �Է��Ͽ� �ּ���.");  return;  }
	if(frm.user_name.value =="") { alert("�̸��� �Է��Ͽ� �ּ���.");  return;  }
	
	
	frm.submit(); 
	   
}

//��й�ȣ ����
function pwd_modify(){
	 window.open("/member/pwd_modify.php","pwd","scrollbars=no,toolbar=no,directories=no,menubar=no,resizable=no,status=no,width=420,height=245'");
}

function pwd_checkform() {

	if (CheckSpaces(frm.p_oldpwd, '������й�ȣ�� �Է��Ͽ� �ֽʽÿ�',0)) { return; }
	else if (CheckSpaces(frm.p_newpwd, '�� ��й�ȣ�� �Է��Ͽ� �ֽʽÿ�',0)) { return; }
	else if (alphaDigit(frm.p_newpwd, '�� ��й�ȣ',0)) { return; }
	else if (CheckLen(frm.p_newpwd, '4', '10')) { return; }
	else if (CheckEqual(frm.p_newpwd, frm.p_pwd_ok,'��й�ȣ',0)) { return; }
	else { frm.submit(); }

	   
}


// ���̵�(�ڸ��� üũ)
function moveForm(move,sname,s)
{       
  
   if(move.length == 6 && s == 6){
     document.frm.elements[sname].focus();
  }
    
  
}

// ������ �ʵ忡�� ���� Ŭ���� ���� �۵� /*�Ϸ�
function checkEnter()
{
	if (event.keyCode==13)
	{
		findname_checkform();
	}
}


function findname_checkform() {

	if (CheckSpaces(frm.user_name, '�̸��� �Է� ���ֽʽÿ�',0)) { return; }
    else if (jumin_chk(frm.jumin1,frm.jumin2) ) { return; }
	else { frm.submit(); }
	   
}


function pass_checkform() 
{
	if(!frm.answer.value && !frm.answer2.value)
	{
		if (CheckSpaces(frm.answer, '��й�ȣ Ȯ�� ���� �Է� ���ֽʽÿ�',0))
		{
			return;
		}
	}
	else if(frm.answer2.value && frm.answer2.value != frm.certification_number.value)
	{
		alert('������ȣ�� ��ġ���� �ʽ��ϴ�.\n\n�ٽ� Ȯ���Ͽ� �ֽʽÿ�.');
		return;
	}
	else { frm.submit(); }
}