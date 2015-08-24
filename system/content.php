<?php

require_once 'engine.php';

if (isset($_GET['project']))
{
	$id = auto_clean((int) $_GET['project']);
	$check = sql_check($id,'project');

	if (count($check) > 0)
	{
		$projectContent->getThisProject($id);
		    //print_r($postContent);

	} else {

		header('Location: index.php?page=404');
	}

}

if (isset($_GET['announcement']))
{
	$id = auto_clean((int) $_GET['announcement']);
	$check = sql_check($id,'announcement');

	if (count($check) > 0)
	{
		$projectContent->getThisAnnouncement($id);

	} else {

		header('Location: index.php?page=404');
	}

}

if (isset($_GET['user']))
{
	$id = auto_clean((int) $_GET['user']);
	$check = sql_check($id,'user');

	if (count($check) > 0)
	{
		$userContent->getThisUser($id);
		    //print_r($postContent);

	} else {

		header('Location: index.php?page=404');
	}

}


?>