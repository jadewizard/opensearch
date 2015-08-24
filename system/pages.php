<?php

/*

VAR CONTENT
@ single_project.html - шаблон одного поста проекта.
@ single_user.html - шаблон одного поста пользователя.
@ project_content - страница с контентом конкретного проекта

VAR SIDEBAR
@ sidebar_projects.html - sidebar с навигацией по проектам т.е ЯП, ЯО, дейятельность и т.д
@ sidebar_people.html - sidebar с навигацией по пользователям
@ sidebar_project.html - sidebar с информацией о проекте

*/

require_once 'engine.php';


$core = null;
/*
Переменная core служит для передачи
каких либо параметров шаблонизатору.
*/

if (isset($_GET['page']))
{
	switch ($_GET['page']) 
	{
		//Страница всех проектов
		case 'projects':
			  $sidebar = 'sidebar_projects.html';
			  $content = 'single_project.html';
			break;
        
        //Страница всех людей/
		case 'users':
			  $sidebar = 'sidebar_users.html';
			  $content = 'single_user.html';
			break;

		//Страница регистрации
		case 'registration':
		      $sidebar = 'sidebar_projects.html';
			  $content = 'registration.html';
			break;

		default:
		      $sidebar = 'sidebar_projects.html';
			  $content = '404.html';
	}

} else {
	$sidebar = 'sidebar_projects.html';
	$content = 'single_project.html';
}

//Страница конкретного юзера
//index.php?user=[ID]
if (isset($_GET['user']))
{
	$sidebar = 'sidebar_user.html';
	$content = 'user_page.html';	
}

//Страница конкретного проекта
//index.php?project=[ID]
if (isset($_GET['project']))
{
	$sidebar = 'sidebar_project.html';
	$content = 'project_page.html';	
}

//Страница конкретного анонса
//index.php?announcement=[ID]
if (isset($_GET['announcement']))
{
	$sidebar = 'sidebar_announce.html';
	$content = 'announcment_page.html';
	$core = 'announce';
	/*
	Указываем, что страница объявления.
	В дальншейм если эта переменная будет
	равна announe, то будет выводится кнопка
	страничка проекта.
	*/
}

$template = $twig->loadTemplate('index.html');

//Функция которая проверит залогинен ли наш юзер
$cabinet = $userContent->GetUserCabinet($_SESSION);

echo $template->render(array(
	'sidebar' => $sidebar,
	'user_cabinet' => $cabinet,
	'content' => $content,
	'core' => $core ));

    $loader = new Twig_Loader_String();


?>