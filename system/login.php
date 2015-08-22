<?php
require_once 'class/users.class.php';
require_once 'engine.php';
require_once 'functions.php';


if (isset($_POST['loginsend']))
{
	if (!empty($_POST['login']) && !empty($_POST['pass']))
	{
		$login = auto_clean($_POST['login']);
		$pass = auto_clean($_POST['pass']);
        
        //Переменная response хранит в себе ответ полученный от сервера
		$response = $user->authorization($login,$pass);
        
        //Обрабатывае сообшение
        $msg = message($input = array(
		      'response' => $response));
        
        //Добавляем глобальную переменную MESSAGE, которая содержит в себе сообщение
        //полученое в ходе выполнения функции обработчика событий.
        $twig->addGlobal('login_message', $msg);

	} else {
        
        //Если какое то из полей не заполнены
		$twig->addGlobal('login_message', 'Введите логин и пароль!');

	}
}

?>