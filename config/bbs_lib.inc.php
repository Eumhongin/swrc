<?
	
	//*******************  Information  ***********************
  // �Լ����� : �Խ��� ���� Ȯ��
  //*********************************************************
	Function Exist_Table($table)
	{
			global $mysql;
			
			$exits = false;
			$i = 0;

			if (!$mysql->ListTables()) {  $exits = false; }
			
			while ($i < $mysql->RowCount()) 	{
				if($table == $mysql->Result($i)) $exits = true;
				$i++;
			}
	
			return $exits;
			
	}

	//*******************  Information  ***********************
  // �Լ����� : �Խ��� ȯ�� ���� table ����
  //*********************************************************
	Function Bbs_Config_Create()  {
			global $mysql;

			$cqry = "CREATE TABLE bbs_admin (";
			$cqry .="             a_idx varchar(14) NOT NULL default '',";
			$cqry .="             a_type int(11) NOT NULL default '0',";
			$cqry .="             a_bbsname varchar(80) NOT NULL default '',";
			$cqry .="             a_tablename varchar(80) NOT NULL default '',";
			$cqry .="             a_category char(1) NOT NULL default '',";
			$cqry .="             a_email char(1) NOT NULL default '',";
			$cqry .="             a_homepage char(1) NOT NULL default '',";
			$cqry .="             a_jumin char(1) NOT NULL default '',";
			$cqry .="             a_phone char(1) NOT NULL default '',";
			$cqry .="             a_html char(1) NOT NULL default '',";
			$cqry .="             a_upload char(1) NOT NULL default '',";
			$cqry .="             a_upload_len int(11) default NULL,";
			$cqry .="             a_nofilesize varchar(10) default NULL,";
			$cqry .="             a_nofile text,";
			$cqry .="             a_command char(1) NOT NULL default '',";
			$cqry .="             a_ip char(1) NOT NULL default '',";
			$cqry .="             a_new int(11) default NULL,";
			$cqry .="             a_move char(1) NOT NULL default '',";
			$cqry .="             a_noword text,";
			$cqry .="             a_opener char(1) NOT NULL default '',";
			$cqry .="             a_reply char(1) default NULL,";
			$cqry .="             a_reply_type char(1) default NULL,";
			$cqry .="			  a_admin_check char(1) default 'N'	";
			$cqry .="             a_skin tinyint(4) NOT NULL default '0',";
			$cqry .="             a_width int(11) NOT NULL default '0',";
			$cqry .="             a_align varchar(6) NOT NULL default '',";
			$cqry .="             a_title_bgcolor varchar(7) NOT NULL default '',";
			$cqry .="             a_title_border varchar(7) NOT NULL default '',";
			$cqry .="             a_font_color varchar(7) NOT NULL default '',";
			$cqry .="             a_mouseover_color varchar(7) NOT NULL default '',";
			$cqry .="             a_displaysu tinyint(4) NOT NULL default '0',";
			$cqry .="             a_pagesu tinyint(4) NOT NULL default '0',";
			$cqry .="             a_orderby varchar(30) NOT NULL default '',";
			$cqry .="             a_orderby_type varchar(4) NOT NULL default '',";
			$cqry .="             a_title_len int(11) default NULL,";
			$cqry .="             a_header text,";
			$cqry .="             a_detail text,";
			$cqry .="             a_view tinyint(4) NOT NULL default '0',";
			$cqry .="             a_photo char(1) default NULL,";
			$cqry .="             a_photo_width int(11) default NULL,";
			$cqry .="             a_photo_height int(11) default NULL,";
			$cqry .="             a_photo_cols tinyint(4) default NULL,";
			$cqry .="             a_photo_rows tinyint(4) default NULL,";
			$cqry .="             a_include_left varchar(200) default NULL,";
			$cqry .="             a_include_top varchar(200) default NULL,";
			$cqry .="             a_include_right varchar(200) default NULL,";
			$cqry .="             a_include_bottom varchar(200) default NULL,";
			$cqry .="             PRIMARY KEY (a_idx)";
			$cqry .="             ) TYPE=MyISAM;";
			$mysql->ParseExec($cqry); 

	}


	//*******************  Information  ***********************
  // �Լ����� : �Խ��� ȯ�� ���� table ����
  //*********************************************************
	Function Bbs_File_Create()  {
			global $mysql;

			$cqry = "Create table bbs_file (";
			$cqry = $cqry. "       f_tablename varchar(80) not null,";
			$cqry = $cqry. "       f_num int not null,";
			$cqry = $cqry."        f_filename varchar(200),";
			$cqry = $cqry."        f_filesize int null,";
			$cqry = $cqry."        f_sort tinyint )";
			$mysql->ParseExec($cqry); 

	}


	//*******************  Information  ***********************
  // �Լ����� : �Խ��� ȯ�� ���� 
  //*********************************************************

	Function Bbs_Config($a_idx)  {

		global $mysql, $wb_num, $wb_date;
		global $a_language,$a_type, $a_bbsname, $a_tablename, $a_category, $a_email, $a_homepage;
		global $a_jumin, $a_phone, $a_html, $a_upload, $a_upload_len, $a_nofilesize, $a_nofile;
		global $a_command, $a_ip, $a_new, $a_move, $a_excel, $a_noword, $a_opener, $a_reply, $a_reply_type, $a_admin_check;
		global $a_opinion, $a_skin, $a_width, $a_align, $a_title_bgcolor, $a_title_border,$a_font_color,$a_mouseover_color;
		global $a_displaysu, $a_pagesu,$a_orderby, $a_orderby_type, $a_title_len, $a_include_header,$a_header, $a_detail, $a_view;
    global $a_photo, $a_photo_width, $a_photo_height, $a_photo_cols, $a_photo_rows;
		global $a_include_top,$a_include_left, $a_include_right, $a_include_bottom;
		
		$cfg = "Select * From bbs_admin Where a_idx = '$a_idx'";
   	$mysql->ParseExec($cfg);
	

		if ($mysql->RowCount() < 1) {

			 message("�Խ����� �������� �ʽ��ϴ�");
		
		} else {

				$mysql->FetchInto(&$crow);

				$a_language        =  $crow[a_language];
				$a_type            =  $crow[a_type];
				$a_bbsname         =  utf8ToEuckr($crow[a_bbsname]);
				$a_tablename       =  $crow[a_tablename];
				$a_category        =  $crow[a_category];
				$a_email           =  $crow[a_email];
				$a_homepage        =  $crow[a_homepage];
				$a_jumin           =  $crow[a_jumin];
				$a_phone           =  $crow[a_phone];
				$a_html            =  $crow[a_html];
				$a_upload          =  $crow[a_upload];
				$a_upload_len      =  $crow[a_upload_len];
				$a_nofilesize      =  $crow[a_nofilesize];
				$a_nofile          =  $crow[a_nofile];
				$a_command         =  utf8ToEuckr($crow[a_command]);
				$a_ip              =  $crow[a_ip];
				$a_new             =  $crow[a_new];
				$a_move            =  $crow[a_move];
				$a_excel           =  $crow[a_excel];
				$a_noword          =  $crow[a_noword];
				$a_opener          =  $crow[a_opener];
				$a_reply           =  $crow[a_reply];
				$a_reply_type      =  $crow[a_reply_type];
				$a_admin_check	   =  $crow[a_admin_check];
				$a_opinion         =  $crow[a_opinion];
				$a_skin            =  $crow[a_skin];
				$a_width           =  $crow[a_width];
				$a_align           =  $crow[a_align];
				$a_title_bgcolor   =  $crow[a_title_bgcolor];
				$a_title_border    =  $crow[a_title_border];
				$a_font_color      =  $crow[a_font_color];
				$a_mouseover_color =  $crow[a_mouseover_color];
				$a_displaysu       =  $crow[a_displaysu];
				$a_pagesu          =  $crow[a_pagesu];
				$a_orderby         =  $crow[a_orderby];
				$a_orderby_type    =  $crow[a_orderby_type];
				$a_title_len       =  $crow[a_title_len];
				$a_include_header  =  $crow[a_include_header];
				$a_header          =  $crow[a_header];
				$a_detail          =  $crow[a_detail];
				$a_view            =  $crow[a_view];
				$a_photo           =  $crow[a_photo];
				$a_photo_width     =  $crow[a_photo_width];
				$a_photo_height    =  $crow[a_photo_height];
				$a_photo_cols      =  $crow[a_photo_cols];
				$a_photo_rows      =  $crow[a_photo_rows];
				$a_include_top     =  $crow[a_include_top];
				$a_include_left    =  $crow[a_include_left];
				$a_include_right   =  $crow[a_include_right];
				$a_include_bottom  =  $crow[a_include_bottom];

				//�Խ��� ������
				Administrator();
		}
	}


 //*******************  Information  ***********************
 // �Լ����� : �Խ��� ÷������ ������ 
 //*********************************************************
	Function Bbs_FileIcon($filename) {
		
		$tempfilename   = ereg_replace("(\.[^\.]*$)","",$filename);
		$extension      = strtolower(str_replace($tempfilename.".","",$filename));
										
		Switch($extension) {
			Case ""     : $extIcn = "default.gif";	break;
			Case "asf"  : $extIcn = "asf.gif";      break;
			Case "asx"  : $extIcn = "asf.gif";      break;
			Case "doc"  : $extIcn = "doc.gif";      break;
			Case "mpg"  : $extIcn = "mpg.gif";      break;
			Case "mpeg" : $extIcn = "mpg.gif";      break;
			Case "bat"  : $extIcn = "bat.gif";      break;
			Case "bmp"  : $extIcn = "bmp.gif";      break;
			Case "com"  : $extIcn = "com.gif";      break;
			Case "sys"  : $extIcn = "device.gif";   break;
			Case "dll"  : $extIcn = "device.gif";   break;
			Case "exe"  : $extIcn = "exe.gif";      break;
			Case "gif"  : $extIcn = "gif.gif";      break;
			Case "htm"  : $extIcn = "html.gif";     break;
			Case "html" : $extIcn = "html.gif";     break;
			Case "hwp"  : $extIcn = "hwp.gif";      break;
			Case "xls"  : $extIcn = "xls.gif";      break;
			Case "jpg"  : $extIcn = "jpg.gif";      break;
			Case "jpge" : $extIcn = "jpg.gif";      break;
			Case "mp3"  : $extIcn = "mp3.gif";      break;
			Case "pcx"  : $extIcn = "pcx.gif";      break;
			Case "png"  : $extIcn = "png.gif";      break;
			Case "ppt"  : $extIcn = "ppt.gif";      break;
			Case "ra"   : $extIcn = "ra.gif";       break;
			Case "txt"  : $extIcn = "text.gif";     break;
			Case "url"  : $extIcn = "url.gif";      break;
			Case "wav"  : $extIcn = "wav.gif";      break;
			Case "zip"  : $extIcn = "zip.gif";      break; 
			Case "pdf"  : $extIcn = "pdf.gif";      break; 
			Default     : $extIcn = "unknown.gif";  break;
		}

		return $extIcn;
	}

	//*******************  Information  ***********************
	// �Լ����� : �Խ��� ÷������ Ȯ���� 
	//*********************************************************
	Function Bbs_FileExt($filename) {
		
		$tempfilename   = ereg_replace("(\.[^\.]*$)","",$filename);
		$extension      = strtolower(str_replace($tempfilename.".","",$filename));

		return $extension;
	}

	//*******************  Information  ***********************
	// �Լ����� : �Խ��� ����
	//*********************************************************
	Function Bbs_Orderby() {
		global $a_orderby, $a_orderby_type;
		global $a_reply, $a_reply_type;

		if($a_orderby == "num" and $a_reply == "Y" and $a_reply_type == "0") {
			 $q_order = "b_ref $a_orderby_type, b_step asc";
		}elseif($a_orderby == "num" and $a_reply == "Y" and $a_reply_type == "1") {
			 $q_order = "b_num desc";
		}elseif($a_orderby == "num" and $a_reply == "N") {
			 $q_order = "b_num desc";
		}elseif($a_orderby == "title") {
			 $q_order = "b_subject $a_orderby_type";
		}elseif($a_orderby == "regdate") {
			$q_order = "b_regdate $a_orderby_type";
		}

		return $q_order;

	}

	//*******************  Information  ***********************
	// �Լ����� : ������ ����
	//*********************************************************
	Function Administrator() {
			global $menuname, $a_tablename;
			global $mysql, $HTTP_SESSION_VARS,$adminstrator;
			global $m_list, $m_write, $m_read, $m_reply, $m_modify, $m_del, $m_power;

			if($HTTP_SESSION_VARS[duchmember] == 99) { //�̸� �Ѱ�����
				$m_list    = "Y";
				$m_write   = "Y";
				$m_read    = "Y";
				$m_reply   = "Y";
				$m_modify  = "Y";
				$m_del     = "Y";

				$adminstrator = true;
			} else {
					$adminstrator = false;
			}

	}


	//*******************  Information  ***********************
	// �Լ����� : �Խ��� ����Ʈ
	//*********************************************************
	Function Bbs_List(&$col, $pageUrl) {
		
		global $a_language,$a_idx, $a_tablename, $a_width, $a_mouseover_color, $a_title_border;
		global $m_read, $a_reply, $a_reply_type,$a_new, $a_reply, $a_reply_type,$b_id, $b_look;
		global $b_top, $b_year,$b_month,$a_upload, $a_title_len, $a_category, $a_open, $a_command;
		global $num, $real_num, $category, $wb_num;
		global $HTTP_SESSION_VARS, $adminstrator,$m_power, $search, $keyword;
		global $pageIdx;
		global $b_admin_check, $a_admin_check;

		$b_id       = $col["b_id"];
		$b_top      = $col["b_top"];
		$b_num      = $col["b_num"];
		$b_date     = $col["b_date"];
		$b_category = $col["b_category"];
		$b_subject  = shorten_string(utf8ToEuckr($col["b_subject"]),$a_title_len*2,"...");
		$b_writer   = utf8ToEuckr($col["b_writer"]);
		$b_regdate  = explode(" ", $col["b_regdate"]);
		$b_count    = $col["b_count"];
		$b_ref      = $col["b_ref"];
		$b_level    = $col["b_level"];
		$b_file     = $col["b_file"];
		$b_open     = $col["b_open"];
		$b_look     = $col["b_look"];

		$b_year     = substr($b_date,0,4);
		$b_month    = substr($b_date,4,2);

		//��������
		if($b_open == 1) {
			 $key = "<img src=\"/images/bbs/icon_key.gif\" alt=\"��б�\" class=\"vmiddle\" /> ";
		} else {
			 $key = "";
		}
		
		// �亯�� ���
		if($b_level > 0 and $b_top == "N" and $a_reply == "Y" and $a_reply_type == "0") {
			 for ($j = 1 ; $j <=$b_level; $j++) {
					$reply = $reply . "&nbsp;";
			 }
			 $reply = $reply . "<img src=\"/images/bbs/icon_re.gif\" alt=\"�亯\" class=\"vmiddle\" /> ";
		}  
		
		// �Խ��� �з�
		$mysql2 = new Mysql_DB;
		$mysql2->Connect();

		if($a_category == "Y") { 
			$sql =  " Select c_catename From bbs_admin_cate Where c_tablename='$a_tablename' and c_cate = $b_category ";
			$mysql2->ParseExec($sql);
			$mysql2->FetchInto(&$cate);
		}
		
		if($a_command == "Y") { 
			$sql =  " Select count(*) cm_total From comment Where c_tablename='$a_tablename' and c_bnum = $b_num ";
			$mysql2->ParseExec($sql);
			$mysql2->FetchInto(&$cm);

			$cm_total = $cm[cm_total];
		}

		//�亯������ ȭ���϶� �亯���θ� �����ش�
		if($a_reply == "Y" and $a_reply_type =="1") { 
			$sql = "Select * From $a_tablename Where b_ref = $b_ref and b_step > 0";
			$mysql2->ParseExec($sql);

			if($mysql2->RowCount() > 0) {
				$mark = ($a_idx == "I_080725140527")?"�亯�Ϸ�":"".$mysql2->RowCount()."��";
			}
			else {
				$mark = ($a_idx == "I_080725140527")?"������":"-";
			}
			$mark = "<span class=\"f_blue\"> ".$mark."</span>";
		}

		//��뿩�� -- �����ڸ� ����
		if($b_top == "N" and ($m_power == "2" or $adminstrator == true)) {
			if($a_language == 1) {
				if($b_look == 0)	$l_mark = "����";
				else $l_mark = "�̽���";
			} else {
				if($b_look == 0)	$l_mark = "use";
				else $l_mark = "stop";
			}
		}

 
    //new ������
    $new_icon = strtotime("-$a_new day");
    $new_icon = date("Y-m-d", $new_icon);

		//���� ����
		if($b_top == "Y"){ //�����ϰ��
			$b_subject = "<strong>".$b_subject."</strong>";
		}

		if($b_regdate[0] > $new_icon){ //�����ϰ��
			$b_subject .= " <img src=\"/images/bbs/icon_new.gif\" alt=\"����\" class=\"vmiddle\" /> ";
		}

		if($a_command == "Y"){ //������ ���
			if($cm_total > 0 )
			$b_subject .= " (".$cm_total.")";
		}
	?>
	<tr>
		<td>
			<?if($b_top == "Y"){ //���� �ϰ��?>
				<strong>����</strong>
			<?}else{?>
				<?=$num?>
			<?}?>
		</td>
		<td class="title">
		<?
			//�亯 ǥ��
			echo $reply;

			//����� ���� ���
			if($b_open == 1 and !($m_power == "2" or $adminstrator == true)){
				// �մ��� ��� ��ϸ� ���δ�. Ŭ�� �Ұ� (�������� �Ǿ��� ������ ���� �ҽ� �����Ұ�)
				if($HTTP_SESSION_VARS[duid] == ""){
		?>
					<a href="<?=$pageUrl?>&page=/pages/bbs/password.php&amp;wb_num=<?=$wb_num ?>&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category?>&amp;search=<?=$search?>&amp;keyword=<?=curlencode($keyword)?>&amp;pageIdx=<?=$pageIdx?>&amp;b_num=<?=$b_num?>&amp;look=<?=$look?>&nextPage=view">
					<?=$b_subject?> <?=$key?>
					</a>
		<?
				}else if($HTTP_SESSION_VARS[duid] == $b_id) { //ȸ���ϰ�� �ڽ��� ���� �� �� �ִ�.
		?>
					<a href="<?=$pageUrl?>&page=/pages/bbs/view.php&amp;wb_num=<?=$wb_num ?>&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category?>&amp;search=<?=$search?>&amp;keyword=<?=curlencode($keyword)?>&amp;pageIdx=<?=$pageIdx?>&amp;b_num=<?=$b_num?>&amp;look=<?=$look?>">
						<?=$b_subject?> <?=$key?>
					</a>
		<?
				}else{ //ȸ�������� �ڱ���� �ƴ� ���
		?>
					<a href="<?=$pageUrl?>&page=/pages/bbs/view.php&amp;wb_num=<?=$wb_num ?>&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category?>&amp;search=<?=$search?>&amp;keyword=<?=curlencode($keyword)?>&amp;pageIdx=<?=$pageIdx?>&amp;b_num=<?=$b_num?>&amp;look=<?=$look?>" onclick="alert('����� ���Դϴ�.'); return false;">
					<?=$b_subject?> <?=$key?>
					</a>
		<?
				}//End if($HTTP_SESSION_VARS[duid] == "")
			}else { //�������ϰ��
		?>
					<a href="<?=$pageUrl?>&amp;page=/pages/bbs/view.php&amp;wb_num=<?=$wb_num ?>&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category ?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>&amp;b_num=<?=$b_num ?>&amp;look=<?=$look?>">
						<?=$b_subject?> <?=$key?>
					</a>
		<?
			}
		?>
		</td>
		<?if($a_upload == "Y"){ //���� ÷���ϰ��?>
			<td>
				<?if($b_file == "Y"){?>
					<img src="/images/bbs/icon_file.gif" alt="÷��" />
				<?}?>
			</td>
		<?}?>
			<td>
				<?=$b_writer?>
			</td>
			<td>
				<?=$b_regdate[0]?>
			</td>
			<td>
				<?=$b_count ?>
			</td>
		<? if($a_reply == "Y" and $a_reply_type =="1") { ?>
			<td>
				<?=$mark?>
			</td>
		<?}?>
		<?if($a_category == "Y"){?>
			<td>
				<?=$cate[c_catename]?>
			</td>
		<?}?>
	</tr>
			
	<?							
			$num--;
			$reply = "";
	}

	//*******************  Information  ***********************
	// �Լ����� : ������ �Խ��� ����Ʈ
	//*********************************************************
	Function Bbs_Admin_List(&$col, $pageUrl) {
		
		global $a_language,$a_idx, $a_tablename, $a_width, $a_mouseover_color, $a_title_border;
		global $m_read, $a_reply, $a_reply_type,$a_new, $a_reply, $a_reply_type,$b_id, $b_look;
		global $b_top, $b_year,$b_month,$a_upload, $a_title_len, $a_category, $a_open, $a_command;
		global $num, $real_num, $category, $wb_num;
		global $HTTP_SESSION_VARS, $adminstrator,$m_power, $search, $keyword;
		global $pageIdx;
		global $b_admin_check, $a_admin_check;

		$b_id       = $col["b_id"];
		$b_top      = $col["b_top"];
		$b_num      = $col["b_num"];
		$b_date     = $col["b_date"];
		$b_category = $col["b_category"];
		$b_subject  = utf8ToEuckr(shorten_string($col["b_subject"],$a_title_len*2,"..."));
		$b_writer   = $col["b_writer"];
		$b_regdate  = explode(" ", $col["b_regdate"]);
		$b_count    = $col["b_count"];
		$b_ref      = $col["b_ref"];
		$b_level    = $col["b_level"];
		$b_file     = $col["b_file"];
		$b_open     = $col["b_open"];
		$b_look     = $col["b_look"];
		$b_admin_check = $col["b_admin_check"];

		$b_year     = substr($b_date,0,4);
		$b_month    = substr($b_date,4,2);


		//��������
		if($b_open == 1) {
			 $key = "<img src=\"/images/bbs/icon_key.gif\" alt=\"��б�\" class=\"vmiddle\" /> ";
		} else {
			 $key = "";
		}
		
		// �亯�� ���
		if($b_level > 0 and $b_top == "N" and $a_reply == "Y" and $a_reply_type == "0") {
			 for ($j = 1 ; $j <=$b_level; $j++) {
					$reply = $reply . "&nbsp;";
			 }
			 $reply = $reply . "<img src=\"/images/bbs/icon_re.gif\" alt=\"�亯\" class=\"vmiddle\" /> ";
		}  
		
		// �Խ��� �з�
		$mysql2 = new Mysql_DB;
		$mysql2->Connect();

		if($a_category == "Y") { 
			$sql =  " Select c_catename From bbs_admin_cate Where c_tablename='$a_tablename' and c_cate = $b_category ";
			$mysql2->ParseExec($sql);
			$mysql2->FetchInto(&$cate);
		}
		
		if($a_command == "Y") { 
			$sql =  " Select count(*) cm_total From comment Where c_tablename='$a_tablename' and c_bnum = $b_num ";
			$mysql2->ParseExec($sql);
			$mysql2->FetchInto(&$cm);

			$cm_total = $cm[cm_total];
		}

		//�亯������ ȭ���϶� �亯���θ� �����ش�
		if($a_reply == "Y" and $a_reply_type =="1") { 
			$sql = "Select * From $a_tablename Where b_ref = $b_ref and b_step > 0";
			$mysql2->ParseExec($sql);

			if($mysql2->RowCount() > 0) {
				$mark = ($a_idx == "I_080725140527")?"<img src=\"/images/bbs/i_end.gif\" border=\"0\">":"<img src=\"/bbs/image/replyok.gif\" border=\"0\">";
			}
			else {
				$mark = ($a_idx == "I_080725140527")?"<img src=\"/images/bbs/i_ing.gif\" border=\"0\">":"-";
			}
		}

		//��뿩�� -- �����ڸ� ����
		if($b_top == "N" and $a_admin_check == "Y" and ($m_power == "2" or $adminstrator == true)) {
			if($a_language == 1) {
				if($b_look == 0)	$l_mark = "����";
				else $l_mark = "�̽���";
			} else {
				if($b_look == 0)	$l_mark = "use";
				else $l_mark = "stop";
			}
		}

		
 
    //new ������
    $new_icon = strtotime("-$a_new day");
    $new_icon = date("Y-m-d", $new_icon);

		//���� ����
		if($b_top == "Y"){ //�����ϰ��
			$b_subject = "<strong>".$b_subject."</strong>";
		}

		if($b_regdate[0] > $new_icon){ //�����ϰ��
			$b_subject .= " <img src=\"/images/bbs/icon_new.gif\" alt=\"����\" class=\"vmiddle\" /> ";
		}

		if($a_command == "Y"){ //������ ���
			$b_subject .= "(".$cm_total.")";
		}
	?>
	<tr >
		<td class="acenter">
			<?if($b_top == "Y"){ //���� �ϰ��?>
				<strong>����</strong>
			<?}else{?>
				<?=$num?>
			<?}?>
		</td>
		<td class="tal" >
		<?
			//�亯 ǥ��
			echo $reply;
			//����� ���� ���
			if($b_open == 1 and $m_read == "Y" and !($m_power == "2" or $adminstrator == true)){
				//�մ��� ��� ��ϸ� ���δ�. Ŭ�� �Ұ� (�������� �Ǿ��� ������ ���� �ҽ� �����Ұ�)
				if($HTTP_SESSION_VARS[duid] == ""){
		?>
					<?=$b_subject?>
		<?
				}else if($HTTP_SESSION_VARS[duid] == $b_id) { //ȸ���ϰ�� �ڽ��� ���� �� �� �ִ�.
		?>
					<a href="<?=$pageUrl?>&page=pages/admin/bbs/view.php&amp;wb_num=<?=$wb_num ?>&amp;a_idx=<?$a_idx ?>&amp;category=<?$category?>&amp;search=<?=$search?>&amp;keyword=<?=curlencode($keyword)?>&amp;pageIdx=<?=$pageIdx?>&amp;b_num=<?=$b_num?>&amp;look=<?=$look?>">
						<?=$b_subject?>
					</a>
		<?
				}else{ //ȸ�������� �ڱ���� �ƴ� ���
		?>
					<?=$b_subject?>
		<?
				} //End if($HTTP_SESSION_VARS[duid] == "")
			}else { //�������ϰ��
				if($m_read == "Y" or $m_power == "2" or $adminstrator == true) { //�б� ������ �������
		?>
					<a href="<?=$pageUrl?>&amp;page=/pages/admin/bbs/view.php&amp;wb_num=<?=$wb_num ?>&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category ?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>&amp;b_num=<?=$b_num ?>&amp;look=<?=$look?>">
						<?=$b_subject?>
					</a>
		<?
				}
			}
				//����� ǥ��
				echo $key;
		?>
		</td>
		<?if($a_upload == "Y"){ //���� ÷���ϰ��?>
			<td class="acenter">
				<?if($b_file == "Y"){?>
					<img src="/images/bbs/icon_file.gif" alt="÷��" />
				<?}else{?>
					-
				<?}?>
			</td>
		<?}?>

			<td class="acenter">
				<?=utf8ToEuckr($b_writer)?>
			</td>
			<td class="acenter">
				<?=$b_regdate[0]?>
			</td>
			<td class="acenter">
				<?=$b_count ?>
			</td>
		<? if($a_reply == "Y" and $a_reply_type =="1") { ?>
			<td class="acenter">
				<?=$mark?>
			</td>
		<?}?>
		<?if($a_category == "Y"){?>
			<td class="acenter">
				<?=$cate[c_catename]?>
			</td>
		<?}?>
		<?if(($m_power == "2" or $adminstrator == true) and $a_admin_check == "Y"){?>
			<td class="acenter">
				<input type="checkbox" name="look_num[]" value="<?=$b_num?>" />
			</td>
			<td class="acenter">
				<?=$l_mark?>
				<?if($l_mark == ""){?>-<?}?>
			</td>
		<?}?>
	</tr>
			
	<?							
			$num--;
			$reply = "";
	}


	//*******************  Information  ***********************
	// �Լ����� : Viewȭ�� ������
	//********************************************************* 
	Function View_Icon($value) {

		global $a_language, $a_idx, $a_tablename, $a_width, $a_skin, $a_reply, $a_move;
		global $m_write, $m_modify, $m_read, $m_reply, $m_del, $wb_num;
		global $HTTP_SESSION_VARS,$m_power, $adminstrator, $ref_step, $a_reply_type;
		global $category, $b_id, $look, $search, $keyword, $pageIdx, $b_open;
		global $pageUrl;
	
		$b_num = $value;

		if($a_language == 1) {
		  $wStatus = "�����ۼ��ϱ�";
		  $eStatus = "�����ϱ�";
		  $rStatus = "�亯�ϱ�";
		  $lStatus = "������� ����";
		  $mStatus = "���̵�";
		  $wStatus = "������ ���";
		  $dStatus = "�����ϱ�";
		} else {

		  $wStatus = "WRITE";
		  $eStatus = "EDIT";
		  $rStatus = "REPLY";
		  $lStatus = "LIST";
		  $mStatus = "MOVE";
		  $wStatus = "WEBZINE";
		  $dStatus = "DELETE";
		
		} 
		?>
		<?
		//if(($a_reply_type == "1" and $ref_step == "") and (($HTTP_SESSION_VARS[duid] == "" and $m_write == "Y") or ($HTTP_SESSION_VARS[duid] <> "" and $m_write == "Y") or $m_power == "2" or $adminstrator == true))  
		//{	//���� ����
			?>
			<p>
			<?
				//���������϶�
			if( $a_idx == "I_131112160821" ) {
				if($adminstrator == true){
			?>
					<a href="<?=$pageUrl?>&amp;page=/pages/bbs/writeform.php&amp;wb_num=<?=$wb_num ?>&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category ?>&amp;b_look=<?=$b_look ?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>">
				<img src="/images/bbs/btn_write.gif" alt="�۵��" />
				</a>
			<?
				}
			}else{?>
				<?
					//ȸ����
					if($HTTP_SESSION_VARS[duid] != ""){?>
				<a href="<?=$pageUrl?>&amp;page=/pages/bbs/writeform.php&amp;wb_num=<?=$wb_num ?>&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category ?>&amp;b_look=<?=$b_look ?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>">
				<img src="/images/bbs/btn_write.gif" alt="�۵��" />
				</a>
					<?}?>
			<?}?>
			</p>
			<? 
		//}
		?>
		<?
		//if(($HTTP_SESSION_VARS[duid] == "" and $m_modify == "Y") or ($HTTP_SESSION_VARS[duid] == $b_id and $m_modify == "Y") or ($m_power == "2" and $m_modify == "Y") or $adminstrator == true) 
		
		if( $a_idx == "I_131112160821" ) {
			if($adminstrator == true){
			//{	//���� ����
				?>
				
				<p>
					<a href="<?=$pageUrl?>&amp;page=/pages/bbs/writeform.php&amp;wb_num=<?=$wb_num ?>&amp;mode=modify&amp;a_idx=<?=$a_idx ?>&amp;b_num=<?=$b_num ?>&amp;category=<?=$category ?>&amp;look=<?=$look ?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>" >
					<img src="/images/bbs/btn_modify.gif" alt="����" />
					</a>
				</p>
				
			<? 
			}
		}else{
			if($adminstrator == true or ($b_id != "" and $HTTP_SESSION_VARS[duid] == $b_id) ){
			//{	//���� ����
				?>
				
				<p>
					<a href="<?=$pageUrl?>&amp;page=/pages/bbs/writeform.php&amp;wb_num=<?=$wb_num ?>&amp;mode=modify&amp;a_idx=<?=$a_idx ?>&amp;b_num=<?=$b_num ?>&amp;category=<?=$category ?>&amp;look=<?=$look ?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>" >
					<img src="/images/bbs/btn_modify.gif" alt="����" />
					</a>
				</p>
				
			<? 
			// ȸ���� �� ���ε�, ��ȸ���� ��������
			}else if( $b_id != "" and $HTTP_SESSION_VARS[duid] == "" ){

			
			}else{
			?>
			<!--
				<p>
					<a href="<?=$pageUrl?>&amp;page=/pages/bbs/password.php&amp;wb_num=<?=$wb_num ?>&amp;mode=modify&amp;a_idx=<?=$a_idx ?>&amp;b_num=<?=$b_num ?>&amp;category=<?=$category ?>&amp;look=<?=$look ?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>&nextPage=writeform" >
					<img src="/images/bbs/btn_modify.gif" alt="����" />
					</a>
				</p>
			-->
			<?
			}	
		}


		?>
		<?
		if($a_reply == "Y" and (($m_reply == "Y" and $a_reply_type == "1" and $ref_step == "") or (($m_reply == "Y" and $a_reply_type == "0") and ($m_power == "2" or $adminstrator == true)))) 
		{	//�亯 ����
			?>
			<p>
				<a href="<?=$pageUrl?>&amp;page=/pages/bbs/writeform.php&amp;wb_num=<?=$wb_num ?>&amp;mode=reply&amp;a_idx=<?=$a_idx ?>&amp;b_num=<?=$b_num ?>&amp;category=<?=$category ?>&amp;look=<?=$look ?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>">
				<img src="/images/bbs/btn_reply.gif" alt="�亯" />
				</a>
			</p>
		<? 
		}
		?>
		<? 
		if(($a_reply_type == "1" and $ref_step == "") or $a_reply_type == "0") 
		{
			?>
			<p>
				<a href="<?=$pageUrl?>&amp;page=/pages/bbs/list.php&amp;wb_num=<?=$wb_num ?>&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category ?>&amp;look=<?=$look ?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>" >
				<img src="/images/bbs/btn_list.gif" alt="���" />
				</a>
			</p>
			<?
		}
		?>
		<?
		
		if( $a_idx == "I_131112160821") {
			if(($HTTP_SESSION_VARS[duid] == $b_id and $m_del == "Y") or ($m_power == "2" and $m_del == "Y") or $adminstrator == true)

			{
				//���� ����?>
				<p>
					<a href="javascript:bbs_delete('wb_num=<?=$wb_num ?>&amp;mode=delete&amp;a_idx=<?=$a_idx ?>&amp;b_num=<?=$b_num ?>&amp;category=<?=$category ?>&amp;look=<?=$look ?>', '<?=$pageUrl?>')" >
					<img src="/images/bbs/btn_delete.gif" alt="����" />
					</a>
				</p>
			<? 
			}
		}else{

			if($adminstrator == true or ($b_id != "" and $HTTP_SESSION_VARS[duid] == $b_id) )
			{
				//���� ����?>
				<p>
					<a href="javascript:bbs_delete('wb_num=<?=$wb_num ?>&amp;mode=delete&amp;a_idx=<?=$a_idx ?>&amp;b_num=<?=$b_num ?>&amp;category=<?=$category ?>&amp;look=<?=$look ?>', '<?=$pageUrl?>')" >
					<img src="/images/bbs/btn_delete.gif" alt="����" />
					</a>
				</p>			
			<? 
			}else if( $b_id != "" and $HTTP_SESSION_VARS[duid] == "" ){

			
			}
			else
			{
				?>
				<!--
				<p>
					<a href="<?=$pageUrl?>&amp;page=/pages/bbs/password.php&amp;wb_num=<?=$wb_num ?>&amp;mode=delete&amp;a_idx=<?=$a_idx ?>&amp;b_num=<?=$b_num ?>&amp;category=<?=$category ?>&amp;look=<?=$look ?>&nextPage=regist">
					<img src="/images/bbs/btn_delete.gif" alt="����" />
					</a>
				</p>
				-->
				<? 
			}

		}

	} 

	//*******************  Information  ***********************
	// �Լ����� : Viewȭ�� ������
	//********************************************************* 
	Function View_Admin_Icon($value) {

		global $a_language, $a_idx, $a_tablename, $a_width, $a_skin, $a_reply, $a_move;
		global $m_write, $m_modify, $m_read, $m_reply, $m_del, $wb_num;
		global $HTTP_SESSION_VARS,$m_power, $adminstrator, $ref_step, $a_reply_type;
		global $category, $b_id, $look, $search, $keyword, $pageIdx, $b_open;
		global $pageUrl;
	
		$b_num = $value;

		if($a_language == 1) {
		  $wStatus = "�����ۼ��ϱ�";
		  $eStatus = "�����ϱ�";
		  $rStatus = "�亯�ϱ�";
		  $lStatus = "������� ����";
		  $mStatus = "���̵�";
		  $wStatus = "������ ���";
		  $dStatus = "�����ϱ�";
		} else {

		  $wStatus = "WRITE";
		  $eStatus = "EDIT";
		  $rStatus = "REPLY";
		  $lStatus = "LIST";
		  $mStatus = "MOVE";
		  $wStatus = "WEBZINE";
		  $dStatus = "DELETE";
		
		} 
		?>
		<?
		if(($a_reply_type == "1" and $ref_step == "") and (($HTTP_SESSION_VARS[duid] == "" and $m_write == "Y") or ($HTTP_SESSION_VARS[duid] <> "" and $m_write == "Y") or $m_power == "2" or $adminstrator == true))  
		{	//���� ����
			?>
			<a href="<?=$pageUrl?>&amp;page=/pages/admin/bbs/writeform.php&amp;wb_num=<?=$wb_num ?>&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category ?>&amp;b_look=<?=$b_look ?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>" >
				<img src="/pages/admin/images/bbs/btn_write_big.gif" alt="�۵��" />
			</a>
			<? 
		}
		?>
		<?
		if(($HTTP_SESSION_VARS[duid] == "" and $m_modify == "Y") or ($HTTP_SESSION_VARS[duid] == $b_id and $m_modify == "Y") or ($m_power == "2" and $m_modify == "Y") or $adminstrator == true) 
		{	//���� ����
			?>
			<a href="<?=$pageUrl?>&amp;page=/pages/admin/bbs/writeform.php&amp;wb_num=<?=$wb_num ?>&amp;mode=modify&amp;a_idx=<?=$a_idx ?>&amp;b_num=<?=$b_num ?>&amp;category=<?=$category ?>&amp;look=<?=$look ?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>" >
				<img src="/pages/admin/images/bbs/btn_modify_big.gif" alt="����" />
			</a>			
		<? 
		}
		?>
		<?
		if($a_reply == "Y" and (($m_reply == "Y" and $a_reply_type == "1" and $ref_step == "") or (($m_reply == "Y" and $a_reply_type == "0") and ($m_power == "2" or $adminstrator == true)))) 
		{	//�亯 ����
			?>
			<a href="<?=$pageUrl?>&amp;page=/pages/admin/bbs/writeform.php&amp;wb_num=<?=$wb_num ?>&amp;mode=reply&amp;a_idx=<?=$a_idx ?>&amp;b_num=<?=$b_num ?>&amp;category=<?=$category ?>&amp;look=<?=$look ?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>" >
				<img src="/pages/admin/images/bbs/btn_reply.gif" alt="�亯" />
			</a>
		<? 
		}
		?>
		<? 
		if(($a_reply_type == "1" and $ref_step == "") or $a_reply_type == "0") 
		{
			?>
			<a href="<?=$pageUrl?>&amp;page=/pages/admin/bbs/list.php&amp;wb_num=<?=$wb_num ?>&amp;a_idx=<?=$a_idx ?>&amp;category=<?=$category ?>&amp;look=<?=$look ?>&amp;search=<?=$search ?>&amp;keyword=<?=curlencode($keyword) ?>&amp;pageIdx=<?=$pageIdx ?>" >
				<img src="/pages/admin/images/bbs/btn_list_big.gif" alt="���" />
			</a>
			<?
		}
		?>
		<?
		if($wb_num == "")  
		{
			?>
			<?
			if($a_move == "Y" and (($m_write == "Y" and $m_power == "2") or $adminstrator == true)) 
			{	// ���̵� ���(�Խ��� �����ڸ� ���)  
				?>
				
				<?
			}		
		}
		?>

		<?
		if(($HTTP_SESSION_VARS[duid] == $b_id and $m_del == "Y") or ($m_power == "2" and $m_del == "Y") or $adminstrator == true) 
		{
			//���� ����?>
			<a href="javascript:bbs_delete_admin('wb_num=<?=$wb_num ?>&amp;mode=delete&amp;a_idx=<?=$a_idx ?>&amp;b_num=<?=$b_num ?>&amp;category=<?=$category ?>&amp;look=<?=$look ?>', '<?=$pageUrl?>')" >
				<img src="/pages/admin/images/bbs/btn_delete_big.gif" alt="����" />
			</a>
		<? 
		}
		elseif($b_id == "" and $m_del == "Y") 
		{
			?>
			<a href="<? if($b_open == 1 ) { ?>javascript:open_delete()<? } else { ?><?=$pageUrl?>&amp;page=/pages/admin/bbs/authform.php&amp;wb_num=<?=$wb_num ?>&amp;mode=delete&amp;a_idx=<?=$a_idx ?>&amp;b_num=<?=$b_num ?>&amp;category=<?=$category ?>&amp;look=<?=$look ?><? } ?>">
				<img src="/pages/admin/images/bbs/btn_delete_big.gif" alt="����" />
			</a>
			<? 
		}
	} 

	//*******************  Information  ***********************
	// �Լ����� : �ܱ��� Viewȭ�� ������
	//********************************************************* 
	Function View_Icon_01($value) {

		global $a_language, $a_idx, $a_tablename, $a_width, $a_skin, $a_reply, $a_move;
		global $m_write, $m_modify, $m_read, $m_reply, $m_del, $wb_num;
		global $HTTP_SESSION_VARS,$m_power, $adminstrator, $ref_step, $a_reply_type;
		global $category, $b_id, $look, $search, $keyword, $pageIdx, $b_open;

		$b_num = $value;

    if($a_language == 1) {
      $wStatus = "�����ۼ��ϱ�";
      $eStatus = "�����ϱ�";
      $rStatus = "�亯�ϱ�";
      $lStatus = "������� ����";
      $mStatus = "���̵�";
      $wStatus = "������ ���";
      $dStatus = "�����ϱ�";
    } else {

      $wStatus = "WRITE";
      $eStatus = "EDIT";
      $rStatus = "REPLY";
      $lStatus = "LIST";
      $mStatus = "MOVE";
      $wStatus = "WEBZINE";
      $dStatus = "DELETE";
    
    } 
	echo "asdf";
 	?>
	<table border="0" cellspacing="0" cellpadding="2" align="center">
		<tr> 
			<? if(($a_reply_type == "1" and $ref_step == "") and (($HTTP_SESSION_VARS[duid] == "" and $m_write == "Y") or ($HTTP_SESSION_VARS[duid] <> "" and $m_write == "Y") or $m_power == "2" or $adminstrator == true))  { //���� ����?>
			<td><a href="writeform.php?wb_num=<?=$wb_num ?>&a_idx=<?=$a_idx ?>&category=<?=$category ?>&b_look=<?=$b_look ?>&search=<?=$search ?>&keyword=<?=curlencode($keyword) ?>&pageIdx=<?=$pageIdx ?>" ><img src="/english/img/b_write.gif" border="0"></a></td>
			<? } ?>
			<? if(($HTTP_SESSION_VARS[duid] == "" and $m_modify == "Y") or ($HTTP_SESSION_VARS[duid] == $b_id and $m_modify == "Y") or ($m_power == "2" and $m_modify == "Y") or $adminstrator == true) { //���� ����?>
			<td><a href="<? if($b_open == 1 ) { ?>javascript:open_modify()<? } else { ?>writeform.php?wb_num=<?=$wb_num ?>&mode=modify&a_idx=<?=$a_idx ?>&b_num=<?=$b_num ?>&category=<?=$category ?>&look=<?=$look ?>&search=<?=$search ?>&keyword=<?=curlencode($keyword) ?>&pageIdx=<?=$pageIdx ?><? } ?>" ><img src="/english/img/b_edit.gif" border="0"></a></td>
			<? } ?>
			<? if($a_reply == "Y" and (($m_reply == "Y" and $a_reply_type == "1" and $ref_step == "") or (($m_reply == "Y" and $a_reply_type == "0") and ($m_power == "2" or $adminstrator == true)))) { //�亯 ����?>
			<td><a href="writeform.php?wb_num=<?=$wb_num ?>&mode=reply&a_idx=<?=$a_idx ?>&b_num=<?=$b_num ?>&category=<?=$category ?>&look=<?=$look ?>&search=<?=$search ?>&keyword=<?=curlencode($keyword) ?>&pageIdx=<?=$pageIdx ?>" ><img src="/english/img/b_reply.gif" border="0"></a></td>
			<? } ?>
			<td><? if(($a_reply_type == "1" and $ref_step == "") or $a_reply_type == "0") { ?><a href="list.php?wb_num=<?=$wb_num ?>&a_idx=<?=$a_idx ?>&category=<?=$category ?>&look=<?=$look ?>&search=<?=$search ?>&keyword=<?=curlencode($keyword) ?>&pageIdx=<?=$pageIdx ?>" ><img src="/english/img/b_list.gif" border="0"></a><? } ?></td>
<? if($wb_num == "")  {   ?>
      <? if($a_move == "Y" and (($m_write == "Y" and $m_power == "2") or $adminstrator == true)) {  // ���̵� ���(�Խ��� �����ڸ� ���)  ?>
      <td><a href='javascript:list_move("wb_num=<?=$wb_num ?>&a_idx=<?=$a_idx ?>&b_num=<?=$b_num ?>&look=<?=$look ?>&category=<?=$category ?>&search=<?=$search ?>&keyword=<?=curlencode($keyword) ?>&pageIdx=<?=$pageIdx ?>");' ><img src="/english/img/b_move.gif" border="0"></a></td>
			<? }  ?>
<? } ?>
      <? if($a_idx == "I_040204163945" and (($m_list == "Y" and $m_power == "2") or $adminstrator == true)) { ?>
			<td><a href="seminar_list.php?wb_num=<?=$wb_num ?>&a_idx=<?=$a_idx ?>&b_num=<?=$b_num ?>&category=<?=$category ?>&look=<?=$look ?>&search=<?=$search ?>&keyword=<?=curlencode($keyword) ?>&pageIdx=<?=$pageIdx ?>">aaaaa<img src="/bbs/image/icon/<?=$a_skin ?>/shview.gif" border="0"></a></td>
      <? } ?>
			<? if(($HTTP_SESSION_VARS[duid] == $b_id and $m_del == "Y") or ($m_power == "2" and $m_del == "Y") or $adminstrator == true) { //���� ����?>
			<td><a href="javascript:bbs_delete('wb_num=<?=$wb_num ?>&mode=delete&a_idx=<?=$a_idx ?>&b_num=<?=$b_num ?>&category=<?=$category ?>&look=<?=$look ?>')" ><img src="/english/img/b_delete.gif" border="0"></a></td>
			<? } elseif($b_id == "" and $m_del == "Y") { ?>
			<td><a href="<? if($b_open == 1 ) { ?>javascript:open_delete()<? } else { ?>authform.php?wb_num=<?=$wb_num ?>&mode=delete&a_idx=<?=$a_idx ?>&b_num=<?=$b_num ?>&category=<?=$category ?>&look=<?=$look ?><? } ?>" ><img src="/english/img/b_delete.gif" border="0"></a></td>
      <? } ?>
		</tr>
	</table>
<?  }

	//*******************  Information  ***********************
	// �Լ����� : �Խ��� �Ӹ���
	//*********************************************************
	 Function Bbs_Header() {
		 global $a_width, $a_header;
     global $mysql, $a_idx, $a_tablename, $category, $wb_num;

     if($a_idx == "I_040320094455")  {

        $sql =  " Select c_catename From bbs_admin_cate Where c_tablename='$a_tablename' and c_cate = '$category' ";
        $mysql->ParseExec($sql);
        $mysql->FetchInto(&$cate);

        $a_header = "<br>&nbsp;<font size=3 face=���� style=line-height:120%><b>".$cate[c_catename]."<b></font>";
     } 
     if($a_idx == "I_040226172647" and $wb_num <> "") {
        $a_header = "<br>&nbsp;<font size=3 face=���� style=line-height:120%><b>�����Ѹ���<b></font>";
     } 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	  <td><?=$a_header ?></td>
	</tr>
</table>	
<?  } 

	//*******************  Information  ***********************
	// �Լ����� : �Խ��� ������
	//*********************************************************
	Function Bbs_Detail() {
		 global $a_width, $a_detail;
?>
<table width="<?=$a_width ?>" border="0" cellspacing="0" cellpadding="0">
  <tr>
	  <td><?=$a_detail ?></td>
	</tr>
</table>
<?  } 

	//*******************  Information  ***********************
	// �Լ����� : �Խ��� top include
	//*********************************************************
	 Function Bbs_Top() {
		 global $a_include_top;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	  <td><? //include("..$a_include_top"); ?></td>
	</tr>
</table>
<?  } 

	//*******************  Information  ***********************
	// �Լ����� : �Խ��� left include
	//*********************************************************
	 Function Bbs_Left() {
		 global $a_include_left;
?>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
	  <td><?// include("..$a_include_left"); ?></td>
	</tr>
</table>
<?  } 

	//*******************  Information  ***********************
	// �Լ����� : �Խ��� right include
	//*********************************************************
	 Function Bbs_Reft() {
		 global $a_include_right;
?>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
	  <td><?// include("..$a_include_right"); ?></td>
	</tr>
</table>
<?  } 

	 //*******************  Information  ***********************
	// �Լ����� : �Խ��� bottom include
	//*********************************************************

	 Function Bbs_Bottom() {
		 global $a_include_bottom;
     
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	  <td><?// include("..$a_include_bottom"); ?></td>
	</tr>
</table>
<? } 
  
  //*******************  Information  ***********************
	// �Լ����� : ���Ϻ�����
	//*********************************************************

  Function Bbs_sendmail() {

    global $a_bbsname, $mode;
    global $b_subject, $b_content, $b_writer, $b_email, $t_email;

    $url = homepage_url(1);

    if ($mode == "reply") {
      $gubun = "�亯";
      $name  = "�����";
    } else {
      $gubun = "����";
      $name  = "�ۼ���";
    }

    $body   = "	<html> \n\n"; 
    $body  .= "	<head>\n\n"; 
    $body  .= "	<title>".$gubun."����</title>\n\n"; 
    $body  .= "	<meta http-equiv=Content-Type content=text/html; charset=euc-kr>\n\n"; 
    $body  .= "	<link rel=stylesheet type='text/css' href='$url/css/dip.css'>\n\n"; 
    $body  .= "	</head>\n\n"; 
    $body  .= "	<body topmargin=0 leftmargin=0>\n\n"; 
    $body  .= "	<table width=100% border=0 cellspacing=0 cellpadding=0>\n\n"; 
    $body  .= "	  <tr>\n\n"; 
    $body  .= "	    <td align=center bgcolor=F5F5F5><table width=600 border=0 cellspacing=0 cellpadding=0>\n\n"; 
    $body  .= "	        <tr>\n\n"; 
    $body  .= "	          <td width=600 height=92 align=right valign=bottom background=$url/images/mailling01.gif style=padding-right:20px><table width=200 border=0 cellspacing=0 cellpadding=0>\n\n"; 
    $body  .= "	              <tr>\n\n"; 
    $body  .= "	                <td align=right>*&nbsp; <strong>". $a_bbsname ." �Խ��� ".$gubun."����</strong></td>\n\n"; 
    $body  .= "	              </tr>\n\n"; 
    $body  .= "	            </table></td>\n\n"; 
    $body  .= "	        </tr>\n\n"; 
    $body  .= "	        <tr>\n\n"; 
    $body  .= "	          <td align=center valign=top background=$url/images/mailling02.gif><table width=552 border=0 cellspacing=0 cellpadding=0>\n\n"; 
    $body  .= "	              <tr> \n\n"; 
    $body  .= "	               <td height=25 colspan=2>&nbsp;</td>\n\n"; 
    $body  .= "	              </tr>\n\n"; 
    $body  .= "	              <tr> \n\n"; 
    $body  .= "	                <td width=38><strong>���� :</strong></td>\n\n"; 
    $body  .= "	                <td width=514 height=20>". $b_subject ."</td>\n\n"; 
    $body  .= "	              </tr>\n\n"; 
    $body  .= "	              <tr> \n\n"; 
    $body  .= "	                <td colspan=2><img src=$url/images/mailling_jum02.gif width=535 height=8></td>\n\n"; 
    $body  .= "	              </tr>\n\n"; 
    $body  .= "	              <tr> \n\n"; 
    $body  .= "	                <td height=20 colspan=2>&nbsp;</td>\n\n"; 
    $body  .= "	              </tr>\n\n"; 
    $body  .= "	              <tr>\n\n"; 
    $body  .= "	                <td colspan=2>".cnl2br($b_content)."</td>\n\n"; 
    $body  .= "	              </tr>\n\n"; 
    $body  .= "	              <tr> \n\n"; 
    $body  .= "	                <td height=20 colspan=2>&nbsp;</td>\n\n"; 
    $body  .= "	              </tr>\n\n"; 
    $body  .= "	              <tr align=right> \n\n"; 
    $body  .= "	                <td colspan=2><strong>".$name.":</strong> ". $b_writer ."</td>\n\n"; 
    $body  .= "	              </tr>\n\n"; 
    $body  .= "	              <tr> \n\n"; 
    $body  .= "	               <td colspan=2>&nbsp;</td>\n\n"; 
    $body  .= "	              </tr>\n\n"; 
    $body  .= "	            </table></td>\n\n"; 
    $body  .= "	        </tr>\n\n"; 
    $body  .= "	        <tr>\n\n"; 
    $body  .= "	          <td><img src=$url/images/mailling03.gif width=600 height=19></td>\n\n"; 
    $body  .= "	        </tr>\n\n"; 
    $body  .= "	      </table></td>\n\n"; 
    $body  .= "	  </tr>\n\n"; 
    $body  .= "	</table>\n\n"; 
    $body  .= "	</body>\n\n"; 
    $body  .= "	</html>\n\n"; 

    $mailheaders  = "X-Mailer: Webmail\r\n";
    $mailheaders .= "X-Priority: 3\r\n";
    if ($mode == "reply") {
      $mailheaders .= "From:�뱸�����л������� <". $b_email. ">\r\n";     
    } else {
      $mailheaders .= "From:".$b_writer." <". $b_email. ">\r\n"; 
    }
    $mailheaders .= "Return-Path: ".$b_email."\r\n";
    $mailheaders .= "Content-Type: text/html; charset=euc-kr\r\n"; 
    $mailheaders .= "Content-Transfer-Encoding: 8bit\r\n\r\n"; 
   
    $mailsubject = $gubun." �����Դϴ�";
    mail($t_email,$mailsubject,$body,$mailheaders);
  }

		 
?>
