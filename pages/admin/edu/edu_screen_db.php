<?
session_start();
include "../lib/admin_session_chk.php";
include "../inc/mysql.php";



# ���� ���ε�
if($add_file)
{
	# ���� ũ�⸦ ���Ѵ�.
	$file_size = $add_file_size;

	# �̹��� ũ�⸦ ���Ѵ�.
	$add_file_wh = getimagesize($add_file);	# wh : w = width, h = height
	$imgsize	 =  $add_file_wh[0]."X".$add_file_wh[1];


	#�̹����� ���ε��� ���
	$save_dir = "../up_file/edu_screen";

	##### ���Ұ� ���� �Ǻ� image1
	$filename = explode(".", $add_file_name);
	$extension = $filename[sizeof($filename)-1];

	if(trim($extension) != "gif" and trim($extension) != "GIF" and trim($extension) != "jpg" and trim($extension) != "JPG" and trim($extension) != "jpeg" and trim($extension) != "JPEG")
	{
		?>
		<script language="JavaScript" type="text/JavaScript">
		<!--
			alert("gif, jpg, jpeg ���ϸ� ��� �����մϴ�.");
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
			alert("������ ������ ���丮�� �����ϴµ� �����߽��ϴ�. ������ ���� �ٶ��ϴ�.");
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
			alert("�ӽ������� �����ϴµ� �����߽��ϴ�.");
			return;
		//-->
		</script>
		<?
		exit;
	}
}


$cnt_que = mysql_query("SELECT MAX(uid) AS uid FROM edu_screen");
$cnt_res = mysql_fetch_array($cnt_que);

$new_uid = $cnt_res[uid] + 1;

$stime = mktime(13,0,0, $cmonth, $cday, $cyear);



$sql = "insert into edu_screen values (".$new_uid.", '".addslashes($subject)."', ".$stime.", '".addslashes($content)."', '".$add_file_name."')";
$que = mysql_query($sql);

if(!$que)
{
		echo "ERROR: 0016";
}
else
{
		echo "<meta http-equiv='Refresh' content='0; URL=edu_screen.php'>";
}

?>
















