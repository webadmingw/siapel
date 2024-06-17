<?php
class NewsController {
    private $newsModel;

    public function __construct() {
        $this->newsModel = new NewsModel();
    }

    public function index() {
        $news = $this->newsModel->getAllNews();
        require_once '../app/Views/news/index.php';
    }

    public function view($id) {
        $news = $this->newsModel->getNewsById($id);
        require_once '../app/Views/news/view.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $contributor_id = $_SESSION['user_id'];
            $image = $_FILES['image']['name'];

            // Handle image upload
            $target_dir = "../public/images/";
            $target_file = $target_dir . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

            $this->newsModel->createNews($title, $content, $contributor_id, $image);

            header('Location: /news');
        } else {
            require_once '../app/Views/news/create.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_FILES['image']['name'];

            // Handle image upload
            $target_dir = "../public/images/";
            $target_file = $target_dir . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

            $this->newsModel->updateNews($id, $title, $content, $image);

            header('Location: /news');
        } else {
            $news = $this->newsModel->getNewsById($id);
            require_once '../app/Views/news/edit.php';
        }
    }

    public function delete($id) {
        $this->newsModel->deleteNews($id);
        header('Location: /news');
    }
}
