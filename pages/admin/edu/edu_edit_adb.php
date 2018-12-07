<?
session_start();
include "../lib/admin_session_chk.php";
include "../inc/mysql.php";


$cnt_sql = "SELECT MAX(luid) AS luid FROM edu_list";
$cnt_que = mysql_query($cnt_sql);
$cnt_res = mysql_fetch_array($cnt_que);

$new_luid = $cnt_res[luid]+1;

$sql = "INSERT INTO edu_list VALUES (".$new_luid.", ".$uid.", '".$l_subject."', '".$other."')";
$que = mysql_query($sql);

if(!$que)
{
		echo "ERROR: 0016";
}
else
{
		echo "<meta http-equiv='Refresh' content='0; URL=edu_edit.php?kind=".$kind."&uid=".$uid."'>";
}





/*
echo "luid = ".$cnt_res[luid]."<br>";
echo $uid."<br>";
echo $kind."<br>";
echo $l_subject."<br>";
echo $other."<br>";
*/
?>