<?php
require_once 'vendor/autoload.php';
require_once 'functions.php';

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates/default/');
$twig = new Twig_Environment($loader);

$user = new UserFunctions();

?>