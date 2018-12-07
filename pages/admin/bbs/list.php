<?
	include("../../config/bbs_lib.inc.php");  
	include("../../config/comm.inc.php"); 
	include("../../config/mysql.inc.php"); 

	$mysql = new Mysql_DB;
	$mysql->Connect();

	$a_idx = $_REQUEST["a_idx"];
	$category = $_REQUEST["category"];
	$keyword = $_REQUEST["keyword"];
	$search = $_REQUEST["search"];
	$b_num = $_REQUEST["b_num"];
	$real_num = $_REQUEST["b_num"];
	$look = $_REQUEST["look"];
	$mnu_name = $_REQUEST["mnu_name"];
	$pageIdx = $_REQUEST["pageIdx"];
	$wb_num = $_REQUEST["wb_num"];

	// *** 게시판 환경 **** 
	Bbs_Config($a_idx);

	// *** 리스트 보기 권한 ***
	if($adminstrator == false) {

		if($HTTP_SESSION_VARS[duchmember] <> "") {
			if ($m_list == "N") { 
				message("읽기 권한이 존재하지 않습니다");
			}
		} else {
		  if ($m_list == "N") message("로그인 후 이용이 가능합니다.",$gubun=-1);		  
		}
	}

	if($adminstrator == true) {

		if($HTTP_SESSION_VARS[duchmember] <> "") {
			

		} else {
      
			if ($m_list == "N") message("로그인 후 이용이 가능합니다.",$gubun=-1);
		}
	}
?>

<?
//게시판 리스트
include("list.inc.php"); 
?>