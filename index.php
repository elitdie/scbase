<html>
<head>
<title>База элприс</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="scbase.css">
<link type="text/css" href="scripts/js/jquery-ui/scbase_old/jquery-ui-1.8.22.custom.css" rel="Stylesheet" />
<link type="text/css" href="scripts/js/fancybox/jquery.fancybox-1.3.4.css" rel="Stylesheet" />
<script src="scripts/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="scripts/js/jquery-ui/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
<script src="scripts/js/jquery-ui/jquery.ui.datepicker-ru.js" type="text/javascript"></script>
<script src="scripts/js/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript"></script>
</head>
<body>
<?php
error_reporting (E_ERROR | E_WARNING | E_PARSE);

$time_start = microtime(1);

$debug = '';
require('inc/connect.php');
include('useractions.php');
echo '<div id="header">';
#require('user.php');
echo '</div>';
require('menu.php');
echo '<div id="main">';
if($_REQUEST[action] === 'add') require('actions/add.php');
elseif($_REQUEST[action] === 'edit') require('actions/editOrder.php');
else require('actions/showOrders.php');

//ajax loading - не работает
echo '<div id="loading"></div>';

echo "</div>";
mysql_close($db);
if($mode == 'debug') echo "<div id='debug'>$debug</div>";

$time = microtime(1) - $time_start;
echo 'Время: '.round($time,2);
?>