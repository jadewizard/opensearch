<?php

class ProjectContent
{
	public $data;

	public function __construct()
	{
		global $db;

		$this->data = $db->getAll("SELECT * FROM os_project_announcment");

	}

	/*
	Функция для передачи всех постов
	в глобальнюу переменную шаблонизатор
	*/
	public function getAll()
	{
		global $twig;
        

        /*
        С помощью цикла заменим элемент массива
        INFO массивом дополнительной информации.
        Массив с доп. информацией получается
        в результате выполнения функции
        перевода json в array (jsonToArray)
        */
        for ($i = 0;$i < count($this->data); $i++)
        {   
        	$infoArray = $this->jsonToArray($this->data[$i]['info']);

        	$this->data[$i]['info'] = $infoArray;
        }

        /*
        Передаём переменную в шаблонизатор
        Переменная содержит в себе массив
        Полученный в ходе выполнения конструктора
        В массиве все посты из категории ПРОЕКТЫ.
        */
         $twig->addGlobal('projects_array', $this->data);
	}

	public function jsonToArray($string)
	{

		return json_decode($string,true);

	}

}

class UserContent extends ProjectContent
{
	
	function __construct()
	{
		global $db;

		$this->data = $db->getAll("SELECT * FROM os_users");
	}

	/*
	Функция для передачи всех постов
	в глобальнюу переменную шаблонизатор
	*/

	public function getAll()
	{
		global $twig;

        /*
        Передаём переменную в шаблонизатор
        Переменная содержит в себе массив
        Полученный в ходе выполнения конструктора
        В массиве все посты из категории ЛЮДИ.
        */

		$twig->addGlobal('users_array', $this->data);
	}

}

/*
Класс для вывода содержимого конкретного поста
на сайте.
*/
class getContent extends ProjectContent
{
    
    /*
    Функция достаёт из базы 
    пост который имеет ID 
    взятый из аргумента функии
    getProjectContent и формерует
    массив, который в дальнешейм
    выводится на странице
    поста. Массив передаётся
    шаблонизатору.
    */
	public function getAnnouncmentContent($id)
	{
		global $twig,$db;
        
        $this->data = $db->getAll("SELECT * FROM os_project_announcment WHERE id=".$id."");

        for ($i = 0;$i < count($this->data); $i++)
        {   
        	$infoArray = $this->jsonToArray($this->data[$i]['info']);

        	$this->data[$i]['info'] = $infoArray;

        	$tagsArray = explode(",", $this->data[$i]['tags']);

        	$this->data[$i]['tags'] = $tagsArray;

        	//print_r($this->data);
        }
        
        $twig->addGlobal('project_array', $this->data[0]);
            
        //return $this->data[0];
	}

	public function getProjectContent($id)
	{
		global $twig,$db;
        
        $this->data = $db->getAll("SELECT * FROM os_project_content WHERE id=".$id."");
        
        $twig->addGlobal('project_array', $this->data[0]);
            
        //return $this->data[0];
	}

    /*
    Функция достаёт из базы 
    страницу пользователя 
    которая имеет ID 
    взятый из аргумента функии
    getMemberContent и формерует
    массив, который в дальнешейм
    выводится на странице
    юзера. Массив передаётся
    шаблонизатору.
    */
	public function getUserContent($id)
	{
		global $twig,$db;
        
        $this->data = $db->getAll("SELECT * FROM os_users WHERE id=".$id."");
        
        $twig->addGlobal('user_array', $this->data[0]);
            
        //print_r ($this->data);
	}

}

?>