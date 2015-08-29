<?php
require_once 'system/engine.php';

class UserFunctions
{

    public function registration($login,$email,$pass,$name)
    {
        global $db;

        /*
        Вызываем функцию которая проверит не занят ли E-Mail и LOGIN.
        Переменная $check_response содержит в себе
        КОД сообщения который получен в ходе проверки
        */

        $check_response = $this->UserCheck($login,$email);

    	if ($check_response != 100 && $check_response != 110)
    	{
    		//Добавляем пользователя в БД
            $query = $db->query("INSERT INTO os_user (login,pass,email,u_group,name) VALUES ('$login','$pass','$email','2','$name')");

            if ($query == true)
            {
                //Если пользователь успешно зарегистрирован, то вернём число 140 для handler.php
                return $response = 140;
            }

    	} else {

            return $response = $check_response;

    	}

    }

    public function UserCheck($login,$email)
    {
        /*Функция для проверки занятости ЛОГИНА и ЕМАИЛА
          В начале она проверят логин. Если логин НЕ занят
          то проверяет ЕМАИЛ и в ходе проверки передаёт
          код сообщения.

          100 - логин занят.
          105 - емали занят.
        */

        global $db;

        //Проверяем логин на занятость
        $query = $db->getAll("SELECT id FROM os_user WHERE login = '$login'");

        if (count($query) > 0)
        {

            return 100; //Возврашаем код ошибки, которая гласит о том, что логин занят

        } else {

            //иначе продолжаем проверку
            $query = $db->getAll("SELECT id FROM os_user WHERE email = '$email'");

            if (count($query) > 0)
            {
                return 110; //Возврашем код ошибки - E-Mail уже занят!
            }

        }
    }

    public function authorization($user_login,$user_pass)
    {
        global $db,$site;

        //Проверяем есть ли такой логин
        $query = $db->getAll("SELECT id FROM os_user WHERE login = '$user_login'");

        if (count($query) == 0)
        {
            //Если такого логина нет, то:
            return 200; //Возвращаем ошибку, логин или пароль не верный!

        } else {

            //Иначе получаем пароль и сравниваем его с введёным (из формы)
            $query = $db->getAll("SELECT id,pass FROM os_user WHERE login = '$user_login'");

            $pass = $query[0]['pass'];

            if ($pass == $user_pass)
            {
                $id = $query[0]['id'];
                $_SESSION['user_id'] = $id;
                //Делаем ридерект
                //header('Location: '.$site->get_url());
                //exit();

            } else {

                return 200; //Возвращаем ошибку, логин или пароль не верны

            }

        }
    }

    public function addUserInfo($userInfoArray)
    {
        global $db;

        $query = $db->query("UPDATE os_user SET about='$userInfoArray[about]' WHERE id=51");
    }

    //С помощью данной функции
    //Мы получим ID текущего авторизованного
    //пользователя
    public function user_id($session_array)
    {
        global $twig;

        if (count($session_array) > 0)
        {
            $twig->addGlobal('currentUserId',$session_array['user_id']);
            return $session_array['user_id'];
        }
    }

    /*
    При помощи данной функции мы
    Мы определим, является ли
    текущий пользователь просматривающий
    профиль какого либо пользователя
    его обалателем.
    */
    public function isOwner($userId,$getId)
    {
        global $twig;

        if ($userId == $getId)
        {
            //Если юзер авторизован
            $twig->addGlobal('isOwner',1);
            return true;

        } else {
            //Иначе
            $twig->addGlobal('isOwner',0);
            return false;

        }
    }

    /*
    Всем и так понятная функция
    которая помогают юзеру
    покинуть сайт.
    */
    public function logout()
    {
        unset($_SESSION['user_id']);
        session_destroy();
        //Делаем ридерект
        header('Location: /');
        exit();
    }
}
?>
