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
		case 'members':
			  $sidebar = 'sidebar_members.html';
			  $content = 'single_member.html';
			break;
        
        //Страница конкретного проекта
	    case 'project':
	          $sidebar = 'sidebar_project.html';
			  $content = 'project_page.html';
			break;

        //Страница конкретного объявления
	    case 'announce':
	          $sidebar = 'sidebar_project.html';
			  $content = 'project_page.html';
			break;

        //Страница конкретного пользователя
	    case 'member':
	          $sidebar = 'sidebar_member.html';
			  $content = 'member_page.html';
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

$core = array('message' => 'asd');

$template = $twig->loadTemplate('index.html');

//Функция которая проверит залогинен ли наш юзер
$cabinet = $user->GetUserCabinet($_COOKIE);

echo $template->render(array(
	'sidebar' => $sidebar,
	'user_cabinet' => $cabinet,
	'content' => $content,
	'core' => $core ));

    $loader = new Twig_Loader_String();


?>