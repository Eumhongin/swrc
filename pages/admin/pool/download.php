<?
	
	$path = "../../pool/data";
	$tempfile = $file;
	//$file = $HTTP_POST_VARS[$tempfile];
	$chfile = $path."/".$file;

	#chmod($path, 0700);
	

	if(file_exists($chfile)) {
	 
		 $FILE = fopen($chfile, "r");

		 if($FILE) { 
		
			 $fp = fread($FILE, filesize($chfile));
				

				Header("Content-Disposition:attachment; filename=$file"); 
				Header("Content-Type: file/unknown"); 
				Header("Content-Length: ".filesize($chfile)); 
				Header("Content-type: application/octet-stream;\n\n");
				Header("Pragma: no-cache"); 
				Header("Expires: 0");  
 
				echo($fp);  
				
				fclose($FILE);
				
					
		 } else {
				 echo "<script>alert('파일($chfile)열기 실패');
						history.back();
					 </script>";
				 exit();
		 }        
	  
	}
	else {
		 echo "<script>alert('파일($chfile)이 존재하지 않습니다');
			 history.back();
			</script>";
			exit();	 
	} 
	
	#chmod($path, 0000);
	//chmod($path, 0777);

?>
