<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2012
 */

echo '<div id="usermenu">
Добро пожаловать!
<br>Авторизуйтесь:<br>
<form name="auth">
<table>
<tr><td>Логин:</td><td><input type="text" name="login"></td></tr>
<tr><td>Пароль:</td><td><input type="password" name="pwd"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Войти" onclick="ajaxQuery(\'auth.php\',\'\',\'\')"></td></tr>
</table>
</form>
</div>
';
?>