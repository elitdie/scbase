<?php
error_reporting (E_ERROR | E_WARNING | E_PARSE);
/**
 *
 *
 * @version $Id$
 * @copyright 2012
 */
if(!$db)include('../inc/db.php');

$query = mysql_query('select o.id,name,lastname,surname,phone1,phone2,num,date_plan,status,sum,comment from orders o inner join client c on (o.client_id = c.id) order by num desc limit 30');
echo '<table><tr><th>Номер</th><th>Окончание</th><th>Клиент</th><th>Телефон</th><th>Принято</th><th>Работники</th><th>Статус</th><th>Сумма</th><th></th><th>';
echo '</th></tr>';
while ($row = mysql_fetch_assoc($query)) {
	if($row[phone2]) $phone = "<p>$row[phone1]</p><p>$row[phone2]</p>";
	else $phone = "<p>$row[phone1]</p>";
	$client = "<p>$row[name] $row[surname]</p>";
	if($row[lastname]) $client .= "<p>$row[lastname]</p>";
	$subquery1 = mysql_query('select caption,item,color,sn from orders o inner join orders_has_item ohi on (o.id = ohi.orders_id) inner join item i on (ohi.item_id = i.id) inner join item_type it on (i.item_type_id = it.id) where o.id = '.$row[id]);
	$items = '';
	while($row2 = mysql_fetch_array($subquery1)) {
		if($row2[sn]) $items .= "<p>$row2[caption] $row2[color] $row2[item], SN:<i>$row2[sn]</i></p>";
		else $items .= "<p>$row2[caption] $row2[color] $row2[item]</p>";
	}
	$subquery2 = mysql_query('select name,lastname from orders o inner join orders_has_employee ohe on (o.id = ohe.orders_id) inner join employee e on (ohe.employee_id = e.id) where o.id = '.$row[id]);
	$workers = '';
	while($row2 = mysql_fetch_array($subquery2)) $workers .= "<p>$row2[name] $row2[lastname]</p>";
	$comment = '';
	if($row[comment]) $comment = "<img src='img/pen.png' title='$row[comment]' width='20'>";
	echo "<tr id='$row[id]'><td><a href='index.php?action=edit&id=$row[id]'>$row[num]</a></td><td>$row[date_plan]</td><td>$client</td><td>$phone</td><td>$items</td><td>$workers</td><td>$row[status]</td><td>$row[sum]</td><td>$comment</td><td>";
echo "<input type='button' class='deleteButton' num='$row[id]' value='Удалить'>";

	#######Место для инклуда скриптов ПИ
	#include_once('tables.php');

echo "</td></tr>";
}
echo '</table>';

//echo '<div id="accordion">';
//$query = mysql_query('select o.id,name,lastname,surname,phone1,phone2,num,date_plan,status,sum,comment from orders o inner join client c on (o.client_id = c.id) order by num desc limit 30');
//echo '';
//while ($row = mysql_fetch_assoc($query)) {
//	if($row[phone2]) $phone = "$row[phone1] $row[phone2]";
//	else $phone = "$row[phone1]";
//	$client = "$row[name] $row[surname]";
//	if($row[lastname]) $client .= "$row[lastname]";
//	$subquery1 = mysql_query('select caption,item,color,sn from orders o inner join orders_has_item ohi on (o.id = ohi.orders_id) inner join item i on (ohi.item_id = i.id) inner join item_type it on (i.item_type_id = it.id) where o.id = '.$row[id]);
//	$items = '';
//	while($row2 = mysql_fetch_array($subquery1)) {
//		if($row2[sn]) $items .= "$row2[caption] $row2[color] $row2[item], SN:<i>$row2[sn]</i>";
//		else $items .= "$row2[caption] $row2[color] $row2[item]";
//	}
//	$subquery2 = mysql_query('select name,lastname from orders o inner join orders_has_employee ohe on (o.id = ohe.orders_id) inner join employee e on (ohe.employee_id = e.id) where o.id = '.$row[id]);
//	$workers = '';
//	while($row2 = mysql_fetch_array($subquery2)) $workers .= "$row2[name] $row2[lastname]";
//	$comment = '';
//	if($row[comment]) $comment = "<img src='img/pen.png' title='$row[comment]' width='20'>";
//	echo "<h3><a href=#>$row[num] | $client | $phone | $items | $row[status]</a></h3>
//	<div>$workers | $row[sum] | $comment |
//<input type='button' onclick='deleteOrder($row[id])' value='Удалить'>
//</div>";
//}
//echo '</div>';

?>
<script>
$(document).ready(function(){
	$("#accordion").accordion();
	$("input.deleteButton").click(function(){
		num = $(this).parent().parent().attr('id')
		if(confirm('Удалить?')){
			$.post(
			'actions/deleteOrder.php',
			{'delete_id': num},
			OnAjaxSuccess
			)
		}
	function OnAjaxSuccess(data){
	$('#' + num).remove();
	alert(data)
	}
	})
});
</script>
<p class=goodjob>Все готово!</p>