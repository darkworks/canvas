<?php

class Error404_Controller extends Controller {

    public function index() {
        $this->registry->template->heading = 'This is the 404';
        $this->registry->template->render('error404');
    }
}
?>
