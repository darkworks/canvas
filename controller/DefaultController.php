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
        $gallery = ImageModel::findAll();

        return $this->template->render('index', ['gallery' => $gallery]);
    }

    public function save()
    {
        if(isset($_SESSION['userid']) && isset($_POST['image']) && isset($_POST['password'])) {
            $uploadDir = 'upload/';
            $path = SYSPATH . $uploadDir;
            $fileName = uniqid() . '.png';

            $img = str_replace('data:image/png;base64,', '', $_POST['image']);
            $img = str_replace(' ', '+', $img);

            file_put_contents($path . $fileName, base64_decode($img));

            $data = [];
            $data['userid'] = $_SESSION['userid'];
            $data['name'] = $fileName;
            $data['password'] = System::crypt($_POST['password']);

            $sql = ImageModel::add($data);

            $json = [];
            $json['error'] = (!$sql) ? true : false;

            if($sql) {
                $json['image'] = DIRECTORY_SEPARATOR . $uploadDir . $fileName;
                $json['id'] = ImageModel::$lastInsertId;
            }

            static::json($json);

            // var_dump($data);

        }

        // header('Content-Type: application/json');
        // echo json_encode($_POST);
        // echo print_r($_POST, true);
        // echo print_r($_SESSION, true);
        // die();
    }

    public function access()
    {
        if(isset($_SESSION['userid']) && isset($_POST['password']) && isset($_POST['imageid'])) {
            $imageInfo = ImageModel::checkAccess($_POST['imageid']);

            $check = false;

            if($imageInfo['password'] == System::crypt($_POST['password'])) {
                $check = true;
            }

            $json = [];
            $json['error'] = !$check;

            static::json($json);
        }
    }

    public function error404()
    {
        return $this->template->render('error404');
    }

    protected static function json($array)
    {
        header('Content-type: application/json');
        echo json_encode($array);
        exit();
    }
}