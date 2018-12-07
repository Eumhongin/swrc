arrLinks = new Array();
arrTargets = new Array();
document.onkeydown=OnPressShortcut;

function OnPressShortcut()
{
	var objFocus = document.activeElement;
	if ( objFocus != document.body ) return;

	var cKey = String.fromCharCode( event.keyCode );
	var strLink = arrLinks[ cKey ];
	if ( !strLink ) return;

	var strLow = strLink;
	strLow.toLowerCase();
	var strTarget = arrTargets[ cKey ];
	var nPos = -1;
	
	nPos = strLow.indexOf( "javascript:" );
	if ( nPos >= 0 ) eval( strLink );
	else OnBtnClick( strLink, strTarget );
}

function AddShortcut( cKey, strLink )
{
	var nPos = -1;
	var strHREF = "";
	var strTarget = "";
	var cUpperKey = cKey;
	cUpperKey.toUpperCase();

	nPos = strLink.indexOf( " " );
	if ( nPos > 0 ) 
	{
		strHREF = strLink.substring( 0, nPos );
		nPos = strLink.indexOf( "target=" );
		if ( nPos > 0 ) strTarget = strLink.substr( nPos + 7 );
	}
	else strHREF = strLink;

	arrLinks[ cUpperKey ] = strHREF;
	arrTargets[ cUpperKey ] = strTarget;
}

function OnBtnClick( strLink, strTarget )
{
  if ( strTarget && strTarget.length > 0 ) window.open( strLink, strTarget );
  else document.location = strLink;
}

function GetStrWidth( str, nUnit )
{
  var i, nCode;
  var nWidth = 0;
  if ( !str ) return 0;

  for ( i = 0 ; i < str.length; i++ )
  {
    nCode = str.charCodeAt( i );
    if ( ( nCode < 0 ) || ( nCode > 127 ) ) nWidth += nUnit * 2;
    else nWidth += nUnit;
  }

  return nWidth;
}

function ForceQuote( str )
{
  var nDouble = 0;
  var ch;
  var i;

  ch = str.charCodeAt( 0 );
  if ( ( ch == 34 ) || ( ch == 39 ) ) return str;

  for ( i = 1 ; i < str.length - 1 ; i++ )
  {
    ch = str.charCodeAt( i );
    if ( ch == 39 )
    {
      nDouble = 1;
      break;
    }
  }

  if ( nDouble ) strQuote = "\"";
  else strQuote = "'";

  return ( strQuote + str + strQuote );
}

function GetBtnHREF( strLink )
{
  var strOnBtnClick = "";
  var nPos = -1;
  var strHREF = "";
  var strTarget = "";
  var strLow;

  strLow = strLink;
  strLow.toLowerCase();
  nPos = strLow.indexOf( "javascript:" );
  if ( nPos >= 0 ) return ForceQuote( strLink );

  nPos = strLink.indexOf( " " );
  if ( nPos > 0 ) strHREF = strLink.substring( 0, nPos );
  else strHREF = strLink;

  nPos = strLink.indexOf( "target=" );
  if ( nPos > 0 ) strTarget = strLink.substr( nPos + 7 );

  strHREF = ForceQuote( strHREF );
  strTarget = ForceQuote( strTarget );
  strOnBtnClick = "javascript:OnBtnClick( " + strHREF + " , " + strTarget + " )";
  strOnBtnClick = ForceQuote( strOnBtnClick );

  return strOnBtnClick;
}


function T2ButtonChangeCR(currentBtnID, strLiteCR, strMidCR, strDarkCR)
{
  var colLiteCR = document.getElementsByName("T2ButtonLiteCR_"+currentBtnID);
  var colMidCR = document.getElementsByName("T2ButtonMidCR_"+currentBtnID);
  var colDarkCR = document.getElementsByName("T2ButtonDarkCR_"+currentBtnID);

  for (var i=0; i<colLiteCR.length; i++)
    colLiteCR[i].bgColor = strLiteCR;
  for (var i=0; i<colMidCR.length; i++)
    colMidCR[i].bgColor = strMidCR;
  for (var i=0; i<colDarkCR.length; i++)
    colDarkCR[i].bgColor = strDarkCR;
}

var btnID = 0;

function T2Button(strBtnTitle, strLink, nWidth, nHeight, disable, strLiteCR, strMidCR, strDarkCR, strBorderCR, strLiteOverCR, strMidOverCR, strDarkOverCR, strCSS, strImg, nLeftGap, nImgGap, nRiteGap, cKey)
{
 
  var strFormat;

  btnID++;
  if (!strBtnTitle) strBtnTitle = "È® ÀÎ";
  if (!strLink) strLink = "#";
  if (!nWidth || (nWidth <= 0)) nWidth = GetStrWidth(strBtnTitle, 15);
  if (!nHeight || (nHeight <= 0)) nHeight = 20;
  if (!strLiteCR) strLiteCR = "#FFFFFF";
  if (!strMidCR) strMidCR = "#F7F7F7";
  if (!strDarkCR) strDarkCR = "#C4C4C4";
  if (!strBorderCR) strBorderCR = "#1F1F1F";

  if (!strLiteOverCR) strLiteOverCR = "#FFFFFF";
  if (!strMidOverCR) strMidOverCR = '#DEDEDE';
  if (!strDarkOverCR) strDarkOverCR = '#989898';


  if (!strCSS) strCSS = "black";
  if (!nImgGap) nImgGap = 4;

  strLink = GetBtnHREF( strLink );
  if (cKey) 
  {
    AddShortcut(cKey, strLink);
    strBtnTitle += " ("+cKey+")";
  }

  if (disable)
    strFormat = 
"<table id=saybutton border=0 width="+nWidth+" cellpadding=0 cellspacing=0 onmouseover=\"this.style.cursor='default'\">";
  else
    strFormat = 
"<table id=saybutton border=0 width="+nWidth+" cellpadding=0 cellspacing=0 onclick="+strLink+" onmousedown=\"T2ButtonChangeCR("+btnID+", '"+strDarkOverCR+"', '"+strMidOverCR+"', '"+strLiteOverCR+"');\" onmouseup=\"T2ButtonChangeCR("+btnID+", '"+strLiteOverCR+"', '"+strMidOverCR+"', '"+strDarkOverCR+"');\" onmouseover=\"this.style.cursor='hand';T2ButtonChangeCR("+btnID+", '"+strLiteOverCR+"', '"+strMidOverCR+"', '"+strDarkOverCR+"');\" onmouseout=\"T2ButtonChangeCR("+btnID+", '"+strLiteCR+"', '"+strMidCR+"', '"+strDarkCR+"');\">";
  document.write(strFormat);

  strFormat = 
"<tr height=1>"+
  "<td width=1 bgcolor="+strBorderCR+"></td>"+
  "<td width=1 bgcolor="+strBorderCR+"></td>"+
  "<td width=1 bgcolor="+strBorderCR+"></td>"+
  "<td width="+( nWidth - 6 )+" bgcolor="+strBorderCR+"></td>"+
  "<td width=1 bgcolor="+strBorderCR+"></td>"+
  "<td width=1 bgcolor="+strBorderCR+"></td>"+
  "<td width=1 bgcolor="+strBorderCR+"></td>"+
"</tr>";
  document.write(strFormat);

  strFormat = 
"<tr height=1>"+
  "<td bgcolor="+strBorderCR+"></td>"+
  "<td bgcolor="+strLiteCR+"></td>"+
  "<td id=T2ButtonLiteCR_"+btnID+" colspan=2 bgcolor="+strLiteCR+"></td>"+
  "<td id=T2ButtonLiteCR_"+btnID+" bgcolor="+strLiteCR+"></td>"+
  "<td bgcolor="+strLiteCR+"></td>"+
  "<td bgcolor="+strBorderCR+"></td>"+
"</tr>";
  document.write( strFormat );

  strFormat = 
"<tr height=1>"+
  "<td bgcolor="+strBorderCR+"></td>"+
  "<td bgcolor="+strLiteCR+"></td>"+
  "<td bgcolor="+strMidCR+"></td>"+
  "<td id=T2ButtonMidCR_"+btnID+" bgcolor="+strMidCR+" align=center>";

  if (strImg && (strImg.length > 1))
  {
    strFormat += "<table border=0 cellpadding=0 cellspacing=0><tr>";
    if (nLeftGap) strFormat += "<td width="+nLeftGap+"></td>";

    if (disable)
      strFormat += "<td><img src='"+strImg+"' border=0></td>";
    else
      strFormat += "<td><a href="+strLink+" onclick='window.event.returnValue=false' class="+strCSS+"><img src='"+strImg+"' border=0></a></td>";

    strFormat += "<td width="+nImgGap+"></td>";
    if (disable)
      strFormat += "<td class='"+strCSS+"'>"+strBtnTitle+"</td>";
    else
      strFormat += "<td class='"+strCSS+"'><a href="+strLink+" onclick='window.event.returnValue=false' class="+strCSS+">"+strBtnTitle+"</a></td>";

    if (nRiteGap) strFormat += "<td width="+nRiteGap+"></td>";
    strFormat += "</tr></table>";
  }
  else
  {
    strFormat += "<table border=0 cellpadding=0 cellspacing=0>";
    strFormat += "<tr height="+((nHeight-11-4)/2)+"><td></td></tr>";
    strFormat += "<tr><td class="+strCSS+">";

    if (disable)
      strFormat += strBtnTitle;
    else
      strFormat += "<a href="+strLink+" onclick='window.event.returnValue=false' class="+strCSS+">"+strBtnTitle+"</a>";

    strFormat += "</td></tr>";
    strFormat += "</table>";
  }

  strFormat += 
  "</td>"+
  "<td id=T2ButtonMidCR_"+btnID+" bgcolor="+strMidCR+"></td>"+
  "<td id=T2ButtonDarkCR_"+btnID+" bgcolor="+strDarkCR+"></td>"+
  "<td bgcolor="+strBorderCR+"></td>"+
"</tr>";

  document.write(strFormat);

  strFormat = 
"<tr height=1>"+
  "<td bgcolor="+strBorderCR+"></td>"+
  "<td bgcolor="+strLiteCR+"></td>"+
  "<td id=T2ButtonDarkCR_"+btnID+" colspan=2 bgcolor="+strDarkCR+"></td>"+
  "<td id=T2ButtonDarkCR_"+btnID+" bgcolor="+strDarkCR+"></td>"+
  "<td bgcolor="+strDarkCR+"></td>"+
  "<td bgcolor="+strBorderCR+"></td>"+
"</tr>";
  document.write(strFormat);

  strFormat = 
"<tr height=1>"+
  "<td width=1 bgcolor="+strBorderCR+"></td>"+
  "<td width=1 bgcolor="+strBorderCR+"></td>"+
  "<td width=1 bgcolor="+strBorderCR+"></td>"+
  "<td width="+( nWidth - 6 )+" bgcolor="+strBorderCR+"></td>"+
  "<td width=1 bgcolor="+strBorderCR+"></td>"+
  "<td width=1 bgcolor="+strBorderCR+"></td>"+
  "<td width=1 bgcolor="+strBorderCR+"></td>"+
"</tr>";
  
  document.write(strFormat);

  strFormat = "</table>";
  document.write(strFormat);
}

