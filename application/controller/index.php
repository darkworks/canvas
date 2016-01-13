<?php

class Index_Controller extends Controller {

    public function index() {
        $this->registry->template->welcome = 'Welcome';
        $this->registry->template->content = "456";
        $this->registry->template->render('index');
    }

}

?>
