<?php
$contentInfoArray = array(
	'new_announce_name' => null,
	'new_announce_text' => null,
	'new_announce_act' => null,
	'new_announce_planguage' => null,
	'new_announce_language' => null,
	'new_announce_team' => null,
	'new_announce_host' => null
	);

if (isset($_POST['announceSaveSend']))
{
	$contentInfoArray = array(
    'announce_id' => $_GET['announcement'],
	'new_announce_name' => $site->auto_clean($_POST['new_announce_name']),
	'new_announce_text' => $site->auto_clean($_POST['new_announce_text']),
	'new_announce_act' => $site->auto_clean($_POST['new_announce_act']),
	'new_announce_planguage' => $site->auto_clean($_POST['new_announce_planguage']),
	'new_announce_language' => $site->auto_clean($_POST['new_announce_language']),
	'new_announce_team' => $site->auto_clean($_POST['new_announce_team']),
	'new_announce_host' => $site->auto_clean($_POST['new_announce_host'])
	);

	$result = $projectContent->updateAnnounceInfo($contentInfoArray);
	print_r($result);
}

?>