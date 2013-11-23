<?php
error_reporting(E_WARNING);
require('../inc/db.php');
if(!mysql_query("delete from `orders` where id = $_REQUEST[delete_id]")) $err=1;
if($err==0) echo 'Заявка удалена!';
	else echo mysql_error();
?>
