<?php

class ProjectContent
{
    public $data;

    /*
    * Функция для получения
    * Массива ВСЕХ объявлений
    * Из БД.
    */
    public function getAllAnnouncement()
    {
        global $db,$twig;

        $this->data = $db->getAll('SELECT * FROM os_announcment');

        $twig->addGlobal('announceAll',$this->data);
    }

    /*
    * Функция для получения
    * Массива с контеном
    * Текущего (id) объявления
    */
    public function getThisAnnouncement($id)
    {
        global $db,$twig;

        $this->data = $db->getAll('SELECT * FROM os_announcment WHERE id='.$id.'');

        $twig->addGlobal('announceContent',$this->data[0]);
    }

    public function addAnnouncement($announceDataArray)
    {
        global $db;

        $query = $db->query("INSERT INTO os_announcment (title,annoucne_text,add_date,img,owner_id,program_language,action,project_language,team,host) VALUES ('$announceDataArray[announce_name]','$announceDataArray[announce_text]','$announceDataArray[announce_date]','$announceDataArray[announce_img]','$announceDataArray[announce_owner_id]','$announceDataArray[announce_planguage]','$announceDataArray[announce_act]','$announceDataArray[announce_language]','$announceDataArray[announce_team]','$announceDataArray[announce_host]')");
    }

}

class UserContent
{
    public $data;

    public function getAllUser()
    {
        global $db,$twig;

        $this->data = $db->getAll('SELECT * FROM os_user');

        $twig->addGlobal('allUser',$this->data);
    }

    public function getThisUser($id)
    {
        global $db,$twig;

        $this->data = $db->getAll('SELECT * FROM os_user WHERE id='.$id.'');

        $twig->addGlobal('userContent',$this->data[0]);

        return $this->data[0];
    }

    /*
    Функция которая проверяте
    Залогинен ли юзер и возвращает
    шаблон который нужно показать.
    */
    public function GetUserCabinet($data)
    {

        if (!empty($data['user_id']))
        {

            return 'cabinet.html';
            //Если есть user_id, то выводим кабинет

        } else {

            return 'login.html';
            //Иначе форму логина

        }
    }

    public function updateUserInfo($userInfoArray)
    {
        global $db,$twig;

        $query = $db->query("UPDATE os_user SET
         name = '$userInfoArray[new_name]',
         about = '$userInfoArray[new_about]',
         age = '$userInfoArray[new_age]',
         country = '$userInfoArray[new_country]',
         city = '$userInfoArray[new_city]',
         action = '$userInfoArray[new_action]',
         programm_language = '$userInfoArray[new_p_launguage]',
         language = '$userInfoArray[new_launguage]',
         p_url = '$userInfoArray[new_git]'
          WHERE id='$userInfoArray[user_id]'");

    }

}

?>
