<?

	//pageUrl 셋팅
	$pageUrl .= $pageName;

	include("../../config/mysql.inc.php");  
	include("../../config/comm.inc.php");  

	$mysql = new Mysql_DB;
	$mysql->Connect();
	
	$mode = $_REQUEST["mode"];
	$pageIdx = $_REQUEST["pageIdx"];
	$search = $_REQUEST["search"];
	$keyword = $_REQUEST["keyword"];
	$keyword2 = $_REQUEST["keyword2"];
	$user_id = $_REQUEST["user_id"];
	$user_name = euckrToUtf8($_REQUEST["user_name"]);
	$ch_member = $_REQUEST["ch_member"];
	$user_num = $_REQUEST["user_num"];
	$email = $_REQUEST["email"];
	$tel1 = $_REQUEST["tel1"];
	$tel2 = $_REQUEST["tel2"];
	$tel3 = $_REQUEST["tel3"];
	$hp1 = $_REQUEST["hp1"];
	$hp2 = $_REQUEST["hp2"];
	$hp3 = $_REQUEST["hp3"];
	$user_pass = $_REQUEST["user_pass"];	
	
	if($mode == "insert"){

		$qry = "Insert Into members";
		$qry = $qry. "  (user_id, user_pass, user_name ,user_num, email, tel1, tel2, tel3,";
		$qry = $qry. "   hp1, hp2, hp3, in_day, ch_member)";
		$qry = $qry. " Values('$user_id','$user_pass','$user_name','$user_num','$email','$tel1','$tel2','$tel3',";
		$qry = $qry. " '$hp1', '$hp2','$hp3', now(), $ch_member)";
		$mysql->ParseExec($qry); 

		message_url("등록되었습니다.","$pageUrl&page=/pages/admin/member/list.php&user_id=$user_id&user_flag=$not_user&pageIdx=$pageIdx&search=$search&keyword=$keyword");

	}else if($mode == "update"){

		$qry  = " Update members Set ";
		$qry .= "                    user_pass      = '$user_pass', ";
		$qry .= "                    user_name      = '$user_name', ";
		$qry .= "                    ch_member		= '$ch_member', ";
		$qry .= "                    user_num		= '$user_num', ";
		$qry .= "                    email			= '$email', ";
		$qry .= "                    tel1			= '$tel1', ";
		$qry .= "                    tel2			= '$tel2', ";
		$qry .= "                    tel3			= '$tel3', ";
		$qry .= "                    hp1			= '$hp1', ";
		$qry .= "                    hp2			= '$hp2', ";
		$qry .= "                    hp3			= '$hp3' ";
		$qry .= " Where user_id = '$user_id'";
		$mysql->ParseExec($qry); 

		message_url("수정이 성공적으로 이루어졌습니다","$pageUrl&page=/pages/admin/member/list.php&user_id=$user_id&pageIdx=$pageIdx&search=$search&keyword=$keyword");
	}else{
		message("잘못된 경로로 접근하셨습니다.");
	}

?>

