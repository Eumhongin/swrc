
<script type="text/javascript">
<!--
	// prototype.js ������ include ���� �ʾ��� ��츦 �����...
	if (!window.Ajax) {
		document.writeln("<script type=\"text/javascript\" src=\"/js/prototype.js\"></sc" + "ript><nos" + "cript>");
		document.writeln("<p>�ڹٽ�ũ��Ʈ�� ����� �� ���� �������Դϴ�.<br />���� �������� �̿��Ͻñ� ���ؼ��� �ٸ� �������� ������ �ֽñ� �ٶ��ϴ�.</p> ");
		document.writeln("</no" + "script>");
	}

	// ������ �������� �����ϴ� �Լ�.
	function writeSatisfaction() {

		/*if (!$RF2('satisfactionForm',"satisfactionChoice")) {
			alert("�������� �������ּ���.");
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

	// ������ ������ ������ ������
	function completeSatisfaction(request) {

		alert("�������ּż� �����մϴ�.");
		return false;
		
	}

	// ������ ������ ������ ���н�
	function failureSatisfaction(request) {
		alert("�������� ������ �����ϴ�.\n\n�ٽ� �õ����ּ���.");
		return false;
	}

	// ������������ ����
	function satisfactionView(menuIdx) {
		window.open("/pages/satisfaction/satisfactionView.php?menuIdx=" + menuIdx, "satisfactionViewPopup", "width=586,height=435,top=100,left=100,scrollbars=yes,resizable=no");

		return false;
	}

//-->
</script>

				<div class="info">
				<form id="satisfactionForm" name="satisfactionForm" onsubmit="return writeSatisfaction();"  method="post">
				<input type="hidden" id="menuIdx" name="menuIdx" value="<?=$menuIdx?>" />
					<p class="title"><img src="/images/common/personinfo_title.gif" alt="������ ����" /></p>
					<p class="txt">������������ �����ϴ� ������ �����Ͻʴϱ�?</p>
					<ul class="man">
						<li>
							<input type="radio" name="satisfactionChoice" id="satisfactionChoice5" class="vmiddle" value="5" checked="checked" /><label for="satisfactionChoice5"> <img src="/images/common/personinfo_star05.gif" alt="�ſ� ����" class="vmiddle" /></label>
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
						<a href="/pages/satisfaction/satisfactionView.php?menuIdx=<?=$menuIdx?>" target="displayWindow" onclick="childwin=window.open('','displayWindow','toolbar=no,scrollbars=no,width=460,height=277,top=30,left=30'); childwin.focus();"><img src="/images/common/personinfo_btn_stats.gif" alt="���" /></a>
					</p>
				</form>
				</div>