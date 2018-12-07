<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$path = "../../pool/data/";

	//금지단어 설정
	//추가 설정 할 것이 있을 경우 배열로 추가 해야함.
	$temp_nofile[0] = "php";

	//0 : pool_image, 1: pool_resume, 2: pool_forward, 3: pool_backward, 4: pool_bankbook
	//기본으로 모든 파일 플래그 N 으로 설정
	for($i = 0; $i <= 4; $i++){
		$pool_file_flag[$i] = "N";
	}
	//기본으로 fimename 를 "" 으로 설정한다.
	for($i = 0; $i <= 4; $i++){
		$pool_file_name_arr[$i] = "";
	}

	if($mode == "write" ){
	
		//0 : pool_image, 1: pool_resume, 2: pool_forward, 3: pool_backward, 4: pool_bankbook
		for($f = 0; $f < count($pool_file); $f++){
			
			if($pool_file_size[$f] > 0){

				$tempfilename    = str_replace("\'","",$pool_file_name[$f]);
				$filename        = ereg_replace("(\.[^\.]*$)","",$tempfilename);
				$filesize        = $pool_file_size[$f];
				$extension       = str_replace($filename,"",$tempfilename);
				$target			 = $path.$tempfilename;
				$strfilename	 = $filename.$extension;

				if($filesize > 10 * 1048576) {
					message_url("파일크기가 10MByte 이하여야 합니다.", $pageUrl."&page=/pages/admin/pool/pool.php" );
				}

				for($i = 0; $i <= count($temp_nofile); $i++){
					for ($i = 0 ; $i <=count($temp_nofile); $i++) {
						if(strtolower($extension) == ".".strtolower($temp_nofile[$i])) 
							message_url($temp_nofile[$i]."파일은 첨부할 수 없습니다.", $pageUrl."&page=/pages/admin/pool/pool.php" );
					}
				}

				for($k = 1; file_exists($target); $k++){
					$target = $path.$filename."_".$k.$extension;
					$strfilename = $filename."_".$k.$extension;
				}

				copy($pool_file[$f], $target);

				//filename 과 flag 를 배열에 담는다.
				$pool_file_name_arr[$f] = $filename;
				$pool_file_extension_arr[$f] = $extension;
				$pool_file_flag[$f] = "Y";
			}
		}

		$query  = " INSERT INTO t_pool ( ";
		$query .= "		pool_name, ";
		$query .= "		pool_organ, ";
		$query .= "		pool_select_organ, ";
		$query .= "		pool_grade, ";
		$query .= "		pool_pass, ";
		$query .= "		pool_tel, ";
		$query .= "		pool_fax, ";
		$query .= "		pool_hp, ";
		$query .= "		pool_zip_code, ";
		$query .= "		pool_address, ";
		$query .= "		pool_address_detail, ";
		$query .= "		pool_email, ";
		$query .= "		pool_major, ";
		$query .= "		pool_career, ";
		
		//업로드 된 파일이 있을 경우
		if($pool_file_flag[0] == "Y"){			
			$query .= "		pool_image, ";
		}
		if($pool_file_flag[1] == "Y"){
			$query .= "		pool_resume, ";
		}
		if($pool_file_flag[2] == "Y"){
			$query .= "		pool_idcard_forward, ";
		}
		if($pool_file_flag[3] == "Y"){
			$query .= "		pool_idcard_backward, ";
		}
		if($pool_file_flag[4] == "Y"){
			$query .= "		pool_bankbook, ";
		}

		$query .= "		pool_approve_date, ";
		$query .= "		pool_approve_flag, ";
		$query .= "		pool_request_date, ";
		$query .= "		pool_user_id ";
		$query .= "		) VALUES ( ";
		$query .= "		'$pool_name', ";
		$query .= "		'$pool_organ', ";
		$query .= "		'$pool_select_organ', ";
		$query .= "		'$pool_grade', ";
		$query .= "		'$pool_pass', ";
		$query .= "		'$pool_tel', ";
		$query .= "		'$pool_fax', ";
		$query .= "		'$pool_hp', ";
		$query .= "		'$pool_zip_code', ";
		$query .= "		'$pool_address', ";
		$query .= "		'$pool_address_detail', ";
		$query .= "		'$pool_email', ";
		$query .= "		'$pool_major', ";
		$query .= "		'$pool_career', ";

		//업로드 된 파일이 있을 경우
		if($pool_file_flag[0] == "Y"){			
			$query .= "		'".$pool_file_name_arr[0].$pool_file_extension_arr[0]."', ";
		}
		if($pool_file_flag[1] == "Y"){
			$query .= "		'".$pool_file_name_arr[1].$pool_file_extension_arr[1]."', ";
		}
		if($pool_file_flag[2] == "Y"){
			$query .= "		'".$pool_file_name_arr[2].$pool_file_extension_arr[2]."', ";
		}
		if($pool_file_flag[3] == "Y"){
			$query .= "		'".$pool_file_name_arr[3].$pool_file_extension_arr[3]."', ";
		}
		if($pool_file_flag[4] == "Y"){
			$query .= "		'".$pool_file_name_arr[4].$pool_file_extension_arr[4]."', ";
		}

		$query .= " now(), ";
		$query .= " 'Y', ";
		$query .= " now(), ";

		if($HTTP_SESSION_VARS[duid] != ""){
			$query .= " '$HTTP_SESSION_VARS[duid]' ";
		}else{
			$query .= " '' ";
		}

		$query .= " ) ";

		$mysql->ParseExec($query);

		message_url("신청이 완료되었습니다.", $pageUrl."&page=/pages/admin/pool/pool.php" );

	}elseif($mode == "edit"){

		if($pool_idx == "") message_url("오류가 발생하였습니다.\\n\\n 관리자에게 문의하여 주시기 바랍니다.", $pageUrl."&page=/pages/admin/pool/pool.php");


		//0 : pool_image, 1: pool_resume, 2: pool_forward, 3: pool_backward, 4: pool_bankbook
		for($f = 0; $f < count($pool_file); $f++){
			
			if($pool_file_size[$f] > 0){

				$tempfilename    = str_replace("\'","",$pool_file_name[$f]);
				$filename        = ereg_replace("(\.[^\.]*$)","",$tempfilename);
				$filesize        = $pool_file_size[$f];
				$extension       = str_replace($filename,"",$tempfilename);
				$target			 = $path.$tempfilename;
				$strfilename	 = $filename.$extension;

				if($filesize > 10 * 1048576) {
					message_url("파일크기가 10MByte 이하여야 합니다.", $pageUrl."&page=/pages/admin/pool/poolWriteForm.php&pool_idx=".$pool_idx );
				}

				for($i = 0; $i <= count($temp_nofile); $i++){
					for ($i = 0 ; $i <=count($temp_nofile); $i++) {
						if(strtolower($extension) == ".".strtolower($temp_nofile[$i])) 
							message_url($temp_nofile[$i]."파일은 첨부할 수 없습니다.", $pageUrl."&page=/pages/admin/pool/poolWriteForm.php&pool_idx=".$pool_idx );
					}
				}

				for($k = 1; file_exists($target); $k++){
					$target = $path.$filename."_".$k.$extension;
					$strfilename = $filename."_".$k.$extension;
				}

				copy($pool_file[$f], $target);

				//filename 과 flag 를 배열에 담는다.
				$pool_file_name_arr[$f] = $filename;
				$pool_file_extension_arr[$f] = $extension;
				$pool_file_flag[$f] = "Y";
			}
		}

		$query  = " UPDATE t_pool SET ";
		$query .= " pool_name = '$pool_name', ";
		$query .= " pool_organ = '$pool_organ', ";
		$query .= " pool_select_organ = '$pool_select_organ', ";
		$query .= " pool_grade = '$pool_grade', ";
		$query .= " pool_pass = '$pool_pass', ";
		$query .= " pool_tel = '$pool_tel', ";
		$query .= " pool_fax = '$pool_fax', ";
		$query .= " pool_hp = '$pool_hp', ";
		$query .= " pool_zip_code = '$pool_zip_code', ";
		$query .= " pool_address = '$pool_address', ";
		$query .= " pool_address_detail = '$pool_address_detail', ";
		$query .= " pool_email = '$pool_email', ";
		$query .= " pool_major = '$pool_major', ";
		$query .= " pool_career = '$pool_career', ";
		//업로드 된 파일이 있을 경우
		if($pool_file_flag[0] == "Y"){
			$query .= " pool_image = '".$pool_file_name_arr[0].$pool_file_extension_arr[0]."', ";
		}
		if($pool_file_flag[1] == "Y"){
			$query .= " pool_resume = '".$pool_file_name_arr[1].$pool_file_extension_arr[1]."', ";
		}
		if($pool_file_flag[2] == "Y"){
			$query .= " pool_idcard_forward = '".$pool_file_name_arr[2].$pool_file_extension_arr[2]."', ";
		}
		if($pool_file_flag[3] == "Y"){
			$query .= " pool_idcard_backward = '".$pool_file_name_arr[3].$pool_file_extension_arr[3]."', ";
		}
		if($pool_file_flag[4] == "Y"){
			$query .= " pool_bankbook = '".$pool_file_name_arr[4].$pool_file_extension_arr[4]."', ";
		}
		$query .= " pool_approve_flag = '$pool_approve_flag' ";
		$query .= " Where pool_idx = '".$pool_idx."' ";

		$mysql->ParseExec($query);

		message_url("수정이 완료되었습니다.", $pageUrl."&page=/pages/admin/pool/pool.php" );

	}else if($mode == "delete"){

		if($pool_idx == "") message_url("오류가 발생하였습니다.\\n\\n 관리자에게 문의하여 주시기 바랍니다.", $pageUrl."&page=/pages/admin/pool/pool.php");

		$query  = " DELETE FROM t_pool ";
		$query .= " WHERE pool_idx = '".$pool_idx."' ";

		$mysql->ParseExec($query);

		message_url("성공적으로 삭제되었습니다.", $pageUrl."&page=/pages/admin/pool/pool.php" );
	}

	$mysql->Disconnect();
?>