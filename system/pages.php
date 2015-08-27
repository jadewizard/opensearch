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
		$userProfileInfo = null;

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

			if (($_GET['page'] == 'registration') && (isset($_GET['step'])) && ($_GET['step']) == '2')
			{
				 $sidebar = 'sidebar_projects.html';
			    $content = 'userinfo.html';
			}

		} else {
			$sidebar = 'sidebar_projects.html';
			$content = 'single_project.html';
		}

		//Если пользователь уже авторизирован
		//То передаём шаблонизатор значение auth=1
		//Что бы запретить показ страницы регистрации.
		if (isset($_SESSION['user_id']))
		{
			$twig->addGlobal('auth',1);
		} else {
			$twig->addGlobal('edit_message', message($input = array('response' => '300')));
		}

		//Страница конкретного юзера
		//index.php?user=[ID]
		if (isset($_GET['user']))
		{

			$isOwner = $user->isOwner($user->user_id($_SESSION),$_GET['user']);
			/*
			Определяем является ли текущий пользователь
			//Владельцем той страницы котору посещает
			//В данный момент и возвращаем шаблонизатору
			1 или 0 в зависимости от рез-та
			*/

			$sidebar = 'sidebar_user.html';
			$content = 'user_page.html';

			if (isset($_GET['act']) && $_GET['act'] == 'edit')
			{

		     if (isset($_SESSION['user_id']))
				 {
		         $userProfileInfo = $userContent->getThisUser($_SESSION['user_id']);
			       if ($isOwner == false)
						 {
							   header('Location: http://localhost/index.php?user='.$_SESSION['user_id'].'');
							   exit();
						 }
				 }

			   $sidebar = 'sidebar_user.html';
			   $content = 'profile/edit.html';
			}
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
			'core' => $core,
			'userProfileInfo'=> $userProfileInfo ));

		    $loader = new Twig_Loader_String();


		?>
