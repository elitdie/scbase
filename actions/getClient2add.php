<?php
error_reporting(E_WARNING);
/**
 *
 *
 * @version $Id$
 * @copyright 2012
 */
include('../inc/connect.php');

if(isset($_GET[term])){
	$query = mysql_query("select `id`,`lastname`,`name`,`surname`,`phone1`,`phone2`,`address`,`email`,`type`,`cl_categorie_id` from `client` where `lastname` like '$_GET[term]%'");
	while($row = mysql_fetch_array($query)) {
		$arr[label] = "$row[lastname] $row[name] $row[surname] ($row[phone1])";
		$arr[lastname] = $row[lastname];
		$arr[name] = $row[name];
		$arr[surname] = $row[surname];
		$arr[id] = $row[id];
		$arr[phone1] = $row[phone1];
		$arr[phone2] = $row[phone2];
		$arr[address] = $row[address];
		$arr[email] = $row[email];
		$arr[type] = $row[type];
		$arr[cl_categorie_id] = $row[cl_categorie_id];
		$return[] = json_encode($arr);
		unset($arr);
	}
	echo '['.implode(',',$return).']';
}

//$arr = array('label' => 'Петроф', 'desc' => 'Сирега');
//$arr2 = array('label' => 'Петрофа', 'desc' => 'Надин');
//
//echo '['.json_encode($arr).','.json_encode($arr2).']';
//echo '{
//	value: "питроф",
//	label: "Петров",
//	desc: "the write less, do more, JavaScript library",
//	icon: "jquery_32x32.png"
//},
//{
//	value: "Петруха",
//	label: "Петруха",
//	desc: "the official user interface library for jQuery",
//	icon: "jqueryui_32x32.png"
//},
//{
//	value: "sizzlejs",
//	label: "Sizzle JS",
//	desc: "a pure-JavaScript CSS selector engine",
//	icon: "sizzlejs_32x32.png"
//}';
?>