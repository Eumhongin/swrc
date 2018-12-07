<?php include('dbconnect.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      .content img{
        width: 100%;
      }
    </style>
  </head>
  <body>

    <h1>bbs_notice</h1>
    <hr>
      <?php

      // $id = $_POST['id'];
      // //$name = iconv("UTF-8", "UTF8_general_ci", $_POST['name']);
      // $name = $_POST['name'];
      // echo $name;
      // // if (!$conn->set_charset("EUC-KR")) {
      // //     printf("Error loading character set utf8: %s\n", $conn->error);
      // //     exit();
      // // } else {
      // //     printf("Current character set: %s\n", $conn->character_set_name());
      // // }
      //
      //
      //
      // $query = "INSERT INTO hongin VALUES('".$id."','".$name."')";
      // mysqli_query($conn,$query);
      //mysqli_close($conn);
      //echo "<script>document.location.href='test.html'</script>";
      $sql = "SELECT * FROM bbs_notice";
      // if (!$conn->set_charset("utf8")) {
      //     printf("Error loading character set utf8: %s\n", $conn->error);
      //     exit();
      // } else {
      //     printf("Current character set: %s\n", $conn->character_set_name());
      // }
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
        $b_content = $row['b_content'];
        $b_subject = $row['b_subject'];
        // echo "<tbody><td>".$row['b_num']."</td><td>".$row['a_num']."</td><td>".$row['b_top']."</td><td>".$row['b_id']."</td><td>".$row['b_category']."</td><td>".$row['b_date']."</td><td>".$row['b_writer']."</td><td>".$row['b_subject']."</td><td>".$row['b_regdate']."</td><td>".$row['b_count']."</td></tbody>";
        ?>


        <div class="wrapper" style="width:80%;margin:0 auto;;box-shadow:0 2px 5px rgb(182, 182, 182);margin-top:10px;padding:5%;box-sizing:border-box;">
          <p>SubTitle : <?= html_entity_decode($b_subject)?></p>
          <hr>
          <div class="content">
            <?=html_entity_decode($b_content)?>
          </div>
        </div>
        <?php
      }
      ?>
      <h1>bbs_data</h1>
      <hr>
      <?php
      $sql = "SELECT * FROM bbs_data";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
        $b_content = $row['b_content'];
        $b_subject = $row['b_subject'];
        // echo "<tbody><td>".$row['b_num']."</td><td>".$row['a_num']."</td><td>".$row['b_top']."</td><td>".$row['b_id']."</td><td>".$row['b_category']."</td><td>".$row['b_date']."</td><td>".$row['b_writer']."</td><td>".$row['b_subject']."</td><td>".$row['b_regdate']."</td><td>".$row['b_count']."</td></tbody>";
        ?>


        <div class="wrapper" style="width:80%;margin:0 auto;;box-shadow:0 2px 5px rgb(182, 182, 182);margin-top:10px;padding:5%;box-sizing:border-box;">
          <p>SubTitle : <?= html_entity_decode($b_subject)?></p>
          <hr>
          <div class="content">
            <?=html_entity_decode($b_content)?>
          </div>
        </div>
        <?php
      }

       ?>



      <?php
      mysqli_close($conn);
      // <td>".$row['b_subject']."</td>




      ?>

  </body>
</html>
