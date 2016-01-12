<?php
defined('APP') or die('No direct script access.');

class Controller_Welcome extends Controller {

    public function action_index() {
    	$this->content = "Hello world";
    }
}

?>


