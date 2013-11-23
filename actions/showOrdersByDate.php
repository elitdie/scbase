<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2012
 */
include('../inc/db.php');
error_reporting (E_ERROR | E_WARNING | E_PARSE);
$date = explode('.',$_REQUEST[date]);
var_dump($_REQUEST);
$date = "$date[2]-$date[1]-$date[0]";
$query = mysql_query("select orders.id,client.name,client.surname,client.lastname,client.phone1,client.phone2,num,date_plan,orders_item.item,status,sum,comment from `orders`,`client`,`orders_item` where orders.client = client.id and orders.id = orders_item.oid and date_plan < $date and status <> 'Выполнено' order by num date_plan");
echo '<table><tr><th>Номер</th><th>Окончание</th><th>Клиент</th><th>Телефон</th><th>Принято</th><th>Работники</th><th>Статус</th><th>Сумма</th><th></th><th></th></tr>';
while ($row = mysql_fetch_assoc($query)) {
	$subquery = mysql_query("select distinct name,lastname from `employee`,`orders_employee` where oid = $row[id] and employee.id = eid");
	$workers = '';
	while($temp = mysql_fetch_assoc($subquery)) $workers .= "$temp[name] $temp[lastname]<br>";
	$comment = '';
	if($row[comment]) $comment = "<img src='img/pen.png' title='$row[comment]' width='20'>";
	echo "<tr><td class='number'>$row[num]</td><td>$row[date_plan]</td><td>$row[name] $row[surname]<br>$row[lastname]</td><td>$row[phone1]<br>$row[phone2]</td><td>$row[item]</td><td>$workers</td><td>$row[status]</td><td>$row[sum]</td><td>$comment</td><td>кнопки</td></tr>";
}
echo '</table>';

?>