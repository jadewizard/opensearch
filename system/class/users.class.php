<?php
require_once 'system/engine.php';

$db = new SafeMysql(array('user' => 'root', 'pass' => '211996dima','db' => 'db', 'charset' => 'utf8'));

class UserFunctions
{
	public $login;
	public $password;
	public $email;
	public $group;
	public $db;

    public function registration($login,$email,$pass,$name)
    {
        global $db;
        
        /*
        Вызываем функцию которая проверит не занят ли E-Mail и LOGIN.
        Переменная $check_response содержит в себе
        КОД сообщения который получен в ходе проверки
        */

        $check_response = $this -> UserCheck($login,$email);

    	if ($check_response != 100 && $check_response != 110)
    	{
    		//Добавляем пользователя в БД
            $query = $db->query("INSERT INTO os_users (login,pass,email,u_group,name) VALUES ('$login','$pass','$email','2','$name')");

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
        $query = $db->getAll("SELECT id FROM os_users WHERE login = '$login'");

        if (count($query) > 0)
        {

            return 100; //Возврашаем код ошибки, которая гласит о том, что логин занят

        } else {

            //иначе продолжаем проверку
            $query = $db->getAll("SELECT id FROM os_users WHERE email = '$email'");

            if (count($query) > 0)
            {
                return 110; //Возврашем код ошибки - E-Mail уже занят!
            }

        }
    }

    public function authorization($user_login,$user_pass)
    {
        global $db;
        
        //Проверяем есть ли такой логин
        $query = $db->getAll("SELECT id FROM os_users WHERE login = '$user_login'");

        if (count($query) == 0)
        {
            //Если такого логина нет, то:
            return 200; //Возвращаем ошибку, логин или пароль не верный!

        } else {
            
            //Иначе получаем пароль и сравниваем его с введёным (из формы)
            $query = $db->getAll("SELECT id,pass FROM os_users WHERE login = '$user_login'");

            $pass = $query[0]['pass'];

            if ($pass === md5(md5($user_pass)))
            {
                $id = $query[0]['id'];
                setcookie('id',$id,time()+86400*30);
                setcookie('login',$user_login,time()+86400*30);
                //Делаем ридерект
                header('Location: '.get_url());
                exit();
            } else {

                return 200; //Возвращаем ошибку, логин или пароль не верны

            }

        }
    }

    /*
    Функция которая проверяте
    Залогинен ли юзер и возвращает
    шаблон который нужноп показать.
    */
    public function GetUserCabinet($data)
    {
        if (!empty($data['id']))
        {

            return 'cabinet.html';

        } else {

            return 'login.html';

        }
    }

    public function logout()
    {
        setcookie('id','null',time()-86400*30);
        setcookie('login','null',time()-86400*30);
        //Делаем ридерект
        header('Location: /');
        exit();
    }
}
?>