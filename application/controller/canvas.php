<?php

class Canvas_Controller extends Controller {

    public function index() {
        $this->registry->template->heading = 'This is the canvas Index';
        $this->registry->template->render('canvas_index');
    }

    public function view() {
        $this->registry->template->heading = 'This is the canvas heading';
        $this->registry->template->content = 'This is the canvas content';
        $this->registry->template->render('canvas_view');
    }

}
?>
