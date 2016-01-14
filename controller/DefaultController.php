<?php

class DefaultController
{
    protected $template;

    public function init($config)
    {
        $this->template = new Template();
    }

    public function runAction($action)
    {
        ob_start();
        $this->$action();

        return ob_get_clean();
    }

    public function index()
    {
        $content = 'Hello world';

        if(isset($_SESSION['username'])){
            $content = 'Hello ' . $_SESSION['username'];
        }

        return $this->template->render('index', ['content' => $content]);
    }

    public function error404()
    {
        return $this->template->render('error404');
    }
}