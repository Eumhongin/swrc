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
			return $this->getPageListA($pageURL, $parameter, $total, $WidthPageList, "<img src=\"/images/bbs/page_prev.gif\" alt=\"이전\" class=\"vmiddle\" />", "<img src=\"/images/bbs/page_next.gif\" alt=\"다음\" class=\"vmiddle\" />" );
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
					
					//맨앞 설정
					$pageList .= "<li class=\"b_first\">";
					$pageList .= "<a href=\"$pageURL&amp;pageIdx=1&amp;$parameter\">";
					$pageList .= "<img src=\"/images/bbs/page_first.gif\" alt=\"맨앞\" class=\"vmiddle\" /> ";
					$pageList .= "</a>";
					$pageList .= "</li>";

					$prev = $start-1;

					$pageList .= "<li class=\"b_prev\">";					
					$pageList .= "<a href=\"$pageURL&amp;pageIdx=";
					$pageList .= $prev;
					$pageList .= "&amp;";
					$pageList .= $parameter;
					$pageList .= "\">$prevTag</a> ";
					$pageList .= "</li>";

				}else{
					$pageList .= "<li class=\"b_first\">";
					$pageList .= "<img src=\"/images/bbs/page_first.gif\" alt=\"맨앞\" class=\"vmiddle\" /> ";
					$pageList .= "</li>";
					$pageList .= "<li class=\"b_prev\">";
					$pageList .= $prevTag;
					$pageList .= "</li>";
				}

				for($start; $start<=$end; $start++) {

					$pageList .= "<li>";
					$pageList .= "<a href=\"$pageURL&amp;pageIdx=";
					$pageList .= $start;
					$pageList .= "&amp;";
					$pageList .= $parameter;
					$pageList .= "\"";
					//선택된 페이지일경우
					if($this->pageIdx == $start){
						$pageList .= "class=\"pre\" ";
					}
					$pageList .= ">";
					$pageList .= $start;
					$pageList .= "</a>";
					$pageList .= "</li>";

				}
								
				if($totalPage > $end) {
					$next = $end + 1;

					$pageList .= "<li class=\"b_next\">";
					$pageList .= " <a href=\"$pageURL&amp;pageIdx=";
					$pageList .= $next;
					$pageList .= "&amp;";
					$pageList .= $parameter;
					$pageList .= "\">$nextTag</a>";
					$pageList .= "</li>";

				}else{
					$pageList .= "<li class=\"b_next\">";
					$pageList .= $nextTag;
					$pageList .= "</li>";
				}

				//맨뒤 설정
				if($totalPage > 0){
					$pageList .= "<li class=\"b_last\">";
					$pageList .= "<a href=\"$pageURL&amp;pageIdx=$totalPage&amp;$parameter\">";
					$pageList .= "<img src=\"/images/bbs/page_last.gif\" alt=\"맨뒤\" class=\"vmiddle\" /> ";
					$pageList .= "</a>";
					$pageList .= "</li>";
				}else{
					$pageList .= "<li class=\"b_last\">";
					$pageList .= "<img src=\"/images/bbs/page_last.gif\" alt=\"맨뒤\" class=\"vmiddle\" /> ";
					$pageList .= "</li>";
				}

			return $pageList;
		}           
    
    
    }
?>    