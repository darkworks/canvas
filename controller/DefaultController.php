<?php
/**
 * Abstract base controller
 */
abstract class DefaultController
{
    abstract protected function index();

    /**
     * Template
     * @var object
     */
    protected $template;

    /**
     * Config for controllers
     * @var [type]
     */
    protected $config;

    /**
     * Database initialization
     * @param  array $config main config
     * @return void
     */
    public function init($config)
    {
        $this->template = new Template();
        $this->config = $config['controller'];
    }

    /**
     * Run the requested action
     * @param  string $action action
     * @return string         content of action
     */
    public function runAction($action)
    {
        ob_start();

        try{
            $this->$action();
        } catch(Exception $e) {

            if($e->getMessage() == 'Not found') {
                $this->error404();
                exit();
            }

            $this->error500();
            exit();
        }

        return ob_get_clean();
    }

    /**
     * Action Error404
     * @return string return content
     */
    public function error404()
    {
        return $this->template->render('error404');
    }

    /**
     * Action Error500
     * @return string return content
     */
    public function error500()
    {
        return $this->template->render('error500');
    }
}