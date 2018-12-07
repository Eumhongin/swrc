<?

	session_start();

  $self = $PHP_SELF;
	
	if(ereg("regist.php",$self) or ereg("register.php",$self)) $self = "/";

  if($QUERY_STRING) $self .= "?".$QUERY_STRING;
	$self = urlencode($self);

  if($HTTP_SESSION_VARS["duid"] == "") {
	echo "<script>alert('회원 로그인 정보가 없습니다');history.back(-1);</script>"; 
    #echo "<script>alert('회원 로그인 정보가 없습니다');"; 
    #echo "location.href='/member/login.php?url=$self';</script>";
  }
?>