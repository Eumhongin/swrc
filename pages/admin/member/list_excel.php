<?  
  Header("Content-type: application/vnd.ms-excel");
  Header("Content-type: charset=euc-kr");
  header("Content-Disposition: attachment; filename=memberList.xls");
  Header("Content-Description: PHP4 Generated Data");
  Header("Pragma: no-cache");
  Header("Expires: 0");
?>
<?
	//*******************  Information  ***********************
	//	Program Title :	ȸ������Ʈ
	//	File Name		  :	list.php
	//	Company			  :	(��)��������� (053)955-9055
	//	Creator			  :	�� �� ��   2003. 10
	//*********************************************************
	session_start();

  include("../../admin_security.php");
	include("../../../config/comm.inc.php"); 
	// *** mysql connect class *****
	include("../../../config/mysql.inc.php");  
	$mysql = new Mysql_DB;
	$mysql->Connect();

	$m_query = " Where 1=1 "; 
  

 // $m_query = $m_query. " not_user = 0 ";                //����� ȸ��
 // $m_query = $m_query. " Order by in_day desc";

  //��ü ȸ������ ���Ѵ�
  $total_qry = "Select * From members ";
  $total_qry .= $m_query; 
	$mysql->ParseExec($total_qry); 
	$total = $mysql->RowCount();
	$mysql->ParseFree();

	// ����Ʈ �������� ������ �����ش�
	$qry = "select * from members ";
	$qry .= $m_query;

	$mysql->ParseExec($qry); 
?>
<html>
<head>
<title>ȸ������</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" type="text/css" href="/bbs/style.css">
<script src="/bbs/js/comm.js"></script>
<script src='/js/eButton.js'></script>
</head>
<body topmargin="20">
	<table width="950" cellpadding="3" cellspacing="1" bgcolor="#D5D5D5">
		<tr bgcolor="#F7F7F7" class="td" align="center" height="25"> 
			<td width="45" bgcolor="#EEF8FF"><b>��ȣ</b></td>
			<td width="80" bgcolor="#EEF8FF"><b>���̵�</b></td>
			<td width="90" bgcolor="#EEF8FF">�̸�</td>
			<td width="125" bgcolor="#EEF8FF"><b>�Ҽ�</b></td>
			<td width="125" bgcolor="#EEF8FF"><b>�̸���</b></td>
			<td width="120" bgcolor="#EEF8FF"><b>����ó</b></td>
			<td width="80" bgcolor="#EEF8FF"><b>���Գ�¥</b></td>
			<td width="100" bgcolor="#EEF8FF">���</td>
			<td width="60" bgcolor="#EEF8FF"><b>����</b></td>
          <td width="60" bgcolor="#EEF8FF"><b>SMS</b></td>
		</tr>
<?
	if ($total > 0) {
		$i = $total;
		 while($mysql->FetchInto(&$col)) { 
		
?>
		<tr bgcolor="#FFFFFF" align="center">
			<td><? echo $i-- ?></td>
			<td><? echo $col["user_id"] ?></a></td>
			<td><? echo $col["user_name"] ?></td>
		    <td><? echo $col["in_ent"] ?> </td>
			<td><? echo $col["email"] ?></td>
			<td><? echo $col["tel"] ?></td>
			<td><? echo $col["in_day"]?></td>
			<td>
<? 
	 //ȸ�� ���
   $mysql2 = New MySql_DB();
   $mysql2->Connect();
	 
   $qry1 = "Select * From m_level Order by l_level Asc";
	 $mysql2->ParseExec($qry1);

	 while($mysql2->FetchInto(&$col2)) { 
?> 	 
<? if($col2["l_level"]==$col["ch_member"]){ echo $col2["l_levelname"];} ?>
<? } ?>
			</td>
			<td><? echo $newsletter ?></td>
			<td><? echo $sms ?></td>
				</tr>
<?		} //while member
				
	} //count > 0
?>
</table>

</body>
</html>


<?
	$mysql->Disconnect();
?>
