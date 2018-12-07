<?
	/************************/
	//rquest 관련 함수
	/************************/

	//첫번째 파라미터 값이 없을 경우 두번째 파라미터 값으로 리턴한다.
	function getParameter($str, $returnStr){
		if($str == ""){
			$str = $returnStr;	
		}
		return $str;
	}

	//파라미터 보안
	function parameterCheck($str){

		$str = eregi_replace("script", "", $str);
		$str = eregi_replace("select", "", $str);
		$str = eregi_replace("drop", "", $str);
		//$str = eregi_replace("delete", "", $str);
		$str = eregi_replace("from", "", $str);
		//$str = eregi_replace("'", "＇", $str);
		//$str = eregi_replace("\"", "＂", $str);
		//$str = eregi_replace(".php", "", $str);
		//$str = eregi_replace("//", "", $str);
		$str = eregi_replace("exec", "", $str);
		$str = eregi_replace("cookie", "", $str);

		return $str;
	}

?>