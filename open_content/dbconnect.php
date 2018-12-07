<?php

$conn = mysqli_connect('localhost','root','admin','strc');
if (!$conn->set_charset("utf8")) {
  printf("Error loading character set utf8: %s\n", $conn->error);
  exit();
} else {
  printf("Current character set: %s\n", $conn->character_set_name());
}
 ?>
