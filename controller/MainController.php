<?php

class MainController extends DefaultController
{
    /**
     * Template
     * @var object
     */
    protected $template;

    /**
     * Default action
     * @return string content
     */
    public function index()
    {
        $count_items_on_page = $this->config['pagination']['count_items_on_page'];

        $allrecords = ImageModel::countAll();
        $gallery = ImageModel::findPart(0, $count_items_on_page);

        $data = [];
        $data['gallery'] = $gallery;

        if ($allrecords > $count_items_on_page) {
            $data['pagination'] = true;
        }

        return $this->template->render('index', $data);
    }

    /**
     * Action save canvas
     * @return json
     */
    public function save()
    {
        if (isset($_SESSION['userid']) && isset($_POST['image']) && (isset($_POST['password']) || isset($_POST['id']))) {

            $uploadDir = 'upload/';
            $path = SYSPATH . $uploadDir;
            $fileName = uniqid() . '.png';

            $img = str_replace('data:image/png;base64,', '', $_POST['image']);
            $img = str_replace(' ', '+', $img);

            if (isset($_POST['id'])) {
                $id = intval($_POST['id']);
                $image = ImageModel::find($id);

                if (isset($image->name)) {
                    throw new Exception('Not found');
                }

                file_put_contents($path . $image->name, base64_decode($img));

                $json = [];
                $json['error'] = false;
                $json['image'] = DIRECTORY_SEPARATOR . $uploadDir . $fileName;

                static::json($json);
            }

            file_put_contents($path . $fileName, base64_decode($img));

            $data = [];
            $data['userid'] = $_SESSION['userid'];
            $data['name'] = $fileName;
            $data['hash'] = System::crypt($_POST['password']);

            $image = new ImageModel();
            $image->userid = $_SESSION['userid'];
            $image->name = $fileName;
            $image->hash = System::crypt($_POST['password']);
            $status = $image->save();

            $json = [];
            $json['error'] = (!$status) ? true : false;

            if ($status) {
                $json['image'] = DIRECTORY_SEPARATOR . $uploadDir . $fileName;
                $json['id'] = ImageModel::getLastInsertId();
            }

            static::json($json);
        }
    }

    /**
     * Action get access for edit canvas
     * @return json
     */
    public function access()
    {
        if (isset($_SESSION['userid']) && isset($_POST['password']) && isset($_POST['imageid'])) {
            $imageInfo = ImageModel::find($_POST['imageid']);

            $check = false;
            $password = $_POST['password'];

            if (password_verify($password, $imageInfo->hash)) {
                $check = true;
            }

            $json = [];
            $json['error'] = !$check;

            if ($check) {
                $uploadDir = 'upload/';
                $path = SYSPATH . $uploadDir . $imageInfo->name;
                $imageData = file_get_contents($path);

                $json['image'] = 'data:image/png;base64,' . base64_encode($imageData);
            }

            static::json($json);
        }
    }

    /**
     * Action get images use Ajax
     * @return void
     */
    public function getimages()
    {
        if (isset($_SESSION['userid'])) {
            $currentPage = (intval($_POST['page']) <= 1) ? 1 : intval($_POST['page']);
            $allrecords = ImageModel::countAll();
            $count_items_on_page = $this->config['pagination']['count_items_on_page'];

            $start = $count_items_on_page * ($currentPage - 1);

            $show = ($allrecords >= $start + $count_items_on_page + 1) ? true : false;

            $json = [];
            $json['button'] = $show;
            $json['path'] = '/upload/';
            $json['currentpage'] = $currentPage;
            $result = ImageModel::findPart($start, $count_items_on_page);
            $json['images'] = $result->attributes;

            static::json($json);
        }
    }

    /**
     * Send json content
     * @param  array $array json
     * @return void
     */
    protected static function json($array)
    {
        header('Content-type: application/json');
        echo json_encode($array);
        exit();
    }
}