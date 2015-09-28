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
/*
		Переменная core служит для передачи
		каких либо параметров шаблонизатору.
*/
$core = null;
$auth = null;
$userProfileInfo = null;
$paginationTmp = 'pagination.html';

if (isset($_GET['page'])) 
{
    switch ($_GET['page']) 
    {
            //Страница всех проектов
            
        case 'announcement':
            $sidebar = 'sidebar_projects.html';
            $content = 'single_announce.html';
            $paginationTmp = 'pagination.html';
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
} 
else
{
    $sidebar = 'sidebar_projects.html';
    $content = 'single_announce.html';
}
//Если пользователь уже авторизирован
//То передаём шаблонизатор значение auth=1
//Что бы запретить показ страницы регистрации.
if (isset($_SESSION['user_id'])) 
{
    $twig->addGlobal('auth', true);
    $auth = true;
} 
else
{
    $twig->addGlobal('auth_message', message($input = array('response' => '300')));
}

//Страница конкретного юзера
//index.php?user=[ID]
if (isset($_GET['user'])) 
{
    
    /*
    Определяем является ли текущий пользователь
    Владельцем той страницы котору посещает
    В данный момент и возвращаем шаблонизатору
    true или false в зависимости от рез-та
    */
    $isOwner = $user->isOwner($user->user_id($_SESSION), $_GET['user']);
    
    $userContent->getAnnounceCurrentUser($_GET['user']); //Объявления определённого юзера
    $sidebar = 'sidebar_user.html';
    $content = 'user_page.html';
    
    if (isset($_GET['act']) && $_GET['act'] == 'edit') 
    {
        
        if ($auth == true) 
        {
            //Если пользователь авторизирован
            $userProfileInfo = $userContent->getThisUser($_SESSION['user_id']);
            
            if ($isOwner == false) 
            {
                // Если пользователь не владелец текущего ID
                header('Location: http://localhost/index.php?user=' . $_SESSION['user_id'] . '');
                exit();
            }
        }
        
        $sidebar = 'sidebar_user.html';
        $content = 'profile/edit.html';
    } 
    elseif (isset($_GET['act']) && $_GET['act'] == 'add') 
    {
        
        if ($isOwner == false) 
        {
            // Если пользователь не владелец текущего ID
            header('Location: http://localhost/index.php?user=' . $_SESSION['user_id'] . '&act=add');
            exit();
        }
        
        $sidebar = 'sidebar_user.html';
        $content = 'announcement/add_announce.html';
    }
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
    
    /*
    Определяем является ли текущий пользователь
    Владельцем той страницы котору посещает
    В данный момент и возвращаем шаблонизатору
    true или false в зависимости от рез-та
    */
    $isOwnerAnnounce = $user->isOwnerAnnounce($user->user_id($_SESSION),$_GET['announcement']);

    if (isset($_GET['act']) && $_GET['act'] == 'edit') 
    {
        
        if ($auth == true) 
        {
            //Если пользователь авторизирован
            $announcementInfo = $projectContent->getThisAnnouncement((int) $_GET['announcement']);
            
            if ($isOwnerAnnounce == false) 
            {
                // Если пользователь не владелец текущего ID
                header('Location: http://localhost/index.php?user=' . $_SESSION['user_id'] . '');
                exit();
            }
        }
        
        $sidebar = 'sidebar_announce.html';
        $content = 'announcement/edit.html';
    } 
}

$template = $twig->loadTemplate('index.html');
//Функция которая проверит залогинен ли наш юзер
$cabinet = $userContent->GetUserCabinet($_SESSION);

echo $template->render(array('sidebar' => $sidebar, 'user_cabinet' => $cabinet, 'content' => $content, 'core' => $core, 'userProfileInfo' => $userProfileInfo, 'pagination' => $paginationTmp));

$loader = new Twig_Loader_String();

?>
