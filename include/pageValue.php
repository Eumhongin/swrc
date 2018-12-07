
<script type="text/javascript">
<!--
	// prototype.js 파일이 include 되지 않았을 경우를 대비해...
	if (!window.Ajax) {
		document.writeln("<script type=\"text/javascript\" src=\"/js/prototype.js\"></sc" + "ript><nos" + "cript>");
		document.writeln("<p>자바스크립트를 사용할 수 없는 브라우저입니다.<br />현재 페이지를 이용하시기 위해서는 다른 브라우저로 접속해 주시기 바랍니다.</p> ");
		document.writeln("</no" + "script>");
	}

	// 페이지 만족도를 저장하는 함수.
	function writeSatisfaction() {

		/*if (!$RF2('satisfactionForm',"satisfactionChoice")) {
			alert("만족도를 선택해주세요.");
			$("satisfactionChoice5").focus();
			
			return false;
		}*/

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
		return false;
		
	}

	// 페이지 만족도 보내기 실패시
	function failureSatisfaction(request) {
		alert("페이지가 응답이 없습니다.\n\n다시 시도해주세요.");
		return false;
	}

	// 페이지만족도 보기
	function satisfactionView(menuIdx) {
		window.open("/pages/satisfaction/satisfactionView.php?menuIdx=" + menuIdx, "satisfactionViewPopup", "width=586,height=435,top=100,left=100,scrollbars=yes,resizable=no");

		return false;
	}

//-->
</script>

				<div class="info">
				<form id="satisfactionForm" name="satisfactionForm" onsubmit="return writeSatisfaction();"  method="post">
				<input type="hidden" id="menuIdx" name="menuIdx" value="<?=$menuIdx?>" />
					<p class="title"><img src="/images/common/personinfo_title.gif" alt="만족도 조사" /></p>
					<p class="txt">이페이지에서 제공하는 정보에 만족하십니까?</p>
					<ul class="man">
						<li>
							<input type="radio" name="satisfactionChoice" id="satisfactionChoice5" class="vmiddle" value="5" checked="checked" /><label for="satisfactionChoice5"> <img src="/images/common/personinfo_star05.gif" alt="매우 만족" class="vmiddle" /></label>
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
						<a href="/pages/satisfaction/satisfactionView.php?menuIdx=<?=$menuIdx?>" target="displayWindow" onclick="childwin=window.open('','displayWindow','toolbar=no,scrollbars=no,width=460,height=277,top=30,left=30'); childwin.focus();"><img src="/images/common/personinfo_btn_stats.gif" alt="통계" /></a>
					</p>
				</form>
				</div>