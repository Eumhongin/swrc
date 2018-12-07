<?

	//*******************  Information  ***********************
	//	����	:	���й�ȣ Ȯ�� ����
	//*********************************************************


	function pwd_question()
		{
			global $v_arrpwd, $v_pwdcount;

			$v_arrpwd[0]  = "������ �����ϼ���.";
			$v_arrpwd[1]  = "���￡ ���� �߾��� ���Ҵ�?";
			$v_arrpwd[2]  = "�ڽ��� �λ� �¿�����?";
			$v_arrpwd[3]  = "�ڽ��� ���� ��1ȣ��?";
			$v_arrpwd[4]  = "���� ���￡ ���� ������ ������?";
			$v_arrpwd[5]  = "Ÿ���� �𸣴� �ڽŸ��� ��ü������ �ִٸ�?";
			$v_arrpwd[6]  = "�߾��ϰ� ���� ��¥�� �ִٸ�?";
			$v_arrpwd[7]  = "�޾Ҵ� ���� �� ���￡ ���� ��Ư�� ������?";
			$v_arrpwd[8]  = "�������� ���� �������� ģ�� �̸���?";
			$v_arrpwd[9]  = "�λ� ���� ���� å �̸���?";
			$v_arrpwd[10] = "�ڽ��� �ι�°�� �����ϴ� �ι���?";
			$v_arrpwd[11] = "���� å �߿��� �����ϴ� ������ �ִٸ�?";
			$v_arrpwd[12] = "ģ���鿡�� �������� ���� � �� ������ �ִٸ�?";
			$v_arrpwd[13] = "�ʵ��б� �� ���￡ ���� ¦�� �̸���?";
			$v_arrpwd[14] = "�ٽ� �¾�� �ǰ� ���� ����?";
			$v_arrpwd[15] = "���� �����ϴ� ĳ���ʹ�?";

			$v_pwdcount = count($v_arrpwd)-1;
		}


	//*******************  Information  ***********************
	//	����	:	���� ����Ʈ
	//*********************************************************
	function job()
		{
			global $v_arrjob, $v_jobcount;

			$v_arrjob[0] = "�Ϲݻ繫��";
			$v_arrjob[1] = "��������/���ͳ�";
			$v_arrjob[2] = "������";
			$v_arrjob[3] = "������";
			$v_arrjob[4] = "�ֺ�";
			$v_arrjob[5] = "�л�";
			$v_arrjob[6] = "��Ÿ";

			$v_jobcount = count($v_arrjob)-1;
		}

  //*******************  Information  ***********************
	//	����	:	���� ����Ʈ
	//*********************************************************
	function job_level()
		{
			global $v_arrjoblevel, $v_joblevelcount;

			$v_arrjoblevel[0] = "��ǥ";
			$v_arrjoblevel[1] = "�̻���";
			$v_arrjoblevel[2] = "������";
			$v_arrjoblevel[3] = "������";
			$v_arrjoblevel[4] = "������";
			$v_arrjoblevel[5] = "�븮��";
			$v_arrjoblevel[6] = "����";
		    $v_arrjoblevel[7] = "��Ÿ";

			$v_joblevelcount = count($v_arrjoblevel)-1;
		}

	//*******************  Information  ***********************
	//	����	:	�б�
	//*********************************************************
	function school()
		{
			global $v_arrschool, $v_schoolcount;

			$v_arrschool[0] = "��������";
			$v_arrschool[1] = "��������";
			$v_arrschool[2] = "��������";
			$v_arrschool[3] = "����";
			$v_arrschool[4] = "����";
			$v_arrschool[5] = "���п���";
			$v_arrschool[6] = "���п���";
			$v_arrschool[7] = "�ڻ�";
			$v_schoolcount = count($v_arrschool)-1;
		}

  //*******************  Information  ***********************
	//	����	:	�������� ī�װ���
	//*********************************************************
	function cal_category()
		{
			global $v_arrcal, $v_calcount;

			$v_arrcal[0] = "����/���̳�";
			$v_arrcal[1] = "����ȸ";
			$v_arrcal[2] = "������ġ����ȸ";
			$v_arrcal[3] = "�ܺαⰣ��������";
			$v_arrcal[4] = "���ָ�������";
			$v_arrcal[5] = "��Ÿ";

			$v_calcount = count($v_arrcal)-1;
		}

  //*******************  Information  ***********************
	// �Լ����� : �ΰ����� ���� (�Խ��� ����)
	//*********************************************************
	function Menu_Administrator($menuname) {
		global $administrator , $mysql;
		global $HTTP_SESSION_VARS;

		$pqry = "Select * From m_admin_menu as a, m_add_menu as b Where a.m_num = b.m_num and b.m_menutable='$menuname' and a.ad_level = '$HTTP_SESSION_VARS[duchmember]'";
		$mysql->ParseExec($pqry);

		if ($mysql->RowCount() > 0)  $administrator = true;
		else  $administrator = false;

		//�Ѱ�����
		if ($HTTP_SESSION_VARS[duchmember] == 99) $administrator = true;
	}


  //*******************  Information  ***********************
	//	����	:	�׷��� �ۼ�
	//*********************************************************
  function draw_graph() {
		global $num;
		global $graph;
		global $interval, $maxHeight;

    //�ִ밪���ϱ�
    $maxCount = 0;
    $minCount = 100000;

      for ($i = 0 ; $i<= $num - 1; $i++) {

        if ($maxCount  < $graph[$i][0] ) {
            $maxCount  = $graph[$i][0];
        }

        if ($minCount > $graph[$i][0]) {
            $minCount = $graph[$i][0];
        }

      }

      $g_height = strlen($maxCount);
      $div1 = "1";
      $div2 = "2";
      $div5 = "5";

      if( $g_height > 1 ) {

        if($g_height == 2 && $maxCount >=50) $maxleng = strlen($maxCount);
        else $maxleng =  strlen($maxCount) - 1;

        //�׷��� ���ݱ��ϱ�
        for($i = 1 ; $i < $maxleng ; $i++) {
           $div1 .= "0";
           $div2 .= "0";
           $div5 .= "0";
        }

      } else {

        $div1 = 1;

      }

      if(($maxCount / $div1) < 10 ) {
         $interval  = $div1;
         $maxHeight = ceil($maxCount/$div1) * $div1;
      } else if(($maxCount / $div2) < 10 ) {
        $interval = $div2;
        $maxHeight = ceil($maxCount/$div2) * $div2;
      } else {
        $interval = $div5;
        $maxHeight = ceil($maxCount/$div5) * $div5;
      }


  }

  //*******************  Information  ***********************
	//	����	:	HTML Tag�� �����ϴ� �Լ�, ���ڿ��� �����Ѵ�
	//*********************************************************
	function output_value($str) {
		$str = str_replace( "&gt;", ">",$str);
		$str = str_replace( "&lt;", "<",$str);
		$str = str_replace( "&quot;", "\"",$str);
		return $str;
	}// end function del_html


	//*******************  Information  ***********************
	//	����	:	HTML Tag�� �����ϴ� �Լ�, ���ڿ��� �����Ѵ�
	//  $num : 0 (�ʼ��׸�), 1
	//*********************************************************
	function input_value($field, $str, $num) {
		$str = str_replace( ">", "&gt;",$str);
		$str = str_replace( "<", "&lt;",$str);
		$str = str_replace( "\"", "&quot;",$str);

		if(trim($str) == "" and $num == 0 ) {
			error_go($field."��(��) �Է��Ͽ� �ֽʽÿ�",$n= -1);
		}

		return $str;
	}// end function input_value


	//*******************  Information  ***********************
	//	����	:	ū����ǥ�� �����ϴ� �Լ�, ���ڿ��� �����Ѵ�
	//*********************************************************
	function del_quot($str) {
		$str = str_replace( "\"", "&quot;",$str);
		return $str;
	}// end fu


	//*******************  Information  ***********************
	// �Լ����� : �����޼��� Ȯ�ι�ư�� ������������ �̵�
	//*********************************************************
	function error_go($msg,$n= -1)
	{
		echo("	<script type=\"text/javascript\">
						window.alert('$msg')
						history.go($n);
					</script>
				");
		exit;
	}// end function error_go


	//*******************  Information  ***********************
	// �Լ����� : Ư�� URL�� �̵�
	//*********************************************************
	function movepage($url,$target=-1)
	{
		echo("<script type=\"text/javascript\">");
		if ($target == -1) 	echo ("location.href = \"$url\"; ");
		else {
			echo ("$target.location.href = \"$url\"; ");
			if($target == "opener") echo ("	self.close(); ");
			}
		echo(" </script>");
  	exit;
	} // end function movepage


	//*******************  Information  ***********************
	// �Լ����� : ����â�� ������ ex) message("����â�� ��Ÿ���ϴ�");
	//*********************************************************
	function message($msg,$gubun=-1)
	{
		echo(" <script type=\"text/javascript\">");
		echo("		window.alert('$msg');");
		if ($gubun == -1) echo (" history.back(); ");
		else echo ("self.close(); ");
		echo(" </script>");
  	exit;
	} // end function message


	//*******************  Information  ***********************
	// �Լ����� : ����â�� ������, Ư�� URL�� �̵�
	//*********************************************************
	function message_url($msg,$url)
	{
		echo(" <script type=\"text/javascript\">");
		echo(" window.alert('$msg');");
		echo(" location.href = '$url'; ");
		echo(" </script>");
  	exit;
	} // end function message


  //*******************  Information  ***********************
	// �Լ����� : ����â�� ������, Ư������ URL�� �̵�(target = top)
	//*********************************************************
	function message_top_url($msg,$url)
	{
		echo(" <script type=\"text/javascript\">");
		echo(" window.alert('$msg');");
		echo(" top.location.href = '$url'; ");
		echo(" </script>");
  	exit;
	} // end function message

	//*******************  Information  ***********************
	// �Լ����� : urlencode(stripslashes($a)) �������� �����Ѵ�
	//*********************************************************
	function curlencode($str) {
	 $str = urlencode(stripslashes($str));
	 return $str;
	}

	//*******************  Information  ***********************
	// �Լ����� : stripslashes(nl2br($a)) �������� �����Ѵ�
	//*********************************************************
	function cnl2br($str) {
	 $str = stripslashes(nl2br(str_replace(" ","&nbsp;",$str)));
	 return $str;
	}


	//*******************  Information  ***********************
	// �Լ����� : ���� ����
	//*********************************************************

	function shorten_string($string, $maxlen,$shortenstr) {
	 $stringlen = strlen($string);
   $effectlen = $maxlen - strlen($shortenstr) ;
   if($stringlen < $maxlen)
		{  return $string ; }
   for($i = 0 ;$i <= $effectlen ; $i++)
	 { $laststr = substr($string, $i, 1) ;
       if( ord($laststr) > 127   )
		 $i++ ;
    }

   $retstr = substr($string, 0 , $i) ;
   return $retstr .= $shortenstr ;


 }


 //*******************  Information  ***********************
 // �Լ����� : ���� ����
 //*********************************************************

	function file_path() {

   //$path = "/home/dip/public_html/korean";
   $path = "C:/APM_Setup/htdocs/newworld";

	 return $path ;
 }


function homepage_url($lang) {

   if($lang == 1) {
    //$home_url = "http://www.dip.or.kr";
	$home_url = "http://renew.dip.or.kr";
	 } elseif($lang == 2) {
    $home_url = "http://english.dip.or.kr";
	 } elseif($lang == 3) {
    $home_url = "http://japanese.dip.or.kr";
   } elseif($lang == 4) {
    $home_url = "http://chinese.dip.or.kr";
   }
	 return $home_url ;
 }

//*******************  Information  ***********************
// �Լ����� : ���Ϻ�����(���񿹾�)
//*********************************************************

 Function Equip_sendmail($mail_date, $e_name) {
    global $HTTP_SESSION_VARS,$mysql;

    $pqry  = " Select user_name, email, in_ent from members ";
		$pqry .= " Where user_id='$HTTP_SESSION_VARS[duid]'";
		$mysql->ParseExec($pqry);
    $mysql->FetchInto($mail);

    $url = homepage_url(1);

    $body   = "	<html> \n\n";
    $body  .= "	<head>\n\n";
    $body  .= "	<title>���񿹾���û����</title>\n\n";
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
    $body  .= "	                <td align=right>*&nbsp; <strong>���񿹾� ��û����</strong></td>\n\n";
    $body  .= "	              </tr>\n\n";
    $body  .= "	            </table></td>\n\n";
    $body  .= "	        </tr>\n\n";
    $body  .= "	        <tr>\n\n";
    $body  .= "	          <td align=center valign=top background=$url/images/mailling02.gif><table width=552 border=0 cellspacing=0 cellpadding=0>\n\n";
    $body  .= "	              <tr> ";
    $body  .= "	                <td height=127 align=center><strong>".$HTTP_SESSION_VARS[duname]."</strong>(".$mail[in_ent].")���� <strong>".$mail_date."</strong><br><br> ".$e_name." ������ ������û�� �ϼ̽��ϴ�.<br></td>";
    $body  .= "	              </tr>";
    $body  .= "	              <tr>\n\n";
    $body  .= "	                <td><img src=$url/images/mailling03.gif width=600 height=19></td>\n\n";
    $body  .= "	             </tr>\n\n";
    $body  .= "	         </table></td>\n\n";
    $body  .= "	  </tr>\n\n";
    $body  .= "	</table>\n\n";
    $body  .= "	</body>\n\n";
    $body  .= "	</html>\n\n";

    $to = "dipalba@dip.or.kr,dchannel@dip.or.kr,diptech@dip.or.kr";
    //$to = "moocoo@dip.or.kr";
    $from_name = $mail[user_name];
    $from = $mail[email];
    $title = $HTTP_SESSION_VARS[duname]." ȸ���Բ��� ���� ��û�� �ϼ̽��ϴ�.";

    $mailheaders .= "Return-Path: $from\r\n";
    $mailheaders .= "From: $from_name < $from >\r\n";
    $mailheaders .= "Date:" . date("D, d M Y H:i:s ")."\r\n";
    $mailheaders .= "Reply-To: $from \r\n";
    $mailheaders .= "MIME-Version: 1.0\n";
    $mailheaders .= "Content-Type: text/html; charset=euc_kr\n";
    $mailheaders .= "Content-Transfer-Encoding: 8bit\r\n\r\n";

    mail($to,$title,$body,$mailheaders);

    mail("moocoo@dip.or.kr",$title,$body,$mailheaders);

 }

 function control_formdata($line) {
	 $line = trim($line);
	 $line = stripslashes($line);
	 $line = eregi_replace("<", "&lt;", $line);
	 $line = eregi_replace(">", "&gt;", $line);
	 $line = eregi_replace("\"", "&quot;", $line);
	 $line = eregi_replace("'", "''", $line);
	 return $line;
 }

 function tomoth_sendmail($b_num, $b_to, $b_writer, $b_email, $b_subject, $b_content) {


	#$to = "dipalba@dip.or.kr,dchannel@dip.or.kr,diptech@dip.or.kr";
	#$to = "tomoth@nate.com";
	$to = $b_to;
	$from_name = $b_writer;
	$from = $b_email;
	$title = $b_subject;

	$mailheaders .= "Return-Path: $from\r\n";
	$mailheaders .= "From: $from_name < $from >\r\n";
	$mailheaders .= "Date:" . date("D, d M Y H:i:s ")."\r\n";
	$mailheaders .= "Reply-To: $from \r\n";
	$mailheaders .= "MIME-Version: 1.0\n";
	$mailheaders .= "Content-Type: text/html; charset=euc_kr\n";
	$mailheaders .= "Content-Transfer-Encoding: 8bit\r\n\r\n";

	mail($to,$title,$b_content,$mailheaders);
	#echo "mail($to,$title,$b_content,$mailheaders)";
	#exit;

    #mail("moocoo@dip.or.kr",$title,$body,$mailheaders);

 }

 Function kimna_sendmail($b_num, $b_to, $b_writer, $b_email, $b_subject, $b_content){

	require("../mail/smtp.php");

	$smtp = new smtp_class;

	if(!function_exists("GetMXRR")){
			$_NAMESERVERS=array();
			include("getmxrr.php");
	}

	$smtp->host_name = "localhost";	//�ܺ� smtp ������ �����Ϸ��� $smtp->host_name = "�ܺ� smtp ���� IP" �Է�.
	$smtp->localhost = "localhost";
	$smtp->direct_delivery = 0;
	$smtp->debug=0;
	$smtp->user="";
	$smtp->realm="";
	$smtp->password="";

	$body = $b_content;
	$from = $b_email;
	$bodytext = stripslashes($body);
	$subject = $b_subject;
	$to = $b_to;

	if($smtp->SendMessage($from, array($to),
		array(
		"From : $from",
		"To : $to",
		"Subject : $subject",
		"Date : ".strftime("%a, %d %b %Y %H:%M:%S %Z")
	),
	"$bodytext"))
		$resultMsg = "������ �߼۵Ǿ����ϴ�.";
	else{
		//echo "$to Mail Send Failed!!nError: ".$smtp->error."n";
		$resultMsg = "���� �߼ۿ� �����Ͽ����ϴ�. \n\n ErrorCode : $smtp->error";
	}

	return $resultMsg;

 }


?>
