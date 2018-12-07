<?

function cut_str($str, $len, $suffix = '')
	{
	 $str = strip_tags(stripslashes(trim($str)));

	 if(strlen($str) > $len)
	 {
	  $cnt = 0;
	  $len2 = $len;
	  $str2 = '';

	  for($i = 0; $i < $len2 ; $i++)
	  {
	   $cut = ord(substr($str, $i, 1));

	   if($cut > 127)
	   {
		$cnt++;
		$str2 .= substr($str, $i, 2);
		$i++;
		$len2++;
	   }

	   else
	   {
		$str2 .= substr($str, $i, 1);
	   }
	  }
	 }

	 return $str = $str2 . $suffix;
	}

	//���� ������ �Խù� ���� �ѷ��ִ� �Լ�
	//�޴� �ε���, �Խ��� �ڵ�, ���̺���, ���� ��ȣ, �� ��ȣ, ī�װ��� ���뿩��
	function mainBoardList($menuIdx, $a_idx, $a_tablename, $StartNum, $PostNum, $a_category){
		$count1 = New MySql_DB();
		$count1->Connect();
		$mysqli = $count1->conn;

		/* check connection */
		if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
		}


		//printf("Initial character set: %s\n", $mysqli->character_set_name());

		/* change character set to utf8 */
		if (!$mysqli->set_charset("utf8")) {
				printf("Error loading character set utf8: %s\n", $mysqli->error);
				exit();
		} else {
				printf("Current character set: %s\n", $mysqli->character_set_name());
		}

		$qry .= " SELECT b_id, b_top, b_num, b_date, b_category, b_subject, b_writer,b_regdate";
		$qry .= "  FROM $a_tablename ";
		$qry .= " Where b_top = 'N' ";
		$qry .= " AND b_look = '0' ";
		//$qry .= " Where b_look = '0' ";
		$qry .= " Order By b_num Desc Limit $StartNum, $PostNum ";
		//echo "<script>console.log('lets go Exec?');</script>";
		$count1->ParseExec($qry);



		while($col = mysqli_fetch_array($count1->stmt,MYSQLI_BOTH)) {

			$b_id = $col["b_id"];						//게시글아이디
			$b_top = $col["b_top"];					//상단고정인지아닌지
			$b_num = $col["b_num"];
			$b_date = $col["b_date"];
			$b_category = $col["b_category"];
			$b_subject = $col["b_subject"];
			$b_writer = $col["b_writer"];
			$b_regdate  = explode(" ", $col["b_regdate"]);

			$len = strlen($b_subject);
			if($len > 26){
				//echo "<script>alert('$b_subject')</script>";
				echo "<script>console.log('$b_subject');</script>";
				$b_subject = substr($b_subject, 0, 35);
				echo "<script>console.log('$b_subject');</script>";
				$b_subject = cut_str($b_subject, 20, "");
				echo "<script>console.log('$b_subject');</script>";
				$b_subject = $b_subject."..";
			}


			// if($a_category == "Y") {
			// 	$mysql2 = new Mysql_DB;
			// 	$mysql2->Connect();
			//   $mysqli = $mysql2->conn;
			//
			//   /* check connection */
			//   if (mysqli_connect_errno()) {
			//       printf("Connect failed: %s\n", mysqli_connect_error());
			//       exit();
			//   }
			//
			//
			//   printf("Initial character set: %s\n", $mysqli->character_set_name());
			//
			//   /* change character set to utf8 */
			//   if (!$mysqli->set_charset("utf8")) {
			//       printf("Error loading character set utf8: %s\n", $mysqli->error);
			//       exit();
			//   } else {
			//       printf("Current character set: %s\n", $mysqli->character_set_name());
			//   }
			//
			// 	$sql =  " Select c_catename From bbs_admin_cate Where c_tablename='$a_tablename' and c_cate = $b_category ";
			//
			// 	$mysql2->ParseExec($sql);
			// 	$mysql2->FetchInto($cate);
			//
			// 	$cateName = $cate[c_catename];
			//
			// 	$mysql2->ParseFree();
			//
			// }

			//new ������
			$new_icon = strtotime("-3 day");
			$new_icon = date("Y-m-d", $new_icon);


		?>
			<li><span class="subject">
				<a href="/open_content/sub.php?menuIdx=<?=$menuIdx?>&amp;page=/pages/bbs/view.php&amp;a_idx=<?=$a_idx?>&amp;b_num=<?=$b_num?>&pn=<?=$pn?> ">
				<img src="/images/main/dot.jpg" class="pad_t3"><span class="f_gray"><?=$b_subject?></span>
				</a>
				<?if($b_regdate[0] > $new_icon){ //�����ϰ���?>
				<img src="/images/main/icon_new.gif" alt="����" class="vmiddle" />
				<?}?>
			</span>
			<span class="date"><?=$b_regdate[0]?></span>
			</li>
		<?

		}


		mysqli_close($mysqli);
		echo "<script>console.log('finish!');</script>";


	}


	//���� ������ �˸�â
	function mainPopupZone(){
		$mysql = new Mysql_DB;
		$mysql->Connect();

		$qry = "Select * from t_image_window Where image_use_flag = 'Y' Order By image_order DESC";

		$mysql->ParseExec($qry);
		$popupNum = 0;
		while($mysql->FetchInto($col)) {

			$idx = $col[idx];
			$image_name = $col[image_name];
			$image_alt = $col[image_alt];
			$image_link = $col[image_link];
			$image_target = $col[image_target];
			$window_name = $col[window_name];

			$tempTitle = "";
			if($image_target == "_blank"){
				$tempTitle = "title = \"��â\" ";
			}

		?>
			<li>
				<a href="#self" onmouseover="popupZoneMove(<?=$popupNum+1?>); return false;" onfocus="this.onmouseover();" onmouseout="popupZoneStop(0); return false;" onblur="this.onmouseout();"><img id="popNum<?=$popupNum+1?>" src="/images/main/popupzone_<?=$popupNum+1?>_off.gif" alt="<?=$popupNum+1?>" /></a>
			   <div id="bannerZone_<?=$popupNum+1?>" class="popupZoneImage">
					<?if($image_link == ""){?>
						<img src="/up_file/imageWindow/<?=$image_name?>" width="300" height="130" alt="<?=$image_alt?>" />
					<?}else{?>
					<a href="<?=$image_link?>" target="<?=$image_target?>" <?=$tempTitle?> onmouseover="popupZoneMove(<?=$popupNum+1?>); return false;" onfocus="this.onmouseover();" onmouseout="popupZoneStop(0); return false;" onblur="this.onmouseout();"><img src="/up_file/imageWindow/<?=$image_name?>" alt="<?=$image_alt?>" width="300" height="130" /></a>
					<?}?>
				</div>
			</li>
		<?
			$popupNum ++;
		}

		$mysql->ParseFree();
		$mysql->Disconnect();

	}

?>
