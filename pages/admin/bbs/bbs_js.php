<script type="text/javascript">
<!--
function bbs_checkform()
{
	var form = document.frm;
	/*
	var str = document.twe.MimeValue();
	form.mime_contents.value = str;		
	form.b_content.value = str;
*/
	<? if($a_photo == "N") 
	{
		?>
		if(window.VBN_prepareSubmit != null)	
		{
			if(!VBN_prepareSubmit())  
			{
				return false;
			}
		}
		<?
	}
	?>
	<?
	if($a_idx == "I_040320094455")  
	{  // *** 웹진에 관련 게시판 ********************************************************  
		?>
		<?
	}
	else
	{
		?>                                    
		<? 
		if($HTTP_SESSION_VARS[duid] == "") 
		{	//비회원일경우만 ?>
			if ( CheckSpaces(frm.b_writer, '이름을 입력하여 주십시오', 0) ) { return; }
			<? 
			if($a_idx <> "I_040204202620")  
			{
				?>
				if ( CheckSpaces(frm.b_pass, '비밀번호를 입력하여 주십시오', 0) ) { return; }
				<?
			}  
		} 
		if($a_category == "Y")
		{	//카테고리 사용  
			?>
			if ( CheckSpaces(frm.b_category, '카테고리를 선택하여 주십시오', 0) ) { return; }
			<?
		}
		if($a_jumin == "Y")  
		{	//주민등록번호 사용 
			?>
			if (CheckSpaces(frm.b_jumin1, '주민등록번호 앞자리를 입력하여 주십시오', 0)) { return; }
			if (CheckSpaces(frm.b_jumin2, '주민등록번호 뒷자리를 입력하여 주십시오', 0)) { return; }
			if (jumin_chk(frm.b_jumin1,frm.b_jumin2) ) { return; }
			<?
		} 
		if($a_phone == "Y")  
		{	//연락처 사용 
			?>
			if ( Digit(frm.b_phone1, '연락처를 입력하여 주십시오', 0)) { return; }
			if ( Digit(frm.b_phone2, '연락처를 입력하여 주십시오', 0)) { return; }
			if ( Digit(frm.b_phone3, '연락처를 입력하여 주십시오', 0)) { return; }
		<? 
		}
		?>
		<? if($a_idx == "I_040204202620") 
		{
			?>
			if ( CheckSpaces(frm.b_email, '이메일 주소를 입력하여 주십시오', 0) ) { return; }
			<?
		}
		?>
		<?
	}
	?>

	if ( CheckSpaces(frm.b_subject, '제목을 입력하여 주십시오', 0) ) { return; }
	if ( CheckSpaces(frm.b_content, '내용을 입력하여 주십시오', <? if($a_phone == "N") { ?>0<? } else { ?>1<? } ?>) ) { return; }

	<?
		
	if($a_idx == "I_070317102520")
	{	//# 포토 이벤트의 경우 적어도 하나의 첨부 파일이 필요하다...
	?>
		if(!frm["b_filename[]"][0].value && !frm["b_filename[]"][1].value) 
		{ 
			alert('목록에 보여질 사진을 등록하여 주십시오.'); 
			frm["b_filename[]"][0].focus();
			return; 
		} 
	<?
	}
	
	?>

	document.frm.submit();
	return;


}


function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

-->
</script>