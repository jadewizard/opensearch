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

function sql_check($id)
{
	global $db;

	$query = $db -> getAll("SELECT title FROM os_projects_content WHERE id=".$id."");

	return $query;
}
?>