<?php
	//*******************  Information  ***********************
	//	Program Title	: admin session Ȯ��
	//	File Name		  :	admin_security.php
	//*********************************************************
	session_start();

  if ($HTTP_SESSION_VARS[dupower] <> 2) {
				
			echo("<script type=\"text/javascript\">
							alert('������ ���ų� ������ ������ϴ�.!'); 
							top.location.href='/pages/admin/login/loginForm.php';
				</script>");    
			exit;
	}
?>