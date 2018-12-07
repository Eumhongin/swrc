<?php
	/****** 페이지 분할법 *************************/

	class initPage
	{
		var $pageIdx;
		var $PostPageList;
	
		function initPage($pageIdx,$PostPageList)
		{
		    $this->pageIdx = $pageIdx;
		    $this->PostPageList = $PostPageList;
	     
		}    
		function getPageList ( $pageURL, $parameter, $total, $WidthPageList )
		{
			return $this->getPageListA($pageURL, $parameter, $total, $WidthPageList, "<img src=\"/bbs/image/list_pre2.gif\" width=\"15\" height=\"15\" />", "<img src=/bbs/image/list_next2.gif width=15 height=15 />" );
		}
		
		function getPageListA($pageURL, $parameter, $total, $WidthPageList, $prevTag, $nextTag)
		{ 
				// ceil() 올림, floor() 내림

				global $totalPage;

				$totalPage = ($total == 0) ? 0:ceil($total/$this->PostPageList); //전체 페이지 갯수
				$widthPage = floor(($this->pageIdx-1)/$WidthPageList)+1;   
			

				/***************************************************************
				[1][2][3]>>
				<<[4][5][6]>>
				<<[7][8]            아래코드는 이와 같이 작동함.
				***************************************************************/

				$start = ($widthPage-1) * $WidthPageList + 1;
				$end   = $widthPage * $WidthPageList;

				if($totalPage < $end)
				$end = $totalPage;

				/***************************************************************/

				$pageList = "";

				if($widthPage > 1) {
					$prev = $start-1;
					
					$pageList .= "<a href='$pageURL?pageIdx=";
					$pageList .= $prev;
					$pageList .= "&";
					$pageList .= $parameter;
					$pageList .= "'>$prevTag</a> ";

				}else{
					//$pageList .= $prevTag; 
				}

				$bar = 1 ;
				for($start; $start<=$end; $start++) {

					if($bar > 1 ) $pageList .=  " | ";

					if($this->pageIdx==$start)
						$pageList .= "<strong>".$start."</strong> ";
					else {
						$pageList .= "<a href='$pageURL?pageIdx=";
						$pageList .= $start;
						$pageList .= "&";
						$pageList .= $parameter;
						$pageList .= "'>$start</a>";
					}
					
					$bar ++ ;

				}

				if($totalPage > $end) {
					$next = $end + 1;

					$pageList .= " <a href='$pageURL?pageIdx=";
					$pageList .= $next;
					$pageList .= "&";
					$pageList .= $parameter;
					$pageList .= "'>$nextTag</a>";

				} else {
					//$pageList .= $nextTag; 
				}
					return $pageList;
				}           
    
    
    }
?>    