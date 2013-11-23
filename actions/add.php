<head><meta http-equiv="refresh" content="1;URL=index.php"></head>
<?php

//var_dump($query);
if(isset($_REQUEST[client_id])) $maxid = $_REQUEST[client_id];
else {
	$query = mysql_query("insert `client` values (0,'$_REQUEST[name]','$_REQUEST[lastname]','$_REQUEST[surname]','$_REQUEST[phone1]','$_REQUEST[phone2]','$_REQUEST[address]','$_REQUEST[email]','$_REQUEST[type]',".$_REQUEST[cl_categorie][0].")");
	$maxid = mysql_insert_id();
}

$query = mysql_query("insert `orders` values (0,'$_REQUEST[number]','$_REQUEST[date_get]','$_REQUEST[date_plan]',0,$maxid,0,'Принято','',$_REQUEST[employee_id])");
$maxorder = mysql_insert_id();

for ($i=0;$i<sizeof($_REQUEST[item_type]);$i++) {
	$item_type = $_REQUEST[item_type][$i];
	$item = $_REQUEST[item_name][$i];
	$sn = strtoupper($_REQUEST[item_sn][$i]);
	$color = $_REQUEST[item_color][$i];
	$problem = $_REQUEST[item_problem][$i];
	$query = mysql_query("insert `item` values (0,$maxid,$item_type,'$item','$sn','$color','$problem')");
	$items_id[] = mysql_insert_id();
	//var_dump($query);
}

foreach($items_id as $k => $maxitem) {
	$query = mysql_query("insert `orders_has_item` values ($maxorder,$maxitem)");
	//var_dump($query);
}
echo '<p class="goodjob">Заявка успешно добавлена</p>'
?>
