<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
    	$this->view->pass = $this->security->hash("pass1234");
    }

}

