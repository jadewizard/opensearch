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
			$twig->addGlobal('project_id', $id-1);

		} else {
			header('Location: index.php?page=404');
		}
	}
}

?>