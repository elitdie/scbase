<head>
<style>
#addForm textarea{
	width:100%;
	resize:none;
}
</style>
</head>
<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2012
 */
include('../inc/connect.php');
$query = mysql_query('select max(num) from orders');
$row = @mysql_fetch_array($query);
$number = $row['max(num)']+1;
echo '
<form action="index.php">
<input type="hidden" name="action" value="add">
<input type="hidden" name="client_id" value="">
<table id="addForm">
	<tr><th colspan="4">Заявка №'.$number.'<input type="hidden" name="number" value="'.$number.'"></th></tr>
	<tr><td>Дата и время приема</td><td>'.date('d.m.Y H:i').'<input type="hidden" name="date_get" value="'.date('Y-m-d H:i:s').'"></td>
	<td>Планируемая дата завершения <input class="calendar" type="text" name="date_plan" placeholder="Календарь" required></td>
	</td><td>Тип клиента: <select name="type"><option id="fiz">Физ.лицо</option><option id="org">Организация</option></td></tr>
	<tr><td>Клиент</td><td colspan="3"><input id="client" type="text" name="lastname" placeholder="Фамилия клиента" required>
	<input type="text" name="name" placeholder="Имя клиента" required>
	<input type="text" name="surname" placeholder="Отчество клиента"></td></tr>
	<tr><td>Телефон</td><td colspan="2"><input type="text" name="phone1" placeholder="Номер телефона" required>
	<input type="text" name="phone2" placeholder="Дополнительный"></td><td></td></tr>
	<tr><td>Контактная информация</td><td colspan="2"><input type="email" name="email" placeholder="email">
	<input type="text" name="address" placeholder="Адрес клиента"></td>
	<td>Категория клиента: ';
	echo $ctypes = getTypes('cl_categorie');
	echo '</td></tr>
	<tr><td colspan="4"><center><b>Сдаваемое оборудование</b></center></td></tr>
	<tr><td id="itemDescription" colspan="4" num="1" align="center">';
	echo $types = getTypes('item_type');
	echo '
	<input type="text" name="item_name[]" placeholder="Название оборудования" size="70" required>
	<input type="text" name="item_sn[]" placeholder="Серийный номер">
	<input type="text" name="item_color[]" placeholder="Цвет"><br>
	<textarea name="item_problem[]" placeholder="Описание проблемы со слов клиента, либо примерные предстоящие работы" required></textarea>
	<br>
	<img id="addNewField" src="img/add.png" title="Добавить дополнительное оборудование"><img id="removeNewField" src="img/remove.png" title="Удалить последние поля">
	<br>
	<span id="itemtypes"></span></td></tr>
	<tr><td colspan="4" align="center">
	<input type="submit" value="Добавить заявку">
	<input type="button" value="Закрыть" onclick="parent.$.fancybox.close()">
	</td></tr>
</table>
<input type="hidden" value="3" name="employee_id">

</form>
';
function getTypes($tab){
	$query = mysql_query("select caption,id from `$tab`");
	$output = "<select name='".$tab."[]'><option>--выберите тип--</option>";
	while ($row = @mysql_fetch_assoc($query)) $output .= "<option value='$row[id]'>$row[caption]</option>";
	$output .= '</select>';
	return $output;
}
?>
<script>
$(document).ready(function(){

	$('input').attr('autocomplete','off');

	setAutocomplete();

	$('#org').bind('click',function(){
		$('#client').replaceWith('<input id="client" type="text" name="lastname" placeholder="Название организации" size="45" required>');
		$('input[name="name"],input[name="surname"]').toggle();
		$('input[name="name"],input[name="surname"]').removeAttr('required');
		setAutocomplete();
	});
	$('#fiz').bind('click',function(){
		$('#client').replaceWith('<input id="client" type="text" name="lastname" placeholder="Фамилия клиента" required>');
		$('input[name="name"],input[name="surname"]').toggle();
		$('input[name="name"]').attr('required','');
		setAutocomplete();
	});


	$(".calendar").datepicker( {beforeShowDay: $.datepicker.noWeekends,
	autoSize: "true",
	navigationAsDateFormat: "true",
	showAnim: "slide",
	dateFormat: "yy-mm-dd",
	minDate: "+1d",
	showOtherMonths: true,
	selectOtherMonths: 'true'
	});
	var selectOpt = "<?php echo $types ?>";
	$("#addNewField").bind('click', function(){
        var num = $("#itemDescription").attr("num");
        var text = "<div class='newItem" + num + "'>" + selectOpt + " <input type='text' name='item_name[]' placeholder='Название оборудования' size='70' required> <input type='text' name='item_sn[]' placeholder='Серийный номер'> <input type='text' name='item_color[]' placeholder='Цвет'><br><textarea name='item_problem[]' placeholder='Описание проблемы со слов клиента, либо примерные предстоящие работы' required></textarea></div>";
        $("#addNewField").before(text);
     	$("#itemDescription").attr("num", (parseInt(num)+1));
	});
	$("#removeNewField").bind('click', function(){
        var num = $("#itemDescription").attr("num");
        num = parseInt(num)-1;
        if(num == 0) return;
        $(".newItem" + num).remove();
        $("#itemDescription").attr("num", (parseInt(num)));
	});
});

function setAutocomplete(){
$('#client').autocomplete({
		minLenght: 2,
		source: "actions/getClient2add.php",
		select: function(event, ui){
			$(this).val(ui.item.lastname);
			$('input[name="name"]').val(ui.item.name);
			$('input[name="surname"]').val(ui.item.surname);
			$('input[name="client_id"]').val(ui.item.id);
			$('input[name="phone1"]').val(ui.item.phone1);
			$('input[name="phone2"]').val(ui.item.phone2);
			$('input[name="email"]').val(ui.item.email);
			$('input[name="address"]').val(ui.item.address);
			return false;
		}
	})
};
</script>