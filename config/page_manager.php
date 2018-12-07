<?php
	/****** ������ ���ҹ� *************************/

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
			return $this->getPageListA($pageURL, $parameter, $total, $WidthPageList, "<img src=\"/images/bbs/page_prev.gif\" alt=\"����\" class=\"vmiddle\" />", "<img src=\"/images/bbs/page_next.gif\" alt=\"����\" class=\"vmiddle\" />" );
		}
		
		function getPageListA($pageURL, $parameter, $total, $WidthPageList, $prevTag, $nextTag)
		{ 
				// ceil() �ø�, floor() ����

				global $totalPage;

				$totalPage = ($total == 0) ? 0:ceil($total/$this->PostPageList); //��ü ������ ����
				$widthPage = floor(($this->pageIdx-1)/$WidthPageList)+1;   
			

				/***************************************************************
				[1][2][3]>>
				<<[4][5][6]>>
				<<[7][8]            �Ʒ��ڵ�� �̿� ���� �۵���.
				***************************************************************/

				$start = ($widthPage-1) * $WidthPageList + 1;
				$end   = $widthPage * $WidthPageList;

				if($totalPage < $end)
				$end = $totalPage;

				/***************************************************************/

				$pageList = "";

				
				if($widthPage > 1) {
					
					//�Ǿ� ����
					$pageList .= "<li class=\"b_first\">";
					$pageList .= "<a href=\"$pageURL&amp;pageIdx=1&amp;$parameter\">";
					$pageList .= "<img src=\"/images/bbs/page_first.gif\" alt=\"�Ǿ�\" class=\"vmiddle\" /> ";
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
					$pageList .= "<img src=\"/images/bbs/page_first.gif\" alt=\"�Ǿ�\" class=\"vmiddle\" /> ";
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
					//���õ� �������ϰ��
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

				//�ǵ� ����
				if($totalPage > 0){
					$pageList .= "<li class=\"b_last\">";
					$pageList .= "<a href=\"$pageURL&amp;pageIdx=$totalPage&amp;$parameter\">";
					$pageList .= "<img src=\"/images/bbs/page_last.gif\" alt=\"�ǵ�\" class=\"vmiddle\" /> ";
					$pageList .= "</a>";
					$pageList .= "</li>";
				}else{
					$pageList .= "<li class=\"b_last\">";
					$pageList .= "<img src=\"/images/bbs/page_last.gif\" alt=\"�ǵ�\" class=\"vmiddle\" /> ";
					$pageList .= "</li>";
				}

			return $pageList;
		}           
    
    
    }
?>    