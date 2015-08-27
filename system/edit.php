<?php

$userInfoArray = array(
	'new_name' => 'dsadsa',
	'new_about' => null,
	'new_country' => null,
	'new_p_launguage' => null,
	'new_launguage' => null,
	'new_city' => null,
	'new_action' => null,
	'new_git' => null,
	'new_age' => null);

if (isset($_POST['savesend']))
{

    $userInfoArray = array(
	'new_name' =>        $site->auto_clean($_POST['new_name']),
	'new_about' =>       $site->auto_clean($_POST['new_about']),
	'new_country' =>     $site->auto_clean($_POST['new_country']),
	'new_p_launguage' => $site->auto_clean($_POST['new_p_launguage']),
	'new_launguage' =>   $site->auto_clean($_POST['new_launguage']),
	'new_city' =>        $site->auto_clean($_POST['new_city']),
	'new_action' =>      $site->auto_clean($_POST['new_action']),
	'new_git' =>         $site->auto_clean($_POST['new_git']),
	'new_age' =>         $site->auto_clean($_POST['new_age']));

	print_r($userInfoArray);

	$userContent->updateUserInfo($userInfoArray);

}
?>
