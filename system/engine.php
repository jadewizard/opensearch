<?php
/*
Файл в котором подключаются все системные файлы
Данные файл подключается к другим файлам
Текущая версия скрипта - 0.2.1
*/

session_start();

include 'class/safemysql.class.php'; //Класс для работы с БД

$db = new SafeMysql(array('user' => 'root', 'pass' => '211996', 'db' => 'db', 'charset' => 'utf8'));

require_once 'vendor/autoload.php'; //Шаблонизатор
require_once 'class/users.class.php'; //Класс для работы с юзерами на сайте
require_once 'functions.php'; //Различные функции
require_once 'class/content.class.php'; //Класс для работы с постами на сайте
require_once 'class/info.class.php'; //Класс для получения различной информации
require_once 'class/pagination.class.php'; //Пагинация

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates/default/'); //Путь к шаблону
$twig = new Twig_Environment($loader); //Инициализируем шаблонизатор

//$info = new info();
$site = new siteFunctions();
$user = new UserFunctions(); //Функции юзеров
$projectContent = new ProjectContent(); //Объявления
$userContent = new UserContent(); //Пользователи
$paginationManager = new paginations(); //Пагинация

//Получаем все объявления и юзеров
$projectContent->getAllAnnouncement(); //Объялвения
$userContent->getAllUser(); //пользователи

//Получаем список всех стран мира
//$info->getCountries();

$currentUserId = $user->user_id($_SESSION); //ID текущего пользователя

$projectContent->getPageCount();
require_once 'system/handler.php'; //Обработчик ошибок
require_once 'system/registration.php'; //Обработчик регистрации
require_once 'system/logout.php'; //Выход с сайта
require_once 'system/login.php'; //Вход на сайт
require_once 'system/user_edit.php';
require_once 'system/announcement_edit.php';
require_once 'system/add_announce.php';
require_once 'content.php'; //Вывод содержимого конктренхы постов на сайт
require_once 'system/pages.php'; //Обработчик шаблонов
require_once 'system/user_request.php';
?>