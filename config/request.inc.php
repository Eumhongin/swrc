<?
	/************************/
	//rquest ���� �Լ�
	/************************/

	//ù��° �Ķ���� ���� ���� ��� �ι�° �Ķ���� ������ �����Ѵ�.
	function getParameter($str, $returnStr){
		if($str == ""){
			$str = $returnStr;	
		}
		return $str;
	}

	//�Ķ���� ����
	function parameterCheck($str){

		$str = eregi_replace("script", "", $str);
		$str = eregi_replace("select", "", $str);
		$str = eregi_replace("drop", "", $str);
		//$str = eregi_replace("delete", "", $str);
		$str = eregi_replace("from", "", $str);
		//$str = eregi_replace("'", "��", $str);
		//$str = eregi_replace("\"", "��", $str);
		//$str = eregi_replace(".php", "", $str);
		//$str = eregi_replace("//", "", $str);
		$str = eregi_replace("exec", "", $str);
		$str = eregi_replace("cookie", "", $str);

		return $str;
	}

?>