// ie6 png24 투명배경 적용
function setPng24(obj){
obj.width=obj.height=1;
obj.className=obj.className.replace(/\bpng24\b/i,'');
obj.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+obj.src+"',sizeMethod='image');"
objsrc='';
return '';
}


var zoomSize = 100;

function screenZoom(inOrOut) {
	if(new RegExp(/Firefox/).test(navigator.userAgent)){
		alert("+,- 는 해당 브라우저에서 지원하지 않습니다.");
	}else if (navigator.userAgent.toLowerCase().indexOf("msie") != -1) {
		if (inOrOut == "reset") {
			zoomSize = 100;
		} else if (inOrOut == "in") {
			zoomSize = zoomSize + 10;
		} else {
			zoomSize = zoomSize - 10;
		}
		
		if (zoomSize > 150) {
			zoomSize = 150;
		}
		
		if (zoomSize < 60) {
			zoomSize = 60;
		}
		document.getElementById("Wrap").style.zoom = zoomSize + "%";
		document.getElementById("bottomWrap").style.zoom = zoomSize + "%";

	}
}


function printPage(pageTitle) {
	/*
	if(document.getElementById("subContents")){
		Pwin = window.open("/open_content/print.php?css="+css,"print","width=780,height=600,scrollbars=1");
	} else if(document.getElementById("app_subWrap")) {
		Pwin = window.open("/open_content/print.php?css="+css,"print","width=850,height=600,scrollbars=1");
	}
	*/
	Pwin = window.open("/open_content/print.php?pageTitle="+pageTitle,"print","width=730,height=600,scrollbars=1");
}


function ChangeSite(url) {
	var errorMessage = null;
	var objFocus = null;
	if (url.select_site.value.length != 0) {
		//location.href = url.select_site.value;
		window.open(url.select_site.value,'','');
		return false;
	}
	return false;
}


// 메인메뉴
function initNavigation(seq) {
	nav = document.getElementById("topMenu");
	nav.menu = new Array();
	nav.current = null;
	nav.menuseq = 0;
	navLen = nav.childNodes.length;
	
	allA = nav.getElementsByTagName("a")
	for(k = 0; k < allA.length; k++) {
		allA.item(k).onmouseover = allA.item(k).onfocus = function () {
			nav.isOver = true;
		}
		allA.item(k).onmouseout = allA.item(k).onblur = function () {
			nav.isOver = false;
			setTimeout(function () {
				if (nav.isOver == false) {
					if (nav.menu[seq])
						nav.menu[seq].onmouseover();
					else if(nav.current) {
						menuImg = nav.current.childNodes.item(0);
						menuImg.src = menuImg.src.replace("_on.jpg", "_off.jpg");
						if (nav.current.submenu)
							nav.current.submenu.style.display = "none";
						nav.current = null;
					}
				}
			}, 500);
		}
	}

	for (i = 0; i < navLen; i++) {
		navItem = nav.childNodes.item(i);
		if (navItem.tagName != "LI")
			continue;

		navAnchor = navItem.getElementsByTagName("a").item(0);
		navAnchor.submenu = navItem.getElementsByTagName("ul").item(0);
		
		navAnchor.onmouseover = navAnchor.onfocus = function () {
			if (nav.current) {
				menuImg = nav.current.childNodes.item(0);
				menuImg.src = menuImg.src.replace("_on.jpg", "_off.jpg");
				if (nav.current.submenu)
					nav.current.submenu.style.display = "none";
				nav.current = null;
			}
			if (nav.current != this) {
				menuImg = this.childNodes.item(0);
				menuImg.src = menuImg.src.replace("_off.jpg", "_on.jpg");
				if (this.submenu)
					this.submenu.style.display = "block";
				nav.current = this;
			}
			nav.isOver = true;
		}
		nav.menuseq++;
		nav.menu[nav.menuseq] = navAnchor;
	}
	if (nav.menu[seq])
		nav.menu[seq].onmouseover();
}


var popupZoneVal = 0;
var popupZoneTmpVal = 0;
var autocontrolvar;
var waitTime = 5000;
var popupZoneState = 1;

function popupZone() {
	var id1, id2;
	allA = document.getElementById("popupZone").getElementsByTagName("li");
	for (var i=1;i<=allA.length;i++) {
		if (popupZoneTmpVal!=1) {
			popupZoneVal = popupZoneTmpVal;
			popupZoneTmpVal = 1;
		}
		if (popupZoneVal == allA.length+1) popupZoneVal = 1;
		id1 = "popNum"+i;
		id2 = "bannerZone_"+i;

		if (popupZoneVal==i) {
			document.getElementById(id1).src = document.getElementById(id1).src.replace("_off.gif", "_on.gif");
			document.getElementById(id2).style.top	= "0px";
		} else {
			document.getElementById(id1).src = document.getElementById(id1).src.replace("_on.gif", "_off.gif");
			document.getElementById(id2).style.top	= "-9000px";
		}
	}
	popupZoneVal = popupZoneVal + 1;
	if (popupZoneVal == 1) {
		autocontrolvar=setTimeout("popupZone()",0);	
	} else {
		autocontrolvar=setTimeout("popupZone()",waitTime);
	}
}

function popupZoneStop(chk) {
	if (chk > 0) {
		clearTimeout(autocontrolvar);
		if(chk == 100) {
			document.getElementById("popupStop").setAttribute("src","/images/main/popupzone_stop_on.gif");
			document.getElementById("popupPlay").setAttribute("src","/images/main/popupzone_play_off.gif");
			popupZoneState = 0;
			//document.getElementById("popupText").innerHTML = "Stop";
		}
	} else {
		if(chk == -1) popupZoneState = 1;
		if(popupZoneState){
			clearTimeout(autocontrolvar);
			document.getElementById("popupStop").setAttribute("src","/images/main/popupzone_stop_off.gif");
			document.getElementById("popupPlay").setAttribute("src","/images/main/popupzone_play_on.gif");
			//document.getElementById("popupText").innerHTML = "Play";
			popupZone();
		}
	}
}

function popupZoneMove(num) {
	if(popupZoneState) {
		var id1, id2;
		for (i=1;i<=allA.length;i++) {
			id1 = "popNum"+i;
			id2 = "bannerZone_"+i;
			if (num==i) {
				document.getElementById(id1).src = document.getElementById(id1).src.replace("_off.gif", "_on.gif");
				document.getElementById(id2).style.top	= "0px";
			} else {
				document.getElementById(id1).src = document.getElementById(id1).src.replace("_on.gif", "_off.gif");
				document.getElementById(id2).style.top	= "-9000px";
			}
		}
		popupZoneVal = num;
		popupZoneTmpVal = num;
		popupZoneStop(1);
	}
}

function tabChange(kind,num) {
	var temp1, temp2, temp3;
	more = "";
	if(kind == "fav"){
		total = 4;
		title = "favTitle_";
		cont = "favCont_";
		more = "";
	}
	else if(kind == "bbs"){
		total = 2;
		title = "bbsTitle_";
		cont = "bbsCont_";
		more = "bbsMore_";
	}
	else if(kind == "bbs2"){
		total = 3;
		title = "bbsTitle2_";
		cont = "bbsCont2_";
		more = "bbsMore2_";
	}

	for (i=1;i<=total;i++) {
		temp1 = title + i;
		temp2 = cont + i;
		temp3 = more + i;
		if (num==i){
			document.getElementById(temp1).className +=" over";
			document.getElementById(temp1).src = document.getElementById(temp1).src.replace("_off.jpg", "_on.jpg");
			document.getElementById(temp2).style.display = "block";
			if (more != "") document.getElementById(temp3).style.display = "block";
		}else{
			document.getElementById(temp1).className = document.getElementById(temp1).className.replace("over","");
			document.getElementById(temp1).src = document.getElementById(temp1).src.replace("_on.jpg", "_off.jpg");
			document.getElementById(temp2).style.display = "none";
			if (more != "") document.getElementById(temp3).style.display = "none";
		}
	}
}

function goSite(form,target) {
	var myindex=form.linkSite.selectedIndex
	myUri = form.linkSite.options[myindex].value;
	if(myUri!="") { window.open(myUri,target); }
}

function antiSpam(id){
	window.open("/pages/util/antispamin.jsp?UniqId=" + id, "AntiSpam", "width=180, height=263, left=1, top=1");
}

function openSearch() {
	var frmObj = document.getElementById("searchForm");
	var menu =  frmObj.menu.value;
	var qt = frmObj.qt.value;

	if(qt.length==0)	{
			alert("검색어를 입력하세요.");
			frmObj.qt.focus();
			return false ;
	} 
	//var pop = window.open('http://search.gyeongju.go.kr/RSA/front/Search.jsp?menu='+menu+'&amp;qt='+qt,'popSearch','left=0,top=0,width=1000,height=600,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes');
	//frmObj.action = '';
	//frmObj.action = 'http://search.gyeongju.go.kr/RSA/front/Search.jsp?menu='+menu+'&qt='+qt
 	return true;
}

function openGetIdentityWindow(Ret){
	window.open('/include/pop_auth.jsp?RET='+Ret,'lecturer','width=700,height=390');
}

// 직원연결,삭제관련
function deptsearch(usr_id){
   window.open('/pages/admin/user/userGovSearch.jsp?usr_id='+usr_id,'직원검색', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes, resizable=no,copyhistory=no ,width=550, height=200, left=220,top=250');
}
function deptsearchDel(usr_id){
   window.open('/pages/admin/user/userGovSearchDel.jsp?usr_id='+usr_id,'직원검색', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes, resizable=no,copyhistory=no ,width=550, height=200, left=220,top=250');
}

function checkDeptUser(usr_id,usr_code){
	if( confirm('회원정보와 직원 정보를 연결합니다"') ){
		location.href='/pages/admin/user/userGovSearchSelect.jsp?usr_id='+usr_id+'&amp;usr_code='+usr_code;
	}
}

function setCookieValue(name, value, expiredays)
{
	var today = new Date();
	today.setDate( today.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
}


