<?
	
  session_cache_limiter('private');
	session_start();

	include("../../config/mysql.inc.php");  
    include("../../config/comm.inc.php");  

	$mysql = new Mysql_DB;
	$mysql->Connect();
	
	$mode = $_REQUEST["mode"];
	$a_idx = $_REQUEST["a_idx"];
	$search = $_REQUEST["search"];
	$keyword = $_REQUEST["keyword"];
	$pageIdx = $_REQUEST["pageIdx"];
	$a_language = $_REQUEST["a_language"];
	$a_type = $_REQUEST["a_type"];
	$a_admin_check = $_REQUEST["a_admin_check"];
	$a_bbsname = euckrToUtf8($_REQUEST["a_bbsname"]);
	$a_tablename = $_REQUEST["a_tablename"];
	$a_category = $_REQUEST["a_category"];
	$a_reply = $_REQUEST["a_reply"];
	$a_reply_type = $_REQUEST["a_reply_type"];
	$a_email = $_REQUEST["a_email"];
	$a_homepage = $_REQUEST["a_homepage"];
	$a_phone = $_REQUEST["a_phone"];
	$a_html = $_REQUEST["a_html"];
	$a_new = $_REQUEST["a_new"];
	$a_move = $_REQUEST["a_move"];
	$a_excel = $_REQUEST["a_excel"];
	$a_upload = $_REQUEST["a_upload"];
	$a_upload_len = $_REQUEST["a_upload_len"];
	$a_nofilesize = $_REQUEST["a_nofilesize"];
	$a_nofile = $_REQUEST["a_nofile"];
	$a_command = $_REQUEST["a_command"];
	$a_noword = euckrToUtf8($_REQUEST["a_noword"]);
	$a_displaysu = $_REQUEST["a_displaysu"];
	$a_pagesu = $_REQUEST["a_pagesu"];
	$a_orderby = $_REQUEST["a_orderby"];
	$a_orderby_type = $_REQUEST["a_orderby_type"];
	$a_title_len = $_REQUEST["a_title_len"];
	$a_view = $_REQUEST["a_view"];
	$a_photo = $_REQUEST["a_photo"];
	$a_photo_width = $_REQUEST["a_photo_width"];
	$a_photo_height = $_REQUEST["a_photo_height"];
	$a_photo_cols = $_REQUEST["a_photo_cols"];
	$a_photo_rows = $_REQUEST["a_photo_rows"];

  //언어별 폴더
  $path  = file_path();
  if($a_language == 1) {
  	#$nowfolder   = $path."/korean/bbs/data";      // 한글
	$nowfolder   = $path."\pages\bbs\data";      // 한글
  } elseif($a_language == 2) {
    $nowfolder   = $path."/english/bbs/data";     // 영어
  } elseif($a_language == 3) {
    $nowfolder   = $path."/japanese/bbs/data";   // 일어
  } elseif($a_language == 4) {
    $nowfolder   = $path."/chinese/bbs/data";     // 중국어
  }
	
  exec("chmod 0777 $nowfolder");

  //**  입력 ***
	if ($mode == "write" or $mode == "") {
		
		$a_type      = input_value("게시판종류", $a_type, 0);
		$a_bbsname   = input_value("게시판 이름", $a_bbsname, 0); 
		$a_tablename = input_value("테이블 이름", $a_tablename, 0); 

		// ** bbs_admin 테이블에 같은 이름이 존재하는지 확인
		$qry = "Select * From bbs_admin Where a_tablename='$a_tablename'";
		$mysql->ParseExec($qry);
		if ($mysql->RowCount()) {

					message("게시판이 이미 존재합니다.");
		}
		else {

			// ** DB 안에 같은 테이블이 존재하는지 확인
			$tqry = "show tables";
			$mysql->ParseExec($tqry);

			while($mysql->FetchInto(&$col)) {  
		
				if (($col[Tables_in_daegu] == trim($a_tablename)) or ($col[Tables_in_daegu] == trim($a_tablename."_file"))) { 
						message("게시판이 이미 존재합니다.");
						exit;
				}	

			}

			$a_idx = "I_".date("ymdHis"); // pk I_년월일시분초
			
			if($a_upload == "Y") {
				//$a_tablename 폴더 생성
				if(!(is_dir("$nowfolder/$a_idx")))	{ 
						$Result = mkdir("$nowfolder/$a_idx", 0700);
						//if(!$Result) message("폴더 생성에 실패했습니다");
						echo "<br> $nowfolder/$a_idx <br>";
				} 
			}

			//$a_tablename 테이블 생성
			$cqry = "Create table $a_tablename (";
		    $cqry = $cqry. "       b_num int not null auto_increment,";
			$cqry = $cqry."        a_num int not null ,";
			$cqry = $cqry."        b_top char(1) not null ,";
			$cqry = $cqry."        b_id varchar(30) null ,";
			$cqry = $cqry."        b_category int,";
			$cqry = $cqry."        b_date varchar(10) default NULL,";
			$cqry = $cqry."        b_writer varchar(40)  not null ,";
			$cqry = $cqry."        b_pass varchar(20)  null ,";
			$cqry = $cqry."        b_email varchar(80) null ,";
			$cqry = $cqry."        b_jumin varchar(14) null ,";
			$cqry = $cqry."        b_phone varchar(20) null ,";
			$cqry = $cqry."        b_home varchar(100) null ,";
			$cqry = $cqry."        b_subject varchar(100)  not null ,";
			$cqry = $cqry."        b_html varchar(1) not null,";
			$cqry = $cqry."        b_content text  not null ,";
			$cqry = $cqry."        b_regdate datetime not null,";
			$cqry = $cqry."        b_count int not null,";
			$cqry = $cqry."        b_ip varchar(15) not null,";
			$cqry = $cqry."        b_ref int null,";
			$cqry = $cqry."        b_step int null ,";
			$cqry = $cqry."        b_level int null ,";
			$cqry = $cqry."        b_look varchar(1) null,";
			$cqry = $cqry."        b_open varchar(1) null,";
			$cqry = $cqry."        b_file varchar(1) null,";
			$cqry = $cqry."        b_movetablename varchar(80) null,";
			$cqry = $cqry."		   b_admin_check char(1) null,	";
			$cqry = $cqry."        primary key(b_num) )";
			$mysql->ParseExec($cqry); 

			//DB에 저장

			$qry = "Insert Into bbs_admin";
			$qry = $qry. "  (a_idx,a_language,a_type,a_bbsname, a_tablename, a_category, a_email, a_homepage, a_jumin, a_phone, a_html,";
			$qry = $qry. "   a_upload, a_upload_len, a_nofilesize, a_nofile, a_command, a_ip, a_new, a_move, a_excel,a_noword,";
			$qry = $qry. "   a_opener, a_reply, a_reply_type ,a_skin, a_width, a_align, a_title_bgcolor, a_title_border, a_font_color,";
			$qry = $qry. "   a_mouseover_color,a_displaysu, a_pagesu, a_orderby, a_orderby_type, a_title_len, a_include_header,a_header,";
			$qry = $qry. "   a_detail, a_view, a_photo, a_photo_width, a_photo_height, a_photo_cols, a_photo_rows,";
			$qry = $qry. "   a_include_top, a_include_left, a_include_right, a_include_bottom)";

			$qry = $qry. " Values('$a_idx','$a_language','$a_type','$a_bbsname','$a_tablename','$a_category','$a_email','$a_homepage','$a_jumin',";
			$qry = $qry. " '$a_phone', '$a_html','$a_upload', '$a_upload_len', '$a_nofilesize','$a_nofile', '$a_command', '$a_ip', "; 
			$qry = $qry. " '$a_new','$a_move','$a_excel', '$a_noword', '$a_opener', '$a_reply','$a_reply_type','$a_skin', ";
			$qry = $qry. " '$a_width', '$a_align', '$a_title_bgcolor', '$a_title_border', '$a_font_color','$a_mouseover_color',";
			$qry = $qry. " '$a_displaysu','$a_pagesu', '$a_orderby', '$a_orderby_type', '$a_title_len','$a_include_header','$a_header',";
			$qry = $qry. " '$a_detail', '$a_view', '$a_photo','$a_photo_width','$a_photo_height', '$a_photo_cols', '$a_photo_rows',";
			$qry = $qry. " '$a_include_top','$a_include_left','$a_include_right','$a_include_bottom')";
			$mysql->ParseExec($qry); 
	

	  }
	
	}
	//**  수정 ***
	elseif ($mode == "modify" or $a_num <> "") {

		$a_type      = input_value("게시판종류", $a_type, 0);
		$a_bbsname   = input_value("게시판 이름", $a_bbsname, 0); 
		$a_tablename = input_value("테이블 이름", $a_tablename, 0); 

		if($a_displaysu < 1)      $a_displaysu = 10;
		if($a_pagesu < 1)         $a_pagesu = 10;
		if($a_photo_width < 1)    $a_photo_width=  100;
		if($a_photo_height < 1)   $a_photo_height=  100;
		if($a_photo_cols  < 1)    $a_photo_cols=  4;
		if($a_photo_rows < 1)     $a_photo_rows =  3;
		
		if($a_upload == "Y") {
			//$a_tablename 폴더 생성
			if(!(is_dir("$nowfolder/$a_idx")))	{ 	
					$Result = mkdir("$nowfolder/$a_idx", 0700);
					//if(!$Result) message($nowfolder."폴더 생성에 실패했습니다");
			} 
		}	   

		$qry = "Update bbs_admin Set a_language='$a_language',a_type='$a_type',a_bbsname='$a_bbsname', a_tablename='$a_tablename', ";
		$qry = $qry. "            a_category='$a_category', a_email='$a_email', a_homepage='$a_homepage',";
		$qry = $qry. "            a_jumin='$a_jumin', a_phone='$a_phone', a_html='$a_html',a_upload='$a_upload',";
		$qry = $qry. "            a_upload_len='$a_upload_len', a_nofilesize='$a_nofilesize', a_nofile='$a_nofile',";
		$qry = $qry. "            a_command='$a_command', a_ip='$a_ip', a_new='$a_new', a_move='$a_move',";
		$qry = $qry. "            a_excel='$a_excel',a_noword='$a_noword',";
		$qry = $qry. "            a_opener='$a_opener',a_reply='$a_reply',a_reply_type='$a_reply_type',";
		
		$qry = $qry. "			  a_admin_check = '$a_admin_check', ";

		//$qry = $qry. "            a_skin='$a_skin', a_width='$a_width', a_align='$a_align',a_title_bgcolor='$a_title_bgcolor',";
		//$qry = $qry. "            a_title_border='$a_title_border', a_font_color='$a_font_color',";
		//$qry = $qry. "            a_mouseover_color='$a_mouseover_color',a_displaysu='$a_displaysu',a_pagesu='$a_pagesu',";
		$qry = $qry. " a_displaysu='$a_displaysu',a_pagesu='$a_pagesu',";
		$qry = $qry. "            a_orderby='$a_orderby',a_orderby_type='$a_orderby_type', a_title_len='$a_title_len',";
		//$qry = $qry. "            a_include_header='$a_include_header',a_header='$a_header', a_detail='$a_detail', a_view='$a_view',";
		$qry = $qry. "            a_view='$a_view',";
		$qry = $qry. "            a_photo='$a_photo', a_photo_width='$a_photo_width', a_photo_height='$a_photo_height',"; 
		$qry = $qry. "            a_photo_cols='$a_photo_cols',a_photo_rows=' $a_photo_rows'"; 
		//$qry = $qry. "            a_include_top='$a_include_top',a_include_left='$a_include_left',"; 
		//$qry = $qry. "            a_include_right='$a_include_right',a_include_bottom='$a_include_bottom'"; 
		$qry = $qry. "  Where a_idx = '$a_idx'"; 

		$mysql->ParseExec($qry); 
		movepage($pageUrl.$pageName."&page=/pages/admin/bbs/bbs_admin.php&search=$search&keyword=$keyword&pageIdx=$pageIdx");
	}

	//**  삭제 ***
	elseif ($mode == "delete" or $a_num <> "") {
	
		// ** bbs_admin 테이블에 같은 이름이 존재하는지 확인
		$qry = "Select * From bbs_admin Where a_idx = '$a_idx'"; 
		$mysql->ParseExec($qry);
		$mysql->FetchInto(&$col);
		
		//chmod($nowfolder, 0700);

		exec("rm -rf $nowfolder/$col[a_tablename]");
			
		//첨부파일 테이블 삭제
		$qry = "delete from bbs_file where f_tablename='$col[a_tablename]'"; 
		$mysql->ParseExec($qry);

		//관련된 꼬리글 삭제
		$qry = "delete from comment where c_tablename = '$col[a_tablename]'"; 
		$mysql->ParseExec($qry);

		//게시판 테이블 삭제
		$qry = "drop table $col[a_tablename]"; 
		$mysql->ParseExec($qry);

		//게시판 환경 설정 삭제
		$qry = "delete from bbs_admin where a_tablename = '$col[a_tablename]'"; 
		$mysql->ParseExec($qry);
		
		//게시판 카테고리 삭제
		$qry  = "delete from bbs_admin_cate where c_tablename='$col[a_tablename]'";
		$mysql->ParseExec($qry); 
		
		//관련된 권한 삭제
		$qry = "delete From m_menu where m_menutable='$col[a_tablename]'";
		$mysql->ParseExec($qry);

		//chmod($nowfolder, 0000);
 
		
	}

  //exec("chmod 0000 $nowfolder");

  movepage($pageUrl.$pageName."&page=/pages/admin/bbs/bbs_admin.php");
?>

