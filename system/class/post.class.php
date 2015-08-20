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
	Функция для получения всех
	постов из категории проекты
	*/
	public function getAll()
	{
		global $twig;

		$twig->addGlobal('projects_list', $this->data);
	}
}

?>