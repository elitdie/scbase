<head>
<style>
p.edit_center{
	padding:5px;
	background:#D799FF;
	text-align:center;
	font-weight:bold;
}
fieldset.per30, fieldset.per50{
	width:31%;
	float:left;
	margin:0 5px;
}
fieldset.per50{
	width:50%;
	margin:0 20px;
}
fieldset textarea {
	width:100%;
	height:91px;
	resize:none;
}
#completed_works, #pricelist {
	list-style-type: none;
	margin: 0;
	padding: 10px 0;
	float: left;
	background:yellow;
	width:99%;
}
#completed_works li, #pricelist li {
	margin: 0px 5px 5px 20px;
	padding: 5px;
	font-size: 1.2em;
	width: 90%;
	border:1px solid #666;
	border-radius:10px;
	cursor:pointer;
	padding:10px;
	height:15px;
}
#completed_works div.edit_right, #pricelist div.edit_right{
	text-align:right;
}
#completed_works div, #pricelist div {
	float:left;
	margin:0px;
	padding:0px;
	width:50%;
}
#completed_works li{
	float:left;
}
.works-del{
	display:none;
}
</style>
<script>
	$(function() {
		var cost = 0;
		$( "#completed_works, #pricelist" ).sortable({
			connectWith: ".connSort",
			helper: 'clone',
			receive: function(event, ui){
				alert(ui.item.attr('data-work-id'));
				console.log(ui.item);
				cost = cost + parseInt(ui.item.attr('data-cost'));
				$('#cost').html(cost);
				//$(this).find('li').css('width','80%');
				$(this).find('.works-add').removeClass('works-add').addClass('works-del');
			}
		}).disableSelection();
	});

	var comment = '';

	$(document).ready(function(){
		$('#edit_comment').blur(function(){
			comment = $(this).val();
			alert(comment);
		});

		$('#save_comment').bind('click',function(){
			id = $(this).attr('data-id');
			alert(id+'\n'+comment);
			var data = 'comment_id=' + id + '&comment=' + comment ;
			$.ajax({
				url:'editOrder_proc.php',
				type:'post',
				data:data,
				success: function(msg){
					//$('#tz_clientTimezone').html('Время у клиента: ' + msg);
   				};
			});
		});
	});
</script>
</head>
<?php

var_dump($_REQUEST);

$query_edit = "SELECT `o`.`id`,
	`name`,
	`lastname`,
	`surname`,
	`phone1`,
	`phone2`,
	`address`,
	`email`,
	`type`,

	`num`,
	`date_plan`,
	`date_get`,
	`date_real`,
	`status`,
	`sum`,
	`comment`

	FROM `orders` o INNER JOIN client c ON (o.client_id = c.id) WHERE `o`.`id` = $_REQUEST[id] LIMIT 1";
$result_edit = mysql_query($query_edit);

$row_edit = mysql_fetch_assoc($result_edit);

if($row_edit[date_real] == '0000-00-00 00:00:00') $date_real_edit = '1';
else $date_real_edit = date('d.m.Y H:i',strtotime($row_edit[date_real]));

echo "$row_edit[id] $row_edit[num] $row_edit[date_get] $row_edit[get_plan] $row_edit[date_real] $row_edit[client_id] $row_edit[sum] $row_edit[status] $row_edit[comment] $row_edit[creator]";
echo "$row_edit[name] $row_edit[lastname] $row_edit[surname] $row_edit[phone1] $row_edit[phone2] ";

echo "<p class='edit_center'>Детали заказа №$row_edit[num]</p>
	<fieldset class='per30'>
		<legend>Даты</legend>
		<table>
		<tr><td>Прием:</td><td>".date('d.m.Y H:i',strtotime($row_edit[date_get]))."</td></tr>
		<tr><td>Планируемая сдача:</td><td>".date('d.m.Y',strtotime($row_edit[date_plan]))."</td></tr>
		<tr><td>Реальная сдача:</td><td>$date_real_edit</td></tr>
		</table>
	</fieldset>";

if($row_edit[phone2] != '') $phone2_edit = "<br />$row_edit[phone2]";

error_reporting(E_WARNING);

echo "<fieldset class='per30'>
		<legend>Клиент</legend>
		<table>
		<tr><td>ФИО:</td><td>$row_edit[lastname] $row_edit[name] $row_edit[surname]</td></tr>
		<tr><td>Телефоны:</td><td>$row_edit[phone1] $phone2_edit</td></tr>
		<tr><td>Контакты:</td><td>$row_edit[email]<br />$row_edit[address]</td></tr>
		<tr><td>Тип:</td><td>$row_edit[type]</td></tr>
		</table>
	</fieldset>";

echo "<fieldset class='per30'>
		<legend>Детали</legend>
		<table>
		<tr><td>Статус:</td><td>$row_edit[status]</td><td></td></tr>
		<tr><td>Комментарий:</td><td>
			<textarea id='edit_comment' placeholder='Введите комментарий'>$row_edit[comment]</textarea>
		</td>
		<td align='center'><img id='save_comment' data-id='$row_edit[id]' src='img/save.png'></td>
		</tr>
		</table>
	</fieldset>";

echo '<div class="clear"></div>';

$query_works = 'SELECT id,caption,cost FROM scbase.works';
$result_works = mysql_query($query_works);

echo "<fieldset>
		<legend>Услуги</legend>
		<fieldset class='per50'>
			<legend>Выполненные работы</legend>
			<ul id='completed_works' class='connSort'>

			</ul>
			<div id='cost'></div>
		</fieldset>
		<fieldset>
			<legend>Прайс-лист</legend>
			<ul id='pricelist' class='connSort'>";
while($row_works = mysql_fetch_assoc($result_works)){
	echo "<li class='ui-state-default' data-work-id='$row_works[id]' data-cost='$row_works[cost]'><div>$row_works[caption]</div><div class='edit_right'>$row_works[cost]</div><img src=111 class='works-add'><div class='clear'></div></li>";
}
echo	"</ul>
		</fieldset>
		<div class='clear'></div>
	</fieldset>";
echo '';
?>