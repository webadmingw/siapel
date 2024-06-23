<?php
require_once '../app/Models/UserModel.php';

class LoginController {
    private $user;

    public function __construct() {
        $this->user = new UserModel();
    }

    public function index() {
        if ($_SESSION) {
            header('Location: ' . BASE_URL);
            exit;
        }

        require_once '../app/Views/login/index.php';
    }

    public function doLogin() {
        $user = $this->user->getUserByEidAndPasswordHash($_POST['nomor_eid'], $_POST['key']);
        if ($user) {
            $_SESSION['eid'] = $user['eid'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['phone_number'] = $user['phone_number'];
            $_SESSION['avatar'] = $user['avatar'];
            // redirect to home page
            header('Location: ' . BASE_URL);
            exit;
        } else {
            $error = 'Email atau kata kunci tidak valid';
            require_once '../app/Views/login/index.php';
        }
    }
}
