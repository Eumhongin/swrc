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
	{  // *** ������ ���� �Խ��� ********************************************************  
		?>
		<?
	}
	else
	{
		?>                                    
		<? 
		if($HTTP_SESSION_VARS[duid] == "") 
		{	//��ȸ���ϰ�츸 ?>
			if ( CheckSpaces(frm.b_writer, '�̸��� �Է��Ͽ� �ֽʽÿ�', 0) ) { return; }
			<? 
			if($a_idx <> "I_040204202620")  
			{
				?>
				if ( CheckSpaces(frm.b_pass, '��й�ȣ�� �Է��Ͽ� �ֽʽÿ�', 0) ) { return; }
				<?
			}  
		} 
		if($a_category == "Y")
		{	//ī�װ� ���  
			?>
			if ( CheckSpaces(frm.b_category, 'ī�װ��� �����Ͽ� �ֽʽÿ�', 0) ) { return; }
			<?
		}
		if($a_jumin == "Y")  
		{	//�ֹε�Ϲ�ȣ ��� 
			?>
			if (CheckSpaces(frm.b_jumin1, '�ֹε�Ϲ�ȣ ���ڸ��� �Է��Ͽ� �ֽʽÿ�', 0)) { return; }
			if (CheckSpaces(frm.b_jumin2, '�ֹε�Ϲ�ȣ ���ڸ��� �Է��Ͽ� �ֽʽÿ�', 0)) { return; }
			if (jumin_chk(frm.b_jumin1,frm.b_jumin2) ) { return; }
			<?
		} 
		if($a_phone == "Y")  
		{	//����ó ��� 
			?>
			if ( Digit(frm.b_phone1, '����ó�� �Է��Ͽ� �ֽʽÿ�', 0)) { return; }
			if ( Digit(frm.b_phone2, '����ó�� �Է��Ͽ� �ֽʽÿ�', 0)) { return; }
			if ( Digit(frm.b_phone3, '����ó�� �Է��Ͽ� �ֽʽÿ�', 0)) { return; }
		<? 
		}
		?>
		<? if($a_idx == "I_040204202620") 
		{
			?>
			if ( CheckSpaces(frm.b_email, '�̸��� �ּҸ� �Է��Ͽ� �ֽʽÿ�', 0) ) { return; }
			<?
		}
		?>
		<?
	}
	?>

	if ( CheckSpaces(frm.b_subject, '������ �Է��Ͽ� �ֽʽÿ�', 0) ) { return; }
	if ( CheckSpaces(frm.b_content, '������ �Է��Ͽ� �ֽʽÿ�', <? if($a_phone == "N") { ?>0<? } else { ?>1<? } ?>) ) { return; }

	<?
		
	if($a_idx == "I_070317102520")
	{	//# ���� �̺�Ʈ�� ��� ��� �ϳ��� ÷�� ������ �ʿ��ϴ�...
	?>
		if(!frm["b_filename[]"][0].value && !frm["b_filename[]"][1].value) 
		{ 
			alert('��Ͽ� ������ ������ ����Ͽ� �ֽʽÿ�.'); 
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