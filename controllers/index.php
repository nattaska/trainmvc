<?php

class Index extends Controller {
    function __construct(){
        parent::__construct();
        // echo "We are in index </br>";

        // $this->view->render('index/index');
    }

    function index() {
        $this->view->render('index/index');
    }

    function details() {
        $this->view->render('index/index');
    }

}

?>