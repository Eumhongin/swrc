<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>��������</title>
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
        <li><a href="#topLogo">�ΰ� �ٷΰ���</a></li>
        <li><a href="#topMenu">���θ޴� �ٷΰ���</a></li>
        <li><a href="#subMenu">����޴� �ٷΰ���</a></li>
        <li><a href="#subContents">�������� �ٷΰ���</a></li>
        <li><a href="#bottomCopy">�ϴܸ޴� �ٷΰ���</a></li>
    </ul>
</div>
<hr/>

<div id="Wrap">

	<div id="topWrap">

	<div id="topLogo">
		<h1><a href="/"><img src="/images/common/logo.gif" alt="(��)�뱸�����л�������" /></a></h1>
	</div>
<script type="text/javascript">
	function fncSearchCheck(){
		if(formTopSearch.searchword.value == "Search" || formTopSearch.searchword.value == ""){
			alert("�˻�� �Է��Ͽ� �ּ���.");
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
						<input type="text" id="searchword" name="searchword" value="Search" onclick="formTopSearch.searchword.value = ''; return false;" title="�˻���" class="aa"/>
						<input type="image" class="vmiddle" src="/images/common/btn_search.gif" alt="�˻�" />
					</div>
					</form>
				</li>
				<li>
					<div class="t_font">
						<h2 class="floatleft">
							<img src="/images/common/fontsize.gif" alt="����ũ��" />
						</h2>
						<p class="floatleft">
							<a href="#" class="browserZoomIn" onclick="return false;"><img src="/images/common/fontsize_zoomin.gif" alt="����Ȯ��" /></a>
						</p>
						<p class="floatleft">
							<a href="#" class="browserZoomOut" onclick="return false;"><img src="/images/common/fontsize_zoomout.gif" alt="�������" /></a>
						</p>
						<!-- 
						<p class="floatleft">
							<a href="#self" onclick="screenZoom('in'); return false;"><img src="/images/common/fontsize_zoomin.gif" alt="����Ȯ��" /></a>
						</p>
						<p class="floatleft">
							<a href="#self" onclick="screenZoom('out'); return false;"><img src="/images/common/fontsize_zoomout.gif" alt="�������" /></a>
						</p> 
						-->
					</div>
				</li>
				<li>
					<ul class="t_navi">
												<li class="fcolor">
							<img src="/images/common/icon_key.gif" alt="" class="vmiddle" />
							<a href="/open_content/sub.php?menuIdx=69">�α���</a>
						</li>
						<li>
							<a href="/open_content/sub.php?menuIdx=70">ȸ������</a>
						</li>
												<li class="bgnone">
							<a href="/open_content/sub.php?menuIdx=127">����Ʈ��</a>
						</li>
					</ul>
				</li>
				<li>
					<h2 class="none">�ܱ������Ʈ</h2>
					<ul class="t_global">
						<li class="mar_l3">
							<a href="/english/open_content/main_page.php"><img src="/images/common/tmenu_eng.gif" alt="English" /></a>
						</li>
						<li class="mar_l3">
							<a href="/chinese/open_content/main_page.php"><img src="/images/common/tmenu_chi.gif" alt="������" /></a>
						</li>
						<li class="mar_l3">
							<a href="/japanese/open_content/main_page.php"><img src="/images/common/tmenu_jpn.gif" alt="������" /></a>
						</li>
					</ul>
				</li>
			</ul>
        </div>

		<ul id="topMenu">

		<li><a href="sub.php?menuIdx=11">
			<img src="/images/common/menu_1_off.gif" alt="������Ұ�" />
			</a>
		<ul>
						<li class="f_sm_1"><a href="./sub.php?menuIdx=11" >�λ縻</a></li>
<li><a href="./sub.php?menuIdx=23" >�������� �� ����</a></li>
<li><a href="./sub.php?menuIdx=25" >�������� �� �൵</a></li>
<li><a href="./sub.php?menuIdx=27" >ȫ���ڷ�</a></li>
<li><a href="./sub.php?menuIdx=43" >�ֿ����Ұ�</a></li>
<li><a href="./sub.php?menuIdx=29" >ICT Park��?</a></li>
					</ul></li>		<li><a href="./sub.php?menuIdx=52">
			<img src="/images/common/menu_2_off.gif" alt="IT��CT �������" />
			</a>
		<ul>
						<li class="f_sm_2"><a href="./sub.php?menuIdx=52" >��������</a></li>
<li><a href="./sub.php?menuIdx=30" >������å/�ڱ�����</a></li>
<li><a href="./sub.php?menuIdx=31" >��������</a></li>
<li><a href="./sub.php?menuIdx=32" >���������ȳ�</a></li>
<li><a href="./sub.php?menuIdx=53" >������� ����</a></li>
					</ul></li>		<li><a href="./sub.php?menuIdx=54">
			<img src="/images/common/menu_3_off.gif" alt="������ POOL" />
			</a>
		<ul>
						<li class="f_sm_3"><a href="./sub.php?menuIdx=54" >�����ȳ�</a></li>
<li><a href="./sub.php?menuIdx=34" >�������</a></li>
					</ul></li>		<li><a href="./sub.php?menuIdx=36">
			<img src="/images/common/menu_4_off.gif" alt="��������ý���" />
			</a>
		<ul>
						<li class="f_sm_4"><a href="./sub.php?menuIdx=36" >���ֱ��</a></li>
<li><a href="./sub.php?menuIdx=60" >���־ȳ�</a></li>
<li><a href="./sub.php?menuIdx=64" >���ֽ�û</a></li>
<li><a href="./sub.php?menuIdx=38" >�ڷ��</a></li>
<li><a href="./sub.php?menuIdx=39" >��������</a></li>
<li><a href="./sub.php?menuIdx=40" >Ŭ���Ű���</a></li>
					</ul></li>		</ul><!--topMenu End-->

		<script type="text/javascript">
		//<![CDATA[
			initNavigation(2);
		//]]>
		</script>
		
	<hr/>	 </div><!--topWrap End-->


    <div id="subWrap">

        <div id="subMenu">
<h2><img src="/images/itct/left_title.gif" alt="IT��CT �������" /></h2>
						<ul>												
						<li class="sm_on" ><a href="./sub.php?menuIdx=52"  >��������</a> 						
					</li >												
						<li ><a href="./sub.php?menuIdx=30"  >������å/�ڱ�����</a> 						
					</li >												
						<li ><a href="./sub.php?menuIdx=31"  >��������</a> 						
					</li >												
						<li ><a href="./sub.php?menuIdx=32"  >���������ȳ�</a> 						
					</li >												
						<li ><a href="./sub.php?menuIdx=53"  >������� ����</a> 						
					</li>
		</ul>
        </div><!--subMenu End-->


        <hr/>

        <div id="subContents">
			<p id="subVisual"><img src="/images/common/visual_sub_itct.jpg" alt="" /></p>	<div id="ContLocation">
		<p class="cont">HOME &gt; IT��CT ������� &gt; <span class="cont_state">��������</span></p>
	</div>
	<h3 id="ContTitle"><img src="/images/itct/title04_01.gif" alt="��������" /></h3>

	<div id="Contents">
<p class="bu_attention">
					<span class="f_14 f_orange"><strong>(��)�뱸�����л��������� �������� �Խ����Դϴ�.</strong></span><br/>
					����, ����, ��翡 ���� ������ �����ϰ� �ֽ��ϴ�.
				</p><script type="text/javascript" src="/pages/bbs/js/comm.js"></script>

		<div class="bbsView">
			<table class="wps_100" summary="�������� �� ���� �󼼳���">
				<caption class="none">�������� �� ����</caption>
				<colgroup>
					<col width="15%" />
					<col width="35%" />
					<col width="15%" />
					<col width="35%" />
				</colgroup>
				<tbody>
					<tr>
						<th scope="row">����</th>
						<td colspan="3">
						 [����] 						<strong>e-fun 2011 ��ȹ������ ���� ��������</strong></td>
					</tr>
															<tr>
						<th scope="row">�̸���</th>
						<td colspan="3">lyj@dip.or.kr</td>
					</tr>
															<tr>
						<th scope="row">�����</th>
						<td>2011-01-31</td>
						<th scope="row">��ȸ��</th>
						<td>4109</td>
					</tr>
					<tr>
						<th scope="row">�ۼ���</th>
						<td>������</td>
						<th scope="row">÷��</th>
						<td>
																	<form name="file" method="post" target="_self">
										<input type="hidden" name="path" value="I_040204163945" />
										<input type="hidden" name="num" value="" />
																							<input type="hidden" name="file1" value="e-fun 2011�������缭.hwp">
													<img src="/images/bbs/icon_file.gif" alt="" class="vmiddle" />
													<a href="javascript:FileDownload('1')">e-fun 2011�������缭.hwp</a>
																						</form>
															</td>
					</tr>
									</tbody>
			</table>

			<div class="article" title="�Խù�����">
								<HTML>
<HEAD>
<META name=GENERATOR content="TAGFREE Active Designer v2.0">
</HEAD>
<BODY style="FONT-SIZE: 10pt"><!--StartFragment--><SPAN><!--StartFragment-->&nbsp;<SPAN style="FONT-FAMILY: '���Ĺ���'"><STRONG><IMG style="WIDTH: 528px; HEIGHT: 92px" border=0 src="http://www.dip.or.kr/up_file/bbs/UNI00000718b9e4.gif" width=658 height=99><BR>
</STRONG></SPAN></SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt; FONT-WEIGHT: bold"><BR>
�� �� ��</SPAN> 
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt; FONT-WEIGHT: bold">&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">o</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt; FONT-WEIGHT: bold"> ����� : e-fun 2011 ��ȹ������ ���� ��������</SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt; FONT-WEIGHT: bold">&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">o �� ��<BR>
</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">&nbsp;&nbsp;&nbsp;&nbsp;- ��������� ���並 �ľ��Ͽ� e-fun 2011 ��ȹ������ �ݿ�<BR>
</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">&nbsp;&nbsp;&nbsp;&nbsp;- ������ ���α׷� ������ ���� ������� ������ ����</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: �޸ո���,���ĵ���; FONT-SIZE: 14pt"><BR>
</SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt; FONT-WEIGHT: bold">�� ��������</SPAN></P>
<P style="LINE-HEIGHT: 180%; TEXT-INDENT: -37.6pt; MARGIN-LEFT: 37.6pt" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt"><!--StartFragment--></P>
<P style="LINE-HEIGHT: 180%; TEXT-INDENT: -37.6pt; MARGIN-LEFT: 37.6pt" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt"><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">&nbsp;&nbsp;o </SPAN>����Ⱓ: 2011�� 1�� 31��(��) ~ 2�� 8��(ȭ)����<BR>
<BR>
</P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt; FONT-WEIGHT: bold">�� ������<BR>
</SPAN><BR>
<SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt"><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">&nbsp;&nbsp;o </SPAN></SPAN>������: ����� �̸���(<A href="mailto:lyj@dip.or.kr">lyj@dip.or.kr</A>)�� ����&nbsp;<BR>
&nbsp; o ����� : �뱸�����л������� CT����� �̿��� å��<BR>
&nbsp;&nbsp;&nbsp; - TEL)053-655-5625</SPAN></SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt; FONT-WEIGHT: bold">�� e-fun 2011 ����ȹ(��)</SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt; FONT-WEIGHT: bold">&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">o �� ��</SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">&nbsp;&nbsp;- �� �� �� : e-fun 2011<BR>
</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">&nbsp;&nbsp;- ���Ⱓ : 2011�� 5�� 12��(��) ~ 14��(��)<BR>
</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">&nbsp;&nbsp;- ��&nbsp;&nbsp;&nbsp; �� : ������ ������ ���� ������ ��������<BR>
</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">&nbsp; - ��&nbsp;&nbsp;&nbsp; �� : �뱸������<BR>
&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">- ��&nbsp;&nbsp;&nbsp; �� : �뱸�����л�������(DIP)<BR>
&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">- ��&nbsp;&nbsp;&nbsp; �� : �뱸���������Ǽ���(EXCO)</SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: �޸ո���,���ĵ���; FONT-SIZE: 6pt"><BR>
</SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle0><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">&nbsp;&nbsp;o ��系��</SPAN></P>
<P style="LINE-HEIGHT: 180%" class=HStyle1><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">&nbsp; - </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; LETTER-SPACING: 0.6pt; FONT-SIZE: 10pt">e-fun 2011 &amp; ���������̺�TV�� ����&#61600;ü�����<BR>
&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; FONT-SIZE: 10pt">- ������ ������ ���� ������ �������� ���۷��� ����<BR>
&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; LETTER-SPACING: 0.6pt; FONT-SIZE: 10pt">- ���� ������ ����Ͻ� ���ȸ<BR>
&nbsp; </SPAN><SPAN style="LINE-HEIGHT: 180%; FONT-FAMILY: ����; LETTER-SPACING: 0.6pt; FONT-SIZE: 10pt">- �������(�ܼ�Ʈ, �мǼ�, ���Ӵ�ȸ, û�ҳ� ü��Ȱ�� ��)<BR>
<BR>
<BR>
<BR>
</SPAN></P><STRONG><SPAN style="COLOR: #0000ff">�� �������缭�� �������ֽô� �� �� 10���� ��÷���� �����Ͽ�,<BR>
&nbsp;</SPAN><BR>
<SPAN style="COLOR: #0000ff">�ְ�� �������(SAMSUNG HM1600, 5��), e-fun Ƽ����(5��) ����</SPAN><BR>
<BR>
<SPAN style="COLOR: #0000ff">��÷�ڴ� ���� Ȩ������(http://www.efun.or.kr) ����</SPAN><BR>
</STRONG><BR>
<BR>
</BODY></HTML> 			</div><!-- //article -->
		</div><!--//bbsView -->
	

			<div class="bbsBtn">
														<p>
				<a href="/open_content/sub.php?menuIdx=52&amp;page=/pages/bbs/list.php&amp;wb_num=&amp;a_idx=I_040204163945&amp;category=&amp;look=&amp;search=&amp;keyword=&amp;pageIdx=1" >
				<img src="/images/bbs/btn_list.gif" alt="���" />
				</a>
			</p>
					
				</div>
		
		<div class="bbsSlide" title="������/������">
			<dl>
				<dt class="prev">������</dt>
					<dd>
																												<a href="/open_content/sub.php?menuIdx=52&amp;page=/pages/bbs/view.php&amp;a_idx=I_040204163945&amp;b_num=1163&amp;category=&amp;search=&amp;keyword=&amp;pageIdx=1&amp;mnu_name=">TCN���δ��ǰ� �Բ��ϴ� ��ȭ �û�ȸ �ȳ��͢͢�</a>
																		</dd>
				<dt class="next">������</dt>
				<dd>
																								<a href="/open_content/sub.php?menuIdx=52&amp;page=/pages/bbs/view.php&amp;a_idx=I_040204163945&amp;b_num=1160&amp;category=&amp;search=&amp;keyword=&amp;pageIdx=1&amp;mnu_name=">�뱸��ũ����ũ ������� ����ȸ</a>
															</dd>
			</dl>
		</div><!-- //bbsSlide -->
	

			</td>
		</tr>
	</table>

	</div> <!-- Contents end -->



			<hr/>
			<!-- ����� ���� �� ���� -->
			<div id="personInfo">
				<div class="person">
					<p>
						<strong>�����</strong> : ��� <span class="f_green">DIP</span> <img src="/images/common/icon_mail.gif" alt="����" />
						(T.053-655-5619)
					</p>
					<div class="right">
						<p class="date">
							<strong>�ֱپ�����Ʈ</strong> :
							2011.03.10						</p>
						<p>
							<a href="#self" onclick="printPage('��������');return false;">
								<img src="/images/common/btn_print.gif" alt="�μ�" />
							</a>								
						</p>
						<p>
							<a href="#Contents"><img src="/images/common/btn_top.gif" alt="����" /></a>
						</p>
					</div>
				</div>

				
<script type="text/javascript">
<!--


	// ������ �������� �����ϴ� �Լ�.
	function writeSatisfaction() {

		if (!$RF2('satisfactionForm',"satisfactionChoice")) {
			alert("�������� �������ּ���.");
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

	// ������ ������ ������ ������
	function completeSatisfaction(request) {

		alert("�������ּż� �����մϴ�.");
		
	}

	// ������ ������ ������ ���н�
	function failureSatisfaction(request) {
		alert("�������� ������ �����ϴ�.\n\n�ٽ� �õ����ּ���.");
	}

	// ������������ ����
	function satisfactionView(menuIdx) {
		window.open("/pages/satisfaction/satisfactionView.php?menuIdx=" + menuIdx, "satisfactionViewPopup", "width=586,height=435,top=100,left=100,scrollbars=yes,resizable=no");

		return false;
	}

//-->
</script>

				<div class="info">
				<form id="satisfactionForm" name="satisfactionForm" onsubmit="return writeSatisfaction();" method="post">
				<input type="hidden" id="menuIdx" name="menuIdx" value="52" />
					<p class="title"><img src="/images/common/personinfo_title.gif" alt="������ ����" /></p>
					<p class="txt">������������ �����ϴ� ������ �����Ͻʴϱ�?</p>
					<ul class="man">
						<li>
							<input type="radio" name="satisfactionChoice" id="satisfactionChoice5" class="vmiddle" value="5"/><label for="satisfactionChoice5"> <img src="/images/common/personinfo_star05.gif" alt="�ſ� ����" class="vmiddle" /></label>
						</li>
						<li>
							<input type="radio" name="satisfactionChoice" id="satisfactionChoice4" class="vmiddle" value="4"/><label for="satisfactionChoice4"> <img src="/images/common/personinfo_star04.gif" alt="����" class="vmiddle" /></label>
						</li>
						<li>
							<input type="radio" name="satisfactionChoice" id="satisfactionChoice3" class="vmiddle" value="3"/><label for="satisfactionChoice3"> <img src="/images/common/personinfo_star03.gif" alt="����" class="vmiddle" /></label>
						</li>
						<li>
							<input type="radio" name="satisfactionChoice" id="satisfactionChoice2" class="vmiddle" value="2"/><label for="satisfactionChoice2"> <img src="/images/common/personinfo_star02.gif" alt="�Ҹ�" class="vmiddle" /></label>
						</li>
						<li>
							<input type="radio" name="satisfactionChoice" id="satisfactionChoice1" class="vmiddle" value="1"/><label for="satisfactionChoice1"> <img src="/images/common/personinfo_star01.gif" alt="�ſ� �Ҹ�" class="vmiddle" /></label>
						</li>
					</ul>
					<p class="btn">
						<input type="image" src="/images/common/personinfo_btn_ok.gif" value="Ȯ��" alt="Ȯ��" />
					</p>
					<p class="btn">
						<a href="/pages/satisfaction/satisfactionView.php?menuIdx=52" target="displayWindow" onclick="childwin=window.open('','displayWindow','toolbar=no,scrollbars=no,width=460,height=277,top=30,left=30'); childwin.focus();"><img src="/images/common/personinfo_btn_stats.gif" alt="���" /></a>
					</p>
				</form>
				</div>
			</div>
			<!-- ����� ���� �� ���� End -->
			<hr/>

        </div><!--subContents End-->

    </div><!--subWrap End-->

</div><!--Wrap End-->


<div id="bottomWrap">

    <div id="bottomCont">


        <h2 id="bottomLogo"><img src="/images/common/bottom_logo.gif" alt="DIP" /></h2>

        <div id="bottomCopy">
			<h3 class="none">
				�ϴ� �޴�
			</h3>
			<ul class="bottomMenu">
				<li class="fir">
					<a href="/open_content/sub.php?menuIdx=70"><img src="/images/common/bottom_m01.gif" alt="����������ȣ��å/�̿���" /></a>
				</li>
				<li>
					<a href="/open_content/member/mailno.php" target="displayWindow" onclick="childwin=window.open('','displayWindow','toolbar=no,scrollbars=no,width=460,height=232,top=30,left=30'); childwin.focus();" title="��â����"><img src="/images/common/bottom_m02.gif" alt="�̸��Ϲ��ܼ����ź�" /></a>
				</li>
				<li class="end">
					<a href="/open_content/sub.php?menuIdx=26"><img src="/images/common/bottom_m03.gif" alt="ã�ƿ��ô� ��" /></a>
				</li>
			</ul>

			<div id="bottomSite">
				<form id="link_3" action="/go_url.html" onsubmit="return false;">
					<h3 class="none">
						<label for="familySite">�йи� ����Ʈ</label>
					</h3>
					<p>
						<select name="linkSite" id="familySite" title="��â����">
							<option value="">Family Site</option>
							<option value="http://tech.dip.or.kr">������񿹾�ý���</option>
							<option value="http://dggame.or.kr">�뱸���Ӿ�ī����</option>
							<option value="http://dgmedia.or.kr">�뱸����̵���</option>
							<option value="http://mediabiz.dip.or.kr">ICT Park �̵�����</option>
							<option value="http://mediabiz.dip.or.kr">ICT Park �̵�Ʃ���</option>
							<option value="http://rndcard.dip.or.kr">������ ī�� �ý���</option>
							<option value="http://www.efun.or.kr">e-fun 2009</option>
							<option value="http://cafe.naver.com/2010daeguforum">2010 �뱸��ȭ�������</option>
						</select>
						<input type="image" src="/images/common/bottom_btn_go.gif" onclick="goSite(this.form,'_blank')" alt="�̵�" value="�̵�" title="�йи� ����Ʈ ��â" class="vmiddle" />
					</p>
				</form>
			</div>

			<p class="mark">
				<img src="/images/common/bottom_mark01.gif" alt="SSL" />
				<img src="/images/common/bottom_mark02.gif" alt="���ͳ� �Ǹ�Ȯ��" />
			</p>

            <address class="address">
				<img src="/images/common/bottom_address.gif" alt="�뱸������ ���� ����� 441(���3�� 2139-11����) Tel:053)655-5600 Fax:053)655-5619" />
			</address>
            <p>
				<img src="/images/common/bottom_copyright.gif" alt="Copyright (c) 2006~2011 by DIP. All right reserved." />
			</p>
        </div>
		
    </div>

</div><!--bottomWrap End-->

</body>
</html>