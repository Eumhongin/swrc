<?php
	//파일을 DB에 저장하는 페이지
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


	//파라미터 빌더 세팅
	$listParameter = "pageIdx=".$pageIdx."&searchCategoryIdx=".$searchCategoryIdx."&listCount=".$listCount."&searchKeyword=".$searchKeyword."&orderByColumn=".$orderByColumn."&isOrderByAsc=".$isOrderByAsc."&idx=".$idx;

	//새글 등록일 경우
	if(!$isEdit){
		$idx = getNewCmsManagementIdx();
		if($idx == "") $idx = 1;
	}

	$contentIdx = getNewCmsContentIdx();
	if($contentIdx == "") $contentIdx = 1;
	

	// 텍스트로 콘텐츠를 올릴 경우. 파일은 차후 작업
	if($uploadType == "text"){

	}

	//파일의 명칭을 만든다.
	$fileName = $idx;

	//기존 파일이 있을 경우
	if(file_exists($cmsContentsPagesPath."/".$fileName.".php") && $isEdit){
		//파일을 읽는다.
		$readFile = fopen($cmsContentsPagesPath."/".$fileName.".php", "r");
		//읽은 파일의 내용을 변수에 담는다.
		while(!feof($readFile)){
			$fileContents .= fgets($readFile);
		}
		fclose($readFile);

		$fileContents = str_replace("\\", "", $fileContents);

		//org 경로에 기존 내용 저장
		$openOrgFile = fopen($cmsContentsOrgPagesPath."/".$contentIdx.".php", "w+");
		fwrite($openOrgFile, $fileContents);
		fclose($openOrgFile);
		
	}

	$contentText = str_replace("\\", "", $contentText);

	//파일 작성
	$openFile = fopen($cmsContentsPagesPath."/".$fileName.".php", "w+");
	fwrite($openFile, $contentText);
	//파일 길이
	$checksum = filesize($cmsContentsPagesPath."/".$fileName.".php");
	fclose($openFile);

	$cmsContentArr[idx] = $contentIdx;
	$cmsContentArr[management_idx] = $idx;
	//임의로 $checksum 값 넣어놈.
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

	//Content가 변경될때만 저장한다.
	if($contentIdx > 0){
		$result = $result && insertCmsContentArr($cmsContentArr);
	}
	
	if($result){
		if($isEdit){
			message_url("콘텐츠가 수정되었습니다.", "/pages/admin/main.php?pageName=콘텐츠관리&page=/pages/admin/cms/cmsManagementForm.php&".$listParameter);
		}else{
			message_url("콘텐츠가 입력되었습니다.", "/pages/admin/main.php?pageName=콘텐츠관리&page=/pages/admin/cms/cmsManagementList.php&".$listParameter);
		}
	}else{
		if($isEdit){
			message("콘텐츠 수정에 실패하였습니다.");
		}else{
			message("콘텐츠 입력에 실패하였습니다.");
		}
	}

?>