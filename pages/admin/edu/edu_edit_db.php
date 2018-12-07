<?
	include("../../config/mysql.inc.php");     //** 접속통계
	include("../../config/comm.inc.php");

	$pageUrl .= $pageName;

	$mysql = new Mysql_DB;
	$mysql->Connect();


function uploadFile($oFile, $oFilename, $destDir)
{
	$newFilename = str_replace(" ", "_", $oFilename);
	$i = 1;
	$tmpFilename = explode(".", $newFilename);
	while (file_exists("$destDir/$newFilename"))
	{
		$tmpRoot = $tmpFilename[0]."_$i";
		$newFilename = $tmpRoot.".".$tmpFilename[1];

		$i++;
	}

	if (strtolower(substr($newFilename,strlen($newFilename)-4,4)) == ".php" or strtolower(substr($newFilename,strlen($newFilename)-5,5)) == ".php3")
	{
		echo "<script type=\"text/javascript\">alert('PHP파일은 업로드가 불가능합니다.'); history.back();</script>";
		exit;
	}

	if (is_uploaded_file($oFile))
	{
		if (!move_uploaded_file($oFile, "$destDir/$newFilename"))
		{
			return false;
		}
	}

	return $newFilename;

}


function deleteFile($oFile, $filePath)
{
	unlink($filePath."/".$oFile);
}



#echo $file."<br>";
// upload file
if ($file)
{
	$filename = uploadFile($file, $file_name, "./../../up_file/edu");
	if (!$filename)
	{
		echo "<script type=\"text/javascript\">alert('업로드 에러');history.back();</script>";
		exit;
	}
}

$sdate = mktime($sTime, 0,0, $sMonth, $sDay, $sYear);
$edate = mktime($eTime, 0,0, $eMonth, $eDay, $eYear);



$sql  = "UPDATE edu SET ";
$sql .= " kind = '".$kind."'";
$sql .= ", subject = '".$subject."'";
$sql .= ", sdate = '".$sdate."'";
$sql .= ", edate = '".$edate."'";
$sql .= ", stime = '".$sTime."'";
$sql .= ", etime = '".$eTime."'";
$sql .= ", t_time = '".$t_time."'";
$sql .= ", price = '".$price."'";
$sql .= ", room = '".$room."'";
$sql .= ", t_person = '".$t_person."'";
$sql .= ", teach = '".$teach."'";
$sql .= ", damdang = '".$damdang."'";
$sql .= ", content1 = '".$content1."'";
$sql .= ", content2 = '".$content2."'";
if($file) { $sql .= ", up_file = '".$filename."'"; }
$sql .= " WHERE uid = ".$uid;

#$sql = "INSERT INTO edu values ('', '".$kind."', '".$subject."', '".$sdate."', ".$edate.", '".$sTime."', '".$eTime."', '".$t_time."', '".$price."', '".$room."', '".$t_person."', '".$teach."', '".$damdang."', '".addslashes($content1)."', '".addslashes($content2)."', '".$filename."')";
$que = mysql_query($sql);

if(!$que)
{
	echo "ERROR :0028";
	exit;
}



if($que)
{
		echo	"
						<script type=\"text/javascript\">
							alert('".$subject." 강좌가 등록되었습니다.');
							location.href='".$pageUrl."&page=/pages/admin/edu/edu.php';
						</script>
					";
}


/*
echo $l_subject[0]."<br>";
echo $l_subject[1]."<br>";
echo $l_subject[2]."<br>";
echo $l_subject[3]."<br>";
echo $l_subject[4]."<br>";
echo $l_subject[5]."<br>";
echo $other[1]."<br>";
echo sizeof($l_subject);
*/
?>



