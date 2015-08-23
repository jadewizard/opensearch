<?php
function auto_clean($string)
{
	$string = trim($string);
    $string = stripslashes($string);
    $string = strip_tags($string);
    $string = htmlspecialchars($string);

    return $string;
}

function get_url()
{
	return "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ;
}

function sql_check($id,$type)
{
	global $db;

	if ($type == 'user')
	{
	    $query = $db -> getAll("SELECT name FROM os_users WHERE id=".$id."");

	    return $query;
	} 

	if ($type == 'project')
	{
	    $query = $db -> getAll("SELECT name FROM os_project_content WHERE id=".$id."");

	    return $query;
	}

	if ($type == 'announcement')
	{
	    $query = $db -> getAll("SELECT title FROM os_project_announcment WHERE id=".$id."");

	    return $query;
	}
}
?>