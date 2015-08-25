<?php

/*
Файл в котором подключаются все системные файлы
Данные файл подключается к другим файлам
Текущая версия скрипта - 0.1.3
*/

session_start();

include 'class/safemysql.class.php'; //Класс для работы с БД

$db = new SafeMysql(array('user' => 'root', 'pass' => '211996dima','db' => 'db', 'charset' => 'utf8'));

require_once 'vendor/autoload.php'; //Шаблонизатор
require_once 'class/users.class.php'; //Класс для работы с юзерами на сайте
require_once 'functions.php'; //Различные функции
require_once 'class/content.class.php'; //Класс для работы с постами на сайте

Twig_Autoloader::register(); 
$loader = new Twig_Loader_Filesystem('templates/default/'); //Путь к шаблону
$twig = new Twig_Environment($loader); //Инициализируем шаблонизатор

$user = new UserFunctions(); //Функции юзеров
$projectContent = new ProjectContent(); //Объявления
$userContent = new UserContent(); //Пользователи

//Получаем все объявления и юзеров
$projectContent->getAllAnnouncement(); //Объялвения
$userContent->getAllUser(); //пользователи

require_once 'system/handler.php'; //Обработчик ошибок
require_once 'system/registration.php'; //Обработчик регистрации
require_once 'system/logout.php'; //Выход с сайта
require_once 'system/login.php'; //Вход на сайт
require_once 'content.php'; //Вывод содержимого конктренхы постов на сайт
require_once 'system/pages.php'; //Обработчик шаблонов
?>