<?
//*******************  Information  ***********************
//	Program Title	:	게시판 글입력
//	File Name		  :	writeform.php
//*********************************************************

include("../../config/bbs_lib.inc.php"); 
include("../../config/mysql.inc.php");
include("../../config/comm.inc.php");  

	$pageUrl .= $pageName;

	$a_idx = $_REQUEST["a_idx"];
	$category = $_REQUEST["category"];
	$keyword = $_REQUEST["keyword"];
	$search = $_REQUEST["search"];
	$b_num = $_REQUEST["b_num"];
	$real_num = $_REQUEST["b_num"];
	$look = $_REQUEST["look"];
	$mnu_name = $_REQUEST["mnu_name"];
	$pageIdx = $_REQUEST["pageIdx"];
	$mode = $_REQUEST["mode"];
	$wb_num = $_REQUEST["wb_num"];

	$mysql = new Mysql_DB;
	$mysql->Connect();

// *** 게시판 환경 **** 
Bbs_Config($a_idx);

if($b_num <> "") 
{        //답변, 수정일때

	$qry = "Select * From $a_tablename Where b_num = $b_num";
	if($mode == "modify"  and $HTTP_SESSION_VARS[duid] <> "" and !($m_power == "2" or $adminstrator == true)) 	
	$qry .= " And b_id = '$HTTP_SESSION_VARS[duid]' ";
	$mysql->ParseExec($qry);

	if ($mysql->RowCount() < 1) 
	{
		message("등록된 글이 존재하지 않습니다");
	}
	else
	{
		$mysql->FetchInto(&$row);

		if($mode == "modify") 
		{
			$b_id        = $row[b_id];
			$b_category  = $row[b_category];
			$b_date      = $row[b_date];
			$b_writer    = utf8ToEuckr(del_quot($row[b_writer]));
			$b_email     = utf8ToEuckr($row[b_email]);
			$b_jumin     = Split("-",$row[b_jumin]);
			$b_phone     = Split("-",$row[b_phone]);
			$b_home      = $row[b_home];
			$b_html      = $row[b_html];
			$b_top       = $row[b_top];
			$b_content   = utf8ToEuckr($row[b_content]);
			$b_regdate   = $row[b_regdate];
			$b_regdate   = explode(" ", $b_regdate);
			$b_count     = $row[b_count];
			$b_look      = $row[b_look];
			$b_open      = $row[b_open];
			$b_seminar   = $row[b_seminar];

			$b_content  = output_value($b_content);

			/*if($b_html == "0")     $b_content  = output_value($b_content);
			elseif($b_html == "1") $b_content  = cnl2br(output_value($b_content));*/
			if($b_html == "0")     $b_content  = output_value($b_content);
			elseif($b_html == "1") $b_content  = output_value($b_content);
			elseif($b_html == "2") $b_content  = cnl2br(output_value($b_content));


			// 수정할 컨텐트를 지정한다. (데이터베이스로부터 가져온 .. )
			// 여기서 가져온 컨텐트의 HTML 문자열 중에 특수 문자를 HTML 엔티티로 변경한다.
			// 그리고 content를 값으로 지정하는 form의 값은 반드시 "로 감싸야 한다.
			// ex> <input type="hidden" value="<%= content % >">
			$content = stripslashes($b_content);
			$content = htmlspecialchars($content, ENT_QUOTES);



			//게시판 관리자, 총관리자만 패스워드를 보여준다
			if($m_power == "2" or $adminstrator == true) 
			{
				$b_pass    = $row[b_pass];
			}

			// *** 수정 권한 ***
			if($mode == "modify" and $m_modify == "N") 
			{
				message("수정 권한이 없습니다");
			}	
			else
			{
				// *** 수정 권한(비공개)***
				if($b_open == 1 and $open_pass <> $row[b_pass] and !($m_power == "2" or $adminstrator == true)) 
				{
					message("수정 권한이 없습니다");
				} 

				// *** 수정 권한(회원) ***
				if($b_id <> "" and $b_id <> $HTTP_SESSION_VARS[duid] and !($m_power == "2" or $adminstrator == true)) 
				{
					message("수정 권한이 없습니다");
				} 
			}


		}

		$b_year     = substr($b_date,0,4);
		$b_month    = substr($b_date,4,2);
		$b_subject  = del_quot($row[b_subject]);
		$b_ref      = $row[b_ref];
		$b_step     = $row[b_step];
		$b_level    = $row[b_level];

		// *** 답변 권한 ***
		if($mode == "reply" and $a_reply == "N" and !($m_reply == "Y" or $m_power == "2" or $adminstrator == true)) 
		{
			message("답변 권한이 없습니다");
		}
		if($mode == "reply") 
		{
			$b_id     = $HTTP_SESSION_VARS[duid];
			$b_writer = $HTTP_SESSION_VARS[duname];
		} 
	}
}
else 
{    // 새글일때

	// *** 쓰기 권한 ***
	if(($mode == "" or $mode == "write") and ! ($m_write == "Y" or $m_power == "2" or $adminstrator == true))	{ message("쓰기 권한이 없습니다"); }

	$b_id     = $HTTP_SESSION_VARS[duid];
	$b_writer = $HTTP_SESSION_VARS[duname];
	$b_year   = date("Y");
	$b_month  = date("m");

}

if($mode == "modify") 
{
	// *** 첨부파일 **** 
	$fqry = "Select * From bbs_file Where f_tablename='$a_tablename' and f_num = $b_num Order by f_sort ";
	$mysql->ParseExec($fqry);
	while($mysql->FetchInto(&$file))  { $temp_file[$file["f_sort"]] = utf8ToEuckr($file["f_filename"]); }
}

?>

<script type="text/javascript" src="/config/common.js"></script>
<!--
<script FOR="twe" type="text/javascript"  EVENT="OnControlInit()">
	var form = document.frm;
	form.twe.HtmlValue = form.contents.value;
</script>
-->

<script type="text/javascript" src="/pages/bbs/js/comm.js"></script>
<script type="text/javascript" src="/pages/bbs/se2/js/HuskyEZCreator.js" charset="utf-8"></script>
<?// include("bbs_js.php");?>  

<script type="text/javascript">

	function fncCheckForm(){
		 oEditors.getById["b_content"].exec("UPDATE_CONTENTS_FIELD", []);
 

    // 에디터의 내용에 대한 값 검증은 이곳에서

    // document.getElementById("ir1").value를 이용해서 처리한다.

		
		if("<?=$HTTP_SESSION_VARS[duid]?>" == "") 
		{	//비회원일경우만 ?>
			if ( CheckSpaces(frm.b_writer, '이름을 입력하여 주십시오', 0) ) { return false; }
			if ( CheckSpaces(frm.b_pass, '비밀번호를 입력하여 주십시오', 0) ) { return false; }
		} 

		if("<?=$a_category?>" == "Y")
		{	//카테고리 사용 
			if ( CheckSpaces(frm.b_category, '카테고리를 선택하여 주십시오', 0) ) { return false; }
		}
		if("<?=$a_jumin?>" == "Y")  
		{	//주민등록번호 사용
			if (CheckSpaces(frm.b_jumin1, '주민등록번호 앞자리를 입력하여 주십시오', 0)) { return false; }
			if (CheckSpaces(frm.b_jumin2, '주민등록번호 뒷자리를 입력하여 주십시오', 0)) { return false; }
			if (jumin_chk(frm.b_jumin1,frm.b_jumin2) ) { return false; }
		} 
		if("<?=$a_phone?>" == "Y")  
		{	//연락처 사용 
			if ( Digit(frm.b_phone1, '연락처를 입력하여 주십시오', 0)) { return false; }
			if ( Digit(frm.b_phone2, '연락처를 입력하여 주십시오', 0)) { return false; }
			if ( Digit(frm.b_phone3, '연락처를 입력하여 주십시오', 0)) { return false; }
		}

		if ( CheckSpaces(frm.b_subject, '제목을 입력하여 주십시오', 0) ) { return false; }
		if ( CheckSpaces(frm.b_content, '내용을 입력하여 주십시오', <? if($a_phone == "N") { ?>0<? } else { ?>1<? } ?>) ) { return false; }

		frm.b_content.value =frm.b_content.value.replace(/<p>/gi, "");
		frm.b_content.value = frm.b_content.value.replace(/<\/p>/gi, "<br>");


		return true;
	}

</script>

	<form name="frm" method="post" onSubmit="return fncCheckForm();" action="<?=$pageUrl?>&page=/pages/admin/bbs/write.php" enctype="multipart/form-data">
	<input type="hidden" name="temp" value="" />
	<input type="hidden" name="a_idx" value="<?=$a_idx ?>" />
	<input type="hidden" name="mode" value="<?=$mode ?>" />
	<input type="hidden" name="b_num" value="<?=$b_num ?>" />
	<input type="hidden" name="b_ref" value="<?=$b_ref ?>" />
	<input type="hidden" name="b_step" value="<?=$b_step ?>" />
	<input type="hidden" name="b_level" value="<?=$b_level ?>" />
	<input type="hidden" name="category" value="<?=$category ?>" />
	<input type="hidden" name="search" value="<?=$search ?>" />
	<input type="hidden" name="keyword" value="<?=curlencode($keyword) ?>" />
	<input type="hidden" name="pageIdx" value="<?=$pageIdx ?>" />
	<input type="hidden" name="mime_contents" />
	<input type="hidden" name="contents" value="<? echo($content) ?>" />
	<!-- 기존 컨텐트를 저장 -->

	<div class="bbsView">
		<table class="wps_100" summary="<?=$a_bbsname?> 글쓰기">
			<caption class="none"><?=$a_bbsname?></caption>
				<colgroup>
					<col width="15%" />
					<col width="85%" />
				</colgroup>
				<thead>
					<tr>
						<th colspan="2" class="acenter">글쓰기</th>
					</tr>
				</thead>
				<tbody>						
					<? 
					if($a_category == "Y")  
					{   //카테고리 사용 
						?>

					<tr>
						<th scope="row">
							<label for="subject">카테고리 선택</label>
						</th>
						<td>
						<select name="b_category">
							<?
							$sql = "Select * From bbs_admin_cate Where c_use='1' and c_tablename='$a_tablename' Order by c_cate ";
							$mysql->ParseExec($sql);

							while($mysql->FetchInto(&$cate)) 
							{   
								?>
								<option value="<?=$cate[c_cate] ?>" <? if($category == $cate[c_cate]) { ?>selected<? } ?>><?=$cate[c_catename] ?></option>
								<? 
							} 
							?>
						</select>
						</td>
					</tr>
					<?  
					} //카테고리 사용 if문 닫음  ?>
					<? 
//---------------------------여기서부터 일반 게시판 시작 kimna -----------------------
					?>
					<tr>
						<th scope="row">
							<label for="b_subject">제목</label> <span class="f_orange">*</span>
						</th>
						<td>
							<input type="text" id="b_subject" name="b_subject" size="50" class="basic" value="<?=utf8ToEuckr($b_subject)?>"/>
							<?if($a_photo == "N" and ($m_power == "2" or $adminstrator == true)) { ?>
								<input type="checkbox" name="b_top" <? if($b_top == "Y") {?>checked<? } ?>> 공지
							<? } ?> 
						</td>
					</tr>

					<?
					if($HTTP_SESSION_VARS[duid] == "") 
					{ 
						//비회원일경우만 
						?>
						<tr>
							<th scope="row">
								작성자 <span class="f_orange">*</span>
							</th>
							<td>
								<input type="text" id="b_writer" name="b_writer" size="50" class="basic" value="<?=$b_writer?>"/>
							</td>
						</tr>
						<tr>
							<th scope="row">
								비밀번호 <span class="f_orange">*</span>
							</th>
							<td>
								<input type="password" id="b_pass" name="b_pass" size="50" maxlength="10" class="basic" value="<?=$b_pass?>"/>
							</td>
						</tr>
					<? 
					}else{
					?>
						<tr>
							<th scope="row">
								작성자 <span class="f_orange">*</span>
							</th>
							<td>
								<?=$b_writer?>(<?=$b_id?>)
							</td>
						</tr>
					<? 
					} 
					?>

					<? 
					if($a_jumin == "Y"){ //주민등록번호 사용 
					?>
						<tr>
							<th scope="row">
								주민등록번호 
							</th>
							<td>
								<input type="text" name="b_jumin1" id="b_jumin1" size="20" class="basic" value="<?=$b_jumin[0] ?>" />
								 - 
								<input type="password" name="b_jumin2" id="b_jumin2" size="20" class="basic" value="<?=$b_jumin[1] ?>" />
							</td>
						</tr>
						<?  
					} //주민등록번호 사용 if문 닫음  
					?>

					<? 
					if($a_phone == "Y"){//연락처 사용 
					?>
						<tr>
							<th scope="row">
								연락처
							</th>
							<td>
								<input type="text" name="b_phone1" id="b_phone1" maxlength="3" size="10" class="basic" value="<?=$b_phone[0]?>" />
								 - 
								<input type="text" name="b_phone2" id="b_phone2" maxlength="4" size="10" class="basic" value="<?=$b_phone[1] ?>" />
								 -
								<input type="text" name="b_phone3" id="b_phone3" maxlength="4" size="10" class="basic" value="<?=$b_phone[2] ?>" />
							</td>
						</tr>
					<?  
					} //연락처 사용 if문 닫음  
					?>
					<? 
					if($a_email == "Y"){ //이메일 사용 
					?>
						<tr>
							<th scope="row">
								e-mail
							</th>
							<td>
								<input type="text" name="b_email" id="b_email" size="50" class="basic" value="<?=(!$b_email)?$duemail:$b_email?>" />
							</td>
						</tr>
					<?  
					} //이메일 사용 if문 닫음  
					?>

					<? 
					if($a_homepage == "Y") {//홈페이지사용 
					?>
						<tr>
							<th scope="row">
								홈페이지
							</th>
							<td>
								<input type="text" name="b_home" id="b_home" size="50" class="basic" value="<?=$b_home ?>" />
							</td>
						</tr>
					<? 
					} //홈페이지 사용 if문 닫음  
					?>

					<tr>
						<th scope="row">
							<label for="b_content">내용</label> <span class="f_orange">*</span>
						</th>
						<td>
							<!--
							<textarea id="b_content" name="b_content" cols="80" rows="14"><?=$b_content?></textarea><br/>
							-->
							<!--
							<input type="checkbox" id="b_html" name="b_html" value="1" <?if($b_html == "1"){?>checked<?}?>/>
							<label for="b_html">HtmlTag사용</label>
							-->
							<textarea name="b_content" id="b_content" rows="18" cols="68"><?=$b_content?></textarea>
							<script type="text/javascript">
								var oEditors = [];
									nhn.husky.EZCreator.createInIFrame({
									oAppRef: oEditors,
									elPlaceHolder: "b_content",
									sSkinURI: "/pages/bbs/se2/SmartEditor2Skin.php",
									fCreator: "createSEditor2"
								});
							</script>
							<input type="hidden" id="b_html" name="b_html" value="0">
						</td>
					</tr> 
				<?
				if($a_photo == "Y" and $a_html =="Y") 
				{

				}   


				if($a_upload == "Y") 
				{ 
					for ($f = 0 ; $f < $a_upload_len; $f++) 
					{ 
						?>
						<tr>
							<th scope="row">
								<label for="file">
									파일첨부
								</label>
							</th>
							<td>
								<input type="file" id="b_filename<?=$f?>" name="b_filename<?=$f?>" class="basic" style="height:19px;" />
								<?if($temp_file[$f] <> ""){?>
									<?=$temp_file[$f] ?> <input type="checkbox" name="del_filename<?=$f?>" value="on"/> 기존파일 삭제
								<?}?>
							</td>
						</tr>
					<?
					}
					?>
					<input type="hidden" name="a_upload_len" value="<?=$a_upload_len?>">
					<input type="hidden" name="a_upload" value="<?=$a_upload?>">
				<?
				}
				?>
				<?
				if($a_type == 2) { //공개/비공개 사용
				?>
					<tr>
						<th scope="row">
							공개/비공개
						</th>
						<td>
							<input type="checkbox" id="b_open" name="b_open" value="1" <? if ($b_open == 1) { ?>checked<? } ?>/>
							<label for="b_open">비공개</label>
						</td>
					</tr>				
				<?}?>
		</tbody>
	</table>
</div><!--//bbsView -->

		<div class="bbsBtn">
			<p>
				<a href="<?=$pageUrl?>&page=/pages/admin/bbs/list.php&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category ?>&amp;search=<?=$search ?>&amp;keywrod=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>">
					<img src="/pages/admin/images/bbs/btn_list_big.gif" alt="목록" />
				</a>
			</p>
			<p>
				<input type="image" src="/pages/admin/images/bbs/btn_write_big.gif">
			</p>
		</div>
	</form>