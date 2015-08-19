<?php

include 'class/safemysql.class.php';

require_once 'vendor/autoload.php';
require_once 'class/users.class.php';
require_once 'functions.php';

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates/default/');
$twig = new Twig_Environment($loader);

$user = new UserFunctions();

require_once 'system/handler.php'; //Обработчик ошибок
require_once 'system/registration.php'; //Обработчик регистрации
require_once 'system/logout.php'; //Выход с сайта
require_once 'system/login.php'; //Вход на сайт
require_once 'system/pages.php'; //Обработчик шаблонов
?>