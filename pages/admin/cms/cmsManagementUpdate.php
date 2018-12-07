<?php
	//������ DB�� �����ϴ� ������
	// 2011 01 25 
	//kimna

	//request Parameter
	//$site_code, $listcount, $searchKeyword, $orderByColumn, $isOrderByAsc
	//$contentFileCharset, $orgChecksum

	include("../../config/stringBuffer.inc.php"); 
	include("../../config/mysql.inc.php");
	include("../../config/webConfig.inc.php");
	include("../../config/comm.inc.php");
	include("../../query/cms/cmsQuery.php");
	include("../../query/menu/menuQuery.php");

	$SiteCode = getParameter($_REQUEST["site_code"], "505000000");
	$idx = $_REQUEST["idx"];
	$pageIdx = $_REQUEST["pageIdx"];
	$searchCategoryIdx = $_REQUEST["searchCategoryIdx"];
	$listcount = $_REQUEST["listcount"];
	$searchKeyword = $_REQUEST["searchKeyword"];
	$orderByColumn = $_REQUEST["orderByColumn"];
	$isOrderByAsc = $_REQUEST["isOrderByAsc"];

	$memo = euckrToUtf8($_REQUEST["memo"]);
	$orgChecksum = $_REQUEST["orgChecksum"];
	$memoForm = euckrToUtf8($_REQUEST["memoForm"]);
	$title = euckrToUtf8($_REQUEST["title"]);
	$description = $_REQUEST["description"];
	$useFlag = $_REQUEST["useFlag"];
	$uploadType = $_REQUEST["uploadType"];
	$contentText = $_REQUEST["contentText"];
	$contentFile = $_REQUEST["contentFile"];
	$categoryIdx = $_REQUEST["categoryIdx"];

	$cmsManagementArr = array();
	$cmsContentArr = array();

	
	//if($idx > 0) $isEdit = true;

	$idx > 0 ? $isEdit = true : $isEdit = false;


	//�Ķ���� ���� ����
	$listParameter = "pageIdx=".$pageIdx."&searchCategoryIdx=".$searchCategoryIdx."&listCount=".$listCount."&searchKeyword=".$searchKeyword."&orderByColumn=".$orderByColumn."&isOrderByAsc=".$isOrderByAsc."&idx=".$idx;

	//���� ����� ���
	if(!$isEdit){
		$idx = getNewCmsManagementIdx();
		if($idx == "") $idx = 1;
	}

	$contentIdx = getNewCmsContentIdx();
	if($contentIdx == "") $contentIdx = 1;
	

	// �ؽ�Ʈ�� �������� �ø� ���. ������ ���� �۾�
	if($uploadType == "text"){

	}

	//������ ��Ī�� �����.
	$fileName = $idx;

	//���� ������ ���� ���
	if(file_exists($cmsContentsPagesPath."/".$fileName.".php") && $isEdit){
		//������ �д´�.
		$readFile = fopen($cmsContentsPagesPath."/".$fileName.".php", "r");
		//���� ������ ������ ������ ��´�.
		while(!feof($readFile)){
			$fileContents .= fgets($readFile);
		}
		fclose($readFile);

		$fileContents = str_replace("\\", "", $fileContents);

		//org ��ο� ���� ���� ����
		$openOrgFile = fopen($cmsContentsOrgPagesPath."/".$contentIdx.".php", "w+");
		fwrite($openOrgFile, $fileContents);
		fclose($openOrgFile);
		
	}

	$contentText = str_replace("\\", "", $contentText);

	//���� �ۼ�
	$openFile = fopen($cmsContentsPagesPath."/".$fileName.".php", "w+");
	fwrite($openFile, $contentText);
	//���� ����
	$checksum = filesize($cmsContentsPagesPath."/".$fileName.".php");
	fclose($openFile);

	$cmsContentArr[idx] = $contentIdx;
	$cmsContentArr[management_idx] = $idx;
	//���Ƿ� $checksum �� �־��.
	$cmsContentArr[length] = $checksum;
	$cmsContentArr[write_name] = $duname;
	$cmsContentArr[write_id] = $duid;
	$cmsContentArr[write_ip] = $REMOTE_ADDR;
	$cmsContentArr[memo] = $memo;
	$cmsContentArr[checksum] = $checksum;
	
	$cmsManagementArr[management_idx] = $idx;
	$cmsManagementArr[content_idx] = $contentIdx;
	$cmsManagementArr[category_idx] = $categoryIdx;
	$cmsManagementArr[title] = $title;
	$cmsManagementArr[description] = $description;
	$cmsManagementArr[use_flag] = $useFlag;
	$cmsManagementArr[write_name] = $duname;
	$cmsManagementArr[write_id] = $duid;
	$cmsManagementArr[write_ip] = $REMOTE_ADDR;
	$cmsManagementArr[site_code] = $SiteCode;
		
	if($isEdit){
		$result = updateCmsManagementArr($cmsManagementArr);
	}else{
		$result = insertCmsManagementArr($cmsManagementArr);
	}

	//Content�� ����ɶ��� �����Ѵ�.
	if($contentIdx > 0){
		$result = $result && insertCmsContentArr($cmsContentArr);
	}
	
	if($result){
		if($isEdit){
			message_url("�������� �����Ǿ����ϴ�.", "/pages/admin/main.php?pageName=����������&page=/pages/admin/cms/cmsManagementForm.php&".$listParameter);
		}else{
			message_url("�������� �ԷµǾ����ϴ�.", "/pages/admin/main.php?pageName=����������&page=/pages/admin/cms/cmsManagementList.php&".$listParameter);
		}
	}else{
		if($isEdit){
			message("������ ������ �����Ͽ����ϴ�.");
		}else{
			message("������ �Է¿� �����Ͽ����ϴ�.");
		}
	}

?>