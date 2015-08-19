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
?>