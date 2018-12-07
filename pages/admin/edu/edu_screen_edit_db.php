<?
session_start();
include "../lib/admin_session_chk.php";
include "../inc/mysql.php";


$que = mysql_query("SELECT * FROM edu_screen WHERE uid = ".$uid);
$res = mysql_fetch_array($que);

$img_name = $res[up_file];


if($add_file)
{
	@unlink("../up_file/edu_screen/".$img_name);
	
	# 파일 크기를 구한다.
	$file_size = $add_file_size;

	# 이미지 크기를 구한다.
	$add_file_wh = getimagesize($add_file);	# wh : w = width, h = height
	$imgsize	 =  $add_file_wh[0]."X".$add_file_wh[1];


	#이미지를 업로드할 경로
	$save_dir = "../up_file/edu_screen";

	##### 허용불가 파일 판별 image1
	$filename = explode(".", $add_file_name);
	$extension = $filename[sizeof($filename)-1];

	if(trim($extension) != "gif" and trim($extension) != "GIF" and trim($extension) != "jpg" and trim($extension) != "JPG" and trim($extension) != "jpeg" and trim($extension) != "JPEG")
	{
		?>
		<script language="JavaScript" type="text/JavaScript">
		<!--
			alert("gif, jpg, jpeg 파일만 등록 가능합니다.");
			return;
		//-->
		</script>
		<?
		exit;
	}

	$dest = $save_dir."/".$add_file_name;


	/*
	if(file_exists($dest))
	{
		$dest = $save_dir."/".$num."_".$Vars[add_file_name];
		$Vars[add_file_name] = $num."_".$Vars[add_file_name];			
	}
	*/

	if(!copy($add_file, $dest))
	{
		?>
		<script language="JavaScript" type="text/JavaScript">
		<!--
			alert("파일을 지정한 디렉토리에 복사하는데 실패했습니다. 관리자 문의 바랍니다.");
			return;
		//-->
		</script>
		<?
		exit;
	}
	
	if(!unlink($add_file))
	{
		?>
		<script language="JavaScript" type="text/JavaScript">
		<!--
			alert("임시파일을 삭제하는데 실패했습니다.");
			return;
		//-->
		</script>
		<?
		exit;
	}

	$add_sql = ", up_file = '".$add_file_name."' ";
}


$stime = mktime(13,0,0, $cmonth, $cday, $cyear);

$que = mysql_query("UPDATE edu_screen SET subject = '".addslashes($subject)."', stime = ".$stime.", content='".addslashes($content)."' ".$add_sql." WHERE uid = ".$uid);

if(!$que)
{
		echo "ERROR: 0016";
}
else
{
?>
	<SCRIPT LANGUAGE=javascript>
	<!--
		parent.opener.location.href="edu_screen.php";
		self.close();
	//-->
	</SCRIPT>
<?
		#echo "<meta http-equiv='Refresh' content='0; URL=edu_screen.php'>";
}

?>





