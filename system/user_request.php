<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

require_once 'class/users.class.php';
require_once 'class/safemysql.class.php';

$db = new SafeMysql(array('user' => 'root', 'pass' => '211996', 'db' => 'db', 'charset' => 'utf8'));
$user = new UserFunctions;

if (isset($_POST['id']))
{
    $db->query("INSERT INTO os_user_request (project_id,user_id) VALUES ('$_POST[id]','$_SESSION[user_id]')");
}

?>