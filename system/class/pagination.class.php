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
     		//Определяем текущюю страницу
     	    $this->currentPage = $_GET['p'];
     	    //Определяем следующую страницу
     	    $this->nextPage = $this->currentPage + 1;

     	    //Предыдущая страница
     	    if ($this->currentPage != 1)
     	    {
     	    	$this->prevPage = $this->currentPage -1;
     	    	$twig->addGlobal('pageLink','index.php?page=announcement&p='.$this->prevPage);
     	    }
     	    else
     	    {
     	    	$this->prevPage = 0;
     	    	$twig->addGlobal('pageLink','#');
     	    }

     	    if ($this->nextPage == $this->pageNumber-1)
     	    {
     	    	$twig->addGlobal('pageLink','#');
     	    }

     	    $twig->addGlobal('currentPage',$this->currentPage);
     	    $twig->addGlobal('nextPage',$this->nextPage);
     	    $twig->addGlobal('prevPage',$this->prevPage);
     	}
     }
}

?>