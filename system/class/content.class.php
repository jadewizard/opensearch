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

        for ($i = 0;$i < count($this->data);$i++)
        {
            $id = $this->data[$i]['owner_id'];

            $projectInfo = $this->getProjectInfo($id);

            $this->data[$i] = array_merge($this->data[$i],$projectInfo[0]);
        }

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

        // В переменной projectInfo хранится массив
        // С данными о КОНКРЕТНОМ проекте из таблицы
        // os_project.
        $projectInfo = $this->getProjectInfo($this->data[0]['owner_id']);
        
        //Соеденяем два массива. Исходный и полученные в рез-те
        //Работы функции getProjectInfo.
        $this->data[0] = array_merge($this->data[0],$projectInfo[0]);

        $twig->addGlobal('announceContent',$this->data[0]);
    }

    public function getThisProject($id)
    {
        global $db,$twig;

        $this->data = $db->getAll('SELECT * FROM os_project WHERE id='.$id.'');

        $twig->addGlobal('projectContent',$this->data[0]);
    }

    /*
    * Функция для получения
    * Информации о конерктном проекте
    * (Язык проекта, язык про-ния и т.д)
    */
    public function getProjectInfo($id)
    {
        global $db;

        return $db->getAll('SELECT action,program_language,project_language,team,host FROM os_project WHERE id='.$id.'');;
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

}

?>