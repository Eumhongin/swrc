<?php
	
	//CMS ���� ����
	//CMS �������� ������ �ӽ� ����� ���
	$cmsContentsTempPath = $_SERVER[DOCUMENT_ROOT]."/contents/temp";
	//CMS �������� ����� ���
	$cmsContentsPagesPath = $_SERVER[DOCUMENT_ROOT]."/contents/pages";
	//CMS ������ �ִ� ũ��
	$cmsContentsPagesLength = 10485760;
	//CMS ������ ����� ���
	$cmsContentsFilesPath = $_SERVER[DOCUMENT_ROOT]."/contents/files";
	//�̹� CMS ������ �Ű��� ���
	$cmsContentsOrgPagesPath = $_SERVER[DOCUMENT_ROOT]."/contents/org";

	//CMS ��ũ Ÿ�� ����
	define("INCLUDE_LINK_TYPE",0);
	define("CMS_LINK_TYPE",1);
	define("URL_LINK_TYPE",2);
	define("JAVASCRIPT_LINK_TYPE",3);

	define("INCLUDE_LINK_TYPE_STR", "Include");
	define("CMS_LINK_TYPE_STR", "CMS");
	define("URL_LINK_TYPE_STR", "URL");
	define("JAVASCRIPT_LINK_TYPE_STR", "Javascript");


?>