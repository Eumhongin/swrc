<?php
	//*******************  Information  ***********************
	//	Program Title	: admin session 확인
	//	File Name		  :	admin_security.php
	//*********************************************************
	session_start();

  if ($HTTP_SESSION_VARS[dupower] <> 2) {
				
			echo("<script type=\"text/javascript\">
							alert('권한이 없거나 연결이 끊겼습니다.!'); 
							top.location.href='/pages/admin/login/loginForm.php';
				</script>");    
			exit;
	}
?>