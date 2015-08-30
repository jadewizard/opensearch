<?php

$announceDataArray = array(
  'announce_name'      => null,
  'announce_text'      => null,
  'announce_act'       => null,
  'announce_planguage' => null,
  'announce_language'  => null,
  'announce_team'      => null,
  'announce_date'      => null,
  'announce_img'       => null,
  'announce_host'      => null,
  'owner_id'           => null);

if (isset($_POST['addsend']))
{

  if (!empty($_POST['announce_name']) &&
      !empty($_POST['announce_text']) &&
      !empty($_POST['announce_language']))
  {
     $announceDataArray = array(
      'announce_name'      => $site->auto_clean($_POST['announce_name']),
      'announce_text'      => $site->auto_clean($_POST['announce_text']),
      'announce_act'       => $site->auto_clean($_POST['announce_act']),
      'announce_planguage' => $site->auto_clean($_POST['announce_planguage']),
      'announce_language'  => $site->auto_clean($_POST['announce_language']),
      'announce-date'      => date('Y-m-d'),
      'announce_team'      => $site->auto_clean($_POST['announce_team']),
      'announce_host'      => $site->auto_clean($_POST['announce_host']),
      'owner_id'           => $_SESSION['user_id']
     );

    $response = $projectContent->addAnnouncement($announceDataArray);

  } else {
    $twig->addGlobal('addMessage', message(array('response' => 400)));
  }

}

?>
