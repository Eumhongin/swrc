//공백체크
function CheckSpaces(str,m,event) {
    var flag=true;
    var strValue = str.value;
 
    if (strValue!=" ") {
       for (var i=0; i < strValue.length; i++) {
          if (strValue.charAt(i) != " ") {
             flag=false;
             break;
          }
       }
    }
	if(flag == true) {
       alert( m );
       if(event == 0)	 str.focus();
    }
   
    return flag;
}

//숫자 체크
function Digit( str, m, min ) {
   var flag = false;
   var Digit= "1234567890";

   for(i=0; i<str.value.length;i++) {

	 if(Digit.indexOf(str.value.substring(i, i+1)) == -1){	
		alert(m + "은(는) 숫자만 사용하실 수 있습니다.");
		str.value = "";
		str.focus();	
		flag = true;

		return flag;
		
		break;
	  }
	  
	}

	if(str.value < min) {
	   alert(m + "은(는) "+ min +"보다 작게 입력할 수 없습니다");
	   str.focus();	
	   flag = true;
	}	
   	return flag;
   
}  

//영문,숫자 체크
function alphaDigit( str, m ) {
   var flag = false;
   var alphaDigit= "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
  
   for(i=0; i<str.value.length;i++) {

	 if(alphaDigit.indexOf(str.value.substring(i, i+1)) == -1){	
		alert(m + "은(는) 영문/숫자만 사용하실 수 있습니다.");
		str.focus();	
		flag = true;
		break;
	  }
	  
    }
    return flag;
   
}   

//길이 체크
function CheckLen( str, start, end ) {
	var flag = false;

	if ( str.value.length < start && str.value.length < end ) {
			alert(start + "~" + end + "자 이내로 입력하여 주십시오");
			str.focus();	
			flag = true;
   }

   return flag;
}


// 주민등록 체크
function jumin_chk(jumin1,jumin2) {
 var chk =0
 var yy  = jumin1.value.substring(0,2)
 var mm  = jumin1.value.substring(2,4)
 var dd  = jumin1.value.substring(4,6)
 var sex = jumin2.value.substring(0,1)
 
 var today = new Date();
 var curr_year = today.getYear();
 curr_year += 1900;
 
 var birth_year = 1900 + parseInt(yy);
 
 // End of Hangul Check Function
 
  if ((jumin1.value.length != 6 )||
       (yy <25 || mm <1 || mm>12 ||dd<1) )
   {
     alert ("주민등록번호를 바로 입력하여 주십시오.");
     jumin1.focus();
     return true;
   }
 
   if ((sex != 1 && sex !=2 )|| (jumin2.value.length != 7 ))
   {
     alert ("주민등록번호를 바로 입력하여 주십시오.");
     jumin2.focus();
     return true;
   }   
 
   
 // 주민등록번호 validation check
 
   for (var i = 0; i <=5 ; i++){ 
 	chk = chk + ((i%8+2) * parseInt(jumin1.value.substring(i,i+1)))
  }
   for (var i = 6; i <=11 ; i++){ 
         chk = chk + ((i%8+2) * parseInt(jumin2.value.substring(i-6,i-5)))
  }
 
 
   chk = 11 - (chk %11)
   chk = chk % 10
 
 
   if (chk != jumin2.value.substring(6,7))
   {
     alert ("유효하지 않은 주민등록번호입니다.");
     jumin1.focus();
     return true;
   }
   
    return false;
}


function CheckEqual( str1, str2, m ) {
	var flag = false;

	if ( str1.value !=  str2.value ) {
		alert(m + "가 같지 않습니다");
		str2.value="";
		str2.focus();
		flag = true;
	}
	 return flag;
}


//아이디 체크
function IDCheck( str, m ) {
   var flag = false;
   var strvalue = "abcdefghijklmnopqrstuvwxyz1234567890-_";
  
   for(i=0; i<str.value.length;i++) {

	 if(strvalue.indexOf(str.value.substring(i, i+1)) == -1){	
		alert(m + "은(는) 영문소문자,숫자, (-,_)의 조합으로 이루어져야 합니다");
		str.focus();	
		flag = true;
		break;
	  }
	  
    }
    return flag;
   
}   


 //우편번호..
function zipcode(){
 window.open("/member/zipcode.php","zipcode","scrollbars=yes,toolbar=no,directories=no,menubar=no,resizable=yes,status=no,width=431,height=400'");
}