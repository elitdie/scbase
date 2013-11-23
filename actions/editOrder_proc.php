<?php
include('../inc/connect.php');

var_dump($_REQUEST);

echo $query = "UPDATE `orders` SET `comment` = '$_REQUEST[comment]' WHERE `id` = $_REQUEST[comment_id]";

?>