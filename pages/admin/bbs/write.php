<?

	include("../../config/bbs_lib.inc.php");  
	include "../../pages/bbs/decode.php"; // ���ڵ� ó�� ��ü ���� ������ ��Ŭ���
	include("../../config/mysql.inc.php");
	include("../../config/request.inc.php");
	include("../../config/comm.inc.php"); 

	$pageUrl .= $pageName;

	$temp = parameterCheck($_REQUEST["temp"]);
	$a_idx = parameterCheck($_REQUEST["a_idx"]);
	$mode = parameterCheck($_REQUEST["mode"]);
	$b_num = parameterCheck($_REQUEST["b_num"]);
	$b_ref = parameterCheck($_REQUEST["b_ref"]);
	$b_step = parameterCheck($_REQUEST["b_step"]);
	$b_level = parameterCheck($_REQUEST["b_level"]);
	$category = parameterCheck($_REQUEST["category"]);
	$search = parameterCheck($_REQUEST["search"]);
	$keyword = parameterCheck($_REQUEST["keyword"]);
	$pageIdx = parameterCheck($_REQUEST["pageIdx"]);
	$mime_contents = parameterCheck($_REQUEST["mime_contents"]);
	$contents = euckrToUtf8(parameterCheck($_REQUEST["contents"]));
	$b_category = parameterCheck($_REQUEST["b_category"]);
	$b_subject = euckrToUtf8(parameterCheck($_REQUEST["b_subject"]));
	$b_top = parameterCheck($_REQUEST["b_top"]);
	$b_writer = euckrToUtf8(parameterCheck($_REQUEST["b_writer"]));
	$b_pass = parameterCheck($_REQUEST["b_pass"]);
	$b_jumin1 = parameterCheck($_REQUEST["b_jumin1"]);
	$b_jumin2 = parameterCheck($_REQUEST["b_jumin2"]);
	$b_phone1 = parameterCheck($_REQUEST["b_phone1"]);
	$b_phone2 = parameterCheck($_REQUEST["b_phone2"]);
	$b_phone3 = parameterCheck($_REQUEST["b_phone3"]);
	$b_email = euckrToUtf8(parameterCheck($_REQUEST["b_email"]));
	$b_home = parameterCheck($_REQUEST["b_home"]);
	$b_content = euckrToUtf8(parameterCheck($_REQUEST["b_content"]));
	$b_html = parameterCheck($_REQUEST["b_html"]);
	$b_open = parameterCheck($_REQUEST["b_open"]);
	$open_pass = parameterCheck($_REQUEST["open_pass"]);
	$cm_pass = parameterCheck($_REQUEST["cm_pass"]);
	$cm_feel = parameterCheck($_REQUEST["cm_feel"]);
	$mnu_name = euckrToUtf8(parameterCheck($_REQUEST["mnu_name"]));
	$cm_num = parameterCheck($_REQUEST["cm_num"]);
	$cm_content = euckrToUtf8(parameterCheck($_REQUEST["cm_content"]));

	$a_upload = parameterCheck($_REQUEST["a_upload"]);
	$a_upload_len = parameterCheck($_REQUEST["a_upload_len"]);

	$b_filename = array();
	$b_file_name = array();
	$b_file_size = array();
	$del_filename = array();

	if($a_upload == "Y"){
		$b_filename[0] = euckrToUtf8($_FILES['b_filename0']['tmp_name']);
		$b_filename[1] = euckrToUtf8($_FILES['b_filename1']['tmp_name']);
		$b_filename[2] = euckrToUtf8($_FILES['b_filename2']['tmp_name']);
		$b_filename[3] = euckrToUtf8($_FILES['b_filename3']['tmp_name']);
		$b_filename[4] = euckrToUtf8($_FILES['b_filename4']['tmp_name']);
		$b_file_name[0] = euckrToUtf8($_FILES['b_filename0']['name']);
		$b_file_name[1] = euckrToUtf8($_FILES['b_filename1']['name']);
		$b_file_name[2] = euckrToUtf8($_FILES['b_filename2']['name']);
		$b_file_name[3] = euckrToUtf8($_FILES['b_filename3']['name']);
		$b_file_name[4] = euckrToUtf8($_FILES['b_filename4']['name']);				
		$b_file_size[0] = $_FILES['b_filename0']['size'];
		$b_file_size[1] = $_FILES['b_filename1']['size'];
		$b_file_size[2] = $_FILES['b_filename2']['size'];
		$b_file_size[3] = $_FILES['b_filename3']['size'];
		$b_file_size[4] = $_FILES['b_filename4']['size'];
		$del_filename[0] = euckrToUtf8($_REQUEST['del_filename0']);
		$del_filename[1] = euckrToUtf8($_REQUEST['del_filename1']);
		$del_filename[2] = euckrToUtf8($_REQUEST['del_filename2']);
		$del_filename[3] = euckrToUtf8($_REQUEST['del_filename3']);
		$del_filename[4] = euckrToUtf8($_REQUEST['del_filename4']);
	}

	$mysql = new Mysql_DB;
	$mysql->Connect();
// *** �Խ��� ȯ�� ***
	Bbs_Config($a_idx);

// *** ����, �亯, ���� ���� üũ ***
	// *** ���� ����
	if(($mode == "" or $mode == "write") and !($m_write == "Y" or $adminstrator == true)) {
		 message("���� ������ �����ϴ�");
	}	

	// *** �亯 ����
	if($mode == "reply" and !($m_reply == "Y" or $adminstrator == true)) {
		 message("�亯 ������ �����ϴ�");
	}	

	// *** ���� ���� ***
	if ($mode == "delete" and !($m_del == "Y" or $adminstrator == true)) {
		message("���� ������ �����ϴ�");
	
	}
	
	//html ��� üũ���� ������ 0 ���� �ִ´�.
	if($b_html == "") $b_html = "0";
	//����� üũ���� ������ 0 ���� �ִ´�.
	if($b_open == "") $b_open = "0";

#$b_content    = $content;
// *** �Է�/���� �� �Ѿ���� �� üũ, �����ܾ� üũ ***
// $mode == "" : ���۾���, $mode == "modify" : ����,  $mode == "reply" : �亯 
	if($mode == "reply" or $mode == "" or $mode == "modify") {

	
			$b_date       = $b_year.$b_month;
      //��ȸ���ϰ�츸
			if($HTTP_SESSION_VARS[duid] == "") {
				$b_writer   = input_value("�̸�", $b_writer, 0);
				if($a_idx <> "I_040204202620")  { 
        $b_pass     = input_value("��й�ȣ", $b_pass, 0);
        }
			} else {
        
        $b_id       = $HTTP_SESSION_VARS[duid];
        $b_writer   = euckrToUtf8($HTTP_SESSION_VARS[duname]);
      }
			
			$b_jumin      = $b_jumin1 . "-" .$b_jumin2;
			$b_phone      = $b_phone1 . "-" .$b_phone2. "-" .$b_phone3;
			$b_subject    = input_value("����", $b_subject, 0); 
			
			if( $b_top  == "on") {
					$b_top    = "Y";
			} else {
					$b_top    = "N";
			}
      
      if( $b_seminar  == "on") {
					$b_seminar    = "Y";
			} else {
					$b_seminar    = "N";
			}
			
			
			$b_content    = input_value("����", $b_content, 0); 
			$temp_noword  = Split(",", $a_noword); //�����ܾ�

			if(count($temp_noword) > 1) {
				for ($i = 0 ; $i <=count($temp_noword); $i++) {
		
						$s_noword = strstr($b_subject,$temp_noword[$i]);
						$c_noword = strstr($b_content,$temp_noword[$i]);
						
						if($s_noword <> "" or $c_noword <> "")  
							message($temp_noword[$i-1]." ��(��) �������ܾ��Դϴ�.");
						

				}
			}
			
			if($a_photo == "N") {
					$b_content = $b_content;#VBN_uploadMultiFiles($b_content);  
			}
			$b_ip          = $REMOTE_ADDR;  
	}


// ******************************* ���� ��� ****************************************************************
// ���� ���
	$path =  "../../pages/bbs/data/$a_idx/";
	//$path =  "C:/APM_Setup/htdocs/newworld/pages/bbs/data/$a_idx/";

// ******************************* �۾���(DB�� ����)**********************************************************
// $mode == "" : ���۾���, $mode == "reply" : �亯 
	if($mode == "reply" or $mode == "") {
	
	//$b_content = addslashes($b_content);
	

			//���� ũ��, Ȯ���� üũ
			$b_file = "N";
			//exec("chmod 0700 $path");
			//chmod($path, 0700);

			
			for($f = 0; $f < $a_upload_len ; $f++) {

				if($b_file_size[$f] > 0)  {
				 			
					$tempfilename    = str_replace("\'","",$b_file_name[$f]);
					$filename        = ereg_replace("(\.[^\.]*$)","",$tempfilename);
					$filesize        = $b_file_size[$f];
					$extension       = str_replace($filename,"",$tempfilename);

					//���ε� ���� ũ�� ����  1MByte = 1048576Byte
					if($filesize > $a_nofilesize*1048576) {
						//message("����ũ�Ⱑ"& $a_nofilesize &"MByte ���Ͽ��� �մϴ�.");
						?>
						<script type="text/javascript">
							alert("����ũ�Ⱑ"+<?=$a_nofilesize?>+"MByte ���Ͽ��� �մϴ�.");
							history.back(-1);
						</script>
						<?
					}
					//���� Ȯ���� ����
					if(trim($a_nofile) <> "") {

						$temp_nofile  = Split(",", $a_nofile); //�����ܾ�

						for ($i = 0 ; $i <=count($temp_nofile); $i++) {
							if(strtolower($extension) == ".".strtolower($temp_nofile[$i]))  
								message($temp_nofile[$i]." ������ ÷���� �� �����ϴ�.");
						}
					}

					$b_file = "Y";
				}
			}

			if ($b_num == "") {
					$b_ref   = 0 ;
					$b_step  = 0 ;
					$b_level = 0 ;
			} else {
					$qry = "update $a_tablename set b_step = b_step+1 where b_ref = $b_ref and b_step > $b_step";
					$mysql->ParseExec($qry);      
							
					$b_step  = $b_step + 1 ;
					$b_level = $b_level + 1 ;

			}


			// *** �����̸� ****
			if($a_num == "" ) $a_num = 0;
      $qry  = "insert into $a_tablename ( ";
      $qry .= "            a_num,  ";
      $qry .= "            b_top,  ";
      $qry .= "            b_id, ";
      $qry .= "            b_category, ";
      $qry .= "            b_date, ";
      $qry .= "            b_writer, ";
      $qry .= "            b_pass, ";
      $qry .= "            b_email, ";
      $qry .= "            b_jumin, ";
      $qry .= "            b_phone, ";
      $qry .= "            b_home, ";
      $qry .= "            b_subject, ";
      $qry .= "            b_html, ";
      $qry .= "            b_content, ";
      $qry .= "            b_regdate, ";
      $qry .= "            b_count, ";
      $qry .= "            b_ip, ";
      $qry .= "            b_ref, ";
      $qry .= "            b_step, ";
      $qry .= "            b_level, ";
      $qry .= "            b_look, ";
      $qry .= "            b_open, ";
      $qry .= "            b_file ";
      $qry .= "  ) values ( ";
      $qry .= "           '$a_num',  ";
      $qry .= "           '$b_top', ";
      $qry .= "           '$b_id', ";
      $qry .= "           '$b_category', ";
      $qry .= "           '$b_date', ";
      $qry .= "           '$b_writer', ";
      $qry .= "           '$b_pass', ";
      $qry .= "           '$b_email', ";
      $qry .= "           '$b_jumin', ";
      $qry .= "           '$b_phone', ";
      $qry .= "           '$b_home', ";
      $qry .= "           '$b_subject', ";
      $qry .= "           '$b_html', ";
      $qry .= "           '$b_content', ";
      $qry .= "            now(),  ";
      $qry .= "            0, ";
      $qry .= "            '$b_ip',  ";
      $qry .= "            $b_ref,  ";
      $qry .= "            $b_step, ";
      $qry .= "            $b_level, ";

	  //������ ���� ��� �϶� �����ڰ� �� �ۼ��ϸ� �ٷ� ����.
      if($a_admin_check == "Y"){ 
		  if($adminstrator == true){
				$qry .= " '0', ";
		  }else{
			  $qry .= " '1', ";
		  }
	  }else{
		  $qry .= "            '0', ";
	  }

      $qry .= "            '$b_open', ";
      $qry .= "            '$b_file' ";
      $qry .= "  ) ";

      $mysql->ParseExec($qry);    


			if ($b_num == "") {
					$qry  = "Select Max(b_num) as num From $a_tablename";
					$mysql->ParseExec($qry);  
					$mysql->FetchInto(&$row);
				
					$b_num = $row[num];

					$qry = "Update $a_tablename Set b_ref = $row[num] Where b_num = $b_num";
					$mysql->ParseExec($qry); 
		
			}

			for($f = 0; $f < $a_upload_len ; $f++) {

					if($b_file_size[$f] > 0)  {
										
						$tempfilename    = str_replace("\'","",$b_file_name[$f]);
						$filename        = ereg_replace("(\.[^\.]*$)","",$tempfilename);
						$filesize        = $b_file_size[$f];
						$extension       = str_replace($filename,"",$tempfilename);
						$target          = $path.$tempfilename;
						$strfilename     = $filename.$extension;

						for($k=1; file_exists($target);$k++) {
							$target = $path.$filename."_".$k.$extension;
							$strfilename = $filename."_".$k.$extension;
						}

						copy($b_filename[$f],$target);
						
						$filename = $strfilename;
					
						$fqry  = " Insert into bbs_file (f_tablename, f_num, f_filename, f_filesize, f_sort)";
						$fqry .= " Values('$a_tablename', $b_num,'$filename','$filesize', $f)";
						$mysql->ParseExec($fqry);
					}					
			}
			
			

      if($a_idx == "I_040204202620" and !($m_power == "2" or $adminstrator == true)) { 
        movepage($pageUrl."&page=/pages/admin/bbs/writeform.php&a_idx=$a_idx");
      } else {
        movepage($pageUrl."&page=/pages/admin/bbs/list.php&a_idx=$a_idx&category=$category");
      }
			
  } 
// ******************************* ���� ����(DB�� ����)**********************************************************
// $mode == "modify" : ���� 
	elseif($mode == "modify" and $b_num <> "") {
					
			$qry  = " Select b_num, b_pass, b_jumin from $a_tablename where b_num = '$b_num'";
      if(($m_power == "2" and $m_modify == "Y") or $adminstrator == true) {
      
      } elseif($HTTP_SESSION_VARS[duid] <> "") 	{
			  $qry .= " And b_id = '$HTTP_SESSION_VARS[duid]' ";
      } elseif($a_jumin == "Y") {
			  $qry .= " And b_jumin = '$b_jumin' ";
      } else {
        $qry .= " And b_pass = '$b_pass' ";
      }
      $mysql->ParseExec($qry);
      $mysql->FetchInto(&$col);

	//$b_content = addslashes($b_content);
	

      if(((($a_jumin == "Y" and $col[b_jumin] == $b_jumin) or  $a_jumin == "N") and ($HTTP_SESSION_VARS[duid] == "" and $col[b_pass] == $b_pass)) or ($HTTP_SESSION_VARS[duid] <> "" and $col[b_num])) {

        //exec("chmod 0700 $path");
				//chmod($path, 0700);
				
				for($f = 0; $f < $a_upload_len ; $f++) {
			
						if($b_file_size[$f] > 0)  {
			
							$tempfilename    = str_replace("\'","",$b_file_name[$f]);
							$filename        = ereg_replace("(\.[^\.]*$)","",$tempfilename);
							$filesize        = $b_file_size[$f];
							$extension       = str_replace($filename,"",$tempfilename);
							$target          = $path.$tempfilename;
							$strfilename     = $filename.$extension;

							//���ε� ���� ũ�� ����  1MByte = 1048576Byte
							if($filesize > $a_nofilesize*1048576) 
									message("����ũ�Ⱑ"& $a_nofilesize &"MByte ���Ͽ��� �մϴ�.");

							//���� Ȯ���� ����
							if(trim($a_nofile) <> "") {
						
								$temp_nofile  = Split(",", $a_nofile); //�����ܾ�

								for ($i = 0 ; $i <=count($temp_nofile); $i++) {
									if(strtolower($extension) == ".".strtolower($temp_nofile[$i]) )  
										message($temp_nofile[$i]." ������ ÷���� �� �����ϴ�.");
								}
									
							}
							//���� ���� ����
							$fqry = "Select f_filename From bbs_file Where f_tablename='$a_tablename' and f_num = $b_num and f_sort = '$f'";
							$mysql->ParseExec($fqry);
							$mysql->FetchInto(&$file);

							if ($file[f_filename] <> "") {

									@unlink($path.$file[f_filename]);
									$dqry  = " Delete From bbs_file Where f_tablename='$a_tablename' and f_num = $b_num and f_sort = $f";
									$mysql->ParseExec($dqry);
							
							}

							//�ߺ� �̸� üũ
              for($k=1; file_exists($target);$k++) {
								$target = $path.$filename."_".$k.$extension;
								$strfilename = $filename."_".$k.$extension;
							}

							//÷������ ���ε�
              copy($b_filename[$f],$target);
							$filename = $strfilename;

							$fqry  = " Insert into bbs_file (f_tablename, f_num, f_filename, f_filesize, f_sort)";
							$fqry .= " Values('$a_tablename', $b_num,'$filename','$filesize', $f)";
							$mysql->ParseExec($fqry);
			
						}
			
				}

				for($f = 0; $f <= $a_upload_len ; $f++) {
					
					if($del_filename[$f] == "on" and $b_file_size[$f] < 1)  {

							$fqry = "Select f_filename From bbs_file Where f_tablename='$a_tablename' and f_num = $b_num and f_sort = '$f' ";
							$mysql->ParseExec($fqry);
							$mysql->FetchInto(&$file);

							if ($file[f_filename] <> "") {

									@unlink($path.$file[f_filename]);
									$dqry  = " Delete From bbs_file Where f_tablename='$a_tablename' and f_num = $b_num and f_sort = $f";
									$mysql->ParseExec($dqry);
							
							}
					
					}
				}
				
				$qry = "Select f_filename From bbs_file Where f_tablename='$a_tablename' and f_num = $b_num";
				$mysql->ParseExec($qry);
				$mysql->FetchInto(&$col);

				if($col[f_filename] <> "") $b_file = "Y";
				else $b_file = "N";

				$qry  = "update $a_tablename set b_top = '$b_top', b_date = '$b_date', b_category = '$b_category', ";
        if(!($m_power == "2" or $adminstrator == true)) {
        $qry .= "                        b_writer = '$b_writer',";
        }
        
        $qry .= "                        b_email='$b_email', b_phone = '$b_phone',  b_home = '$b_home', ";
				$qry .= "                        b_subject = '$b_subject', b_html ='$b_html', b_content='$b_content',";
				$qry .= "                        b_open = '$b_open', b_file = '$b_file'";
				$qry .= " where b_num=$b_num";
				$mysql->ParseExec($qry);

				//exec("chmod 0000 $path");
				//chmod($path, 0000);

			} else {

				if($a_jumin == "Y") message("�ֹε�Ϲ�ȣ�� ��й�ȣ�� ��ġ���� �ʽ��ϴ�");
				else message("��й�ȣ�� ��ġ���� �ʽ��ϴ�");
			
			}

      movepage($pageUrl."&page=/pages/admin/bbs/view.php&a_idx=$a_idx&category=$category&look=$look&search=$search&keyword=$keyword&pageIdx=$pageIdx&b_num=$b_num");
	}
	

// ******************************* ������ �ޱ� **************************************************************
	elseif($mode == "comment" and $b_num <> "") {
	
		$c_id  = $HTTP_SESSION_VARS[duid];
		$cm_name  = euckrToUtf8($HTTP_SESSION_VARS[duname]);
		$cm_content = addslashes($cm_content);

		if($HTTP_SESSION_VARS[duid] <> ""){

			  $qry  = " Insert into comment (c_tablename, c_bnum, c_id, c_pass, c_name, c_feel, c_content, c_regdate)";
					$qry .= " Values('$a_tablename',$b_num,'$c_id', '$cm_pass','$cm_name', '$cm_feel', '$cm_content', now())";
					$mysql->ParseExec($qry);

					movepage($pageUrl."&page=/pages/admin/bbs/view.php&a_idx=$a_idx&b_num=$b_num&look=$look");
		}else{
		
			message("�α����� �ϼž� �մϴ�.");
		}
	}

// ******************************* ������ ���� **************************************************************	
	elseif($mode == "comment_del" and $b_num <> "") {

			$qry  = " Select c_num, c_pass from comment where c_num = '$cm_num'";
			if($HTTP_SESSION_VARS[duid] <> "" and !($m_power == "2" or $adminstrator == true)) 	{
				$qry .= " and c_id = '$HTTP_SESSION_VARS[duid]'";
			} elseif($HTTP_SESSION_VARS[duid] == "" and $cm_pass) {
				$qry .= " and c_pass='$cm_pass'";
			}
			$mysql->ParseExec($qry);
			$mysql->FetchInto(&$col);

			if(($HTTP_SESSION_VARS[duid] == "" and $col[c_pass] == $cm_pass) or ($HTTP_SESSION_VARS[duid] <> "" and $col[c_num] <> "")) {
				$qry  = " Delete From comment Where c_num = '$cm_num'";
				$mysql->ParseExec($qry);
				movepage($pageUrl."&page=/pages/admin/bbs/view.php&a_idx=$a_idx&b_num=$b_num&look=$look");

			} else {

				if($HTTP_SESSION_VARS[duid] == "") message("��й�ȣ�� ��ġ���� �ʽ��ϴ�");
				else message("�������� �����ϴµ� �����߽��ϴ�");

			}

	}

// ******************************* �� ���� ******************************************************************	
	elseif($mode == "delete" and ($b_num <> "" or count($look_num) > 0)) {

			if(count($look_num) > 0 and ($m_power == "2" or $adminstrator == true)) {
				for ($i = 0; $i < count($look_num); $i++) {
						$count_temp[$i] = $look_num[$i];
				}
			} else {
				$count_temp[0] =  $b_num;
			}
			
			for ($i = 0; $i < count($count_temp); $i++) {
					$b_num = $count_temp[$i];

					//�亯���� ���� ���
          $qry = " Select *  from $a_tablename where b_ref = '$b_num'";
          $mysql->ParseExec($qry);
         	if($mysql->RowCount() > 1) {
            
            message("�亯���� �����Ƿ� ������ �Ұ����մϴ�");

          } else {
          
            //�ڽ��� �� �۸� ���� ����
            $qry  = " Select b_pass, b_content from $a_tablename where b_num = '$b_num'";
            if($HTTP_SESSION_VARS[duid] <> "" and !($m_power == "2" or $adminstrator == true)) 	
            $qry .= " And b_id = '$HTTP_SESSION_VARS[duid]' ";
            $mysql->ParseExec($qry);
            $mysql->FetchInto(&$col);

            if(($col[b_pass] == $b_pass) or $m_power == "2" or $adminstrator == true) {
              
              // ������ ÷������ ����
              #VBN_deleteFiles($col[b_content]);  

              // �� ����
              $qry  = " Delete From $a_tablename Where b_num = '$b_num'";
              $mysql->ParseExec($qry);

              //÷������ ����
              $fqry = "Select f_sort, f_filename From bbs_file Where f_tablename='$a_tablename' and f_num = '$b_num'";
              $mysql->ParseExec($fqry);
        
              //chmod($path, 0700);
              //exec("chmod 0700 $path");

              while($mysql->FetchInto(&$file)) {   
                  
                  @unlink($path.$file[f_filename]);

                  $mysql2 = new Mysql_DB;
                  $mysql2->Connect();

                  $dqry  = " Delete From bbs_file Where f_tablename='$a_tablename' and f_num = $b_num and f_sort = $file[f_sort]";
                  $mysql2->ParseExec($dqry);
            
              }
              
              //chmod($path, 0000);
              //exec("chmod 0000 $path");
              
              //������ ����
              $qry  = " Delete From comment Where c_tablename = '$a_tablename' and c_bnum = '$b_num'";
              $mysql->ParseExec($qry);

            } else {

              message("��й�ȣ�� ��ġ���� �ʽ��ϴ�");

            }
          
         }

      }

      movepage($pageUrl."&page=/pages/admin/bbs/list.php&a_idx=$a_idx&category=$category&look=$look");
	}

// ******************************* ����, ����� : �����ڸ�  **************************************************************
	elseif($mode == "look") {

			for ($i = 0; $i < count($look_num); $i++) {
				
				$qry  = "update $a_tablename set b_look = '$gubun' where b_num = $look_num[$i]";
				$mysql->ParseExec($qry);
			}

			movepage($pageUrl."&page=/pages/admin/bbs/list.php&a_idx=$a_idx");

	}

// *************************************** ������ ����  ******************************************************************
	elseif($mode == "admin") {

			$qry  = "select user_id, user_name, ch_member, conn_num from members ";
	    $qry .= "where user_id='$m_id' and user_pass = password('$m_pass') ";
	    $qry .= "and not_user=0 ";
			$mysql->ParseExec($qry);
			$mysql->FetchInto(&$col);

			//���̵�, ��й�ȣ�� ��ġ �� ���
      if($col[user_id] == $m_id) {
				
				if($col[ch_member] == "99") {      // �Ѱ�����

						$duid        = $col[user_id];
            $duname      = $col[user_name];
            $duchmember  = $col[ch_member];
            $dupass      = $dupass;

						Session_Register("duid");
            Session_Register("duname");
            Session_Register("duchmember");
            Session_Register("dupass");
						
            $conn_num   = $col[conn_num];
            $conn_num   = $conn_num + 1;
            $conn_day   = date("Y-m-d");

            $qry = "update members set conn_num='$conn_num', conn_day='$conn_day' where user_id='$duid' and user_pass=password('$dupass')";
          	$mysql->ParseExec($qry); 

						movepage($pageUrl."&page=/pages/admin/bbs/list.php&a_idx=$a_idx");

				} else {                         // �Խ��� ������

					$pqry = "Select * From m_menu Where (m_menutable='all' or m_menutable='$a_tablename') and m_level='$col[ch_member]'";
					$mysql->ParseExec($pqry); 
					if ($mysql->RowCount() > 0) {
						
						$duid        = $col[user_id];
            $duname      = $col[user_name];
            $duchmember  = $col[ch_member];
            $dupass      = $dupass;

						Session_Register("duid");
            Session_Register("duname");
            Session_Register("duchmember");
            Session_Register("dupass");
						
            $conn_num   = $col[conn_num];
            $conn_num   = $conn_num + 1;
            $conn_day   = date("Y-m-d");

            $qry = "update members set conn_num='$conn_num', conn_day='$conn_day' where user_id='$duid' and user_pass=password('$dupass')";
          	$mysql->ParseExec($qry); 
						
						movepage($pageUrl."&page=/pages/admin/bbs/list.php&a_idx=$a_idx");

					} else {
						
						message("������ ������ ��ġ���� �ʽ��ϴ�");

					}
				}
				
			} else {

				message("������ ������ ��ġ���� �ʽ��ϴ�");
			}
		

	}
?>