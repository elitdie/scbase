<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2012
 */


?>
<div id="useractions">
<input type="button" id="showAddForm" value="Добавить заявку">
</div>
<a class="btn-slide">действия</a>
<div id="addForm"></div>
<script>
$(document).ready(function(){
    $(".btn-slide").click(function(){
        $("#useractions").slideToggle("slow");
        $(this).toggleClass("active");
    });
    $("#showAddForm").click(function(){
    	$("#addForm").load("actions/addform.php");
		$("#addForm").dialog({modal:true});

    });
});
</script>