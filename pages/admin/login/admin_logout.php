<? 
	//*******************  Information  ***********************
	//	Program Title	:	�α׾ƿ�
	//	File Name		  :	logout.php
	//*********************************************************
	
	session_start();
	session_destroy();

	include("../../../config/comm.inc.php"); 
 
	movepage("loginForm.php","top");	
?>