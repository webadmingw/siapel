<?php
require_once '../app/Models/UserModel.php';

class UserController {
    private $user;

    public function __construct() {
        $this->user = new UserModel();
    }

    public function reg() {
        $post = [];
        $error = "";
        if (isset($_POST["nomor_eid"])) {
            $post = $_POST;
            if (isset($_POST["password"]) && isset($_POST["confirm_password"]) && $_POST["password"] !== $_POST["confirm_password"]) {
                $error = "Kata Kunci dan Konfirmasi tidak sama.";
            } else {
                $r = $this->user->insertUser($_POST["nomor_eid"], $_POST["email"], $_POST["phone_number"], $_POST["fullname"], $_POST["password"]); // added semicolon
                if ($r === true) {
                    // redirect to home page
                    header('Location: ' . BASE_URL . "login");
                    exit;
                } else {
                    $error = "Gagal mendaftar atau member sudah tersedia, silakan coba lagi.";
                }
                echo "REDI ".$r;
            }
        } 
        require_once '../app/Views/user/register.php';
    }
}
