<?php

abstract class Controller {

    protected $registry;
    protected $template;

    function __construct($registry) {
        $this->registry = $registry;
        $this->template = $registry->template;
    }

    abstract function index();

}

?>
