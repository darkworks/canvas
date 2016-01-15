<?php

class UserController extends DefaultController
{
    protected $template;

    public function index()
    {
        // var_dump($_POST);
        $errors = [];

        // Auth
        if(!empty($_POST) && isset($_POST['username']) && isset($_POST['password'])) {

            $username = $_POST['username'];
            $password = System::crypt($_POST['password']);

            $userInfo = UserModel::find($username);

            if(!$userInfo){
                $errors[] = 'User not found';
            }

            if($password != $userInfo['password']) {
                $errors[] = 'Username or password are incorrect';
            }

            if(!empty($errors)){
                return $this->template->render('userIndex', ['errors' => $errors]);
            }

            $_SESSION['userid'] = $userInfo['id'];
            $_SESSION['username'] = $userInfo['username'];

            header('Location: /');
        }

        return $this->template->render('userIndex');
    }

    // public function create()
    // {
    //     $user = new User();
    //     $user->name = 'Вася Пупкин';
    //     $user->save();

    //     return $this->template->render('userIndex', ['user' => $user->name]);
    // }
}
