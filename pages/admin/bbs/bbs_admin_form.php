<?
	session_start();
	//include("../admin_security.php");

	include("../../config/mysql.inc.php");  
	include("../../config/comm.inc.php");  

	$mysql = new Mysql_DB;
	$mysql->Connect();

	
	$mode = $_REQUEST["mode"];
	$a_idx = $_REQUEST["a_idx"];
	$search = $_REQUEST["search"];
	$keyword = $_REQUEST["keyword"];
	$pageIdx = $_REQUEST["pageIdx"];

	// *** ���� *****
	if($a_idx <> "") {
		$qry = "Select * From bbs_admin Where a_idx = '$a_idx'";
		$mysql->ParseExec($qry);
		if ($mysql->RowCount() < 1) {

			 message("�Խ����� �������� �ʽ��ϴ�");
		
		} else {

				$mysql->FetchInto(&$row);

				$a_language        =  $row[a_language];
				$a_type            =  $row[a_type];
				$a_bbsname         =  utf8ToEuckr($row[a_bbsname]);
				$a_tablename       =  $row[a_tablename];
				$a_category        =  $row[a_category];
				$a_email           =  $row[a_email];
				$a_homepage        =  $row[a_homepage];
				$a_jumin           =  $row[a_jumin];
				$a_phone           =  $row[a_phone];
				$a_html            =  $row[a_html];
				$a_upload          =  $row[a_upload];
				$a_upload_len      =  $row[a_upload_len];
				$a_nofilesize      =  $row[a_nofilesize];
				$a_nofile          =  $row[a_nofile];
				$a_command         =  $row[a_command];
				$a_ip              =  $row[a_ip];
				$a_new             =  $row[a_new];
				$a_move            =  $row[a_move];
				$a_excel           =  $row[a_excel];
				$a_noword          =  utf8ToEuckr($row[a_noword]);
				$a_opener          =  $row[a_opener];
				$a_reply           =  $row[a_reply];
				$a_reply_type      =  $row[a_reply_type];
				$a_skin            =  $row[a_skin];
				$a_width           =  $row[a_width];
				$a_align           =  $row[a_align];
				$a_title_bgcolor   =  $row[a_title_bgcolor];
				$a_title_border    =  $row[a_title_border];
				$a_font_color      =  $row[a_font_color];
				$a_mouseover_color =  $row[a_mouseover_color];
				$a_displaysu       =  $row[a_displaysu];
				$a_pagesu          =  $row[a_pagesu];
				$a_orderby         =  $row[a_orderby];
				$a_orderby_type    =  $row[a_orderby_type];
				$a_title_len       =  $row[a_title_len];
				$a_include_header  =  $row[a_include_header];
				$a_header          =  $row[a_header];
				$a_detail          =  $row[a_detail];
				$a_view            =  $row[a_view];
				$a_photo           =  $row[a_photo];
				$a_photo_width     =  $row[a_photo_width];
				$a_photo_height    =  $row[a_photo_height];
				$a_photo_cols      =  $row[a_photo_cols];
				$a_photo_rows      =  $row[a_photo_rows];
				$a_include_top     =  $row[a_include_top];
				$a_include_left    =  $row[a_include_left];
				$a_include_right   =  $row[a_include_right];
				$a_include_bottom  =  $row[a_include_bottom];
				//�Խù��� �����ڿ� ���� ���� ������ ���� ���̰� ���� �Ǵ��� Ȯ�� �÷���
				$a_admin_check	   =  $row[a_admin_check];

		}
	} else {
		
		//�⺻�� ����
		$a_new             =  3;
		$a_width           =  "600";
		$a_skin            =  1;
		$a_title_bgcolor   =  "#f7f7f7";
		$a_title_border    =  "#e7e3e7";
		$a_font_color      =  "#333333";
		$a_mouseover_color =  "#f7f7f7";
		$a_nofilesize      =  10;
		$a_displaysu       =  10;
		$a_pagesu          =  10;
		$a_title_len       =  20;
		$a_photo_width     =  100;
		$a_photo_height    =  100;
		$a_photo_cols      =  4;
		$a_photo_rows      =  3;

	}


	//$mysql->DisConnect();
?>
<script type="text/javascript" src="/js/eButton.js"></script>
<script type="text/javascript" src="/pages/bbs/js/comm.js"></script>
<script type="text/javascript">
<!--
function DisplayNofile_new(id_name){
	if (document.all[id_name].style.display == ""){
		document.all[id_name].style.display = "none";
	}else{
		document.all[id_name].style.display = "";
	}
 }

function change(val){
	 var num = val;
	 num = num - 1 ;

	 var Tbgcolor  = new Array("#F4EFEA","#EFF2E7","#E7EDF2","#F2EAE7","#E4ECDC","#EFEBE0","#F1E4ED","#E5E0F1","#D5E1EF","#DEF3FF","#f7f7f7");
	 var Tborder   = new Array("#E3D8CD","#DCE2CD","#C7D7E1","#E4D6CF","#D7E2CD","#E6E1D1","#E9D4E3","#D2C9E6","#BCCDE2","#C6DBEF","#e7e3e7");
	 var Fcolor    = new Array("#333333","#333333","#333333","#333333","#333333","#333333","#333333","#333333","#333333","#333333","#333333");
 	 var Mouseover = new Array("#FCFAF8","#FAFBF8","#F6F8FA","#FCFAF9","#F6F9F4","#F9F8F3","#F9F5F8","#F6F4FA","#F0F4F8","#F7FFFF","#f7f7f7");

	 document.frm.a_title_bgcolor.value    = Tbgcolor[num];      //Ÿ��Ʋ ����
 	 document.frm.a_title_border.value     = Tborder[num];      //Ÿ��Ʋ �׵θ�
	 document.frm.a_font_color.value       = Fcolor[num];      //Ÿ��Ʋ ���ڻ�
	 document.frm.a_mouseover_color.value  = Mouseover[num];  //���콺����
}

function DisplayPhoto(gubun){
	if (gubun == "Y") {
		 frm.a_displaysu.disabled=true;
		 frm.a_displaysu.style.background="#F3F3F3";
		 
		 frm.a_photo_width.disabled=false;
		 frm.a_photo_width.style.background="#FFFFFF";

		 frm.a_photo_height.disabled=false;
		 frm.a_photo_height.style.background="#FFFFFF";	

		 frm.a_photo_cols.disabled=false;
		 frm.a_photo_cols.style.background="#FFFFFF";	

		 frm.a_photo_rows.disabled=false;
		 frm.a_photo_rows.style.background="#FFFFFF";	

	} else {
		 
		 frm.a_displaysu.disabled=false;
		 frm.a_displaysu.style.background="#FFFFFF";

		 frm.a_photo_width.disabled=true;
		 frm.a_photo_width.style.background="#F3F3F3";

		 frm.a_photo_height.disabled=true;
		 frm.a_photo_height.style.background="#F3F3F3";	

		 frm.a_photo_cols.disabled=true;
		 frm.a_photo_cols.style.background="#F3F3F3";	

		 frm.a_photo_rows.disabled=true;
		 frm.a_photo_rows.style.background="#F3F3F3";	
  }

 }

function frm_submit(){

	if(CheckSpaces(frm.a_bbsname, '�Խ��� �̸��� �Է��ϼ���', 0) ) { return; }
	else if(CheckSpaces(frm.a_tablename, '���̺� �̸��� �Է��ϼ���', 0) ) { return; }
	else if(frm.a_new.value != "" && Digit(frm.a_new, "new�����ܼ����Ⱓ", 0) ) { return; }
	else if(frm.a_nofilesize.value != "" && Digit(frm.a_nofilesize, "���� �뷮", 3) ) { return; }
	else if(CheckSpaces(frm.a_width, '�Խ��� ũ�⸦ �Է��ϼ���', 0) ) { return; }
	else if(Digit(frm.a_width, "�Խ��� ũ��", 500) ) { return false; }
	else if(CheckSpaces(frm.a_displaysu, '�������� �Խù� ���� �Է��ϼ���', 0) ) { return; }
	else if(Digit(frm.a_displaysu, "�������� �Խù� ��", 1) ) { return; }
	else if(CheckSpaces(frm.a_pagesu, '����¡ ���� �Է��ϼ���', 0) ) { return; }
	else if(Digit(frm.a_pagesu, "����¡ ��", 1) ) { return false; }
	else if(CheckSpaces(frm.a_title_len, '���� ���̸� �Է��ϼ���', 0) ) { return; }
	else if(Digit(frm.a_title_len, "���� ����", 1) ) { return false; }
	else if(frm.a_photo_width.disabled==false &&
					frm.a_photo_width.value != "" && Digit(frm.a_photo_width, "�̹��� ����", 70)){ return; }
	else if(frm.a_photo_height.disabled==false &&
					frm.a_photo_height.value != "" && Digit(frm.a_photo_height, "�̹��� ����", 70)){ return; }
	else if(frm.a_photo_cols.disabled==false &&
					frm.a_photo_cols.value != "" && Digit(frm.a_photo_cols, "���", 1)){ return; }
	else if(frm.a_photo_rows.disabled==false &&
					frm.a_photo_rows.value != "" && Digit(frm.a_photo_rows, "����", 1)){ return; }
	else {
		frm.submit();
	}
}
//-->
</script>

<form name="frm" method="post" action="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/regist.php">
<input type="hidden" name="mode" value="<? echo $mode ?>">
<input type="hidden" name="a_idx" value="<? echo $a_idx ?>">
<input type="hidden" name="search" value="<? echo $search ?>">
<input type="hidden" name="keyword" value="<? echo $keyword ?>">
<input type="hidden" name="pageIdx" value="<? echo $pageIdx ?>">



		<table class="bbsCont" cellspacing="0" summary="�⺻ ȯ�� ���� ��� ����">
			<caption class="none">�⺻ȯ�漳��</caption>
			<colgroup>
				<col width="20%" />
				<col width="50%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="fir">�⺻ȯ�漳��</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row" class="fir">
						<label for="a_language">����</label>
					</th>
					<td class="tal">
						<select name="a_language" id="a_language">
							<option value="1" <? if($a_language == 1) { ?>selected<? } ?>>�ѱ�(Korean)</option>
							<option value="2" <? if($a_language == 2) { ?>selected<? } ?>>����(English)</option>
							<option value="3" <? if($a_language == 3) { ?>selected<? } ?>>�Ͼ�(Japanese)</option>
							<option value="4" <? if($a_language == 4) { ?>selected<? } ?>>�߱���(Chinese)</option>
						  </select>
					</td>
					<td class="tal">
						����
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_type">�Խ�������</label>
					</th>
					<td class="tal">
						<input type="radio" name="a_type" value="1" <? if ($a_type == 1 or $a_type == "") { ?>checked<? } ?>>
							����&nbsp;&nbsp;
						<input type="radio" name="a_type" value="2" <? if ($a_type == 2) { ?>checked<? } ?>>
							����/�����
					</td>
					<td class="tal">
						�Խ����� ����
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_admin_check">�����ڽ��ν� �Խù� ����</label>
					</th>
					<td class="tal">
						<input type="radio" name="a_admin_check" value="Y" <? if ($a_admin_check == "Y") { ?>checked<? } ?>>���&nbsp;&nbsp;
						<input type="radio" name="a_admin_check" value="N" <? if ($a_admin_check != "Y") { ?>checked<? } ?>>������
					</td>
					<td class="tal">
						���� �����ڰ� ������ �Խù��� ����
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_bbsname">�Խ��� �̸�</label>
					</th>
					<td class="tal">
						<input type="text" name="a_bbsname" id="a_bbsname" size="30" maxlength="40" value="<? echo $a_bbsname ?>" class="basic"/>
						ex)��������
					</td>
					<td class="tal">
						���� �����ڰ� ������ �Խù��� ����
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_tablename">���̺� �̸�</label>
					</th>
					<td class="tal">
						<input type="text" name="a_tablename" id="a_tablename" size="30" maxlength="40" value="<? echo $a_tablename ?>" class="basic"/>
						ex)bbs_notice
					</td>
					<td class="tal">
						�Խ����� ���̺� �̸�<br/>
						<b>(�� �������� ǥ�� �ϼž� �մϴ�.)</b>
					</td>
				</tr>
			</tbody>
		</table>

		<br/>

		<table class="bbsCont" cellspacing="0" summary="�ʵ���� ���� ��� ����">
			<caption class="none">�ʵ���� ����</caption>
			<colgroup>
				<col width="20%" />
				<col width="50%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="fir">�ʵ���� ����</th>
				</tr>
			</thead>
			<tbody>
			<!--
				<tr>
					<th scope="row" class="fir">
						<label for="a_category">�Խ��� ī�װ�</label>
					</th>
					<td class="tal">
						<input name="a_category" type="radio" value="Y" <? if ($a_category == "Y") { ?>checked<? } ?>>���&nbsp;&nbsp; 
						 <input name="a_category" type="radio" value="N" <? if ($a_category == "N" or $a_category == "") { ?>checked<? } ?>>������
					</td>
					<td class="tal">
						�Խ��� ī�װ� ��� ����
					</td>
				</tr>
			-->
				<input type="hidden" name="a_category" value="N">
				<tr>
					<th scope="row" class="fir">
						<label for="a_reply">�亯��</label>
					</th>
					<td class="tal">
						<input name="a_reply" type="radio" value="Y" <? if ($a_reply == "Y") { ?>checked<? } ?>>���
						<input type="hidden" name="a_reply_type" value="0" />
						<input name="a_reply" type="radio" value="N" <? if ($a_reply == "N" or $a_reply == "") { ?>checked<? } ?>>������
					</td>
					<td class="tal">
						�Խ��� �亯�� ��� ����
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_email">�̸���</label>
					</th>
					<td class="tal">
						<input name="a_email" type="radio" value="Y" <? if ($a_email == "Y" or $a_email == "") { ?>checked<? } ?>>���&nbsp;&nbsp; 
						<input name="a_email" type="radio" value="N" <? if ($a_email == "N") { ?>checked<? } ?>>������
					</td>
					<td class="tal">
						�̸����Է� ����
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_homepage">Ȩ������</label>
					</th>
					<td class="tal">
						<input name="a_homepage" type="radio" value="Y" <? if ($a_homepage == "Y") { ?>checked<? } ?>>���&nbsp;&nbsp; 
						<input name="a_homepage" type="radio" value="N" <? if ($a_homepage == "N" or $a_homepage == "") { ?>checked<? } ?>>������
					</td>
					<td class="tal">
						Ȩ�������Է� ����
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_phone">��ȭ��ȣ</label>
					</th>
					<td class="tal">
						<input name="a_phone" type="radio" value="Y" <? if ($a_phone == "Y") { ?>checked<? } ?>>���&nbsp;&nbsp; 
						<input name="a_phone" type="radio" value="N" <? if ($a_phone == "N" or $a_phone == "") { ?>checked<? } ?>>������
					</td>
					<td class="tal">
						��ȭ��ȣ �Է� ����
					</td>
				</tr>
				<!--
				<tr>
					<th scope="row" class="fir">
						<label for="a_html">HTML ����</label>
					</th>
					<td class="tal">
						<input name="a_html" type="radio" value="Y" <? if ($a_html == "Y" or $a_html == "") { ?>checked<? } ?>>���&nbsp;&nbsp; 
						<input name="a_html" type="radio" value="N" <? if ($a_html == "N") { ?>checked<? } ?>>������
					</td>
					<td class="tal">
						HTML �±� ���� ����
					</td>
				</tr>
				-->
				<input name="a_html" type="hidden" value="N">
				<tr>
					<th scope="row" class="fir">
						<label for="a_new">new������ �����Ⱓ</label>
					</th>
					<td class="tal">
						<input name="a_new" type="text" id="a_new" size="3" maxlength="2" value="<? echo $a_new ?>" class="basic" />
						��
					</td>
					<td class="tal">
						�Խñ� new�����ܼ����Ⱓ
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_move">���̵����</label>
					</th>
					<td class="tal">
						<input name="a_move" type="radio" value="Y" <? if ($a_move == "Y" or $a_move == "") { ?>checked<? } ?>>���&nbsp;&nbsp;
						<input name="a_move" type="radio" value="N" <? if ($a_move == "N") { ?>checked<? } ?>>������
					</td>
					<td class="tal">
						�Խñ��̵���� ����
					</td>
				</tr>
				<!--
				<tr>
					<th scope="row" class="fir">
						<label for="a_excel">�����������</label>
					</th>
					<td class="tal">
						<input name="a_excel" type="radio" value="Y" <? if ($a_excel == "Y") { ?>checked<? } ?>>���&nbsp;&nbsp;
						<input name="a_excel" type="radio" value="N" <? if ($a_excel == "N" or $a_excel == "") { ?>checked<? } ?>>������
					</td>
					<td class="tal">
						�Խñ۳����� �������Ϸ� ���
					</td>
				</tr>
				-->
				<input name="a_excel" type="hidden" value="N" >
				<tr>
					<th scope="row" class="fir">
						<label for="a_upload">���Ͼ��ε�</label>
					</th>
					<td class="tal">
						<input name="a_upload" type="radio" value="Y" <? if ($a_upload == "Y") { ?>checked<? } ?> onclick="javascript:DisplayNofile_new('nofile','');"	>���&nbsp;&nbsp; 
						<input name="a_upload" type="radio" value="N" <? if ($a_upload == "N"  or $a_upload == "") { ?>checked<? } ?> onclick="javascript:DisplayNofile_new('nofile','');">������
							<div ID="nofile" style="display:<? if ($a_upload == "N" or $a_upload == "") { ?>none<? } ?>;">
								<table class="bbsCont" cellspacing="0">
									<tr>
										<td class="fir tal">���ε����ϰ��� : 
											<select name="a_upload_len">
											<? for ($i = 1 ; $i <= 5 ; $i++) {  ?>
											<option value="<? echo $i ?>" <? if ($a_upload_len == $i) { ?>selected<? } ?>><? echo $i ?></option>
											<? } ?>
											</select> ��
										</td>
									</tr>
									<tr>
										<td class="fir tal">���ε����ѿ뷮 : <input type='text' name='a_nofilesize' size='5' maxlength='3' value="<? echo $a_nofilesize ?>" class="basic"/> MByte����</td>
									</tr>
									<tr>
										<td class="fir tal">���ε���������..ex)php,exe,dll,......<br><textarea name='a_nofile' cols='45' rows='2'><? echo $a_nofile ?></textarea></td>
									</tr>
								</table>
							</div>
					</td>
					<td class="tal">
						���� ���ε� ���� ����
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_command">������(�ǰߴޱ�)</label>
					</th>
					<td class="tal">
						<input name="a_command" type="radio" value="Y" <? if ($a_command == "Y" or $a_command == "") { ?>checked<? } ?>>���&nbsp;&nbsp; 
						<input name="a_command" type="radio" value="N" <? if ($a_command == "N") { ?>checked<? } ?>>������
					</td>
					<td class="tal">
						������ ��� ����
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_noword">�����ܾ�</label>
					</th>
					<td class="tal">
						ex)����,����,���ڽ�,......<br><textarea name="a_noword" id="a_noword" cols="40" rows="4"><? echo $a_noword ?></textarea>
					</td>
					<td class="tal">
						�Խ��� �����ܾ� �Է�. (,�� �з�)
					</td>
				</tr>
			</tbody>
		</table>
		
		<br/>

		<table class="bbsCont" cellspacing="0" summary="�Խ��� �ٹ̱� ���� ��� ����">
			<caption class="none">�Խ��� �ٹ̱�</caption>
			<colgroup>
				<col width="20%" />
				<col width="50%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="fir">�Խ��� �ٹ̱�</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<th scope="row" class="fir">
					<label for="a_displaysu">�������� �Խù� ��</label>
				</th>
				<td class="tal">
					<input type="text" name="a_displaysu" id="a_displaysu" size="5" maxlength="2" value="<? echo $a_displaysu ?>" class="basic"/>
				</td>
				<td class="tal">
					�������� �Խù� ��
				</td>
			</tr>
			<tr>
				<th scope="row" class="fir">
					<label for="a_pagesu">������ ����</label>
				</th>
				<td class="tal">
					<input type='text' name='a_pagesu' size='5' maxlength='2' value="<? echo $a_pagesu ?>" class="basic">
				</td>
				<td class="tal">
					����¡ ��
				</td>
			</tr>
			<tr>
				<th scope="row" class="fir">
					<label for="a_pagesu">����</label>
				</th>
				<td class="tal">
					<select name="a_orderby">
						<option value="num" <? if($a_orderby == "num") { ?>selected<? } ?>>��ȣ</option>
						<option value="title" <? if($a_orderby == "title") { ?>selected<? } ?>>����</option>
						<option value="regdate" <? if($a_orderby == "regdate") { ?>selected<? } ?>>��¥</option>
					</select>
					<input name="a_orderby_type" type="radio" value="Desc" <? if($a_orderby_type == "Desc" or $a_orderby_type == "") { ?>checked<? } ?> />Desc&nbsp;&nbsp;
					<input name="a_orderby_type" type="radio" value="Asc" <? if($a_orderby_type == "Asc") { ?>checked<? } ?>>Asc		
				</td>
				<td class="tal">
					�Խ��� ����
				</td>
			</tr>
			<tr>
				<th scope="row" class="fir">
					<label for="a_title_len">���� ����</label>
				</th>
				<td class="tal">
					<input type='text' name='a_title_len' size='4' maxlength='3' value="<? echo $a_title_len ?>" class="basic" />
					(�ѱ� 2byte, ����/���� 1byte)
				</td>
				<td class="tal">
					���� ���� ����
				</td>
			</tr>
			<tr>
				<th scope="row" class="fir">
					<label for="a_view">ȭ��(view)</label>
				</th>
				<td class="tal">
					<input name="a_view" type="radio" value="1" <? if($a_view == 1) { ?>checked<? } ?>>�⺻ȭ��&nbsp;&nbsp;&nbsp;  
					<input name="a_view" type="radio" value="2" <? if($a_view == 2 or $a_view == "") { ?>checked<? } ?>>�⺻ȭ��+����������&nbsp;&nbsp;&nbsp;
					<br/>
					<input name="a_view" type="radio" value="3" <? if($a_view == 3) { ?>checked<? } ?>>�⺻ȭ��+���&nbsp;&nbsp;&nbsp;
					<!--<input name="a_view" type="radio" value="4" <? if($a_view == 4) { ?>checked<? } ?>>�⺻ȭ��+���ñ�-->
				</td>
				<td class="tal">
					ȭ��(view) ����
				</td>
			</tr>
		</tbody>
	</table>
<br>
	<table class="bbsCont" cellspacing="0" summary="���� �Խ��� ���� ��� ����">
<!--
			<caption class="none">���� �Խ���</caption>
			<colgroup>
				<col width="20%" />
				<col width="50%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="fir">���� �Խ���</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row" class="fir">
						<label for="a_photo">���� �Խ���</label>
					</th>
					<td class="tal">
						<input name="a_photo" type="radio" value="Y" <? if($a_photo == "Y") { ?>checked<? } ?> onclick="DisplayPhoto('Y')">���&nbsp;&nbsp; 
						<input name="a_photo" type="radio" value="N" <? if($a_photo == "N"  or $a_photo == "") { ?>checked<? } ?>  onclick="DisplayPhoto('N')" >������
					</td>
					<td class="tal">
						���� �Խ��� ��� ����
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_photo_width">�̹��� ����</label>
					</th>
					<td class="tal">
						<input name="a_photo_width" type="text" size="4" maxlength="3"  value="<? echo $a_photo_width ?>" <? if($a_photo == "N") { ?>disabled style="background-color='#F3F3F3'"<? } ?> >
					</td>
					<td class="tal">
						�̹��� ���� ����
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_photo_height">�̹��� ����</label>
					</th>
					<td class="tal">
						<input name="a_photo_height" type="text" size="4" maxlength="3" value="<? echo $a_photo_height ?>" <? if($a_photo == "N") { ?>disabled style="background-color='#F3F3F3'"<? } ?>>
					</td>
					<td class="tal">
						�̹��� ���� ����
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_photo_cols">���</label>
					</th>
					<td class="tal">
						<input name="a_photo_cols" id="a_photo_cols" type="text" size="4" maxlength="3" value="<? echo $a_photo_cols ?>" <? if($a_photo == "N") { ?>disabled style="background-color='#F3F3F3'"<? } ?> >
					</td>
					<td class="tal">
						��Ͽ� �ѷ��� ���
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_photo_rows">����</label>
					</th>
					<td class="tal">
						<input name="a_photo_rows" id="a_photo_rows" type="text" size="4" maxlength="3" value="<? echo $a_photo_rows ?>" <? if($a_photo == "N") { ?>disabled style="background-color='#F3F3F3'"<? } ?> >
					</td>
					<td class="tal">
						��Ͽ� �ѷ��� ����
					</td>
				</tr>
			</tbody>
		-->
			<tfoot>
				<tr>
					<td colspan="3">
						<input type="image" src="/pages/admin/images/bbs/btn_write_big.gif" alt="���" />
						<a href="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/bbs_admin_form.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="���" /></a>
					</td>
				</tr>
			</tfoot>
		</table>
		<input name="a_photo" type="hidden" value="N" >
</form>