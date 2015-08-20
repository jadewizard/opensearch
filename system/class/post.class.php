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

		$this->data = $db->getAll("SELECT * FROM os_projects");

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

?>