<?php

class paginations
{
	 public $pageNumber;
	 public $currentPage;
	 public $nextPage;
	 public $prevPage;

     function __construct() 
     {
        global $db;

        $data = $db->getAll("SELECT * FROM os_announcment");

        $this->pageNumber = ceil(count($data) / 10);

        $this->getHtml();
     }

     public function getHtml()
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
     	    }

     	    $twig->addGlobal('currentPage',$this->currentPage);
     	    $twig->addGlobal('nextPage',$this->nextPage);
     	    $twig->addGlobal('prevPage',$this->prevPage);
     	}
     }
}

?>