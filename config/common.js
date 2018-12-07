function inputCheck(obj, msg)
{
	var str = obj.value;
	if(TextTrim(str).length == 0)
	{
		alert(msg);
		obj.focus();
		return false;
	}
	else
	{
		return true;
	}
}


function TextTrim(s) {
	var m = s.match(/^\s*(\S+(\s+\S+)*)\s*$/);
	return (m == null) ? "" : m[1];
}



function jsSearch(form)
{
	if(inputCheck(form.searchValue, "검색어를 입력해 주세요."))
	{
		form.submit();
	}
	else
	{
		if(event)
		{
			return false;
		}
	}

  /*
  if (form.searchValue.value=="")  
  {
	  alert("검색어를 입력해 주세요.");
  }
  else
  {
    form.submit();
  }
  */
}

function goUrl(urlPath)
{
  location.href = '/dge/servlet/fs.HDServlet_FS?tc=' + urlPath;
}



function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}



// 상단 좌측 FLASH - 메인화면
function writeObj_main() {
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="950" height="780" id="m_flash" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/main_f.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/main_f.swf" quality="high" bgcolor="#ffffff" wmode=transparent width="950" height="780" name="m_flash" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 상단 좌측 FLASH - 메인화면
function writeObj_main2() {
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="950" height="780" id="m_flash" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/main_movie_spring.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/main_movie_spring.swf" quality="high" bgcolor="#ffffff" wmode=transparent width="950" height="780" name="m_flash" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 상단 좌측 FLASH - 주요사업소개
function writeObj_policy() {
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="238.5" height="110" id="m_flash" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/policy.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/policy.swf" quality="high" bgcolor="#ffffff" wmode=transparent width="238.5" height="110" name="m_flash" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 상단 좌측 FLASH - 서브화면
function writeObj_main_navi(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="193" height="319" id="sb_flash" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/main_navi.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/main_navi.swf" quality="high" bgcolor="#ffffff" width="193" height="319" name="sb_flash" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}
							  
// 서브이미지 FLASH 01
function writeObj_sub01(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="758" height="245" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/sub01_visual.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/sub01_visual.swf" quality="high" bgcolor="#ffffff" width="758" height="245" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 서브이미지 FLASH 02
function writeObj_sub02(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="758" height="245" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/sub02_visual.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/sub02_visual.swf" quality="high" bgcolor="#ffffff" width="758" height="245" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 서브이미지 FLASH 03
function writeObj_sub03(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="758" height="245" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/sub03_visual.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/sub03_visual.swf" quality="high" bgcolor="#ffffff" width="758" height="245" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 서브이미지 FLASH 04
function writeObj_sub04(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="758" height="245" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/sub04_visual.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/sub04_visual.swf" quality="high" bgcolor="#ffffff" width="758" height="245" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 서브이미지 FLASH 05
function writeObj_sub05(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="758" height="245" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/sub05_visual.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/sub05_visual.swf" quality="high" bgcolor="#ffffff" width="758" height="245" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}	

// 서브이미지 FLASH 06
function writeObj_sub06(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="758" height="245" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/sub06_visual.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/sub06_visual.swf" quality="high" bgcolor="#ffffff" width="758" height="245" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 서브이미지 FLASH 06
function writeObj_quick(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="68" height="240" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/quick_mn.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/quick_mn.swf" quality="high" bgcolor="#ffffff" width="68" height="240" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}	  

// 주요기관 및 시설
function writeObj_guide01(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="496" height="354" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/guide_f01.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/guide_f01.swf" quality="high" bgcolor="#ffffff" width="496" height="354" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}	 	  

// 주요기관 및 시설
function writeObj_guide02(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="496" height="354" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/guide_f02.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/guide_f02.swf" quality="high" bgcolor="#ffffff" width="496" height="354" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}	  

// 주요기관 및 시설
function writeObj_guide03(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="496" height="354" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/guide_f03.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/guide_f03.swf" quality="high" bgcolor="#ffffff" width="496" height="354" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}	  

// 주요기관 및 시설
function writeObj_guide04(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="480" height="320" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/guide_f04.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/guide_f04.swf" quality="high" bgcolor="#ffffff" width="480" height="320" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}	  

// 주요기관 및 시설
function writeObj_guide05(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="496" height="354" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/guide_f05.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/guide_f05.swf" quality="high" bgcolor="#ffffff" width="496" height="354" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}	  

// 주요기관 및 시설
function writeObj_guide06(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="500" height="354" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/guide_f06.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/guide_f06.swf" quality="high" bgcolor="#ffffff" width="500" height="354" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}	  

// 주요기관 및 시설
function writeObj_guide07(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="480" height="320" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/guide_f07.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/guide_f07.swf" quality="high" bgcolor="#ffffff" width="480" height="320" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}	  

// 주요기관 및 시설
function writeObj_guide08(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="496" height="354" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/guide_f08.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/guide_f08.swf" quality="high" bgcolor="#ffffff" width="496" height="354" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}	  

// 주요기관 및 시설
function writeObj_guide09(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="496" height="354" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/guide_f09.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/guide_f09.swf" quality="high" bgcolor="#ffffff" width="480" height="340" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}


	  

// 주요기관 및 시설
function writeObj_building01(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="640" height="600" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../Sub_Information/building01.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../Sub_Information/building01.swf" quality="high" bgcolor="#ffffff" width="640" height="600" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 주요기관 및 시설
function writeObj_building02(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="640" height="600" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../Sub_Information/building02.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../Sub_Information/building02.swf" quality="high" bgcolor="#ffffff" width="640" height="600" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 주요기관 및 시설
function writeObj_building03(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="640" height="600" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../Sub_Information/building03.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../Sub_Information/building03.swf" quality="high" bgcolor="#ffffff" width="640" height="600" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
} 


// 주요기관 및 시설
function writeObj_building04(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="640" height="600" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../Sub_Information/building04.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../Sub_Information/building04.swf" quality="high" bgcolor="#ffffff" width="640" height="600" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
} 

// 주요기관 및 시설
function writeObj_building05(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="640" height="600" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../Sub_Information/building05.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../Sub_Information/building05.swf" quality="high" bgcolor="#ffffff" width="640" height="600" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
} 


// 주요기관 및 시설
function writeObj_org01(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="630" height="200" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/org01.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/org01.swf" quality="high" bgcolor="#ffffff" width="630" height="200" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 주요기관 및 시설
function writeObj_org02(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="630" height="200" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/org02.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/org02.swf" quality="high" bgcolor="#ffffff" width="630" height="200" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 주요기관 및 시설
function writeObj_org03(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="630" height="200" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/org03.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/org03.swf" quality="high" bgcolor="#ffffff" width="630" height="200" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

	 
// 주요기관 및 시설
function writeObj_org05(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="630" height="200" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/org05.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/org05.swf" quality="high" bgcolor="#ffffff" width="630" height="200" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 주요기관 및 시설
function writeObj_org07(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="630" height="200" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/org07.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/org07.swf" quality="high" bgcolor="#ffffff" width="630" height="200" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}

// 주요기관 및 시설
function writeObj_org08(){
  document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="630" height="200" id="menu" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="../images/swf/org08.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name="wmode" value="transparent"><embed src="../images/swf/org08.swf" quality="high" bgcolor="#ffffff" width="630" height="200" name="menu" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>');
}