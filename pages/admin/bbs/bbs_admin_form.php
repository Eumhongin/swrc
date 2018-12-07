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

	// *** 수정 *****
	if($a_idx <> "") {
		$qry = "Select * From bbs_admin Where a_idx = '$a_idx'";
		$mysql->ParseExec($qry);
		if ($mysql->RowCount() < 1) {

			 message("게시판이 존재하지 않습니다");
		
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
				//게시물이 관리자에 의해 최종 승인이 나야 보이게 설정 되는지 확인 플래그
				$a_admin_check	   =  $row[a_admin_check];

		}
	} else {
		
		//기본값 설정
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

	 document.frm.a_title_bgcolor.value    = Tbgcolor[num];      //타이틀 배경색
 	 document.frm.a_title_border.value     = Tborder[num];      //타이틀 테두리
	 document.frm.a_font_color.value       = Fcolor[num];      //타이틀 글자색
	 document.frm.a_mouseover_color.value  = Mouseover[num];  //마우스오버
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

	if(CheckSpaces(frm.a_bbsname, '게시판 이름을 입력하세요', 0) ) { return; }
	else if(CheckSpaces(frm.a_tablename, '테이블 이름을 입력하세요', 0) ) { return; }
	else if(frm.a_new.value != "" && Digit(frm.a_new, "new아이콘설정기간", 0) ) { return; }
	else if(frm.a_nofilesize.value != "" && Digit(frm.a_nofilesize, "파일 용량", 3) ) { return; }
	else if(CheckSpaces(frm.a_width, '게시판 크기를 입력하세요', 0) ) { return; }
	else if(Digit(frm.a_width, "게시판 크기", 500) ) { return false; }
	else if(CheckSpaces(frm.a_displaysu, '페이지당 게시물 수를 입력하세요', 0) ) { return; }
	else if(Digit(frm.a_displaysu, "페이지당 게시물 수", 1) ) { return; }
	else if(CheckSpaces(frm.a_pagesu, '페이징 수를 입력하세요', 0) ) { return; }
	else if(Digit(frm.a_pagesu, "페이징 수", 1) ) { return false; }
	else if(CheckSpaces(frm.a_title_len, '제목 길이를 입력하세요', 0) ) { return; }
	else if(Digit(frm.a_title_len, "제목 길이", 1) ) { return false; }
	else if(frm.a_photo_width.disabled==false &&
					frm.a_photo_width.value != "" && Digit(frm.a_photo_width, "이미지 넓이", 70)){ return; }
	else if(frm.a_photo_height.disabled==false &&
					frm.a_photo_height.value != "" && Digit(frm.a_photo_height, "이미지 높이", 70)){ return; }
	else if(frm.a_photo_cols.disabled==false &&
					frm.a_photo_cols.value != "" && Digit(frm.a_photo_cols, "행수", 1)){ return; }
	else if(frm.a_photo_rows.disabled==false &&
					frm.a_photo_rows.value != "" && Digit(frm.a_photo_rows, "열수", 1)){ return; }
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



		<table class="bbsCont" cellspacing="0" summary="기본 환경 설정 목록 보기">
			<caption class="none">기본환경설정</caption>
			<colgroup>
				<col width="20%" />
				<col width="50%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="fir">기본환경설정</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row" class="fir">
						<label for="a_language">언어선택</label>
					</th>
					<td class="tal">
						<select name="a_language" id="a_language">
							<option value="1" <? if($a_language == 1) { ?>selected<? } ?>>한글(Korean)</option>
							<option value="2" <? if($a_language == 2) { ?>selected<? } ?>>영어(English)</option>
							<option value="3" <? if($a_language == 3) { ?>selected<? } ?>>일어(Japanese)</option>
							<option value="4" <? if($a_language == 4) { ?>selected<? } ?>>중국어(Chinese)</option>
						  </select>
					</td>
					<td class="tal">
						언어선택
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_type">게시판종류</label>
					</th>
					<td class="tal">
						<input type="radio" name="a_type" value="1" <? if ($a_type == 1 or $a_type == "") { ?>checked<? } ?>>
							공개&nbsp;&nbsp;
						<input type="radio" name="a_type" value="2" <? if ($a_type == 2) { ?>checked<? } ?>>
							공개/비공개
					</td>
					<td class="tal">
						게시판의 종류
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_admin_check">관리자승인시 게시물 노출</label>
					</th>
					<td class="tal">
						<input type="radio" name="a_admin_check" value="Y" <? if ($a_admin_check == "Y") { ?>checked<? } ?>>사용&nbsp;&nbsp;
						<input type="radio" name="a_admin_check" value="N" <? if ($a_admin_check != "Y") { ?>checked<? } ?>>사용안함
					</td>
					<td class="tal">
						사용시 관리자가 승인한 게시물만 보임
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_bbsname">게시판 이름</label>
					</th>
					<td class="tal">
						<input type="text" name="a_bbsname" id="a_bbsname" size="30" maxlength="40" value="<? echo $a_bbsname ?>" class="basic"/>
						ex)공지사항
					</td>
					<td class="tal">
						사용시 관리자가 승인한 게시물만 보임
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_tablename">테이블 이름</label>
					</th>
					<td class="tal">
						<input type="text" name="a_tablename" id="a_tablename" size="30" maxlength="40" value="<? echo $a_tablename ?>" class="basic"/>
						ex)bbs_notice
					</td>
					<td class="tal">
						게시판의 테이블 이름<br/>
						<b>(꼭 영문으로 표기 하셔야 합니다.)</b>
					</td>
				</tr>
			</tbody>
		</table>

		<br/>

		<table class="bbsCont" cellspacing="0" summary="필드관리 설정 목록 보기">
			<caption class="none">필드관리 설정</caption>
			<colgroup>
				<col width="20%" />
				<col width="50%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="fir">필드관리 설정</th>
				</tr>
			</thead>
			<tbody>
			<!--
				<tr>
					<th scope="row" class="fir">
						<label for="a_category">게시판 카테고리</label>
					</th>
					<td class="tal">
						<input name="a_category" type="radio" value="Y" <? if ($a_category == "Y") { ?>checked<? } ?>>사용&nbsp;&nbsp; 
						 <input name="a_category" type="radio" value="N" <? if ($a_category == "N" or $a_category == "") { ?>checked<? } ?>>사용안함
					</td>
					<td class="tal">
						게시판 카테고리 사용 여부
					</td>
				</tr>
			-->
				<input type="hidden" name="a_category" value="N">
				<tr>
					<th scope="row" class="fir">
						<label for="a_reply">답변글</label>
					</th>
					<td class="tal">
						<input name="a_reply" type="radio" value="Y" <? if ($a_reply == "Y") { ?>checked<? } ?>>사용
						<input type="hidden" name="a_reply_type" value="0" />
						<input name="a_reply" type="radio" value="N" <? if ($a_reply == "N" or $a_reply == "") { ?>checked<? } ?>>사용안함
					</td>
					<td class="tal">
						게시판 답변글 사용 여부
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_email">이메일</label>
					</th>
					<td class="tal">
						<input name="a_email" type="radio" value="Y" <? if ($a_email == "Y" or $a_email == "") { ?>checked<? } ?>>사용&nbsp;&nbsp; 
						<input name="a_email" type="radio" value="N" <? if ($a_email == "N") { ?>checked<? } ?>>사용안함
					</td>
					<td class="tal">
						이메일입력 여부
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_homepage">홈페이지</label>
					</th>
					<td class="tal">
						<input name="a_homepage" type="radio" value="Y" <? if ($a_homepage == "Y") { ?>checked<? } ?>>사용&nbsp;&nbsp; 
						<input name="a_homepage" type="radio" value="N" <? if ($a_homepage == "N" or $a_homepage == "") { ?>checked<? } ?>>사용안함
					</td>
					<td class="tal">
						홈페이지입력 여부
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_phone">전화번호</label>
					</th>
					<td class="tal">
						<input name="a_phone" type="radio" value="Y" <? if ($a_phone == "Y") { ?>checked<? } ?>>사용&nbsp;&nbsp; 
						<input name="a_phone" type="radio" value="N" <? if ($a_phone == "N" or $a_phone == "") { ?>checked<? } ?>>사용안함
					</td>
					<td class="tal">
						전화번호 입력 여부
					</td>
				</tr>
				<!--
				<tr>
					<th scope="row" class="fir">
						<label for="a_html">HTML 지원</label>
					</th>
					<td class="tal">
						<input name="a_html" type="radio" value="Y" <? if ($a_html == "Y" or $a_html == "") { ?>checked<? } ?>>사용&nbsp;&nbsp; 
						<input name="a_html" type="radio" value="N" <? if ($a_html == "N") { ?>checked<? } ?>>사용안함
					</td>
					<td class="tal">
						HTML 태그 지원 여부
					</td>
				</tr>
				-->
				<input name="a_html" type="hidden" value="N">
				<tr>
					<th scope="row" class="fir">
						<label for="a_new">new아이콘 설정기간</label>
					</th>
					<td class="tal">
						<input name="a_new" type="text" id="a_new" size="3" maxlength="2" value="<? echo $a_new ?>" class="basic" />
						일
					</td>
					<td class="tal">
						게시글 new아이콘설정기간
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_move">글이동기능</label>
					</th>
					<td class="tal">
						<input name="a_move" type="radio" value="Y" <? if ($a_move == "Y" or $a_move == "") { ?>checked<? } ?>>사용&nbsp;&nbsp;
						<input name="a_move" type="radio" value="N" <? if ($a_move == "N") { ?>checked<? } ?>>사용안함
					</td>
					<td class="tal">
						게시글이동기능 여부
					</td>
				</tr>
				<!--
				<tr>
					<th scope="row" class="fir">
						<label for="a_excel">엑셀파일출력</label>
					</th>
					<td class="tal">
						<input name="a_excel" type="radio" value="Y" <? if ($a_excel == "Y") { ?>checked<? } ?>>사용&nbsp;&nbsp;
						<input name="a_excel" type="radio" value="N" <? if ($a_excel == "N" or $a_excel == "") { ?>checked<? } ?>>사용안함
					</td>
					<td class="tal">
						게시글내용을 엑셀파일로 출력
					</td>
				</tr>
				-->
				<input name="a_excel" type="hidden" value="N" >
				<tr>
					<th scope="row" class="fir">
						<label for="a_upload">파일업로드</label>
					</th>
					<td class="tal">
						<input name="a_upload" type="radio" value="Y" <? if ($a_upload == "Y") { ?>checked<? } ?> onclick="javascript:DisplayNofile_new('nofile','');"	>사용&nbsp;&nbsp; 
						<input name="a_upload" type="radio" value="N" <? if ($a_upload == "N"  or $a_upload == "") { ?>checked<? } ?> onclick="javascript:DisplayNofile_new('nofile','');">사용안함
							<div ID="nofile" style="display:<? if ($a_upload == "N" or $a_upload == "") { ?>none<? } ?>;">
								<table class="bbsCont" cellspacing="0">
									<tr>
										<td class="fir tal">업로드파일갯수 : 
											<select name="a_upload_len">
											<? for ($i = 1 ; $i <= 5 ; $i++) {  ?>
											<option value="<? echo $i ?>" <? if ($a_upload_len == $i) { ?>selected<? } ?>><? echo $i ?></option>
											<? } ?>
											</select> 개
										</td>
									</tr>
									<tr>
										<td class="fir tal">업로드제한용량 : <input type='text' name='a_nofilesize' size='5' maxlength='3' value="<? echo $a_nofilesize ?>" class="basic"/> MByte이하</td>
									</tr>
									<tr>
										<td class="fir tal">업로드제한파일..ex)php,exe,dll,......<br><textarea name='a_nofile' cols='45' rows='2'><? echo $a_nofile ?></textarea></td>
									</tr>
								</table>
							</div>
					</td>
					<td class="tal">
						파일 업로드 지원 여부
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_command">꼬리글(의견달기)</label>
					</th>
					<td class="tal">
						<input name="a_command" type="radio" value="Y" <? if ($a_command == "Y" or $a_command == "") { ?>checked<? } ?>>사용&nbsp;&nbsp; 
						<input name="a_command" type="radio" value="N" <? if ($a_command == "N") { ?>checked<? } ?>>사용안함
					</td>
					<td class="tal">
						꼬리글 사용 여부
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_noword">금지단어</label>
					</th>
					<td class="tal">
						ex)광고,성인,개자식,......<br><textarea name="a_noword" id="a_noword" cols="40" rows="4"><? echo $a_noword ?></textarea>
					</td>
					<td class="tal">
						게시판 금지단어 입력. (,로 분류)
					</td>
				</tr>
			</tbody>
		</table>
		
		<br/>

		<table class="bbsCont" cellspacing="0" summary="게시판 꾸미기 설정 목록 보기">
			<caption class="none">게시판 꾸미기</caption>
			<colgroup>
				<col width="20%" />
				<col width="50%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="fir">게시판 꾸미기</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<th scope="row" class="fir">
					<label for="a_displaysu">페이지당 게시물 수</label>
				</th>
				<td class="tal">
					<input type="text" name="a_displaysu" id="a_displaysu" size="5" maxlength="2" value="<? echo $a_displaysu ?>" class="basic"/>
				</td>
				<td class="tal">
					페이지당 게시물 수
				</td>
			</tr>
			<tr>
				<th scope="row" class="fir">
					<label for="a_pagesu">페이지 나눔</label>
				</th>
				<td class="tal">
					<input type='text' name='a_pagesu' size='5' maxlength='2' value="<? echo $a_pagesu ?>" class="basic">
				</td>
				<td class="tal">
					페이징 수
				</td>
			</tr>
			<tr>
				<th scope="row" class="fir">
					<label for="a_pagesu">정렬</label>
				</th>
				<td class="tal">
					<select name="a_orderby">
						<option value="num" <? if($a_orderby == "num") { ?>selected<? } ?>>번호</option>
						<option value="title" <? if($a_orderby == "title") { ?>selected<? } ?>>제목</option>
						<option value="regdate" <? if($a_orderby == "regdate") { ?>selected<? } ?>>날짜</option>
					</select>
					<input name="a_orderby_type" type="radio" value="Desc" <? if($a_orderby_type == "Desc" or $a_orderby_type == "") { ?>checked<? } ?> />Desc&nbsp;&nbsp;
					<input name="a_orderby_type" type="radio" value="Asc" <? if($a_orderby_type == "Asc") { ?>checked<? } ?>>Asc		
				</td>
				<td class="tal">
					게시판 정렬
				</td>
			</tr>
			<tr>
				<th scope="row" class="fir">
					<label for="a_title_len">제목 길이</label>
				</th>
				<td class="tal">
					<input type='text' name='a_title_len' size='4' maxlength='3' value="<? echo $a_title_len ?>" class="basic" />
					(한글 2byte, 영문/숫자 1byte)
				</td>
				<td class="tal">
					제목 길이 제한
				</td>
			</tr>
			<tr>
				<th scope="row" class="fir">
					<label for="a_view">화면(view)</label>
				</th>
				<td class="tal">
					<input name="a_view" type="radio" value="1" <? if($a_view == 1) { ?>checked<? } ?>>기본화면&nbsp;&nbsp;&nbsp;  
					<input name="a_view" type="radio" value="2" <? if($a_view == 2 or $a_view == "") { ?>checked<? } ?>>기본화면+이전다음글&nbsp;&nbsp;&nbsp;
					<br/>
					<input name="a_view" type="radio" value="3" <? if($a_view == 3) { ?>checked<? } ?>>기본화면+목록&nbsp;&nbsp;&nbsp;
					<!--<input name="a_view" type="radio" value="4" <? if($a_view == 4) { ?>checked<? } ?>>기본화면+관련글-->
				</td>
				<td class="tal">
					화면(view) 설정
				</td>
			</tr>
		</tbody>
	</table>
<br>
	<table class="bbsCont" cellspacing="0" summary="포토 게시판 설정 목록 보기">
<!--
			<caption class="none">포토 게시판</caption>
			<colgroup>
				<col width="20%" />
				<col width="50%" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th colspan="3" class="fir">포토 게시판</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row" class="fir">
						<label for="a_photo">포토 게시판</label>
					</th>
					<td class="tal">
						<input name="a_photo" type="radio" value="Y" <? if($a_photo == "Y") { ?>checked<? } ?> onclick="DisplayPhoto('Y')">사용&nbsp;&nbsp; 
						<input name="a_photo" type="radio" value="N" <? if($a_photo == "N"  or $a_photo == "") { ?>checked<? } ?>  onclick="DisplayPhoto('N')" >사용안함
					</td>
					<td class="tal">
						포토 게시판 사용 여부
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_photo_width">이미지 넓이</label>
					</th>
					<td class="tal">
						<input name="a_photo_width" type="text" size="4" maxlength="3"  value="<? echo $a_photo_width ?>" <? if($a_photo == "N") { ?>disabled style="background-color='#F3F3F3'"<? } ?> >
					</td>
					<td class="tal">
						이미지 넓이 설정
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_photo_height">이미지 높이</label>
					</th>
					<td class="tal">
						<input name="a_photo_height" type="text" size="4" maxlength="3" value="<? echo $a_photo_height ?>" <? if($a_photo == "N") { ?>disabled style="background-color='#F3F3F3'"<? } ?>>
					</td>
					<td class="tal">
						이미지 높이 설정
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_photo_cols">행수</label>
					</th>
					<td class="tal">
						<input name="a_photo_cols" id="a_photo_cols" type="text" size="4" maxlength="3" value="<? echo $a_photo_cols ?>" <? if($a_photo == "N") { ?>disabled style="background-color='#F3F3F3'"<? } ?> >
					</td>
					<td class="tal">
						목록에 뿌려진 행수
					</td>
				</tr>
				<tr>
					<th scope="row" class="fir">
						<label for="a_photo_rows">열수</label>
					</th>
					<td class="tal">
						<input name="a_photo_rows" id="a_photo_rows" type="text" size="4" maxlength="3" value="<? echo $a_photo_rows ?>" <? if($a_photo == "N") { ?>disabled style="background-color='#F3F3F3'"<? } ?> >
					</td>
					<td class="tal">
						목록에 뿌려진 열수
					</td>
				</tr>
			</tbody>
		-->
			<tfoot>
				<tr>
					<td colspan="3">
						<input type="image" src="/pages/admin/images/bbs/btn_write_big.gif" alt="등록" />
						<a href="<?=$pageUrl.$pageName?>&page=/pages/admin/bbs/bbs_admin_form.php"><img src="/pages/admin/images/bbs/btn_cancel_big.gif" alt="취소" /></a>
					</td>
				</tr>
			</tfoot>
		</table>
		<input name="a_photo" type="hidden" value="N" >
</form>