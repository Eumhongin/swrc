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

	// *** �Խ��� ȯ�� **** 
	Bbs_Config($a_idx);

	// *** ����Ʈ ���� ���� ***
	if($adminstrator == false) {

		if($HTTP_SESSION_VARS[duchmember] <> "") {
			if ($m_list == "N") { 
				message("�б� ������ �������� �ʽ��ϴ�");
			}
		} else {
		  if ($m_list == "N") message("�α��� �� �̿��� �����մϴ�.",$gubun=-1);		  
		}
	}

	if($adminstrator == true) {

		if($HTTP_SESSION_VARS[duchmember] <> "") {
			

		} else {
      
			if ($m_list == "N") message("�α��� �� �̿��� �����մϴ�.",$gubun=-1);
		}
	}
?>

<?
//�Խ��� ����Ʈ
include("list.inc.php"); 
?>