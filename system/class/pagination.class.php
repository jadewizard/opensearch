<?php

class paginations
{
	 public $pageNumber;
	 public $announceAmount;
	 public $currentPage;
	 public $nextPage;
	 public $prevPage = null;
	 public $btnStyle = array('first' => null, 'second' => null);

     function __construct() 
     {
        global $db;

        $data = $db->getAll("SELECT * FROM os_announcment");

        $this->pageNumber = ceil(count($data) / 10);
        //Определяем колв-во страниц

        $this->announceAmount = 10;
        //Кол-во постов выводимых на 1 странице

        $this->getPageUrl();
     }

     public function getPageUrl()
     {
     	global $twig;

     	if (isset($_GET['p']))
     	{
     		$this->currentPage = $_GET['p']; //Текущая страница
     		$this->nextPage = 'index.php?page=announcement&p='.($this->currentPage+1).'';
     		
     		if ($this->currentPage != 1)
     		{
     			$this->prevPage = 'index.php?page=announcement&p='.($this->currentPage-1).'';
                //Если текущая страница НЕ 1, то формируем ссылку
                //На предидущую страницу.
     		}
     		else
     		{
     			$this->btnStyle['first'] = 'disabled';
     			//Если текущая страница 1, то задаём класс для кнопки
     			//На предидущую страницу disabled.
     		}

     		if ($this->currentPage == $this->pageNumber)
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
     		$this->nextPage = 'index.php?page=announcement&p=2';
     		//Если нет GET параметра P, то предидущей страницы нет,
     		//И кнопка << - выключена, следующая страница 2.
     	}

     	    $twig->addGlobal('currentPage',$this->currentPage);
     	    $twig->addGlobal('nextPage',$this->nextPage);
     	    $twig->addGlobal('prevPage',$this->prevPage);
     	    $twig->addGlobal('btnStyle',$this->btnStyle);
     }
}

?>