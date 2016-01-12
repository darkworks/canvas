<?php
defined('APP') or die('No direct script access.');

class Controller_My extends Controller {

    public function action_index() {
    	$this->content = "Hello MY";
    }
}

?>


