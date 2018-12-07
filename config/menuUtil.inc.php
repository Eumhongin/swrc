<?php
	function plusCode($code, $depth, $plus) {
		

		$leftCode = substr($code, 0, (($depth) * 3));
		$centerNum = substr($code, ($depth) * 3, $depth *3 );
		//중간 증가
		$centerNum += $plus;
		$centerNum = "0"."0".$centerNum;
		
		$rightCode = substr($code, $depth, 3);

		return $leftCode.$centerNum.$rightCode;
	}

?>