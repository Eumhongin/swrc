<?

	session_start();

  $self = $PHP_SELF;
	
	if(ereg("regist.php",$self) or ereg("register.php",$self)) $self = "/";

  if($QUERY_STRING) $self .= "?".$QUERY_STRING;
	$self = urlencode($self);

  if($HTTP_SESSION_VARS["duid"] == "") {
	echo "<script>alert('ȸ�� �α��� ������ �����ϴ�');history.back(-1);</script>"; 
    #echo "<script>alert('ȸ�� �α��� ������ �����ϴ�');"; 
    #echo "location.href='/member/login.php?url=$self';</script>";
  }
?>