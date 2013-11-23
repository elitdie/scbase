<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2012
 */
$dbuser = 'root';
$dbpwd = '375555';
$mode = 'debug';

$db = mysql_connect('localhost',$dbuser,$dbpwd);
if(mysql_num_rows(mysql_query('show create database `scbase`'))) mysql_select_db('scbase',$db);
else require_once('inc/init.php');

?>