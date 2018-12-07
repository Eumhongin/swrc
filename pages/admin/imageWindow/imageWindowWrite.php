<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");
	include ("../../query/imageWindow/imageWindowQuery.php");


	$mode = $_REQUEST["mode"];
	$idx = $_REQUEST["idx"];
	$window_name = euckrToUtf8($_REQUEST["window_name"]);
	//$window_image = $_REQUEST["window_image"];
	$image_alt = euckrToUtf8($_REQUEST["image_alt"]);
	$image_link = $_REQUEST["image_link"];
	$image_target = $_REQUEST["image_target"];
	$image_use_flag = $_REQUEST["image_use_flag"];


	$b_filename = euckrToUtf8($_FILES['window_image']['tmp_name']);
	$b_file_name = euckrToUtf8($_FILES['window_image']['name']);
	$b_file_size = $_FILES['window_image']['size'];

	
	$pageUrl .= $pageName;

	$newOrder = getNewMenuIdx();
	if($newOrder == "") $newOrder = 1;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$path = "../../up_file/imageWindow/";

	//금지단어 설정
	//추가 설정 할 것이 있을 경우 배열로 추가 해야함.
	$temp_nofile[0] = "php";

	$image_file_flag = "N";

	//기본으로 fimename 를 "" 으로 설정한다.
	$image_file_name = "";

	if($mode == "write" ){		
				
		if($b_file_size > 0){

			$tempfilename    = str_replace("\'","",$b_file_name);
			$filename        = ereg_replace("(\.[^\.]*$)","",$tempfilename);
			$filesize        = $b_file_size;
			$extension       = str_replace($filename,"",$tempfilename);
			$target			 = $path.$tempfilename;
			$strfilename	 = $filename.$extension;

			if($filesize > 10 * 1048576) {
				message_url("파일크기가 10MByte 이하여야 합니다.", $pageUrl."&page=/pages/admin/imageWindow/imageWindowList.php" );
			}



			for($i = 0; $i <= count($temp_nofile); $i++){
				for ($i = 0 ; $i <=count($temp_nofile); $i++) {
					if(strtolower($extension) == ".".strtolower($temp_nofile[$i])) 
						message_url($temp_nofile[$i]."파일은 첨부할 수 없습니다.", $pageUrl."&page=/pages/admin/imageWindow/imageWindowList.php" );
				}
			}

			for($k = 1; file_exists($target); $k++){
				$target = $path.$filename."_".$k.$extension;
				$strfilename = $filename."_".$k.$extension;
			}

			copy($b_filename, $target);

			//filename 과 flag 를 배열에 담는다.
			$image_file_name = $filename;
			$image_file_extension = $extension;
			$image_file_flag = "Y";

			$image_file_name = $image_file_name.$image_file_extension;
		}

		$query  = " INSERT INTO t_image_window ( ";
		if($image_file_flag == "Y"){
		$query .= "		image_name, ";
		}
		$query .= "		image_alt, ";
		$query .= "		image_link, ";
		$query .= "		image_target, ";
		$query .= "		image_regist_date, ";
		$query .= "		image_use_flag, ";
		$query .= "		image_order, ";
		$query .= "		window_name ";

		$query .= "		) VALUES ( ";
		if($image_file_flag == "Y"){
		$query .= "		'$image_file_name', ";
		}
		$query .= "		'$image_alt', ";
		$query .= "		'$image_link', ";
		$query .= "		'$image_target', ";
		$query .= "		now(), ";
		$query .= "		'$image_use_flag', ";
		$query .= "		'$newOrder', ";
		$query .= "		'$window_name' ";
		$query .= " ) ";

		$mysql->ParseExec($query);

		message_url("등록이 완료되었습니다.", $pageUrl."&page=/pages/admin/imageWindow/imageWindowList.php" );

	}elseif($mode == "edit"){

		if($idx == "") message_url("오류가 발생하였습니다.\\n\\n 관리자에게 문의하여 주시기 바랍니다.", $pageUrl."&page=/pages/admin/imageWindow/imageWindowList.php");

			
		if($b_file_size > 0){

			$tempfilename    = str_replace("\'","",$b_file_name);
			$filename        = ereg_replace("(\.[^\.]*$)","",$tempfilename);
			$filesize        = $b_file_size;
			$extension       = str_replace($filename,"",$tempfilename);
			$target			 = $path.$tempfilename;
			$strfilename	 = $filename.$extension;

			if($filesize > 10 * 1048576) {
				message_url("파일크기가 10MByte 이하여야 합니다.", $pageUrl."&page=/pages/admin/imageWindow/imageWindowList.php" );
			}



			for($i = 0; $i <= count($temp_nofile); $i++){
				for ($i = 0 ; $i <=count($temp_nofile); $i++) {
					if(strtolower($extension) == ".".strtolower($temp_nofile[$i])) 
						message_url($temp_nofile[$i]."파일은 첨부할 수 없습니다.", $pageUrl."&page=/pages/admin/imageWindow/imageWindowList.php" );
				}
			}

			for($k = 1; file_exists($target); $k++){
				$target = $path.$filename."_".$k.$extension;
				$strfilename = $filename."_".$k.$extension;
			}

			copy($b_filename, $target);

			//filename 과 flag 를 배열에 담는다.
			$image_file_name = $filename;
			$image_file_extension = $extension;
			$image_file_flag = "Y";

			$image_file_name = $image_file_name.$image_file_extension;
			
		}

		$query  = " UPDATE t_image_window SET ";
		
		if($image_file_flag == "Y"){
		$query .= "	image_name = '$image_file_name', ";
		}


		$query .= " image_alt = '$image_alt', ";
		$query .= " image_link = '$image_link', ";
		$query .= " image_target = '$image_target', ";
		$query .= " image_use_flag = '$image_use_flag', ";
		$query .= " window_name = '$window_name' ";
		$query .= " Where idx = '".$idx."' ";

		$mysql->ParseExec($query);

		message_url("수정이 완료되었습니다.", $pageUrl."&page=/pages/admin/imageWindow/imageWindowWriteForm.php&idx=".$idx."&mode=edit" );

	}else if($mode == "delete"){

		if($idx == "") message_url("오류가 발생하였습니다.\\n\\n 관리자에게 문의하여 주시기 바랍니다.", $pageUrl."&page=/pages/admin/imageWindow/imageWindowList.php");

		$query  = " DELETE FROM t_image_window ";
		$query .= " WHERE idx = '".$idx."' ";

		$mysql->ParseExec($query);

		message_url("성공적으로 삭제되었습니다.", $pageUrl."&page=/pages/admin/imageWindow/imageWindowList.php" );
	}

	$mysql->Disconnect();
?>