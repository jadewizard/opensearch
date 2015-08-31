<?php

$userInfoArray = array(
	'user_id'         => null,
	'new_name'        => null,
	'new_about'       => null,
	'new_country'     => null,
	'new_p_launguage' => null,
	'new_launguage'   => null,
	'new_city'        => null,
	'new_action'      => null,
	'new_git'         => null,
	'new_age'         => null,
	'avatar'         => null);

if (isset($_POST['savesend']) && isset($_SESSION['user_id']))
{

    $userInfoArray = array(
	'user_id' =>         $_SESSION['user_id'],//ID юзера
	'new_name' =>        $site->auto_clean($_POST['new_name']),
	'new_about' =>       $site->auto_clean($_POST['new_about']),
	'new_country' =>     $site->auto_clean($_POST['new_country']),
	'new_p_launguage' => $site->auto_clean($_POST['new_p_launguage']),
	'new_launguage' =>   $site->auto_clean($_POST['new_launguage']),
	'new_city' =>        $site->auto_clean($_POST['new_city']),
	'new_action' =>      $site->auto_clean($_POST['new_action']),
	'new_git' =>         $site->auto_clean($_POST['new_git']),
	'new_age' =>         $site->auto_clean($_POST['new_age']),
	'avatar' =>          $site->auto_clean($_POST['avatar_url']));

	$result = $userContent->updateUserInfo($userInfoArray);

	$response_msg = message(array('response' => $result)); //Обрабатываем ответ
	$twig->addGlobal('updMessage',$response_msg);

}
?>
