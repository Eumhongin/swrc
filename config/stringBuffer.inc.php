<?php

	class stringBuffer{
		var $str = "";
		
		function init(){
			$this->str = "";
		}

 		function append($s){
			$this->str.= $s;
		}

		function getStringValue(){
			return $this->str;
		}
	}

?>