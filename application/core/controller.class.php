<?php

class Controller {

	public $content;

	public function __construct() {

		$controller = Request->getController();
		$controller = ($controler == 'index') ? 'welcome' : $controller;

		$action = 'action_' . Request->getMethod();

		if()



	}


}