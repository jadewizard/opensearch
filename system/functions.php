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
	    $query = $db -> getAll("SELECT name FROM os_user WHERE id=".$id."");

	    return $query;
	} 

	if ($type == 'project')
	{
	    $query = $db -> getAll("SELECT name FROM os_project WHERE id=".$id."");

	    return $query;
	}

	if ($type == 'announcement')
	{
	    $query = $db -> getAll("SELECT title FROM os_announcment WHERE id=".$id."");

	    return $query;
	}
}

function futureID()
{
	global $db;

	$query = $db -> getRow("SELECT MAX(id) FROM os_user");

	return $query['MAX(id)']+1;
}

?>