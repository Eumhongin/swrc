<?php
	
	//CMS 설정 정보
	//CMS 페이지나 파일이 임시 저장될 경로
	$cmsContentsTempPath = $_SERVER[DOCUMENT_ROOT]."/contents/temp";
	//CMS 페이지가 저장될 경로
	$cmsContentsPagesPath = $_SERVER[DOCUMENT_ROOT]."/contents/pages";
	//CMS 페이지 최대 크기
	$cmsContentsPagesLength = 10485760;
	//CMS 파일이 저장될 경로
	$cmsContentsFilesPath = $_SERVER[DOCUMENT_ROOT]."/contents/files";
	//이번 CMS 파일이 옮겨질 경로
	$cmsContentsOrgPagesPath = $_SERVER[DOCUMENT_ROOT]."/contents/org";

	//CMS 링크 타입 선언
	define("INCLUDE_LINK_TYPE",0);
	define("CMS_LINK_TYPE",1);
	define("URL_LINK_TYPE",2);
	define("JAVASCRIPT_LINK_TYPE",3);

	define("INCLUDE_LINK_TYPE_STR", "Include");
	define("CMS_LINK_TYPE_STR", "CMS");
	define("URL_LINK_TYPE_STR", "URL");
	define("JAVASCRIPT_LINK_TYPE_STR", "Javascript");


?>