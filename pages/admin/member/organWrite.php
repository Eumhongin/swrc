<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");
	include ("../../query/organ/organQuery.php");

	$pageUrl .= $pageName;

	$newOrder = getNewMenuIdx($organ_code);
	if($newOrder == "") $newOrder = 1;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$path = "../../up_file/organ/";
	$pathMobile = "../../mobile/images/org/";

	//금지단어 설정
	//추가 설정 할 것이 있을 경우 배열로 추가 해야함.
	$temp_nofile[0] = "php";

	$image_file_flag = "N";

	//기본으로 fimename 를 "" 으로 설정한다.
	$image_file_name = "";

	if($mode == "write" ){		
				
		if($image_name_size > 0){

			$tempfilename    = str_replace("\'","",$image_name_name);
			$filename        = ereg_replace("(\.[^\.]*$)","",$tempfilename);
			$filesize        = $image_name_size;
			$extension       = str_replace($filename,"",$tempfilename);
			$target			 = $path.$tempfilename;
			$targetMobile	 = $pathMobile.$tempfilename;
			$strfilename	 = $filename.$extension;

			if($filesize > 10 * 1048576) {
				message_url("파일크기가 10MByte 이하여야 합니다.", $pageUrl."&page=/pages/admin/member/organ.php&sel_organ_code=".$organ_code );
			}



			for($i = 0; $i <= count($temp_nofile); $i++){
				for ($i = 0 ; $i <=count($temp_nofile); $i++) {
					if(strtolower($extension) == ".".strtolower($temp_nofile[$i])) 
						message_url($temp_nofile[$i]."파일은 첨부할 수 없습니다.", $pageUrl."&page=/pages/admin/member/organ.php&sel_organ_code=".$organ_code );
				}
			}

			for($k = 1; file_exists($target); $k++){
				$target = $path.$filename."_".$k.$extension;
				$strfilename = $filename."_".$k.$extension;
			}

			for($k = 1; file_exists($targetMobile); $k++){
				$targetMobile = $pathMobile.$filename."_".$k.$extension;
				$strfilename = $filename."_".$k.$extension;
			}

			copy($image_name, $target);
			copy($image_name, $targetMobile);

			//filename 과 flag 를 배열에 담는다.
			$image_file_name = $filename;
			$image_file_extension = $extension;
			$image_file_flag = "Y";

			$image_file_name = $image_file_name.$image_file_extension;
		}

		$query  = " INSERT INTO t_organ ( ";
		if($image_file_flag == "Y"){
		$query .= "		image_name, ";
		}
		$query .= "		name, ";
		$query .= "		grade, ";
		$query .= "		tel, ";
		$query .= "		email, ";
		$query .= "		organ_order, ";
		$query .= "		organ_code ";
		$query .= "		) VALUES ( ";
		if($image_file_flag == "Y"){
		$query .= "		'$image_file_name', ";
		}
		$query .= "		'$name', ";
		$query .= "		'$grade', ";
		$query .= "		'$tel', ";
		$query .= "		'$email', ";
		$query .= "		'$newOrder', ";
		$query .= "		'$organ_code' ";
		$query .= " ) ";

		$mysql->ParseExec($query);

		message_url("등록이 완료되었습니다.", $pageUrl."&page=/pages/admin/member/organ.php&sel_organ_code=".$organ_code );

	}elseif($mode == "edit"){

		if($idx == "") message_url("오류가 발생하였습니다.\\n\\n 관리자에게 문의하여 주시기 바랍니다.", $pageUrl."&page=/pages/admin/member/organ.php&sel_organ_code=".$organ_code);

			
		if($image_name_size > 0){

			$tempfilename    = str_replace("\'","",$image_name_name);
			$filename        = ereg_replace("(\.[^\.]*$)","",$tempfilename);
			$filesize        = $image_name_size;
			$extension       = str_replace($filename,"",$tempfilename);
			$target			 = $path.$tempfilename;
			$targetMobile	 = $pathMobile.$tempfilename;
			$strfilename	 = $filename.$extension;

			if($filesize > 10 * 1048576) {
				message_url("파일크기가 10MByte 이하여야 합니다.", $pageUrl."&page=/pages/admin/member/organ.php&sel_organ_code=".$organ_code );
			}



			for($i = 0; $i <= count($temp_nofile); $i++){
				for ($i = 0 ; $i <=count($temp_nofile); $i++) {
					if(strtolower($extension) == ".".strtolower($temp_nofile[$i])) 
						message_url($temp_nofile[$i]."파일은 첨부할 수 없습니다.", $pageUrl."&page=/pages/admin/member/organ.php&sel_organ_code=".$organ_code );
				}
			}

			for($k = 1; file_exists($target); $k++){
				$target = $path.$filename."_".$k.$extension;
				$strfilename = $filename."_".$k.$extension;
			}

			for($k = 1; file_exists($targetMobile); $k++){
				$targetMobile = $pathMobile.$filename."_".$k.$extension;
				$strfilename = $filename."_".$k.$extension;
			}

			copy($image_name, $target);
			copy($image_name, $targetMobile);

			//filename 과 flag 를 배열에 담는다.
			$image_file_name = $filename;
			$image_file_extension = $extension;
			$image_file_flag = "Y";

			$image_file_name = $image_file_name.$image_file_extension;
			
		}

		$query  = " UPDATE t_organ SET ";
		
		if($image_file_flag == "Y"){
		$query .= "	image_name = '$image_file_name', ";
		}


		$query .= " name = '$name', ";
		$query .= " grade = '$grade', ";
		$query .= " tel = '$tel', ";
		$query .= " email = '$email', ";
		$query .= " organ_code = '$organ_code' ";
		$query .= " Where idx = '".$idx."' ";

		$mysql->ParseExec($query);

		message_url("수정이 완료되었습니다.", $pageUrl."&page=/pages/admin/member/organWriteForm.php&idx=".$idx."&mode=edit&sel_organ_code=".$organ_code );

	}else if($mode == "delete"){

		if($idx == "") message_url("오류가 발생하였습니다.\\n\\n 관리자에게 문의하여 주시기 바랍니다.", $pageUrl."&page=/pages/admin/member/organ.php&sel_organ_code=".$organ_code);

		$query  = " DELETE FROM t_organ ";
		$query .= " WHERE idx = '".$idx."' ";

		$mysql->ParseExec($query);

		message_url("성공적으로 삭제되었습니다.", $pageUrl."&page=/pages/admin/member/organ.php&sel_organ_code=".$organ_code );
	}

	$mysql->Disconnect();
?>