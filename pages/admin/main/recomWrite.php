<?
	include ("../../config/mysql.inc.php");
	include ("../../config/comm.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();

	//$path = "../../main/data/";
	$path = $_SERVER['DOCUMENT_ROOT']."/pages/main/data/";

	$recom_img_title = $_REQUEST["recom_img_title"];
	$recom_img_explain = $_REQUEST["recom_img_explain"];
	$recom_url = $_REQUEST["recom_url"];
	$recom_chk = $_REQUEST["recom_chk"];
	$mode = $_REQUEST["mode"];

	$recom_filename = $_FILES['recom_img_name']['tmp_name'];
	$recom_file_name = $_FILES['recom_img_name']['name'];			
	$recom_file_size = $_FILES['recom_img_name']['size'];

/*
echo "ecom_img_explain = $recom_img_explain <br>";
echo "recom_url = $recom_url <br>";
echo "recom_chk = $recom_chk <br>";
echo "mode = $mode <br>";
echo "recom_filename = $recom_filename <br>";
echo "recom_file_name = $recom_file_name <br>";
echo "recom_file_size = $recom_file_size <br>";
*/


	if($mode == "write" ){
	
			
		if($recom_file_size > 0){
			$tempfilename    = str_replace("\'","",$recom_file_name);
			$filename        = ereg_replace("(\.[^\.]*$)","",$tempfilename);
			$filesize        = $recom_file_size;
			$extension       = str_replace($filename,"",$tempfilename);
			$target			 = $path.$tempfilename;
			$strfilename	 = $filename.$extension;

			if($filesize > 10 * 1048576) {
				message_url("파일크기가 10MByte 이하여야 합니다.", $pageUrl."&page=/pages/admin/main/main.php" );
			}
			
			for($k = 1; file_exists($target); $k++){
				$target = $path.$filename."_".$k.$extension;
				$strfilename = $filename."_".$k.$extension;
			}


			copy($recom_filename, $target);
		}

		$query  = " INSERT INTO recom_img ( ";
		$query .= "		recom_url, ";
		$query .= "		recom_img_title, ";
		$query .= "		recom_img_name, ";
		$query .= "		recom_chk, ";
		$query .= "		recom_img_explain, ";
		$query .= "		regdate ";
		$query .= "		) VALUES ( ";
		$query .= "		'$recom_url', ";
		$query .= "		'$recom_img_title', ";
		$query .= "		'$strfilename', ";
		$query .= "		'$recom_chk', ";
		$query .= "		'$recom_img_explain', ";
		$query .= "		now() ";
		$query .= " ) ";

		$mysql->ParseExec($query);

		message_url("등록 완료되었습니다.", $pageUrl."&page=/pages/admin/main/main.php" );

	}elseif($mode == "edit"){

		
		if($recom_file_size > 0){

			$tempfilename    = str_replace("\'","",$recom_file_name);
			$filename        = ereg_replace("(\.[^\.]*$)","",$tempfilename);
			$filesize        = $recom_file_size;
			$extension       = str_replace($filename,"",$tempfilename);
			$target			 = $path.$tempfilename;
			$strfilename	 = $filename.$extension;

			if($filesize > 10 * 1048576) {
				message_url("파일크기가 10MByte 이하여야 합니다.", $pageUrl."&page=/pages/admin/main/main.php" );
			}

			for($k = 1; file_exists($target); $k++){
				$target = $path.$filename."_".$k.$extension;
				$strfilename = $filename."_".$k.$extension;
			}

			copy($recom_filename, $target);
		}

		$query  = " UPDATE recom_img SET ";
		$query .= " recom_url = '$recom_url', ";
		if($recom_file_size > 0){
			$query .= " recom_img_name = '$strfilename', ";
		}
		$query .= " recom_img_title = '$recom_img_title', ";
		$query .= " recom_img_explain = '$recom_img_explain', ";
		$query .= " regdate = now() ";
		$query .= " Where recom_chk = '".$recom_chk."' ";



		$mysql->ParseExec($query);


		message_url("수정이 완료되었습니다.", $pageUrl."&page=/pages/admin/main/main.php" );

	}else if($mode == "delete"){

		if($pool_idx == "") message_url("오류가 발생하였습니다.\\n\\n 관리자에게 문의하여 주시기 바랍니다.", $pageUrl."&page=/pages/admin/pool/pool.php");

		$query  = " DELETE FROM t_pool ";
		$query .= " WHERE pool_idx = '".$pool_idx."' ";

		$mysql->ParseExec($query);

		message_url("성공적으로 삭제되었습니다.", $pageUrl."&page=/pages/admin/pool/pool.php" );
	}

	$mysql->Disconnect();
?>