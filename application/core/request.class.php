<?php

Class Request {

	private $_controller;
    private $_method;
    private $_args;

    public function __construct(){

        $uri = explode('/', $_SERVER['REQUEST_URI']);

        array_shift($uri);

        $this->_controller = ($c = array_shift($uri)) ? $c: 'index';
        $this->_method = ($c = array_shift($uri)) ? $c: 'index';
        $this->_args = (isset($uri[0])) ? $uri : array();
    }

	public function getController() {
        return $this->_controller;
    }

    public function getMethod() {
        return $this->_method;
    }

    public function getArgs() {
        return $this->_args;
    }

    public function output() {

    	$out = array();
    	$out['controller'] = $this->_controller;
    	$out['method'] = $this->_method;
    	$out['args'] = $this->_args;

    	return $out;
    }
}

?>