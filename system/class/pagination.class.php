<?php

class paginations
{
	 public $pageNumber;
	 public $announceAmount;
	 public $currentPage;
	 public $nextPage;
	 public $prevPage;

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
     		}
     		else
     		{
     			$this->prevPage = null;
     		}
     	}

     	    $twig->addGlobal('currentPage',$this->currentPage);
     	    $twig->addGlobal('nextPage',$this->nextPage);
     	    $twig->addGlobal('prevPage',$this->prevPage);
     }
}

?>