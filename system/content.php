<?php

require_once 'engine.php';

if (isset($_GET['page']) && $_GET['page'] == 'project')
{
	if (isset($_GET['id']))
	{
		$id = auto_clean($_GET['id']);
		$getContent->getProjectContent($id);
		//print_r($postContent);
	}
}

?>