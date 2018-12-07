    var userDe = "";
    var passDe = "";
		function createXMLHttpRequest(){
			if (window.ActiveXObject) {
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");//LÊ8·̠M½ºȃ·η¯
			} else if (window.XMLHttpRequest) {
				xmlHttp = new XMLHttpRequest();//ǄL¾½º
			}
		}
		
		function returnCreateXMLHttpRequest(){
			if (window.ActiveXObject) {
				xmlHttpReturn = new ActiveXObject("Microsoft.XMLHTTP");//LÊ8·̠M½ºȃ·η¯
			} else if (window.XMLHttpRequest) {
				xmlHttpReturn = new XMLHttpRequest();//ǄL¾½º
			}
		}		
		
		function returnCreateXMLHttpRequest1(){
			if (window.ActiveXObject) {
				xmlHttpReturn1 = new ActiveXObject("Microsoft.XMLHTTP");//LÊ8·̠M½ºȃ·η¯
			} else if (window.XMLHttpRequest) {
				xmlHttpReturn1 = new XMLHttpRequest();//ǄL¾½º
			}
		}				

		function userDecp(userIdValue){
			returnCreateXMLHttpRequest();
			xmlHttpReturn.onreadystatechange = handleStateChangeReturn;
			xmlHttpReturn.open("GET", "/pages/login/loginCheck.jsp?searchFlag=userId&userId="+userIdValue+"&passWord=", true);
			xmlHttpReturn.send(null);
		}

		function passDecp(userPassValue){
			returnCreateXMLHttpRequest1();
			xmlHttpReturn1.onreadystatechange = handleStateChangeReturn1;
			xmlHttpReturn1.open("GET", "/pages/login/loginCheck.jsp?searchFlag=passWrod&userId=&passWord="+userPassValue, true);
			xmlHttpReturn1.send(null);
		}
		
		function startRequest() {
			var loginForm = $("loginForm");
			userIdSend = document.loginForm.id.value;
			userPwSend = document.loginForm.passwd.value;
			userDecp(userIdSend);
			passDecp(userPwSend);			
			createXMLHttpRequest();
			xmlHttp.onreadystatechange = handleStateChange;
			xmlHttp.open("GET", "http://yescall.gumi.go.kr/login.do?method=loginIF&USER_ID="+userDe+"&USER_PW="+passDe+"&agreeYN=T&TP_REG_CHNN=03", true);
			xmlHttp.send(null);
		}


		function handleStateChange() {
		
			if(xmlHttp.readyState == 4) {
					 if(xmlHttp.status == 200) {
						var returnValue = xmlHttp.responseText;
							if (returnValue=="T"){
									loginForm.action = "/pages/member/login.jsp";
									loginForm.submit();
							}else {
									alert("login Fail")
							}
				 }
			}
		}

		function handleStateChangeReturn() {
			if(xmlHttpReturn.readyState == 4) {
					 if(xmlHttpReturn.status == 200) {
						var returnValue = xmlHttpReturn.responseText;
							userDe = returnValue;
							alert(userDe + "aaaa")
							if (returnValue=="T"){
									return "T";
							}else {
									return "F";
							}
				 }
			}
		}
		
		function handleStateChangeReturn1() {
			if(xmlHttpReturn1.readyState == 4) {
					 if(xmlHttpReturn1.status == 200) {
						var returnValue = xmlHttpReturn1.responseText;
							passDe = returnValue;
							alert(passDe + "=====")
							if (returnValue=="T"){
									return "T";
							}else {
									return "F";
							}
				 }
			}
		}

