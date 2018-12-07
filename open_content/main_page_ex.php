<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>공지사항</title>
<link rel="stylesheet" type="text/css" href="../../css/common.css"/>
<link rel="stylesheet" type="text/css" href="../../css/layout.css"/>
<link rel="stylesheet" type="text/css" href="../../css/contents.css"/>
<link rel="stylesheet" type="text/css" href="../../css/board.css"/>
<script type="text/javascript" src="/js/common.js"></script>
<!-- <script type="text/javascript" src="/js/prototype.js"></script> -->
<script type="text/javascript" src="/js/member.js" ></script>

<script type="text/javascript" src="/js/jquery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/jquery/jquery.cookie.js"></script>
<script type="text/javascript" src="/js/jquery/zoom.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	try { 
		
		$(document).browserZoom({
			curr: $.cookie("dip_zoom_curr")
		});
	} catch(e) {
	}
});
</script>
</head>

<body class="sub">

<div id="accessibility">
    <ul>
        <li><a href="#topLogo">로고 바로가기</a></li>
        <li><a href="#topMenu">메인메뉴 바로가기</a></li>
        <li><a href="#subMenu">서브메뉴 바로가기</a></li>
        <li><a href="#subContents">본문내용 바로가기</a></li>
        <li><a href="#bottomCopy">하단메뉴 바로가기</a></li>
    </ul>
</div>
<hr/>

<div id="Wrap">

	<div id="topWrap">

	<div id="topLogo">
		<h1><a href="/"><img src="/images/common/logo.gif" alt="(재)대구디지털산업진흥원" /></a></h1>
	</div>
<script type="text/javascript">
	function fncSearchCheck(){
		if(formTopSearch.searchword.value == "Search" || formTopSearch.searchword.value == ""){
			alert("검색어를 입력하여 주세요.");
			formTopSearch.searchword.value = "";
			formTopSearch.searchword.focus();
			return false;
		}
		return true;
	}
</script>
		<div id="topUtilMenu">
			<ul>
				<li>
					<form name="formTopSearch" method="post" onsubmit="return fncSearchCheck();" action="/open_content/sub.php?menuIdx=109" style="display:inline;" >
					<div class="t_search">
						<input type="text" id="searchword" name="searchword" value="Search" onclick="formTopSearch.searchword.value = ''; return false;" title="검색어" class="aa"/>
						<input type="image" class="vmiddle" src="/images/common/btn_search.gif" alt="검색" />
					</div>
					</form>
				</li>
				<li>
					<div class="t_font">
						<h2 class="floatleft">
							<img src="/images/common/fontsize.gif" alt="글자크기" />
						</h2>
						<p class="floatleft">
							<a href="#" class="browserZoomIn" onclick="return false;"><img src="/images/common/fontsize_zoomin.gif" alt="글자확대" /></a>
						</p>
						<p class="floatleft">
							<a href="#" class="browserZoomOut" onclick="return false;"><img src="/images/common/fontsize_zoomout.gif" alt="글자축소" /></a>
						</p>
						<!-- 
						<p class="floatleft">
							<a href="#self" onclick="screenZoom('in'); return false;"><img src="/images/common/fontsize_zoomin.gif" alt="글자확대" /></a>
						</p>
						<p class="floatleft">
							<a href="#self" onclick="screenZoom('out'); return false;"><img src="/images/common/fontsize_zoomout.gif" alt="글자축소" /></a>
						</p> 
						-->
					</div>
				</li>
				<li>
					<ul class="t_navi">
												<li class="fcolor">
							<img src="/images/common/icon_key.gif" alt="" class="vmiddle" />
							<a href="/open_content/sub.php?menuIdx=69">로그인</a>
						</li>
						<li>
							<a href="/open_content/sub.php?menuIdx=70">회원가입</a>
						</li>
												<li class="bgnone">
							<a href="/open_content/sub.php?menuIdx=127">사이트맵</a>
						</li>
					</ul>
				</li>
				<li>
					<h2 class="none">외국어사이트</h2>
					<ul class="t_global">
						<li class="mar_l3">
							<a href="/english/open_content/main_page.php"><img src="/images/common/tmenu_eng.gif" alt="English" /></a>
						</li>
						<li class="mar_l3">
							<a href="/chinese/open_content/main_page.php"><img src="/images/common/tmenu_chi.gif" alt="中國語" /></a>
						</li>
						<li class="mar_l3">
							<a href="/japanese/open_content/main_page.php"><img src="/images/common/tmenu_jpn.gif" alt="日本語" /></a>
						</li>
					</ul>
				</li>
			</ul>
        </div>

		<ul id="topMenu">

		<li><a href="sub.php?menuIdx=11">
			<img src="/images/common/menu_1_off.gif" alt="진흥원소개" />
			</a>
		<ul>
						<li class="f_sm_1"><a href="./sub.php?menuIdx=11" >인사말</a></li>
<li><a href="./sub.php?menuIdx=23" >설립목적 및 연혁</a></li>
<li><a href="./sub.php?menuIdx=25" >조직구성 및 약도</a></li>
<li><a href="./sub.php?menuIdx=27" >홍보자료</a></li>
<li><a href="./sub.php?menuIdx=43" >주요사업소개</a></li>
<li><a href="./sub.php?menuIdx=29" >ICT Park란?</a></li>
					</ul></li>		<li><a href="./sub.php?menuIdx=52">
			<img src="/images/common/menu_2_off.gif" alt="IT·CT 산업정보" />
			</a>
		<ul>
						<li class="f_sm_2"><a href="./sub.php?menuIdx=52" >공지사항</a></li>
<li><a href="./sub.php?menuIdx=30" >정부정책/자금지원</a></li>
<li><a href="./sub.php?menuIdx=31" >입찰정보</a></li>
<li><a href="./sub.php?menuIdx=32" >교육일정안내</a></li>
<li><a href="./sub.php?menuIdx=53" >유관기관 공고</a></li>
					</ul></li>		<li><a href="./sub.php?menuIdx=54">
			<img src="/images/common/menu_3_off.gif" alt="전문가 POOL" />
			</a>
		<ul>
						<li class="f_sm_3"><a href="./sub.php?menuIdx=54" >포럼안내</a></li>
<li><a href="./sub.php?menuIdx=34" >유관기관</a></li>
					</ul></li>		<li><a href="./sub.php?menuIdx=36">
			<img src="/images/common/menu_4_off.gif" alt="기업지원시스템" />
			</a>
		<ul>
						<li class="f_sm_4"><a href="./sub.php?menuIdx=36" >입주기업</a></li>
<li><a href="./sub.php?menuIdx=60" >입주안내</a></li>
<li><a href="./sub.php?menuIdx=64" >입주신청</a></li>
<li><a href="./sub.php?menuIdx=38" >자료실</a></li>
<li><a href="./sub.php?menuIdx=39" >참여광장</a></li>
<li><a href="./sub.php?menuIdx=40" >클린신고센터</a></li>
					</ul></li>		</ul><!--topMenu End-->

		<script type="text/javascript">
		//<![CDATA[
			initNavigation(2);
		//]]>
		</script>
		
	<hr/>	 </div><!--topWrap End-->


    <div id="subWrap">

        <div id="subMenu">
<h2><img src="/images/itct/left_title.gif" alt="IT·CT 산업정보" /></h2>
						<ul>												
						<li class="sm_on" ><a href="./sub.php?menuIdx=52"  >공지사항</a> 						
					</li >												
						<li ><a href="./sub.php?menuIdx=30"  >정부정책/자금지원</a> 						
					</li >												
						<li ><a href="./sub.php?menuIdx=31"  >입찰정보</a> 						
					</li >												
						<li ><a href="./sub.php?menuIdx=32"  >교육일정안내</a> 						
					</li >												
						<li ><a href="./sub.php?menuIdx=53"  >유관기관 공고</a> 						
					</li>
		</ul>
        </div><!--subMenu End-->


        <hr/>

        <div id="subContents">
			<p id="subVisual"><img src="/images/common/visual_sub_itct.jpg" alt="" /></p>	<div id="ContLocation">
		<p class="cont">HOME &gt; IT·CT 산업정보 &gt; <span class="cont_state">공지사항</span></p>
	</div>
	<h3 id="ContTitle"><img src="/images/itct/title04_01.gif" alt="공지사항" /></h3>

	<div id="Contents">
<p class="bu_attention">
					<span class="f_14 f_orange"><strong>(재)대구디지털산업진흥원의 공지사항 게시판입니다.</strong></span><br/>
					공지, 교육, 행사에 대한 정보를 제공하고 있습니다.
				</p><script type="text/javascript" src="/pages/bbs/js/comm.js"></script>

		<div class="bbsView">
			<table class="wps_100" summary="공지사항 및 뉴스 상세내용">
				<caption class="none">공지사항 및 뉴스</caption>
				<colgroup>
					<col width="15%" />
					<col width="35%" />
					<col width="15%" />
					<col width="35%" />
				</colgroup>
				<tbody>
					<tr>
						<th scope="row">제목</th>
						<td colspan="3">
						 [공지] 						<strong>e-fun 2011 계획수립을 위한 수요조사</strong></td>
					</tr>
															<tr>
						<th scope="row">이메일</th>
						<td colspan="3">lyj@dip.or.kr</td>
					</tr>
															<tr>
						<th scope="row">등록일</th>
						<td>2011-01-31</td>
						<th scope="row">조회수</th>
						<td>4109</td>
					</tr>
					<tr>
						<th scope="row">작성자</th>
						<td>관리자</td>
						<th scope="row">첨부</th>
						<td>
																	<form name="file" method="post" target="_self">
										<input type="hidden" name="path" value="I_040204163945" />
										<input type="hidden" name="num" value="" />
																							<input type="hidden" name="file1" value="e-fun 2011수요조사서.hwp">
													<img src="/images/bbs/icon_file.gif" alt="" class="vmiddle" />
													<a href="javascript:FileDownload('1')">e-fun 2011수요조사서.hwp</a>
																						</form>
															</td>
					</tr>
									</tbody>
			</table>

			<div class="article" title="게시물내용">
								<HTML>
<HEAD>
<META name=GENERATOR content="TAGFREE Active Designer v2.0">
</HEAD>
<BODY style="FONT-SIZE: 10pt"><!--StartFragment--><SPAN><!--StartFragment-->&nbsp;<SPAN style="FONT-FAMILY: '한컴바탕'"><STRONG><IMG style="WIDTH: 528px; HEIGHT: 92px" border=0 src="http://www.dip.or.kr/up_file/bbs/UNI00000718b9e4.gif" width=658 height=99><BR>
</STRONG></SPAN></SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt; FONT-WEIGHT: bold"><BR>
□ 개 요</SPAN> 
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt; FONT-WEIGHT: bold">&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">o</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt; FONT-WEIGHT: bold"> 조사명 : e-fun 2011 계획수립을 위한 수요조사</SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt; FONT-WEIGHT: bold">&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">o 목 적<BR>
</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">&nbsp;&nbsp;&nbsp;&nbsp;- 지역기업의 수요를 파악하여 e-fun 2011 계획수립에 반영<BR>
</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">&nbsp;&nbsp;&nbsp;&nbsp;- 참여형 프로그램 개발을 통한 지역기업 참여율 제고</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 휴먼명조,한컴돋움; FONT-SIZE: 14pt"><BR>
</SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt; FONT-WEIGHT: bold">□ 조사일정</SPAN></P>
<P style="LINE-HEIGHT: 180%; TEXT-INDENT: -37.6pt; MARGIN-LEFT: 37.6pt" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt"><!--StartFragment--></P>
<P style="LINE-HEIGHT: 180%; TEXT-INDENT: -37.6pt; MARGIN-LEFT: 37.6pt" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt"><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">&nbsp;&nbsp;o </SPAN>조사기간: 2011년 1월 31일(월) ~ 2월 8일(화)까지<BR>
<BR>
</P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt; FONT-WEIGHT: bold">□ 제출방법<BR>
</SPAN><BR>
<SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt"><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">&nbsp;&nbsp;o </SPAN></SPAN>제출방법: 담당자 이메일(<A href="mailto:lyj@dip.or.kr">lyj@dip.or.kr</A>)로 전달&nbsp;<BR>
&nbsp; o 담당자 : 대구디지털산업진흥원 CT사업팀 이영준 책임<BR>
&nbsp;&nbsp;&nbsp; - TEL)053-655-5625</SPAN></SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt; FONT-WEIGHT: bold">□ e-fun 2011 행사계획(안)</SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt; FONT-WEIGHT: bold">&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">o 개 요</SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">&nbsp;&nbsp;- 행 사 명 : e-fun 2011<BR>
</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">&nbsp;&nbsp;- 행사기간 : 2011년 5월 12일(목) ~ 14일(토)<BR>
</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">&nbsp;&nbsp;- 주&nbsp;&nbsp;&nbsp; 제 : 차세대 디지털 융합 콘텐츠 발전전략<BR>
</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">&nbsp; - 주&nbsp;&nbsp;&nbsp; 최 : 대구광역시<BR>
&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">- 주&nbsp;&nbsp;&nbsp; 관 : 대구디지털산업진흥원(DIP)<BR>
&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">- 장&nbsp;&nbsp;&nbsp; 소 : 대구전시컨벤션센터(EXCO)</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 휴먼명조,한컴돋움; FONT-SIZE: 6pt"><BR>
</SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">&nbsp;&nbsp;o 행사내용</SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle1><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">&nbsp; - </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; LETTER-SPACING: 0.6pt; FONT-SIZE: 10pt">e-fun 2011 &amp; 디지털케이블TV쇼 전시&#61600;체험행사<BR>
&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; FONT-SIZE: 10pt">- 차세대 디지털 융합 콘텐츠 발전전략 컨퍼런스 개최<BR>
&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; LETTER-SPACING: 0.6pt; FONT-SIZE: 10pt">- 융합 콘텐츠 비즈니스 상담회<BR>
&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: 굴림; LETTER-SPACING: 0.6pt; FONT-SIZE: 10pt">- 연계행사(콘서트, 패션쇼, 게임대회, 청소년 체험활동 등)<BR>
<BR>
<BR>
<BR>
</SPAN></P><STRONG><SPAN style="COLOR: #0000ff">※ 수요조사서를 제출해주시는 분 중 10분을 추첨으로 선정하여,<BR>
&nbsp;</SPAN><BR>
<SPAN style="COLOR: #0000ff">최고급 블루투스(SAMSUNG HM1600, 5개), e-fun 티셔츠(5개) 증정</SPAN><BR>
<BR>
<SPAN style="COLOR: #0000ff">당첨자는 이펀 홈페이지(http://www.efun.or.kr) 공지</SPAN><BR>
</STRONG><BR>
<BR>
</BODY></HTML> 			</div><!-- //article -->
		</div><!--//bbsView -->
	

			<div class="bbsBtn">
														<p>
				<a href="/open_content/sub.php?menuIdx=52&amp;page=/pages/bbs/list.php&amp;wb_num=&amp;a_idx=I_040204163945&amp;category=&amp;look=&amp;search=&amp;keyword=&amp;pageIdx=1" >
				<img src="/images/bbs/btn_list.gif" alt="목록" />
				</a>
			</p>
					
				</div>
		
		<div class="bbsSlide" title="이전글/다음글">
			<dl>
				<dt class="prev">이전글</dt>
					<dd>
																												<a href="/open_content/sub.php?menuIdx=52&amp;page=/pages/bbs/view.php&amp;a_idx=I_040204163945&amp;b_num=1163&amp;category=&amp;search=&amp;keyword=&amp;pageIdx=1&amp;mnu_name=">TCN프로덕션과 함께하는 영화 시사회 안내♨♨♨</a>
																		</dd>
				<dt class="next">다음글</dt>
				<dd>
																								<a href="/open_content/sub.php?menuIdx=52&amp;page=/pages/bbs/view.php&amp;a_idx=I_040204163945&amp;b_num=1160&amp;category=&amp;search=&amp;keyword=&amp;pageIdx=1&amp;mnu_name=">대구테크노파크 기업지원 설명회</a>
															</dd>
			</dl>
		</div><!-- //bbsSlide -->
	

			</td>
		</tr>
	</table>

	</div> <!-- Contents end -->



			<hr/>
			<!-- 담당자 정보 및 평점 -->
			<div id="personInfo">
				<div class="person">
					<p>
						<strong>담당자</strong> : 운영팀 <span class="f_green">DIP</span> <img src="/images/common/icon_mail.gif" alt="메일" />
						(T.053-655-5619)
					</p>
					<div class="right">
						<p class="date">
							<strong>최근업데이트</strong> :
							2011.03.10						</p>
						<p>
							<a href="#self" onclick="printPage('공지사항');return false;">
								<img src="/images/common/btn_print.gif" alt="인쇄" />
							</a>								
						</p>
						<p>
							<a href="#Contents"><img src="/images/common/btn_top.gif" alt="위로" /></a>
						</p>
					</div>
				</div>

				
<script type="text/javascript">
<!--


	// 페이지 만족도를 저장하는 함수.
	function writeSatisfaction() {

		if (!$RF2('satisfactionForm',"satisfactionChoice")) {
			alert("만족도를 선택해주세요.");
			$("satisfactionChoice5").focus();
			
			return false;
		}

		var url = "/pages/satisfaction/satisfactionWrite.php";
		var pars = Form.serialize("satisfactionForm");

		var satisfactionAjax = new Ajax.Request(
			url, 
			{
				method : "post", 
				parameters : pars, 
				onComplete : completeSatisfaction, 
				onFailure : failureSatisfaction
			}
		);
	}

	// 페이지 만족도 보내기 성공시
	function completeSatisfaction(request) {

		alert("참여해주셔서 감사합니다.");
		
	}

	// 페이지 만족도 보내기 실패시
	function failureSatisfaction(request) {
		alert("페이지가 응답이 없습니다.\n\n다시 시도해주세요.");
	}

	// 페이지만족도 보기
	function satisfactionView(menuIdx) {
		window.open("/pages/satisfaction/satisfactionView.php?menuIdx=" + menuIdx, "satisfactionViewPopup", "width=586,height=435,top=100,left=100,scrollbars=yes,resizable=no");

		return false;
	}

//-->
</script>

				<div class="info">
				<form id="satisfactionForm" name="satisfactionForm" onsubmit="return writeSatisfaction();" method="post">
				<input type="hidden" id="menuIdx" name="menuIdx" value="52" />
					<p class="title"><img src="/images/common/personinfo_title.gif" alt="만족도 조사" /></p>
					<p class="txt">이페이지에서 제공하는 정보에 만족하십니까?</p>
					<ul class="man">
						<li>
							<input type="radio" name="satisfactionChoice" id="satisfactionChoice5" class="vmiddle" value="5"/><label for="satisfactionChoice5"> <img src="/images/common/personinfo_star05.gif" alt="매우 만족" class="vmiddle" /></label>
						</li>
						<li>
							<input type="radio" name="satisfactionChoice" id="satisfactionChoice4" class="vmiddle" value="4"/><label for="satisfactionChoice4"> <img src="/images/common/personinfo_star04.gif" alt="만족" class="vmiddle" /></label>
						</li>
						<li>
							<input type="radio" name="satisfactionChoice" id="satisfactionChoice3" class="vmiddle" value="3"/><label for="satisfactionChoice3"> <img src="/images/common/personinfo_star03.gif" alt="보통" class="vmiddle" /></label>
						</li>
						<li>
							<input type="radio" name="satisfactionChoice" id="satisfactionChoice2" class="vmiddle" value="2"/><label for="satisfactionChoice2"> <img src="/images/common/personinfo_star02.gif" alt="불만" class="vmiddle" /></label>
						</li>
						<li>
							<input type="radio" name="satisfactionChoice" id="satisfactionChoice1" class="vmiddle" value="1"/><label for="satisfactionChoice1"> <img src="/images/common/personinfo_star01.gif" alt="매우 불만" class="vmiddle" /></label>
						</li>
					</ul>
					<p class="btn">
						<input type="image" src="/images/common/personinfo_btn_ok.gif" value="확인" alt="확인" />
					</p>
					<p class="btn">
						<a href="/pages/satisfaction/satisfactionView.php?menuIdx=52" target="displayWindow" onclick="childwin=window.open('','displayWindow','toolbar=no,scrollbars=no,width=460,height=277,top=30,left=30'); childwin.focus();"><img src="/images/common/personinfo_btn_stats.gif" alt="통계" /></a>
					</p>
				</form>
				</div>
			</div>
			<!-- 담당자 정보 및 평점 End -->
			<hr/>

        </div><!--subContents End-->

    </div><!--subWrap End-->

</div><!--Wrap End-->


<div id="bottomWrap">

    <div id="bottomCont">


        <h2 id="bottomLogo"><img src="/images/common/bottom_logo.gif" alt="DIP" /></h2>

        <div id="bottomCopy">
			<h3 class="none">
				하단 메뉴
			</h3>
			<ul class="bottomMenu">
				<li class="fir">
					<a href="/open_content/sub.php?menuIdx=70"><img src="/images/common/bottom_m01.gif" alt="개인정보보호정책/이용약관" /></a>
				</li>
				<li>
					<a href="/open_content/member/mailno.php" target="displayWindow" onclick="childwin=window.open('','displayWindow','toolbar=no,scrollbars=no,width=460,height=232,top=30,left=30'); childwin.focus();" title="새창열림"><img src="/images/common/bottom_m02.gif" alt="이메일무단수집거부" /></a>
				</li>
				<li class="end">
					<a href="/open_content/sub.php?menuIdx=26"><img src="/images/common/bottom_m03.gif" alt="찾아오시는 길" /></a>
				</li>
			</ul>

			<div id="bottomSite">
				<form id="link_3" action="/go_url.html" onsubmit="return false;">
					<h3 class="none">
						<label for="familySite">패밀리 사이트</label>
					</h3>
					<p>
						<select name="linkSite" id="familySite" title="새창열림">
							<option value="">Family Site</option>
							<option value="http://tech.dip.or.kr">공용장비예약시스템</option>
							<option value="http://dggame.or.kr">대구게임아카데미</option>
							<option value="http://dgmedia.or.kr">대구영상미디어센터</option>
							<option value="http://mediabiz.dip.or.kr">ICT Park 미디어허브</option>
							<option value="http://mediabiz.dip.or.kr">ICT Park 미디어스튜디오</option>
							<option value="http://rndcard.dip.or.kr">연구비 카드 시스템</option>
							<option value="http://www.efun.or.kr">e-fun 2009</option>
							<option value="http://cafe.naver.com/2010daeguforum">2010 대구문화산업포럼</option>
						</select>
						<input type="image" src="/images/common/bottom_btn_go.gif" onclick="goSite(this.form,'_blank')" alt="이동" value="이동" title="패밀리 사이트 새창" class="vmiddle" />
					</p>
				</form>
			</div>

			<p class="mark">
				<img src="/images/common/bottom_mark01.gif" alt="SSL" />
				<img src="/images/common/bottom_mark02.gif" alt="인터넷 실명확인" />
			</p>

            <address class="address">
				<img src="/images/common/bottom_address.gif" alt="대구광역시 남구 현충로 441(대명3동 2139-11번지) Tel:053)655-5600 Fax:053)655-5619" />
			</address>
            <p>
				<img src="/images/common/bottom_copyright.gif" alt="Copyright (c) 2006~2011 by DIP. All right reserved." />
			</p>
        </div>
		
    </div>

</div><!--bottomWrap End-->

</body>
</html>