<?php
	include("../config/stringBuffer.inc.php");
	include("../config/mysql.inc.php");
	$count1 = New MySql_DB();
	$count1->Connect();
	$mysqli = $count1->conn;
	/* check connection */
	if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
	}


	//printf("Initial character set: %s\n", $mysqli->character_set_name());

	/* change character set to utf8 */
	if (!$mysqli->set_charset("utf8")) {
			//printf("Error loading character set utf8: %s\n", $mysqli->error);
			exit();
	} else {
			//printf("Current character set: %s\n", $mysqli->character_set_name());
	}
	include("../config/webConfig.inc.php");
	include("../config/request.inc.php");

	include("../config/comm.inc.php");
	include("../query/menu/menuQuery.php");
	include("../query/cms/cmsQuery.php");
	include("../config/mainPage.inc.php");
	include("../query/counter/counter2.php");
	$siteCode = "505000000";
	$mMenu = "main";
$pn = $_REQUEST["pn"];
echo "<script>console.log('$pn')</script>";
	$topMenuList = getAllDepthMenuListMain(0, 1, $siteCode);
	$sub2DepthAllMenuList = getAllDepthMenuListMain(0, 2, $siteCode);

	session_start();
	setCount();

	//header('Content-Type: text/html; charset=UTF-8');

?>

<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<title>소프트웨어 기술 연구소</title>
	<link rel="stylesheet" type="text/css" href="../css/common.css"/>
	<link rel="stylesheet" type="text/css" href="../css/layout.css"/>
	<link rel="stylesheet" type="text/css" href="../css/main.css"/>
	<link rel="stylesheet" type="text/css" href="../css/slide.css"/>
	<script type="text/javascript" src="../js/common.js"></script>

	<script type="text/javascript" src="/js/jquery/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="/js/jquery/jquery.cookie.js"></script>
	<script type="text/javascript" src="/js/jquery/zoom.js"></script>
	<script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="/js/auto.slide.js"></script>

	<script>
		$(function(){
			slide.load({id:'zoom_slide'
				,view_num:1//ȭ����°���
				,image_size:[300,88]//�̹��� �ܾƿ� ������(����,����)
				,image_margin:10//�̹�����������
				,zoom_size:100//�̹������� Ȯ�����200=200%
				,zoom_in_num:1//0~n 0=autoȭ����°��� �� ���� ��ȣ(ex:view_num�� 5���̸� 3��° �̹��� ����)
				,easing:'easeOutSine'//�ִϸ��̼�Ÿ��easeInOutBack
				,ani_time:600/*�ִϸ��̼Ǽӵ�*/
				,auto_slide:true//�ڵ�(����)�����̵� �������
				,auto_play_type:'next'//prev,next�ڵ������̵� �̵� ���� ���� �Ǵ� ����
				,auto_time:3000//2 sec �ڵ� �����̵� Ÿ��
				,ended : function() {} //�̵��ִϸ��̼ǿϷ��� �ݹ��Լ�
				})
			//���� ��ư ������ ���(�Ǵ� ��ũ �±׷� ��������)
			$('#prev').click(function () {
				slide.navi('prev');
			});
			//���� ��ư ������ ���
			$('#next').click(function () {
				slide.navi('next');
			});
		});
	</script>
</head>

<body id="body">
	<div id="accessibility">
		<ul>
			<li><a href="#topLogo">�ΰ� �ٷΰ���</a></li>
			<li><a href="#topMenu">���θ޴� �ٷΰ���</a></li>
			<li><a href="#mainWrap">�������� �ٷΰ���</a></li>
			<li><a href="#bottomCopy">�ϴܸ޴� �ٷΰ���</a></li>
		</ul>
	</div>
	<hr/>

	<div id="Wrap_main">
		<div id="Wrap">

			<div id="topWrap">

			<?
			include("../include/menuHtml.php");
			?>

			</div><!--topWrap End-->

			<div id="mainWrap">

				<div id="mainLeft">
					<p class="pad_t25 pad_l60">
						<img src="/images/main/main_slogan.jpg">
					</p>
					<p class="pad_t20 pad_l70">
						<span class="f_gray f_11"> The <strong>Software Technology Research Center (SWRC)</strong> was established to research on enhancing effectiveness and applicability of fundamental software development techniques such as computer graphics, computer visions, computer network, multimedia, software security and safety, and so on.</span>
					</p>
					<div id="business">
						<p class="pad_t48 pad_l60">
							<img src="/images/main/business.jpg">
						</p>
						<div id="prev" class="pad_l60" style="position:absolute;" title="����"><img src="/images/main/arrow_left.jpg"  style="cursor:hand;"></div>
						<div class="slide_wrap">
							<div id="zoom_slide">
								<ul>
									<li class="pad_l5"><a href="/open_content/sub.php?menuIdx=3"><img src="/images/main/business_1.jpg"></a></li>
									<li class="pad_l5"><a href="/open_content/sub.php?menuIdx=3"><img src="/images/main/business_2.jpg"></a></li>
									<li class="pad_l10"><a href="/open_content/sub.php?menuIdx=3"><img src="/images/main/business_3.jpg"></a></li>
									<li ><a href="/open_content/sub.php?menuIdx=3"><img src="/images/main/business_4.jpg"></a></li>
								</ul>
							</div>
						</div>
						<div id="next" class="pad_l400" style="position:absolute;" title="����"><img src="/images/main/arrow_right.jpg" style="cursor:hand;"></div>
					</div><!--business End-->

					<p class="pad_l60 pad_t25">
						<a href="mailto:soft@knu.ac.kr"><img src="/images/main/email.jpg"></a>
					</p>
					<p class="pad_l60 pad_t10">
						<img src="/images/main/tel.jpg">
					</p>
					<p class="pad_l60 pad_t10">
						<img src="/images/main/fax.jpg">
					</p>
				</div><!--mainLeft End-->
				<div id="mainRight">
					<p class="">
						<img src="/images/main/main_img.jpg">
					</p>
				</div><!--mainRight End-->
				<!-- �������� -->
				<div class="row" >
					<ul id="mainNotice" >
						<li class="">
							<h2><a href="/open_content/sub.php?menuIdx=9"><img src="/images/main/news_notices.jpg" alt="��������" id="bbsTitle_1" class="pad_l5"/></a>
								<img src="/images/main/underbar_news_notices.jpg" class="pad_l5 pad_t3"/></h2>
								<ul id="bbsCont_1" class="mar_t5">
									<?mainBoardList("9", "I_131112160821" , "bbs_notice", "0", "3", "Y");?>
								</ul>
								<p id="bbsMore_1" >
									<a href="/open_content/sub.php?menuIdx=9" ><img src="/images/main/more.jpg" alt="more" class=""/></a>
								</p>
							</li>
						</ul>

						<ul id="mainData">

							<li class="">
								<h2><a href="/open_content/sub.php?menuIdx=15"><img src="/images/main/data.jpg" alt="�ڷ��" id="bbsTitle_1" class="pad_l5"/></a>
									<img src="/images/main/underbar_data.jpg" class="pad_l5"/></h2>
									<ul id="bbsCont_1" class="mar_t5">
										<?mainBoardList("15", "I_131108020452" , "bbs_data", "0", "3", "Y");?>
									</ul>
									<p id="bbsMore_1" >
										<a href="/open_content/sub.php?menuIdx=15" ><img src="/images/main/more.jpg" alt="more" class=""/></a>
									</p>
								</li>
							</ul>
				</div>

			</div><!-- //mainWrap -->

		</div><!-- //Wrap -->
		</div><!-- //Wrap_main -->
		<hr/>

		<div id="bottomWrap">

			<div id="bottomCont">

			<? include("../include/copyrightHtml.php"); ?>

			</div>

		</div><!-- //bottomWrap -->

	</body>
</html>
