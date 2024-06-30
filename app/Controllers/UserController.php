<?php
require_once '../app/Models/UserModel.php';

class UserController {
    private $user;

    public function __construct() {
        $this->user = new UserModel();
    }

    public function index() {
        $users = $this->user->getAllUsers();
        require_once '../app/Views/user/index.php';
    }

    public function reg() {
        $post = [];
        $error = "";
        if (isset($_POST["nomor_eid"])) {
            $post = $_POST;
            if (isset($_POST["password"]) && isset($_POST["confirm_password"]) && $_POST["password"] !== $_POST["confirm_password"]) {
                $error = "Kata Kunci dan Konfirmasi tidak sama.";
            } else {
                $r = $this->user->insertUser($_POST["nomor_eid"], $_POST["email"], $_POST["phone_number"], $_POST["fullname"], $_POST["password"], $_POST["ktp"], $_POST["addr"], $_POST["cities"]); 
                if ($r === true) {
                    // redirect to home page
                    header('Location: ' . BASE_URL . "login");
                    exit;
                } else {
                    $error = "Gagal mendaftar atau member sudah tersedia, silakan coba lagi.";
                }
            }
        } 

        $cities = $this->user->getAllCities();
        require_once '../app/Views/user/register.php';
    }

    public function createUser() {
        $post = [];
        $error = "";
        if (isset($_POST["nomor_eid"])) {
            $post = $_POST;
            if (isset($_POST["password"]) && isset($_POST["confirm_password"]) && $_POST["password"] !== $_POST["confirm_password"]) {
                $error = "Kata Kunci dan Konfirmasi tidak sama.";
            } else {
                $r = $this->user->insertUserAdmin($_POST["nomor_eid"], $_POST["email"], $_POST["phone_number"], $_POST["fullname"], $_POST["password"], $_POST["role"], $_POST["ktp"], $_POST["addr"], $_POST["cities"]); 
                if ($r === true) {
                    // redirect to home page
                    header('Location: ' . BASE_URL . "user");
                    exit;
                } else {
                    $error = "Gagal mendaftar atau member sudah tersedia, silakan coba lagi.";
                }
            }
        } 

        $cities = $this->user->getAllCities();
        require_once '../app/Views/user/create.php';
    }

    public function delete($id) {
        $r = $this->user->deleteUser($id);
        if ($r === true) {
            header('Location: ' . BASE_URL . "user");
            exit;
        } else {
            $error = "Gagal menghapus pengguna.";
        }
    }

    public function reset_password($id) {
        $post = [];
        $error = "";
        $eid = $id;
        if($_POST){
            if (isset($_POST["password"]) && isset($_POST["confirm_password"]) && $_POST["password"] !== $_POST["confirm_password"]) {
                $error = "Kata Kunci Baru dan Konfirmasi tidak sama.";
            } else {
                $r = $this->user->changePasswordByUserId($id, $_POST["password"]);
                if ($r === true) {
                    header('Location: ' . BASE_URL . "user");
                    exit;
                } else {
                    $error = "Gagal mengubah kata kunci.";
                }
            }
        }
        require_once '../app/Views/user/reset_password.php';
    }

    public function edit($id) {
        $post = [];
        $error = "";
        $eid = $id;
        if($_POST){
            $r = $this->user->updateUserWithoutPassword($id, $_POST["email"], $_POST["phone_number"], $_POST["fullname"], $_POST["role"], $_POST["ktp"], $_POST["addr"], $_POST["cities"]);
            if ($r === true) {
                header('Location: ' . BASE_URL . "user");
                exit;
            } else {
                $error = "Gagal mengubah profil.";
            }
        }
        $user = $this->user->getUserByEid($id);
        $cities = $this->user->getAllCities();
        require_once '../app/Views/user/edit.php';
    }
}
