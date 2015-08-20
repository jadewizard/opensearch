<?php

class ProjectContent
{
	public $title;
	public $text;
	public $info;
	public $author;
	public $post_data;
	public $data;

	public function __construct()
	{
		global $db;

		$this->data = $db->getAll("SELECT * FROM os_projects_content");

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
        В массиве все посты из категории ПРОЕКТЫ.
        */

		$twig->addGlobal('projects_array', $this->data);
	}
}

class UserContent extends ProjectContent
{
	
	function __construct()
	{
		global $db;

		$this->data = $db->getAll("SELECT * FROM os_users_content");
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
	public function getProjectContent($id)
	{
		global $twig,$db;
        
        $this->data = $db->getAll("SELECT * FROM os_projects_content WHERE id=".$id."");
        
        $twig->addGlobal('project_array', $this->data[0]);
            
        //return $this->data[0];
	}

	public function getMemberContent($id)
	{
		global $twig,$db;
        
        $this->data = $db->getAll("SELECT * FROM os_users_content WHERE id=".$id."");
        
        $twig->addGlobal('user_array', $this->data[0]);
            
        //return $this->data[0];
	}

}

?>