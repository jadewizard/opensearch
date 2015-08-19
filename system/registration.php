<?php

require_once 'engine.php';

if (isset($_POST['send']))
{
	//Если поля не пустые, то --
	if (!empty($_POST['name']) && !empty($_POST['pass']) && !empty($_POST['email']) && !empty($_POST['name']))
	{
		if (strlen($_POST['pass']) > 6)
		{
	  
	        /*
	        Тут мы прогоняем полученные данные
	        из полей через функцию которая
            удаляет из строк "ненужные" символы
	        Сама функция находится в файле functions.php
	        */
	        $login = auto_clean($_POST['login']);
	        $pass = md5(md5($_POST['pass'])); //Дважды шифруем пароль пользователя
	        $email = auto_clean($_POST['email']);
	        $name = auto_clean($_POST['name']);

	        $response = $user->registration($login,$email,$pass,$name); 
	        //В переменной response храним ответ от сервера

            //переменная msg хранит в себе сообщение полученное от функции errMsg.
            //Массив input служит для передачи входных данных для обработчика ошибок
            //Может содержать в себе множество аргументов, но основные это
            //Код ответа и передача суперглобального массива POST.

	        $msg = message($input = array(
		             'response' => $response,
                     'post' => $_POST));

            //Добавляем глобальную переменную MESSAGE, которая содержит в себе сообщение
            //полученое в ходе выполнения функции обработчика событий.

	        $twig->addGlobal('message', $msg);

	     } else {

	     	$twig->addGlobal('message', message($input = array('response' => '150')));

	     }
 
    } else {

         //Если не заполнено какое либо поле в форме, то выдаём ошибку.
	     $twig->addGlobal('message', message($input = array('response' => '130')));

    }
}

?>