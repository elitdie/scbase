<div id="menu">
<a href="index.php">
<div class="button">
Главная
</div>
</a>
<div class="button" onclick="ajaxQuery(\'actions/showOrdersByDate.php\',\'main\',\'date=07082012\')">
Просрочка
</div>
<a href="actions/addform.php" class="fancy">
<div class="button">
Добавить
</div>
</a>



<div class="clear"></div>
</div>
<script>
$(document).ready(function(){
	$("a.fancy").fancybox({
	hideOnOverlayClick:false,
	centerOnScroll:true
	});
});
</script>