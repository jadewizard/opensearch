<?php

require_once 'engine.php';

if (isset($_GET['page']) && $_GET['page'] == 'project')
{
	if (isset($_GET['id']))
	{
		$id = auto_clean((int) $_GET['id']);
		$check = sql_check($id);

		if (count($check) > 0)
		{
			$getContent->getProjectContent($id);
		    //print_r($postContent);

		} else {

			header('Location: index.php?page=404');

		}
	}
}

if (isset($_GET['page']) && $_GET['page'] == 'member')
{
	if (isset($_GET['id']))
	{
		$id = auto_clean((int) $_GET['id']);
		$check = sql_check($id);

		if (count($check) > 0)
		{
			$getContent->getMemberContent($id);
		    //print_r($postContent);

		} else {

			header('Location: index.php?page=404');
			
		}
	}
}

?>