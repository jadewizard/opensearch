<?php

class paginations
{
	 public $pageNumber;
	 public $announceAmount;
	 public $usersAmount;
	 public $currentPage;
	 public $nextPage;
	 public $prevPage = null;
	 public $btnStyle = array('first' => null, 'second' => null);

     function __construct() 
     {
        global $db;

        $data = array(
        	'announcement' => $db->getAll("SELECT * FROM os_announcment"),
        	'users' => $db->getAll("SELECT * FROM os_user"));
        	//Получаем данные из БД

        $this->announceAmount = 5;
        //Кол-во постов выводимых на 1 странице

        $this->usersAmount = 5;
        //Кол-во пользователей выводимых на 1 странице

        $this->pageNumber = array(
        	'announcement' => ceil(count($data['announcement']) / $this->announceAmount),
        	'users' => ceil(count($data['users']) / $this->usersAmount));
        	//Определяем колв-во страниц

        $this->getPageUrl();
     }

     public function getPageUrl()
     {
     	global $twig;

     	//print_r($_GET);

     	if (isset($_GET['page']) && ($_GET['page'] == 'announcement'))
     	{
            if (isset($_GET['p']))
            {
                $this->currentPage = $_GET['p']; //Текущая страница
                $this->nextPage = 'announcement?p='.($this->currentPage+1).'';
            
                if ($this->currentPage != 1)
                {
                    $this->prevPage = 'announcement?p='.($this->currentPage-1).'';
                    //Если текущая страница НЕ 1, то формируем ссылку
                    //На предидущую страницу.
                }
                else
                {
                    $this->btnStyle['first'] = 'disabled';
                    //Если текущая страница 1, то задаём класс для кнопки
                    //На предидущую страницу disabled.
                }

                if ($this->currentPage == $this->pageNumber['announcement'])
                {
                    $this->btnStyle['second'] = 'disabled';
                    $this->nextPage = null;
                    //Если текущая страница = последней странцие, то
                    //Следующая страница = null и кнопка >> disabled
                }
            }
            else
            {
                $this->btnStyle['first'] = 'disabled';
                $this->nextPage = 'announcement?p=2';
                //Если нет GET параметра P, то предидущей страницы нет,
                //И кнопка << - выключена, следующая страница 2.
            }
     	}


     	if (isset($_GET['page']) && ($_GET['page'] == 'users'))
     	{
            if (isset($_GET['p']))
            {
                $this->currentPage = $_GET['p']; //Текущая страница
                $this->nextPage = 'users?p='.($this->currentPage+1).'';
            
                if ($this->currentPage != 1)
                {
                    $this->prevPage = 'users?p='.($this->currentPage-1).'';
                    //Если текущая страница НЕ 1, то формируем ссылку
                    //На предидущую страницу.
                }
                else
                {
                    $this->btnStyle['first'] = 'disabled';
                    //Если текущая страница 1, то задаём класс для кнопки
                    //На предидущую страницу disabled.
                }

                if ($this->currentPage == $this->pageNumber['users'])
                {
                    $this->btnStyle['second'] = 'disabled';
                    $this->nextPage = null;
                    //Если текущая страница = последней странцие, то
                    //Следующая страница = null и кнопка >> disabled
                }
            }
            else
            {
            $this->btnStyle['first'] = 'disabled';
            $this->nextPage = 'users?p=2';
            //Если нет GET параметра P, то предидущей страницы нет,
            //И кнопка << - выключена, следующая страница 2.
            }
        }

     	    $twig->addGlobal('currentPage',$this->currentPage);
     	    $twig->addGlobal('nextPage',$this->nextPage);
     	    $twig->addGlobal('prevPage',$this->prevPage);
     	    $twig->addGlobal('btnStyle',$this->btnStyle);
    }
}

?>