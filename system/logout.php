<?php
require_once 'system/engine.php';

if (isset($_GET['action']))
{
	if ($_GET['action'] == 'logout')
	{
		$user->logout();
	}
}
?>