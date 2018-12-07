<?php
	//*******************  Information  ***********************
	//	Program Title	:	MysqlClass
	//	File Name		  :	mysql.inc.php
	//	Creator			  :	�� �� �� 2011.01.18
	//*********************************************************

	////////// Mysq Class///////////////////////////////////////////////////////////////////////////////
	class Mysql_DB
	{
		var $conn = FALSE;
		var $stmt = 0;
		var $abstractData = FALSE;
		var $error = FALSE;
		var $db_name;
		var $db_host;
		var $mysql_id;
		var $mysql_passwd;
		var $db;

		function Mysql_DB() {
			$this->db_host = "localhost";
			$this->db_name = "strc";
			$this->mysql_id = "root";
			$this->mysql_passwd = "admin";
		}

		function Connect(){

			$this->conn = mysql_connect($this->db_host,$this->mysql_id,$this->mysql_passwd);
			$this->db = mysql_select_db($this->db_name,$this->conn) ;

		}


		function ListTables(){
			$this->stmt = mysql_list_tables($this->db_name,$this->conn);
			return $this->stmt ;
		}

		function ParseExec($qry){
			$this->stmt = mysql_query($qry,$this->conn);
			$this->error = mysql_error($this->conn) ;
			if($this->error){
 				$this->Disconnect();
			}
		}


		function RowCount(){
			return mysql_num_rows($this->stmt);
		}

		function FetchInto(&$col,$mode=MYSQL_ASSOC){
			$col = mysql_fetch_array($this->stmt,$mode);
			return $col ;
		}

		function DataSeek($num){
			$col = mysql_data_seek($this->stmt,$num);
			return $col ;
		}

		function Result($i){
			return mysql_result($this->stmt,$i);
		}


		function ParseFree(){
			mysql_free_result($this->stmt) ;
		}

		function Disconnect(){
			if($this->error) {
				/*
				echo ("<script type=\"text/javascript\">
				alert(\"DB ���ῡ �����߽��ϴ�!\\n\\n $this->error\");
				history.go(-1);
				</script>");
				*/
				//echo $this->error;
			}
			//mysql_close($this->conn);
		}

	} // end class


////////// ������豸�ϱ�///////////////////////////////////////////////////////////////////////////////

	if(!$HTTP_COOKIE_VARS["VCounter_Cookie"]){

		//setcookie("VCounter_Cookie","checked",0,"/");

		$count = New MySql_DB();
		$count->connect();


		$temp = split(";",$HTTP_USER_AGENT);

		if (count($temp) > 1 ) {
			$vIp      = $REMOTE_ADDR;
			$vYY      = Date("Y");
			$vMM      = Date("m");
			$vDD      = Date("d");
			$vHH      = Date("H");
			$vMT      = Date("i");
			$vDw      = Date("w");
			$vBrowser = $temp[1];
			$vOs      = str_replace(")","",$temp[2]);

			Switch($vMM) {
				Case "3"  :	$vSeason = 1; break;
				Case "4"  :	$vSeason = 1; break;
				Case "5"  :	$vSeason = 1; break;
				Case "6"  :	$vSeason = 2; break;
				Case "7"  :	$vSeason = 2; break;
				Case "8"  :	$vSeason = 2; break;
				Case "9"  :	$vSeason = 3; break;
				Case "10" :	$vSeason = 3; break;
				Case "11" :	$vSeason = 3; break;
				Case "12" :	$vSeason = 4; break;
				Case "1"  :	$vSeason = 4; break;
				Case "2"  :	$vSeason = 4; break;

		  }
			$cqry  = " Insert Into visit_counter(vIP, vYY, vMM, vDD, vHH, vMT, vDw, vBrowser, vOS, vSeason)";
			$cqry .= " Values('$vIp', $vYY, $vMM, $vDD, $vHH, $vMT, $vDw, '$vBrowser', '$vOs', '$vSeason')";
			$count->parseExec($cqry);

		}

		$count->Disconnect();


	}



///////////////////////////////////���ڵ� �Լ�

	function euckrToUtf8($iptChar){
		return iconv("EUC-KR", "UTF-8", $iptChar);
	}

	function utf8ToEuckr($iptChar){
		return iconv("UTF-8", "EUC-KR", $iptChar);
	}


?>
